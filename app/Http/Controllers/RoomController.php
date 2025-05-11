<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\Room;

class RoomController extends Controller
{
    // FUNZIONE PER LA VISUALIZZAZIONE DI TUTTE LE CAMERE
    public function index():View
    {
        $rooms = Room::all();

        // Verificare se ci sono stanze nel Database
        if ($rooms->isEmpty()) {
            return view('rooms.index', ['rooms' => $rooms])->with('message', 'Nessuna stanza disponibile');
        }
        return view('rooms.index', compact('rooms')); // Equivalente a scrivere -> ['rooms' => $rooms]);
    }

    // FUNZIONE PER LA CREAZIONE E STORAGGIO DELLE CAMERE
    public function create(): View
    {
        return view('rooms.create');

    }


    public function store(Request $request):RedirectResponse
    {
        // VALIDAZIONE DEI DATI
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price_per_night' => 'required|numeric|min:0',
            'beds' => 'required|integer|min:1',
            'available_from' => 'required|date',
            'available_to' => 'required|date|after_or_equal:available_from',
        ]);

        // CREAZIONE DELLA CAMERA
        Room::create($request->all());
        return redirect()->route('rooms.index')->with('success', 'Stanza creata con successo!');
        
    }

    // FUNZIONE PER LA VISUALIZZAZIONE DELLE SINGOLE CAMERE
    public function show(string $id):View
    {
        $room = Room::findOrFail($id);
        return view('rooms.show', compact('room')); 
    }

    // FUNZIONE PER LA MODIFICA E L'AGGIORNAMENTO DELLE CAMERE
    public function edit(string $id):View
    {
        $room = Room::findOrFail($id);
        return view('rooms.edit', compact('room')); 
    }

    public function update(Request $request, $id):RedirectResponse
    {
        // VALIDAZIONE DEI DATI
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price_per_night' => 'required|numeric|min:0',
            'beds' => 'required|integer|min:1',
            'available_from' => 'required|date',
            'available_to' => 'required|date|after_or_equal:available_from',
        ]);

        // AGGIORNAMENTO DELLA CAMERA
        $room = Room::findOrFail($id);
        $room->update($request->all());
        return redirect()->route('rooms.index')->with('success', 'Stanza aggiornata con successo!');
    }


    // FUNZIONE PER LA CANCELLAZIONE DELLE CAMERE
    public function destroy(string $id):RedirectResponse
    {
        $room = Room::findOrFail($id);
        $room->delete();
        return redirect()->route('rooms.index')->with('success', 'Stanza eliminata con successo!');
    }

};


