<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClubTag extends Model
{
    use HasFactory;

    protected $fillable = ["name"];

    public function clubs()
    {
        return $this->belongsToMany(Club::class);
    }

    public function events()
    {
        return $this->belongsToMany(Event::class, 'club_tag_event', 'club_tag_id', 'event_id');
    }




}
