<?php

namespace App\Services\Media;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use RuntimeException;
use Spatie\Image\Image;

class MediaService
{
    public function cropImage(string $url): array
    {
        $storage = Storage::disk('public');
        $folder = Str::random(16);
        $path = "images/downloads/$folder/";
        $saveImage = $storage->path($this->saveImage($url, $path));
        $savePath = $storage->path($path);
        $image = Image::load($saveImage);
        $width = $image->getWidth();
        $height = $image->getHeight();

        // 이미지 로드

        Image::load($saveImage)
             ->manualCrop($width / 2, $height / 2, 0, 0)
             ->save($savePath . '1.jpg');
        Image::load($saveImage)
             ->manualCrop($width / 2, $height / 2, $width / 2, 0)
             ->save($savePath . '2.jpg');
        Image::load($saveImage)
             ->manualCrop($width / 2, $height / 2, 0, $height / 2)
             ->save($savePath . '3.jpg');
        Image::load($saveImage)
             ->manualCrop($width / 2, $height / 2, $width / 2, $height / 2)
             ->save($savePath . '4.jpg');

        $getUrl = fn(string $image) => $storage->url($path . $image);
        
        return [
            $getUrl('1.jpg'),
            $getUrl('2.jpg'),
            $getUrl('3.jpg'),
            $getUrl('4.jpg'),
        ];
    }

    public function saveImage(string $url, string $path): string
    {
        $client = new Client();
        $response = $client->request('GET', $url);

        if ($response->getStatusCode() === 200) {
            $imageData = $response->getBody()->getContents();
            $filename = 'image_' . time() . '.jpg';
            Storage::disk('public')->put($path . $filename, $imageData);
            return $path . $filename;
        }

        throw new RuntimeException('Failed to download image');
    }
}