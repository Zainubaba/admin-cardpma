@include('depot.header')
<div id="wrapper">
    <!-- Sidebar -->
@include('depot.navbar')

 
    <!-- Sidebar -->
@include('depot.sidebar')
    <!-- Sidebar -->
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
  
        <!-- Container Fluid-->
     @yield('content')
     </div>
        <!-- Footer -->
      
      
</div >
</div>

 
  
