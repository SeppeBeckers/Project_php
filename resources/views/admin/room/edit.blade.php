@extends('layouts.template')
@section('title', 'Verander kamer')

@section('main')
    <h1>Verander kamer {{ $room->room_number }}</h1>
    <form action="/admin/room/{{ $room->id }}" method="post">
        @method('put')
        @csrf
        <div class="container">
            <div class="form-row">
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

            <div class="form-group" style="margin-top: 10px">
                    <label for="beschrijving">Beschrijving van de kamer: </label>
                    <input type="text" name="beschrijving" id="beschrijving"
                           class="form-control"
                           placeholder="Beschrijving"
                           value="{{ old('beschrijving', $room->description) }}">
            </div>

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

        <div class="form-check">
            <input class="form-check-input" type="radio" name="beschikbaarheid" id="onbeschikbaar" value="onbeschikbaar"
            @if ($standard_date >  $not->starting_date && $standard_date < $not->end_date)
                checked
            @endif>
            <label class="form-check-label" for="onbeschikbaar">
                Onbeschikbaar
            </label>

            <div class="form-group" style="margin-top: 1%">
                <label for="van">Van: </label>
                <input class="form-control col-sm-2" type="date" name="van" id="van" placeholder="Van"
                       value="{{$not->starting_date}}">
                <br>
                <label for="tot">Tot: </label>
                <input class="form-control col-sm-2" type="date" name="tot" id="tot" placeholder="Tot"
                       value="{{$not->end_date}}">
            </div>

        </div>

        <div class="form-check" style="margin-bottom: 3%">
            <input class="form-check-input" type="radio" name="beschikbaarheid" id="beschikbaar" value="obeschikbaar"
                   @if ($standard_date <  $not->starting_date)
            checked
                    @endif>
            <label class="form-check-label" for="beschikbaar" >
                Beschikbaar
            </label>
        </div>

        <button type="submit" class="btn btn-success">Kamer opslaan</button>
        </div>
    </form>
@endsection
@section('script_after')
    <script>
        $(document).ready(function () {
            if ($("#beschikbaar").is(":checked")) {
                $('#van').prop("disabled", true).val(" ");
                $('#tot').prop("disabled", true).val(" ");
            }
        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#preview').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
        }

        $("#afbeelding").change(function() {
            readURL(this);
        });

        $('#beschikbaar').click(function() {
            if ($(this).prop('checked') === true) {
                $('#van').prop("disabled", true);
                $('#tot').prop("disabled", true);
           }
        });

        $('#onbeschikbaar').click(function() {
            if ($(this).prop('checked') === true) {
                $('#van').prop("disabled", false);
                $('#tot').prop("disabled", false);
            }
        });


    </script>

@stop
