<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class City extends Model implements HasMedia
{

    use HasFactory , InteractsWithMedia;
    protected $fillable = ["name"];


    public function clubs()
    {
        return $this->hasMany(Club::class);
    }


    public function events()
    {
        return $this->hasMany(Event::class);
    }


}
