<?php

namespace App\Http\Requests\Card;

use LaravelSupports\Http\Requests\BaseFormRequest;

class CardStoreRequest extends BaseFormRequest
{

    public function rules(): array
    {
        return [
            'image'   => [
                'required',
                'image',
            ],
            'message' => [
                'required',
                'string',
            ],
        ];
    }

}