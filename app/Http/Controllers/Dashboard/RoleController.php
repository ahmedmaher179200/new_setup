<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\roles\createRequest;
use App\Http\Requests\roles\editRequest;
use App\Models\Role;
use App\Services\ActivityLogsService;
use App\Services\RolesService;

class RoleController extends Controller
{
    protected $RolesService;
    protected $ActivityLogsService;

    public function __construct(RolesService $RolesService,
                                ActivityLogsService $ActivityLogsService) {
                                    
        $this->RolesService = $RolesService;
        $this->ActivityLogsService = $ActivityLogsService;


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
        $role = $this->RolesService->insert($request);

        $this->ActivityLogsService->insert([
            'subject_id'      => $role->id,
            'subject_type'    => 'App\Models\Role',
            'description'     => 'create',
            'causer_id'       => auth('user')->user()->id,
            'causer_type'     => 'App\Models\User',
            'properties'      => null,
        ]);

        return redirect('dashboard/roles')->with('success', 'success');
    }

    public function edit($role_id){
        $role = Role::findOrFail($role_id);

        return view('admins.roles.edit')->with('role', $role);
    }

    public function update($role_id, editRequest $request){
        $role = Role::findOrFail($role_id);

        $this->RolesService->update($role, $request);

        $this->ActivityLogsService->insert([
            'subject_id'      => $role_id,
            'subject_type'    => 'App\Models\Role',
            'description'     => 'update',
            'causer_id'       => auth('user')->user()->id,
            'causer_type'     => 'App\Models\User',
            'properties'      => null,
        ]);

        return redirect('dashboard/roles')->with('success', 'success');
    }

    public function destroy($role_id){
        $role = Role::where('status', '!=', -1)
                        ->findOrFail($role_id);

        if($role->id == Role::first()->id)
            return redirect('dashboard/roles')->with('error', trans('admin.you can\'t delete this role'));
        
        $role->delete();

        $this->ActivityLogsService->insert([
            'subject_id'      => $role_id,
            'subject_type'    => 'App\Models\Role',
            'description'     => 'delete',
            'causer_id'       => auth('user')->user()->id,
            'causer_type'     => 'App\Models\User',
            'properties'      => null,
        ]);

        return redirect()->back()->with('success', trans('admin.success'));
    }
}