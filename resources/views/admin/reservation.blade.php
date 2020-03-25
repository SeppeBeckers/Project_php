@extends('layouts.template')
@section('title', 'Reservatie')

@section('main')
<h1 class="pl-0 ml-0 pl-xl-5">Reservatie</h1>

<div class="row">
    <div class="col-12 col-md-6">
    <h2 class="pl-xl-5">Gegevens verblijvers</h2>
    </div>
    <div class="col-12 col-md-6 text-md-right">
        <a href="/admin/bill" class="btn btn-primary mx-1 ">Factuur raadplegen</a>
        <a href="/admin/overview" class="btn btn-primary mx-1 ">Terug</a>
    </div>
</div>


<div class="row m-2 justify-content-center">
    <form action="/admin/reservation" method="post">
        @csrf
        <div class="row">
            <div class="col-7">
                <div class="row">
                    <div class="col-6 my-2">
                        <label for="name">Naam:</label>
                        <input type="text" class="form-control" id="name"
                               @error('name') is-invalid @enderror
                               placeholder="Geerkens"
                               value=""
                               required>
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6 my-2">
                        <label for="first_name">Voornaam:</label>
                        <input type="text" class="form-control" id="first_name"
                               @error('first_name') is-invalid @enderror
                               placeholder="Babette"
                               value=""
                               required>
                        @error('first_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 my-2">
                        <label for="email">Email:</label>
                        <input type="email" name="email" id="email"
                               class="form-control"
                               @error('email') is-invalid @enderror
                               placeholder="babettegeerkens@hotmail.com"
                               value=""
                               required>
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6 my-2">
                        <label for="phone_number">Telefoonnummer:</label>
                        <input type="text" class="form-control" id="phone_number"
                               @error('phone_number') is-invalid @enderror
                               placeholder="0987 65 43 21"
                               value=""
                               required>
                        @error('phone_number')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                </div>
            </div>
            <div class="col-5 my-2">
                <label for="message">Opmerking:</label>
                <textarea name="message" id="message" rows="5"
                          class="form-control" >
                                     </textarea>
            </div>
        </div>

        <div class="row">
            <div class="col-md-2 col-3 my-2">
                <label for="age">0-3 jaar:</label>
                <input type="text" class="form-control" id="age"
                       @error('age') is-invalid @enderror
                       placeholder="0"
                       value=""
                       required>
            </div>
            <div class="col-md-2 col-3 my-2">
                <label for="age">4-8 jaar:</label>
                <input type="text" class="form-control" id="age"
                       @error('age') is-invalid @enderror
                       placeholder="0"
                       value=""
                       required>
            </div>
            <div class="col-md-2 col-3 my-2">
                <label for="age">9-12 jaar:</label>
                <input type="text" class="form-control" id="age"
                       @error('age') is-invalid @enderror
                       placeholder="0"
                       value=""
                       required>
            </div>
            <div class="col-md-2 col-3 my-2">
                <label for="age">Volwassenen:</label>
                <input type="text" class="form-control" id="age"
                       @error('age') is-invalid @enderror
                       placeholder="2"
                       value=""
                       required>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2 col-4 my-2">
                <label for="room_number">Kamernummer:</label>
                <select class="form-control" id="room_number">
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
        </form>
    </div>

    <div class="row justify-content-center my-5">
        <div class="col text-right">
            <a href="#!" class="btn btn-danger" id="deleteReservation">Verwijderen</a>
        </div>

        <div class="col">
            <button type="submit" class="btn btn-success">Opslaan</button>
        </div>
    </div>


@endsection
