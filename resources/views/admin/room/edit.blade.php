@extends('layouts.template')
@section('title', 'Verander kamer')

@section('main')
    <div class="row">
        <div class="col-8 col-md-8">
            <h1>Verander kamer {{ $room->room_number }}</h1>
        </div>
        <div class="col-12 col-md-4 text-right">
            <i class="fas fa-2x fa-info-circle pr-2" id="openHelp"></i>
            <a href="/admin/overview" ><i class="fas fa-2x fa-home text-dark pr-3"></i></a>
        </div>
    </div>
    <form action="/admin/room/{{ $room->id }}" method="post" enctype="multipart/form-data">
        @method('put')
        @csrf
        <div class="container">
            <div class="form-row">
                {{-- Kamernummer --}}
                <div class="col-sm-6 align-self-start">
                    <label for="kamerNr">Kamer nummer: </label>
                    <input type="text" name="kamerNr" id="kamerNr"
                        class="form-control @error('kamerNr') is-invalid @enderror"
                        placeholder="KamerNr"
                        minlength="1"
                        required
                        value="{{ old('kamerNr', $room->room_number) }}">
                    @error('kamerNr')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
                <div class="form-row">
                {{-- Aantal personen --}}
                <div class="col-sm-6 align-self-end">
                    <label for="maxPers">Maximum aantal personen: </label>
                    <input type="text" name="maxPers" id="maxPers"
                        class="form-control @error('maxPers') is-invalid @enderror"
                        placeholder="maxPersonen"
                        required
                        minlength="1"
                        value="{{ old('maxPers', $room->maximum_persons) }}">
                    @error('maxPers')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>


            {{-- Beschrijving --}}
            <div class="form-group" style="margin-top: 10px">
                    <label for="beschrijving">Beschrijving van de kamer: </label>
                    <input type="text" name="beschrijving" id="beschrijving"
                           class="form-control"
                           placeholder="Beschrijving"
                           value="{{ old('beschrijving', $room->description) }}">
            </div>


            {{-- Type kamer (met of zonder bad) --}}
            <div class="form-row">
                <div class="col-4">
                    <label for="faciliteiten">Faciliteiten: </label>
                    <select class="form-control" name="faciliteiten" id="faciliteiten" required>
                        @foreach($typeRoom as $type)
                            <option value="{{$type->id}}" @if ($type->id == $room->type_room_id)
                            selected
                                    @endif>{{$type->type_bath}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            {{-- Afbeelding --}}
            <div class="form-group">
                <div class="custom-file" style="margin-top: 10px">
                    <label for="afbeelding">Selecteer een bestand: </label>
                    <input type="file" id="afbeelding" name="afbeelding"><br><br>
                </div>
                <div class="form-group">
                    <img class="img-thumbnail" id="preview" src="/public_html/assets/{{$room->picture}}"
                         alt="{{$room->picture}}" style="margin-bottom: 5%"/>
                </div>
            </div>
        </div>
        <div class="row m-2">
            <a href="/admin/room" class="btn btn-primary mx-2">
                <i class="fas fa-arrow-left"></i> Terug
            </a>
            <button type="submit" class="btn btn-success">
                <i class="fas fa-plus-circle mr-1"></i>Kamer opslaan
            </button>
        </div>
    </form>

    <!-- Overlay text: when you press the info button this help page will be displayed -->
    <div class="overlay" id="MyDiv">
        <a href="#" class="text-danger" id="closeHelp"><i class="far fa-times-circle"></i></a>
        <div class="content">
            <p>Op deze pagina vindt u de informatie van de geselecteerde kamer terug en kan u deze ook bewerken.
                <br>
            <p>Als u op de blauwe knop "terug" klikt dan keert u terug naar het overzicht scherm van de kamers,
            en als u op de groene knop "Kamer opslaan" kan u de informatie opslaan die u heeft veranderd. </p>

            <p>
                Wilt u terug naar het hoofdscherm? Klik dan op het huisje rechtsboven van het scherm.
            </p>
            <p>Om dit scherm te sluiten, klikt u rechtsboven op het kruisje.</p>
        </div>
    </div>

@endsection
@section('script_after')
    <script>
        {{-- Knoppen afzetten als kamer beschikbaar is --}}
        $(document).ready(function () {
            if ($("#beschikbaar").is(":checked")) {
                $('#van').prop("disabled", true).val(" ");
                $('#tot').prop("disabled", true).val(" ");
            }
        });

        {{-- Afbeelding lezen als ze uploaden --}}
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#preview').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
        }
        {{-- Afbeelding veranderen --}}
        $("#afbeelding").change(function() {
            readURL(this);
        });

        {{-- Van en tot afzetten als beschikbaar is --}}
        $('#beschikbaar').click(function() {
            if ($(this).prop('checked') === true) {
                $('#van').prop("disabled", true);
                $('#tot').prop("disabled", true);
           }
        });
        {{-- Van en tot aanzetten als beschikbaar is --}}
        $('#onbeschikbaar').click(function() {
            if ($(this).prop('checked') === true) {
                $('#van').prop("disabled", false);
                $('#tot').prop("disabled", false);
            }
        });


    </script>

@endsection
