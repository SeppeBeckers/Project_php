@extends('layouts.template')
@section('title', 'Overzicht kamers')

@section('main')
    <h1>Overzicht kamers</h1>
    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th>#</th>
                <th>Kamernr</th>
                <th>Beschrijving</th>
            </tr>
            </thead>
            <tbody>
            @foreach($rooms as $room)
                <tr>
                    <td>{{ $room->id }}</td>
                    <td>{{ $room->room_number }}</td>
                    <td>{{ $room->description }}</td>
                    <td>
                        <form action="/admin/room/{{ $room->id }}" method="post">
                            @method('delete')
                            @csrf
                            <div class="btn-group btn-group-sm">
                                <a href="/admin/room/{{ $room->id }}/edit" class="btn btn-outline-success"
                                   data-toggle="tooltip"
                                   title="Edit {{ $room->room_number }}">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button type="submit" class="btn btn-outline-danger"
                                        data-toggle="tooltip"
                                        title="Verwijder kamer {{ $room->room_number }}">
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
