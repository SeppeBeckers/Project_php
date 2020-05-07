@extends('layouts.template')

@section('title', 'Nieuw arrangement')

@section('main')
    <h1>Nieuw arrangement</h1>
    <div class="mx-3">
        <form action="/admin/arrangement" method="post">
            @csrf
            <div class="form-group small-input">
                <label for="naam" class="font-weight-bold">Naam:</label>
                <input type="text" name="naam" id="naam"
                       class="form-control  @error('naam') is-invalid @enderror"
                       placeholder="Kies een naam" required
                       value="{{old('naam')}}">
                @error('naam')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="beschrijving" class="font-weight-bold">Beschrijving:</label>
                <textarea name="beschrijving" id="beschrijving" rows="3"
                          class="form-control @error('beschrijving') is-invalid @enderror"
                          placeholder="Geef een beschrijving" required>{{old('beschrijving')}}</textarea>
                @error('beschrijving')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="row">
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="form-group small-input">
                        <label for="begindag" class="font-weight-bold">Van:</label>
                        <input type="text" name="begindag" id="begindag"
                               class="form-control  @error('begindag') is-invalid @enderror"
                               placeholder="Weekdag"
                               value="{{old('begindag')}}">
                        @error('begindag')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="form-group small-input">
                        <label for="einddag" class="font-weight-bold">Tot:</label>
                        <input type="text" name="einddag" id="einddag"
                               class="form-control  @error('einddag') is-invalid @enderror"
                               placeholder="Weekdag"
                               value="{{old('einddag')}}">
                        @error('einddag')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <h3 class="font-weight-bold mt-4">Prijzen per persoon (€)</h3>
            <div class="row">
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="form-group small-input">
                        <label for="amount1">Kamer met douche <br> 1 persoon</label>
                        <input type="number" name="amount1" id="amount1"
                               class="form-control @error('amount1') is-invalid @enderror"
                               placeholder="Prijs" required
                               value="{{old('amount1')}}">
                        @error('amount1')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="form-group small-input">
                        <label for="amount2">Kamer met douche/bad <br> 1 persoon</label>
                        <input type="number" name="amount2" id="amount2"
                               class="form-control @error('amount2') is-invalid @enderror"
                               placeholder="Prijs" required
                               value="{{old('amount2')}}">
                        @error('amount2')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="form-group small-input">
                        <label for="amount3">Kamer met douche <br> 2 personen</label>
                        <input type="number" name="amount3" id="amount3"
                               class="form-control @error('amount3') is-invalid @enderror"
                               placeholder="Prijs" required
                               value="{{old('amount3')}}">
                        @error('amount3')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="form-group small-input">
                        <label for="amount4">Kamer met douche/bad <br> 2 personen</label>
                        <input type="number" name="amount4" id="amount4"
                               class="form-control @error('amount4') is-invalid @enderror"
                               placeholder="Prijs" required
                               value="{{old('amount4')}}">
                        @error('amount4')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="mt-xl-4 mt-3 ml-3 row">
            <a href="/admin/arrangement" class="btn btn-primary mx-1" data-toggle="tooltip" title="Terug naar het overzicht"><i class="fas fa-arrow-left"></i> Terug</a>
            <button type="submit" id="submit" class="btn btn-success mx-1" data-toggle="tooltip" title="Arrangement toevoegen"><i class="fas fa-plus-circle mr-1"></i>Toevoegen</button>
        </div>
        </form>
    </div>

@endsection

@section('script_after')
    <script>
        $(function () {
            $('#footer_names').append(
                kempenrust.names_footer(1,3)
            );
        });
    </script>
@endsection