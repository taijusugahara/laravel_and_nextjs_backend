<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//適当にapiのresが返ってくるかテスト
Route::get('/', function (Request $request) {
    $res = [
        "message" => "apiアクセスに成功しました。",
    ];
    return $res;
});

Route::prefix('todo')->controller(TodoController::class)->group(function () {
    Route::get('/index', 'index');
    Route::post('/create', 'create');
    Route::get('/show/{id}', 'show');
    Route::patch('/update/{id}', 'update');
    Route::delete('/delete/{id}', 'delete');
    Route::get('/search/{word}', 'search');
});