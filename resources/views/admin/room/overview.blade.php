@extends('layouts.template')
@section('title', 'Overzicht kamers')

@section('main')
    @include('shared.alert')
    <div class="row">
        <div class="col-12 col-md-8">
            <h1>Overzicht kamers</h1>
        </div>
        <div class="col-12 col-md-4 text-right">
            <i class="fas fa-2x fa-info-circle pr-2" id="openHelp"></i>
            <a href="/admin/overview" ><i class="fas fa-2x fa-home text-dark pr-3"></i></a>
        </div>
    </div>
    <p>
        <a href="#!" class="btn btn-outline-primary" id="btn-create">
            <i class="fas fa-plus-circle mr-1"></i>Kamers onbeschikbaar maken
        </a>
    </p>

    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th class="text-center">selecteer alles <br><input type="checkbox" name="select-all" id="select-all"></th>
                <th class="align-top">Foto</th>
                <th class="align-top">Kamernr</th>
                <th class="align-top">Beschrijving</th>
                <th class="align-top">Beschikbaar?</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($rooms as $room)
                <tr>
                    <td class="text-center"><input class="kamer_checkbox" type="checkbox" name="kamer_checkbox[]" value="{{$room->id}}"></td>
                    <td><img src="{{ $room->picture }}" alt="foto van kamer {{ $room->room_number }} "></td>
                    <td>{{ $room->room_number }}</td>
                    <td style="white-space:pre-wrap; word-wrap:break-word"> {{ $room->description }}
 @if ($room -> maximum_persons == 1)
{{$room->maximum_persons}} persoon
     @else
{{$room->maximum_persons}} personen
 @endif
</td>

                    <td>
                        <!--Als kamer beschikbaar is of geen onbeschikbaarheden heeft (checkmark), kamer is onbeschikbaar (kruisje) -->
                        @foreach($not_availables as $not_available)
                            @if ($not_available->room_id === $room->id && $standard_date >=  $not_available->starting_date && $standard_date <= $not_available->end_date)
                                    <i class="fas fa-times"></i>
                                @break
                                @elseif ($not_available ->where('room_id', $room->id)->count() === 0 || $not_available->room_id === $room->id)
                                    <i class="fas fa-check"></i>
                                @break
                                @endif
                        @endforeach
                    </td>

                    <td>
                        <form action="/admin/room/{{ $room->id }}" method="post">
                            @method('not_available')
                            @csrf
                            <div class="btn-group btn-group-sm">
                                <a href="/admin/room/{{ $room->id }}" class="btn btn-outline-primary"
                                   data-toggle="tooltip"
                                   title="Bekijk onbeschikbaarheden van kamer {{ $room->room_number }}">
                                    <i class="fas fa-eye"> Onbeschikbaarheden</i>
                                </a>
                            </div>
                        </form>
                    </td>


                    <td>
                        <form action="/admin/room/{{ $room->id }}" method="post">
                            @method('edit')
                            @csrf
                            <div class="btn-group btn-group-sm">
                                <a href="/admin/room/{{ $room->id }}/edit" class="btn btn-outline-secondary"
                                   data-toggle="tooltip" data-placement="top"
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
    @include('admin.room.modal')

    <!-- Overlay text: when you press the info button this help page will be displayed -->
    <div class="overlay" id="MyDiv">
        <a href="#" class="text-danger" id="closeHelp"><i class="far fa-times-circle"></i></a>
        <div class="content">
            <p>Hier kan u alle kamers bekijken en de informatie die erbij hoort zoals: de beschrijving van de kamer en of de kamer beschikbaar is.
                <br>
                <p>Als u linksboven op de knop "Alle kamers onbeschikbaar maken" klikt dan krijgt u een klein schermpje te zien waarmee u de geselecteerde kamers tegelijkertijd
                onbeschikbaar kunt maken. U kunt kamers selecteren door links van de foto op het vierkantje te klikken of je kunt ze allemaal selecteren door op het vierkantje rechtonder "selecteer alles" te klikken</p>
                <br>
                <p>Bij elke kamer staan er 2 knoppen: een knop "onbeschikbaarheden" en een knop "bewerken", als u op de eerste knop klikt dan krijgt u een overzicht van de onbeschikbaarheden (dus de datums waar deze kamer onbeschikbaar is).
                    Als u op de tweede knop klikt dan kan u de informatie van de kamer veranderen. </p>
                <br>
            <p>
                Wilt u terug naar het hoofdscherm? Klik dan op het huisje rechts vanboven.
            </p>
            <p>Om dit scherm te sluiten, klikt u rechts boven op het kruisje.</p>
        </div>
    </div>

@endsection
@section('script_after')
    <script>
        $(function () {
            $('#footer_names').append(
                kempenrust.names_footer(4,2)

            );
        });


    </script>


<script>

        $('#select-all').click(function () {
            $('input:checkbox').prop('checked', this.checked);
        });

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
                        $(location).attr('href', '/admin/room');
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
            // get all check checkboxes
            let room_id_array = [];
            $(".kamer_checkbox:checked").each(function () {
                room_id_array.push($(this).val());
            });
            // Update the modal
            $('.modal-title').text(`Alle kamers onbeschikbaar maken`);
            $('form').attr('action', `/admin/room`);
            $('#id').val(room_id_array);
            $('input[id="_method"]').val('post');
            $('#starting_date').val('');
            $('input[starting_date="_method"]').val('post');
            $('#end_date').val('');
            $('input[end_date="_method"]').val('post');
            // Show the modal
            $('#modal-not').modal('show');
            $('[data-toggle="tooltip"]').tooltip('hide');
        });

    </script>
@stop

