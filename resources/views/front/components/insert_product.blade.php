<div class="col-lg-3 signup-form">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{route('productInsert')}}" method="post" enctype="multipart/form-data">
        @csrf
        <h3>Add product</h3>
        <p></p>
        <div class="form-group">
            <label class="formaUnos">Product name:</label>
            <input type="text" class="form-control" name="productName" required="required">
        </div>
        <div class="form-group">
            <label class="formaUnos">Product description:</label>
            <textarea rows="6" class="form-control" name="productDesc" required="required"> </textarea>
        </div>
        <div class="form-group">
            <label class="formaUnos">Product price in &euro;:</label>
            <input type="text" class="form-control" name="productPrice" required="required">
        </div>
        <div class="form-group">
            <label class="formaUnos">Product picture:</label>
            <input type="file" class="form-control" name="productImage" required="required">
        </div>
        <div class="form-group">
            <label class="formaUnos">Product category:</label>
            <select class="form-control" name="productCategory">
                @foreach($categories as $c)
                    <option value="{{$c->id}}">{{$c->naziv}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label class="formaUnos">Product manufacturer:</label>
            <select class="form-control" name="productManufacturer">
                @foreach($manufacturers as $c)
                    <option value="{{$c->id}}">{{$c->naziv}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-success btn-lg btn-block" name="addProduct">Add product</button>
        </div>
    </form>
</div>