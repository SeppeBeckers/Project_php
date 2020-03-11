@extends('layouts.template')

@section('title', "Edit arrangement")

@section('main')
    <h1>Aanpassen arrangement: {{ $arrangement->type }}</h1>
    <form action="/admin/arrangement" method="post">
        @method('put')
        @csrf
        <div class="form-group">
            <label for="type">Naam</label>
            <input type="text" name="type" id="type"
                   class="form-control @error('type') is-invalid @enderror"
                   placeholder="Type"
                   required
                   value="{{ old('type', $arrangement->type) }}">
            @error('type')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="description">Beschrijving</label>
            <input type="text" name="description" id="description"
                   class="form-control @error('description') is-invalid @enderror"
                   placeholder="Description"
                   description
                   required
                   value="{{ old('description', $arrangement->description) }}">
            @error('description')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success mt-3">Opslaan</button>
        <a href="/admin/arrangement" class="btn btn-primary mx-1 ">Terug</a>
    </form>
@endsection