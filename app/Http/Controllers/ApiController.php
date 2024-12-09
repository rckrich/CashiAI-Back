<?php

namespace App\Http\Controllers;

use App\Models\AiDefaultMessage;
use App\Models\AiUser;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    /**
     * Register user data
     *
     * @return \Illuminate\Http\Client\Response
     */
    public function saveUser(Request $request)
    {
        $validator = $this->isValidUserData($request);
        if($validator -> fails()){
            return response()->json(['message' => $validator->errors()], 422);
        }

        $aiUser = new AiUser();
        $aiUser->name = $request->name;
        $aiUser->email = $request->email;
        $aiUser->age = $request->age;
        $aiUser->save();
        $aiUser->refresh();

        return Response([
            'id' => $aiUser->id,
        ], 200);
    }

    /**
     * Register conversation
     *
     * @return \Illuminate\Http\Client\Response
     */
    public function saveConversation(Request $request)
    {
        $aiUser = AiUser::find($request->id);
        $aiUser->interaction_date = Carbon::now();
        $aiUser->save();

        return Response([
        ], 204);
    }

    /**
     * Get default messages
     *
     * @return \Illuminate\Http\Client\Response
     */
    public function getDefaultMessages(Request $request)
    {
        $aiMessages = AiDefaultMessage::get();

        return Response([
            'defaultMessages' => $aiMessages,
        ], 200);
    }

    private function isValidUserData($request){
        $rules = [
            'name' => ['required', 'string'],
            'email' => ['required', 'string', 'email'],
            'age' => ['required', 'integer'],
        ];

        $validator = Validator::make($request->all(), $rules);

        return $validator;
    }
}
