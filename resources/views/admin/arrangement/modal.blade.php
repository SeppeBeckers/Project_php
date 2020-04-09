<div class="modal" id="modal-price">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">modal-editUser-title</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    @method('')
                    @csrf
                    <div class="form-group">
                            <label for="amount">Prijs</label>
                        <input type="text" name="amount" id="amount"
                               class="form-control"
                               placeholder="Prijs"
                               required
                               value="">
                        <div class="invalid-feedback"></div>
                    </div>

                    <button type="submit" id="closeModal" class="btn btn-success">Prijs bevestigen</button>
                </form>
            </div>
        </div>
    </div>
</div>
