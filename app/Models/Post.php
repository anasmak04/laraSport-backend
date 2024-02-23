<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

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


//    public function getAvatarAttribute()
//    {
//        $avatarMedia = $this->getFirstMedia('image');
//        if ($avatarMedia) {
//            $avatar = $avatarMedia->toArray();
//            $avatar['url'] = $avatarMedia->getUrl();
//            $avatar['thumbnail'] = $avatarMedia->getUrl('thumbnail');
//            $avatar['preview_thumbnail'] = $avatarMedia->getUrl('preview_thumbnail');
//            return $avatar;
//        }
//        return $avatarMedia;
//
//    }
//
//    public function registerMediaConversions(Media $media = null): void
//    {
//        $thumbnailWidth = 50;
//        $thumbnailHeight = 50;
//
//        $thumbnailPreviewWidth = 120;
//        $thumbnailPreviewHeight = 120;
//
//        $this->addMediaConversion('thumbnail')
//            ->width($thumbnailWidth)
//            ->height($thumbnailHeight)
//            ->fit('crop', $thumbnailWidth, $thumbnailHeight);
//        $this->addMediaConversion('preview_thumbnail')
//            ->width($thumbnailPreviewWidth)
//            ->height($thumbnailPreviewHeight)
//            ->fit('crop', $thumbnailPreviewWidth, $thumbnailPreviewHeight);
//    }


}
