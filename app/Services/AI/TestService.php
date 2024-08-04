<?php

namespace App\Services\AI;

use App\Services\AI\Contracts\AIServiceContract;
use Illuminate\Http\UploadedFile;

class TestService implements AIServiceContract
{

    public function presets()
    {
        $builder = fn($code, $name, $image) => [
            'code'  => $code,
            'name'  => $name,
            'image' => $image,
        ];
        return [
            $builder('happy-party', 'Happy Party', 'https://cdn.discordapp.com/attachments/1259404272374775871/1262732980275777647/image.png?ex=66b00efa&is=66aebd7a&hm=a3592d5729374923aebc0cfcd8c553e6a8b18a529271a7f4f0370e72a89d5592&'),
            $builder('preset2', 'Preset 2', 'https://cdn.discordapp.com/attachments/1259404272374775871/1262733679768244234/image.png?ex=66b00fa1&is=66aebe21&hm=cefa0608e7136eb45ce878a966a7446a37c2962c3e2efce7fee0e803ffee55ce&'),
        ];
    }

    public function generate(UploadedFile $image, string $preset)
    {
        $builder = fn($url) => [
            'url'    => $url,
            'size'   => '1024',
            'width'  => '512',
            'height' => '512',
        ];

        $result = [
            $builder('https://cdn.discordapp.com/attachments/1259404272374775871/1262730281937404004/ai_dog_image.png?ex=66b00c77&is=66aebaf7&hm=f18d0b587fb31f39064be2c67fbe654b1f6ed08f22c066298792c3993c73605a&'),
            $builder('https://cdn.discordapp.com/attachments/1259404272374775871/1262732936394965043/image.png?ex=66b00ef0&is=66aebd70&hm=b6980de7125b27b79ac97f876bb0356ca60521c2a8ece309475128a6ba5e4a7e&'),
            $builder('https://cdn.discordapp.com/attachments/1259404272374775871/1262732980275777647/image.png?ex=66b00efa&is=66aebd7a&hm=a3592d5729374923aebc0cfcd8c553e6a8b18a529271a7f4f0370e72a89d5592&'),
            $builder('https://cdn.discordapp.com/attachments/1259404272374775871/1262733018066583592/image.png?ex=66b00f03&is=66aebd83&hm=e41ff57dce71119027ecbf8794dd059ac76ca85469318759367d33c351139f72&'),
        ];

        if ($preset == 'preset2') {
            $result = [
                $builder('https://cdn.discordapp.com/attachments/1259404272374775871/1262733679768244234/image.png?ex=66b00fa1&is=66aebe21&hm=cefa0608e7136eb45ce878a966a7446a37c2962c3e2efce7fee0e803ffee55ce&'),
                $builder('https://cdn.discordapp.com/attachments/1259404272374775871/1262733679348809738/image.png?ex=66b00fa1&is=66aebe21&hm=8f3d8d3bd6245aa76da8fd9dad88225b0b03955a9dc2a2be2561b8c448730be9&'),
                $builder('https://cdn.discordapp.com/attachments/1259404272374775871/1262733680279945256/image.png?ex=66b00fa1&is=66aebe21&hm=896b5a3621dd5ff231ae95902a6508634fcd7ab92e90feca52a8adfbd774dbd8&'),
                $builder('https://cdn.discordapp.com/attachments/1259404272374775871/1262733680774877246/image.png?ex=66b00fa1&is=66aebe21&hm=100885f853957cf937c5ba47dc8303b1ccc05f684b3f85f93b39b7d52aeddb09&'),
            ];
        }
        return $result;
    }
}
