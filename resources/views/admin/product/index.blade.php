@extends('layouts.admin')
@section('main')
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header">
                        Manage Products
                    </h3>
                    @if(session()->has('message'))
                        <div class="container">
                            <div class="alert alert-success">
                                {{ session()->get('message') }}
                            </div>
                        </div>
                        <?php session()->forget('message'); ?>
                    @endif
                    <ol class="breadcrumb">
                        <li class="active">
                            <a href="" data-toggle="modal" data-target="#adminProductInsert"  class="btn btn-primary" >Add new product</a>
                        </li>
                    </ol>
                    <div class="col-md-8">
                        <div id="odgovor"></div>
                        <table class="table table-striped table-condensed table-bordered tabe-responsive" style="font-size: 14px;">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Desc</th>
                                <th>Price</th>
                                <th>Checked</th>
                                <th>Owner</th>
                                <th>Category</th>
                                <th>Manufacturer</th>
                                <th>Image</th>
                                <th>Delete</th>
                                <th>Update</th>
                            </tr>
                            @foreach($products as $p)
                            <tr>
                                <td>
                                    {{ $p->p_id }}
                                </td>
                                <td>
                                    {{ $p->naziv }}
                                </td>
                                <td>
                                    {{ $p->opis }}
                                </td>
                                <td>
                                    {{ $p->cena }}
                                </td>
                                <td>
                                    {{ $p->pregledano }}
                                </td>
                                <td>
                                    {{ $p->ime.' '.$p->prezime }}
                                </td>
                                <td>
                                    {{ $p->kat_naziv }}
                                </td>
                                <td>
                                    {{ $p->pro_naziv }}
                                </td>
                                <td>
                                    <img src="{{asset($p->src)}}" width="100px" height="70px">
                                </td>
                                <td>
                                    <a href=""  class="adminDeleteProduct btn btn-danger" data-id="{{$p->p_id}}">Delete</a>
                                </td>
                                <td>
                                    <a href="" data-id="{{$p->p_id}}" data-toggle="modal" data-target="#adminProductUpdate" class="adminUpdateProduct btn btn-success">Update</a>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                        <input type="hidden" id="csrf" value="{{csrf_token()}}">
                        <nav aria-label="Page navigation">
                            <ul class="pagination">
                                {{$products->links()}}
                            </ul>
                        </nav>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@component('admin.product.insert_modal', ['users'=>$users,'categories'=>$categories,'manufacturers'=>$manufacturers])@endcomponent
@component('admin.product.update_modal', ['users'=>$users,'categories'=>$categories,'manufacturers'=>$manufacturers])@endcomponent
