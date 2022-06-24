<?php

namespace App\Http\Controllers;

use App\Helpers\Telegram;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WebhookController extends Controller
{
    public function index(Request $request, Telegram $telegram)
    {

        Log::debug($request->input('from')['id']);


//        Log::debug($request->all());
//        Log::debug($request->input('message')['text']);
//        $telegram->sendMessage(env('TELEGRAM_CHAT_ID'), 'Pong');
    }
}
