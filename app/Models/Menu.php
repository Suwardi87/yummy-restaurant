<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid', 'user_id', 'category_id', 'name', 'slug', 'description', 'price', 'photo', 'status'
    ];

    public static function booted(){
        static::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
            $model->user_id = Auth::user()->id;
        });
    }


    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
