<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';


//Admin Routes

Route::prefix('admin')->group(function(){
    Route::middleware('guest:admin')->group(function(){
        // login routes
        Route::get('login', [AdminController::class, 'index'])->name('admin.login');
        Route::post('login', [AdminController::class, 'store']);
    });
    Route::middleware('admin')->group(function() {
        Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard'); 
    });
    Route::post('logout', [AdminController::class, 'destroy'])->name('admin.logout');
});
