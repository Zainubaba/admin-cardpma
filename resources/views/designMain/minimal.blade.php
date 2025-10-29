@if(empty($hideHeaderFooter))
@include('design_main.headernew')
@endif
<div id="wrapper">
    <!-- Sidebar -->
    @if(empty($hideNavbar))
{{-- @include('design_main.sidebarnew') --}}
@endif
 

  
        <!-- Container Fluid-->
     @yield('content')
    
</div>
       {{-- @if(empty($hideHeaderFooter))    
        @include('design_main.footer')
          @endif --}}

 
  




















{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Page')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @stack('styles')
</head>
<body>
    @yield('content')
    @stack('scripts')
</body>
</html> --}}
