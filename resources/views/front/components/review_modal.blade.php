<div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Your review</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('comment')}}" method="post">
                    @csrf
                    <p></p>
                    <div class="form-group">
                        <textarea rows="6" class="form-control" name="comment" required="required"> </textarea>
                    </div>
                    <div class="form-group">
                        <input type="hidden" class="form-control" name="product_id" required="required" value="{{$product->p_id}}">
                        <input type="hidden" class="form-control" name="user_id" required="required" value="{{session()->get('user')->id}}">
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success" name="inComm">Send comment</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>