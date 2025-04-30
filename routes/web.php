<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\vacationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    //Vacation

    Route::get('/vacation/create', [vacationController::class, 'create'])->name('vacation.create');
    Route::post('/vacation', [vacationController::class, 'store'])->name('vacation.store');

    //permission

});

require __DIR__.'/auth.php';
