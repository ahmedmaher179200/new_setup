<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\users\createRequest;
use App\Http\Requests\users\editRequest;
use App\Models\Role;
use App\Models\User;
use App\Services\UsersService;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;
use Illuminate\Database\Eloquent\Factories\Sequence;

class UserController extends Controller
{
    protected $UsersService;

    public function __construct(UsersService $UsersService) {
        $this->UsersService = $UsersService;

        $this->middleware('permissionMiddleware:read-users')->only('index');
        $this->middleware('permissionMiddleware:delete-users')->only('destroy');
        $this->middleware('permissionMiddleware:update-users')->only(['edit', 'Update']);
        $this->middleware('permissionMiddleware:create-users')->only(['create', 'store']);
    }

    public function index(){
        $users = User::get();
        return view('admins.users.index')->with('users', $users);
    }

    public function create(){
        $roles = Role::all();
        return view('admins.users.create')->with('roles', $roles);
    }

    public function store(createRequest $request){
        $this->UsersService->insert($request);

        return redirect('dashboard/users')->with('success', 'success');
    }

    public function edit($id){
        $roles = Role::all();
        $user = User::findOrFail($id);

        if($user->id == User::first()->id)
            return redirect('dashboard/users')->with('error', trans('admin.you can\'t update this user'));
        
        return view('admins.users.edit')->with([
            'roles' => $roles,
            'user' => $user,
        ]);
    }

    public function update($id, editRequest $request){
        $user = User::findOrFail($id);

        $this->UsersService->update($user, $request);

        return redirect('dashboard/users')->with('success', 'success');
    }

    public function destroy($user_id){
        $user = User::findOrFail($user_id);

        if($user->id == User::first()->id)
            return redirect('dashboard/users')->with('error', trans('admin.you can\'t delete this user'));
        
        $user->delete();

        return redirect()->back()->with('success', trans('admin.success'));
    }
}