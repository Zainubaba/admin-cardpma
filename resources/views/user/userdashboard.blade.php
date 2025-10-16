@include('design_main.header')
<div id="wrapper">
    <!-- Sidebar -->
    <style>   
body{
  /* background: linear-gradient(to bottom, rgba(62, 54, 173, 0.6) 0%, rgba(62, 54, 173, 0.6) 100%), url(images/welcome.png) no-repeat center center fixed; */
  /* background-image: url(images/welcome.png); */
  background-repeat: no-repeat, repeat;
  height:auto; 
  width:100%;
  -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
  padding-top: 0px;
  font-family: 'Poppins';
  
 
}
    /* .box {
        direction: rtl;
        display: flex;
        justify-content: center;
        margin-top: 640px;
        margin-bottom: 0px;
        margin-left:0px;
        margin-right:0px;
} */
@media screen and (max-width : 400px ){
    .navbar-brand{
        font-size: 13px;
    }
}

@media only screen and (max-width: 2000px) and (min-width: 600px)  {
    .navbar-brand{
        font-size:35px;
    }
   
}




</style>


<!-- Navigation -->
<nav class="navbar navbar-expand navbar-dark sm-navbar topbar mb-4" style="padding-left:0%; padding-right:0%; padding-top:0%;">
        <div class="container-fluid" style="background: linear-gradient(to bottom, rgba(2, 0, 24, 0.6) 0%, rgba(2, 0, 24, 0.6) 100%);  width: 100%;  height: 70px; ">
               
               <div style="margin:auto";>
                 <a class="navbar-brand ml-auto" style= "color:white;" href="#" >
                    <b style = "text-align:center; font-size:22px;">Welcome To User's Dashboard</b>
                 </a>
               </div>
               {{-- <li class="nav-item"> --}}
                
                @auth
                <a style="color: white;" class="nav-link" href="/userdashboard">{{ __('<<Back') }}</a>
                @else
                <a style="color: white;" class="nav-link" href="{{ route('login') }}">{{ __('<<Back') }}</a>
                @endauth
            {{-- </li> --}}
      
      
</nav>   


<!-- <button type="button" class="btn btn-info">Info</button> -->

</div>
 <!-- Bootstrap core JS-->
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>



    <!-- Sidebar -->
    @include('design_main.sidebar')
    <!-- Sidebar -->
    <div id="content-wrapper" class="d-flex flex-column " >
        <div id="content">
            <!-- Container Fluid-->
            @yield('content')
        </div>
    </div>
{{-- <div class="box" style="background-color: white">
            <img style="width: 50px;" src="{!! asset('/images/pitb logo.jpeg') !!}" />
            <small style="margin-top: 30px"><b><span>copyright &copy; <script> document.write(new Date().getFullYear()); </script> - developed by
        <b ><a style="color: #7d0000; " href="" target="_blank">(PITB)</a></b></b></small>
            <img style="width: 60px;" src="{!! asset('logo.png') !!}" />
          </div> --}}
    
</div>

{{-- @extends('design_main.master')
@section('content')

<body>
<div class="" style="height:400px; width:100%;"> 
<div class="" style=" margin-top:100px; margin-left:100px; ">
    <div class="row justify-content-center" style="margin-left:0%;margin-right:0%">
        <div class="col-xs-4" >
            <div class="card" style = "background-color:#905352; color:white; align-items:center;">

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                
                  <div class= "wel"> <b style = "text-align:center;">Welcome To User's Dashboard</b></div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</body>






@endsection --}}