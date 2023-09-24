<?php

use App\Http\Controllers\HospitalController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// LOGIN
Route::get('/', [UserController::class, 'login_page'])->name('login_page');
Route::post('/login', [UserController::class, 'login'])->name('login');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');

// REGISTER
Route::get('/register_page', [UserController::class, 'register_page'])->name('register_page');
Route::post('/register', [UserController::class, 'register'])->name('register');

// PUBLIC
Route::get('/home', function() {
    return view('home');
})->name('home');

// RUMAH SAKIT
Route::get('/rumah_sakit', [HospitalController::class, 'index'])->name('rumah_sakit');

Route::get('/search', [HospitalController::class, 'search'])->name('search');

// HANYA USER LOGIN
Route::middleware('checkAuth')->group(function() {

    // PROFIL
    Route::get('/profile/{id_user}', [UserController::class, 'index'])->name('profile');
    Route::get('/edit_profile_page/{id_user}', [UserController::class, 'edit_profile_page'])->name('edit_profile_page');
    Route::patch('/edit_profile', [UserController::class, 'edit_profile'])->name('edit_profile');

    // PESAN DAN ADUAN
    Route::get('/add_aduan_page', [QuestionController::class, 'index'])->name('add_aduan_page');
    Route::post('/add_aduan', [QuestionController::class, 'add_aduan'])->name('add_aduan');

    // HANYA ADMIN
    Route::middleware('role:admin')->group(function() {
        // ADMINISTRASI
        Route::get('/administration', [UserController::class, 'administration'])->name('administration');

        Route::get('/edit_user_page/{id_user}', [UserController::class, 'edit_user_page'])->name('edit_user_page');
        Route::patch('/edit_user/{id_user}', [UserController::class, 'edit_user'])->name('edit_user');

        Route::delete('/delete_user', [UserController::class, 'delete_user'])->name('delete_user');

        // RUMAH SAKIT
        Route::get('/add_rumah_sakit_page', [HospitalController::class, 'add_rumah_sakit_page'])->name('add_rumah_sakit_page');
        Route::post('/add_rumah_sakit', [HospitalController::class, 'add_rumah_sakit'])->name('add_rumah_sakit');

        Route::get('/edit_rumah_sakit_page/{id_hospital}', [HospitalController::class, 'edit_rumah_sakit_page'])->name('edit_rumah_sakit_page');
        Route::patch('/edit_rumah_sakit/{id_hospital}', [HospitalController::class, 'edit_rumah_sakit'])->name('edit_rumah_sakit');

        Route::delete('/delete_rumah_sakit', [HospitalController::class, 'delete_rumah_sakit'])->name('delete_rumah_sakit');

        // PESAN ADUAN
        Route::get('/pertanyaan_aduan', [QuestionController::class, 'pertanyaan_aduan'])->name('pertanyaan_aduan');
    });
});
