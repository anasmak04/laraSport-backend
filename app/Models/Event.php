<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;


    protected $fillable = ["title", "description", "content", "event_date", "sport_type_id"];

    public function sporttype()
    {
        return $this->belongsTo(SportType::class);
    }

}
