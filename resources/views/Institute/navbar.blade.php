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
        background-image: url('/images/welcome2.png');
        background-size: cover;
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-position: center;
        background-color: #f4f4f4;
        min-height: 100vh;
    }

    .navbar {
        width: 100%;
        background: linear-gradient(to bottom, rgba(3, 1, 32, 0.6) 0%, rgba(3, 1, 32, 0.6) 100%);
        padding: 0;
        z-index: 1000;
    }

    .navbar .container-fluid {
        height: 35px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0 5px;
    }

    .navbar-brand {
        font-size: 0.9rem;
        color: white;
        text-align: center;
        flex-grow: 1;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        margin: 0;
        padding: 0 5px;
    }

    .navbar-nav {
        display: flex;
        align-items: center;
        margin: 0;
        padding: 0;
    }

    .nav-link {
        color: white !important;
        font-size: 0.7rem;
        padding: 0 3px;
        margin: 0;
    }

    .navbar-toggler {
        color: white;
        border: none;
        padding: 0.1rem 0.3rem;
        font-size: 0.8rem;
        margin: 0;

    }

    @media (max-width: 991px) {
        body {
            background-size: cover;
        }
        .navbar .container-fluid {
            height: 35px;
            padding: 3px 5px;
        }
        .navbar-brand {
            font-size: 0.85rem;
        }
        .nav-link {
            font-size: 0.65rem;
        }
    }

    @media (max-width: 575px) {
        body {
            background-size: cover;
            background-position: top center;
        }
        .navbar .container-fluid {
            height: 35px;
            padding: 2px 4px;
        }
        .navbar-brand {
            font-size: 0.8rem;
        }
        .nav-link {
            font-size: 0.6rem;
            padding: 2px;
        }
    }

    @media (max-width: 400px) {
        body {

            background-size: cover;
            background-position: top center;
        }
        .navbar .container-fluid {
            height: 35px;
            padding: 1px 3px;
        }
        .navbar-brand {
            font-size: 0.7rem;
        }
        .nav-link {
            font-size: 0.5rem;
            padding: 1px;
        }
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
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
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
