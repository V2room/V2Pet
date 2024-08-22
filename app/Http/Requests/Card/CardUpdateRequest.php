<?php

namespace App\Http\Requests\Card;

use LaravelSupports\Http\Requests\BaseFormRequest;

class CardUpdateRequest extends BaseFormRequest
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