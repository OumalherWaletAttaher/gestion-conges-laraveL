<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DemandeCongeController;

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
});

require __DIR__.'/auth.php';

Route::middleware('auth')->group(function () {
    Route::resource('demande-conges', DemandeCongeController::class);
});

Route::middleware(['auth', 'manager'])->group(function () {
    Route::patch('/demande-conges/{demande_conge}/valider', [DemandeCongeController::class, 'valider'])->name('demande-conges.valider');
    Route::patch('/demande-conges/{demande_conge}/refuser', [DemandeCongeController::class, 'refuser'])->name('demande-conges.refuser');
});