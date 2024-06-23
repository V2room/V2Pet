<?php

namespace App\Models;

use LaravelSupports\Models\Common\BaseModel;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class BaseMediaModel extends BaseModel implements HasMedia
{
    use InteractsWithMedia;

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('card')
             ->singleFile()
             ->registerMediaConversions(function (Media $media = null) {
                 $this->addMediaConversion('thumbnail')
                      ->width(150)
                      ->height(150);
             });

    }
}