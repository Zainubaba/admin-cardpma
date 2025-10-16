@extends('design_main.s')
@section('content')

      <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <title>Status</title>
      </head>
      <body>
        <div class="flex-1 h-full min-h-screen">
            <style>
                .progress-meter {
                    width: 100%;
                    margin: 100px auto 300px auto;
                }
                .progress-meter .track {
                    position: relative;
                    height: 2px;
                    width: 900px;
                    background: black;
                    top: 50px;
                    left: 10%;
                    margin-left: 20px;
                }
                .progress-meter .progress-points {
                    position: relative;
                    margin: -15px 0 0;
                    padding: auto;
                    list-style: none;
                }
                .progress-meter .progress-point.step-phone:before {
                    /* background: url("/images/pngs-01.png") no-repeat 0 0; */
                    background: url("/images/1.png") no-repeat 0 0;
                    background-size: 100%;
                    background-origin: content-box, padding-box;
                    padding: 5px;
                }
                .progress-meter .progress-point.step-4:before {
                    /* background: url("/images/department (2).png") no-repeat 0 0; */
                    background: url("/images/4 (2).png") no-repeat 0 0; 
                    
                    background-size: 100%;
                    background-origin: content-box, padding-box;
                    padding: 5px;
                }
                .progress-meter .progress-point.step-5:before {
                    /* background: url("/images/pngs-03.png") no-repeat 0 0; */
                    background: url("/images/01.png") no-repeat 0 0;
                    background-size: 100%;
                    background-origin: content-box, padding-box;
                    padding: 5px;
                }
                .progress-meter .progress-point.error:before {
    background-color: red;
}

                .progress-meter .progress-point.step-7:before {
                    /* background: url("/images/department (2).png") no-repeat 0 0; */
                    background: url("/images/4 (2).png") no-repeat 0 0;
                    background-size: 100%;
                    background-origin: content-box, padding-box;
                    padding: 5px;
                }
                .progress-meter .progress-point.step-8:before {
                    /* background: url("/images/forward.png") no-repeat 0 0; */
                    background: url("/images/4.png") no-repeat 0 0;
                    background-size: 100%;
                    background-origin: content-box, padding-box;
                    padding: 5px;
                }
                .progress-meter .progress-point.step-9:before {
                    /* background: url("/images/the-bank-of-punjab-logo-png_seeklogo-238153.png") no-repeat 0 0; */
                    background: url("/images/6,.png") no-repeat 0 0;
                    background-size: 100%;
                    background-origin: content-box, padding-box;
                    padding: 5px;
                }
                .progress-meter .progress-point.step-10:before {
                    /* background: url("/images/pngs-04.png") no-repeat 0 0; */
                    background: url("/images/8,.png") no-repeat 0 0;
                    background-size: 1020px auto;
                    background-size: 100%;
                    background-origin: content-box, padding-box;
                    padding: 5px;
                
                
                }
                .progress-meter .progress-point.step-11:before {
                   /* background: url("/images/railway-station.png") no-repeat center center; */
                   background: url("/images/7,.png") no-repeat center center;
    background-size: contain;
    background-origin: content-box;
    padding: 10px;
                    
                }
                .progress-meter .progress-point.no_suc:before {
                    background-color: #9fa1a0;
                }
                .progress-meter .progress-point.suc:before {
                    background-color: #8dc540;
                }
                .progress-meter .progress-point:before {
                    display: block;
                    margin: -16px auto 0;
                    content: " ";
                    height: 60px;
                    padding: 11px 0 0 0;
                    width: 60px;
                    border: 2px solid white;
                    border-radius: 55px;
                }
                .progress-meter .progress-point {
                    position: absolute;
                    display: block;
                    width: 12%;
                    margin-left: -30px;
                    text-align: center;
                    cursor: pointer;
                    color: #999;
                }
                .step-title {
                   
                    color: black;
                    font-size: 8px;
                }
                ol.progress-points {
                    list-style: none;
                    counter-reset: numList;
                }
                .progress-meter .progress-point:after {
                    counter-increment: numList;
                    content: counter(numList);
                    position: absolute;
                    top: -20px;
                    right: 50px;
                    font-size: 16px;
                    text-align: center;
                    color: black;
                    background-color: white;
                    line-height: 23px;
                    width: 25px;
                    height: 25px;
                    border: 1px solid black;
                    border-radius: 100%;
                }
                @media (min-width: 1024px) {
                    body {
                        overflow: hidden;
                    }
                    .progress-meter {
                        width: 80%;
                        margin-left: 150px;
                    }
                }
                @media (max-width: 960px) and (min-width: 0px) {
                    .progress-meter .track {
                        width: 2px;
                        position: absolute;
                        display: none;
                    }
                    .progress-meter .progress-point {
                        position: static;
                        width: 100%;
                        margin-left: 50%;
                        text-align: left;
                    }
                    .progress-meter .progress-point:before {
                        margin: 0;
                        position: absolute;
                        margin-left: -86px;
                        padding: 8px 0 0 13px;
                    }
                }
                @media screen and (min-width: 960px) {
                    .box {
                        position: fixed;
                        top: auto;
                        right: 0;
                        bottom: 0;
                        left: 0;
                        background-color: #efefef;
                        text-align: center;
                    }
                    .ph12 {
                        font-size: 11px;
                        line-height: 150%;
                        font-family: 'museo500', Verdana, sans-serif;
                        margin: 0 0 6px 0;
                    }
                }
                @media screen and (min-width: 992px) {
                    .ph12 {
                        font-size: 11px;
                    }
                }
                @media screen and (min-width: 1200px) {
                    .ph12 {
                        font-size: 11px;
                    }
                }
                .meter_box {
                    height: 300px;
                }
                .progress-meter .track_down {
                    position: absolute;
                    width: 2px;
                    height: 60px;
                    margin-left:-130px;
                    background: black;
                    
                }
                .sms, .sms2, .sms3, .sms4, .sms5, .sms6, .sms7 {
                    position: absolute;
                    height: 50px;
                    width: 50px;
                    border-radius: 50%;
                    top: -96px;
                    border: 2px solid white;
                }
                .sms img, .sms2 img, .sms3 img, .sms4 img, .sms5 img, .sms6 img, .sms7 img {
                    width: 50px;
                    height: 50px;
                }
                .sms:after, .sms2:after, .sms3:after, .sms4:after, .sms5:after, .sms6:after, .sms7:after {
                    position: absolute;
                    content: '';
                    font-size: 8px;
                    top: 0px;
                    left: 30px;
                }
                .overlay {
                    position: fixed;
                    top: 0;
                    bottom: 0;
                    left: 0;
                    right: 0;
                    background: rgba(0, 0, 0, 0.7);
                    transition: opacity 500ms;
                    visibility: hidden;
                    opacity: 0;
                }
                .overlay:target {
                    visibility: visible;
                    opacity: 1;
                }
                .popup {
                    margin: 70px auto;
                    padding: 20px;
                    background: #fff;
                    border-radius: 5px;
                    width: 30%;
                    position: relative;
                    transition: all 5s ease-in-out;
                }
                .popup h2 {
                    margin-top: 0;
                    color: #333;
                    font-family: Tahoma, Arial, sans-serif;
                }
                .popup .close {
                    position: absolute;
                    top: 20px;
                    right: 30px;
                    transition: all 200ms;
                    font-size: 30px;
                    font-weight: bold;
                    text-decoration: none;
                    color: #333;
                }
                .popup .content {
                    max-height: 30%;
                    overflow: auto;
                }
                @media screen and (max-width: 700px) {
                    .box {
                        width: 70%;
                    }
                    .popup {
                        width: 70%;
                    }
                }
                .fir {
                    position: absolute;
                    font-size: 12px;
                    font-weight: 600;
                    text-align: center;
                    color: rgb(248, 250, 248);
                    background-color: #2596be;
                    line-height: 23px;
                    border-width: 50px;
                    top: -15px;
                    left: 35px;
                    color: white;
                    border: 1px solid white;
                    border-radius: 50%;
                    width: 25px;
                    height: 25px;
                }
                @media screen and (min-width: 961px) {
                    .progress-meter .track {
                        width: 900px;
                    }
                    .progress-meter .track_down {
                        left: 160px;
                    }
                    .progress-meter .track_down2 {
                        left: 280px;
                    }
                    .progress-meter .track_down3 {
                        left: 400px;
                    }
                    .progress-meter .track_down4 {
                        left: 520px;
                    }
                    .progress-meter .track_down5 {
                        left: 640px;
                    }
                    .progress-meter .track_down6 {
                        left: 760px;
                    }
                    .progress-meter .track_down7 {
                        left: 880px;
                    }
                    .sms {
                        left: 130px;
                    }
                    .sms2 {
                        left: 250px;
                    }
                    .sms3 {
                        left: 370px;
                    }
                    .sms4 {
                        left: 490px;
                    }
                    .sms5 {
                        left: 610px;
                    }
                    .sms6 {
                        left: 730px;
                    }
                    .sms7 {
                        left: 850px;
                    }
                    .progress-point.step-phone {
                        left: 10%;
                    }
                    .progress-point.step-4 {
                        left: 22%;
                    }
                    .progress-point.step-5 {
                        left: 34%;
                    }
                    .progress-point.step-7 {
                        left: 46%;
                    }
                    .progress-point.step-8 {
                        left: 58%;
                    }
                    .progress-point.step-9 {
                        left: 70%;
                    }
                    .progress-point.step-10 {
                        left: 82%;
                    }
                    .progress-point.step-11 {
                        left: 94%;
                    }
                }
                @media screen and (max-width: 1200px) and (min-width: 992px) {
                    .progress-meter .track {
                        width: 700px;
                    }
                    .progress-meter .track_down {
                        left: 124px;
                    }
                    .progress-meter .track_down2 {
                        left: 218px;
                    }
                    .progress-meter .track_down3 {
                        left: 312px;
                    }
                    .progress-meter .track_down4 {
                        left: 406px;
                    }
                    .progress-meter .track_down5 {
                        left: 500px;
                    }
                    .progress-meter .track_down6 {
                        left: 594px;
                    }
                    .progress-meter .track_down7 {
                        left: 688px;
                    }
                    .sms {
                        left: 100px;
                    }
                    .sms2 {
                        left: 194px;
                    }
                    .sms3 {
                        left: 288px;
                    }
                    .sms4 {
                        left: 382px;
                    }
                    .sms5 {
                        left: 476px;
                    }
                    .sms6 {
                        left: 570px;
                    }
                    .sms7 {
                        left: 664px;
                    }
                    .progress-point.step-phone {
                        left: 10%;
                    }
                    .progress-point.step-4 {
                        left: 22%;
                    }
                    .progress-point.step-5 {
                        left: 34%;
                    }
                    .progress-point.step-7 {
                        left: 46%;
                    }
                    .progress-point.step-8 {
                        left: 58%;
                    }
                    .progress-point.step-9 {
                        left: 70%;
                    }
                    .progress-point.step-10 {
                        left: 82%;
                    }
                    .progress-point.step-11 {
                        left: 94%;
                    }
                }
                @media screen and (max-width: 991px) and (min-width: 961px) {
                    .progress-meter .track {
                        width: 600px;
                    }
                    .progress-meter .track_down {
                        left: 106px;
                    }
                    .progress-meter .track_down2 {
                        left: 186px;
                    }
                    .progress-meter .track_down3 {
                        left: 266px;
                    }
                    .progress-meter .track_down4 {
                        left: 346px;
                    }
                    .progress-meter .track_down5 {
                        left: 426px;
                    }
                    .progress-meter .track_down6 {
                        left: 506px;
                    }
                    .progress-meter .track_down7 {
                        left: 586px;
                    }
                    .sms {
                        left: 86px;
                    }
                    .sms2 {
                        left: 166px;
                    }
                    .sms3 {
                        left: 246px;
                    }
                    .sms4 {
                        left: 326px;
                    }
                    .sms5 {
                        left: 406px;
                    }
                    .sms6 {
                        left: 486px;
                    }
                    .sms7 {
                        left: 566px;
                    }
                    .progress-point.step-phone {
                        left: 10%;
                    }
                    .progress-point.step-4 {
                        left: 22%;
                    }
                    .progress-point.step-5 {
                        left: 34%;
                    }
                    .progress-point.step-7 {
                        left: 46%;
                    }
                    .progress-point.step-8 {
                        left: 58%;
                    }
                    .progress-point.step-9 {
                        left: 70%;
                    }
                    .progress-point.step-10 {
                        left: 82%;
                    }
                    .progress-point.step-11 {
                        left: 94%;
                    }
                }
                @media screen and (max-width: 960px) and (min-width: 0px) {
                    .progress-meter .track {
                        width: 2px;
                        height: 650px;
                        left: 125px;
                        top: 80px;
                        margin-left: 0px;
                        position: absolute;
                    }
                    .progress-meter .track_down,
                    .progress-meter .track_down2,
                    .progress-meter .track_down3,
                    .progress-meter .track_down4,
                    .progress-meter .track_down5,
                    .progress-meter .track_down6,
                    .progress-meter .track_down7,
                    .sms,
                    .sms2,
                    .sms3,
                    .sms4,
                    .sms5,
                    .sms6,
                    .sms7 {
                        display: none;
                    }
                    .progress-meter .progress-point.step-phone:before {
                        top: -20px;
                    }
                    .progress-meter .progress-point.step-4:before {
                        top: 80px;
                    }
                    .progress-meter .progress-point.step-5:before {
                        top: 160px;
                    }
                    .progress-meter .progress-point.step-7:before {
                        top: 240px;
                    }
                    .progress-meter .progress-point.step-8:before {
                        top: 320px;
                    }
                    .progress-meter .progress-point.step-9:before {
                        top: 400px;
                    }
                    .progress-meter .progress-point.step-10:before {
                        top: 480px;
                    }
                    .progress-meter .progress-point.step-11:before {
                        top: 560px;
                    }
                    .ph12 {
                        font-size: 11px;
                        line-height: 110%;
                        font-family: 'museo500', Verdana, sans-serif;
                        margin-top: 50px;
                    }
                }
                @media screen and (max-width: 767px) and (min-width: 550px) {
                    .progress-meter .track {
                        left: 110px;
                    }
                }
                @media screen and (max-width: 549px) and (min-width: 401px) {
                    .progress-meter .track {
                        left: 100px;
                    }
                }
                @media screen and (max-width: 400px) and (min-width: 0px) {
                    .progress-meter .track {
                        left: 90px;
                    }
                }

                .track_down7 {
    width: 2px;
    height: 56px;
    background-color: black;
    margin: auto;
    margin-top: 4px;
}
.progress-point.tick:after {
    content: '✔';
    font-size: 18px;
    color: white;
    background-color: green;
    display: flex;
    align-items: center;
    justify-content: center;
}
.progress-point.big-image-circle::before {
    width: 80px;
    height: 80px;
    border-radius: 40px;
    background-size: 100% 100%;
}
.progress-point.big-image-circlex::before {
    width: 80px;
    height: 80px;
    border-radius: 40px;
    background-size: 100% 100%; 
}

            </style>
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
            <section class="">
                <div class="container pt-5 mb-4">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="">
                                <div class="progress-meter meter_box">
                                    <div class="track" style="width:85%;"></div>
                                    <div>
                                        <ol class="progress-points mb-5">
                                            <li class="progress-point step-phone big-image-circle {{$confirmation == 1  ? 'suc tick' : 'no_suc' }}" style="left:10%;">

                                                <div class="progress-step-meta">
                                                    <div class="step-title ph12">Application<br>Submitted</div>
                                                </div>
                                            </li>
                                               <li class="sms" style="left:15%; position:absolute; bottom:59px; <?php echo $formbg == 1 ? 'background-color:#335c2c;' : 'background-color:#9fa1a0;'; ?>">

                                                <a href="#sms">
                                                    <span><img src="/images/22.png" alt="sms"></span>
                                                </a>
                                                <div class="track_down"></div>
                                            </p>
                                           <li class="progress-point step-4 {{ $deptbg == 1 ? 'suc tick' : 'no_suc' }}" style="left:22%">

                                                
                                               
                                                <div class="progress-step-meta">
                                                    <div class="step-title ph12">Department<br></div>
                                                </div>
                                            </li>
                                            
   <li class="progress-point step-5 
    @if ($step5bg === 1)
        suc tick
    @elseif ($step5bg === 0)
        error
    @else
        no_suc
    @endif" style="left:34%">

    <div class="progress-step-meta">
        <div class="step-title ph12">Verified by<br>Institutes</div>
    </div>
</li>



                                            
                                            <li class="progress-point step-7 {{ $dept2bg == 1 ? 'suc tick' : 'no_suc' }}" style="left:46%">
    <div class="progress-step-meta">
        <div class="step-title ph12">Forwarded<br>by Department</div>
    </div>
</li>

                                           
                                           <li class="progress-point step-8 {{ $tcashbg == 1 ? 'suc tick' : 'no_suc' }}" style="left:58%">
    <div class="progress-step-meta">
        <div class="step-title ph12">Forwarded<br>to AFC BSS</div>
    </div>
</li>

                                            
                                            <li class="progress-point step-9 {{ $bopbg == 1 ? 'suc tick' : 'no_suc' }}" style="left:70%">
    <div class="progress-step-meta">
        <div class="step-title ph12">BOP<br>Process</div>
    </div>
</li>
                                            <p>
    
</p>

   <li class="sms7" style="left:91%; transform: translateX(-50%); position:absolute; bottom:58px; <?php echo $cardbg == 1 ? 'background-color:#335c2c;' : 'background-color:#9fa1a0;'; ?>">
<a href="#sms7">
        <span><img src="/images/22.png" alt="sms"></span>
        <div class="track_down7"></div>

    </a>
    
</li>

<li class="progress-point step-11 {{ $stationbg == 1 ? 'suc' : 'no_suc' }}" style="left:82%">
    <div class="progress-step-meta">
        <div class="step-title ph12">Card Delivered<br>at Station</div>
    </div>
</li>

                                            
                                            <li class="progress-point step-10 big-image-circlex  <?php
                                                if ($handoverbg == 1) {
                                                    echo 'suc';
                                                } else {
                                                    echo 'no_suc';
                                                }
                                            ?>" style="left:94%">
                                                <div class="progress-step-meta">
                                                    <div class="step-title ph12">Card Handed<br>Over
</div>
                                                </div>
                                            </li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </body>
        <script>
            $(document).ready(() => {
                $(document.body).on("click", ".card[data-clickable=true]", (e) => {
                    var href = $(e.currentTarget).data("href");
                    window.location = href;
                });
            });
            jQuery(document).ready(function (e) {
                function t(t) {
                    e(t).bind("click", function (t) {
                        t.preventDefault();
                        e(this).parent().fadeOut()
                    })
                }
                e(".dropdown-toggle").click(function () {
                    var t = e(this).parents(".button-dropdown").children(".dropdown-menu").is(":hidden");
                    e(".button-dropdown .dropdown-menu").hide();
                    e(".button-dropdown .dropdown-toggle").removeClass("active");
                    if (t) {
                        e(this).parents(".button-dropdown").children(".dropdown-menu").toggle().parents(".button-dropdown").children(".dropdown-toggle").addClass("active")
                    }
                });
                e(document).bind("click", function (t) {
                    var n = e(t.target);
                    if (!n.parents().hasClass("button-dropdown")) e(".button-dropdown .dropdown-menu").hide();
                });
                e(document).bind("click", function (t) {
                    var n = e(t.target);
                    if (!n.parents().hasClass("button-dropdown")) e(".button-dropdown .dropdown-toggle").removeClass("active");
                })
            });
        </script>
@endsection