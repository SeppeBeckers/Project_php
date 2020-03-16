@extends('layouts.template')
@section('title', 'Data reservatie')

@section('main')
    <h1>Overzicht reservatie + persoonsgegevens</h1>
    <hr>
    <h3>Overzicht</h3>
    <div class="pl-3">
        <p>Datum: {{"request->aankomstdatum"}}</p>
        <p>Bezetting: </p>
        <p>Verblijfkeuze:</p>
    </div>
    <form action="">
        <h3>Persoonsgegevens:</h3>
        <form>
            <div class="form-row">
                <div class="form-group col-md-5">
                    <label for="naam" >Naam *</label>
                    <input type="text" class="form-control" id="naam" required placeholder="Naam">
                </div>
                <div class="form-group col-md-6">
                    <label for="voornaam">Voornaam *</label>
                    <input required type="text" class="form-control" id="voornaam" placeholder="Voornaam">
                </div>
                <div class="form-group col-1">
                    <label for="geslacht">Geslacht *</label>
                    <select required id="geslacht" name="geslacht" class="form-control">
                        <option value="volvo">Man</option>
                        <option value="saab">Vrouw</option>
                        <option value="fiat">Andere</option>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-8">
                    <label required for="email">Email *</label>
                    <input type="email" class="form-control" id="email" placeholder="Email">
                </div>
                <div class="form-group col-md-4">
                    <label required for="telefoonnummer">Telefoonnummer *</label>
                    <input type="tel" class="form-control" id="telefoonnummer" placeholder="Telefoonnummer">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-10">
                    <label for="adres">Adres</label>
                    <input type="text" class="form-control" id="adres" placeholder="Straat en nummer">
                </div>
                <div class="form-group col-2">
                    <label for="bus">Bus</label>
                    <input type="text" class="form-control" id="bus" placeholder="Bus">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="stad">Stad</label>
                    <input type="text" class="form-control" id="stad">
                </div>
                <div class="form-group col-md-4">
                    <label for="provincie">Provincie</label>
                    <input type="text" id="provincie" class="form-control">
                </div>
                <div class="form-group col-md-2">
                    <label for="postcode">Postcode</label>
                    <input type="text" class="form-control" id="postcode">
                </div>
            </div>
            @guest()
                <p>U dient een voorschot van 10% te betalen</p>
            @else
                <label for="voorschot">Voorschot</label>
                <input type="checkbox" class="form-control" id="voorschot">
            @endguest
            <button type="submit" class="btn btn-success mb-4">Bevestig reservatie</button>

        </form>
    </form>

@endsection
