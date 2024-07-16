<?php

namespace App\Services\AI;

use App\Services\AI\Contracts\AIServiceContract;
use Illuminate\Http\UploadedFile;

class TestService implements AIServiceContract
{

    public function presets()
    {
        $builder = fn($code, $name, $image) => [
            'code' => $code,
            'name' => $name,
            'image' => $image,
        ];
        return [
            $builder('happy-party', 'Happy Party', 'https://media.discordapp.net/attachments/1259404272374775871/1262730281937404004/ai_dog_image.png?ex=6697a8b7&is=66965737&hm=2ec50f4950e8338edbf39cdc1918d757cbe1066177c46184e442faf4f419eab4&=&format=webp&quality=lossless'),
            $builder('preset2', 'Preset 2', 'https://github.com/shadcn.png'),
            $builder('preset3', 'Preset 3', 'https://github.com/shadcn.png'),
        ];
    }

    public function generate(UploadedFile $image, string $preset)
    {
        $builder = fn($url) => [
            'url' => 'https://media.discordapp.net/attachments/1259404272374775871/1262730281937404004/ai_dog_image.png?ex=6697a8b7&is=66965737&hm=2ec50f4950e8338edbf39cdc1918d757cbe1066177c46184e442faf4f419eab4&=&format=webp&quality=lossless',
            'size' => '1024',
            'width' => '512',
            'height' => '512',
        ];
        return [
            $builder('happy-party'),
            $builder('preset2'),
            $builder('preset3'),
        ];
    }
}
