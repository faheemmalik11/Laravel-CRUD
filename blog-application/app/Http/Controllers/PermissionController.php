<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permission;

class PermissionController extends Controller
{
    public function index(){
        $permissions = Permission::all();
        return view('permissions.index', compact('permissions'));
    }

    public function store(Permission $permission){
        $inputs =  request()->validate([
             'name' => 'required|max:255|unique:permissions,name',
         ]);
         $inputs['name'] = ucfirst(request('name'));
         $permission->create($inputs);
         request()->session()->flash('permission-created', 'Permission created successfully');
         return redirect()->back();
         
     }

     public function show(Permission $permission){
        return view('permissions.edit',compact('permission'));
    }

     public function update (Permission $permission){
        $inputs = request()->validate([
            'name' => 'required|max:255|unique:permissions,name',
        ]);
        $inputs['name'] = ucfirst(request('name'));
         $permission->update($inputs);
         request()->session()->flash('permission-updated', 'permission updated successfully!');
         return redirect()->back();
    }

    public function delete(Permission $permission){
        $permission->delete();
        request()->session()->flash('permission-deleted', 'Permission deleted successfully.');
        return redirect()->back();
    }


}
