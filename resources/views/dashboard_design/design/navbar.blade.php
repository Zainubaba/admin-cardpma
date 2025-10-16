<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>PMA T-Cash Card</title>

  <link rel="icon" href="{{ asset('img/resize-01.png') }}" type="image/png"/>


  <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css'>
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css'>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<link rel="stylesheet" href="/stepwise/style.css">


<link rel="stylesheet" href="{{ asset('css/app.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">



</head>


<nav class="navbar navbar-expand-lg" style="background-color:#111a33; color:white;">
    <a class="navbar-brand" href="/" style="color:white">
            <p style="color:white;margin-top:0%; font-size:16px;"><p>

    </a>

    <button class="navbar-toggler border-0 sidebarToggle" type="button" data-toggle="collapse" data-target="#navigation">
        {{-- <i id="menuIcon" class="fas fa-bars h4" style="color: white;" onclick="toggleMenuIcon()"></i> --}}
        <div class="logout-button">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a class="btn btn-sm btn" style="background-color:#111a33; color:white; border: 1px solid white"
                   onmouseover="this.style.backgroundColor='white'; this.style.color='#111a33';"
                   onmouseout="this.style.backgroundColor='#111a33'; this.style.color='white';"
                   href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                    {{ __('Logout') }}
                </a>
            </form>
        </div>

    </button>
    <div class="collapse navbar-collapse text-center" id="navigation">
        <ul class="navbar-nav mx-auto align-items-center">
            <!-- Navbar links -->
        </ul>
        @auth
        <!-- Logout button in navbar for non-DD pages -->
        <div class="logout-button">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a class="btn btn-sm btn" style="background-color:#111a33; color:white; border: 1px solid white"
                   onmouseover="this.style.backgroundColor='white'; this.style.color='#111a33';"
                   onmouseout="this.style.backgroundColor='#111a33'; this.style.color='white';"
                   href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                    {{ __('Logout') }}
                </a>
            </form>
        </div>
                @else
        <a href="/login" class="btn btn-sm btn" style="background-color:#111a33; color:white; border: 1px solid white"

        onmouseover="this.style.backgroundColor='white'; this.style.color='#111a33';"
        onmouseout="this.style.backgroundColor='#111a33'; this.style.color='white';"
>Login</a>
        @endauth
    </div>
</nav>
