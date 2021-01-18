<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Role;
use App\Models\Admin;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\AdminRequest;
use App\Http\Controllers\Controller;

class UsersController extends Controller {

    /**
    * render and paginate the users page.
    *
    * @return string
    */
    public function index() {
      $users = Admin::latest()->where('id', '<>', auth()->id())->get();
      return view('dashboard.users.index', compact('users'));
    }

    public function create(){
        $roles = Role::get();
        return view('dashboard.users.create',compact('roles'));
    }


    public function store(AdminRequest $request) {
        $user = new Admin();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);

        $user->role_id = $request->role_id;

        // save the new user data
        if($user->save())
             return redirect()->route('admin.users.index')->with(['success' => 'تم التحديث بنجاح']);
        else
            return redirect()->route('admin.users.index')->with(['success' => 'حدث خطا ما']);

    }

    public function edit($id){
      $user=Admin::findOrFail($id);
      $roles = Role::get();
      if (!$user || !$roles){
        return redirect()->route('admin.users.index')->with(['error' =>  __('admin/users.not found')]);
      }
      return view('dashboard.users.edit',compact('roles','user'));
    }

    public function update($id, AdminRequest  $request)
    {
      try {

         $user = Admin::findOrFail($id);

        if (!$user)
          return redirect()->route('admin.users.index')->with(['error' => __('admin/users.not found')]);

        DB::beginTransaction();

        $data = array_filter($request->validated());

        $user->update($data);

        DB::commit();
        return redirect()->route('admin.users.index')->with(['success' => __('admin/users.updated')]);

      } catch (\Exception $ex) {

        DB::rollback();
        return redirect()->route('admin.users.index')->with(['error' => __('admin/users.error try later')]);
      }

    }

    public function destroy($id)
    {

      $user = Admin::findOrFail($id);

      if(!$user){
        return redirect()->route('admin.users.index')->with([
          'error'=> __('admin/users.not found')
        ]);
      };

      $user->delete();

      return redirect()->route('admin.users.index')->with([
        'success' => _('admin/users.deleted')
      ]);

    }
}
