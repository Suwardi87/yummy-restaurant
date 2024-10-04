<?php

namespace App\Models\Galerry;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'name',
        'slug',
        'description',
        'file'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->uuid = Str::uuid();
        });
    }

}

