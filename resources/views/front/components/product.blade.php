
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="card h-100">
            <a class="viewsUpdate" data-id="{{$product->p_id}}" href="{{ url('/product/'.$product->p_id)  }}">
                <img class="card-img-top" style="height: 160px;" src="{{asset($product->src)}}" alt="{{$product->alt}}">
            </a>
            <div class="card-body">
                <h4 class="card-title">
                    <a class="viewsUpdate" data-id="{{$product->p_id}}" href="{{ url('/product/'.$product->p_id) }}" style="text-decoration: none; color: #138496;"> {{ $product->naziv }} </a>
                </h4>
                <input type="hidden" id="tokenViews" value="{{csrf_token()}}">
                <h5 style="color: #138496;">&euro;{{ $product->cena }}</h5>
                <p class="card-text">{{ $product->opis  }}</p>
            </div>
        </div>
    </div>
