{{-- userdashvboard navbar hitting on this page too--}}
<style>
    body {
        /* background:  url(images/welcome.png)  center center fixed; */
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
    @media screen and (max-width:768px){
        .notnav{
            width: 100%;
        }
    }
    @media screen and (max-width: 500px) {
        .navbar-brand {
            font-size: 13px;
        }
    }
    @media screen and (max-width:450px){
        .notnav{
            width: 150%;
        }
    }
    @media screen and (max-width:425px){
        .notnav{
            width: 100%;
        }
        .navbar-brand b{
            margin-left: 60px;
            font-size: 12px;
        }

    }
    @media screen and (max-width:375px){
        .notnav{
            width: 120%;
        }
        .notnav b{
            width: 10%;
        }
        .navbar-brand b{
        font-size: 15px;
        margin-left: 60px;
    }

    }
    @media screen and (max-width:320px){
        .notnav{
            width: 50%;
        }
    }


    @media screen and (max-width:320px){
        .navbar-brand b{
            font-size:10px;
            margin-left: 5px;
        }
        .notnav{
            width: 140%;
        }
        .nav-item a{
            margin-left: 10px;

        }
    }

</style>


<!-- Navigation -->
<nav class="navbar navbar-expand navbar-dark sm-navbar topbar mb-4 notnav" style="padding-left:0%; padding-right:0%; padding-top:0%;">
    <div class="container-fluid" style="background: linear-gradient(to bottom, rgba(2, 0, 24, 0.6) 0%, rgba(2, 0, 24, 0.6) 100%);  width: 100%;  height: 70px; ">

        <div style="margin:auto">
            <a class="navbar-brand ml-auto " style= "color:white;" href="#" >
               <b style = "text-align:center;  color:white;">Welcome To Head Institute Dashboard</b>
            </a>
          </div>
          {{-- <li class="nav-item"> --}}
           @auth
           <a style="color: white;" class="nav-link" href="{{ url()->previous() }}">{{ __('<<Back') }}</a>
           @else
           <a style="color: white;" class="nav-link" href="{{ route('login') }}">{{ __('<<Back') }}</a>
           @endauth
       </li>
            <!-- Authentication Links -->
            @guest
                <li class="nav-item">
                    <a style="color: white;" class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @if (Route::has('register'))
                    <li class="nav-item">
                        <a style="color: white;" class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif
            {{-- @else --}}
                {{-- <li class="nav-item">
                    <a style="color:white;" class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li> --}}
            @endguest
        </ul>

    </div>
</nav>

</div>



</body>

</html>
