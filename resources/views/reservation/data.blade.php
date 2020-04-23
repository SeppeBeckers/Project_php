@extends('layouts.template')
@section('title', 'Data reservatie')

@section('main')
    <div class="row">
        <div class="col text-left"> <h1>Overzicht reservatie en persoonsgegevens</h1></div>
        <div title="info" class="col text-right"><i class="fas fa-2x fa-info-circle pr-2" id="openHelp"></i></div>
    </div>

    <hr>
    <h3>Overzicht</h3>
    <div class="pl-3">
        <p>Datum: {{$aankomstdatum}} tot {{$vertrekdatum}}</p>
        <div class="row">
            <div class="col-7">
                <p>Bezetting:</p>
                <table class="table  table-sm table-bordered">
                    <tr>
                        <td width="10%">Aantal 0 tot 3j</td>
                        <td width="10%">Aantal 4 tot 8j</td>
                        <td width="10%">Aantal 9 tot 12j</td>
                        <td width="10%">Aantal volwassenen</td>
                    </tr>
                    <tr>
                        <td width="10%">{{$aantal0_3}}</td>
                        <td width="10%">{{$aantal4_8}}</td>
                        <td width="10%">{{$aantal9_12}}</td>
                        <td width="10%">{{$aantal12}}</td>
                    </tr>
                </table>
            </div>
            <div class="col-5 text-center">
                <p>Uw prijs:</p>
        @foreach($prijzen as $prijs)
            <p>€{{$prijs->amount}} per persoon @if ($prijs->occupancy_id == 2)
                    (double bezetting) @elseif($prijs->occupancy_id == 1)
                    (single bezetting)
            @endif</p>
        @endforeach
            </div>
        </div>
    </div>

    <form action="/reservation/summary">

            {{--Hidden velden van vorige pagina--}}
            <label for="aankomstdatum" ></label>
            <input type="text"  name="aankomstdatum" id="aankomstdatum"  hidden value="{{$aankomstdatum}}">
            <label for="vertrekdatum" ></label>
            <input type="text" name="vertrekdatum" id="vertrekdatum"  hidden value="{{$vertrekdatum}}">
            <label for="aantal0_3" ></label>
            <input type="text" name="aantal0_3" id="aantal0_3"  hidden value="{{$aantal0_3}}">
            <label for="aantal4_8" ></label>
            <input type="text" name="aantal4_8" id="aantal4_8"  hidden value="{{$aantal4_8}}">
            <label for="aantal9_12" ></label>
            <input type="text" name="aantal9_12" id="aantal9_12"  hidden value="{{$aantal9_12}}">
            <label for="aantal12" ></label>
            <input type="text" name="aantal12" id="aantal12"  hidden value="{{$aantal12}}">
            <label for="soortkamer" ></label>
            <input type="text" name="soortkamer" id="soortkamer"  hidden value="{{$soortkamer}}">
            <label for="verblijfskeuze" ></label>
            <input type="text" name="verblijfskeuze" id="verblijfskeuze"  hidden value="{{$verblijfskeuze}}">
            <label for="arrangement" ></label>
            <input type="text" name="arrangement" id="arrangement"  hidden value="{{$arrangement}}">
            <label for="comment" ></label>
            <input type="text" name="comment" id="comment"  hidden value="{{$comment}}">

        <h3>Kies hier uw kamer(s)</h3>
            <div class="card-columns">
                @foreach($rooms as $room)
                    <div>
                        <div class="card">

                            <p class="card-header">Kamer {{$room->room_number}}</p>
                            <p>Beschrijving: {{$room->description}}</p>
                            <p>max personen: {{$room->maximum_persons}}</p>
                            <p>Type badkamer: @if ($room->type_room_id == 1)
                                Douche @else Bad/douche
                            @endif</p>
                            <input type="radio" id="room" name="room" value="{{$room->id}}">
                            <label for="room">Ik wil deze kamer</label>
                        </div>
                    </div>
                @endforeach
            </div>
        <h3>Persoonsgegevens:</h3>
            <div class="form-row">
                <div class="form-group col-md-5">
                    <label for="naam" >Naam *</label>
                    <input type="text" class="form-control" name="naam" id="naam" value="" required placeholder="Naam">
                </div>
                <div class="form-group col-md-6">
                    <label for="voornaam">Voornaam *</label>
                    <input required type="text" class="form-control" name="voornaam" id="voornaam" placeholder="Voornaam">
                </div>
                <div class="form-group col-1">
                    <label for="geslacht">Geslacht *</label>
                    <select required id="geslacht" name="geslacht" class="form-control">
                        <option value="Male">Man</option>
                        <option value="Female">Vrouw</option>
                        <option value="Other">Andere</option>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-8">
                    <label required for="email">E-mail *</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Email">
                </div>
                <div class="form-group col-md-4">
                    <label required for="telefoonnummer">Telefoonnummer *</label>
                    <input type="tel" class="form-control" name="telefoonnummer" id="telefoonnummer" placeholder="Telefoonnummer">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-10">
                    <label for="adres">Adres</label>
                    <input type="text" class="form-control" name="adres" id="adres" placeholder="Straat en nummer">
                </div>
                <div class="form-group col-2">
                    <label for="bus">Bus</label>
                    <input type="text" class="form-control" name="bus" id="bus" placeholder="Bus">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="stad">Stad</label>
                    <input type="text" class="form-control" name="stad" id="stad">
                </div>
                <div class="form-group col-md-4">
                    <label for="provincie">Provincie</label>
                    <input type="text" name="provincie" id="provincie" class="form-control">
                </div>
                <div class="form-group col-md-2">
                    <label for="postcode">Postcode</label>
                    <input type="text" class="form-control" name="postcode" id="postcode">
                </div>
            </div>
            @guest()
                <p>U dient een voorschot van 10% te betalen</p>

            @else
                <label for="voorschot">Voorschot</label>
                <input type="checkbox" class="form-control" name="voorschot" id="voorschot" checked>
            @endguest
            <button title="bevesig" type="submit" class="btn btn-success mb-4">Bevestig reservatie</button>
    </form>
    <div class="overlay" id="MyDiv">
        <a href="#" class="text-danger" id="closeHelp"><i class="far fa-times-circle"></i></a>
        <div class="content">
            <p>Dit is de tweede pagina van de twee om een reservatie te maken. Hierin geef je alle persoongegevens in en kies je de kamer die je wilt.
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

