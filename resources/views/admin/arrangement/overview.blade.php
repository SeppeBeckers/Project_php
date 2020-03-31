@extends('layouts.template')
@section('title', 'Overzicht arrangement')

@section('main')

    <div class="row">
        <div class="col-12 col-md-8">
            <h1>Overzicht arrangementen</h1>
        </div>
        <div class="col-12 col-md-4 text-md-right">
            <button class=" btn btn-dark" id="openHelp">Help mij</button>
        </div>
    </div>
    <div class="mx-4">
        <p class="font-weight-bold">Prijzen per persoon</p>

        @foreach($arrangements as $arrangement)
            <div class="card mb-3 border-green">

                <h3 class="card-header  border-bottom bg-white">
                    <b>Type:</b> {{ $arrangement->type }}
                </h3>
                <div class="card-body pb-0 text-center">
                    <div class="">
                        <div>
                            <p> {{ $arrangement->description}} </p>
                        </div>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-sm-8 col-12">
                            <div class="table-responsive text-center">
                                <table class="table table-bordered table-sm " data-toggle="tooltip" title="Overzicht prijzen {{ $arrangement->type }}">
                                    <thead class="thead-light">
                                    <tr >
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
                                                <td>{{ $price->amount }}</td>
                                            @endif
                                            @if ($price->type_room_id == 2 && $price->occupancy_id == $occupancy->id)
                                                <td>{{ $price->amount }}</td>
                                            @endif
                                        @endforeach

                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                </div>
                                </div>
                                </div>
                                <p class="m-0"><b>Dagen:</b> {{ $arrangement->from_day . ' - ' . $arrangement->until_day }}

                                <a href="/admin/arrangement/{{ $arrangement->id }}/edit" class="btn btn-success ml-5 mb-1 "
                                data-toggle="tooltip"
                                data-id="{{ $arrangement->id }}"
                                title="{{ $arrangement->type }} aanpassen" >Aanpassen</a>
                                </p>
                                </div>
                                </div>
@endforeach

<a href="/admin/overview" class="btn btn-primary mx-1 ">Terug</a>

</div>



    <div class="overlay" id="MyDiv">
        <a href="#" class="text-danger" id="closeHelp">&times;</a>
        <div class="content">
            <p>Hier kan je de arrangementen bekijken. Je vindt hier informatie erover en je kan ook bepaalde informatie bewerken zoals de naam, de beschrijving en de prijzen. Dit doe je door op de groene knop 'Aanpassen' te klikken.
                <br>
            Wil je terug naar het vorig scherm? Klik dan vanonder op de knop 'Terug'.
                </p>
            <p>
            Om dit scherm te sluiten, klik je rechts boven op het kruisje.</p>
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
