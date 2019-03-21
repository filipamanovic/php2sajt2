@include('front.common.head')
@include('front.common.nav')
<div class="container">
    <div class="row">
        @yield('content_left')
        @yield('content_right')
    </div>
</div>
@yield('content')
@include('front.common.footer')