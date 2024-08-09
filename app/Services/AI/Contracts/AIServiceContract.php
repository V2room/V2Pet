<?php

namespace App\Services\AI\Contracts;

use Illuminate\Http\UploadedFile;

interface AIServiceContract
{

    public function presets();

    public function generate(UploadedFile $image, string $preset);
}
