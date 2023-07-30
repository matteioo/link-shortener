<?php

use App\Http\Controllers\LinkController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

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

Route::controller(LinkController::class)->group(function () {
    Route::prefix('/r')->group(function () {
        Route::get('!{identifier}', 'details')->name('link.redirect.details');
        Route::get('/{identifier}', 'redirectToUrl')->name('link.redirect');
        Route::post('/{identifier}', 'redirectToUrl')->name('link.redirect.password');
    });

    Route::get('/links', [LinkController::class, 'index'])->middleware(['auth', 'verified'])->name('links.index');
    Route::post('/links', [LinkController::class, 'store'])->name('links.store');
});

Route::get('/', function () {
    return Inertia::render('Home/Index', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
    ]);
})->name('home');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
