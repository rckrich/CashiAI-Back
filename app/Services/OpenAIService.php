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
            'model' => Config::get('assistant.model'),
            'instructions' => Config::get('assistant.instructions'),
            'tools' => [
                [
                    'type' => Config::get('assistant.type'),
                    'vector_store_ids' => [Config::get('assistant.vector_store')],
                    'max_num_results' => Config::get('assistant.max_num_results')
                ]
            ],
            'previous_response_id' => $previousResponse,
        ]);
        return $response;
    }
}
