@extends('layouts.template')
@section('title', 'Data reservatie')

@section('main')
    <h1>Overzicht reservatie + persoonsgegevens</h1>
    <hr>
    <h3>Overzicht</h3>
    <div class="pl-3">
        <p>Datum: {{$aankomstdatum}} tot {{$vertrekdatum}}</p>
        <p>Bezetting:</p>
        <div class="col-7">
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
    </div>
    <form action="/reservation/summary">
        <h3>Persoonsgegevens:</h3>
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
            <label for="comment" ></label>
            <input type="text" name="comment" id="comment"  hidden value="{{$comment}}">

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
                        <option value="man">Man</option>
                        <option value="vrouw">Vrouw</option>
                        <option value="anders">Andere</option>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-8">
                    <label required for="email">Email *</label>
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
                <input type="checkbox" class="form-control" name="voorschot" id="voorschot">
            @endguest
            <button type="submit" class="btn btn-success mb-4">Bevestig reservatie</button>
    </form>

@endsection
