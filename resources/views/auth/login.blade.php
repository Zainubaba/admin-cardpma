<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>

    <title>PMA</title>
    <style>

        .captcha-container { margin-bottom: 1.5rem; text-align: center; }
    .captcha-container img { border: 1px solid #ccc; border-radius: 0.5rem; }
    .captcha-container button { margin-left: 0.5rem; padding: 0.25rem 0.5rem; background: #23aab5; color: white; border: none; border-radius: 0.25rem; cursor: pointer; }
    .captcha-container button:hover { background: #237890; }


        body {
            background: linear-gradient(to bottom, rgba(15, 12, 49, 0.6) 0%, rgba(15, 12, 49, 0.6) 100%), url(images/welcome.png) no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
            font-family: 'Poppins';
        }
        label{
            font-size: 16px;
            font-weight: 800;
        }
      /* .navbar  .navbar-brand .head span{
        font-weight: 900;
         font-size: 40px;
       } */
       .heading{
            font-size: 40px;
            font-weight: 900;
        }

        @media screen and  (max-width: 320px) {

            .heading{
                font-size: 16px;

            }
            .nav-item{
                margin-top: 6px;
            }
            .navbar-brand p{
                font-size: 10px;
                margin-top: 5px;

            }


        }
      @media screen and (max-width:425){
        .heading{
                font-size: 16px;

            }
      }

    </style>
</head>




<body>
    <header>



        <nav class="navbar navbar-expand-lg navbar-light bg-transparent fixed-top" >
            <a class="navbar-brand " href="#">
                <a href="#"><img src="{{ asset('logo.png') }}" width="120px" height="auto"
                        style="margin-top:-25px"></a>
                <a class=" ml-auto head " style="color:white; margin-top:-20px;" href="#">

                    <span class="heading"> PUNJAB MASSTRANSIT AUTHORITY</span>
                    <br>
                    <p style="font-size:15px;">GOVERNMENT OF THE PUNJAB</p>

                </a>
                </div>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>



            <div class="collapse navbar-collapse reg" id="navbarSupportedContent">
                <ul class="navbar-nav  ml-auto " style="margin-top: -55px; ">
                @guest
                <!-- <li class="nav-item active">
                    <a style="color: white;" class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li> -->
                @if (Route::has('register'))
                    <li class="nav-item">
                        <a style="color: white;" class="nav-link" data-toggle="modal" data-target="#regModal" >{{ __('Register') }}</a>
                    </li>
                @endif
            @else
                <li class="nav-item">
                    <a style="color:white ;" class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
                @endguest

                </ul>
            </div>
        </nav>
    </header>
@if (session('success'))
    <div class="alert alert-success text-center" style="margin-top:150px">
        {{ session('success') }}
    </div>
@endif
    <div class="login-form" style="margin-top:30px;">
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="container-fluid">
            <div class="col-md-12 col-sm-12">

                <div class="row" style="margin-top: 200px;">
                    <div class="col-lg-7 col-md-6"></div>

                    <div class="col-lg-5 col-md-6 col-sm-12 bg-light" style="height: 430px; margin-top:-50px; border-radius: 37px;">
                        <h1 style="text-align: center; font-weight: 900; font-size: 34px; color:rgb(68, 68, 68); margin-top:20px;">
                            Login
                        </h1>

                        {{-- CNIC --}}
                        <div class="form-group" style="margin-top: 35px;">
                            <label for="cnic">{{ __('CNIC :') }}</label>
                            <input id="cnic"
                                   type="text"
                                   name="cnic"
                                   value="{{ old('cnic') }}"
                                   class="form-control @error('cnic') is-invalid @enderror"
                                   required
                                   autofocus
                                   style="background-color:#6353f562; opacity: 1; color:white;">
                            @error('cnic')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        {{-- Password --}}
                        <div class="form-group">
                            <label for="password">{{ __('Password :') }}</label>
                            <input id="password"
                                   type="password"
                                   name="password"
                                   class="form-control @error('password') is-invalid @enderror"
                                   required
                                   style="background-color:#6353f562; opacity: 1; color:white;">
                            @error('password')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                     <div class="form-group captcha-container">
    <img src="{{ route('captcha.generate') }}?t={{ time() }}" id="captcha-image">
    <button type="button" onclick="document.getElementById('captcha-image').src = '{{ route('captcha.generate') }}?t=' + Date.now()">↻</button>
    <br>
    <input
        type="text"
        name="captcha"
        class="form-input @error('captcha') error @enderror"
        placeholder="Enter CAPTCHA"
        required
    >
    <br>
    @error('captcha')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

                    <div class="row">
                        <div class="col text-center">

                            <button type="submit" style="color:white; text-align:center; background-color:#110b46; width:100px; border-radius: 10px;"  class="btn " >
                                <b>
                                    Submit
                                </b>
                            </button>
                        </div>
                      </div>
                    </div>

                </div>
            </div>
                {{-- end --}}
            </div>
        </div>
    </div>
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
                        <li>Registration will be re-open after formal announcement.</li>

                    </ul>
                </div>
                <div class="modal-footer" style="background-color:lightgreen;">
                    <button type="button" class="btn btn-sm" data-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
</body>

</html>

