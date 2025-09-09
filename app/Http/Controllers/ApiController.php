<?php

namespace App\Http\Controllers;

use App\Models\AiDefaultMessage;
use App\Models\Analytic;
use App\Models\FirstInteraction;
use App\Services\OpenAIService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    /**
     * Register conversation
     */

    protected $openAIService;

    public function __construct(OpenAIService $openAIService)
    {
        $this->openAIService = $openAIService;
    }

    public function saveFirstInteraction(Request $request)
    {
        $firstInteraction = new FirstInteraction();
        $firstInteraction->interaction_date = Carbon::now();
        $firstInteraction->save();

        $analytics = Analytic::find(1);
        $analytics->first_interactions += 1;
        $analytics->save();

        return Response([
        ], 204);
    }

    /**
     * Register conversation
     */
    public function addMessage(Request $request)
    {
        $analytics = Analytic::find(1);
        $analytics->messages += 1;
        $analytics->save();

        return Response([
        ], 204);
    }

    /**
     * Get default messages
     */
    public function getDefaultMessages(Request $request)
    {
        $aiMessages = AiDefaultMessage::get();

        return Response([
            'defaultMessages' => $aiMessages,
        ], 200);
    }

    /**
     * Get video bundle by type
     */
    public function getVideoBundle($type)
    {
        $bundle = Config::get('videobundle.'.$type);
        $bundle['url_movil'] = asset($bundle['url_movil']);
        $bundle['url_desktop'] = asset($bundle['url_desktop']);

        return Response([
            'videobundle' => $bundle,
        ], 200);
    }

    public function getResponse(Request $request)
    {
        $response = $this->openAIService->getResponse($request->input, $request->active_thread);

        return Response([
            'response' => $response,
        ], 200);
    }
}
