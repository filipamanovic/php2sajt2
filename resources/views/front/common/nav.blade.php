<body>
<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">PC & Equipment</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href=" {{url('/')}} ">Home
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                @if(session()->has('user'))
                <li class="nav-item">
                    <a class="nav-link" href="{{route('user', ['user'=> session()->get('user')->id])}}">My profile</a>
                </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('author') }}">Author
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                @if(session()->has('user') && session()->get('user')->uloga == 'admin')
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/admin/user')}}">Admin panel</a>
                </li>
                @endif
            </ul>
            <ul class="navbar-nav ml-auto">
                @if(session()->has('user') && session()->get('user')->aktivan == 1)
                <li class="dropdown nav-item">
                    <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                        <i class="fa fa-user"></i>
                        {{ session()->get('user')->ime.' '.session()->get('user')->prezime  }}
                        <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="{{route('user', ['user'=> session()->get('user')->id])}}" class="nav-link" style="color: #4e555b"><i class="fa fa-address-card"></i> My profile</a>
                        </li>
                        <li>
                            <a href="{{ route('logout') }}" class="nav-link" style="color: #4e555b"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
                @else
                <li class="nav-item">
                    <a class="nav-link" href="" data-toggle="modal" data-target="#exampleModal2">
                        <span class="fa fa-user" aria-hidden="true"></span> Login
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/register') }}">
                        <span class="fa fa-sign-in" aria-hidden="true"></span> Register
                    </a>
                </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
@if(session()->has('noUser'))
<div class="container">
    <div class="alert alert-success">
        {{ session()->get('noUser') }}
    </div>
</div>
<?php session()->forget('noUser'); ?>
@endif

<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="signup-form" style="padding-bottom: 0px;">
                <h2>Login</h2>
            </div>
            <div class="modal-body">
                <form action="{{route('login')}}" method="post">
                    @csrf
                    <p></p>
                    <div class="form-group">
                        <input type="email" class="form-control" name="emailLog" placeholder="Email" required="required">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="passLog" placeholder="Password" required="required">
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success" name="login">Login now</button>
                    </div>
                </form>
                <div class="text-center">You don't have account? Register here: <a href="{{ url('/register') }}" style="color: #138496; text-decoration: none">Register</a></div>
            </div>
        </div>
    </div>
</div>