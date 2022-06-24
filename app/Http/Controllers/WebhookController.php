<?php

namespace App\Http\Controllers;

use App\Helpers\Telegram;
use App\Models\InstanceEC2;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WebhookController extends Controller
{
    public function index(Request $request, Telegram $telegram)
    {

        Log::debug($request->input('message.from.id'));
        Log::debug($request->input('message.text'));

        $chat_id = $request->input('message.from.id');
        $secret_key = $request->input('message.text');

        $instance = InstanceEC2::create([
            'instance_id' => $secret_key,
            'aws_access_key' => $secret_key,
            'aws_secret_key' => $chat_id
        ]);


//        Log::debug($request->all());
//        Log::debug($request->input('message')['text']);
//        $telegram->sendMessage(env('TELEGRAM_CHAT_ID'), 'Pong');
    }
}
