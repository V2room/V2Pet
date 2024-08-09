<?php

namespace Tests\Feature;

use Exception;
use GuzzleHttp\Client;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Spatie\Image\Image;
use Tests\TestCase;

class ImageTest extends TestCase
{
    use RefreshDatabase;

    public function test_download_image()
    {
        // 원본 이미지 경로
        $originalImagePath = 'https://cdn.discordapp.com/attachments/1259404272374775871/1259418571918803044/cs.v2_have_a_teeth_like_a_tiger_668a4ac91a1c3_48227c8e-d089-492e-a785-4287cb2073b0.png?ex=668b9c72&is=668a4af2&hm=60c4b2918f4d8fab34614f3a329719e753cfe4cb59749c9190ea47c96f2fe3d4&';
        $image = $this->downloadAndSaveImage($originalImagePath);
    }

    public function downloadAndSaveImage($imageUrl)
    {
        // GuzzleHttp 클라이언트 생성
        $client = new Client();

        try {
            // 이미지 다운로드 요청 보내기
            $response = $client->request('GET', $imageUrl);

            // 이미지 다운로드 성공 여부 확인
            if ($response->getStatusCode() == 200) {
                // 이미지 데이터 가져오기
                $imageData = $response->getBody()->getContents();

                // 이미지 저장할 경로 (storage/app/public 에 저장됩니다.)
                $storagePath = 'public/images/';

                // 저장할 파일 이름
                $filename = 'image_' . time() . '.jpg';

                // Laravel Storage를 이용하여 이미지 저장
                Storage::put($storagePath . $filename, $imageData);

                // 저장된 파일의 public 경로 가져오기
                $publicPath = Storage::url($storagePath . $filename);

                // 저장된 이미지의 public 경로 반환 (옵션)
                return $publicPath;
            } else {
                // 다운로드 실패 처리
                return 'Failed to download image';
            }
        } catch (Exception $e) {
            // 예외 발생 시 처리
            return $e->getMessage();
        }
    }

    public function test_image_crop(): void
    {

        $originalImagePath = 'images/image_1720342086.jpg';

        $originalImagePath = Storage::disk('public')->path($originalImagePath);
        dump($originalImagePath);

        // 이미지의 너비와 높이 가져오기
        $width = 2912;
        $height = 1632;
        $path = '/var/www/html/storage/app/public/images/';

        // 이미지 로드
        Image::load($originalImagePath)
             ->manualCrop($width / 2, $height / 2, 0, 0)
             ->save($path . '1.jpg');

        Image::load($originalImagePath)
             ->manualCrop($width / 2, $height / 2, $width / 2, 0)
             ->save($path . '2.jpg');

        Image::load($originalImagePath)
             ->manualCrop($width / 2, $height / 2, 0, $height / 2)
             ->save($path . '3.jpg');

        Image::load($originalImagePath)
             ->manualCrop($width / 2, $height / 2, $width / 2, $height / 2)
             ->save($path . '4.jpg');

        return;

        // 이미지를 4개로 잘라내기
        $pieces = [];

        // 첫 번째 조각 (왼쪽 상단)
        $pieces[] = $img->crop($width / 2, $height / 2, 0, 0);

        // 두 번째 조각 (오른쪽 상단)
        $pieces[] = $img->crop($width / 2, $height / 2, $width / 2, 0);

        // 세 번째 조각 (왼쪽 하단)
        $pieces[] = $img->crop($width / 2, $height / 2, 0, $height / 2);

        // 네 번째 조각 (오른쪽 하단)
        $pieces[] = $img->crop($width / 2, $height / 2, $width / 2, $height / 2);

        // 각각의 조각을 저장하거나 다루고 싶은 작업을 수행할 수 있습니다.
        foreach ($pieces as $index => $piece) {
            // 조각을 저장하거나 출력할 수 있습니다.
            $piece->save('path/to/save/piece_' . ($index + 1) . '.jpg');
        }
    }

}
