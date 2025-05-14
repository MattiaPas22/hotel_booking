@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h2">Dettagli Prenotazione</h1>
            <a href="{{ route('bookings.index') }}" class="btn btn-secondary">Torna alla lista</a>
        </div>

        {{-- Messaggi di successo --}}
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        {{-- Dettagli prenotazione --}}
        <div class="card">
            <div class="card-header">
                <h4>Dettagli della Prenotazione</h4>
            </div>
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-3">Utente</dt>
                    <dd class="col-sm-9">{{ $booking->user?->name ?? 'N/A' }}</dd>

                    <dt class="col-sm-3">Camera</dt>
                    <dd class="col-sm-9">{{ $booking->room?->name ?? 'N/A' }}</dd>

                    <dt class="col-sm-3">Data Check-in</dt>
                    <dd class="col-sm-9">{{ \Carbon\Carbon::parse($booking->check_in_date)->format('d/m/Y') }}</dd>

                    <dt class="col-sm-3">Data Check-out</dt>
                    <dd class="col-sm-9">{{ \Carbon\Carbon::parse($booking->check_out_date)->format('d/m/Y') }}</dd>

                    <dt class="col-sm-3">Prezzo Totale (€)</dt>
                    <dd class="col-sm-9">{{ number_format($booking->total_price, 2, ',', '.') }}</dd>

                    <dt class="col-sm-3">Stato</dt>
                    <dd class="col-sm-9">
                        <span class="badge 
                            @if($booking->status == 'confirmed') badge-success 
                            @elseif($booking->status == 'pending') badge-warning 
                            @elseif($booking->status == 'cancelled') badge-danger 
                            @endif">
                            {{ ucfirst($booking->status) }}
                        </span>
                    </dd>
                </dl>

                {{-- Azioni disponibili --}}
                <div class="d-flex gap-2 mt-4">
                    <a href="{{ route('bookings.edit', $booking->id) }}" class="btn btn-warning btn-sm">Modifica</a>
                    <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST" onsubmit="return confirm('Sei sicuro di voler eliminare questa prenotazione?');">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" type="submit">Elimina</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
