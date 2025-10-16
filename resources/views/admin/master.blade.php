@include('admin.header')
<div id="wrapper">
    <!-- Sidebar -->
@include('admin.navbar')

 
    <!-- Sidebar -->
@include('admin.sidebar')
    <!-- Sidebar -->
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
  
        <!-- Container Fluid-->
     @yield('content')
     </div>
        <!-- Footer -->
      
        @include('admin.footer')
</div >
</div>

 
  
