<?php

namespace App\Traits;

use Exception;
use Intervention\Image\ImageManagerStatic as Image;

trait Upload
{
    public static function uploadImage($image, $path, $with = NULL){
        try {
            //Change Name
            $imageName = rand(0,1000000) . time() . '.' . $image->getClientOriginalExtension();

            //upload full size
            if(!$with)
                $image->move(public_path($path), $imageName);

            //upload with new size
            if($with){
                $image_resize = Image::make($image->getRealPath());

                //get new size
                $new_with = $image_resize->width();
                $new_height = $image_resize->height();

                if($with < $image_resize->width()){
                    $original_with_origin = ($with / $image_resize->width()) * 100;
                    $new_height = ($image_resize->height() / 100) * $original_with_origin;
                    $new_with = $with;
                }
                
                
                $image_resize->resize($new_with, $new_height)
                            ->save(public_path($path . '/' . $imageName));
            }

            return $imageName;
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }


    public function uploadFile($file, $path){
        $name = rand(0,1000000) . time() . '.' . $file->getClientOriginalExtension();

        // $file->move(base_path( $path . '/'), $name);
        $file->move(base_path('public/' . $path . '/'), $name);

        return $name;
    }
}