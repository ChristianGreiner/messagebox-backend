<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\Device;
use Laravel\Sanctum\PersonalAccessToken;

class ApiController extends Controller
{
    public function getMessages(Request $request)
    {
        $token = $request->bearerToken();
        $token = PersonalAccessToken::findToken($token);
        $user = $token->tokenable()->first();
        $settings = ['mute' => $user->mute];
        $response = [
            'message' => json_decode('{}'), // empty json dict
            'settings' => json_decode('{}')
        ];

        if(!is_null($user)) {
            $selects = ['id', 'read', 'text', 'author_id', 'text_color', 'background_color'];
            $message = $user->messages()->where('read', false)->with('author:id,name')->orderBy('created_at', 'ASC')->select($selects)->first();
            $response['settings'] = $user->settings();

            if((!is_null($message)) && !($user->mute)) {
                $response['message'] = $message->makeHidden('author_id');
            }
        }
        
        return response()->json($response);
    }

    public function readMessage(Request $request, $id)
    {
        $message = Message::findOrFail($id);
        if(!is_null($message)) {
            $message->read = true;
            $message->save();

            return response()->json(['message' => 'Message read']);
        }
        return response()->json(['error' => 'Message not found'], 404);
    }

    public function register(Request $request)
    {
        $deviceId = $request->get('device');

        $device = Device::where('hardware_id', $deviceId)->first();
        
        if(!is_null($device)) {

            if (!$device->registered) {
                $user = $device->owner()->first();
           
                if(!is_null($user)) {
                    $token = $user->createToken($deviceId);
    
                    $device->registered = true;
                    $device->save();
    
                    return response()->json(['message' => 'Device registered', 'token' => $token->plainTextToken]);
                }
    
                return response()->json(['error' => 'User not found'], 404);
            }
        }
       
        return response()->json(['error' => 'Device not found'], 404);
    }
}
