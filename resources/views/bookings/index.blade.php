@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h2">Lista Prenotazioni</h1>
            <a href="{{ route('bookings.create') }}" class="btn btn-primary">Aggiungi Prenotazione</a>
        </div>

        {{-- Mostra messaggi di successo --}}
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        {{-- Lista prenotazioni --}}
        @if($bookings->isEmpty())
            <div class="alert alert-warning">
                Nessuna prenotazione disponibile.
            </div>
        @else
            <div class="table-responsive">
                <table class="table">
                    <thead class="table-dark">
                        <tr>
                            <th>Utente</th>
                            <th>Camera</th>
                            <th>Data Check-in</th>
                            <th>Data Check-out</th>
                            <th>Prezzo Totale (€)</th>
                            <th>Stato</th>
                            <th>Azioni</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bookings as $booking)
                            <tr>
                                <td>{{ $booking->user->name }}</td>
                                <td>{{ $booking->room->name }}</td>
                                <td>{{ \Carbon\Carbon::parse($booking->check_in_date)->format('d/m/Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($booking->check_out_date)->format('d/m/Y') }}</td>
                                <td>{{ number_format($booking->total_price, 2, ',', '.') }}</td>
                                <td>
                                    <span class="badge 
                                        @if($booking->status == 'confirmed') badge-success 
                                        @elseif($booking->status == 'pending') badge-warning 
                                        @elseif($booking->status == 'cancelled') badge-danger 
                                        @endif">
                                        {{ ucfirst($booking->status) }}
                                    </span>
                                </td>
                                
                                <td class="d-flex gap-2">
                                    <a href="{{ route('bookings.show', $booking->id) }}" class="btn btn-info btn-sm">Dettagli</a>
                                    <a href="{{ route('bookings.edit', $booking->id) }}" class="btn btn-warning btn-sm">Modifica</a>
                                    <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST" onsubmit="return confirm('Sei sicuro di voler eliminare questa prenotazione?');">
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
        @endif

    </div>
@endsection
