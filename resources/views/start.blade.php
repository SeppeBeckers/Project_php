@extends('layouts.template')
@section('title', 'Overview')

@section('main')
    <h1>Hotel Kempenrust</h1>
    <hr>
    <div class="text-body2 py-4">
    <p>Voor het vak 'PHP project' mochten we een webapplicatie maken voor het hotel <a class="text-success font-weight-bolder" href="https://kempenrust.be/nl/">Kempenrust</a>
        in Kasterlee. Dit was in opdracht van Kristine Mangelschots, zij en haar man zijn de eigenaars van dit hotel.
        <br>
        <br>
    Ons project is een toepassing maken voor online een kamer te kunnen reserveren. Achter de schermen wil ook de hoteleigenaar (de admin) een kamer reserveren en alles errond kunnen beheren.
        Om alles te beheren kan de admin zich inloggen, hij is de enige die dat kan. Het is een klein hotel en daarmee is er maar 1 loginaccount.
        Ik som hieronder even op wat de admin met zijn account kan doen:

    </p>
    <ul class="py-3">
        <li>Kamers reserveren</li>
        <li>Overzicht van alle kamerreservaties in kalendervorm bekijken</li>
        <li>Een bestaande reservatie aanpassen</li>
        <li>Info van alle kamers aanpassen, hier kan een kamer onbeschikbaar gemaakt worden voor een onderhoud of een sluitingsperiode van het hotel</li>
        <li>Arrangementen bekijken en eventueel de naam of prijs ervan veranderen <br> (Een arrangement is een verblijf met een vast aantal dagen en een vaste verblijfskeuze.)</li>
        <li>Facturen raadplegen, aanpassen en afdrukken</li>
    </ul>


    </div>
@endsection
