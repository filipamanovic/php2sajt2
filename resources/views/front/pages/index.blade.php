@extends('layouts.front')
@section('content_left')
    @component('front.components.sort_component', ['categories'=>$categories, 'manufacturers'=>$manufacturers])@endcomponent
@endsection


@section('content_right')
    <div class="col-lg-9" style="margin-top: -24px;">
        <div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
            <ol class="carousel-indicators">
                <?php
                $brojac = 0;
                foreach ($products as $item):
                if ($brojac == 0):
                ?>
                <li data-target="#carouselExampleIndicators" data-slide-to="<?=$brojac?>" class="active"></li>
                <?php else: ?>
                <li data-target="#carouselExampleIndicators" data-slide-to="<?=$brojac?>"></li>
                <?php
                endif;
                $brojac ++;
                endforeach;
                ?>
            </ol>
            <div class="carousel-inner" role="listbox">
                <?php
                $brojac2 = 0;
                foreach ($products as $item):
                if($brojac2 == 0):
                ?>
                <div class="carousel-item active">
                    <img class="d-block img-fluid" src="{{ asset($item->src) }}" alt="First slide" style="height: 32vw; width: 100%;">
                </div>
                <?php else: ?>
                <div class="carousel-item">
                    <img class="img-fluid" src="{{ asset($item->src) }}" alt="Second slide" style="height: 32vw; width: 100%;">
                </div>
                <?php endif; $brojac2++; endforeach; ?>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>

        <div class="row">
            @foreach($products as $p)
            @component('front.components.product', ['product' => $p]) @endcomponent
            @endforeach
        </div>
        <div class="row justify-content-md-center">
            {{$products->links()}}
        </div>
    </div>
@endsection