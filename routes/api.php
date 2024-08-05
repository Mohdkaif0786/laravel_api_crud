<?php

use App\Http\Middleware\VerifyCsrfToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\AuthContoller;
// use App\Http\Controllers\auth\PostController;
use App\Http\Controllers\auth\PostController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('signup',[AuthContoller::class,'signup']);
Route::post('login',[AuthContoller::class,'login']);
Route::get('hello',[AuthContoller::class,'hello']);

Route::middleware('auth:sanctum')->group(function(){
    Route::post('logout',[AuthContoller::class,'logout']);
    Route::apiResource('posts',PostController::class)->withoutMiddleware(VerifyCsrfToken::class);
    
});

