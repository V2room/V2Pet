<?php

namespace App\Services\AI;

use App\Services\AI\Contracts\AIServiceContract;
use App\Services\Media\MediaService;
use GuzzleHttp\Client;
use Illuminate\Http\UploadedFile;

class AIService implements AIServiceContract
{

    protected Client $client;

    public function __construct(protected string $apiUrl, protected MediaService $mediaService)
    {
        $this->client = new Client([
            'base_uri' => $apiUrl,
        ]);
    }

    public function presets()
    {
        $response = $this->client->get('/api/ai/presets');
        return json_decode($response->getBody()->getContents(), true)['data'];
    }

    public function generate(UploadedFile $image, string $preset): array
    {
        $response = $this->client->post('/api/ai/imagine', [
            'multipart' => [
                [
                    'name'     => 'image',
                    'contents' => fopen($image->getRealPath(), 'r'),
                    'filename' => $image->getClientOriginalName(),
                ],
                [
                    'name'     => 'preset',
                    'contents' => $preset,
                ],
            ],
        ]);

        return $this->mediaService->cropImage(json_decode($response->getBody()->getContents(), true)['data']['url']);
    }
}
