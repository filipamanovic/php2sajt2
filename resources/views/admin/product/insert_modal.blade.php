<div class="modal fade" id="adminProductInsert" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">New Product</h3>
            </div>
            <div class="modal-body">
                <form action="{{route('product_insert')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <p></p>
                    <div class="form-group">
                        <input type="text" name="product_name" class="form-control" placeholder="Name" required>
                    </div>
                    <div class="form-group">
                        <input type="text" name="product_desc" class="form-control" placeholder="Description" required>
                    </div>
                    <div class="form-group">
                        <input type="number" name="product_price" class="form-control" placeholder="Price" required>
                    </div>
                    <div class="form-group">
                        <input type="number" name="product_checked" class="form-control" placeholder="Checked" required>
                    </div>
                    <div class="form-group">
                        <label>Image</label>
                        <input type="file" name="product_image" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Choose user</label>
                        <select name="user_id" class="form-control">
                            @foreach($users as $user)
                                <option value="{{$user->id}}">{{$user->ime.' '.$user->prezime.' - '.$user->email}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Choose category</label>
                        <select name="category_id" class="form-control">
                            @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->naziv}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Choose manufacturer</label>
                        <select name="manufacturer_id" class="form-control">
                            @foreach($manufacturers as $manufacturer)
                                <option value="{{$manufacturer->id}}">{{$manufacturer->naziv}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success" name="inComm">Add new product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>