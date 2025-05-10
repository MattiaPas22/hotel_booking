<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomController;




// ROTTE CRUD PER LA GESTIONE DELLE CAMERE
Route::prefix('/rooms')->controller(RoomController::class)->group(function () {

    // ROTTE PER LA VISUALIZZAZIONE DI TUTTE LE CAMERE
    Route::get('/index' , [RoomController::class, 'index'])->name('rooms.index');

    // ROTTE PER LA CREAZIONE E STORAGGIO DELLE CAMERE
    Route::get('/create', [RoomController::class, 'create'])->name('rooms.create');
    Route::post('/store', [RoomController::class, 'store'])->name('rooms.store');

    // ROTTE PER LA VISUALIZZAZIONE DELLE SINGOLE CAMERE
    Route::get('/show/{id}', [RoomController::class, 'show'])->name('rooms.show');

    // ROTTE PER LA MODIFICA E L'AGGIORNAMENTO DELLE CAMERE
    Route::get('/edit/{id}', [RoomController::class, 'edit'])->name('rooms.edit');
    Route::put('/update/{id}', [RoomController::class, 'update'])->name('rooms.update');


    // ROTTE PER LA CANCELLAZIONE DELLE CAMERE
    Route::delete('/destroy/{id}', [RoomController::class, 'destroy'])->name('rooms.destroy');

});

// ROTTE GESTIONE DASHBOARD E AUTENTICAZIONE
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
