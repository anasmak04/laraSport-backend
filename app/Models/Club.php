<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Club extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = ["name", "description","city_id"];

    public function clubTags() {
        return $this->belongsToMany(ClubTag::class);
    }


    public function city()
    {
        return $this->belongsTo(City::class);
    }


}
