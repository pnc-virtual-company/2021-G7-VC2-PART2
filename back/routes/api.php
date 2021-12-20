<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;



// user
Route::post('/login',[UserController::class,'login']);
Route::post('/createUser',[UserController::class,'createUser']);

Route::group(['middleware'=>['auth:sanctum']],function(){

    Route::put('/users/{id}',[UserController::class,'updateUser']);
    Route::delete('/users/{id}',[UserController::class,'destroyUser']);
    Route::get('/users/{id}',[UserController::class,'getUser']);
    Route::get('/users',[UserController::class,'getUsers']);

    // Route::post('/createUser',[UserController::class,'createUser']);
    Route::post('/logout',[UserController::class,'logout']);
});

