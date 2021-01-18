<?php

namespace App\Http\Controllers\Dashboard;

use Carbon\Carbon;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Repositories\Repository;
use App\Http\Requests\RolesRequest;
use App\Http\Controllers\Controller;

class RolesController extends Controller
{

  protected $repository;

  public function __construct(Role $role)
  {
    $this->repository   = new Repository($role);
  }

  public function index()
  {
    $roles = $this->repository->all();
    return view('dashboard.roles.index', compact('roles'));
  }

  public function create()
  {
    return view('dashboard.roles.create');
  }

  public function saveRole(RolesRequest $request)
  {

    try {

      if (!$request->has('lang')){
        $request->request->add(['is_active' => '0']);
      }

      $role = $this->process(new Role, $request);

      if ($role)
        return redirect()->route('admin.roles.index')->with(['success' => __('admin/roles.created')]);
      else

      return redirect()->route('admin.roles.index')->with(['error' => __('admin/roles.not found')]);

    } catch (\Exception $ex) {
      return redirect()->route('admin.roles.index')->with(['error' => __('admin/roles.error try later')]);
    }
  }

  public function edit($id)
  {
    $role = Role::findOrFail($id);
    return view('dashboard.roles.edit',compact('role'));
  }

  public function update($id,RolesRequest $request)
  {
    try {
      $role = Role::findOrFail($id);

      $role = $this->process($role, $request);
      if ($role)
        return redirect()->route('admin.roles.index')->with(['success' => __('admin/roles.updated')]);
      else

      return redirect()->route('admin.roles.index')->with(['error' => __('admin/roles.not found')]);

    } catch (\Exception $ex) {
      return redirect()->route('admin.roles.index')->with(['error' => __('admin/roles.error try later')]);
    }
  }

  protected function process(Role $role, Request $r)
  {
    $role->name = $r->name;
    $role->permissions = json_encode($r->permissions);
    $role->save();
    return $role;
  }

  public function destroy($id)
  {
    try {
    $roles = Role::find($id);

    if (!$roles)
      return redirect()->route('admin.roles.index')->with(['error' =>__('admin/roles.not found')]);

    $roles->delete();

    return redirect()->route('admin.roles.index')->with(['success' =>__('admin/roles.deleted')]);

    } catch (\Exception $ex) {
    return redirect()->route('admin.roles.index')->with(['error' => __('admin/roles.error try later')]);
    }
  }

}
