@extends('layouts.template')
@section('title', 'Beschikbaarheden kamer')

@section('main')
    @include('shared.alert')
    <h1>Overzicht onbeschikbaarheden kamer {{$room->id}}</h1>
    <p>
        <a href="#!" class="btn btn-outline-success" id="btn-create">
            <i class="fas fa-plus-circle mr-1"></i>Onbeschikbaar maken
        </a>
    </p>
    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th>Van</th>
                <th>Tot</th>
                <th></th>
            </tr>
            </thead>
            <tbody>

            {{-- Alle onbeschikbaarheden zien plus knoppen --}}
            @foreach($not as $not_available)
                <tr>
                    <td>{{$not_available->starting_date}}</td>
                    <td>{{$not_available->end_date}}</td>
                    <td>
                        <form action="/admin/room/{{ $room->id }}" method="post">
                            @method('not_available')
                            @csrf
                            <div class="btn-group btn-group-sm">
                                <a href="/admin/not_available/{{$not_available->id}}/edit" class="btn btn-outline-success"
                                   data-toggle="tooltip" data-id="{{ $not_available->id }}"
                                   title="Aanpassen onbeschikbaarheid van">
                                    <i class="fas fa-edit"></i>
                                </a>

                            </div>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Als kamer geen onbeschikbaarheden heeft --}}
    @if ($not->count() == 0)
        <div class="alert alert-warning alert-dismissible fade show">
           Er zijn geen onbeschikbaarheden gevonden
        </div>
    @endif

    @include('admin.room.modal')
@endsection

@section('script_after')
    <script>
        $(function () {

            //form oproepen
            $('#modal-not form').submit(function (e) {
                // Don't submit the form
                e.preventDefault();
                // Get the action property (the URL to submit)
                let action = $(this).attr('action');
                // Serialize the form and send it as a parameter with the post
                let pars = $(this).serialize();
                console.log(pars);
                // Post the data to the URL
                $.post(action, pars, 'json')
                    .done(function (data) {
                        console.log(data);
                        // Noty success message
                        new Noty({
                            type: data.type,
                            text: data.text
                        }).show();
                        // Hide the modal
                        $('#modal-not').modal('hide');
                        setTimeout(function () {
                            $(location).attr('href', '/admin/room/{{$room->id}}');
                        }, 2000);
                    })
                    .fail(function (e) {
                        console.log('error', e);
                        // e.responseJSON.errors contains an array of all the validation errors
                        console.log('error message', e.responseJSON.errors);
                        // Loop over the e.responseJSON.errors array and create an ul list with all the error messages
                        let msg = '<ul>';
                        $.each(e.responseJSON.errors, function (key, value) {
                            msg += `<li>${value}</li>`;
                        });
                        msg += '</ul>';
                        // Noty the errors
                        new Noty({
                            type: 'error',
                            text: msg
                        }).show();
                    });
            });


            //Aanmaken
            $('#btn-create').click(function () {
                // Update the modal
                $('.modal-title').text(`Kamer onbeschikbaar maken`);
                $('form').attr('action', `/admin/room`);
                $('#id').val('{{$room->id}}');
                $('input[id="_method"]').val('post');
                $('#starting_date').val('');
                $('input[starting_date="_method"]').val('post');
                $('#end_date').val('');
                $('input[end_date="_method"]').val('post');
                // Show the modal
                $('#modal-not').modal('show');
            });

        });


    </script>
@endsection

