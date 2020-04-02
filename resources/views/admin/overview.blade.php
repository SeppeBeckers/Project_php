@extends('layouts.template')

@section('title', 'Bookings')


@section('main')
    <h1>Overzicht boekingen</h1>
    <p>
        <a href="../reservation/book" class="btn btn-outline-success">
            <i class="fas fa-plus-circle mr-1"></i>Maak een nieuwe boeking
        </a>
    </p>
    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th>Room ID</th>
                <th>Start datum</th>
                <th>Eind datum</th>
                <th>Naam</th>
                <th>Voorschot</th>
            </tr>
            </thead>
            <tbody>
            @foreach($Reservation as $reservation)
                <tr>
                    <td>{{ $reservation->room_id }}</td>
                    <td>{{ $reservation->starting_date }}</td>
                    <td>{{ $reservation->end_date }}</td>
                    <td>{{ $reservation->Reservation->name }}</td>
                    @if($reservation->Reservation->with_deposit == 1)
                        <td><i class="fas fa-check"></i></td>
                    @else
                        <td></td>
                    @endif

                    <td>
                        <form action="" method="post">
                            @method('delete')
                            @csrf
                            <div class="btn-group btn-group-sm">
                                <a href="reservation" class="btn btn-outline-success"
                                   data-toggle="tooltip"
                                   title="Edit {{$reservation->Reservation->name}}">
                                    <i class="fas fa-edit">Edit</i>
                                </a>
                                <button type="submit" class="btn btn-outline-danger"
                                        data-toggle="tooltip"
                                        title="Delete {{$reservation->Reservation->name}}">
                                    <i class="fas fa-trash-alt">Verwijder</i>
                                </button>
                                <a href="/admin/bill/{{$reservation->reservation_id}}" class="btn btn-outline-success"
                                   data-toggle="tooltip"
                                   title="Edit {{$reservation->Reservation->name}}">
                                    <i class="fas fa-edit">Edit</i>
                                </a>
                            </div>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
