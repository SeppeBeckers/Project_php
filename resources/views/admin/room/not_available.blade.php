@extends('layouts.template')
@section('title', 'Beschikbaarheden kamer')

@section('main')
    @include('shared.alert')
    <div class="row">
        <div class="col-12 col-md-8">
            <h1>Overzicht onbeschikbaarheden kamer {{$room->id}}</h1>
        </div>
        <div class="col-12 col-md-4 text-right">
            <i class="fas fa-2x fa-info-circle pr-2" id="openHelp"></i>
            <a href="/admin/overview" ><i class="fas fa-2x fa-home text-dark pr-3"></i></a>
        </div>
    </div>


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

            {{-- Alle onbeschikbaarheden zien samen met de knoppen --}}
            @foreach($not as $not_available)
                <tr>
                    <td>{{$not_available->starting_date}}</td>
                    <td>{{$not_available->end_date}}</td>
                    <td>
                        <form action="/admin/room/{{ $room->id }}" method="post">
                            @method('not_available')
                            @csrf
                            <div class="btn-group btn-group-sm">
                                <a href="/admin/not_available/{{$not_available->id}}/edit" class="btn btn-outline-secondary"
                                   data-toggle="tooltip"
                                   {{-- Anders is knop raar bezig--}}
                                   @if ($not->count() > 1)
                                   title="Aanpassen onbeschikbaarheid {{$not_available->starting_date}} tot {{$not_available->end_date}}"
                                           @else
                                   title="Aanpassen onbeschikbaarheid"
                                   @endif

                                   data-id="{{ $not_available->id }}">
                                    <i class="fas fa-edit">Bewerken</i>
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



    <p>
        <a href="/admin/room" class="btn btn-primary">
            <i class="fas fa-arrow-left"></i> Terug
        </a>
        <a href="#!" class="btn btn-success" id="btn-create">
            <i class="fas fa-plus-circle mr-1"></i>Onbeschikbaar maken
        </a>
    </p>



    @include('admin.room.modal')

    <!-- Overlay text: when you press the info button this help page will be displayed -->
    <div class="overlay" id="MyDiv">
        <a href="#" class="text-danger" id="closeHelp"><i class="far fa-times-circle"></i></a>
        <div class="content">
            <p>Op deze pagina vindt u alle onbeschikbaarheden terug van de geselecteerde kamer
                <br>
            <p>Als u op de blauwe knop "terug" klikt dan keert u terug naar het overzicht scherm van de kamers,
                <br>
                en als u op de groene knop "Kamer opslaan" kan u de informatie opslaan die u heeft verandert. </p>
            <br>
            <p>Elke onbeschikbaarheid (dus de datums waar deze kamer onbeschikbaar is) heeft een groene knop mmet een potlood erin, als u hier
            op klikt kom u op een bewerkscherm waar u de datums kunt wijzigen of zelfs verwijderen</p>
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
                $('form').attr('action', `/admin/room/{id}`);
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

