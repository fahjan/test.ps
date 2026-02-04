<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;


// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('me', function (Request $request) {
        return $request->user();
    });

    Route::prefix('manager')->middleware(['role:manager'])->group(function () {

        Route::resources([
            'students' => App\Http\Controllers\Api\Manager\Students::class,
            // 'trainers' => App\Http\Controllers\Manager\Trainers::class,
            // 'cars' => App\Http\Controllers\Manager\Cars::class,
            // 'school' => App\Http\Controllers\Manager\School::class,
            // 'lessons' => App\Http\Controllers\Manager\Lessons::class,
            // 'payments' => App\Http\Controllers\Manager\Payments::class,
            // 'messages' => App\Http\Controllers\Manager\Messages::class,

        ]);
    });

    Route::prefix('student')->middleware(['role:student'])->group(function () {

    });
});
