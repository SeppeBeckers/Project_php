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
            <p><i class="far fa-calendar-alt fa-2x"></i> Wanneer: {{$roomreservation->starting_date}} tot {{$roomreservation->end_date}} <small>({{$aantaldagen}} nachten)</small></p>
            <p><i class="fas fa-users fa-2x"></i> Met {{$occupancies}} personen</p>

            @if ($verblijfskeuze != null)
                <p><i class="fas fa-utensils fa-2x"></i> Accomodatie: {{$verblijfskeuze->type}}</p>
            @else <p><i class="fas fa-utensils fa-2x"></i> Arrangement: {{$arrangement->type}}</p>
            @endif
            <p>Uw contactgegevens: </p>
            <p class="ml-3">Email: {{$reservation->email}}</p>
            <p class="ml-3">Gsm: {{$reservation->phone_number}}</p>
        </div>

        <img class="img-fluid text-center" src="../assets/enjoy.jpg" alt="">
        <p class="card-footer mb-0">Uw reservatie wordt bevestigd door het betalen van het voorschot dat hier {{$totaleprijs/10}} euro bedraagt.</p>
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

