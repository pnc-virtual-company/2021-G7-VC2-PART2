<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\DisciplineController;


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
//student
Route::get('students', [StudentController::class, 'index']);
Route::get('students/{id}', [StudentController::class, 'show']);
Route::post('students', [StudentController::class, 'store']);
Route::put('students/{id}', [StudentController::class, 'update']);
Route::delete('students/{id}', [StudentController::class, 'destroy']);
Route::get('students/search/{first_name}', [StudentController::class, 'search']);

//permission
Route::get('permission', [PermissionController::class, 'getAllPermission']);
Route::post('permission', [PermissionController::class, 'createPermission']);
Route::put('permission/{id}', [PermissionController::class, 'updatePermission']);
Route::delete('permission/{id}', [PermissionController::class, 'deletePermission']);
Route::get('permission/search/{student_name}', [PermissionController::class, 'search']);


Route::get('discipline', [DisciplineController::class, 'getAllDiscipline']);
Route::post('discipline', [DisciplineController::class, 'createDiscipline']);
Route::put('discipline/{id}', [DisciplineController::class, 'updateDiscipline']);
Route::delete('discipline/{id}', [DisciplineController::class, 'deleteDiscipline']);
Route::get('discipline/search/{student_name}', [DisciplineController::class, 'search']);