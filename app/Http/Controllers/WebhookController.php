<?php

namespace App\Http\Controllers;

use App\Helpers\Telegram;
use App\Models\InstanceEC2;
use Aws\Ec2\Ec2Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WebhookController extends Controller
{
    public function index(Request $request, Telegram $telegram)
    {

        Log::debug($request->input('message.from.id'));
        Log::debug($request->input('message.text'));

        $action = $request->input('message')['text'];
        $chat_id = $request->input('message.from.id');

        $pattern_instance = '/i-*/';
        $pattern_access_key = '/AC:*/';
        $pattern_secret_key = '/SC:*/';

        if ($action == '/start') {
            $telegram->sendMessage($chat_id, 'Write your EC2 instance id. (i-00000000000000000)');

        } elseif (preg_match($pattern_instance, $action)) {
            Log::debug(preg_match($pattern_instance, $action));
            $instance_id = $request->input('message')['text'];

            $instance = InstanceEC2::create([
                'chat_id' => $chat_id,
                'instance_id' => $instance_id
            ]);

            $telegram->sendMessage($chat_id, 'Write your Access key (AC:00000000000000000)');

        } elseif (preg_match($pattern_access_key, $action)) {
            $access_key_text = $request->input('message')['text'];
            $needle = 'AC:';
            $access_key = strrchr($access_key_text, $needle);

            InstanceEC2::where('chat_id', $chat_id)
                ->update(['aws_access_key' => $access_key,]);

            $telegram->sendMessage($chat_id, 'Write your Secret key (SC:00000000000000000)');

        } elseif (preg_match($pattern_secret_key, $action)) {
            $secret_key_text = $request->input('message')['text'];
            $needle = 'SC:';
            $secret_key = strrchr($secret_key_text, $needle);

            InstanceEC2::where('chat_id', $chat_id)
                ->update(['aws_secret_key' => $secret_key,]);

        }

    }
}
