@extends('design_main.s')
@section('content')

<style>
  /* media querry */
  @media screen and (max-width:600px){
    .fc h1 span a{
      font-size: 16px;
      margin-top: 10px;

    }

    
  }
/* body{
  background-image: url("/images/pic1.png");
  /* background-color: #013B7c; */
  background-repeat: no-repeat, repeat;
  background-size: cover;



}

body {
            background: linear-gradient(to bottom, rgba(62, 54, 173, 0.6) 0%, rgba(62, 54, 173, 0.6) 100%), url(images/welcome.png) no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
            font-family: 'Poppins';

        }
.col-md-7{
    font-size: 60px;
    font-family: 'poppins-bold', sans-serif !important;
    padding-top:70px;
    padding-left:10px;

}




</style>


<body>



 <div class="container-fluid px-5">
          <div class="row">
            <div class="fc col-md-7 col-sm-3 " style="color:rgb(255, 255, 255);">

                <h1  style="text-align: center"><span style="font-weight:750;  "> <a style="background-color:#141c84; "> PERSONALIZED STUDENT'S T CASH CARDS</a>
                    <br>BY PUNJAB MASSTRANSIT
                        <br> AUTHORITY
                        </h1></span>
                    </a>
                    <h6 style="text-align:center; margin-top:40px;">GOVERNMENT OF THE PUNJAB</h6>
            </div>

            <div class="col-md-5 col-sm-12">
              <div class="row img" style=";">
                {{-- --------------- --}}

                <div class="col-md-12 ">
                    <div class="img">
                  <div class="mb-2">
                    <img src="/images/first.png" alt="" class="img-fluid" style="border:3px solid#FFFFFF; height:500px;"/>
                  </div>
                </div>
                  {{-- <div class="ps-2">
                    <img src="/images/third.png" alt="" class="img-fluid" style="border:3px solid#FFFFFF; height:250px; " />
                  </div> --}}
                </div>
                {{-- <div class="col-md-6 ">
                  <div class="mb-2">
                    <img src="/images/sec.png" alt="" class="img-fluid" style="border:3px solid#FFFFFF; height:250px; " />
                  </div>
                  <div class="ps-2">
                    <img src="/images/fourth.png" alt="" class="img-fluid" style="border:3px solid#FFFFFF; height:250px; " />
                  </div>
                </div> --}}
              </div>
            </div>

          </div>
        </div>
      </section>
<!--
<div class="container-fluid"  style="padding-left:20%; padding-top:10%; " >
            </div>
<div class="" style="height:400px; width:100%;">
<div class="" style=" margin-top:100px; margin-left:100px; ">
    <div class="row justify-content-center" style="margin-left:0%;margin-right:0%"> -->
        <!-- <div class="col-xs-4" >
            <div class="card" style = "background-color:#905352; color:white; align-items:center;"> -->

                <!-- <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                  <div class= "wel"> <b style = "text-align:center;">Welcome To Punjab MassTransit Authority</b></div>
                </div>
            </div> -->
        <!-- </div> -->
    </div>
</div>
</div>
</body>

 @endsection

{{-- @extends('design_main.s')
@section('content')
<style>
body{
  background-image: url("/images/final-Card.jpg");
  background-repeat: no-repeat, repeat;
  background-size: cover;
  padding-top: 0px;
  padding-bottom: 0px;
}

@media screen and (max-width: 500px){
                .card{
                    margin-top:70px;
                    margin-right:100px;
        }

            }
</style>

<body>
<div class="" style="height:400px; width:100%;">
<div class="" style=" margin-top:100px; margin-left:100px; ">
    <div class="row justify-content-center" style="margin-left:0%;margin-right:0%">
        <div class="col-xs-4" >
            <div class="card" style = "background-color:#905352; color:white; align-items:center;">

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                  <div class= "wel"> <b style = "text-align:center;">Welcome To Punjab MassTransit Authority</b></div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</body>

 @endsection --}}


