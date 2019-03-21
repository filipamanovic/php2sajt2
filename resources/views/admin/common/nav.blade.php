<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="{{url('/admin/user')}}">SB Admin</a>
    </div>
    <!-- Top Menu Items -->
    <ul class="nav navbar-right top-nav">
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-user"></i>
                {{ ' '.session()->get('user')->ime.' '.session()->get('user')->prezime }}
                <b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li>
                    <a href="{{url('/')}}"><i class="fa fa-check"></i> Back</a>
                </li>
                <li>
                    <a href="{{route('logout')}}"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                </li>
            </ul>
        </li>
    </ul>
    <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <input type="hidden" id="navToken" value="{{csrf_token()}}">
        <ul class="nav navbar-nav side-nav">
            <li>
                <a href="{{url('/admin/user')}}"><i class="fa fa-fw fa-user"></i> Users </a>
                <a href="{{ url('/admin/comment/index') }}"><i class="fa fa-comments-o"></i> Comments </a>
                <a href="{{ url('/admin/product/index') }}"><i class="fa fa-desktop"></i> Products</a>
            </li>
        </ul>
    </div>
    <!-- /.navbar-collapse -->
</nav>