@extends('layouts.template')

@section('title', 'Reservatie')

@section('main')

<h1>Overzicht reservatie</h1>
@include('shared.alert')

<div class="row">
    <div class="col-12 col-md-6">
    <h2>Gegevens verblijvers</h2>
    </div>
    <div class="col-12 col-md-6 text-md-right">
        <a href="/admin/bill" class="btn btn-primary mx-1 ">Factuur raadplegen</a>

    </div>
</div>

<div class="row m-2 justify-content-center">
    <form action="/admin/reservation/{{ $reservation->id }}" method="post">
        @method('put')
        @csrf
        <div class="row">
            <div class="col-7">
                <div class="row">
                    <div class="col-6 my-2">
                        <label for="name">Naam:</label>
                        <input type="text" name="name" id="name"
                               class="form-control @error('name') is-invalid @enderror"
                               placeholder="Naam" required
                               value="{{ $reservation->name }}">
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-6 my-2">
                        <label for="first_name">Voornaam:</label>
                        <input type="text" name="first_name" id="first_name"
                               class="form-control @error('first_name') is-invalid @enderror"
                               placeholder="Voornaam" required
                               value="{{ $reservation->first_name }}">
                        @error('first_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-6 my-2">
                        <label for="email">Email:</label>
                        <input type="email" name="email" id="email"
                               class="form-control @error('email') is-invalid @enderror"
                               placeholder="Email" required
                               value="{{ $reservation->email }}">
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-6 my-2">
                        <label for="telefoonnummer">Telefoonnummer:</label>
                        <input type="text" name="telefoonnummer" id="telefoonnummer"
                               class="form-control @error('telefoonnummer') is-invalid @enderror"
                               placeholder="Telefoonnummer" required
                               value="{{ $reservation->phone_number }}">
                        @error('telefoonnummer')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                </div>
            </div>
            <div class="col-5 my-2">
                <label for="message">Opmerking:</label>
                <textarea name="message" id="message" rows="5"
                          class="form-control" text-left>
                    {{ $reservation->message }}
                </textarea>
            </div>
        </div>

        <div class="row">
            <div class="col-12 font-weight-bold">
                <p>Aantal personen</p>
            </div>
            <div class="col-md-2 col-3 mb-2">
                <label for="age1">0 - 3 jaar:</label>
                <input type="text" class="form-control" id="age"
                       @error('age') is-invalid @enderror
                       placeholder="0"
                       value=""
                       required>
            </div>

            <div class="col-md-2 col-3 my-2">
                <label for="age2">4 - 8 jaar:</label>
                <input type="text" class="form-control" id="age"
                       @error('age') is-invalid @enderror
                       placeholder="0"
                       value=""
                       required>
            </div>
            <div class="col-md-2 col-3 my-2">
                <label for="age3">9 - 12 jaar:</label>
                <input type="text" class="form-control" id="age"
                       @error('age') is-invalid @enderror
                       placeholder="0"
                       value=""
                       required>
            </div>
            <div class="col-md-2 col-3 my-2">
                <label for="age4">Volwassenen:</label>
                <input type="text" class="form-control" id="age"
                       @error('age') is-invalid @enderror
                       placeholder="2"
                       value=""
                       required>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2 col-4 my-2">

                <!--
                <label for="room_number">Kamernummer:</label>
                <select class="form-control" name="room_number" id="room_number">
                    <option value="{{ $reservation->id }}">{{ $reservation->id }}</option>
                    @foreach($rooms as $room)
                        <option value="{{ $room->id }}"
                                {{ (request()->room_id ==  $room->id ? 'selected' : '') }}>{{ $room->id }}</option>
                    @endforeach
                </select>
-->

                <label for="room_number">Kamernummer:</label>
                <select class="form-control" id="room_number" name="room_number" value="{{ $reservation->id }}">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                    <option>6</option>
                    <option>7</option>
                    <option>8</option>
                    <option>9</option>
                </select>
            </div>
        </div>

            <hr class="bg-success">
        @if ($reservation->id > 2)
            <div class="alert alert-info d-inline-flex">
                Er zijn geen arrangementen geboekt voor deze reservatie.
            </div>
        @else

            <h2>Kamer met Arrangement</h2>
            <div class="row">
                <div class="col-4 pt-4">
                    <p>..foto komt hier..</p>
                </div>
                <div class="col-4 pt-4">
                    <select class="form-control mt-2 mb-2" id="">
                        <option>Douche</option>
                        <option>Douche/bad</option>
                    </select>
                    <select class="form-control mt-2" id="">
                        <option>Met ontbijt</option>
                        <option>Halfpension (3-gangenmenu)</option>
                        <option>Halfpension (4-gangenmenu)</option>
                        <option>Volpension (3-gangenmenu)</option>
                    </select>
                </div>
                <div class="col-4">
                    <label for="">Van:</label>
                    <input type="text" class="form-control" id=""
                           @error('') is-invalid @enderror
                           placeholder="04/05/20"
                           value=""
                           required>

                    <label for="">Tot:</label>
                    <input type="text" class="form-control" id=""
                           @error('') is-invalid @enderror
                           placeholder="06/05/20"
                           value=""
                           required>
                </div>
            </div>

        @endif



        <div class="row">
            <div class="col-6 ">
                <button type="submit" class="btn btn-success">Opslaan</button>
                <a href="/admin/overview" class="btn btn-primary mx-1 ">Terug zonder opslaan</a>
            </div>


            </form>

            <div class="col-6 text-right">
            <form action="/admin/reservation/{{ $reservation->id }}" method="post"  id="deleteForm{{ $reservation->id }}"
                  data-id="{{ $reservation->id }}">
                @csrf
                @method('delete')
                <div class="">
                    <button type="button" class="btn btn-danger deleteForm"
                            data-toggle="tooltip" data-id="{{ $reservation->id }}" data-name="{{ $reservation->name }}"
                            title="Verwijder reservatie van {{ $reservation->name }}">
                        Verwijderen
                    </button>
                </div>
            </form>
            </div>
        </div>
</div>



@endsection
@section('script_after')

    <script>
        $(function () {
            $('.deleteForm').click(function () {
                let id = $(this).data('id');
                let name = $(this).data('name');
                // Set some values for Noty
                let text = `<p>De reservatie van <b>${name}</b> verwijderen?</p>`;
                let type = 'warning';
                let btnText = 'Verwijder de reservatie';
                // Show Noty
                let modal = new Noty({
                    timeout: false,
                    layout: 'center',
                    modal: true,
                    type: type,
                    text: text,
                    buttons: [
                        Noty.button(btnText, 'btn btn-danger', function () {
                            // Delete reservation and close modal
                            modal.close();
                            $(`#deleteForm${id}`).submit();
                        }),
                        Noty.button('Terug', 'btn btn-secondary ml-2', function () {
                            modal.close();
                        }),
                    ]
                }).show();
            });
        });
    </script>
@endsection

