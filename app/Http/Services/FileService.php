<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Storage;

class FileService
{

    public function upload($file,$path){
        $uploaded = $file;
        $fileName = $uploaded->hashName();
        return $uploaded->storeAs($path, $fileName, 'public');
    }

    public function delete($path){
        $deleted = unlink(storage_path('app/public/'.$path));
        return $deleted;
    }
}
