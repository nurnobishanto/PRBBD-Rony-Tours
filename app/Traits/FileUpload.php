<?php

namespace App\Traits;

use File;

trait FileUpload
{
    public function uploadFile($file, $path)
    {
        if($file){
            $filename = time().rand(1, 99).'.'.$file->getClientOriginalExtension();
            $upload_path = "uploads/$path";
            $file->move(public_path($upload_path), $filename);
            return $path.'/'.$filename;
        }
    }

    public function deleteFile($path=null)
    {
        if($path == null) return true;

        if(File::exists(public_path('uploads/'.$path))) {
            File::delete(public_path('uploads/'.$path));
        }
        return true;
    }
}
