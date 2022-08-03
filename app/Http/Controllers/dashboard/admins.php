<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\createRequest;
use App\Http\Requests\admin\editRequest;
use App\Models\Admin;
use App\Models\Role;
use App\Repositories\dashboard\adminsRepository;
use Illuminate\Support\Facades\Hash;

class admins extends Controller
{
    protected $adminsRepository;

    public function __construct(adminsRepository $adminsRepository) {
        $this->adminsRepository = $adminsRepository;
    }

    public function index(){
        $admins = Admin::get();
        return view('admins.admins.index')->with('admins', $admins);
    }

    public function delete($id){
        $admin = Admin::find($id);

        if($admin == null)
            return redirect('dashboard/admins')->with('error', 'faild');

        $admin->delete();

        return redirect('dashboard/admins')->with('success', 'success');
    }

    public function create(){
        $roles = Role::all();
        return view('admins.admins.create')->with('roles', $roles);
    }

    public function store(createRequest $request){
        $admin = Admin::create([
            'username'      => $request->username,
            'password'      => Hash::make($request->password),
        ]);

        $admin->roles()->attach([$request->role_id]);

        return redirect('dashboard/admins')->with('success', 'add success');
    }

    public function edit($id){
        $roles = Role::all();
        $admin = Admin::find($id);

        if($admin == null)
            return redirect('dashboard/admins');
        
        return view('admins.admins.edit')->with([
            'roles' => $roles,
            'admin' => $admin,
        ]);
    }

    public function Update($id, editRequest $request){
        $admin = Admin::find($id);

        $this->adminsRepository->update($admin, $request);

        return redirect('dashboard/admins')->with('success', 'success');
    }
}