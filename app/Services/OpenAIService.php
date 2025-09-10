<?php

namespace App\Services;

use Illuminate\Support\Facades\Config;
use OpenAI\Laravel\Facades\OpenAI;


class OpenAIService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {

    }

    public function getResponse($input, $previousResponse)
    {
        $response = OpenAI::responses()->create([
            'input' => $input,
            'model' => Config::get('assistant.text.model'),
            'instructions' => Config::get('assistant.text.instructions'),
            'tools' => [
                [
                    'type' => Config::get('assistant.text.type'),
                    'vector_store_ids' => [Config::get('assistant.text.vector_store')],
                    'max_num_results' => Config::get('assistant.text.max_num_results')
                ]
            ],
            'previous_response_id' => $previousResponse,
        ]);
        return $response;
    }

    public function getAudioSpeech($text)
    {
        $response = OpenAI::audio()->speech([
            'input' => $text,
            'model' => Config::get('assistant.audio.model'),
            'voice' => Config::get('assistant.audio.name'),
            'instructions'=> Config::get('assistant.audio.instructions'),
            'response_format' => Config::get('assistant.audio.format'),
        ]);
        return $response;
    }
}
