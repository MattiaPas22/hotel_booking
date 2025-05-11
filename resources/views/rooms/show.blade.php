@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="h2 mb-4">{{ $room->name }}</h1>

    {{-- Dati della camera --}}
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Descrizione</h5>
            <p class="card-text">{{ $room->description }}</p>

            <h5 class="card-title">Dettagli</h5>
            <ul class="list-unstyled">
                <li><strong>Prezzo per Notte:</strong> €{{ number_format($room->price_per_night, 2, ',', '.') }}</li>
                <li><strong>Numero Letti:</strong> {{ $room->beds }}</li>
                <li><strong>Disponibile dal:</strong> {{ $room->available_from->format('d/m/Y') }}</li>
                <li><strong>Disponibile fino al:</strong> {{ $room->available_to->format('d/m/Y') }}</li>
            </ul>

            {{-- Pulsanti Azioni --}}
            <div class="mt-4 d-flex justify-content-between">
                <a href="{{ route('rooms.index') }}" class="btn btn-secondary">Torna Indietro</a>

                <div>
                    <a href="{{ route('rooms.edit', $room->id) }}" class="btn btn-warning me-2">Modifica</a>

                    {{-- Bottone elimina --}}
                    <form action="{{ route('rooms.destroy', $room->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Sei sicuro di voler eliminare questa camera?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Elimina</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
