<?php

namespace App\Http\Resources\Card;

use Illuminate\Http\Request;
use LaravelSupports\Resources\BaseIdResources;

class CardResource extends BaseIdResources
{
    function fields(Request $request): array
    {
        return [
            'image'   => $this->getFirstMedia('card')->getUrl('thumbnail'),
            'message' => $this->message,
        ];
    }
}
