<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Sparors\Ussd\Facades\Ussd;
use App\Http\Ussd\States\WelcomePage;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/ussd', function (Request $request) {
    $ussd = Ussd::machine()
    ->setInitialState(WelcomePage::class)
    ->set([
        'phone_number' => $request->msisdn,
        'network' => $request->network,
        'session_id' => $request->sessionID,
        'input' => $request->ussdString,
    ])
    ->setResponse(function(string $message, string $action) {
        return [
            'action' => $action,
            'title' => $message,
        ];
    });

    return response()->json($ussd->run());
});
