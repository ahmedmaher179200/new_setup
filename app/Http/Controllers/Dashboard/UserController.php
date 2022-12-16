<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\users\createRequest;
use App\Http\Requests\users\editRequest;
use App\Models\Role;
use App\Models\User;
use App\Services\ActivityLogsService;
use App\Services\UsersService;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;
use Illuminate\Database\Eloquent\Factories\Sequence;

class UserController extends Controller
{
    protected $UsersService;
    protected $ActivityLogsService;

    public function __construct(UsersService $UsersService, ActivityLogsService $ActivityLogsService) {
        $this->UsersService = $UsersService;
        $this->ActivityLogsService = $ActivityLogsService;

        $this->middleware('permissionMiddleware:read-users')->only('index');
        $this->middleware('permissionMiddleware:delete-users')->only('destroy');
        $this->middleware('permissionMiddleware:update-users')->only(['edit', 'Update', 'activity_logs']);
        $this->middleware('permissionMiddleware:create-users')->only(['create', 'store']);
    }

    public function index(){
        $users = User::where('super', '!=', 1)->get();
        return view('admins.users.index')->with('users', $users);
    }

    public function create(){
        $roles = Role::all();
        return view('admins.users.create')->with('roles', $roles);
    }

    public function store(createRequest $request){
        $user = $this->UsersService->insert($request);

        $this->ActivityLogsService->insert([
            'subject_id'      => $user->id,
            'subject_type'    => 'App\Models\User',
            'description'     => 'create',
            'causer_id'       => auth('user')->user()->id,
            'causer_type'     => 'App\Models\User',
            'properties'      => null,
        ]);

        return redirect('dashboard/users')->with('success', 'success');
    }

    public function edit($id){
        $roles = Role::all();
        $user = User::findOrFail($id);

        if($user->super == 1)
            return redirect('dashboard/users')->with('error', trans('admin.you can\'t update this user'));
        
        return view('admins.users.edit')->with([
            'roles' => $roles,
            'user' => $user,
        ]);
    }

    public function update($id, editRequest $request){
        $user = User::findOrFail($id);

        $this->UsersService->update($user, $request);

        $this->ActivityLogsService->insert([
            'subject_id'      => $id,
            'subject_type'    => 'App\Models\User',
            'description'     => 'update',
            'causer_id'       => auth('user')->user()->id,
            'causer_type'     => 'App\Models\User',
            'properties'      => null,
        ]);

        return redirect('dashboard/users')->with('success', 'success');
    }

    public function destroy($user_id){
        $user = User::findOrFail($user_id);

        if($user->super == 1)
            return redirect('dashboard/users')->with('error', trans('admin.you can\'t delete this user'));
        
        $user->delete();

        $this->ActivityLogsService->insert([
            'subject_id'      => $user_id,
            'subject_type'    => 'App\Models\User',
            'description'     => 'delete',
            'causer_id'       => auth('user')->user()->id,
            'causer_type'     => 'App\Models\User',
            'properties'      => null,
        ]);

        return redirect()->back()->with('success', trans('admin.success'));
    }

    public function activity_logs($id){
        $user = User::findOrFail($id);

        return view('admins.users.activity_logs')->with([
            'user' => $user,
        ]);
    }
}