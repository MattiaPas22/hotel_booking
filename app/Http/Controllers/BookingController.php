<?php

namespace App\Http\Controllers;
use App\Http\Controllers\BookingController;
use App\Models\Booking;
use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\User;
use App\Models\Payment;

class BookingController extends Controller
{
    // FUNZIONE VISUALIZZAZIONE ELENCO PRENOTAZIONI
    public function index()
    {
        $bookings = Booking::all();
        $bookings = Booking::with(['user', 'room'])->get(); 
        return view('bookings.index', compact('bookings'));
    
    }

    // FUNZIONE CREAZIONE E STORAGGIO PRENOTAZIONI
    public function create()
    {
        $rooms = Room::all();
        return view('bookings.create', compact('rooms'));
    }
    
    
    public function store(Request $request)
    {
        // VALIDAZIONE DEI DATI
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'room_id' => 'required|exists:rooms,id',
            'check_in_date' => 'required|date',
            'check_out_date' => 'required|date|after_or_equal:check_in_date',
            'total_price' => 'required|numeric|min:0',
            'status' => 'required|string|max:255',
        ]);

        // CREAZIONE DELLA PRENOTAZIONE
        Booking::create($request->all());
        return redirect()->route('bookings.index')->with('success', 'Prenotazione creata con successo!');
    }


    // FUNZIONE VISUALIZZAZIONE SINGOLA PRENOTAZIONE
    public function show(Booking $booking)
    {
        return view('bookings.show', compact('booking'));
    }

    // FUNZIONE MODIFICA E AGGIORNAMENTO PRENOTAZIONI
    public function edit($id)
    {
        $booking = Booking::findOrFail($id);
        $users = User::all();
        $rooms = Room::all();
        return view('bookings.edit', compact('booking', 'rooms', 'users'));
    }
    public function update(Request $request, Booking $id)
    {
        // VALIDAZIONE DEI DATI
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'room_id' => 'required|exists:rooms,id',
            'check_in_date' => 'required|date',
            'check_out_date' => 'required|date|after_or_equal:check_in_date',
            'total_price' => 'required|numeric|min:0',
            'status' => 'required|string|max:255',
        ]);

        // AGGIORNAMENTO DELLA PRENOTAZIONE
        $id->update($request->all());
        return redirect()->route('bookings.index')->with('success', 'Prenotazione aggiornata con successo!');
    }

    

    // FUNZIONE CANCELLAZIONE PRENOTAZIONI
    public function destroy(Booking $id)
    {
        // CANCELLARE LA PRENOTAZIONE
        $id->delete();
        return redirect()->route('bookings.index')->with('success', 'Prenotazione cancellata con successo!');
    }
}
