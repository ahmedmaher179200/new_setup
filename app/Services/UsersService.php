<?php

namespace App\Services;

use App\Models\Image;
use App\Models\User;
use App\Traits\Upload;
use Illuminate\Support\Facades\Hash;

class UsersService
{
    use Upload;
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

    public function update_user_image($user,$image){
        $user->clearMediaCollection(User::profile_image);
        $user->addMedia($image)->toMediaCollection(User::profile_image);
    }
}