@extends('layouts.template')

@section('title', 'Bookings')


@section('main')
    <h1>Genres</h1>
    <p>
        <a href="/admin/genres/create" class="btn btn-outline-success">
            <i class="fas fa-plus-circle mr-1"></i>Create new genre
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
            </tr>
            </thead>
            <tbody>
            @foreach($room_reservations as $reservation)
                <tr>
                    <td>{{ $reservation->room_id }}</td>
                    <td>{{ $reservation->starting_date }}</td>
                    <td>{{ $reservation->end_date }}</td>
                    <td>{{ $reservation->name }}</td>
                    <td>
                        <form action="" method="post">
                            @method('delete')
                            @csrf
                            <div class="btn-group btn-group-sm">
                                <a href="" class="btn btn-outline-success"
                                   data-toggle="tooltip"
                                   title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button type="submit" class="btn btn-outline-danger"
                                        data-toggle="tooltip"
                                        title="Delete">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
