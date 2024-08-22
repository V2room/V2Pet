<?php

namespace App\Http\Resources\Card;

use App\Http\Resources\User\UserResource;
use Illuminate\Http\Request;
use LaravelSupports\Resources\BaseIdResources;

class CardResource extends BaseIdResources
{
    protected array $field = ['user_id', 'message'];

    function additionalFields(Request $request): array
    {
        return [
            'image' => $this->getMediaUrl('card', 'thumbnail'),
            'user'  => new UserResource($this->user),
        ];
    }


}
