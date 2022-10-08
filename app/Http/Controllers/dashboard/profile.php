<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\profile\edit;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class profile extends Controller
{
    public function edit(){
        return view('admins.profile.show')->with([
            'user' => auth('user')->user(),
        ]);
    }

    public function update(edit $request){
        $user = auth('user')->user();

        if($request->password == NULL){
            $password = $user->password;
        } else{
            $password = Hash::make($request->password);
        }

        $user->username  = $request->username;
        $user->name      = $request->name;
        $user->password  = $password;
        $user->save();

        return redirect('dashboard/profile')->with('success', trans('admin.success'));
    }

    public function update_image(Request $request){
        $user = auth('user')->user();

        if($request->hasfile('image')){
            $path = $this->upload_image($request->file('image'), 'uploads/users');

            if($user->Image == null){
                //if user don't have image 
                Image::create([
                    'imageable_id'   => $user->id,
                    'imageable_type' => 'App\Models\User',
                    'src'            => $path,
                ]);

            } else {
                $oldImage = $user->Image->src;

                if(file_exists(base_path('public/uploads/users/') . $oldImage)){
                    unlink(base_path('public/uploads/users/') . $oldImage);
                }

                $user->Image->src = $path;
                $user->Image->save();
            }
        }

        return redirect('dashboard/profile')->with('success', trans('admin.success'));
    }
}
