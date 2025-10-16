@extends('design_main.s')
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
          <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="" pattern="[a-z]{3,25}" required autofocus style=" background-color:#905352; opacity: 1; color:white;">

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
  @endsection