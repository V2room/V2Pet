<?php

namespace App\Http\Resources\Card;

use Illuminate\Http\Request;

class CardWithCommentResource extends CardResource
{

    function additionalFields(Request $request): array
    {
        return [
            ...parent::additionalFields($request),
            'comments' => CommentResource::collection($this->comments),
        ];
    }


}
