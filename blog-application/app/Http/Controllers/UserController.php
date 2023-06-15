<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
class UserController extends Controller
{
    public function index(){
        $users = User::all();
        
        return view('user.index', compact('users'));
    }
    public function show(User $user){
        $roles = Role::all();
        return view('user.profile',compact('user','roles'));
    }

    public function update(User $user){
        $inputs = request()->validate([
            'username' => ['required', 'string', 'max:255', 'unique:users,username'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'profile_image' => ['file']
   
        ]);

         $inputs['profile_image'] = request('profile_image')->store('images');
         $user->update($inputs);
         request()->session()->flash('message-user-updated', 'User updated successfully!');
         return redirect()->route('admin.users.index');
    }

    public function delete(User $user){
        $user->delete();
        request()->session()->flash('message', 'User deleted successfully!');
        return redirect()->back();
    }

    public function attach(User $user){
        $user->roles()->attach(request('role'));
        request()->session()->flash('message-role-attach', 'Role attached successfully!');
        return redirect()->back();
    }
    public function detach(User $user){
        $user->roles()->detach(request('role'));
        request()->session()->flash('message-role-detach', 'Role detached successfully!');
        return redirect()->back();
    }
}
