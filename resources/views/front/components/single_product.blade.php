<div class="col-lg-9" style="margin-top: -25px;">
    <div class="card mt-4">
         <img class="card-img-top img-fluid" src="{{ asset($product->src) }}" alt="{{ $product->alt }}">
         <div class="card-body">
              <h3 class="card-title" style="color: #138496;">{{ $product->naziv  }}</h3>
              <h4 style="color: #138496;">&euro; {{ $product->cena  }}</h4>
              <p class="card-text">{{ $product->opis  }}</p>
         </div>
         <div class="card-footer">
             <span class="float-left"><i class="fa fa-eye" aria-hidden="true"></i>{{ ' '.$product->pregledano }}</span>
             <span class="float-right">Created at: {{ ' '.date('d-m-Y', $product->datum) }}</span>
         </div>
    </div>


            <div class="card card-outline-secondary my-4">
                <div class="card-header">
                    Product Reviews
                </div>
                <div class="card-body">
                    @if(count($comments) == 0)
                        {{ "There are currently no product reviews." }}
                    @else
                    @foreach ($comments as $item)
                        <p>{{ $item->text }}</p>
                        <small class="text-muted">
                        Posted by {{ $item->ime.' '.$item->prezime  }} on {{ date('d-m-Y', $item->datum)  }}
                        </small>
                        <hr>
                    @endforeach
                    @endif
                    <hr>
                    @if(session()->has('user'))
                        <a href="#" class="btn btn-success" data-toggle="modal" data-target="#exampleModal3">Leave a Review</a>
                        @component('front.components.review_modal', ['product' => $product])@endcomponent
                    @else
                        You want to leave a comment? <a href="" data-toggle="modal" data-target="#exampleModal2"> Sing in!</a>
                    @endif
                </div>
            </div>
        </div>



