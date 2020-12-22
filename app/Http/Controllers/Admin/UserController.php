<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index_user(){
        $users = User::with(['roles', 'permissions'])->get();
        
        return view('dashboard.user.index', [
            'users' => $users,
        ]);
    }

    public function edit($username){
        $user = User::with(['roles', 'permissions'])->where('username', $username)->firstOrFail();
        $roles = Role::all();
        $permissions = Permission::all();

        return view('dashboard.user.edit', [
            'user' => $user,
            'roles' => $roles,
            'permissions' => $permissions
        ]);
    }

    public function update_user(Request $request, $username){
        $user = User::where('username', $username)->firstOrFail();

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'regex:/^(?![ .]+$)[a-zA-Z .]*$/'],
            'username' => ['required', 'string', Rule::unique('users')->ignore($user->id),'regex:/^[a-zA-Z0-9_.-]*$/' ,'max:25'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id),],
        ]);
        
        $user->update($data);
        
        session()->flash('update', "You're Data has been updated");

        return redirect()->route('user-edit', $user->username);
    }

    public function update_user_role(Request $request, $username){
        $user = User::where('username', $username)->firstOrFail();

        $data = $request->all();

        $user->syncRoles($data['roles']);
        $user->syncPermissions($data['permission']);

        session()->flash('update', "You're Role and Permissions has been updated");

        return back();
    }

    public function delete_user($username){
        $user = User::where('username', $username)->firstOrFail();

        $user->delete();
        
        return redirect()->route('dashboard-user');
    }


    public function create_user(){

        return view('dashboard.user.create');
    }

    public function store_user(Request $request){
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'regex:/^(?![ .]+$)[a-zA-Z .]*$/'],
            'username' => ['required', 'string', 'unique:users','regex:/^[a-zA-Z0-9_.-]*$/', 'max:25'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        
        $data['password'] = Hash::make($request['password']);

        $user = User::create($data);

        $user->assignRole('user');
        $user->givePermissionTo(['publish articles', 'edit articles', 'delete articles']);

        session()->flash('create', "User has been created");

        return redirect()->route('dashboard-user');
    }



    // USER ADMIN
    public function index_admin(){
        $users = User::with(['roles', 'permissions'])->get();
        
        return view('dashboard.admin.index', [
            'users' => $users,
        ]);
    }

    public function create_admin(){
        $this->authorize('create_admin');
        return view('dashboard.admin.create');
    }

    public function store_admin(Request $request){
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'regex:/^(?![ .]+$)[a-zA-Z .]*$/'],
            'username' => ['required', 'string', 'unique:users','regex:/^[a-zA-Z0-9_.-]*$/', 'max:25'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        $data['password'] = Hash::make($request['password']);
        
        $this->authorize('create_admin');

        $user = User::create($data);
        $user->assignRole('admin');
        $user->givePermissionTo(['publish articles', 'edit articles', 'delete articles']);

        return redirect()->route('dashboard-admin');
    }

    public function delete_admin($username){
        $user = User::where('username', $username)->firstOrFail();

        $this->authorize('delete_admin');

        $user->delete();
        
        return redirect()->route('dashboard-admin');
    }
}
