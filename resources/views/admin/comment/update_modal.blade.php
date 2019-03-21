<div class="modal fade" id="adminCommentUpdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">Update comment</h3>
            </div>
            <div class="modal-body">
                <form action="{{route('commnet_update')}}" method="post">
                    @csrf
                    <p></p>
                    <div class="form-group">
                        <label>Comment text</label>
                        <textarea rows="6" type="text" class="form-control" name="comment_text" id="comment_text" required="required"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Choose product</label>
                        <select name="product_id" class="form-control" id="adminProductddl">
                            @foreach($products as $product)
                                <option value="{{$product->id}}">{{$product->naziv}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Choose user</label>
                        <select name="user_id" class="form-control" id="adminUserddl">
                            @foreach($users as $user)
                                <option value="{{$user->id}}">{{$user->ime.' '.$user->prezime.' - '.$user->email}}</option>
                            @endforeach
                        </select>
                    </div>
                    <input type="hidden" id="comment_id" name="comment_id">
                    <div class="form-group">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success" name="inComm">Update user</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>