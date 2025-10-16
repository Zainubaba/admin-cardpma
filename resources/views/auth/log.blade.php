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
           
        }
    </style>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-transparent fixed-top" >
            <a class="navbar-brand" href="#">
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

            <div class="row" style="margin-top: 240px;">
                <div class="col-md-6">

                </div>
                <div class="col-md-6 bg-light" style="height: 380px; margin-top:-50px; border-radius: 37px;">
                    <div class="container">
                        <h1 style="text-align: center; font-weight: 900; font-size: 44px; color:rgb(2, 2, 131); margin-top:10px;">LogIn</h1>
                    
                    <div class="form-group" style="margin-top: 50px;">
                        <label for="" >{{ __('E-mail :') }}</label>
                            <input id="" type="" class="form-control" name="" required 
                            style=" background-color:#453ba5; opacity: 1; color:white;">
                    </div>
                    <div class="form-group">
                        <label for="" >{{ __('Password :') }}</label>
                            <input id="" type="password" class="form-control" name="" required 
                            style=" background-color:#453ba5; opacity: 1; color:white;">
                    </div>
                    <div class="form-group">
                        <button  type="submit" style="color:white; text-align:center; background-color:#453ba5;"  class="btn form-control" >LogIn</button>
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

