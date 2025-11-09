<?php

namespace App\Http\Controllers\Api\user\authentication;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\user\changeImageRequest;
use App\Http\Requests\Api\user\changePasswordRequest;
use App\Http\Requests\Api\user\updateRequest;
use App\Http\Resources\userResource;
use App\Models\Image;
use App\Models\User;
use App\Traits\response;
use App\Traits\Upload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class profileController extends Controller
{
    use Upload;
    public function show(){
        $user = auth('user_api')->user();

        return $this->success(
            trans('auth.success'),
            200,
            'data',
            new userResource($user)
        );
    }

    public function update(updateRequest $request){
        $user = auth('user_api')->user();

        $filterRequest = $request->only(
            'username','name'
        );

        $user->update($filterRequest);

        return $this->success(trans('auth.success'),
                                200,
                                'data',
                                new userResource($user)
                            );
    }

    public function changePassword(changePasswordRequest $request){
        $user = auth('user_api')->user();

        //update user pass
        if(Hash::check($request->old_password, $user->password)){
            $user->password  = Hash::make($request->password);
            $user->save();
        } else {
            return $this->failed(trans('api.old password is wrong'), 400);
        }

        return $this->success(trans('auth.success'), 200);
    }

    public function changeImage(changeImageRequest $request){
        $user = auth('user_api')->user();

        $user->clearMediaCollection(User::profile_image);
        $user->addMedia($request->file('image'))->toMediaCollection(User::profile_image);

        return $this->success(trans('auth.success'), 200);
    }
}
