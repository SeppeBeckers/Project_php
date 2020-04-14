@extends('layouts.template')
@section('title', 'Consult bill')

@section('main')
    <div class="container-fluid">
        <div class="row">

            <div class="col-10">
                <h1>Klant</h1>
                <p><span class="font-weight-bold">Naam:</span> {{$bill->reservation->name}}  {{$bill->reservation->first_name}} <br>
                    <span class="font-weight-bold">Adres:</span> {{$bill->reservation->address}} <br>
                    <span class="font-weight-bold">Email:</span> {{$bill->reservation->email}}
                </p>
            </div>
            <div class="col-2">
                <p>Hotel Kempenrust <br>
                    Geelsebaan 51 <br>
                    2460 Kasterlee <br>
                    Tel : 014/85.04.53 <br>
                    Fax: 014/85.33.26
                </p>
            </div>
        </div>

        <div>
            <h2>Overzicht Verblijf</h2>

            <p> <span class="font-weight-bold">Verblijfsduur:</span>  {{$bill->reservation->roomReservations->first()->starting_date}} tot en met {{$bill->reservation->roomReservations->first()->end_date}}
                <br>
                <span class="font-weight-bold">Aantal personen:</span> {{$bill->reservation->people->first()->number_of_persons}} <br>
                @foreach( $bill->reservation->people as $Person )
                    @if($Person->Age->percentage_discount == 0)
                    @else()
                        <span class="font-weight-bold">Toegepaste kinderkorting:</span> {{$Person->Age->age_category}} <br>
                    @endif
                @endforeach
                <span class="font-weight-bold">Kamer:</span> Kamer {{$bill->reservation->roomReservations->first()->Room->room_number}} met {{$bill->reservation->roomReservations->first()->Room->first()->TypeRoom->type_bath}}
                <br>

                <span class="font-weight-bold">Verblijfskeuze:</span>  {{$bill->reservation->roomReservations->first()->Room->TypeRoom->Prices->first()->AccommodationChoice->type}}
                <br>
            </p>
            <p>
                @if($bill->Reservation->with_deposit == 1)
                    <span class="font-weight-bold">Voorschot:</span>  <i class="fas fa-check"></i> <br>
                @else
                    <span class="font-weight-bold">Voorschot:</span> <i class="fas fa-times"></i> <br>
                @endif
                <span class="font-weight-bold">Prijs voor verblijf:</span> €{{$bill->reservation->roomReservations->first()->Room->TypeRoom->Prices->first()->amount}}
                <br>
                @if($Person->Age->percentage_discount == 0)
                @else()
                    <span class="font-weight-bold">Prijs met kinderkorting:</span> €{{$bill->billCosts->first()->amount}} <br>
                @endif
            </p>

        </div>

        <div class="row">

            <div class="col-8">Rekening gemaakt op {{$bill->bill_made_at}} </div>
            <div class="col-4 h4"> <span class="font-weight-bold">Totaal:</span> €{{$bill->billCosts->first()->amount}}
                @if($bill->adjusted_amount != 0 && $bill->adjusted_amount != $bill->billCosts->first()->amount)
                    <div > <span class="font-weight-bold">Totaal met extra kosten: </span> €{{$bill->adjusted_amount}}</div>
                @else()
                @endif</div>


    <div class="col-8">Rekening gemaakt op {{$bill->bill_made_at}} </div>
    <div class="col-4 h4"> <span class="font-weight-bold">Totaal:</span> €{{$bill->billCosts->first()->amount}}
        @if($bill->adjusted_amount != 0 && $bill->adjusted_amount != $bill->billCosts->first()->amount)
            <div > <span class="font-weight-bold">Totaal met extra kosten: </span> €{{$bill->adjusted_amount}}</div>
        @else()
        @endif</div>



            <a href="/admin/bill/{{$bill->reservation_id}}/edit" class="btn btn-outline-success">
                <i class="fa fa-eur"></i>Aanpassen
            </a>
            </p>






</div>



        </div>

@endsection
