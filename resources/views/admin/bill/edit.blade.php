@extends('layouts.template')
@section('title', 'Edit bill')

@section('main')
    <div class="container-fluid">
        <h1>Extra kosten toevoegen:</h1>
        <form action="/admin/bill/{{ $bill->reservation_id }}" method="post">
            @method('put')
            @csrf
            <div class="row">
                <div class="col-md-2 col-3 my-2">
                    <label for="extra">Extra algemene kosten:</label>
                    <input type="number" name="extra" class="form-control" id="extra"
                           placeholder="€0"
                           value="">
                </div>
            </div>
            <div class="mb-3 my-5">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" value="1"
                           id="zwembad" name="zwembad">
                    <label class="form-check-label" for="zwembad">
                        Zwembad
                    </label>
                </div>

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" value="1"
                           id="hond" name="hond">
                    <label class="form-check-label" for="hond">
                        Hond
                    </label>
                </div>

            </div>
            <button type="submit"  class="btn btn-success">Nieuwe rekening opslagen</button>
            <a href="/admin/bill/{{ $bill->reservation_id }}" class="btn btn-primary mx-1 ">Terug zonder opslaan</a>

        </form>  <div class="col-6 ">

        </div></div>

@endsection



