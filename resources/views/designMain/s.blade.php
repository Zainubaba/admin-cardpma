@if(empty($hideHeaderFooter))
@include('designMain.header')
@endif
<div id="wrapper">
    <!-- Sidebar -->
    @if(empty($hideNavbar))
@include('designMain.navbar2')
@endif
 

  
        <!-- Container Fluid-->
     @yield('content')
    
</div>
       @if(empty($hideHeaderFooter))    
        @include('designMain.footer')
          @endif

 
  
