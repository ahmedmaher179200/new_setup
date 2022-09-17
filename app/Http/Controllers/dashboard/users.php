<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\users\createRequest;
use App\Http\Requests\users\editRequest;
use App\Models\Role;
use App\Models\User;
use App\Repositories\dashboard\usersRepository;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;
use Illuminate\Database\Eloquent\Factories\Sequence;

class users extends Controller
{
    protected $usersRepository;

    public function __construct(usersRepository $usersRepository) {
        $this->usersRepository = $usersRepository;
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
        $this->usersRepository->insert($request);

        return redirect('dashboard/users')->with('success', 'success');
    }

    public function edit($id){
        $roles = Role::all();
        $user = User::find($id);

        if($user->id == User::first()->id)
            return redirect('dashboard/users')->with('error', trans('admin.you can\'t update this user'));

        if($user == null)
            return redirect('dashboard/users');
        
        return view('admins.users.edit')->with([
            'roles' => $roles,
            'user' => $user,
        ]);
    }

    public function Update($id, editRequest $request){
        $user = User::find($id);

        $this->usersRepository->update($user, $request);

        return redirect('dashboard/users')->with('success', 'success');
    }

    public function destroy($user_id){
        $user = User::find($user_id);

        if($user->id == User::first()->id)
            return redirect('dashboard/users')->with('error', trans('admin.you can\'t delete this user'));

        if($user == null)
            return redirect()->back()->with('error', trans('admin.faild'));
        
        $user->delete();

        return redirect()->back()->with('success', trans('admin.success'));
    }
}