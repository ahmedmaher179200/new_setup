<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\roles\createRequest;
use App\Models\Role;

class roles extends Controller
{
    public function index(){
        $roles = Role::where('status', '!=', -1)->get();
        return view('admins.roles.index')->with('roles', $roles);
    }

    public function create(){
        return view('admins.roles.create');
    }

    public function store(createRequest $request){
        $role = Role::create([
            'name'          => $request->name,
            'display_name'  => $request->name,
            'description'   => $request->description
        ]);

        //add permissions to this role
        $role->attachPermissions($request->permissions);

        return redirect('dashboard/roles')->with('success', 'success');
    }

    public function delete($id){
        $role = Role::find($id);

        if($role == null)
            return redirect('dashboard/roles')->with('error', 'delete faild');

        $role->delete();

        return redirect('dashboard/roles')->with('success', 'edit success');
    }

    public function edit($role_id){
        $role = Role::find($role_id);

        if($role == null)
            return redirect('dashboard/roles');

        return view('admins.roles.edit')->with('role', $role);
    }

    public function update($role_id, createRequest $request){
        $role = Role::find($role_id);

        if($role == null)
            return redirect('dashboard/roles');

        $role->name            = $request->name;
        $role->display_name    = $request->name;
        $role->description     = $request->description;
        $role->save();

        $role->syncPermissions($request->permissions); //update role permassion

        return redirect('dashboard/roles')->with('success', 'success');
    }

    public function destroy($role_id){
        $role = Role::where('status', '!=', -1)
                                        ->find($role_id);

        if($role == null)
            return redirect()->back()->with('error', trans('admin.faild'));
        
        $role->update(['status'=> -1]);

        return redirect()->back()->with('success', trans('admin.success'));
    }
}