@extends('layouts.template')
@section('title', 'Overview arrangement')

@section('main')
    <h1>Overzicht arrangementen</h1>
    <div class="mx-4">
        <p class="font-weight-bold">Prijzen per persoon</p>

        @foreach($arrangements as $arrangement)
            <div class="card mb-3 border border-success">

                <h3 class="card-header bg-lightgreen">
                    <b>Type:</b> {{ $arrangement->type }}
                </h3>

                <div class="card-body">
                    <div class="d-flex">
                        <div>
                            <p class="text-center"> {{ $arrangement->description}} </p>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered bg-lightgreen table-sm">
                            <thead>
                            <tr>
                                <th></th>
                                <th>Douche </th>
                                <th>Douche/Bad </th>

                            </tr>
                            </thead>
                            <tbody>

                            @foreach($arrangement->prices as $price)

                                    <tr>
                                    <td>{{ $price->occupancy_id }}</td>
                                    @if ($price->type_room_id == 1)
                                        <td>{{$price->amount}}</td>
                                        <td><p>-</p></td>
                                    @else
                                        <td><p>-</p></td>
                                        <td>{{$price->amount}}</td>

                                    @endif


                                    </tr>

                            @endforeach
                            </tbody>
                        </table>
                        <b>Dagen:</b> {{ $arrangement->from_day . ' - ' . $arrangement->until_day }}
                    </div>
                </div>

                    <form action="/admin/arrangements/{{ $arrangement->id }}" method="post"
                          data-id="{{ $arrangement->id }}">
                        @csrf
                        <a href="/admin/arrangement/{{ $arrangement->id }}/edit" class="btn btn-success ml-5 mb-3"
                           data-toggle="tooltip"
                           data-id="{{ $arrangement->id }}"
                           title="{{ $arrangement->type }} aanpassen" >Aanpassen</a>
                    </form>

            </div>
        @endforeach

    <a href="/admin/overview" class="btn btn-primary mx-1 ">Terug</a>
    </div>

@endsection

@section('script_after')
    <script>
        $(function () {

            $('.deleteForm button').click(function () {
                let id = $(this).data('id');
                let name_type = $(this).data('type');
                // Set some values for Noty
                let text = `<p>Delete the arrangement <b>${name_type}</b>?</p>`;
                let type = 'warning';
                let btnText = 'Delete arrangement';
                // Show Noty
                let modal = new Noty({
                    timeout: false,
                    layout: 'center',
                    modal: true,
                    type: type,
                    text: text,
                    buttons: [
                        Noty.button(btnText, 'btn btn-success', function () {
                            // Delete arrangement and close modal
                            modal.close();
                            $(`#deleteForm${id}`).submit();
                        }),
                        Noty.button('Cancel', 'btn btn-secondary ml-2', function () {
                            modal.close();
                        })
                    ]
                }).show();
            });

        });
    </script>
@endsection