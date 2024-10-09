<?php

namespace App\Http\Services;

use App\Models\Chef;
use Illuminate\Support\Str;

class ChefService
{
    public function select(){
        return Chef::latest()->paginate(3);
    }

    public function getByid(string $id)
    {
       return Chef::where('uuid', $id)->firstOrFail();

    }
    public function create($data){
        return Chef::Create($data);

    }
    public function update($data, string $id){
        return Chef::where('uuid', $id)->update($data);
    }
}
