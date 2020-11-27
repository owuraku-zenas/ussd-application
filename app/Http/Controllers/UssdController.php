<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Sparors\Ussd\Facades\Ussd;
use App\Http\Ussd\States\Welcome;

class UssdController extends Controller
{
    //
    public function index() {
        $ussd = Ussd::machine()
        ->setFromRequest([
            'phone_number' => 'msisdn',
            'input' => 'msg',
            'network',
            'session_id' => 'UserSessionID',
        ])
        ->setInitialState(Welcome::class)
        ->setResponse(function(string $message, string $action) {
            return [
                'USSDResp' => [
                    'action' => $action,
                    'menus' => '',
                    'title' => $message,
                ]
            ];
        });

    return response()->json($ussd->run());
    }

}
