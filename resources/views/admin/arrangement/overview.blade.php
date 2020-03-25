@extends('layouts.template')
@section('title', 'Overzicht arrangement')

@section('main')
    <h1>Overzicht arrangementen</h1>
    <div class="mx-4">
        <p class="font-weight-bold">Prijzen per persoon</p>

        @foreach($arrangements as $arrangement)
            <div class="card mb-3 border border-success">

                <h3 class="card-header bg-lightgreen">
                    <b>Type:</b> {{ $arrangement->type }}
                </h3>
                <div class="card-body pb-0 text-center">
                    <div class="">
                        <div>
                            <p> {{ $arrangement->description}} </p>
                        </div>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-sm-8 col-12">
                            <div class="table-responsive text-center">
                                <table class="table table-bordered bg-lightgreen table-sm" data-toggle="tooltip" title="Overzicht prijzen {{ $arrangement->type }}">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th>Douche </th>
                                        <th>Douche/Bad </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($occupancies as $occupancy)
                                    <tr>
                                    @if ($occupancy->id ==1)
                                        <td>Single</td>
                                    @else
                                        <td>Double</td>
                                    @endif
                                        @foreach($arrangement->prices as $price)
                                            @if ($price->type_room_id == 1 && $price->occupancy_id == $occupancy->id)
                                                <td>{{ $price->amount }}</td>
                                            @endif
                                            @if ($price->type_room_id == 2 && $price->occupancy_id == $occupancy->id)
                                                <td>{{ $price->amount }}</td>
                                            @endif
                                        @endforeach

                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                </div>
                                </div>
                                </div>
                                <p class="m-0"><b>Dagen:</b> {{ $arrangement->from_day . ' - ' . $arrangement->until_day }}

                                <a href="/admin/arrangement/{{ $arrangement->id }}/edit" class="btn btn-success ml-5 mb-1 "
                                data-toggle="tooltip"
                                data-id="{{ $arrangement->id }}"
                                title="{{ $arrangement->type }} aanpassen" >Aanpassen</a>
                                </p>
                                </div>
                                </div>
@endforeach

<a href="/admin/overview" class="btn btn-primary mx-1 ">Terug</a>
</div>





@endsection
