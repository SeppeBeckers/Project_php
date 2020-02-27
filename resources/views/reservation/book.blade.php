@extends('layouts.template')
@section('title', 'Boek kamer')

@section('main')
    <h1>Reserveer een kamer</h1>
    <form action="">
        <h3>Selecteer de data van uw verblijf</h3>
        <div class="row">
            <div class="col">
                <label for="aankomstdatum">Aankomstdatum:</label>
                <input type="date" id="aankomstdatum" name="aankomstdatum">
            </div>
            <div class="col">
            <label for="vertrekdatum">Vertrekdatum:</label>
            <input type="date" id="vertrekdatum" name="vertrekdatum">
            </div>
        </div>
        <h3>Aantal volwassenen en kinderen (met leeftijd)</h3>
        <div class="row">
            <div class="col">
                <label for="aantal0_3">0-3j:</label>
                <input type="number" id="aantal0_3" name="aantal0_3">
            </div>
            <div class="col">
                <label for="aantal4_8">4-8j:</label>
                <input type="number" id="aantal4_8" name="aantal4_8">
            </div>
            <div class="col">
                <label for="aantal9_12">9-12j:</label>
                <input type="number" id="aantal9_12" name="aantal9_12">
            </div>
            <div class="col">
                <label for="aantal12+">12+j:</label>
                <input type="number" id="aantal12" name="aantal12">
            </div>
        </div>

        <h3>Selecteer het soort kamer</h3>
        <div class="row">
            <input type="radio" id="bad" name="soortkamer" value="bad">
            <label for="bad">Kamer met bad/douche, toilet en tv</label><br>
            <input type="radio" id="douche" name="soortkamer" value="douche">
            <label for="douche">Kamer met douche, toilet en tv</label><br>
        </div>

        <h3>Kies uw verblijfkeuze</h3>
        <input type="radio" id="douche" name="verblijfskeuze" value="douche">
        <label for="douche">Kamer met ontbijt</label><br>

        <input type="radio" id="douche" name="verblijfskeuze" value="douche">
        <label for="douche">Halfpension (3 gangen)</label><br>

        <input type="radio" id="douche" name="verblijfskeuze" value="douche">
        <label for="douche">Halfpension (4 gangen)</label><br>

        <input type="radio" id="douche" name="verblijfskeuze" value="douche">
        <label for="douche">Volpension (3 gangen)</label><br>

        <h3>Speciale arrangementen</h3>
        <input type="radio" id="douche" name="verblijfskeuze" value="kortweekend">
        <label for="douche">Kort weekend</label><br>
        <p>Eén overnachting met ontbijt, één 4-gangenmenu  (zaterdagnamiddag tot zondagmorgen)</p>

        <input type="radio" id="douche" name="verblijfskeuze" value="langweekend">
        <label for="douche">Lang weekend</label><br>
        <p>Twee overnachtingen met ontbijt, één 3-gangenmenu op vrijdag, één viergangenmenu op zaterdag (vrijdagmiddag tot zondagmorgen)</p>

        <input type="radio" id="douche" name="verblijfskeuze" value="fietsweekend">
        <label for="douche">Fietsweekend</label><br>
        <p>Twee overnachtingen met ontbijt, één 4-gangenmenu, één 3-gangenmenu en twee lunchpakketten (vrijdagnamiddag tot zondagmorgen)</p>

        <input type="radio" id="douche" name="verblijfskeuze" value="midweek">
        <label for="douche">Midweek</label><br>
        <p>Vier overnachtingen met ontbijt, één 4-gangenmenu en drie 3-gangenmenu's(van maandag tot vrijdag)</p>

        {{--extra opmerkingen--}}
        <textarea placeholder="Geef hier uw eventuele extra opmerkingen" rows="4" cols="50" name="comment" form="usrform"></textarea>
    </form>
@endsection
