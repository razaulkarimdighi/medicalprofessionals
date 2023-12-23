<?php

use App\Http\Controllers\Admin\Profile\UserProfileController;
use App\Http\Controllers\Admin\User\UsersController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\Admin\Anesthesiologist\AnesthesiologistController;
use App\Http\Controllers\Admin\Assign_Anesthesiologist\AssignAnesthesiologistController;
use App\Http\Controllers\Admin\Medical_Practitioner\MedicalPractitionerController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', function () {
    // return redirect()->route('login');
    return view('frontend.index');
});
Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');


//all routes for admin
Route::prefix('admin')->as('admin.')->group(function () {
    // USER
    Route::resource('users', UsersController::class);
    //SCHEDULE
    Route::resource('schedules', ScheduleController::class);
    //Anesthesiologists
    Route::resource('anesthesiologists', AnesthesiologistController::class);
     //Assign Anesthesiologists
    Route::resource('assign_anesthesiologists', AssignAnesthesiologistController::class);
    //All Assignment Data
    Route::get('/assign_anesthesiologist/all/assignment', [AssignAnesthesiologistController::class, 'getAllAssignment'])->name('allassignment');

    //Create Anesthesiologists with data
    Route::get('/assign/anesthesiologist/create/{id}', [AssignAnesthesiologistController::class,'getAnesthesiologist'])->name('assign.anesthesiologist');

    //Medical Practitioners
    Route::resource('medical_practitioners', MedicalPractitionerController::class);
    // PROFILE
    Route::get('/profile', [UserProfileController::class, 'index'])->name('profile.info');
    Route::post('/avatar/update', [UserProfileController::class, 'avatarUpdate'])->name('avatar.update');
    Route::put('/profile/update/{id}', [UserProfileController::class, 'updateProfile'])->name('profile.update');
    Route::post('/pass/update/', [UserProfileController::class, 'updatePassword'])->name('update.password');

});

//all routes for manager
Route::prefix('manager')->as('manager.')->group(function () {

});

//all routes for HR
Route::prefix('hr')->as('hr.')->group(function () {

});

//all routes for Employee
Route::prefix('employee')->as('employee.')->group(function () {

});


