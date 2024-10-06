<?php

namespace App\Http\Services;

use App\Models\Menu;
use Illuminate\Support\Str;

class MenuService
{
    public function select($paginate = null)
    {
        if ($paginate) {
            return Menu::with('category:id,title')->latest()->select('id', 'uuid', 'name', 'category_id', 'price', 'status', 'photo')->paginate($paginate);
        }

        return Menu::latest()->get();
    }

    public function selectFirstBy($column, $value)
    {
        return Menu::with('category:id,title')->where($column, $value)->firstOrFail();
    }
    public function getByid(string $id)
    {
       return Menu::where('uuid', $id)->firstOrFail();

    }
    public function create($data){
        $data['slug'] = Str::slug($data['name']);
        return Menu::Create($data);

    }
    public function update($data, string $id){
        $data['slug'] = Str::slug($data['name']);
        return Menu::where('uuid', $id)->update($data);
    }
}
