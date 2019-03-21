@extends('layouts.front')
@section('content_left')
    <div class="col-lg-3 signup-form">
        <p class="hint-text">Info about the owner</p>
        <ul class="list-group">
            <li class="list-group-item list-group-item-info">Name: {{ $product->ime.' '.$product->prezime }}</li>
            <li class="list-group-item list-group-item-info">Contact: {{ $product->kontakt  }}</li>
            <li class="list-group-item list-group-item-info">City: {{ $product->grad }}</li>
            <li class="list-group-item list-group-item-info">Registration: {{ date('d-m-Y', $product->vremeRegistracije) }}</li>
        </ul>
    </div>
@endsection
@section('content_right')
    @component('front.components.single_product', ['product' => $product, 'comments' => $comments]) @endcomponent
@endsection

