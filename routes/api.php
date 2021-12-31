<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EnrollController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::group(['middleware' => ['auth:sanctum']], function (){
   Route::post('/logout',[AuthController::class,'logout']);
   Route::get('/enroll',[EnrollController::class,'index']);
   Route::delete('/enroll/{id}',[EnrollController::class,'destroy']);
   Route::get('/user',  function (Request $request) {
    return $request->user();
   });
});

Route::post('/enroll',[EnrollController::class,'store']);
Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);
