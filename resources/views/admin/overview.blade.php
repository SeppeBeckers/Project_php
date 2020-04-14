@extends('layouts.template')

@section('title', 'Bookings')

@section('main')
    <div class="container-fluid ">
        <p>
            <a href="../reservation/book" class="btn btn-outline-success">
                <i class="fas fa-plus-circle mr-1"></i>Maak een nieuwe boeking
            </a>
        </p>
        <div class="row ">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="h1">Overzicht reservaties</div>
                    <div class="panel-body">
                        {!! $calendar->calendar() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script_after')
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>

    {!! $calendar->script() !!}
@endsection
@section('css_after')
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>

@endsection
