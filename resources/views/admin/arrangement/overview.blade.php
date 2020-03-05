@extends('layouts.template')
@section('title', 'Overview arrangement')

@section('main')
    <hr>
    <p class="text-center">- - - - - -  - Under construction - - - - - -  -<br> Hard gecodeerd. Nog geen arrangementen in database.</p>
    <hr>
    <h1>Arrangementen</h1>
    <h2>Overzicht</h2>
    <div class="ml-4">
        <p class="font-weight-bold">Prijzen per persoon</p>
        <!-- kort weekend -->
        <div class="custom-control custom-radio">
            <input type="radio" id="customRadio1" name="customRadio" class="custom-control-input">
            <label class="custom-control-label" for="customRadio1"><h4>Kort weekend</h4></label>
        </div>

        <div class="px-5">
            <p>Eén overnachting met ontbijt, één 4-gangenmenu (zaterdagnamiddag tot zondagmorgen).</p>
            <div class="col-8">

                <table class="table table-bordered table-sm">
                    <thead>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">Douche</th>
                        <th scope="col">Douche/bad</th>
                        <th scope="col">Verblijfskeuze</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th scope="row">Single</th>
                        <td>87,00€</td>
                        <td>89,50€</td>
                        <td>?</td>
                    </tr>
                    <tr>
                        <th scope="row">Double</th>
                        <td>74,50€</td>
                        <td>76,00€</td>
                        <td>?</td>
                    </tr>
                    </tbody>
                </table>

            </div>
        </div>
        <!-- lang weekend -->
        <div class="custom-control custom-radio">
            <input type="radio" id="customRadio2" name="customRadio" class="custom-control-input">
            <label class="custom-control-label" for="customRadio2"><h4>Lang weekend</h4></label>
        </div>

        <div class="px-5">
            <p>Twee overnachtingen met ontbijt, één 3-gangenmenu op vrijdag, één 4-gangenmenu op zaterdag(vrijdagnamiddag tot zondagmorgen).</p>
            <div class="col-8">
                <table class="table table-bordered table-sm">
                    <thead>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">Douche</th>
                        <th scope="col">Douche/bad</th>
                        <th scope="col">Verblijfskeuze</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th scope="row">Single</th>
                        <td>161,00€</td>
                        <td>166,00€</td>
                        <td>?</td>
                    </tr>
                    <tr>
                        <th scope="row">Double</th>
                        <td>136,00€</td>
                        <td>139,00€</td>
                        <td>?</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- fietsweekend -->
        <div class="custom-control custom-radio">
            <input type="radio" id="customRadio3" name="customRadio" class="custom-control-input">
            <label class="custom-control-label" for="customRadio3"><h4>Fietsweekend</h4></label>
        </div>

        <div class="px-5">
            <p>Twee overnachtingen met ontbijt, één 4-gangenmenu, één 3-gangenmenu en twee lunchpakketten (vrijdagnamiddag tot zondagmorgen).</p>
            <div class="col-8">
                <table class="table table-bordered table-sm">
                    <thead>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">Douche</th>
                        <th scope="col">Douche/bad</th>
                        <th scope="col">Verblijfskeuze</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th scope="row">Single</th>
                        <td>181,00€</td>
                        <td>186,00€</td>
                        <td>?</td>
                    </tr>
                    <tr>
                        <th scope="row">Double</th>
                        <td>156,00€</td>
                        <td>159,00€</td>
                        <td>?</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- midweek -->
        <div class="custom-control custom-radio">
            <input type="radio" id="customRadio4" name="customRadio" class="custom-control-input">
            <label class="custom-control-label" for="customRadio4"><h4>Midweek</h4></label>
        </div>

        <div class="px-5">
            <p>Vier overnachtingen met ontbijt, één 4-gangenmenu en drie 3-gangenmenu's (van maandag tot vrijdag).</p>
            <div class="col-8">
                <table class="table table-bordered table-sm">
                    <thead>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">Douche</th>
                        <th scope="col">Douche/bad</th>
                        <th scope="col">Verblijfskeuze</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th scope="row">Single</th>
                        <td>309,00€</td>
                        <td>319,00€</td>
                        <td>?</td>
                    </tr>
                    <tr>
                        <th scope="row">Double</th>
                        <td>259,00€</td>
                        <td>265,00€</td>
                        <td>?</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <a href="/admin/arrangement/edit" class="btn btn-success m-3">Bewerken</a>
    </div>
@endsection
