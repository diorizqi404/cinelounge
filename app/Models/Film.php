<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    protected $table = 'films';
    
    protected $fillable = [
        'title',
        'slug',
        'description',
        'release_year',
        'duration',
        'age_rate',
        'genre',
        'image',
        'image_bg',
        'video',
    ];

    public static function boot()
    {
        parent::boot();

        static::saving(function ($film) {
            $film->slug = Str::slug($film->title);
        });
    }

    public function favourites()
    {
        return $this->hasMany(Favourite::class);
    }
}
