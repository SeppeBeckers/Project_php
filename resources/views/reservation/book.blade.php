@extends('layouts.template')
@section('title', 'Boek kamer')

@section('main')
    <h1 class="mb-4">Reserveer een kamer</h1>
    <form action="/reservation/data" class="ml-2">
        <div class="row">
            <div class="col text-left"><h3>Selecteer de data van uw verblijf</h3></div>
            <div title="info" class="col text-right"><i class="fas fa-2x fa-info-circle pr-2" id="openHelp"></i></div>
        </div>
        <div class="row ml-4">
            <div class="col-5">
                <label for="aankomstdatum">Aankomstdatum:</label>
                <input class=" {{ $errors->first('aankomstdatum') ? 'is-invalid' : '' }}" required type="date" min="{{date('Y-m-d')}}" id="aankomstdatum" name="aankomstdatum">
                <div class="invalid-feedback">{{ $errors->first('aankomstdatum') }}</div>
            </div>
            <div class="col-5">
                <label for="vertrekdatum">Vertrekdatum:</label>
                <input required type="date" min="{{date('Y-m-d', time() + 86400)}}" id="vertrekdatum" name="vertrekdatum">
            </div>
        </div>
        <h3>Aantal volwassenen en kinderen (met leeftijd)</h3>
        <div class="form-rom small-input row text-center ml-4">
            <div class="">
                <label for="aantal0_3">0-3j:</label>
                <input type="number" min="0" id="aantal0_3" name="aantal0_3" value="0">
            </div>
            <div class="">
                <label for="aantal4_8">4-8j:</label>
                <input type="number" min="0" id="aantal4_8" name="aantal4_8" value="0">
            </div>
            <div class="">
                <label for="aantal9_12">9-12j:</label>
                <input type="number" min="0" id="aantal9_12" name="aantal9_12" value="0">
            </div>
            <div class="">
                <label for="aantal12+">Volwassenen:</label>
                <input type="number" min="0" id="aantal12" name="aantal12" value="0">
            </div>
        </div>
        <div class="row ml-4">
            <input class="mr-1" type="checkbox" name="samenopkamer" id="samenopkamer">
            <label for="samenopkamer"> Duid dit aan als je allemaal op 1 kamer wil.</label>
        </div>

        <h3>Selecteer het soort kamer</h3>
        @foreach($typerooms as $typeroom)
            <div class="ml-4">
                <input type="radio" id="bad" name="soortkamer" value="{{$typeroom->id}}">
                <label required for="bad">Kamer met {{$typeroom->type_bath}}, toilet en tv</label><br>
            </div>
        @endforeach

        <h3>Kies uw verblijfkeuze</h3>
        @foreach($accomodationchoices as $accomodationchoice)
        <div class="ml-4">
            <input type="radio" id="douche" name="verblijfskeuze" value="{{ $accomodationchoice->id }}">
            <label required for="douche">{{ $accomodationchoice->type  }}</label><br>
        </div>
        @endforeach

        <h3>Speciale arrangementen</h3>
        @foreach ($arrangements as $arrangement)
        <div class="ml-4">
            <input type="radio" id="arrangement" name="arrangement" value="{{ $arrangement->id }}">
            <label for="arrangement">{{ $arrangement->type }}</label><br>
            <p>{{ $arrangement->description }}</p>
        </div>
        @endforeach

        {{--extra opmerkingen--}}
        <div class="text-center">
            <textarea placeholder="Geef hier uw eventuele extra opmerkingen" rows="4" cols="120" name="comment" form="usrform"></textarea>
        </div>
        <button title="naar persoonsgegevens" class="btn btn-success mb-3 pull-right" type="submit">Verder naar persoonsgegevens</button>
    </form>


    <div class="overlay" id="MyDiv">
        <a href="#" class="text-danger" id="closeHelp"><i class="far fa-times-circle"></i></a>
        <div class="content">
            <p>Dit is de eerste pagina van de twee om een reservatie te maken. Hierin geef je alle gegevens over het verblijf zelf in.
                <br>
                <br>
                Als deze allemaal ingevuld zijn ga je verder door op de knop "Verder naar persoonsgegevens" te drukken onderaan.
            </p>
            <p>Om dit scherm te sluiten, klik je rechts boven op het kruisje.</p>
        </div>
    </div>

@endsection

@section('script_after')
    <script>
        $(function () {
            $('#footer_names').append(
                kempenrust.names_footer(4,1)

            );
        });


    </script>

@endsection

