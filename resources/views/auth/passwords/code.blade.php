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
        body {
            background: linear-gradient(to bottom, rgba(15, 12, 49, 0.6) 0%, rgba(15, 12, 49, 0.6)100%), url(images/welcome.png) no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
            font-family: 'Poppins';
        }

        label {
            font-size: 16px;
            font-weight: 800;
            /* margin-bottom: -10px;
            margin-top: -10px; */
        }

        input {
            margin-bottom: -15px;
            margin-top: -5px;
        }
        .navbar-brand span{
            font-weight: 900;
            font-size: 30px;
        }
        .imgback{
                background: linear-gradient(to bottom, rgba(18, 13, 88, 0.86) 0%, rgba(18, 13, 88, 0.86) 100%);
            }
            .bg-light{
                    height: 550px; margin-top:-50px; border-radius: 37px;
            }
        @media screen and (max-width: 991px) {

            .navbar-brand span{
                font-size: 22px;
                margin: 20px;
                padding: 0px;
            }
            .navbar-brand p{
                font-size: 20px;
                margin: 0px;
                padding: 0px;
            }
            .nav-item{
                margin-top: 40px;
            }

        }
        @media screen and (max-width: 480px) and (min-width: 0px) {
            .imgback{
                background: none;
            }
            .nav-item{
                margin-top: 60px;
            }
            .navbar-brand span{
                font-size: 18px;
                margin: 0px;
                padding: 0px;
            }
            .navbar-brand p{
                font-size: 16px;
                margin: 0px;
                padding: 0px;
            }
        }
        @media screen and (max-width:768px){
            .navbar-expand {

            }
        }
@media screen and (max-width:1024px){
    .imgback{
        margin-left: -100px;;
    }
}

        @media screen and (max-width: 800px) {
            .imgback{
                display: none;
            }
        }

    </style>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-transparent " style="">
            <a class=" log navbar-brand" href="#">
                <a href="/login"><img src="{{ asset('logo.png') }}" width="120px" height="auto"
                        style="margin-top:-25px"></a>
                <a class="navbar-brand txt " style="color:white; margin-top:-20px;" href="#">
                    <span style=""> PUNJAB MASSTRANSIT AUTHORITY</span>
                    <br>
                    <p style="margin-top: -12px;">GOVERNMENT OF THE PUNJAB</p>

                </a>
                </div>
            </a>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav  ml-auto " style="margin-top: 0px; ">

                    @guest
                        <li class="nav-item active" style="margin-top: -50px;">
                            <a style="color: white;" class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <!-- <li class="nav-item">
                                    <a style="color: white;" class="nav-link"
                                        href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li> -->
                        @endif
                    @else
                        <li class="nav-item">
                            <a style="color:white;" class="dropdown-item" href="{{ route('logout') }}"
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

    <div class="container" style="">
        <div class="row justify-content-center">

            <div class="col-md-6">
                <div class="card" style="text-align: center;">
                    <div class="card-header" style="background-color:#18345c; margin-top:2%; color:white">
                        <b>{{ __('CODE VERIFICATION') }}</b></div>
                    @if (Session::has('message'))
                        <div class="alert alert-info">{{ Session::get('message') }}</div>
                    @endif
                    <div class="card-body">
                        <form method="POST" action="{{ route('verifi') }}">
                            @csrf
                            @if ($errors->any())
                                <h4>{{ $errors->first() }}</h4>
                            @endif
                            <div class="row mb-3">
                                <label for="code" style="padding:20px;"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Enter 5 Digit Code') }}</label>

                                <div class="col-md-6" style="padding:20px;">
                                    <input style="padding:20px;" id="code" type="code" placeholder="- - - - -"
                                        class="form-control @error('code') is-invalid @enderror" name="otp"
                                        value="{{ old('code') }}" required autocomplete="code" autofocus>

                                    @error('code')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <span id="countdown"></span> <!-- Countdown timer -->
                                </div>
                            </div>

                    <?php
                    $phoneno = AUTH::USER()->phone_number;
                    $cnic = Auth::user()->cnic;
                    ?>

                            <br>

                         <button class="btn" id="resend-otp" style="display:none;" onmouseover="this.style.backgroundColor='#18345c'; this.style.color='white'"
                             onmouseout="this.style.backgroundColor='white'; this.style.color='#18345c'">

                        <a href="/robocall/{{$phoneno}}/{{$cnic}}" style="text-decoration: none; color:black"> Robo Call </a>
                        </button>

                        <!-- Resend OTP link -->

                            <button type="submit" class="btn" style="background-color: #18345c; color:white">
                                {{ __('SUBMIT') }}
                            </button>


                        </form>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    let countdownDuration = 10;
    const countdownElement = document.getElementById('countdown');
    const resendLink = document.getElementById('resend-otp');

    let phone_number = @json(Auth::user()->phone_number);
    let cnic = @json(Auth::user()->cnic);

    if (!countdownElement || !resendLink) {
        console.error("Countdown or Resend OTP element not found!");
        return;
    }

    // Function to check robocall count first
    fetch(`/check-robocalls/${encodeURIComponent(phone_number)}/${encodeURIComponent(cnic)}`)
        .then(response => response.json())
        .then(data => {
            console.log("Robocall Count:", data.count); // Debugging
            if (data.count >= 2) {
                countdownElement.style.display = 'block';
                countdownElement.innerHTML = `You have already accessed Robo Call twice today. As a result, Robo Call is not available at this time. Please try again tomorrow.`;
            } else {
                // Start countdown only if Robo Call is allowed
                countdownElement.style.display = 'block';
                startCountdown();
            }
        })
        .catch(error => console.error('Error fetching robocalls count:', error));

    function startCountdown() {
        function updateCountdown() {
            if (countdownDuration > 0) {
                countdownElement.innerHTML = `You can request a Robo Call in <strong>${countdownDuration}</strong> seconds, if you can't receive OTP.`;
                countdownDuration--;
            } else {
                resendLink.style.display = 'inline-block'; // Show robocall button
                countdownElement.style.display = 'none'; // Hide countdown message
                clearInterval(countdownInterval);
            }
        }

        const countdownInterval = setInterval(updateCountdown, 1000);
        updateCountdown(); // Run once immediately
    }
});
</script>
