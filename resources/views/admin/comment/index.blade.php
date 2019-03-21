@extends('layouts.admin')
@section('main')
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header">
                        Manage Comments
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
                            <a href="" data-toggle="modal" data-target="#adminCommentInsert"  class="btn btn-primary" >Add new comment</a>
                        </li>
                    </ol>
                    <div class="col-md-8">
                        <div id="odgovor"></div>
                        <table class="table table-striped table-condensed table-bordered tabe-responsive" style="font-size: 14px;">
                            <tr>
                                <th>Product_ID</th>
                                <th>Product Name</th>
                                <th>User Name</th>
                                <th>Comment</th>
                                <th>Delete</th>
                                <th>Update</th>
                            </tr>
                            @foreach($comments as $c)
                            <tr>
                                <td>
                                    {{ $c->proizvod_id }}
                                </td>
                                <td>
                                    {{ $c->naziv }}
                                </td>
                                <td>
                                    {{ $c->ime.' '.$c->prezime }}
                                </td>
                                <td>
                                    {{ $c->text }}
                                </td>
                                <td>
                                    <a href=""  class="adminDeleteComment btn btn-danger" data-id="{{$c->k_id}}">Delete</a>
                                </td>
                                <td>
                                    <a href="" data-id="{{$c->k_id}}" data-toggle="modal" data-target="#adminCommentUpdate" class="adminUpdateComment btn btn-success">Update</a>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                        <input type="hidden" id="csrf" value="{{csrf_token()}}">
                        <nav aria-label="Page navigation">
                            <ul class="pagination">
                                {{$comments->links()}}
                            </ul>
                        </nav>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@component('admin.comment.insert_modal', ['products' => $products, 'users' => $users])@endcomponent
@component('admin.comment.update_modal', ['products' => $products, 'users' => $users])@endcomponent
