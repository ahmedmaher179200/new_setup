<?php

namespace App\Repositories\dashboard;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class usersRepository
{
    public function insert($request){
        $user = User::create([
            'username'      => $request->username,
            'name'          => $request->name,
            'password'      => Hash::make($request->password),
        ]);

        $user->roles()->attach([$request->role_id]);
    }

    public function update($user, $request){
        if($request->password == NULL){
            $password = $user->password;
        } else{
            $password = Hash::make($request->password);
        }

        $user->username       = $request->username;
        $user->name           = $request->name;
        $user->password       = $password;
        $user->save();

        $user->roles()->detach([$user->getRoleId()]);
        $user->roles()->attach([$request->role_id]);
    }
}