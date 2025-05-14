<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\UserController;

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
// ROTTE PER LA GESTIONE DELLA PIATTAFORMA LATO AMMINISTRATORE

// ROTTE CRUD PER LA GESTIONE DELLE CAMERE
Route::prefix('/admin/rooms')->controller(RoomController::class)->group(function () {

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

// ROTTE CRUD PER LA GESTIONE DELLE PRENOTAZIONI
Route::prefix('/admin/bookings')->controller(BookingController::class)->group(function () {

    // ROTTE PER LA VISUALIZZAZIONE DI TUTTE LE PRENOTAZIONI
    Route::get('/index' , [BookingController::class, 'index'])->name('bookings.index');

    // ROTTE PER LA CREAZIONE E STORAGGIO DELLE PRENOTAZIONI
    Route::get('/create', [BookingController::class, 'create'])->name('bookings.create');
    Route::post('/store', [BookingController::class, 'store'])->name('bookings.store');

    // ROTTE PER LA VISUALIZZAZIONE DELLE SINGOLE PRENOTAZIONI
    Route::get('/show/{id}', [BookingController::class, 'show'])->name('bookings.show');

    // ROTTE PER LA MODIFICA E L'AGGIORNAMENTO DELLE PRENOTAZIONI
    Route::get('/edit/{id}', [BookingController::class, 'edit'])->name('bookings.edit');
    Route::put('/update/{id}', [BookingController::class, 'update'])->name('bookings.update');

    // ROTTE PER LA CANCELLAZIONE DELLE PRENOTAZIONI
    Route::delete('/destroy/{id}', [BookingController::class, 'destroy'])->name('bookings.destroy');
});

// ROTTE CRUD PER LA GESTIONE DEI PAGAMENTI

Route::prefix('/admin/payments')->controller(PaymentController::class)->group(function () {

    // ROTTE PER LA VISUALIZZAZIONE DI TUTTI I PAGAMENTI
    Route::get('/index' , [PaymentController::class, 'index'])->name('payments.index');

    // ROTTE PER LA CREAZIONE E STORAGGIO DEI PAGAMENTI
    Route::get('/create', [PaymentController::class, 'create'])->name('payments.create');
    Route::post('/store', [PaymentController::class, 'store'])->name('payments.store');

    // ROTTE PER LA VISUALIZZAZIONE DEI SINGOLI PAGAMENTI
    Route::get('/show/{id}', [PaymentController::class, 'show'])->name('payments.show');

    // ROTTE PER LA MODIFICA E L'AGGIORNAMENTO DEI PAGAMENTI
    Route::get('/edit/{id}', [PaymentController::class, 'edit'])->name('payments.edit');
    Route::put('/update/{id}', [PaymentController::class, 'update'])->name('payments.update');

    // ROTTE PER LA CANCELLAZIONE DEI PAGAMENTI
    Route::delete('/destroy/{id}', [PaymentController::class, 'destroy'])->name('payments.destroy');
});
    
// ROTTE CRUD PER LA GESTIONE DEGLI UTENTI
Route::prefix('/admin/users')->controller(UserController::class)->group(function () {

    // ROTTE PER LA VISUALIZZAZIONE DI TUTTI GLI UTENTI
    Route::get('/index' , [UserController::class, 'index'])->name('users.index');

    // ROTTE PER LA CREAZIONE E STORAGGIO DEGLI UTENTI
    Route::get('/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/store', [UserController::class, 'store'])->name('users.store');

    // ROTTE PER LA VISUALIZZAZIONE DEI SINGOLI UTENTI
    Route::get('/show/{id}', [UserController::class, 'show'])->name('users.show');

    // ROTTE PER LA MODIFICA E L'AGGIORNAMENTO DEGLI UTENTI
    Route::get('/edit/{id}', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/update/{id}', [UserController::class, 'update'])->name('users.update');

    // ROTTE PER LA CANCELLAZIONE DEGLI UTENTI
    Route::delete('/destroy/{id}', [UserController::class, 'destroy'])->name('users.destroy');
});






// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
// ROTTE PER LA GESTIONE DELLA PIATTAFORMA LATO CLIENTE








// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
// ROTTE GESTIONE DASHBOARD E AUTENTICAZIONE UTENTI
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
