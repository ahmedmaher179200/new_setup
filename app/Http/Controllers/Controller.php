<?php

namespace App\Http\Controllers;

use Exception;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function upload_image($image, $path){
        try {
            $image_name = rand(0,1000000) . time() . '.' . $image->getClientOriginalExtension();

            $image_resize = Image::make($image->getRealPath());

            $image_resize->save(public_path($path . '/' . $image_name), 10);
            
            return $image_name;
            
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }
}
