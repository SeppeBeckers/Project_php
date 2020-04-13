@extends('layouts.template')

@section('title', 'Overzicht arrangement')

@section('main')
    <div class="row">
        <div class="col-12 col-md-8">
            <h1>Overzicht arrangementen</h1>
        </div>
        <div class="col-12 col-md-4 text-right">
            <i class="fas fa-2x fa-info-circle pr-2" id="openHelp"></i>
            <a href="/admin/overview" ><i class="fas fa-2x fa-home text-dark pr-3"></i></a>
        </div>
    </div>
    <div class="mx-4">
        <p class="font-weight-bold">Prijzen per persoon</p>
        <div class="row">
            @foreach($arrangements as $arrangement)
                <div class="col-12 col-xl-6 d-xl-flex align-items-stretch">
                    <div class="card mb-3 border-green">
                        <h3 class="card-header border-bottom bg-white font-weight-bold">{{ $arrangement->type }}</h3>
                        <div class="card-body pb-0 text-center px-xl-2">
                            <p> {{ $arrangement->description}} </p>
                            <div class="row justify-content-center">
                                <div class="text-center table-sm">
                                    <table class="table table-bordered" data-toggle="tooltip" title="Overzicht prijzen {{ $arrangement->type }}">
                                        <thead class="thead-light">
                                            <tr>
                                                <th></th>
                                                <th>Douche </th>
                                                <th>Douche/Bad </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($occupancies as $occupancy)
                                                <tr>
                                                    @if ($occupancy->id ==1)
                                                        <td class="font-weight-bold bg-grey">Single</td>
                                                    @else
                                                        <td class="font-weight-bold bg-grey">Double</td>
                                                    @endif

                                                    @foreach($arrangement->prices as $price)
                                                        @if ($price->type_room_id == 1 && $price->occupancy_id == $occupancy->id)
                                                            <td>€ {{ $price->amount }}</td>
                                                        @endif
                                                        @if ($price->type_room_id == 2 && $price->occupancy_id == $occupancy->id)
                                                            <td>€ {{ $price->amount }}</td>
                                                        @endif
                                                    @endforeach
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <p class="m-0">{{ $arrangement->from_day . ' - ' . $arrangement->until_day }}
                            <a href="/admin/arrangement/{{ $arrangement->id }}/edit" class="btn btn-success ml-3 mb-3"
                            data-toggle="tooltip" title="{{ $arrangement->type }} aanpassen" >Aanpassen</a>
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Overlay text: when you press the info button this will be displayed -->
    <div class="overlay" id="MyDiv">
        <a href="#" class="text-danger" id="closeHelp"><i class="far fa-times-circle"></i></a>
        <div class="content">
            <p>Hier kan je de arrangementen bekijken. Je vindt hier de informatie erover terug en je kan ook bepaalde informatie bewerken zoals de naam, de beschrijving en de prijzen.
                Dit doe je door op de groene knop 'Aanpassen' te klikken.
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

            $('#openHelp').click(function () {
                $('#MyDiv').css('transform', 'scale(1)');
            })
            $('#closeHelp').click(function () {
                $('#MyDiv').css('transform', 'scale(0)');
            })
        })
    </script>
@endsection
