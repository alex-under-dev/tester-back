<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CheckAnswerController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserProgressController;
use Illuminate\Support\Facades\Route;

Route::post('registration', [UserController::class, 'create']);
Route::post('auth', [AuthController::class, 'login']);

Route::group(
    ['middleware' => 'jwt.verify'],
    function () {
        Route::get('tests', [TestController::class, 'getAllTests']);
        Route::get('test/{id}', [TestController::class, 'getTest']);
        Route::post('check', [CheckAnswerController::class, 'checkingAnswer']);
        Route::delete('/clear_progress', [UserProgressController::class, 'clearProgress']);
        Route::get('/progress', [UserProgressController::class, 'getStatistics']);
    }
);
