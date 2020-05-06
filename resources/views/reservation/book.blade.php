@extends('layouts.template')
@section('title', 'Boek kamer')

@section('main')
    <h1 class="mb-4"></h1>
    <div class="row">
        <div class="col text-left"> <h1>Reserveer een kamer</h1></div>
        <div title="info" class="col text-right"><i class="fas fa-2x fa-info-circle pr-2" id="openHelp"></i></div>
    </div>
    <hr>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="/reservation/data" class="ml-2">

        <div class=" text-left"><h3>Selecteer de data van uw verblijf</h3></div>

        <div class="form-group row ml-3">
            <div class="form-group col-4">
                <label class="font-weight-bolder" for="aankomstdatum">Aankomstdatum:</label>
                <input class="form-control" type="date" min="{{date('Y-m-d')}}" id="aankomstdatum" name="aankomstdatum" required value="{{old ('aankomstdatum')}}">
            </div>
            <div class="form-group col-4">
                <label class="font-weight-bolder" for="vertrekdatum">Vertrekdatum:</label>
                <input class="form-control" type="date" min="{{date('Y-m-d', time() + 86400)}}" id="vertrekdatum" name="vertrekdatum" required value="{{old ('vertrekdatum')}}">
            </div>
        </div>
        <h3>Aantal volwassenen en kinderen (met leeftijd)</h3>
        <div class="form-rom row text-center ml-3">
            <div class="form-group col-2">
                <label class="font-weight-bolder" for="aantal0_3">0-3j:</label>
                <input class="form-control" type="number" min="0" id="aantal0_3" name="aantal0_3" value="0">
            </div>
            <div class="form-group col-2">
                <label class="font-weight-bolder" for="aantal4_8">4-8j:</label>
                <input class="form-control" type="number" min="0" id="aantal4_8" name="aantal4_8"  value="0">
            </div>
            <div class="form-group col-2">
                <label class="font-weight-bolder" for="aantal9_12">9-12j:</label>
                <input class="form-control" type="number" min="0" id="aantal9_12" name="aantal9_12"value="0">
            </div>
            <div class="form-group col-2">
                <label class="font-weight-bolder" for="aantal12+">Volwassenen:</label>
                <input class="form-control" type="number" min="0" id="aantal12" name="aantal12" value="0">
            </div>
        </div>

        <h3>Selecteer het soort kamer</h3>
        @foreach($typerooms as $typeroom)
            <div class="ml-4">
                <input type="radio" id="soortkamer" name="soortkamer" value="{{$typeroom->id}}" required>
                <label for="soortkamer">Kamer met {{$typeroom->type_bath}}, toilet en tv</label><br>
            </div>
        @endforeach

        <h3>Kies uw verblijfkeuze (Of een speciaal arrangement hieronder)   </h3>
        @foreach($accomodationchoices as $accomodationchoice)
        <div class="ml-4">
            <input type="radio" id="verblijfskeuze" name="verblijfskeuze" value="{{ $accomodationchoice->id }}">
            <label for="verblijfskeuze">{{ $accomodationchoice->type  }}</label><br>
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
        <div class="form-group text-center">
            <textarea class="form-control" placeholder="Geef hier uw eventuele extra opmerkingen" rows="4" cols="120" name="comment" form="usrform"></textarea>
        </div>
        <button data-toggle="tooltip" title="naar persoonsgegevens" class="btn btn-success mb-3 pull-right" type="submit">Verder naar persoonsgegevens</button>
        <a data-toggle="tooltip" title="Annuleer" class="float-right btn btn-danger" href="{{ url('/') }}">Annuleer</a>
    </form>
    <div>

    </div>

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

