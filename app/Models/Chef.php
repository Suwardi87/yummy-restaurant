<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Chef extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'name',
        'photo',
        'position',
        'description',
        'instagram_link',
        'linkedin_link'
    ];

    public static function booted(){

        static::creating(function ($chef) {
            $chef->uuid = (string) Str::uuid();
        });
    }

}
