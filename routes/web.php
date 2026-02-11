<?php

use App\Http\Controllers\DetectDeviceController;
use App\Http\Controllers\ImpersonateController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Account\Account;
use App\Http\Controllers\Auth\LoginController;


Route::get('/app', DetectDeviceController::class);

Route::get('/impersonate/{id}', [ImpersonateController::class, 'impersonate'])->name('login-as')
    ->middleware(['auth', 'role:admin']);
Route::get('/leave-impersonation', [ImpersonateController::class, 'leaveImpersonation'])->name('login-back');


Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'arabic_numbers']
    ],
    function () {

        Auth::routes(['register' => true]);


        Route::get('/', function () {
            if ($user = Auth::check()) {
                return redirect('/account');
            }
            return view('auth.login');
        })->name('home');


        Route::get('logout', [LoginController::class, 'logout']);

        // Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
    
        Route::view('/about', 'static.about')->name('about');
        Route::view('/privacy', 'static.privacy')->name('privacy');
        Route::view('/user-policy', 'static.user-policy')->name('user-policy');

        // 
// 
// 
        Route::middleware(['auth'])->group(function () {
            Route::name('account.')->prefix('account')->group(function () {
                Route::get('', [Account::class, 'index']);
                Route::resource('profile', App\Http\Controllers\Account\Profile::class);
                Route::resource('questions', App\Http\Controllers\Account\Questions::class);
                Route::resource('signs', App\Http\Controllers\Account\Signs::class);
            });

            // Route::middleware(['auth:manager', 'role:manager|admin'])->name('manager.')->prefix('manager')->group(function () {
            Route::name('manager.')->middleware(['auth', 'role:manager|admin'])->prefix('manager')->group(function () {
                Route::get('/', [App\Http\Controllers\Manager\Students::class, 'index']);
                Route::get('students/{id}/exams', [App\Http\Controllers\Manager\Students::class, 'exams']);
                Route::get('students/exams/{exam_id}/show', [App\Http\Controllers\Manager\Students::class, 'result']);
                Route::get('students/{user_id}/reset_password', [App\Http\Controllers\Manager\Students::class, 'reset_password'])->name('students.reset_password');
                Route::get('ufreez/{student_id}', [App\Http\Controllers\Manager\Students::class, 'unfrees'])->name('students.unfreez');
                Route::resources([
                    'students' => App\Http\Controllers\Manager\Students::class,
                    'trainers' => App\Http\Controllers\Manager\Trainers::class,
                    'cars' => App\Http\Controllers\Manager\Cars::class,
                    'school' => App\Http\Controllers\Manager\School::class,
                    'lessons' => App\Http\Controllers\Manager\Lessons::class,
                    'payments' => App\Http\Controllers\Manager\Payments::class,
                    'messages' => App\Http\Controllers\Manager\Messages::class,

                ]);
            });

            Route::name('admin.')->prefix('admin')->middleware(['role:admin'])->group(function () {
                // Route::get('', [App\Http\Controllers\Admin\Account::class, 'index']);
    
                Route::get('', [App\Http\Controllers\Admin\Students::class, 'index']);

                Route::resource('schools', App\Http\Controllers\Admin\Schools::class);
                Route::resource('kinds', App\Http\Controllers\Admin\Kinds::class);
                Route::resource('cities', App\Http\Controllers\Admin\Cities::class);
                Route::resource('cars', App\Http\Controllers\Admin\Cars::class);
                Route::resource('jobs', App\Http\Controllers\Admin\Jobs::class);
                Route::resource('managers', App\Http\Controllers\Admin\Managers::class);
                Route::resource('licenses', App\Http\Controllers\Admin\Licenses::class);
                Route::resource('lessons', App\Http\Controllers\Admin\Lessons::class);
                Route::resource('payments', App\Http\Controllers\Admin\Payments::class);
                Route::resource('trainers', App\Http\Controllers\Admin\Trainers::class);
                Route::resource('students', App\Http\Controllers\Admin\Students::class);
                Route::resource('examiners', App\Http\Controllers\Admin\Examiners::class);
            });

            Route::middleware(['auth', 'role:student'])->name('student.')->prefix('student')->group(function () {
                Route::get('', [App\Http\Controllers\Student\Account::class, 'index']);
                Route::resource('exams', App\Http\Controllers\Student\Exams::class);
            });
        });

        Route::get('/home', [App\Http\Controllers\Account\Account::class, 'index'])->name('home');


    }
);
