@extends('layouts.template')
@section('title', 'Summary reservation')

@section('main')
    <h1 class="text-center pb-3">Bedankt voor uw reservatie bij hotel Kempenrust!</h1>
    <h2 class="pb-1">Overzicht van uw reservatie:</h2>

    <div class="col-8 pl-2">
        <p>Wanneer: {{$roomreservation->starting_date}} tot {{$roomreservation->end_date}} <small>({{$aantaldagen}} nachten)</small></p>
        <p>Met {{$occupancies}} personen</p>
        @if ($verblijfskeuze != null)
            <p>Accomodatie: {{$verblijfskeuze->type}}</p>
            @else <p>Arrangement: {{$arrangement->type}}</p>
        @endif
    <p>Uw prijs: €
    @if ($arrangement != null)
        {{$tebetalen = $prijs->amount * $occupancies}}
    @else {{$tebetalen = $prijs->amount*$aantaldagen * $occupancies}}
    @endif
    </p>
    <p>Uw reservatie wordt bevestigd door het betalen van het voorschot dat hier {{$tebetalen/10}} euro bedraagt.</p>
    </div>
    <div class="col-4">
        <img src="../assets/kamer1.jpg" alt="">
    </div>
@endsection
