<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{

    protected $fillable = ["name"];
    use HasFactory;


    public function clubs()
    {
        return $this->hasMany(Club::class);
    }
}
