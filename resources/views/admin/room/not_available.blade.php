@extends('layouts.template')
@section('title', 'Beschikbaarheden kamer')

@section('main')
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

            {{-- Alle onbeschikbaarheden alten zien plus knoppen --}}
            @foreach($not as $not_available)
                <tr>
                    <td>{{$not_available->starting_date}}</td>
                    <td>{{$not_available->end_date}}</td>
                    <td data-id="{{$not_available->id}}"
                        data-starting_date="{{$not_available->starting_date}}"
                        data-end_date="{{$not_available->end_date}}">
                            @method('delete')
                            @csrf
                            <div class="btn-group btn-group-sm">
                                <button class="btn btn-outline-success btn-edit"
                                   data-toggle="tooltip"
                                   title="Bewerk onbeschikbaarheid ">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-outline-danger btn-delete"
                                        data-toggle="tooltip"
                                        title="Verwijder onbeschikbaarheid ">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
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
            {{-- Verwijderknop --}}
            $('tbody').on('click','.btn-delete',  function () {
                // Get data attributes from td tag
                let id = $(this).closest('td').data('id');
                let starting_date = $(this).closest('td').data('starting_date');
                let end_date = $(this).closest('td').data('end_date');
                // Set some values for Noty
                let text = `<p>Verwijder  de datums van: <b>${starting_date}</b> en tot: <b>${end_date}</b>?</p>`;
                let type = 'warning';
                let btnText = 'Verwijder datums';
                let btnClass = 'btn-success';

                // Show Noty
                let modal = new Noty({
                    timeout: false,
                    layout: 'center',
                    modal: true,
                    type: type,
                    text: text,
                    buttons: [
                        Noty.button(btnText, `btn ${btnClass}`, function () {
                            // Delete datum and close modal
                            deleteDate(id);
                            modal.close();
                        }),
                        Noty.button('Annuleer', 'btn btn-secondary ml-2', function () {
                            modal.close();
                        })
                    ]
                }).show();
            });

            {{-- Bewerkknop --}}
            $('tbody').on('click', '.btn-edit', function () {
                // Get data attributes from td tag
                let id = $(this).closest('td').data('id');
                let starting_date = $(this).closest('td').data('starting_date');
                let end_date = $(this).closest('td').data('end_date');
                // Update the modal
                $('.modal-title').text(`Bewerk onbeschikbaarheid van ${starting_date} tot: ${end_date}`);
                $('form').attr('action', `/admin/room/{{$room->id}}/not_available`);
                $('#starting_date').val(starting_date);
                $('input[starting_date="_method"]').val('put');
                $('#end_date').val(end_date);
                $('input[end_date="_method"]').val('put');
                // Show the modal
                $('#modal-not').modal('show');
            });

            {{-- Bewerken --}}
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

            {{-- Aanmaken --}}
            $('#btn-create').click(function () {
                // Update the modal
                $('.modal-title').text(`Kamer onbeschikbaar maken`);
                $('form').attr('action', `/admin/room/{{$room->id}}/not_available`);
                $('#starting_date').val('');
                $('input[starting_date="_method"]').val('post');
                $('#end_date').val('');
                $('input[end_date="_method"]').val('post');
                // Show the modal
                $('#modal-not').modal('show');
            });

        });

        // Delete a genre
        function deleteDate() {
            // Delete the genre from the database
            let pars = {
                '_token': '{{ csrf_token() }}',
                '_method': 'delete',
            };
            $.post(`/admin/room/{{$room->id}}/not_available`, pars, 'json')
                .done(function (data) {
                    console.log('data', data);
                    // Show toast
                    new Noty({
                        type: data.type,
                        text: data.text
                    }).show();
                })
                .fail(function (e) {
                    console.log('error', e);
                });
        }
    </script>
@endsection

