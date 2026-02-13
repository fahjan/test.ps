<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;


// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


Route::post('login', [AuthController::class, 'login'])->middleware(['arabic_numbers']);

Route::middleware(['auth:sanctum', 'arabic_numbers'])->group(function () {
    Route::get('me', function (Request $request) {
        return $request->user();
    });

    Route::prefix('manager')->group(function () { //->middleware(['role:manager'])

        Route::apiResources([
            'students' => App\Http\Controllers\Api\Manager\Students::class,
            'trainers' => App\Http\Controllers\Api\Manager\Trainers::class,
            // 'cars' => App\Http\Controllers\Manager\Cars::class,
            // 'school' => App\Http\Controllers\Manager\School::class,
            // 'lessons' => App\Http\Controllers\Manager\Lessons::class,
            // 'payments' => App\Http\Controllers\Manager\Payments::class,
            // 'messages' => App\Http\Controllers\Manager\Messages::class,

        ]);
    });

    Route::prefix('students')->group(function () {//->middleware(['role:student'])
        Route::resource('exams', App\Http\Controllers\Api\Student\ExamsController::class)->only('store', 'index');
        //     Route::resources([
        //         'students' => App\Http\Controllers\Api\Manager\Students::class,
        // ]);



    });



});

Route::get('/sounds', function () {
    set_time_limit(-1);
    for ($i = 1; $i <= 749; $i++) {
        $fileName = 'questions/' . $i . '.mp3';
        if (Storage::disk('public')->exists($fileName)) {
            continue;
        }

        $response = Http::get("https://eservices.mot.ps/voice-test/public/sounds/$i/$i.mp3");
        if ($response->successful()) {
            // 2. Generate a unique filename


            // 3. Store the audio content
            Storage::disk('public')->put($fileName, $response->body());
        }
        $response = Http::get("https://eservices.mot.ps/voice-test/public/sounds/$i/a1.mp3");
        if ($response->successful()) {
            // 2. Generate a unique filename
            $fileName = 'answers/' . $i . '-1' . '.mp3';

            // 3. Store the audio content
            Storage::disk('public')->put($fileName, $response->body());
        }
        $response = Http::get("https://eservices.mot.ps/voice-test/public/sounds/$i/a2.mp3");
        if ($response->successful()) {
            // 2. Generate a unique filename
            $fileName = 'answers/' . $i . '-2' . '.mp3';

            // 3. Store the audio content
            Storage::disk('public')->put($fileName, $response->body());
        }
    }

});