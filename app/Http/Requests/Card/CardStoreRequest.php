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
                function ($attribute, $value, $fail) {
                    if (!filter_var($value, FILTER_VALIDATE_URL) && !$this->isImage($value)) {
                        $fail('The ' . $attribute . ' must be a valid URL or an image.');
                    }
                },
            ],
            'message' => [
                'required',
                'string',
            ],
        ];
    }

    /*
    * @param mixed $value
    * @return bool
    */
    protected function isImage($value): bool
    {
        // `is_file` 함수로 파일이 있는지 확인하고, `getimagesize`를 통해 유효한 이미지인지 확인
        return is_file($value) && @getimagesize($value) !== false;
    }
}