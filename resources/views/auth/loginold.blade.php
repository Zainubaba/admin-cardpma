@extends('design_main.s')
@section('content')
    <style>
        body {
            background-image: url("/images/final-Card.jpg");
            background-repeat: no-repeat, repeat;
            background-size: cover;
            background-position: center;
            padding-top: 0px;
        }

        ::placeholder {
            color: red;
            opacity: 1;
        }

        @media screen and (max-width: 2000px) {

            .login-form {
                margin-left: 850px
            }
        }

        @media screen and (max-width: 500px) {

            .login-form {
                margin-left: 100px;
                margin-right: 10px;

            }
        }
    </style>


    <div class="login-form" style="margin-top:30px;">
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- <h1 style = "text-align:center;"><b > LogIn </b></h1>
              <input type="email" class="form-control" id="email" name="email" placeholder='&#xf007; USERNAME' style="font-family: FontAwesome; background-color:#905352; color:white; ">
            </div>
            <div class="form-group">
              <input type="password" class="form-control" id="password" name="password" placeholder='&#xf023; PASSWORD' style="font-family: FontAwesome; background-color:#905352; ">
            </div>
            <div class="form-group form-check">
              <input type="checkbox" style = "background-color:#7d0000" class="form-check-input"  id="exampleCheck1">
              <label class="form-check-label" for="exampleCheck1">Remember me</label>
            </div>
            <div class = bn style="text-align:center; ">
            <button  type="submit" style="color:white;"  class="btn" >LOG IN</button>
            
        </div>
        <br><p style = "text-align:center;"> Forget your password? </p>
          </form>
        </div>
      </div> -->

      @guest
                <li class="nav-item active">
                    <a style="color: white;" class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @if (Route::has('register'))
                    <li class="nav-item">
                        <a style="color: white;" class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
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

            
            <div class="form-group">
                <h1 style="text-align:center;"><b> LogIn </b></h1>
                <label for="email">Email</label>
                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                    name="email" required autofocus
                    style="font-family: FontAwesome; background-color:#905352; color:white;">

                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input id="password" type="password"
                    class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required
                    style="font-family: FontAwesome; background-color:#905352;">

                @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Remember me</label>
            </div>
            <div class=bn style="text-align:center;">
                <button type="submit" style="color:white; text-align:center;" class="btn">LOG IN</button>

            </div>
        </form>
    </div>
    </div>
@endsection
