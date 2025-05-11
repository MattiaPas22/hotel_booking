@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="h2 mb-4">Crea una Nuova Camera</h1>

    {{-- FORM --}}
    <form action="{{ route('rooms.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Nome Camera</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Descrizione</label>
            <textarea name="description" id="description" class="form-control" rows="3" required></textarea>
        </div>

        <div class="mb-3">
            <label for="price_per_night" class="form-label">Prezzo per Notte</label>
            <input type="number" name="price_per_night" id="price_per_night" class="form-control" step="0.01" required>
        </div>

        <div class="mb-3">
            <label for="beds" class="form-label">Numero Letti</label>
            <input type="number" name="beds" id="beds" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="available_from" class="form-label">Disponibile da</label>
            <input type="date" name="available_from" id="available_from" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="available_to" class="form-label">Disponibile fino a</label>
            <input type="date" name="available_to" id="available_to" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Salva Camera</button>
    </form>
</div>
@endsection
