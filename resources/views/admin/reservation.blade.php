@extends('layouts.template')

@section('title', 'Reservatie')

@section('main')
    <div class="row">
        <div class="col-12 col-md-8">
            <h1>Overzicht reservatie: {{ $room_reservation->reservation->first_name . ' ' . $room_reservation->reservation->name }}</h1>
        </div>
        <div class="col-5 col-md-4 text-md-right text-center">
            <i class="fas fa-2x fa-info-circle pr-2" id="openHelp"></i>
            <a href="/admin/overview" ><i class="fas fa-2x fa-home text-dark pr-3"></i></a>
        </div>
        <div class="col-md-6 col-7 text-md-right text-center order-md-2">
            <a href="/admin/bill/{{$room_reservation->reservation->id}}" class="btn btn-primary mx-1 ">Factuur raadplegen</a>
        </div>
        <div class="col-md-6 col-12 order-md-1">
            <h2 class="p-2">Boekingsinfo</h2>
        </div>

    </div>

    <div class="mx-3">
        <form action="/admin/reservation/{{ $room_reservation->id }}" method="post">
            @method('put')
            @csrf
            <div class="row ml-1 mr-5">
                <div class="col-md-3 col-12">
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
                <div class="col-md-3 col-12">
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
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <label for="room_number">Kamernummer:</label>
                        <select name="room_number" id="room_number" class="form-control">
                            <option value="" disabled>Kies een kamer</option>
                            @foreach($rooms as $room)
                                @if ($room->maximum_persons >= $numberPersons)
                                    <option value="{{ $room->id }}" {{ $room->id == $room_reservation->room_id ? 'selected' : '' }}>{{ $room->room_number }} &nbsp;({{ $room->typeRoom->type_bath }} - max personen: {{ $room->maximum_persons }})  </option>

                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="row ml-1 mr-5">
                <div class="col-md-3 col-12">
                    <div class="form-group">
                        <label for="occupancy">Bezetting:</label>
                        <input disabled type="text" name="occupancy" id="occupancy"
                               class="form-control"
                               value="{{ $room_reservation->room->typeRoom->prices->first()->occupancy_id == 1 ? '1 persoon' : '2 personen'  }}">
                    </div>
                </div>
                <div class="col-md-4 col-12">
                    <div class="form-group">
                        <label for="accommodation_type">Verblijfskeuze:</label>
                        <input disabled type="text" name="accommodation_type" id="accommodation_type"
                               class="form-control"
                               value="{{ $room_reservation->room->typeRoom->prices->first()->accommodationChoice->type }}">
                    </div>
                </div>
            </div>

            <div class="row ml-1 mr-5">
                <div class="col-md-4 col-12">
                    <div class="form-check">
                        <input class="form-check-input with_deposit" type="checkbox" value="1"
                               @if (old('_token'))
                               @if (old('with_deposit')) checked @endif

                               @else
                               @if ($room_reservation->reservation->with_deposit) checked @endif
                               @endif
                               id="with_deposit" name="with_deposit">
                        <label for="with_deposit" class="form-check-label">Met voorschot</label>
                    </div>
                    <div class="form-group ml-4 small-input deposit_amount">
                        <label for="deposit_amount">Voorschotbedrag(€):</label>
                        <input type="number" name="deposit_amount" id="deposit_amount"
                               class="form-control"
                               placeholder="0"
                               value="{{ $room_reservation->reservation->deposit_amount }}">
                    </div>
                    <div class="form-check deposit_amount">
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

                <div class="col-md-8 col-12">
                    <div class="form-group">
                        <label for="message">Opmerking:</label>
                        <textarea name="message" id="message" rows="3" class="form-control">{{ $room_reservation->reservation->message }}</textarea>
                    </div>
                </div>
            </div>

            <h3 class="ml-1 mt-4">Aantal personen</h3>
            <div class="row ml-2 mr-5">
                <?php $index = 1; ?>
                @foreach ($room_reservation->reservation->people as $person)
                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="form-group small-input">
                            <label for="age{{ $index }}">{{$person->age->age_category}}:</label>
                            <input type="hidden" name="age_{{$person->age_id}}" value="{{$person->id}}">
                            <input type="number" name="age{{$person->age_id}}" id="age{{$index}}"
                                   class="form-control @error('age' . $index) is-invalid @enderror"
                                   placeholder="Aantal" required
                                   value="{{$person->number_of_persons}}">
                            @error('age' . $index)
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <?php $index ++; ?>
                @endforeach

                <div class=" col">
                    @include('shared.alert')
                </div>

            </div>

            <hr class="bg-success">
            <h2>Persoonsgegevens</h2>
            <div class="row ml-1 mr-5">
                <div class="col-md-3 col-12">
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
                <div class="col-md-3 col-12">
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

                <div class="col-md-4 col-12">
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
                <div class="col-md-2 col-12">
                    <div class="form-group">
                        <label for="gender">Geslacht:</label>
                        <select disabled name="gender" id="gender" class="form-control">
                            <option value="M" {{ $room_reservation->reservation->gender == 'Male' ? 'selected' : '' }}>M</option>
                            <option value="V" {{ $room_reservation->reservation->gender == 'Female' ? 'selected' : '' }}>V</option>
                            <option value="/" {{ $room_reservation->reservation->gender == 'Other' ? 'selected' : '' }}>/</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row ml-1 mr-5">
                <div class="col-md-3 col-12">
                    <div class="form-group">
                        <label for="address">Adres:</label>
                        <input type="text" name="address" id="address"
                               class="form-control"
                               placeholder="Adres"
                               value="{{ $room_reservation->reservation->address }}">
                    </div>
                </div>
                <div class="col-md-3 col-12">
                    <div class="form-group">
                        <label for="place">Stad:</label>
                        <input type="text" name="place" id="place"
                               class="form-control"
                               placeholder="Stad"
                               value="{{ $room_reservation->reservation->place }}">
                    </div>
                </div>
                <div class="col-md-3 col-12">
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
                    <div class="col-md-4 col-12 pt-4">
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
                    <div class="col-md-4 col-12">
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
                <div class="col-md-6 col-12">
                    <a href="/admin/overview" class="btn btn-primary"><i class="fas fa-arrow-left"></i>Terug</a>
                    <button type="submit" class="btn btn-success"><i class="fas fa-plus-circle mr-1"></i>Opslaan</button>
                </div>

                </form>

                <div class="col-md-6 col-12 my-1 text-md-right">
                <form action="/admin/reservation/{{ $room_reservation->id }}" method="post"  id="deleteForm{{ $room_reservation->id }}"
                      data-id="{{ $room_reservation->id }}">
                    @csrf
                    @method('delete')
                    <div class="">
                        <button type="button" class="btn btn-danger deleteForm"
                                data-toggle="tooltip" data-id="{{ $room_reservation->id }}" data-name="{{ $room_reservation->reservation->name }}" data-first_name="{{ $room_reservation->reservation->first_name }}"
                                title="Verwijder reservatie van {{ $room_reservation->reservation->first_name }} {{ $room_reservation->reservation->name }}">
                            <i class="fas fa-trash mr-1"></i>Verwijderen
                        </button>
                    </div>
                </form>
                </div>
            </div>
    </div>


    <!-- Overlay text: when you press the info button this help page will be displayed -->
    <div class="overlay" id="MyDiv">
        <a href="#" class="text-danger" id="closeHelp"><i class="far fa-times-circle"></i></a>
        <div class="content">
            <p>Je vindt hier alle informatie over een reservatie, alsook kan je de factuur hier raadplegen via de blauwe knop vanboven.
                Ben je klaar met aanpassen? Klik dan op de groene knop 'opslaan' vanonder op de pagina. Is de reservatie geannuleerd of is deze fout? Klik dan op de rode knop 'Verwijderen' vanonder op de pagina.
                <br>
                <br>
                Wil je terug naar het hoofdscherm? Klik dan op het huisje rechts vanboven.
            </p>
            <p>Om dit scherm te sluiten, klik je rechts boven op het kruisje.</p>
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
                        Noty.button('Terug', 'btn btn-primary ml-2', function () {
                            modal.close();
                        }),
                    ]
                }).show();
            });

            //With deposit or not => show the amount
            let checked = $('.with_deposit').prop('checked');
            if (checked === true){
                $('.deposit_amount').show();
            }
            else {
                $('.deposit_amount').hide();
            }
            let $checkbox = $('input[name="with_deposit"]');
            console.dir($checkbox);
            $checkbox.change(function () {
                let checked = $(this).prop('checked');
                console.log(checked);
                if (checked === true){
                    $('.deposit_amount').show();
                }
                else {
                    $('.deposit_amount').hide();
                }
            });
        });


    </script>
    <script>
        $(function () {
            $('#footer_names').append(
                kempenrust.names_footer(1,3)

            );
        });


    </script>


@endsection

