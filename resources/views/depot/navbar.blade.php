<style>
    
body{
    /* background-image: url(images/welcome.png); */
    /* background: linear-gradient(to bottom, rgba(15, 12, 49, 0.6) 0%, rgba(15, 12, 49, 0.6)100%), url(images/welcome.png) no-repeat center center fixed; */
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
@media screen and(max-width:1024px){
    .container-fluid{
        width: 10px;
    }
}
</style>


<!-- Navigation -->
<nav class="navbar navbar-expand navbar-dark sm-navbar topbar mb-4 " style="padding-left:0%; padding-right:0%; padding-top:0%;">
    <div class="container-fluid" style="background: linear-gradient(to bottom, rgba(3, 1, 32, 0.6) 0%, rgba(3, 1, 32, 0.6) 100%);  width: 100%;  height: 70px; ">
           
           <div style="margin:auto";>
             <a class="navbar-brand ml-auto" style= "color:white;" href="#" >
                <b style = "text-align:center; font-size:22px;">Welcome To Depot Dashboard</b>
             </a>
           </div>
           {{-- <li class="nav-item"> --}}
            @auth
            <a style="color: white;" class="nav-link" href="/userdashboard">{{ __('<<Back') }}</a>
            @else
            <a style="color: white;" class="nav-link" href="{{ route('login') }}">{{ __('<<Back') }}</a>
            @endauth
        </li>
  
         
        {{-- <a class="navbar-brand logo-font" style= "color:white" href="#">
       Punjab Masstransit Authority
       <br> Government of Punjab 
        </a> --}}

        <!-- links toggle -->
       <!--  <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#links" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button> -->
        <!-- account toggle -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#account" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                <i class="fas fa-bars" style="color:white; font-size:28px;"></i>
            </button>

            </div>
        <div class="collapse navbar-collapse" id="account" >
        
        <ul class="navbar-nav mb-auto mt-0 ml-auto" style=" color:white;">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a  style="color: white;" class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a  style="a: white;" class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
               
</li>
                        @endguest
                    </ul>
            
        </div>   
</nav>   


<div class="container">
      <div class="row">

</div>
</div>



</body>
</html>