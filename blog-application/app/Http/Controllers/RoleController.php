<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Permission;

class RoleController extends Controller
{
    public function index(){
        $roles = Role::all();
        return view('roles.index', compact('roles'));
    }
    
    public function store(Role $role){
       $inputs =  request()->validate([
            'name' => 'required|max:255|unique:roles,name',
        ]);
        $inputs['name'] = ucfirst(request('name'));
        $role->create($inputs);
        request()->session()->flash('role-created', 'Role created successfully');
        return redirect()->back();
        
    }

    public function show(Role $role){
        $permissions = Permission::all();
        return view('roles.edit',compact('role','permissions'));
    }

    public function update (Role $role){
        $inputs = request()->validate([
            'name' => 'required|max:255|unique:roles,name',
        ]);
        $inputs['name'] = ucfirst(request('name'));
         $role->update($inputs);
         request()->session()->flash('role-updated', 'Role updated successfully!');
         return redirect()->back();
    }

    public function delete(Role $role){
        $role->delete();
        request()->session()->flash('role-deleted', 'Role deleted successfully.');
        return redirect()->back();
    }

    public function attach(Role $role){
        $role->permissions()->attach(request('permission'));
        request()->session()->flash('message-permission-attach', 'Permission attached successfully!');
        return redirect()->back();
    }
    public function detach(Role $role){
        $role->permissions()->detach(request('permission'));
        request()->session()->flash('message-permission-detach', 'Permission detached successfully!');
        return redirect()->back();
    }
}
