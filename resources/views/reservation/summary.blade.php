@extends('layouts.template')
@section('title', 'Summary reservation')

@section('main')
    <h1 class="text-center pb-3">Bedankt voor uw reservatie bij hotel Kempenrust!</h1>
    <h2 class="pb-1">Overzicht van uw reservatie:</h2>
    <div class="pl-2">
        <p>Wanneer: {{$roomreservation->starting_date}} - {{$roomreservation->end_date}}</p>
        <p>Met hoeveel: {{$occupancies}} personen</p>
{{--        <p>Verblijfskeuze: {{$verblijfskeuze->type}}</p>--}}
    </div>
    <p></p>
@endsection
