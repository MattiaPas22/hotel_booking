@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="h2 mb-4">Modifica Camera</h1>

    {{-- Mostra errori di validazione --}}
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Form di modifica camera --}}
    <form action="{{ route('rooms.update', $room->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="mb-3">
            <label for="name" class="form-label">Nome Camera</label>
            <input type="text" name="name" id="name" 
                   class="form-control" value="{{ old('name', $room->name) }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Descrizione</label>
            <textarea name="description" id="description" 
                      class="form-control" rows="4" required>{{ old('description', $room->description) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="price_per_night" class="form-label">Prezzo per Notte (€)</label>
            <input type="number" name="price_per_night" id="price_per_night" 
                   class="form-control" step="0.01" value="{{ old('price_per_night', $room->price_per_night) }}" required>
        </div>

        <div class="mb-3">
            <label for="beds" class="form-label">Numero Letti</label>
            <input type="number" name="beds" id="beds" 
                   class="form-control" value="{{ old('beds', $room->beds) }}" required>
        </div>

        <div class="mb-3">
            <label for="available_from" class="form-label">Disponibile dal</label>
            <input type="date" name="available_from" id="available_from" 
                   class="form-control" value="{{ old('available_from', $room->available_from->format('Y-m-d')) }}" required>
        </div>

        <div class="mb-3">
            <label for="available_to" class="form-label">Disponibile fino al</label>
            <input type="date" name="available_to" id="available_to" 
                   class="form-control" value="{{ old('available_to', $room->available_to->format('Y-m-d')) }}" required>
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('rooms.index') }}" class="btn btn-secondary">Annulla</a>
            <button type="submit" class="btn btn-primary">Aggiorna Camera</button>
        </div>
    </form>
</div>
@endsection
