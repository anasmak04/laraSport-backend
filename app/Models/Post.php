<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Post extends Model  implements HasMedia
{
    use HasFactory,InteractsWithMedia;


    protected $fillable = ['title', 'content', 'publish_date', 'category_id', 'user_id'];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function tags()
    {
        return $this->belongsToMany(Tags::class);
    }


}
