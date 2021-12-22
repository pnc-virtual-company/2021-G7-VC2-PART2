<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StudentController;



// user
Route::post('/login',[UserController::class,'login']);
Route::post('/createUser',[UserController::class,'createUser']);
Route::get('/users',[UserController::class,'getUsers']);

Route::group(['middleware'=>['auth:sanctum']],function(){
    Route::put('/users/{id}',[UserController::class,'updateUser']);
    Route::delete('/users/{id}',[UserController::class,'destroyUser']);
    Route::get('/users/{id}',[UserController::class,'getUser']);
    
    Route::post('/logout',[UserController::class,'logout']);
});

Route::get('students', [StudentController::class, 'index']);
Route::get('students/{id}', [StudentController::class, 'show']);
Route::post('students', [StudentController::class, 'store']);
Route::put('students/{id}', [StudentController::class, 'update']);
Route::delete('students/{id}', [StudentController::class, 'destroy']);
Route::get('/students/search/{first_name}', [StudentController::class, 'search']);
