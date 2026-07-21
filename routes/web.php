<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DemandeCongeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Bug #3 corrigé : un seul groupe middleware 'auth' pour toutes les routes protégées
Route::middleware('auth')->group(function () {

    // Profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Demandes de congé (CRUD)
    Route::resource('demande-conges', DemandeCongeController::class);

    // Actions manager (protégées en plus par le middleware 'manager')
    Route::middleware('manager')->group(function () {
        Route::patch('/demande-conges/{demande_conge}/valider', [DemandeCongeController::class, 'valider'])->name('demande-conges.valider');
        Route::patch('/demande-conges/{demande_conge}/refuser', [DemandeCongeController::class, 'refuser'])->name('demande-conges.refuser');
    });
});

require __DIR__.'/auth.php';