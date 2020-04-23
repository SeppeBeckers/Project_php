@extends('layouts.template')

@section('title', "Aanpassen arrangement")

@section('main')
    <div class="row">
        <div class="col-8">
            <h1>Aanpassen arrangement: {{ $arrangement->type }} </h1>
        </div>
        <div class="col-4 text-right">
            <i class="fas fa-2x fa-info-circle pr-2" id="openHelp" data-toggle="tooltip" title="Extra informatie"></i>
            <a href="/admin/overview" ><i class="fas fa-2x fa-home text-dark pr-3" data-toggle="tooltip" title="Naar overzicht reservaties"></i></a>
        </div>
    </div>

    <div class="mx-3">
        <form action="/admin/arrangement/{{ $arrangement->id }}" method="post" class="mt-3">
            @method('put')
            @csrf
            <div class="form-group small-input">
                <label for="naam" class="font-weight-bold">Naam:</label>
                <input type="text" name="naam" id="naam"
                       class="form-control  @error('naam') is-invalid @enderror"
                       placeholder="Kies een naam" required data-toggle="tooltip" title="Naam arrangement"
                       value="{{ $arrangement->type}}">
                @error('naam')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="beschrijving" class="font-weight-bold">Beschrijving:</label>
                <textarea name="beschrijving" id="beschrijving" rows="3"
                       class="form-control @error('beschrijving') is-invalid @enderror"
                       placeholder="Geef een beschrijving" required data-toggle="tooltip" title="Beschrijving van een arrangement">{{ $arrangement->description }}</textarea>
                @error('beschrijving')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <h3 class="font-weight-bold mt-4">Prijzen per persoon (€)</h3>
            <div class="row">

                <?php $index = 1; ?>
                @foreach($arrangement->prices as $price)
                    <div class="col-12 col-sm-6 col-xl-3">
                        <div class="form-group small-input">
                            <label for="amount{{ $index }}">
                                @if ($price->occupancy_id == 1)
                                    Kamer met {{$price->typeRoom->type_bath}} <br> 1 persoon
                                @else
                                    Kamer met {{$price->typeRoom->type_bath}} <br> 2 personen
                                @endif
                              </label>
                            <input type="number" name="amount{{ $index }}" id="amount{{ $index }}"
                                   class="form-control @error('amount' . $index ) is-invalid @enderror"
                                   placeholder="Prijs" required data-toggle="tooltip" title="Prijs"
                                   value="{{ $price->amount }}">
                            <input type="hidden" name="id_{{ $index }}" value="{{$price->id}}">
                            @error('amount' . $index )
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                        <?php $index ++; ?>
                @endforeach

            </div>
            <div class="mt-xl-4 mt-3 ml-3">
                <a href="/admin/arrangement" class="btn btn-primary mx-1" data-toggle="tooltip" title="Terug naar het overzicht"><i class="fas fa-arrow-left"></i> Terug</a>
                <button type="submit" id="submit" class="btn btn-success" data-toggle="tooltip" title="Veranderingen opslaan"><i class="fas fa-plus-circle mr-1"></i>Opslaan</button>

            </div>
        </form>
    </div>


    <!-- Overlay text: when you press the info button this help page will be displayed -->
    <div class="overlay" id="MyDiv">
        <a href="#" class="text-danger" id="closeHelp"><i class="far fa-times-circle"></i></a>
        <div class="content">
            <p>Hier kan je een arrangement aanpassen. Je kan de naam, de beschrijving en de prijzen aanpassen.
                Ben je klaar? Klik dan op de groene knop 'opslaan' vanonder op de pagina.
                <br>
                <br>
                Wil je terug naar het hoofdscherm? Klik dan op het huisje rechts vanboven.
            </p>
            <p>Om dit scherm te sluiten, klik je rechts boven op het kruisje.</p>
        </div>
    </div>
@endsection

@section('script_after')
    <script>
        $(function () {
            $('#footer_names').append(
                kempenrust.names_footer(4,2)

            );
        });


    </script>

@endsection





