<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class HuggingFaceService
{
    protected string $token;
    protected string $model;
    protected int $timeout;

    public function __construct()
    {
        $this->token   = config('services.huggingface.token');
        $this->model   = config('services.huggingface.model');
        $this->timeout = config('services.huggingface.timeout');
    }

    /**
     * Generate AI text from a prompt.
     *
     * @return string|null  null ila fchel
     */
    public function generateText(string $prompt): ?string
    {
        $response = Http::withToken($this->token)
            ->timeout($this->timeout)
            ->retry(2, 500)
            ->post('https://router.huggingface.co/v1/chat/completions', [
                'model' => $this->model,
                'messages' => [
                    ['role' => 'user', 'content' => $prompt],
                ],
                'max_tokens'  => 200,
                'temperature' => 0.7,
            ]);

        if ($response->failed()) {
            Log::error('HuggingFace API failed', [
                'status' => $response->status(),
                'body'   => $response->body(),
            ]);
            return null;
        }

        return $response->json('choices.0.message.content');
    }
}