@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Crea Nuova Prenotazione</h2>

    {{-- MESSAGGI DI ERRORE --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- FORM DI CREAZIONE PRENOTAZIONE --}}
    <form action="{{ route('bookings.store') }}" method="POST">
        @csrf

        {{-- Selezione Utente --}}
        <div class="mb-3">
            <label for="user_id" class="form-label">Utente</label>
            <input type="number" name="user_id" class="form-control" placeholder="ID utente" required>
            {{-- In alternativa, se vuoi una select con utenti da caricare dinamicamente: --}}
            {{-- <select name="user_id" class="form-select" required>
                <option value="">-- Seleziona Utente --</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select> --}}
        </div>

        {{-- Selezione Camera --}}
        <div class="mb-3">
            <label for="room_id" class="form-label">Camera</label>
            <select name="room_id" id="room_id" class="form-select" required>
                <option value="">-- Seleziona una camera --</option>
                @foreach($rooms as $room)
                    <option value="{{ $room->id }}">{{ $room->name }}</option>
                @endforeach
            </select>
        </div>

        {{-- Data Check-in --}}
        <div class="mb-3">
            <label for="check_in_date" class="form-label">Data Check-in</label>
            <input type="date" name="check_in_date" class="form-control" required>
        </div>

        {{-- Data Check-out --}}
        <div class="mb-3">
            <label for="check_out_date" class="form-label">Data Check-out</label>
            <input type="date" name="check_out_date" class="form-control" required>
        </div>

        {{-- Prezzo Totale --}}
        <div class="mb-3">
            <label for="total_price" class="form-label">Prezzo Totale (€)</label>
            <input type="number" name="total_price" class="form-control" step="0.01" min="0" required>
        </div>

        {{-- Stato Prenotazione --}}
        <div class="mb-3">
            <label for="status" class="form-label">Stato</label>
            <select name="status" class="form-select" required>
                <option value="">-- Seleziona stato --</option>
                <option value="confirmed">Confermata</option>
                <option value="pending">In attesa</option>
                <option value="cancelled">Annullata</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Conferma Prenotazione</button>
    </form>
</div>
@endsection
