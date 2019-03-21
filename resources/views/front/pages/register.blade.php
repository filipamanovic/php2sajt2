@extends('layouts.front')
@section('content_left')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="signup-form">
    <div id="odgovorBaze" class="alert alert-primary" role="alert"></div>
    <form>
        <h2>Register</h2>
        <p class="hint-text">Create your account. It's free and only takes a minute.</p>
        <div class="form-group">
            <div class="row">
                <div class="col-6">
                    <input type="text" class="form-control" id="firstName" placeholder="First name" required="required">
                    <label class="formaGreska" id="nameReg">Allowed only letters</label>
                </div>
                <div class="col-6">
                    <input type="text" class="form-control" id="lastName" placeholder="Last name" required="required">
                    <label class="formaGreska" id="lastNReg">Allowed only letters</label>
                </div>
            </div>
        </div>
        <div class="form-group">
            <input type="email" class="form-control" id="email" placeholder="Email" required="required">
            <label class="formaGreska" id="emailReg">Not allowed email format</label>
        </div>
        <div class="form-group">
            <input type="password" class="form-control" id="password" placeholder="Password" required="required">
            <label class="formaGreska" id="passReg">Requires min seven characters with one: lowercase letter, capital letter and number.</label>
        </div>
        <div class="form-group">
            <input type="text" class="form-control" id="tel" placeholder="Contact tel" required="required">
            <label class="formaGreska" id="telReg">Contact format +???/??????-???</label>
        </div>
        <div class="form-group">
            <input type="text" class="form-control" id="grad" placeholder="City" required="required">
            <label class="formaGreska" id="cityReg">Allowed only letters </label>
        </div>
        <div class="form-group">
            <button type="button" class="btn btn-success btn-lg btn-block" id="btnReg">Register Now</button>
        </div>
        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
    </form>
    <div class="text-center">Already have an account? <a href="" data-toggle="modal" data-target="#exampleModal2" style="color: #138496; text-decoration: none">Login</a></div>
    </div>
@endsection