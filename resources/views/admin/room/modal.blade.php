{{-- Model voor data te bewerken --}}
<div class="modal" id="modal-not">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">modal-not-title</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    @method('')
                    @csrf
                    <div class="form-group">
                        <input type="hidden" name="id" id="id" value="">
                        <label for="starting_date">Van: </label>
                        <input type="date" name="starting_date" id="starting_date"
                               class="form-control"
                               placeholder="Starting_date"
                               minlength=" "
                               required
                               value="">
                        <div class="invalid-feedback"></div>
                        <br>
                        <label for="end_date">Tot: </label>
                        <input type="date" name="end_date" id="end_date"
                               class="form-control"
                               placeholder="end_date"
                               minlength=" "
                               required
                               value="">
                        <div class="invalid-feedback"></div>
                    </div>
                    <button type="submit" class="btn btn-success">Bewaar de datums</button>
                </form>
            </div>
        </div>
    </div>
</div>