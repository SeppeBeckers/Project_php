@extends('layouts.template')

@section('title', 'Verander kamer')

@section('main')
    <form action="/admin/not_available/{{ $not_available->id }}" method="post">
        @method('put')
        @csrf
            <div class="alert alert-primary">
                <a href="javascript:history.go(-1)" class="btn btn-primary">
                    <i class="fas fa-arrow-left"></i> Terug
                </a>
                <button type="submit"  class="btn btn-success">
                    <i class="fas fa-plus-circle mr-1"></i>opslaan
                </button>
                <a href="#!" class="btn btn-danger" id="deleteDate">
                    <i class="fas fa-trash mr-1"></i>Verwijderen
                </a>
            </div>
    <h1>Verander datums</h1>

        <div class="form-group">
            <div class="form-row">
            <label for="starting_date">Van: </label>
                <div class="col-sm-10" style="margin-left: 10px;">
                    <input type="date" name="starting_date" id="starting_date"
                        class="form-control"
                        placeholder="Starting_date"
                        minlength=" "
                        required
                        value="{{$not_available->starting_date}}">
                    @error('starting_date')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <br>
            <div class="form-row">
                <label for="end_date">Tot: </label>
                <div class="col-sm-10" style="margin-left: 12px;">
                <input type="date" name="end_date" id="end_date"
                   class="form-control"
                   placeholder="end_date"
                   minlength=" "
                   required
                   value="{{$not_available->end_date}}">
                </div>
                @error('end_date')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </form>

@endsection
@section('script_after')
    <script>
        $('#deleteDate').click(function () {
            let id = '{{$not_available->id}}';
            let starting_date = '{{$not_available->starting_date}}';
            let end_date = '{{$not_available->end_date}}';
            let text = `<p>Verwijder  de datums van: <b>${starting_date}</b> en tot: <b>${end_date}</b>?</p>`;
            console.log(`verwijder onbeschikbaarheid met id: ${id}`);
            // Show Noty
            let modal = new Noty({
                timeout: false,
                layout: 'center',
                modal: true,
                type: 'warning',
                text: text,
                buttons: [
                    Noty.button('Verwijder', 'btn btn-danger', function () {
                        // Verwijder datum
                        let pars = {
                            '_token': '{{ csrf_token() }}',
                            '_method': 'delete'
                        };
                        $.post(`/admin/not_available/${id}`, pars, 'json')
                            .done(function (data) {
                                console.log('data', data);
                                // Show toast
                                new Noty({
                                    type: data.type,
                                    text: data.text
                                }).show();
                                // After 2 seconds, redirect to the public master page
                                setTimeout(function () {
                                    $(location).attr('href', '/admin/room/{{$not_available->room_id}}');
                                }, 2000);
                            })
                            .fail(function (e) {
                                console.log('error', e);
                            });
                        modal.close();
                    }),
                    Noty.button('Annuleer', 'btn btn-secondary ml-2', function () {
                        modal.close();
                    })
                ]
            }).show();
        });

    </script>
@endsection