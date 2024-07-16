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
            $builder('preset2', 'Preset 2', 'https://media.discordapp.net/attachments/1259404272374775871/1262733679348809738/image.png?ex=6697abe1&is=66965a61&hm=016bcd0ef9d61bc56964dd44a77531d009917a2ee632b9d95f10f01b03481bd6&=&format=webp&quality=lossless'),
        ];
    }

    public function generate(UploadedFile $image, string $preset)
    {
        $builder = fn($url) => [
            'url' => $url,
            'size' => '1024',
            'width' => '512',
            'height' => '512',
        ];

        $result = [
            $builder('https://media.discordapp.net/attachments/1259404272374775871/1262730281937404004/ai_dog_image.png?ex=6697a8b7&is=66965737&hm=2ec50f4950e8338edbf39cdc1918d757cbe1066177c46184e442faf4f419eab4&=&format=webp&quality=lossless'),
            $builder('https://media.discordapp.net/attachments/1259404272374775871/1262732936394965043/image.png?ex=6697ab30&is=669659b0&hm=274ec75be12750943ce34ddabe3594264396aa73c308f67e2e2c01be752dbbf5&=&format=webp&quality=lossless'),
            $builder('https://media.discordapp.net/attachments/1259404272374775871/1262732980275777647/image.png?ex=6697ab3a&is=669659ba&hm=506631aa10436701fe1a2b9a16087b1cb5972b1935cc670163354ad2dff7b5e0&=&format=webp&quality=lossless'),
            $builder('https://media.discordapp.net/attachments/1259404272374775871/1262733018066583592/image.png?ex=6697ab43&is=669659c3&hm=c64845d22e4a4d786a4b62b49923074597704e8b92d78c53be84bf5cfbae0855&=&format=webp&quality=lossless&width=354&height=350'),
        ];

        if ($preset == 'preset2') {
            $result = [
                $builder('https://media.discordapp.net/attachments/1259404272374775871/1262733679348809738/image.png?ex=6697abe1&is=66965a61&hm=016bcd0ef9d61bc56964dd44a77531d009917a2ee632b9d95f10f01b03481bd6&=&format=webp&quality=lossless'),
                $builder('https://media.discordapp.net/attachments/1259404272374775871/1262733679768244234/image.png?ex=6697abe1&is=66965a61&hm=f952f80ffad6cdacc8224454dfc291216f61f1d1b140a9c4f4512167042fcf65&=&format=webp&quality=lossless'),
                $builder('https://media.discordapp.net/attachments/1259404272374775871/1262733680279945256/image.png?ex=6697abe1&is=66965a61&hm=2603b77f56d760f872a1de4050fb6a85ba06ae88021ff911e170308f91cedb13&=&format=webp&quality=lossless'),
                $builder('https://media.discordapp.net/attachments/1259404272374775871/1262733680774877246/image.png?ex=6697abe1&is=66965a61&hm=1bebedb5b56df4fd9c54bdff48eecdaa9c82b889e0dde0b27c1e70656f40ed6a&=&format=webp&quality=lossless'),
            ];
        }
        return $result;
    }
}
