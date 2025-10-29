<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    
    <style>
       body {
    /* background:  */
    /* linear-gradient(to bottom, rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)) */
    /* , */
                /* url('images/') no-repeat center center fixed; */
    background-size: cover;
background-color: #daf9e9 !important;
    
    font-family: 'Poppins', sans-serif;
    color: white;   
    /*  */
}


        .navbar {
            padding: 0 15px;
        }

        .navbar-brand .logo-container {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
        }

        .navbar-brand img {
            max-width: 120px;
            height: auto;
            margin: 5px 10px 5px 0;
        }

        .navbar-nav {
            align-items: center;
        }

        .navbar-nav .nav-item {
            margin: 5px 10px;
        }

        .navbar-nav .btn {
            background-color: white;
            color: black;
            font-size: 1rem;
            padding: 8px 15px;
            border-radius: 5px;
        }

        .navbar-nav .btn:hover {
            background-color: #f0f0f0;
        }

        /* Tablet and below */
        @media screen and (max-width: 768px) {
            .navbar-brand img {
                max-width: 100px;
            }

            .navbar-nav .btn {
                font-size: 0.9rem;
                padding: 6px 12px;
            }

            .navbar-collapse {
                background-color: rgba(0, 0, 0, 0.9);
                padding: 10px;
            }

            .navbar-nav {
                flex-direction: column;
                text-align: center;
            }

            .navbar-nav .nav-item {
                margin: 10px 0;
            }
        }

        /* Mobile phones */
        @media screen and (max-width: 500px) {
            .navbar-brand img {
                max-width: 50px;
            }

            .navbar-nav .btn {
                font-size: 0.8rem;
                padding: 5px 10px;
            }

            .modal-dialog {
                margin: 10px;
            }

            .modal-body {
                font-size: 0.9rem;
            }
        }

        /* Modal styling */
        .modal-content {
            border-radius: 10px;
        }

        .modal-header {
            background-color: rgb(0, 122, 61);
            color: white;
        }

        .modal-body ul {
            list-style-type: disc;
            padding-left: 20px;
        }

        .modal-footer .btn {
            background-color: rgb(0, 122, 61);
            color: white;
        }
    </style>
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-transparent topbar mb-4">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('logo.png') }}" alt="Logo" class="img-fluid">
                <img src="{{ asset('logo2.png') }}" alt="Logo" class="img-fluid">
                <img src="{{ asset('logo4 (2).png') }}" alt="Logo" class="img-fluid">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#account" aria-controls="account" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="account">
               <ul class="navbar-nav ml-auto">
    {{-- <li class="nav-item">
        <a class="nav-link bg-white text-dark px-4 py-3 rounded" data-toggle="modal" data-target="#eligibilityModal">
            Eligibility Criteria
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link bg-white text-dark px-4 py-3 rounded" href="{{ url('/check-cnic') }}">
            Track your ID
        </a>
    </li> --}}

    @guest
        {{-- <li class="nav-item">
            <a class="nav-link bg-white text-dark px-4 py-3 rounded" href="{{ route('login') }}">
                {{ __('Login') }}
            </a>
        </li> --}}

        <li class="nav-item">
            <a class="nav-link text-white px-4 py-0 rounded-3" href="{{ route('login') }}" style= "background-color:#e26024; border-radius: 12px; font-size: 1.8rem; padding: 2px 28px;">
                {{ __('message.Admin_') }}
            </a>
        </li>

        {{-- @if (Route::has('register'))
            <li class="nav-item">
                <a class="nav-link bg-white text-dark px-4 py-3 rounded" data-toggle="modal" data-target="#regModal">
                    {{ __('Register') }}
                </a>
            </li>
        @endif
    @else
        @auth
            @if(auth()->user()->role == '1' || auth()->user()->role == '3' || auth()->user()->role == '4')
                <li class="nav-item">
                    <a class="nav-link bg-white text-dark px-4 py-3 rounded" href="/">
                        {{ __('Dashboard') }}
                    </a>
                </li>
            @endif
        @endauth --}}

        


        {{-- <li class="nav-item">
            <a class="nav-link bg-white text-dark px-4 py-3 rounded" href="{{ route('logout') }}"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </li> --}}
    @endguest
</ul>


            </div>
        </div>
    </nav>

    
    <div class="modal fade" id="regModal" tabindex="-1" role="dialog" aria-labelledby="regModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title w-100 text-center" id="eligibilityModalLabel">Registration Announcement</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body px-5" style="background-color:lightgreen;">
                    <ul>
                        <li>Registration will re-open after the formal announcement.</li>

                    </ul>
                </div>
                <div class="modal-footer" style="background-color:lightgreen;">
                    <button type="button" class="btn btn-sm" data-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>

 
    window.addEventListener('load', function () {

        // Toggle collapse when hamburger is clicked
        $('.navbar-toggler').click(function () {
            $('#account').collapse('toggle');
        });

        // Collapse navbar after clicking a nav link on mobile
        $('.navbar-nav .nav-link').click(function () {
            if ($(window).width() < 992) {
                $('#account').collapse('hide');
            }
        });
    });
    </script>
</body>
</html>
