<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;

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
Route::controller(AuthController::class)->group(function(){
    Route::prefix('auth')->group(function(){
        Route::post('/register', 'register');
        Route::post('/login', 'login');
    });
});

Route::controller(TestController::class)->group(function(){
    Route::get('/test/{id}', 'retrieve_a_test');
    Route::get('/tests', 'retrieve_all_tests');
    Route::post('/test', 'create_a_test');
    Route::put('/test/{id}', 'update_a_test');
    Route::delete('/test/{id}', 'delete_a_test');
});

Route::controller(CategoryController::class)->group(function(){
    Route::get('/category/{id}', 'retrieve_a_category');
    Route::get('/categories', 'retrieve_all_categories');
    Route::post('/category', 'create_a_category');
    Route::put('/category/{id}', 'update_a_category');
    Route::delete('/category/{id}', 'delete_a_category');
});

Route::group(["middleware" => "auth:sanctum"], function(){
    Route::get('/logout', [AuthController::class, 'logout']);

    Route::controller(UserController::class)->group(function(){
        Route::get('/user/{id}/test', 'retrieve_user_tests');
        Route::post('/user/{id}/test', 'user_take_test');
    });
});
