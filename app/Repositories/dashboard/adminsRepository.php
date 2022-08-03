<?php

namespace App\Repositories\dashboard;

use App\Models\Post;
use Illuminate\Support\Facades\Hash;

class adminsRepository
{
    public function update($admin, $request){
        if($request->password == NULL){
            $password = $admin->password;
        } else{
            $password = Hash::make($request->password);
        }

        $admin->username       = $request->username;
        $admin->password       = $password;
        $admin->save();

        $admin->roles()->detach([$admin->getRoleId()]);
        $admin->roles()->attach([$request->role_id]);
    }
}