<?php

namespace App\Http\Requests\AI;

use LaravelSupports\Http\Requests\BaseFormRequest;

class PresetGenerateRequest extends BaseFormRequest
{

    public function rules(): array
    {
        return [
            'image' => [
                'required',
                'image',
            ],
            'preset' => [
                'required',
                'string',
            ],
        ];
    }

}
