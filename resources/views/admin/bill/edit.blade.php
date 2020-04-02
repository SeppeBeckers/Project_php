@extends('layouts.template')
@section('title', 'Edit bill')

@section('main')
    <h1>Extra kosten toevoegen:</h1>
    <form action="/admin/bill/{{ $bill->reservation->reservation_id }}" method="post">
        @method('put')
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name"
                   class="form-control @error('name') is-invalid @enderror"
                   placeholder="Name"
                   required
                   minlength="3"
                   value="{{ old('name' ) }}">
            @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="name">Email</label>
            <input type="email" name="email" id="email"
                   class="form-control "
                   placeholder="Name"
                   required
                   value="{{ old('email') }}">

        </div>
        <div class="mb-3">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" value="1"


                       id="active" name="active">
                <label class="form-check-label" for="active">
                    Active
                </label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" value="1"


                       id="admin" name="admin">
                <label class="form-check-label" for="admin">
                    Admin
                </label>
            </div>
        </div>
        <button type="submit" class="btn btn-success">Save user</button>
    </form>
@endsection
