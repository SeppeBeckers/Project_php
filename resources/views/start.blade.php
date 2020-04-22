@extends('layouts.template')
@section('title', 'Home')

@section('main')
    <h1 class="hotel-name text-center">Hotel Kempenrust</h1>
    <hr>

    <div class="row justify-content-center">
        <div class="col-xl-11 col-12">
            <p class="text-center">Voor het vak 'PHP project' mochten we een webapplicatie maken voor het hotel <a class="text-success font-weight-bolder" href="https://kempenrust.be/nl/">Kempenrust</a>
                in Kasterlee. Dit was in opdracht van Kristine Mangelschots, zij en haar man zijn de eigenaars van dit hotel.
                <br>
                <br>
                Ons project is een toepassing maken voor online een kamer te kunnen reserveren. Achter de schermen wil ook de hoteleigenaar (de admin) een kamer reserveren en alles errond kunnen beheren.
                Om alles te beheren, kan de admin zich inloggen. Hij is de enige die dat kan. Het is een klein hotel en daarmee is er maar 1 loginaccount.
                Ik som hieronder even op wat de admin met zijn account kan doen:

            </p>
        </div>
        <div class="col-xl-8 col-12">
            <ul class="py-3">
                <li>Kamers reserveren</li>
                <li>Overzicht van alle kamerreservaties in kalendervorm bekijken</li>
                <li>Een bestaande reservatie aanpassen</li>
                <li>Info van alle kamers aanpassen, hier kan een kamer onbeschikbaar gemaakt worden voor een onderhoud of een sluitingsperiode van het hotel</li>
                <li>Arrangementen bekijken en eventueel de naam of prijs ervan veranderen <br> (Een arrangement is een verblijf met een vast aantal dagen en een vaste verblijfskeuze.)</li>
                <li>Facturen raadplegen en aanpassen</li>
            </ul>
        </div>
    </div>

@endsection
@section('script_after')
    <script>
        $(function () {
            $('#footer_names').append(
                kempenrust.names_footer(1,3)

            );
        });


    </script>

@endsection

