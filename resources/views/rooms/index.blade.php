@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h2">Lista Camere</h1>
            <a href="{{ route('rooms.create') }}" class="btn btn-primary">Aggiungi Camera</a>
        </div>

        {{-- Mostra messaggi di successo --}}
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        {{-- Lista camere --}}
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Nome</th>
                        <th>Descrizione</th>
                        <th>Prezzo per Notte (€)</th>
                        <th>Letti</th>
                        <th>Disponibile Dal</th>
                        <th>Disponibile Fino Al</th>
                        <th>Azioni</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($rooms as $room)
                        <tr>
                            <td>{{ $room->name }}</td>
                            <td>{{ Str::limit($room->description, 50) }}</td>
                            <td>{{ number_format($room->price_per_night, 2, ',', '.') }}</td>
                            <td>{{ $room->beds }}</td>
                            <td>{{ $room->available_from->format('d/m/Y') }}</td>
                            <td>{{ $room->available_to->format('d/m/Y') }}</td>
                            <td class="d-flex gap-2">
                                <a href="{{ route('rooms.show', $room->id) }}" class="btn btn-info btn-sm">Dettagli</a>
                                <a href="{{ route('rooms.edit', $room->id) }}" class="btn btn-warning btn-sm">Modifica</a>
                                <form action="{{ route('rooms.destroy', $room->id) }}" method="POST" onsubmit="return confirm('Sei sicuro di voler eliminare questa camera?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm" type="submit">Elimina</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
