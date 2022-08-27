<?php

namespace App\Repositories\dashboard;

use Illuminate\Support\Facades\Hash;

class usersRepository
{
    public function update($user, $request){
        if($request->password == NULL){
            $password = $user->password;
        } else{
            $password = Hash::make($request->password);
        }

        $user->username       = $request->username;
        $user->password       = $password;
        $user->save();

        $user->roles()->detach([$user->getRoleId()]);
        $user->roles()->attach([$request->role_id]);
    }
}