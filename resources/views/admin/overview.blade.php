@extends('layouts.template')

@section('title', 'Bookings')

@section('main')
    <div class="row mb-2">
        <div class="col-12 col-md-8">
            <h1>Overzicht reservaties</h1>
        </div>
        <div class="col-12 col-md-4 text-right">
            <a href="../reservation/book" class="btn btn-outline-secondary">
                <i class="fas fa-plus-circle mr-1"></i>Maak een nieuwe boeking
            </a>
        </div>
    </div>

    @include('shared.alert')

    <div class="row">
        <div class="col-12 ">
            <div class="panel panel-default">
                <div class="panel-body bg-white">
                    {!! $calendar->calendar() !!}
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script_after')

    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/lang/nl.js"></script>
    <script >
        $(function () {
            $('#footer_names').append(
                kempenrust.names_footer(2,4)

            );
        });

        </script>



    {!! $calendar->script() !!}


@endsection
@section('css_after')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>
@endsection
