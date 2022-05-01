<div class="modal fade" id="addCardToOwn" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Credit Card As Owned</h5>
                <button type="button" class="cstm-close-btn" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('mark_card_as_owned')}}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="alert alert-dismissible fade show alert-warning" role="alert">
                        When you own a cards, system will suggest you which card to use according to your activity. You can find all you cards in menu "My cards "
                    </div>
                    <input type="hidden" name="card_id" class="form-control" id="card-id-owned">
                </div>
                <div class="modal-footer">
                    <button type="button" data-bs-dismiss="modal" class="btn btn-danger">Cancel</button>
                    <button type="submit" class="btn btn-success">I Own </button>
                </div>
            </form>

        </div>
    </div>
</div>
