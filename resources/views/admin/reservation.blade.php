@extends('layouts.template')

@section('title', 'Reservatie')

@section('main')
    <div class="row">
        <div class="col-12 col-md-8">
            <h1>Overzicht reservatie: {{ $room_reservation->reservation->first_name . ' ' . $room_reservation->reservation->name }}</h1>
        </div>
        <div class="col-12 col-md-4 text-md-right">
            <a href="/admin/bill/{{$room_reservation->reservation->id}}" class="btn btn-primary mx-1 ">Factuur raadplegen</a>
        </div>
    </div>
    <hr class="bg-success">
    <div class="m-3">
        <h2>Boekingsinfo</h2>
        <form action="/admin/reservation/{{ $room_reservation->id }}" method="post">
            @method('put')
            @csrf

            <div class="row ml-1 mr-5">
                <div class="col-4">
                    <div class="form-group">
                        <label for="starting_date">Aankomstdatum:</label>
                        <input type="date"  id="starting_date" name="starting_date"
                               class="form-control {{ $errors->first('starting_date') ? 'is-invalid' : '' }}"
                               value="{{ $room_reservation->starting_date }}">
                        @error('starting_date')
                        <div class="invalid-feedback">{{ $errors->first('starting_date') }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="end_date">Vertrekdatum:</label>
                        <input type="date"  id="end_date" name="end_date"
                               class="form-control {{ $errors->first('end_date') ? 'is-invalid' : '' }}"
                               value="{{ $room_reservation->end_date }}">
                        @error('end_date')
                        <div class="invalid-feedback">{{ $errors->first('end_date') }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="room_number">Kamernummer:</label>
                        <select name="room_number" id="room_number" class="form-control">
                            <option value="" disabled>Kies een kamer</option>
                            @foreach($rooms as $room)
                                <option value="{{ $room->id }}" {{ $room->id == $room_reservation->room_id ? 'selected' : '' }}>{{ $room->room_number }}</option>
                            @endforeach
                        </select>
                     </div>
                </div>
            </div>

            <div class="row ml-1 mr-5">
                <div class="col-4">
                    <div class="form-group">
                        <label for="accommodation_type">Verblijfskeuze:</label>
                        <select name="accommodation_type" id="accommodation_type" class="form-control">
                            <option value="" disabled>Kies een verblijfskeuze</option>
                            @foreach($accommodations as $accommodation)
                                <option value="{{ $accommodation->id }}" {{ $accommodation->id == $room_reservation->room->typeRoom->prices->first()->accommodation_id ? 'selected' : '' }}>{{ $accommodation->type }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="occupancy">Bezetting:</label>
                        <select name="occupancy" id="occupancy" class="form-control">
                            <option value="" disabled>Kies een bezetting</option>
                            <option value="0" {{ $room_reservation->room->typeRoom->prices->first()->occupancy->is_double == 'false' ? 'selected' : '' }}>1 persoon</option>
                            <option value="1" {{ $room_reservation->room->typeRoom->prices->first()->occupancy->is_double == 'true' ? 'selected' : '' }}>2 personen</option>
                        </select>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="type_bath">Type badkamer:</label>
                        <input disabled type="text" name="type_bath" id="type_bath"
                               class="form-control"
                               value="{{ $room_reservation->room->typeRoom->type_bath }}">
                    </div>
                </div>
            </div>

            <div class="row ml-1 mr-5">
                <div class="col-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="1"
                               @if (old('_token'))
                               @if (old('with_deposit')) checked @endif

                               @else
                               @if ($room_reservation->reservation->with_deposit) checked @endif
                               @endif
                               id="with_deposit" name="with_deposit">
                        <label for="with_deposit" class="form-check-label">Met voorschot</label>
                    </div>
                    <div class="form-group ml-4 small-input">
                        <label for="deposit_amount">Voorschotbedrag(€):</label>
                        <input type="number" name="deposit_amount" id="deposit_amount"
                               class="form-control"
                               placeholder="0"
                               value="{{ $room_reservation->reservation->deposit_amount }}">
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="1"
                               @if (old('_token'))
                               @if (old('admin')) checked @endif

                               @else
                               @if ($room_reservation->reservation->deposit_paid) checked @endif
                               @endif
                               id="deposit_paid" name="deposit_paid">
                        <label for="deposit_paid" class="form-check-label">Voorschot betaald</label>
                    </div>
                </div>

                <div class="col-8">
                    <label for="message">Opmerking:</label>
                    <textarea name="message" id="message" rows="3"
                              class="form-control text-left">
                        {{ $room_reservation->reservation->message }}
                    </textarea>
                </div>
            </div>

            <h3 class="ml-1 mt-4">Aantal personen</h3>
            <div class="row ml-2 mr-5">
                <div class="col-md-2 col-3">
                    <label for="age1">0 - 3 jaar:</label>
                    <input type="text" class="form-control" id="age"
                           @error('age') is-invalid @enderror
                           placeholder="0"
                           value="">
                </div>

                <div class="col-md-2 col-3">
                    <label for="age2">4 - 8 jaar:</label>
                    <input type="text" class="form-control" id="age"
                           @error('age') is-invalid @enderror
                           placeholder="0"
                           value="">
                </div>
                <div class="col-md-2 col-3">
                    <label for="age3">9 - 12 jaar:</label>
                    <input type="text" class="form-control" id="age"
                           @error('age') is-invalid @enderror
                           placeholder="0"
                           value="">
                </div>
                <div class="col-md-2 col-3">
                    <label for="age4">Volwassenen:</label>
                    <input type="text" class="form-control" id="age"
                           @error('age') is-invalid @enderror
                           placeholder="2"
                           value="">
                </div>
            </div>

            <hr class="bg-success">
            <h2>Persoonsgegevens</h2>
            <div class="row ml-1 mr-5">
                <div class="col-3">
                    <div class="form-group">
                        <label for="name">Naam:</label>
                        <input type="text" name="name" id="name"
                               class="form-control @error('name') is-invalid @enderror"
                               placeholder="Naam" required
                               value="{{ $room_reservation->reservation->name }}">
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <label for="first_name">Voornaam:</label>
                        <input type="text" name="first_name" id="first_name"
                               class="form-control @error('first_name') is-invalid @enderror"
                               placeholder="Voornaam" required
                               value="{{ $room_reservation->reservation->first_name }}">
                        @error('first_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-4">
                    <div class="form-group">
                        <label for="email">E-mail:</label>
                        <input type="email" name="email" id="email"
                               class="form-control @error('email') is-invalid @enderror"
                               placeholder="Email" required
                               value="{{ $room_reservation->reservation->email }}">
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-2">
                    <div class="form-group">
                        <label for="gender">Geslacht:</label>
                        <select disabled name="occupancy" id="occupancy" class="form-control">
                            <option value="M" {{ $room_reservation->reservation->gender == 'Male' ? 'selected' : '' }}>M</option>
                            <option value="V" {{ $room_reservation->reservation->gender == 'Female' ? 'selected' : '' }}>V</option>
                            <option value="/" {{ $room_reservation->reservation->gender == 'Other' ? 'selected' : '' }}>/</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row ml-1 mr-5">
                <div class="col-3">
                    <div class="form-group">
                        <label for="address">Adres:</label>
                        <input type="text" name="address" id="address"
                               class="form-control"
                               placeholder="Adres"
                               value="{{ $room_reservation->reservation->address }}">
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <label for="place">Stad:</label>
                        <input type="text" name="place" id="place"
                               class="form-control"
                               placeholder="Stad"
                               value="{{ $room_reservation->reservation->place }}">
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="phone_number">Telefoonnummer:</label>
                        <input type="text" name="phone_number" id="phone_number"
                               class="form-control @error('phone_number') is-invalid @enderror"
                               placeholder="Telefoonnummer" required
                               value="{{ $room_reservation->reservation->phone_number }}">
                        @error('phone_number')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

                <hr class="bg-success">
            @if ($room_reservation->reservation->id > 2)
                <div class="alert alert-info d-inline-flex">
                    Er zijn geen arrangementen geboekt voor deze reservatie.
                </div>
            @else

                <h2>Kamer met arrangement</h2>
                <div class="row">
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
                               value="">

                        <label for="">Tot:</label>
                        <input type="text" class="form-control" id=""
                               @error('') is-invalid @enderror
                               placeholder="06/05/20"
                               value="">
                    </div>
                </div>
            @endif

            <div class="row">
                <div class="col-6 ">
                    <button type="submit" class="btn btn-success">Opslaan</button>
                    <a href="/admin/overview" class="btn btn-primary mx-1">Terug</a>
                </div>


                </form>

                <div class="col-6 text-right">
                <form action="/admin/reservation/{{ $room_reservation->id }}" method="post"  id="deleteForm{{ $room_reservation->id }}"
                      data-id="{{ $room_reservation->id }}">
                    @csrf
                    @method('delete')
                    <div class="">
                        <button type="button" class="btn btn-danger deleteForm"
                                data-toggle="tooltip" data-id="{{ $room_reservation->id }}" data-name="{{ $room_reservation->reservation->name }}" data-first_name="{{ $room_reservation->reservation->first_name }}"
                                title="Verwijder reservatie van {{ $room_reservation->reservation->first_name }} {{ $room_reservation->reservation->name }}">
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
                let first_name = $(this).data('first_name');
                // Set some values for Noty
                let text = `<p>De reservatie van <b>${first_name} ${name}</b> verwijderen?</p>`;
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

