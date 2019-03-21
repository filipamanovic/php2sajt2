<div class="col-lg-4 col-md-6 mb-4">
    <div class="card h-100">
            <img class="card-img-top" style="height: 160px;" src="{{asset($product->src)}}" alt="{{$product->alt}}">
        <div class="card-body">
            <h4 class="card-title" style="color: #138496;">
                 {{ $product->naziv }}
            </h4>

            <h5 style="color: #138496;">&euro;{{ $product->cena }}</h5>
            <p class="card-text">{{ $product->opis  }}</p>
        </div>
        <div class="card-footer">
            <button class="btn btn-outline-warning updateAd" data-id="{{ $product->p_id }}" data-id2="{{ $product->id}}" data-toggle="modal" data-target="#exampleModal">Update</button>
            <a class="btn btn-outline-danger deleteAd" href="{{route('user', ['user'=> session()->get('user')->id])}}" data-id="{{ $product->p_id }}">Delete</a>
        </div>
    </div>
</div>

