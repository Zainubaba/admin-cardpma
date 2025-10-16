    @if (Auth::user()->verify == '1')

    <!DOCTYPE html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>PMA | CMS</title>

        <link rel="shortcut icon" href="{{ asset('images/colour change-01.png') }}">
        <!-- Fonts -->
        <link rel='stylesheet'
            href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css'>

        <style>
            @import url('https://fonts.googleapis.com/css?family=Poppins:400,700,900');

            body {

                background-image: url("/img/BACKGROUND-01.png");
                background-repeat: no-repeat;

                /* Center the image */
                background-size: cover;
                /* background-position: center; */
                width: 100vw;
                font-family: 'Poppins', sans-serif;
                min-height: 100vh;
                overflow: hidden;

            }

            /* media queries */


            @media (max-width:1600px) {
                #img {

                    height: 100px;
                    width: 120px;
                    margin-top: 12px;
                    margin-left: 20px;
                    padding-left: 20px;

                }

                #logo {
                    line-height: 1.2;
                    padding: 30px;
                    margin-top: 10px;
                    margin-left: 20px;
                }

                #heading1 {
                    font-size: 40px;
                    padding-left: 30px;
                    line-height: 1.1;
                    color: white;
                    margin-top: 35px;
                    text-decoration: none;
                    font-family: 'Poppins', sans-serif;
                    font-weight: 500;
                }

                #heading2 {
                    font-size: 20px;
                    padding-left: 40px;
                    line-height: 1.2;
                    color: white;
                    font-family: 'Poppins', sans-serif;
                    font-weight: 100;
                }

                .card {
                    margin-top: 30px;
                    padding: 3px;
                    margin-left: 40px;
                }

                .button {
                    margin-top: 30px;
                    padding: 3px;
                    margin-left: 20px;
                    border: 1px solid white;

                }
            }


            @media (max-width:1205px) {
                #img {

                    height: 90px;
                    width: 120px;
                    margin-top: 7px;
                    padding-right: 20px;

                }

                #logo {
                    margin-top: 2px;
                }

                #heading1 {
                    font-size: 30px;
                    padding-left: 30px;
                    line-height: 1;
                    color: white;
                    margin-top: 20px;
                    text-decoration: none;
                    font-family: 'Poppins', sans-serif;
                    font-weight: 500;
                }

                #heading2 {
                    font-size: 16px;
                    padding-left: 40px;
                    line-height: 1.2;
                    color: white;
                    font-family: 'Poppins', sans-serif;
                    font-weight: 100;
                }

                .card {
                    margin-left: 0px;

                }
            }


            @media (max-width:1120px) {
                #img {

                    height: 80px;
                    width: 120px;
                    padding-right: 20px;
                    padding-top: 5px;
                }


                #logo {
                    font-size: 12px;

                }

                .card {
                    margin-left: 0px;

                }

                #heading1 {
                    font-size: 25px;
                    padding-left: 30px;
                    line-height: 1.1;
                    color: white;
                    margin-top: 35px;
                    text-decoration: none;
                    font-family: 'Poppins', sans-serif;
                    font-weight: 500;
                }
            }

            @media (max-width:1060px) {
                #img {

                    height: 80px;
                    width: 120px;
                    padding-right: 20px;
                    padding-top: 0px;

                }

                #logo {
                    font-size: 10px;
                }

                #heading1 {
                    font-size: 20px;
                    padding-left: 30px;
                    line-height: 1.1;
                    color: white;
                    margin-top: 35px;
                    text-decoration: none;
                    font-family: 'Poppins', sans-serif;
                    font-weight: 500;
                }

                .card {
                    margin-left: 0px;

                }
            }

            @media (max-width:885px) {

                #img {

                    height: 60px;
                    width: 100px;
                    padding-right: 20px;
                    padding-top: 0px;

                }

                #logo {
                    font-size: 8px;
                    margin-top: -3px;
                    margin-left: 30px;

                }

                .card {
                    margin-left: 0px;

                }

            }


            @media (max-width:767px) {

                #img {

                    height: 60px;
                    width: 100px;
                    padding-right: 20px;
                    margin-top: 5px;

                }


                #logo {

                    font-size: 11px;
                    margin-top: -75px;
                    margin-left: 80px;

                }

                .card {
                    margin-top: 30px;
                    padding: 3px;
                    margin-left: 0px;
                    width: 100px;

                }

                .button {
                    margin-top: 30px;
                    padding: 5px;
                    margin-left: 20px;
                    border: 1px solid white;
                    width: 120px;
                }
            }

            @media (max-width:742px) {

                #img {

                    height: 50px;
                    width: 100px;
                    padding-right: 20px;
                    margin-top: 10px;
                }

                #logo {
                    font-size: 11px;
                    margin-top: -70px;
                    margin-left: 100px;

                }

                .card {
                    margin-left: 0px;
                }


            }

            @media screen and (max-width: 678px) {
                #img {

                    height: 60px;
                    width: 100px;
                    padding-right: 20px;
                    margin-top: 5px;
                }

                #logo {
                    font-size: 11px;
                    margin-top: -75px;
                    margin-left: 100px;

                }

                .card {
                    margin-left: 0px;
                }

            }

            @media (max-width:540px) {
                #img {

                    height: 60px;
                    width: 100px;
                    padding-right: 20px;
                    margin-top: 3px;
                }

                #logo {
                    font-size: 11px;
                    margin-top: -75px;
                    margin-left: 100px;

                }

                #heading1 {
                    font-size: 16px;
                    padding-left: 30px;
                    line-height: 1.1;
                    color: white;
                    margin-top: 35px;
                    text-decoration: none;
                    font-family: 'Poppins', sans-serif;
                    font-weight: 500;
                }

                .card {
                    margin-left: 0px;
                }
            }


            @media only screen and (max-width: 450px) {
                #img {

                    height: 60px;
                    width: 100px;
                    padding-right: 20px;
                    margin-top: 4px;
                }

                #logo {
                    font-size: 11px;
                    margin-top: -75px;
                    margin-left: 90px;

                }

                #heading2 {
                    font-size: 12px;
                }

                .card {
                    margin-left: 0px;
                }

            }

            @media only screen and (max-width: 375px) {
                #img {

                    height: 60px;
                    width: 100px;
                    padding-right: 20px;
                    margin-top: 3px;
                }

                #logo {
                    font-size: 11px;
                    margin-top: -75px;
                    margin-left: 90px;

                }

                .card {
                    margin-left: 0px;
                }


            }

            @media only screen and (max-width: 320px) {
                #img {

                    height: 60px;
                    width: 100px;
                    padding-right: 20px;
                    margin-top: 3px;
                }

                #logo {
                    font-size: 10px;
                    margin-top: -75px;
                    margin-left: 90px;

                }

                #heading1 {
                    margin-top: 10px;
                }

                .card {
                    margin-left: 0px;
                }


            }
        </style>






        <div class="row" style="color:white">

            <div class="col-md-1">
                <img src="img/PMA WEB-04.png" id="img" style="">
            </div>

            <div class="col-md-4" style="">
                <div id ="logo">PUNJAB MASSTRANSIT AUTHORITY<br>
                    Government of the Punjab
                </div>
            </div>

            <div class="col-md-7"></div>
        </div>

    <body>

        <div class="container-fluid">

            <div class="col-md-8" id="heading1" style="">
                <p>
                    Welcome to <br>
                    Punjab Mass Transit Authority<br>
                    Complaint Management System
                </p>
            </div>

            <div class="col-md-6" id="heading2">
                At Punjab Mass Transit System, your feedback matters.
                Our commitment to providing safe, efficient, and reliable
                public transportation services is unwavering, and we value
                your input in helping us achieve this goal.
            </div>

            <div class="col-md-6">
            </div>

        </div>

        <div class="row" style="padding-left:80px;">

            @if (Auth::user()->role == 'Admin')
                <div class="card col-md-2">
                    <a href="/adminnew" style="color:#4f5985; text-decoration:none;">
                        <div class="" style="text-align:center">
                            Dashboard
                        </div>
                    @elseif(Auth::user()->role == 'network')
                        <div class="card col-md-2">
                            <a href="/networknew" style="color:#4f5985; text-decoration:none;">
                                <div class="" style="text-align:center">
                                    Dashboard
                                </div>
                            @elseif(Auth::user()->role == 'Secretary')
                                <div class="card col-md-2">
                                    <a href="/mddash" style="color:#4f5985; text-decoration:none;">
                                        <div class="" style="text-align:center">
                                            Dashboard
                                        </div>

                                        {{-- return redirect('/mddash'); --}}
                                    @elseif(Auth::user()->role == 'Middleman')
                                        <div class="card col-md-2">
                                            <a href="/regcomplain" style="color:#4f5985; text-decoration:none;">
                                                <div class="" style="text-align:center">
                                                    Dashboard
                                                </div>
                                            @elseif(Auth::user()->role == 'Assistant_manager')
                                                <div class="card col-md-2">
                                                    <a href="/task" style="color:#4f5985; text-decoration:none;">
                                                        <div class="" style="text-align:center">
                                                            Dashboard
                                                        </div>
                                                    @elseif(Auth::user()->role == 'General_Manager')
                                                        <div class="card col-md-2">
                                                            <a href="/mddash"
                                                                style="color:#4f5985; text-decoration:none;">
                                                                <div class="" style="text-align:center">
                                                                    Dashboard
                                                                </div>
                                                            @elseif (Auth::user()->role == 'Manager')
                                                                <div class="card col-md-2">
                                                                    <a href="/task"
                                                                        style="color:#4f5985; text-decoration:none;">
                                                                        <div class="" style="text-align:center">
                                                                            Dashboard
                                                                        </div>
                                                                    @elseif (Auth::user()->role == 'Deputy_Manager')
                                                                        <div class="card col-md-2">
                                                                            <a href="/task"
                                                                                style="color:#4f5985; text-decoration:none;">
                                                                                <div class=""
                                                                                    style="text-align:center">
                                                                                    Dashboard
                                                                                </div>

                                                                                @elseif (Auth::user()->role == 'CCC')
                                                                                <div class="card col-md-2">
                                                                                    <a href="/cccregcomplain"
                                                                                        style="color:#4f5985; text-decoration:none;">
                                                                                        <div class=""
                                                                                            style="text-align:center">
                                                                                            Dashboard
                                                                                        </div>

                                                                                        @elseif (Auth::user()->role == 'CCC_Dashboard')
                                                                                        <div class="card col-md-2">
                                                                                            <a href="/cccDashboard"
                                                                                                style="color:#4f5985; text-decoration:none;">
                                                                                                <div class=""
                                                                                                    style="text-align:center">
                                                                                                    Dashboard
                                                                                                </div>
                                                                            @else
                                                                                <div class="card col-md-2">
                                                                                    <a href="/user"
                                                                                        style="color:#4f5985; text-decoration:none;">
                                                                                        <div class=""
                                                                                            style="text-align:center">
                                                                                            Dashboard
                                                                                        </div>
            @endif
            </a>
        </div>


        <div class="col-md-8"></div>
        </div>

        </div>

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
            integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
        </script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
        </script>

    </body>

    </html>


    @else

    @include('auth.passwords.code')


    @endif
