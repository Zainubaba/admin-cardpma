{{-- not in use basically--}}
<style>
    @media screen and (max-width: 400px){
body{
  background-image: url("/images/final-Card.jpg");
  background-repeat: no-repeat, repeat;
  background-size: 100px; 
  background-position: center;
  padding-top: 0px;
}
}
</style> 

<!-- Navigation -->
<nav class="navbar navbar-expand-md bg-navbar static-top" style="padding-left:0%; padding-top:0%;">
    <div class="container" style="margin-bottom:px; border-bottom-right-radius:30px;background-color:blue; width: 400px;  height: 100px; opacity: 0.8;">
                <h1 class="mb-0"><a href="#"><img src="logo.png" width="100" height="100" style="margin-left:0px"></a></h1>
         
        <a class="navbar-brand logo-font" style= "color:white" href="#">
       Punjab Masstransit Authority yre
       <br> Government of Punjab
        </a>

        <!-- links toggle -->
       <!--  <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#links" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button> -->
        <!-- account toggle -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#account" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                <i class="fas fa-bars" style="color:#white; font-size:28px;"></i>
            </button>

            </div>
        <div class="collapse navbar-collapse-md " id="account" >
        <style>
           
            </style>
            <ul class="navbar-nav ml-auto" >
            
                <!-- <li style="text-decoration-color: red;" class="nav-item"><a class="nav-link" style= "color:white" href="{{ route('register') }}">{{ __('Register') }}</a></li>
                
                <li class="nav-item"><a class="nav-link" style= "color:white" href="{{ route('login') }}">{{ __('Login') }}</a></li> -->
                @guest
                            <li class="nav-item">
                                <a  style="color: white;" class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a  style="color: white;" class="nav-link" href="/oppmaform">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a style="color:white;" id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                    
                                </a>
                                
                                {{-- <button type="button">Click Me</button> --}}
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                              
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                        
                                    </a>
                                    
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                      
                                    </form>
                                    
                                </div>
                            </li>
                        @endguest
            </ul>
            
        </div>   
</nav>   

</body>
</html>