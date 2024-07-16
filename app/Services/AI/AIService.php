<?php

namespace App\Services\AI;

use App\Services\AI\Contracts\AIServiceContract;
use GuzzleHttp\Client;
use Illuminate\Http\UploadedFile;

class AIService implements AIServiceContract
{

    protected Client $client;

    public function __construct(protected string $apiUrl)
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

    public function generate(UploadedFile $image, string $preset)
    {
        $response = $this->client->post('/api/ai/imagine', [
            'multipart' => [
                [
                    'name' => 'image',
                    'contents' => fopen($image->getRealPath(), 'r'),
                    'filename' => $image->getClientOriginalName(),
                ],
                [
                    'name' => 'preset',
                    'contents' => $preset,
                ],
            ],
        ]);
        return json_decode($response->getBody()->getContents(), true);
    }
}
