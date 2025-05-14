@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Modifica Prenotazione</h2>

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

    {{-- FORM DI MODIFICA PRENOTAZIONE --}}
    <form action="{{ route('bookings.update', $booking->id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Selezione Utente --}}
        <div class="mb-3">
            <label for="user_id" class="form-label">Utente</label>
            <input type="number" name="user_id" id="user_id" class="form-control" value="{{ old('user_id', $booking->user_id) }}" required>
        </div>

        {{-- Selezione Camera --}}
        <div class="mb-3">
            <label for="room_id" class="form-label">Camera</label>
            <select name="room_id" id="room_id" class="form-select" required>
                <option value="">-- Seleziona una camera --</option>
                @foreach($rooms as $room)
                    <option value="{{ $room->id }}" {{ old('room_id', $booking->room_id) == $room->id ? 'selected' : '' }}>
                        {{ $room->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Data Check-in --}}
        <div class="mb-3">
            <label for="check_in_date" class="form-label">Data Check-in</label>
            <input type="date" name="check_in_date" id="check_in_date" class="form-control" value="{{ old('check_in_date', $booking->check_in_date) }}" required>
        </div>

        {{-- Data Check-out --}}
        <div class="mb-3">
            <label for="check_out_date" class="form-label">Data Check-out</label>
            <input type="date" name="check_out_date" id="check_out_date" class="form-control" value="{{ old('check_out_date', $booking->check_out_date) }}" required>
        </div>

        {{-- Prezzo Totale --}}
        <div class="mb-3">
            <label for="total_price" class="form-label">Prezzo Totale (€)</label>
            <input type="number" name="total_price" id="total_price" class="form-control" step="0.01" min="0" value="{{ old('total_price', $booking->total_price) }}" required>
        </div>

        {{-- Stato Prenotazione --}}
        <div class="mb-3">
            <label for="status" class="form-label">Stato</label>
            <select name="status" id="status" class="form-select" required>
                <option value="">-- Seleziona stato --</option>
                <option value="confirmed" {{ old('status', $booking->status) == 'confirmed' ? 'selected' : '' }}>Confermata</option>
                <option value="pending" {{ old('status', $booking->status) == 'pending' ? 'selected' : '' }}>In attesa</option>
                <option value="cancelled" {{ old('status', $booking->status) == 'cancelled' ? 'selected' : '' }}>Annullata</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Aggiorna Prenotazione</button>
    </form>
</div>
@endsection
