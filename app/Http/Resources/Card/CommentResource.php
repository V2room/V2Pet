<?php

namespace App\Http\Resources\Card;

use App\Http\Resources\User\UserResource;
use Illuminate\Http\Request;
use LaravelSupports\Resources\BaseIdResources;

class CommentResource extends BaseIdResources
{
    protected array $field = ['user_id', 'card_id', 'message'];

    protected function additionalFields(Request $request): array
    {
        return [
            'card' => new CardResource($this->card),
            'user' => new UserResource($this->user),
        ];
    }


}
