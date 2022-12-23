<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\profile\edit;
use App\Models\Image;
use App\Services\ActivityLogsService;
use App\Services\UsersService;
use App\Traits\Upload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    protected $ActivityLogsService;
    protected $UsersService;

    public function __construct(UsersService $UsersService,
                                ActivityLogsService $ActivityLogsService) {

        $this->ActivityLogsService = $ActivityLogsService;
        $this->UsersService = $UsersService;
    }

    public function edit(){
        return $this->getPercentage(100,200);

        return view('admins.profile.show')->with([
            'user' => auth('user')->user(),
        ]);
    }

    public function update(edit $request){
        $user = auth('user')->user();

        $this->UsersService->update($user, $request);

        $this->ActivityLogsService->insert([
            'subject_id'      => $user->id,
            'subject_type'    => 'App\Models\User',
            'description'     => 'update',
            'causer_id'       => auth('user')->user()->id,
            'causer_type'     => 'App\Models\User',
            'properties'      => null,
        ]);

        return redirect('dashboard/profile')->with('success', trans('admin.success'));
    }

    public function update_image(Request $request){
        $user = auth('user')->user();

        if($request->hasfile('image'))
            $this->UsersService->update_user_image($user, $request->file('image'));

        return redirect('dashboard/profile')->with('success', trans('admin.success'));
    }
}
