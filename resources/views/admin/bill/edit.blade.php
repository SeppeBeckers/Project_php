@extends('layouts.template')
@section('title', 'Edit bill')

@section('main')

    <div class="row">
        <div class="col-12 text-md-right text-center">
            <i class="fas fa-2x fa-info-circle pr-2" id="openHelp"></i>
            <a href="/admin/overview" ><i class="fas fa-2x fa-home text-dark pr-3"></i></a>
        </div>
        <div class="col-12 my-4 text-center">
            <h1>Extra kosten toevoegen:</h1>
        </div>
    </div>

    <form action="/admin/bill/{{ $bill->reservation_id }}" method="post">
        @method('put')
        @csrf
        <div class="row mt-2 mx-4 justify-content-center">
            <div class="col-12 align-content-center">
                <div class="form-group ">
                    <label for="extra">Extra algemene kosten:</label>
                    <input type="number" name="extra" class="form-control kosten" id="extra"
                           placeholder="€0"
                           value="">
                </div>
            </div>

            <div class="col-12">
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
        </div>

        <div class="row justify-content-center mt-4">
            <a href="/admin/bill/{{ $bill->reservation_id }}" class="btn btn-primary mx-1"><i class="fas fa-arrow-left"></i> Terug</a>
            <button type="submit"  class="btn btn-success mx-1"><i class="fas fa-plus-circle mr-1"></i>Toevoegen</button>

        </div>
    </form>

@endsection
@section('css_after')

    <style>
        @media (min-width: 750px) {
            .container-sm{
                width: 30%!important;

            }
        }

        .kosten{
            width: 100px!important;
        }
    </style>

@endsection


