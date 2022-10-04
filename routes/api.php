<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/* 
Route::get('/{any?}', function(){
    return view('welcome');
}); */

Route::post('/contact', [ContactController::class,'addcontact']);

Route::get('/contactmail', function () {
    $user = \App\Models\User::factory()->make();
    $to = [
        [
            'email' => 'devtest@worksite.ca', 
            'name' => 'worksite',
        ]
    ];

    \Illuminate\Support\Facades\Mail::to($to)
        ->send(new \App\Mail\ContactMail());
        return null;
  
});


