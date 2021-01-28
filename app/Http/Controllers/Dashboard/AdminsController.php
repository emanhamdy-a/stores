<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Role;
use App\Models\Admin;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\AdminRequest;
use App\Http\Controllers\Controller;

class AdminsController extends Controller {

  /**
  * render and paginate the admins page.
  *
  * @return string
  */
  public function index() {
    $users = Admin::latest()->where('id', '<>', auth()->id())->get();
    return view('dashboard.admins.index', compact('users'));
  }

  public function create(){
    $roles = Role::get();
    return view('dashboard.admins.create',compact('roles'));
  }


  public function store(AdminRequest $request) {
    $user = new Admin();
    $user->name = $request->name;
    $user->email = $request->email;
    $user->password = bcrypt($request->password);

    $user->role_id = $request->role_id;

    // save the new user data
    if($user->save())
       return redirect()->route('admin.admins.index')->with(['success' => __('admin/admins.updated')]);
    else
      return redirect()->route('admin.admins.index')->with(['success' => __('admin/admins.error try later')]);

  }

  public function edit($id){
    $user=Admin::findOrFail($id);
    $roles = Role::get();
    if (!$user || !$roles){
    return redirect()->route('admin.admins.index')->with(['error' =>  __('admin/admins.not found')]);
    }
    return view('dashboard.admins.edit',compact('roles','user'));
  }

  public function update($id, AdminRequest  $request)
  {
    try {

     $user = Admin::findOrFail($id);

    if (!$user)
      return redirect()->route('admin.admins.index')->with(['error' => __('admin/admins.not found')]);

    DB::beginTransaction();

    $data = array_filter($request->validated());

    $user->update($data);

    DB::commit();
    return redirect()->route('admin.admins.index')->with(['success' => __('admin/admins.updated')]);

    } catch (\Exception $ex) {

    DB::rollback();
    return redirect()->route('admin.admins.index')->with(['error' => __('admin/admins.error try later')]);
    }

  }

  public function destroy($id)
  {

    $user = Admin::findOrFail($id);

    if(!$user){
    return redirect()->route('admin.admins.index')->with([
      'error'=> __('admin/admins.not found')
    ]);
    };

    $user->delete();

    return redirect()->route('admin.admins.index')->with([
    'success' => _('admin/admins.deleted')
    ]);

  }
}
