@extends('layouts.template')

@section('title', 'Bookings')

@section('main')
    <h1>Overzicht boekingen</h1>
    @include('shared.alert')
    <p>
        <a href="../reservation/book" class="btn btn-outline-success">
            <i class="fas fa-plus-circle mr-1"></i>Maak een nieuwe boeking
        </a>
    </p>
    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th>Kamer ID</th>
                <th>Start datum</th>
                <th>Eind datum</th>
                <th>Naam</th>
                <th>Voorschot</th>
                <th>Acties</th>

            </tr>
            </thead>
            <tbody>

            @foreach($room_reservations as $room_reservation)
                <tr>
                    @foreach($reservations as $reservation)
                        @if ($reservation->id == $room_reservation->reservation_id)
                            <td>{{ $room_reservation->room_id }}</td>
                            <td>{{ $room_reservation->starting_date }}</td>
                            <td>{{ $room_reservation->end_date }}</td>
                            <td>{{ $reservation->name }}</td>
                            @if($reservation->with_deposit == 1)
                                <td><i class="fas fa-check"></i></td>
                            @else
                                <td></td>
                            @endif
                            <td>
                                <form action="/admin/overview/{{$reservation->id}}" method="post" class="deleteForm" id="deleteForm{{ $reservation->id }}"
                                      data-id="{{ $reservation->id }}">
                                    @csrf
                                    @method('delete')
                                    <div class="btn-group btn-group-sm">
                                        <a href="/admin/reservation/{{$reservation->id}}/edit" class="btn btn-outline-success"
                                           data-toggle="tooltip" data-id="{{ $reservation->id }}"
                                           title="Aanpassen reservatie van {{$reservation->name}}">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button" class="btn btn-outline-danger"
                                                data-toggle="tooltip" data-id="{{ $reservation->id }}" data-name="{{ $reservation->name }}"
                                                title="Verwijder reservatie van {{$reservation->name}}">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                        <a href="/admin/bill/{{$reservation->id}}" class="btn btn-outline-success"
                                           data-toggle="tooltip"
                                           title="Edit {{$reservation->name}}">
                                            <i class="fas fa-edit">Edit</i>
                                        </a>
                                    </div>
                                </form>
                            </td>
                        @endif

                    @endforeach



                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
