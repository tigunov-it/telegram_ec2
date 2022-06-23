<?php

namespace App\Http\Controllers;

use App\Helpers\Telegram;
use Aws\Ec2\Ec2Client;
use Illuminate\Http\Request;

class AwsController extends Controller
{
    public function startInstance(Request $request, Telegram $telegram){

        $ec2Client = new Ec2Client([
            'region' => env('AWS_DEFAULT_REGION'),
            'version' => 'latest'
        ]);

        $action = $request->input('message')['text'];

//        $instanceIds = array('InstanceID1', 'InstanceID2');
        $instanceIds = array(env('AWS_EC2_INSTANCES'));

        if ($action == 'start') {
            $result = $ec2Client->startInstances(array(
                'InstanceIds' => $instanceIds,
            ));
            $telegram->sendMessage(env('TELEGRAM_CHAT_ID'), 'Instance starting');
        } else {
            $result = $ec2Client->stopInstances(array(
                'InstanceIds' => $instanceIds,
            ));
            $telegram->sendMessage(env('TELEGRAM_CHAT_ID'), 'Instance stopping');
        }

    }
}
