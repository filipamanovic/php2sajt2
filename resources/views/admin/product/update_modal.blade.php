<div class="modal fade" id="adminProductUpdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">Update comment</h3>
            </div>
            <div class="modal-body">
                <form action="{{route('product_update')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <p></p>
                    <div class="form-group">
                        <input type="text" name="product_name" id="product_name" class="form-control" placeholder="Name" required>
                    </div>
                    <div class="form-group">
                        <input type="text" name="product_desc" id="product_desc" class="form-control" placeholder="Description" required>
                    </div>
                    <div class="form-group">
                        <input type="number" name="product_price" id="product_price" class="form-control" placeholder="Price" required>
                    </div>
                    <div class="form-group">
                        <input type="number" name="product_checked" id="product_checked" class="form-control" placeholder="Checked" required>
                    </div>
                    <div class="form-group">
                        <label>Image</label>
                        <input type="file" name="product_image" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Choose user</label>
                        <select name="user_id" class="form-control" id="user_id">
                            @foreach($users as $user)
                                <option value="{{$user->id}}">{{$user->ime.' '.$user->prezime.' - '.$user->email}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Choose category</label>
                        <select name="category_id" class="form-control" id="category_id">
                            @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->naziv}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Choose manufacturer</label>
                        <select name="manufacturer_id" class="form-control" id="manufacturer_id">
                            @foreach($manufacturers as $manufacturer)
                                <option value="{{$manufacturer->id}}">{{$manufacturer->naziv}}</option>
                            @endforeach
                        </select>
                    </div>
                    <input type="hidden" id="product_id" name="product_id">
                    <input type="hidden" id="slika_id" name="slika_id">
                    <div class="form-group">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success" name="inComm">Update user</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>