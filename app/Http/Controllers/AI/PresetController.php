<?php

namespace App\Http\Controllers\AI;

use App\Http\Controllers\Controller;
use App\Http\Requests\AI\PresetGenerateRequest;
use App\Services\AI\AIService;

class PresetController extends Controller
{

    public function __construct(private AIService $service)
    {
    }

    public function generate(PresetGenerateRequest $request)
    {
        $validated = $request->validated();
        return $this->runTransaction(function () use ($validated) {
            $result = $this->service->generate($validated['image'], $validated['preset']);
            return response()->json($result);
        });
    }
}
