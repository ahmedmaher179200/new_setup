<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\createRequest;
use App\Http\Requests\admin\editRequest;
use App\Models\Admin;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class admins extends Controller
{
    public function index(){
        //select all admin
        $admins = Admin::where('id', '!=', auth('admin')->user()->id)->get();
        
        return view('admins.admins.index')->with('admins', $admins);
    }

    public function delete($id){
        $admin = Admin::find($id);

        //if admin not found
        if($admin == null){
            return redirect('dashboard/admins')->with('error', 'delete faild');
        }

        //delete admin
        $admin->delete();

        return redirect('dashboard/admins')->with('success', 'edit success');
    }

    public function createView(){
        $roles = Role::all();
        return view('admins.admins.create')->with('roles', $roles);
    }

    public function create(createRequest $request){
        $admin = Admin::create([
            'username'      => $request->username,
            'password'      => Hash::make($request->password),
        ]);

        //add role to admin
        $admin->roles()->attach([$request->role_id]);

        return redirect('dashboard/admins')->with('success', 'add success');
    }

    public function editView($id){
        $roles = Role::all();
        $admin = Admin::find($id);

        //if admin not found
        if($admin == null)
            return redirect('dashboard/admins');
        
        return view('admins.admins.edit')->with([
            'roles' => $roles,
            'admin' => $admin,
        ]);
    }

    public function edit($id, editRequest $Request){
        $admin = Admin::find($id);

        //check if admin change password
        if($Request->password == NULL){
            $password = $admin->password;
        } else{
            $password = Hash::make($Request->password);
        }

        //update data
        $admin->username       = $Request->username;
        $admin->password       = $password;
        $admin->save();

        //change admin role
        $admin->roles()->detach([$admin->getRoleId()]);//delete old
        $admin->roles()->attach([$Request->role_id]);//add new

        return redirect('dashboard/admins')->with('success', 'edit success');
    }
}