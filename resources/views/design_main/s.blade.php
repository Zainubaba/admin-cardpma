@if(empty($hideHeaderFooter))
@include('design_main.header')
@endif
<div id="wrapper">
    <!-- Sidebar -->
    @if(empty($hideNavbar))
@include('design_main.navbar2')
@endif
 

  
        <!-- Container Fluid-->
     @yield('content')
    
</div>
       @if(empty($hideHeaderFooter))    
        @include('design_main.footer')
          @endif

 
  
