<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;


// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


Route::post('login', [AuthController::class, 'login'])
    ->middleware(['arabic_numbers']);

Route::middleware(['auth:sanctum', 'arabic_numbers'])->group(function () {
    Route::get('me', [AuthController::class, 'me']);


    Route::prefix('manager')->group(function () { //->middleware(['role:manager'])

        Route::apiResources([
            'students' => App\Http\Controllers\Api\Manager\Students::class,
            'students.exams' => App\Http\Controllers\Api\Manager\ExamsController::class,
            'students.payments' => App\Http\Controllers\Api\Manager\PaymentsController::class,
            'students.lessons' => App\Http\Controllers\Api\Manager\LessonsController::class,
            'trainers' => App\Http\Controllers\Api\Manager\Trainers::class,
            'cars' => App\Http\Controllers\Api\Manager\Cars::class,
            // 'school' => App\Http\Controllers\Manager\School::class,
            // 'payments' => App\Http\Controllers\Manager\Payments::class,
            // 'messages' => App\Http\Controllers\Manager\Messages::class,

        ]);
    });

    Route::prefix('trainer')->group(function () { //
        Route::apiResources([
            'students' => App\Http\Controllers\Api\Trainer\StudentsController::class,

        ]);
    });


    Route::prefix('admin')->middleware(['role:admin'])->group(function () { //

        Route::apiResources([
            'students' => App\Http\Controllers\Api\Admin\Students::class,
            // 'trainers' => App\Http\Controllers\Api\Admin\Trainers::class,
            // 'cars' => App\Http\Controllers\Manager\Cars::class,
            'schools' => App\Http\Controllers\Api\Admin\SchoolsController::class,
            // 'schools.students' => App\Http\Controllers\Api\Admin\StudentsController::class,
            // 'lessons' => App\Http\Controllers\Manager\Lessons::class,
            // 'payments' => App\Http\Controllers\Manager\Payments::class,
            // 'messages' => App\Http\Controllers\Manager\Messages::class,

        ]);
    });

    Route::prefix('students')->group(function () {//->middleware(['role:student'])
        Route::resource('exams', App\Http\Controllers\Api\Student\ExamsController::class)->only('store', 'index');



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