<?php

namespace App\Http\Requests\Card;

use LaravelSupports\Http\Requests\BaseFormRequest;

class CardCommentUpdateRequest extends BaseFormRequest
{

    public function rules(): array
    {
        return [
            'message' => [
                'required',
                'string',
            ],
        ];
    }

}