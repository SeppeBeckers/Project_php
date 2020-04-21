@extends('layouts.template')

@section('title', 'Verander kamer')

@section('main')
    <div class="row">
        <div class="col-12 text-right">
            <i class="fas fa-2x fa-info-circle pr-2" id="openHelp"></i>
            <a href="/admin/overview" ><i class="fas fa-2x fa-home text-dark pr-3"></i></a>
        </div>
        <div class="col-12">
            <h1>Verander datums</h1>
        </div>
    </div>
    <form action="/admin/not_available/{{ $not_available->id }}" method="post">
        @method('put')
        @csrf

        <div class="form-group my-5 ">
            <div class="form-row justify-content-center">
            <label for="starting_date">Van: </label>
                <div class="col-6" style="margin-left: 10px;">
                    <input type="date" name="starting_date" id="starting_date"
                        class="form-control"
                        placeholder="Starting_date"
                        minlength=" "
                        required
                        value="{{$not_available->starting_date}}">
                    @error('starting_date')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <br>
            <div class="form-row justify-content-center">
                <label for="end_date">Tot: </label>
                <div class="col-6" style="margin-left: 12px;">
                <input type="date" name="end_date" id="end_date"
                   class="form-control"
                   placeholder="end_date"
                   minlength=" "
                   required
                   value="{{$not_available->end_date}}">
                </div>
                @error('end_date')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="div m-3">
            <a href="/admin/room/{{$not_available->room_id}}" class="btn btn-primary">
                <i class="fas fa-arrow-left"></i> Terug
            </a>
            <button type="submit"  class="btn btn-success">
                <i class="fas fa-plus-circle mr-1"></i>opslaan
            </button>
            <a href="#!" class="btn btn-danger" id="deleteDate">
                <i class="fas fa-trash mr-1"></i>Verwijderen
            </a>
        </div>
    </form>

    <!-- Overlay text: when you press the info button this help page will be displayed -->
    <div class="overlay" id="MyDiv">
        <a href="#" class="text-danger" id="closeHelp"><i class="far fa-times-circle"></i></a>
        <div class="content">
            <p>Dit is de pagina waar u de datums kan veranderen van de onbeschikbaarheid (dus de datums waar deze kamer onbeschikbaar is).
                <br>
            <p>Als u op de blauwe knop "terug" klikt dan keert u terug naar het overzichtsscherm van de onbeschikbaarheden van de geselecteerde kamer,
                <br>
                door op de groene knop "opslaan" te klikken slaat u de 2 datums op van deze onbeschikbaarheid,
                <br>
                als u op de rode knop "verwijderen" klikt dan verwijdert u deze onbeschikbaarheden.
                 </p>
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
        $('#deleteDate').click(function () {
            let id = '{{$not_available->id}}';
            let starting_date = '{{$not_available->starting_date}}';
            let end_date = '{{$not_available->end_date}}';
            let text = `<p>Verwijder  de datums van: <b>${starting_date}</b> en tot: <b>${end_date}</b>?</p>`;
            console.log(`verwijder onbeschikbaarheid met id: ${id}`);
            // Show Noty
            let modal = new Noty({
                timeout: false,
                layout: 'center',
                modal: true,
                type: 'warning',
                text: text,
                buttons: [
                    Noty.button('Verwijder', 'btn btn-danger', function () {
                        // Verwijder datum
                        let pars = {
                            '_token': '{{ csrf_token() }}',
                            '_method': 'delete'
                        };
                        $.post(`/admin/not_available/${id}`, pars, 'json')
                            .done(function (data) {
                                console.log('data', data);
                                // Show toast
                                new Noty({
                                    type: data.type,
                                    text: data.text
                                }).show();
                                // After 2 seconds, redirect to the public master page
                                setTimeout(function () {
                                    $(location).attr('href', '/admin/room/{{$not_available->room_id}}');
                                }, 2000);
                            })
                            .fail(function (e) {
                                console.log('error', e);
                            });
                        modal.close();
                    }),
                    Noty.button('Annuleer', 'btn btn-secondary ml-2', function () {
                        modal.close();
                    })
                ]
            }).show();
        });

    </script>
@endsection
@section('css_after')

    <style>
        @media (min-width: 750px) {
            .container-sm{
                width: 30%!important;

            }
        }

    </style>

@endsection