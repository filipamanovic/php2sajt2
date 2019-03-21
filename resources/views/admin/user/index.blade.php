@extends('layouts.admin')
@section('main')
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header">
                        Manage Users
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
                            <a href="" data-toggle="modal" data-target="#exampleModal4"  class="btn btn-primary" >Add new user</a>
                        </li>
                    </ol>
                    <div class="col-md-8">
                        <div id="odgovor"></div>
                        <table class="table table-striped table-condensed table-bordered tabe-responsive" style="font-size: 14px;">
                            <tr>
                                <th>ID</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Contact</th>
                                <th>City</th>
                                <th>Active</th>
                                <th>Role</th>
                                <th>Delete</th>
                                <th>Update</th>
                            </tr>
                            @foreach($users as $user)
                            <tr>
                                <td>
                                    {{ $user->id }}
                                </td>
                                <td>
                                    {{ $user->ime }}
                                </td>
                                <td>
                                    {{ $user->prezime }}
                                </td>
                                <td>
                                    {{ $user->email }}
                                </td>
                                <td>
                                    {{ $user->kontakt }}
                                </td>
                                <td>
                                    {{ $user->grad }}
                                </td>
                                <td>
                                    {{ $user->aktivan }}
                                </td>
                                <td>
                                    {{ $user->uloga }}
                                </td>
                                <td>
                                    <a href=""  class="adminDeleteUser btn btn-danger" data-id="{{$user->id}}">Delete</a>
                                </td>
                                <td>
                                    <a href="" data-id="{{$user->id}}" data-toggle="modal" data-target="#adminUserUpdate" class="adminUpdateUser btn btn-success">Update</a>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                        <input type="hidden" id="csrf" value="{{csrf_token()}}">
                        <nav aria-label="Page navigation">
                            <ul class="pagination">
                                {{$users->links()}}
                            </ul>
                        </nav>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@component('admin.user.insert_modal', ['roles' => $roles])@endcomponent
@component('admin.user.update_modal', ['roles' => $roles])@endcomponent
