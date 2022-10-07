<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\roles\createRequest;
use App\Http\Requests\roles\editRequest;
use App\Models\Role;
use App\Repositories\dashboard\rolesRepository;

class roles extends Controller
{
    protected $rolesRepository;

    public function __construct(rolesRepository $rolesRepository) {
        $this->rolesRepository = $rolesRepository;

        $this->middleware('permissionMiddleware:read-roles')->only('index');
        $this->middleware('permissionMiddleware:delete-roles')->only('destroy');
        $this->middleware('permissionMiddleware:update-roles')->only(['edit', 'Update']);
        $this->middleware('permissionMiddleware:create-roles')->only(['create', 'store']);
    }

    public function index(){
        $roles = Role::get();
        return view('admins.roles.index')->with('roles', $roles);
    }

    public function create(){
        return view('admins.roles.create');
    }

    public function store(createRequest $request){
        $this->rolesRepository->insert($request);

        return redirect('dashboard/roles')->with('success', 'success');
    }

    public function edit($role_id){
        $role = Role::findOrFail($role_id);


        return view('admins.roles.edit')->with('role', $role);
    }

    public function update($role_id, editRequest $request){
        $role = Role::findOrFail($role_id);

        $this->rolesRepository->update($role, $request);

        return redirect('dashboard/roles')->with('success', 'success');
    }

    public function destroy($role_id){
        $role = Role::where('status', '!=', -1)
                        ->findOrFail($role_id);

        if($role->id == Role::first()->id)
            return redirect('dashboard/roles')->with('error', trans('admin.you can\'t delete this role'));
        
        $role->delete();

        return redirect()->back()->with('success', trans('admin.success'));
    }
}