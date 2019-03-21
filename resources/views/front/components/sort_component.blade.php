<div class="col-lg-3">
    <form action="{{route('sortProduct')}}" method="get">
        <h3 class="my-4">Sort products:</h3>
        <p class="hint-text">Choose category:</p>
        <select class="form-control" name="category_id">
            <option value="null">All..</option>
            @foreach($categories as $c)
                <option value="{{$c->id}}">{{$c->naziv}}</option>
            @endforeach
        </select>
        <hr>
        <p class="hint-text">Choose manufacturer:</p>
        <select class="form-control" name="manufacturer_id">
            <option value="null">All..</option>
            @foreach($manufacturers as $m)
                <option value="{{$m->id}}">{{$m->naziv}}</option>
            @endforeach
        </select>
        <hr>
        <p class="hint-text">Choose price range:</p>
        <div class="row">
            <div class="col-6">
                <input type="number" class="form-control" name="price_min" placeholder="min">
            </div>
            <div class="col-6">
                <input type="number" class="form-control" name="price_max" placeholder="max">
            </div>
        </div>
        <p></p>
        <p></p>
        <button class="btn btn-outline-info" type="submit" id="btnSort">Search</button>
    </form>
</div>