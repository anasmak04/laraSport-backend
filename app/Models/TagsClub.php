<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TagsClub extends Model
{
    use HasFactory;

    protected $fillable = ["name"];

    public function Events()    {
        return $this->belongsToMany(Event::class);
    }

}
