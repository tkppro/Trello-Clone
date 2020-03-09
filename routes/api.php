<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->group(function() {
    Route::post('/logout', 'API\AuthController@logout');
    Route::get('/user', 'API\UserController@index');
    Route::apiResource('/boards', 'API\BoardController');
    Route::apiResource('/tasks', 'API\TaskController');
    Route::apiResource('/activities', 'API\ActivityController')
            ->only(['index', 'store', 'destroy']);
    Route::apiResource('/comments', 'API\CommentController')
    ->except(['show']);
    Route::apiResource('/cards', 'API\CardController');
    Route::put('/changeTaskOrder/{task}', 'API\TaskController@changeTaskOrder');
});

Route::post('/login', 'API\AuthController@login');
Route::post('/register', 'API\AuthController@register');
