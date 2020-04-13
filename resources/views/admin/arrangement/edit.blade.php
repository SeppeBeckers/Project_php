@extends('layouts.template')

@section('title', "Aanpassen arrangement: $arrangement->type")

@section('main')
    <h1>Aanpassen arrangement: </h1>
    <h2 class="ml-2 mt-2">{{ $arrangement->type }}</h2>
    <div class="mx-3">
        <form action="/admin/arrangement/{{ $arrangement->id }}" method="post" class="mt-3">
            @method('put')
            @csrf
            <div class="form-group small-input">
                <label for="naam" class="font-weight-bold">Naam:</label>
                <input type="text" name="naam" id="naam"
                       class="form-control  @error('naam') is-invalid @enderror"
                       placeholder="Kies een naam" required
                       value="{{ $arrangement->type}}">
                @error('naam')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="beschrijving" class="font-weight-bold">Beschrijving:</label>
                <textarea name="beschrijving" id="beschrijving" rows="3"
                       class="form-control @error('beschrijving') is-invalid @enderror"
                       placeholder="Geef een beschrijving"  required>{{ $arrangement->description }}
                </textarea>
                @error('beschrijving')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <h3 class="font-weight-bold mt-4">Prijzen (€)</h3>
            <div class="row">
                @foreach($arrangement->prices as $price)
                    <div class="col-12 col-sm-6 col-xl-3">
                        <div class="form-group small-input">
                            <label for="prijssoort" class="font-weight-bold">@if ($price->occupancy_id == 1)
                                    @if ($price->type_room_id == 1)
                                        Single - Douche:
                                    @else
                                        Single - Douche/Bad:
                                    @endif
                                @else
                                    @if ($price->type_room_id == 1)
                                        Double - Douche:
                                    @else
                                        Double - Douche/Bad:
                                    @endif
                                @endif</label>
                            <input type="hidden" name="id[]" value="{{$price->id}}">
                            <input type="number" name="amount[]" id="amount"
                                   class="form-control @error('amount[]') is-invalid @enderror"
                                   placeholder="Prijs" required
                                   value="{{ $price->amount }}">
                            @error('amount[]')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="my-3">
                <button type="submit" id="submit" class="btn btn-success ">Opslaan</button>
                <a href="/admin/arrangement" class="btn btn-primary mx-1 ">Terug</a>
            </div>
        </form>
    </div>
@endsection



