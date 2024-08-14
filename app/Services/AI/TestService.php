<?php

namespace App\Services\AI;

use App\Services\AI\Contracts\AIServiceContract;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

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
            $builder('happy-party', 'Happy Party', $this->getImageUrl('image1-1.png')),
            $builder('preset2', 'Preset 2', $this->getImageUrl('image2-1.png')),
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
            $builder($this->getImageUrl('image1-1.png')),
            $builder($this->getImageUrl('image1-2.png')),
            $builder($this->getImageUrl('image1-3.png')),
            $builder($this->getImageUrl('image1-4.png')),
        ];

        if ($preset == 'preset2') {
            $result = [
                $builder($this->getImageUrl('image2-1.png')),
                $builder($this->getImageUrl('image2-2.png')),
                $builder($this->getImageUrl('image2-3.png')),
                $builder($this->getImageUrl('image2-4.png')),
            ];
        }
        return $result;
    }

    private function getImageUrl($image): string
    {
        return Storage::disk('local')->url('/ai/' . $image);
    }
}
