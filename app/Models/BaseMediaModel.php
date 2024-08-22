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
        $thumbnail = function (Media $media = null) {
            $this->addMediaConversion('thumbnail')
                 ->format('webp')
                 ->width(250)
                 ->height(250);
        };

        $this->addMediaCollection('card')
             ->singleFile()
             ->registerMediaConversions($thumbnail);
        $this->addMediaCollection('card-upload')
             ->singleFile()
             ->registerMediaConversions($thumbnail);
        $this->addMediaCollection('card-ai')
             ->singleFile()
             ->registerMediaConversions($thumbnail);
    }

    public function getMediaUrl(string $collection, string $conversion = null): string
    {
        return $this->getFirstMedia($collection)?->getUrl($conversion);
    }
}
