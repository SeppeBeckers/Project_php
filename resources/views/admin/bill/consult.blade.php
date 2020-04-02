@extends('layouts.template')
@section('title', 'Consult bill')

@section('main')
    <div class="container-fluid">
        <div class="row">
    <div class="col-10">
        <h1>Klant</h1>
        <p><span class="font-weight-bold">Naam:</span> {{$Bill->reservation->name}}  {{$Bill->Reservation->first_name}} <br>
            <span class="font-weight-bold">Adres:</span> {{$Bill->reservation->address}} <br>
            <span class="font-weight-bold">Email:</span> {{$Bill->reservation->email}}
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
          <p> <span class="font-weight-bold">Verblijfsduur:</span>  {{$Bill->reservation->roomReservations->first()->starting_date}} tot en met {{$Bill->reservation->roomReservations->first()->end_date}}
              <br>
            <span class="font-weight-bold">Aantal personen:</span> {{$Bill->reservation->people->first()->number_of_persons}} <br>
            @foreach( $Bill->reservation->people as $Person )
                @if($Person->Age->percentage_discount == 0)
                @else()
                    <span class="font-weight-bold">Toegepaste kinderkorting:</span> {{$Person->Age->age_category}} <br>
                    @endif
                    @endforeach
            <span class="font-weight-bold">Kamer:</span> Kamer {{$Bill->reservation->roomReservations->first()->Room->room_number}} met {{$Bill->reservation->roomReservations->first()->Room->first()->TypeRoom->type_bath}}
              <br>
             <span class="font-weight-bold">Verblijfskeuze:</span>  {{$Bill->reservation->roomReservations->first()->Room->TypeRoom->Prices->first()->AccommodationChoice->type}}
              <br>
          </p>
            <p>
            @if($Bill->Reservation->with_deposit == 1)
               <span class="font-weight-bold">Voorschot:</span>  <i class="fas fa-check"></i> <br>
            @else
                  <span class="font-weight-bold">Voorschot:</span> <i class="fas fa-times"></i> <br>
                @endif
                <span class="font-weight-bold">Prijs voor verblijf:</span> €{{$Bill->reservation->roomReservations->first()->Room->TypeRoom->Prices->first()->price}}
                <br>
            @if($Person->Age->percentage_discount == 0)
            @else()
                <span class="font-weight-bold">Prijs met kinderkorting:</span> €{{$EindPrijs}} <br>
                @endif
                <span class="font-weight-bold">BTW:</span> {{$Bill->vat}}%
           </p>
        </div>




<div class="row">

    <div class="col-10">Rekening gemaakt op {{$Bill->bill_made_at}} </div>
    <div class="col-2 h3"> <span class="font-weight-bold">Totaal:</span> €{{$EindPrijs}}</div>

</div>
        <p>
            <a href="/admin/bill/{{$Bill->reservation_id}}/edit" class="btn btn-outline-success">
                <i class="fa fa-eur"></i>Aanpassen
            </a>
        </p>



</div>

@endsection

