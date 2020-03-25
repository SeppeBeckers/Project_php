@extends('layouts.template')

@section('title', "Aanpassen arrangement: $arrangement->type")

@section('main')
    <h1>Aanpassen arrangement: {{ $arrangement->type }}</h1>
    <form action="/admin/arrangement/{{ $arrangement->id }}" method="post">
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


<div class="row">
        @foreach($arrangement->prices as $price)
            <div class="col-6 col-sm-3">
                <div class="form-group">
                    <label for="{{ $price->id }}">
                        @if ($price->occupancy_id == 1)
                            @if ($price->type_room_id == 1)
                                Single - Douche
                            @else
                                Single - Douche/Bad
                            @endif
                        @else
                            @if ($price->type_room_id == 1)
                                Double - Douche
                            @else
                                Double - Douche/Bad
                            @endif
                        @endif
                        </label>
                    <input type="number" name="{{ $price->id }}" id="{{ $price->id }}"
                           class="form-control @error('$price->id ') is-invalid @enderror"
                           placeholder="{{ $price->id }}"
                           {{ $price->id }}
                           required
                           value="{{ old('$price->amount', $price->amount) }}">
                    @error('$price->id')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

        @endforeach
</div>










        <button type="submit" id="submit" class="btn btn-success ">Opslaan</button>
        <a href="/admin/arrangement" class="btn btn-primary mx-1 ">Terug</a>
    </form>
@endsection


