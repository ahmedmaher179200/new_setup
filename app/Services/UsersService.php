<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersService
{
    public function insert($request){
        $user = User::create([
            'username'      => $request->username,
            'name'          => $request->name,
            'password'      => Hash::make($request->password),
        ]);

        $user->roles()->attach([$request->role_id]);

        return $user;
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

        if($request->role_id){
            $user->roles()->detach([$user->getRoleId()]);
            $user->roles()->attach([$request->role_id]);
        }
    }
}