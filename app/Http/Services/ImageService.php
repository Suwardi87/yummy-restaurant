<?php

namespace App\Http\Services;

use Illuminate\Support\Str;
use App\Models\Galerry\Image;

class ImageService
{
    public function select(){
        return Image::latest()->paginate(1);
    }

    public function getByid(string $id)
    {
       return Image::where('uuid', $id)->firstOrFail();

    }
    public function create($data){
        $data['slug'] = Str::slug($data['name']);
        return Image::Create($data);

    }
    public function update($data, string $id){
        $data['slug'] = Str::slug($data['name']);
        return Image::where('uuid', $id)->update($data);
    }
}
