<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Agent\AgentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SocialAuth\ProviderController;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

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
    return view('welcome');
});


// Socialite Login
Route::controller(ProviderController::class)->group(function(){
    Route::get('/auth/{provider}/redirect', 'redirect');
    Route::get('/auth/{provider}/callback', 'callback');
});
 

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::prefix('admin')->controller(AdminController::class)->group(function () {

    Route::middleware(['auth', 'role:admin'])->group(function(){
        Route::get('dashboard', 'index')->name('admin.dashboard');
        Route::get('logout', 'logout')->name('admin.logout');
        Route::get('profile', 'show')->name('admin.profile');
        Route::get('profile/password', 'showPassword')->name('admin.profile.password');
        Route::post('profile/password/update', 'updatePassword')->name('admin.profile.passwordUpdate');
        Route::put('profile', 'update')->name('admin.profile.update');
    });

    Route::get('login', 'login')->name('admin.login');

});


Route::prefix('agent')->middleware(['auth', 'role:agent'])->controller(AgentController::class)->group(function(){
    Route::get('dashboard', 'index')->name('agent.dashboard');
});