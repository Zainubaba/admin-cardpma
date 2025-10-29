@include('design_main.header')
<div id="wrapper">
    <style>
        
    </style>
    <!-- Sidebar -->
    @if(empty($hideNavbar))
    @include('design_main.nav')
@endif

    <!-- Sidebar -->
    @include('design_main.sidebar')
    <!-- Sidebar -->
    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <!-- Container Fluid-->
            @yield('content')
        </div>
    </div>

    <!-- Footer -->

</div>
