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
            background: linear-gradient(to bottom, rgba(62, 54, 173, 0.6) 0%, rgba(62, 54, 173, 0.6) 100%), url(images/bg.jpeg) no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
            font-family: 'Poppins';
        }
        label{
            font-size: 22px;
            font-weight: 800;
            margin-bottom: -10px;
            margin-top: -10px;
        }
        input{
            margin-bottom: -5px;
        }
    </style>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-transparent fixed-top" >
            <a class="navbar-brand" href="#">
                <a href="#"><img src="{{ asset('logo.png') }}" width="120px" height="auto"
                        style="margin-top:-25px"></a>
                                         <a href="#"><img src="{{ asset('logo2.png') }}" width="120px" height="auto" style="margin-top:-25px;"></a>
   
                <a href="#"><img src="{{ asset('logo.png') }}" width="120px" height="auto"
                        style="margin-top:-25px"></a>
                        <a href="#"><img src="{{ asset('logo4 (2).png') }}" width="auto" height="auto"
                        style="margin-top:-25px"></a>
   {{-- <a href="#"><img src="{{ asset('logo3.png') }}" width="120px" height="auto" style="margin-top:-25px;"></a> --}}

                <a class="navbar-brand ml-auto" style="color:white; margin-top:-20px;" href="#">
                    <span style="font-weight: 900; font-size: 30px;"> PUNJAB MASSTRANSIT AUTHORITY</span>
                    <br>
                    <p style="margin-top: -12px;">GOVERNMENT OF THE PUNJAB</p>

                </a>
                </div>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav  ml-auto " style="margin-top: -55px;">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">
                            <span style="font-weight: 900; font-size: 30px; color:white;">Login</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <span style="font-weight: 900; font-size: 30px; color:white;">Register</span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <div class="container">
        <div class="col-md-12">

            <div class="row" style="margin-top: 140px;">
                <div class="col-md-2 ">

                </div>
                <div class="col-md-6 " style="height: 490px; background: linear-gradient(to bottom, rgba(42, 31, 196, 0.6) 0%, rgba(42, 31, 196, 0.6) 100%);">
                    <div class="row" style="margin-top: -20px;">
                        <div class="col-md-1"></div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <img src="{{ asset('images/auth/icon1.png') }}" width="200px" alt="" style="margin-top: 20px;">
                                <br>
                                <img src="{{ asset('images/auth/icon1text.png') }}" width="127px" alt="" style="margin-top: -70px; margin-left:25px;">
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <img src="{{ asset('images/auth/icon2.png') }}" width="200px" alt="" style="margin-top: 0px; margin-left:20px;">
                                <br>
                                <img src="{{ asset('images/auth/icon2text.png') }}" width="300px" alt="" style="margin-top: -125px;  margin-left:-30px;">
                            </div>
                        </div>
                        <div class="col-md-1"></div>
                        <div class="col-md-1"></div>
                        <div class="col-md-5">
                            <div class="form-group" style="margin-top: -160px;">
                                <img src="{{ asset('images/auth/icon3.png') }}" width="200px" alt="">
                                <br>
                                <img src="{{ asset('images/auth/icon3text.png') }}" width="230px" alt="" style="margin-top: -80px; margin-left:-20px;">
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group" style="margin-top: -160px;">
                                <img src="{{ asset('images/auth/icon4.png') }}" width="200px" alt="">
                                <br>
                                <img src="{{ asset('images/auth/icon4text.png') }}" width="230px" alt="" style="margin-top: -80px;  margin-left:-20px;">
                            </div>
                        </div>
                        <div class="col-md-1"></div>
                    </div>
                    
                </div>
                <div class="col-md-4 bg-light" style="height: 580px; margin-top:-50px; border-radius: 37px;">
                    <div class="container">
                        <h1 style="text-align: center; font-weight: 900; font-size: 44px; color:rgb(2, 2, 131); margin-top:10px;">Register</h1>
                    <div class="form-group">
                        <label for="" >{{ __('Name') }}</label>
                            <input id="" type="text" class="form-control" name="" required 
                            style=" background-color:#453ba5; opacity: 1; color:white;">
                    </div>
                    <div class="form-group">
                        <label for="" >{{ __('Contact Number') }}</label>
                            <input id="" type="" class="form-control" name="" required 
                            style=" background-color:#453ba5; opacity: 1; color:white;">
                    </div>
                    <div class="form-group">
                        <label for="" >{{ __('CNIC') }}</label>
                            <input id="" type="" class="form-control" name="" required 
                            style=" background-color:#453ba5; opacity: 1; color:white;">
                    </div>
                    <div class="form-group">
                        <label for="" >{{ __('City') }}</label>
                            <input id="" type="" class="form-control" name="" required 
                            style=" background-color:#453ba5; opacity: 1; color:white;">
                    </div>
                    <div class="form-group">
                        <label for="" >{{ __('E-mail') }}</label>
                            <input id="" type="" class="form-control" name="" required 
                            style=" background-color:#453ba5; opacity: 1; color:white;">
                    </div>
                    <div class="form-group">
                        <label for="" >{{ __('Password') }}</label>
                            <input id="" type="password" class="form-control" name="" required 
                            style=" background-color:#453ba5; opacity: 1; color:white;">
                    </div>
                    <div class="form-group">
                        <button  type="submit" style="color:white; text-align:center; background-color:#453ba5;"  class="btn form-control" >REGISTER</button>
                    </div>
                    </div>
                    
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

{{-- @extends('design_main.s')
@section('content')
<style>
body{
  background-image: url("/images/final-Card.jpg");
  background-repeat: no-repeat, repeat;
  background-size: cover; 
  background-position: center;
  padding-top: 0px;
}
@media screen and (max-width: 2000px){

.login-form{
  margin-left:850px
}
}
@media screen and (max-width: 500px){

  .login-form{
  margin-left:80px;
  margin-right:10px;

}
}

</style>


<div class="login-form offset-md-2"  style ="">
    
      <form method="POST" action="{{ route('register') }}">
         @csrf
        <div class="form-group" >
            <h1 style = "text-align:center;"><b > Register</b></h1>
          <label for="name">{{ __('Name') }}</label>
          <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="" pattern="[a-z]{3,15}" required autofocus style=" background-color:#905352; opacity: 1; color:white;">

            @if ($errors->has('name'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif

                   <label for="contactnumber">{{ __('Contact Number') }}</label>
                   <input id="phone_number" type="number" class="form-control{{ $errors->has('phone_number') ? ' is-invalid' : '' }}" name="phone_number" pattern="[0-9]{13}" required placeholder="Start from 0" style=" background-color:#905352; opacity: 1; color:white;">

                                @if ($errors->has('phone_number'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('phone_number') }}</strong>
                                    </span>
                                @endif
                            
          <label for="CNIC">{{ __('CNIC Number') }}</label>
          <input id="CNIC" type="cnic" class="form-control{{ $errors->has('CNIC') ? ' is-invalid' : '' }}" name="CNIC" pattern="[0-9]{13}" required placeholder="Without dashes" style=" background-color:#905352; opacity: 1; color:white;">

                                @if ($errors->has('CNIC'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('CNIC') }}</strong>
                                    </span>
                                @endif
        
          <label for="city">{{ __('City') }}</label>
          <input id="city" type="text" class="form-control{{ $errors->has('CNIC') ? ' is-invalid' : '' }}" name="city" style=" background-color:#905352; opacity: 1; color:white;">

                                @if ($errors->has('city'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                                @endif
          
          <label for="exampleInputEmail1">{{ __('E-mail:') }}</label>
          <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="" required style=" background-color:#905352; opacity: 1; color:white;">

            @if ($errors->has('email'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif          
        </div>
        <div class="form-group">
          <label for="Password">{{ __('Password') }}</label>
          <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required style=" background-color:#905352; opacity: 1; color:white;">

            @if ($errors->has('password'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
            <div class="form-group">
                            <label for="password-confirm" >{{ __('Confirm Password') }}</label>

                            
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required style=" background-color:#905352; opacity: 1; color:white;">
                            
                        </div>
        </div>
        <div class="form-group form-check" >
          <input type="checkbox" style = "background-color:#7d0000" class="form-check-input"  id="exampleCheck1">
          <label class="form-check-label" for="exampleCheck1">I accept the terms and condition</label>
        </div>
        <div class = btn style="text-align:center; 	margin-left: 80px; margin-right: 40px;">
        <input type="hidden" value="4" id="role" name="role" style="text-align:center;">
        <button  type="submit" style="color:white; text-align:center;"  class="btn" >REGISTER</button>
    </div>
     
    </div>
    </form>
  </div>
  @endsection --}}
