<?php

namespace App\Http\Resources\Card;

use Illuminate\Http\Request;
use LaravelSupports\Resources\BaseIdResources;

class CardResource extends BaseIdResources
{
    function fields(Request $request): array
    {
        return [
            'image'   => $this->getMediaUrl('card', 'thumbnail'),
            'user_id' => $this->user_id,
            'message' => $this->message,
        ];
    }
}
