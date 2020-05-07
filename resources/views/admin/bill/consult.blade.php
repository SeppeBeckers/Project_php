

@extends('layouts.template')
@section('title', 'Consult bill')

@section('main')
    <div class="container-fluid">
        <div class="row">

            <div class="col-9">
                <h1>Klant</h1>
                <p><span class="font-weight-bold">Naam:</span> {{$bill->reservation->name}}  {{$bill->reservation->first_name}} <br>
                    <span class="font-weight-bold">Adres:</span> {{$bill->reservation->address}} <br>
                    <span class="font-weight-bold">Email:</span> {{$bill->reservation->email}}
                </p>
            </div>
            <div class="col-3">
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
                <span class="font-weight-bold">Aantal personen:</span> {{$aantal}} <br>

                <span class="font-weight-bold">Kamer:</span> Kamer {{$bill->reservation->roomReservations->first()->Room->room_number}} met {{$bill->reservation->roomReservations->first()->Room->first()->TypeRoom->type_bath}}
                <br>

                <span class="font-weight-bold">Verblijfskeuze:</span>  {{$bill->reservation->roomReservations->first()->Room->TypeRoom->Prices->first()->AccommodationChoice->type}}
                <br>      @if ($price->arrangement_id == null)
                @else
                    <span class="font-weight-bold">Arrangement:</span> {{$arrangement->description}}

                @endif

            </p>

            <p>
                @if($bill->Reservation->with_deposit == 1)
                    <span class="font-weight-bold">Voorschot:</span>  <i class="fas fa-check"></i>  € {{$voorschot}} <br>
                @else
                    <span class="font-weight-bold">Voorschot:</span> <i class="fas fa-times"></i> <br>
                @endif
                    @if($korting != 0)
                    <span class="font-weight-bold">Kinderkorting:</span> <i class="fas fa-check"></i>  <br>
                @else()
                    <span class="font-weight-bold">Kinderkorting :</span> <i class="fas fa-times"></i>  <br>
                @endif
                    @foreach( $bill->reservation->people as $Person )
                        @if($Person->number_of_persons == 0 or $Person->age_id == 4 )
                        @else()
                            <span class="font-weight-bold">Toegepaste kinderkorting:</span> {{$Person->Age->age_category}} <br>
                        @endif
                    @endforeach
                <span class="font-weight-bold">Prijs per dag:</span> €{{$verblijfsgetal}}
                <br>

                    Rekening gemaakt op {{$bill->bill_made_at}}
            </p>

        </div>



            <div class="h4">
                @if ($price->arrangement_id == null)
                    <span class="font-weight-bold">Totaal:</span> € {{$totaal}}
                @else
                    <span class="font-weight-bold">Totaal:</span> € {{$totaal}}
                @endif


                @if($bill->adjusted_amount != 0 && $bill->adjusted_amount != $bill->billCosts->first()->amount)
                    <div > <span class="font-weight-bold">Totaal met extra kosten: </span> € {{$bill->adjusted_amount}}</div>
                @else()
                @endif</div>




            <div class="div m-3">
                <a href="/admin/reservation/{{ $bill->reservation->id }}/edit" class="btn btn-primary mx-1 "><i class="fas fa-arrow-left"></i>Terug</a>
                <a href="/admin/bill/{{$bill->reservation_id}}/edit" class="btn btn-secondary">
                    <i class="fas fa-edit"></i>Aanpassen
                </a>
            </div>

    </div>

@endsection

@section('script_after')
    <script>
        $(function () {
            $('#footer_names').append(
                kempenrust.names_footer(2,4)

            );
        });


    </script>

@endsection
@section('css_after')

    <style>
        @media (min-width: 750px) {
            .container-sm{
                width: 55%!important;

            }
            .footer{
                position: fixed;
                left: 0;
                bottom: 0;
                width: 100%;

            }
        }

    </style>

@endsection

