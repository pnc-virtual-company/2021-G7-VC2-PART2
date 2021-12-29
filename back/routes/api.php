<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\PermissionController;



// user
Route::post('/login', [UserController::class, 'login']);
Route::post('/createUser', [UserController::class, 'createUser']);
Route::get('/users', [UserController::class, 'getUsers']);
Route::get('/users/search/{userName}', [UserController::class, 'search']);
Route::put('/users/{id}', [UserController::class, 'updateUser']);
Route::delete('/users/{id}', [UserController::class, 'destroyUser']);
Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::get('/users/{id}', [UserController::class, 'getUser']);

    Route::post('/logout', [UserController::class, 'logout']);
});

Route::get('students', [StudentController::class, 'index']);
Route::get('students/{id}', [StudentController::class, 'show']);
Route::post('students', [StudentController::class, 'store']);
Route::put('students/{id}', [StudentController::class, 'update']);
Route::delete('students/{id}', [StudentController::class, 'destroy']);
Route::get('students/search/{first_name}', [StudentController::class, 'search']);


Route::get('permissions', [PermissionController::class, 'getAllPermission']);
Route::post('permissions', [PermissionController::class, 'createPermission']);
Route::put('permissions/{id}', [PermissionController::class, 'updatePermission']);
Route::delete('permissions/{id}', [PermissionController::class, 'deletePermission']);
Route::get('permissions/search/{student_name}', [PermissionController::class, 'search']);