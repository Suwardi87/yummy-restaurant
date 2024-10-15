<?php

namespace App\Http\Services;

use App\Models\Category;

class CategoryService
{
    public function option($coloumn = null, $value = null){
        if($coloumn){
            return Category::where($coloumn, $value)->select('id','uuid','title','slug')->firstOrFail();
        }
        return Category::latest()->get(['id','uuid','title','slug']);
    }
}