<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Club extends Model
{
    use HasFactory;

    protected $fillable = ["name", "description", "club_tag_id","city_id"];

    public function clubstags(){
        return $this->belongsToMany(ClubTag::class);
    }


    public function city()
    {
        return $this->belongsTo(City::class);
    }


}
