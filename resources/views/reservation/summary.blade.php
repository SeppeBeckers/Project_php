@extends('layouts.template')
@section('title', 'Summary reservation')

@section('main')
    <h1 class="text-center pb-3">Bedankt voor uw reservatie bij hotel Kempenrust!</h1>
    <h2>Overzicht van uw reservatie:</h2>
    <div class="card">
        <div class="row card-header">
            <div class="col text-left"><h2>Reservatie op naam: <span class="font-weight-bold">{{$reservation->name}}</span></h2></div>
            <div class="col text-right">Uw prijs: <span class="font-weight-bold">€ {{$totaleprijs}}</span></div>
        </div>
        <div class="pl-2 card-body">
            <p><i class="far fa-calendar-alt fa-2x"></i> Wanneer: {{$roomreservation->starting_date}} tot {{$roomreservation->end_date}} <small>({{$aantaldagen}} @if ($aantaldagen>1)nachten) @else nacht @endif</small></p>
            <p><i class="fas fa-users fa-2x"></i> Met {{$occupancies}} @if ($occupancies >1)personen @else persoon @endif in kamer {{$kamer->room_number}}</p>
            @if ($verblijfskeuze != null)
                <p><i class="fas fa-utensils fa-2x"></i> Accomodatie: {{$verblijfskeuze->type}}</p>
            @else <p><i class="fas fa-utensils fa-2x"></i> Arrangement: {{$arrangement->type}}</p>
            @endif
            <p>Uw contactgegevens: </p>
            <p class="ml-3">Email: {{$reservation->email}}</p>
            <p class="ml-3">Gsm: {{$reservation->phone_number}}</p>
        </div>

        <img class="img-fluid text-center" src="../assets/enjoy.jpg" alt="">
{{--        <div class="row card-footer mb-0">--}}
{{--            <div class="col-8 text-left"><p>Uw reservatie wordt bevestigd door het betalen van het voorschot dat hier {{$totaleprijs/10}} euro bedraagt</p></div>--}}
{{--            <div class="col-4 text-right"><a href="#">Home</a></div>--}}
{{--        </div>--}}
        <div class="card-footer row pb-0">
            <div class="col-8 text-left">
                @if ($reservation->with_deposit == 1)
                <p>Uw reservatie wordt bevestigd door het betalen van het voorschot dat hier {{$totaleprijs/10}} euro bedraagt</p>
                @else
                <p>Er dient geen voorschot betaald te worden.</p>
                @endif
            </div>
            <div class="col-4 text-right">
                <p><a href="{{ url('/') }}"><i class="fas fa-home"></i> Home</a></p>
            </div>
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

