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
                    height: 700px; margin-top:-50px; border-radius: 37px;
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
                              <a href="#"><img src="{{ asset('logo2.png') }}" width="120px" height="auto" style="margin-top:-25px;"></a>
   
                <a href="#"><img src="{{ asset('logo.png') }}" width="120px" height="auto"
                        style="margin-top:-25px"></a>
                        <a href="#"><img src="{{ asset('logo4 (2).png') }}" width="auto" height="auto"
                        style="margin-top:-25px"></a>
   {{-- <a href="#"><img src="{{ asset('logo3.png') }}" width="120px" height="auto" style="margin-top:-25px;"></a> --}}

                <a class="navbar-brand txt " style="color:white; margin-top:-20px;" href="#">
                    <span style=""> PUNJAB MASSTRANSIT AUTHORITY</span>
                    <br>
                    <p style="margin-top: -12px;">GOVERNMENT OF THE PUNJAB</p>

                </a>
                </div>
            </a>
            {{-- this is menu button --}}
            {{-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button> --}}

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
<div class="container-fluid py-5">
  <div class="row justify-content-center">
    <div class="col-md-10">
      <div class="row text-center justify-content-center">
        
        <!-- Icon 1 + Button -->
        <div class="col-md-5 col-sm-8 mb-4">
          <img 
            src="{{ asset('images/auth/icon01.png') }}" 
            alt="Icon 1" 
            class="img-fluid mb-3"
            style="max-width: 100%; width: 350px;">
          <a href="/oppmaform" class="btn btn-primary btn-block">Registration</a>
        </div>
        
        <!-- Icon 2 + Button -->
        <div class="col-md-5 col-sm-8 mb-4">
          <img 
            src="{{ asset('images/auth/732395.png') }}" 
            alt="Icon 2" 
            class="img-fluid mb-3"
            style="max-width: 100%; width: 350px;">
          <a href="/institute_reg" class="btn btn-success btn-block">Institute Registration</a>
        </div>

      </div>
    </div>
  </div>
</div>



<style>
    .bg-light{

    }
</style>


              <!--   <div class="col-md-3 col-sm-12 bg-light" style="">
                    <div class="container">

                        <h1
                            style="text-align: center; font-weight: 900; font-size: 34px; color:rgb(68, 68, 68); margin-top:0px;">
                            Register</h1>
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="form-group">
                                <label for="name">{{ __('Name') }}</label>
                                <input id="name" type="text"
                                    class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                    pattern="[a-zA-Z\s]+" name="name" required
                                    style=" background-color:#6353f562; opacity: 1; color:white;">
                            </div>
                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                            <div class="form-group">
                                <label for="contactnumber">{{ __('Contact Number') }}</label>
                                <input id="phone_number" type="number"
                                    class="form-control{{ $errors->has('phone_number') ? ' is-invalid' : '' }}"
                                    name="phone_number" required pattern="[0-9]{13}"  min="00000000000" max="99999999999"  oninput="checkPhoneLength(this)" maxlength="11"
                                    placeholder="Start from 0"
                                    style=" background-color:#6353f562; opacity: 1; color:white;">
                            </div>
                            @if ($errors->has('phone_number'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('phone_number') }}</strong>
                                </span>
                            @endif
                            <div class="form-group">
                                <label for="cnic">{{ __('CNIC') }}</label>
                                <input id="cnic" type="number"
                                    class="form-control{{ $errors->has('cnic') ? ' is-invalid' : '' }}"
                                    name="cnic" min="1000000000000" max="9999999999999"  oninput="checkLength(this);" maxlength="13" required placeholder="Without dashes"
                                    style=" background-color:#6353f562; opacity: 1; color:white;">
                            </div>
                            @if ($errors->has('cnic'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('cnic') }}</strong>
                                </span>
                            @endif
                            <div class="form-group">
                                <label for="city">{{ __('City') }}</label>

                                  <select class="form-control" id="province" name="city" required="required" style="background-color:#ececf4">
                                      <option style=" background-color:#6353f562; opacity: 1; color:white;" value="">Select City First</option>
                                      @foreach (App\Models\District::all() as $key => $value)
                                      <option value="{{ $value->id }}">{{ $value->name }}</option>
                                      @endforeach
                                    </select>
                            </div>
                            <div class="form-group">
                                <label for="">{{ __('E-mail') }}</label>
                                <input id="email" type="email"
                                    class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                    name="email" required
                                    style=" background-color:#6353f562; opacity: 1; color:white;">
                            </div>
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                            <div class="form-group">
                                <label for="">{{ __('Password') }}</label>
                                <input id="password" type="password"
                                    class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                    name="password" required placeholder="alphanumeric minimum 8 characters"
                                    style=" background-color:#6353f562; opacity: 1; color:white;">
                            </div>
                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                            <div class="form-group">
                                <label for="password-confirm">{{ __('Confirm Password') }}</label>


                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" required
                                    style=" background-color:#6353f562; opacity: 1; color:white;">

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

                            <input type="hidden" value="1" id="role" name="role"
                                style="text-align:center;">
                            <div class="row">
                                <div class="col text-center">
                                    <button type="submit"
                                        style="color:white; border-radius: 10px; text-align:center; background-color:#110b46; width:100px;"
                                        class="btn mt-3">
                                        <b>
                                            REGISTER
                                        </b>
                                    </button>
                                </div>
                            </div>
                    </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    </div> -->

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>

<script>
    function checkPhoneLength(input) {
      if (input.value.length > 11) {
        input.value = input.value.slice(0, 11); // Restrict to 13 digits
      }
    }

    function checkLength(input) {
    if (input.value.length > 13) {
      input.value = input.value.slice(0, 13); // Restrict to 13 digits
    }
  }
  </script>
</body>

</html>
