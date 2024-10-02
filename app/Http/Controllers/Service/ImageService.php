<?php

namespace App\Http\Services;


class ImageService
{
    public function store($request,$image)
    {
        $image = $request->file('image');
        $image->storeAs('public/images', $image->hashName());
        return $image->hashName();
    }
}