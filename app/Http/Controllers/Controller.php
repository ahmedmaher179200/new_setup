<?php

namespace App\Http\Controllers;

use App\Traits\Upload;
use Exception;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    use Upload;

    public function summernote_upload_image(Request $request){
        $path = null;
        if($request->has('file')){
            $path = $this->uploadImage($request->file('file'), 'uploads/images');
        }

        return url('public/uploads/images/' . $path);
    }
}
