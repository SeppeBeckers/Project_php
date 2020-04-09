@extends('layouts.template')

@section('title', "Aanpassen arrangement: $arrangement->type")

@section('main')
    <h1>Aanpassen arrangement: {{ $arrangement->type }}</h1>
    <form action="/admin/arrangement/{{ $arrangement->id }}" method="post">
        @method('put')
        @csrf
        <div class="form-group">
            <label for="naam">Naam</label>
            <input type="text" name="naam" id="naam"
                   class="form-control @error('naam') is-invalid @enderror"
                   placeholder="Kies een naam" required
                   value="{{ $arrangement->type}}">
            @error('naam')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="beschrijving">Beschrijving</label>
            <input type="text" name="beschrijving" id="beschrijving"
                   class="form-control @error('beschrijving') is-invalid @enderror"
                   placeholder="Geef een beschrijving"  required
                   value="{{ $arrangement->description }}">
            @error('beschrijving')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>


        <div class="row">
            @foreach($arrangement->prices as $price)
                <div class="col-6 col-sm-3">
                    <div class="form-group">

                        <div class="form-group">
                            <label for="prijssoort">@if ($price->occupancy_id == 1)
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
                                @endif</label>
                            <input type="hidden" name="id[]" value="{{$price->id}}">
                            <input type="number" name="amount[]"
                                   class="form-control @error('amount[]') is-invalid @enderror"

                                   placeholder="Prijs" required
                                   value="{{ $price->amount }}">
                            @error('amount[]')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>



                    </div>
                </div>

            @endforeach
        </div>


        <button type="submit" id="submit" class="btn btn-success ">Opslaan</button>
        <a href="/admin/arrangement" class="btn btn-primary mx-1 ">Terug</a>
    </form>
@endsection



