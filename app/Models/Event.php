<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Event extends Model implements  HasMedia
{
    use HasFactory , InteractsWithMedia;


    protected $fillable = ["title", "description", "content", "event_date", "sport_type_id" , "city_id", "user_id"];

    public function sporttype()
    {
        return $this->belongsTo(SportType::class, 'sport_type_id');
    }


    public function city()
    {
        return $this->belongsTo(City::class);
    }



    public function clubTags()
    {
        return $this->belongsToMany(ClubTag::class);
    }



    public function user()
    {
        return $this->belongsTo(User::class);
    }



}
