@extends('layouts.template')
@section('title', 'Overzicht kamers')

@section('main')
    <style>

    </style>
    <h1>Overzicht kamers</h1>
    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th>Foto</th>
                <th>Kamernr</th>
                <th>Beschrijving</th>
                <th>Beschikbaar?</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($rooms as $room)
                <tr>
                    <td><img src="{{ $room->picture }}" alt="foto van kamer {{ $room->room_number }} "></td>
                    <td>{{ $room->room_number }}</td>
                    <td style="white-space:pre-wrap; word-wrap:break-word"> {{ $room->description }}
 @if ($room -> maximum_persons == 1)
{{$room->maximum_persons}} persoon
     @else
{{$room->maximum_persons}} personen
 @endif</td>
                    <td>
                        @foreach($not_availables as $not_available)
                            @if ($not_available->room_id === $room->room_number)
                                @if ($standard_date >  $not_available->starting_date && $standard_date < $not_available->end_date || $not_available == null)
                                    <i class="fas fa-times"></i>
                                @else
                                    <i class="fas fa-check"></i>
                                @endif
                            @endif
                        @endforeach
                            @if ($not_available->room_id != $room->room_number)
                                <i class="fas fa-check"></i>
                                @endif

                    </td>
                   <td>
                       <form action="/admin/room/{{ $room->id }}" method="post">
                           @method('edit')
                           @csrf
                           <div class="btn-group btn-group-sm">
                               <a href="/admin/room/{{ $room->id }}/not_available" class="btn btn-outline-success"
                                  data-toggle="tooltip"
                                  title="Bekijk onbeschikbaarheden van kamer {{ $room->room_number }}">
                                   <i class="fas fa-edit"> Onbeschikbaarheden</i>
                               </a>
                           </div>
                       </form>
                   </td>
                    <td>
                        <form action="/admin/room/{{ $room->id }}" method="post">
                            @method('edit')
                            @csrf
                            <div class="btn-group btn-group-sm">
                                <a href="/admin/room/{{ $room->id }}/edit" class="btn btn-outline-success"
                                   data-toggle="tooltip"
                                   title="Bewerk kamer {{ $room->room_number }}">
                                    <i class="fas fa-edit"> Bewerken</i>
                                </a>
                            </div>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="col-sm-3 mb-3">
        <button type="submit" class="btn btn-danger btn-block">Alle kamers onbeschikbaar maken</button>
    </div>
@endsection
