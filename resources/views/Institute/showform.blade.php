
@extends('Institute.master')

@section('content')

<head>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<style>
body {
    
    background-color: #f8f9fa;
    font-family: 'Inter', sans-serif:
    color: #333;
}

#content-wrapper {
    background-color: #ffffff;
    transition: margin-left 0.5s;
    position: relative;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
}

.cardimages {
    margin-top: 20px;
    height: 80px;
    width: 80px;
}

.colstyle {
    text-align: center;
    padding: 10px;
}

.card-body {
    padding: 1rem;
}

.card-body label {
    font-weight: 600;
    font-size: 1rem;
    margin-bottom: 5px;
    display: block;
}

.card-body .form-control {
    border: none;
    border-bottom: 2px solid grey;
    border-radius: 0;
    box-sizing: border-box;
    width: 100%;
    max-width: 240px;
    padding: 6px 10px;
    font-size: 0.95rem;
    transition: border-color 0.3s;
}

.card-body .form-control:focus {
    outline: none;
    border-color: #218838;
    background-color: #f0fff5;
}

.footerlogo {
    text-align: center;
    height: 30px;
    width: 30px;
    margin: 20px auto;
}

.vl {
    border-left: 4px solid white;
    height: 50px;
    position: absolute;
    left: 50%;
    top: 20px;
}

.card[data-clickable="true"] {
    cursor: pointer;
    transition: box-shadow 0.2s;
}

.card[data-clickable="true"]:hover {
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.box {
    direction: rtl;
    display: flex;
    justify-content: center;
}

h2.text-center {
    font-size: 1.75rem;
    margin-bottom: 20px;
    font-weight: 600;
    color: #28a745;
}

h5 {
    background-color: #28a745;
    color: white;
    padding: 10px 16px;
    width: fit-content;
    border-radius: 6px;
    font-size: 1.1rem;
    margin-bottom: 15px;
}

.print-button, .verify-btn, .reject-btn {
    background-color: #28a745;
    color: white;
    border: none;
    border-radius: 4px;
    padding: 10px 16px;
    font-size: 15px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.print-button:hover,
.verify-btn:hover,
.reject-btn:hover {
    background-color: #218838;
}

.alert {
    font-size: 1rem;
    margin: 10px 0;
    padding: 10px;
    border-radius: 4px;
}

.content-container {
    max-width: 90%;
    margin: 0 auto;
    padding: 0 15px;
}

.row.card-body {
    display: flex;
    align-items: center;
    margin-bottom: 15px;
    flex-wrap: wrap;
}

.col-md-3 {
    padding: 10px;
    display: flex;
    align-items: center;
    flex: 0 0 25%;
    max-width: 25%;
}

.col-md-3 label {
    margin-bottom: 0;
    font-weight: 500;
}

.card-body img {
    max-width: 100%;
    height: auto;
    border-radius: 6px;
}

/* Ensure Inter font for form elements */
.card-body .form-control,
.card-body label,
.card-body input,
.card-body button,
.verify-btn,
.reject-btn,
.print-button,
.verify-user-div,
.verify-user-div label,
.verify-user-div input {
    font-family: 'Inter', sans-serif !important;
}

/* Override Bootstrap's form-control */
.form-control {
    font-family: 'Inter', sans-serif !important;
}

/* Ensure h5 uses Inter */
h5 {
    font-family: 'Inter', sans-serif !important;
    background-color: #28a745;
    color: white;
    padding: 10px 16px;
    width: fit-content;
    border-radius: 6px;
    font-size: 1.1rem;
    margin-bottom: 15px;
}



    /* Progress bar CSS */
                    .progress-meter {
                    width: 100%;
                    margin: 20px auto 50px auto;
                    
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
    background-color: #a91101;
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
                        overflow: auto;
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
                    .content-container {
        display: block !important; 
        position: relative;
        margin-top: 50px;
        outline: 2px solid blue;
    }
                }
                @media screen and (min-width: 960px) {
                    .box {
                        position: static;
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
                        /* font-family: 'museo500', Verdana, sans-serif; */
                        font-family: 'Inter', sans-serif;
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
                    height: auto; 
    min-height: 100px;
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
                    /* font-family: Tahoma, Arial, sans-serif; */
                    font-family: 'Inter', sans-serif;
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
                        /* font-family: 'museo500', Verdana, sans-serif; */
                        font-family: 'Inter', sans-serif;
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
</head>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script async src="https://www.googletagmanager.com/gtag/js?id=G-MEJMNHHFKH"></script>
  <section class="">
                <div class="container pt-5 mb-4 mt-5" style="margin-left: 29px;">
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
                                               <li class="sms" style="left:15%; position:absolute; bottom:59px; <?php echo $formbg == 1 ? 'background-color:#8dc540;' : 'background-color:#9fa1a0;'; ?>">

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

   <li class="sms7" style="left:91%; transform: translateX(-50%); position:absolute; bottom:58px; <?php echo $cardbg == 1 ? 'background-color:#8dc540;' : 'background-color:#9fa1a0;'; ?>">
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

                                            
                                            <li class="progress-point step-10 big-image-circle <?php
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

<script>
    window.dataLayer = window.dataLayer || [];
    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());
    gtag('config', 'G-MEJMNHHFKH');
</script>


@if (session('success'))
    <div class="alert alert-success text-center">
        {{ session('success') }}
    </div>
@endif
@if (session('error'))
    <div class="alert alert-danger text-center">
        {{ session('error') }}
    </div>
@endif


    <div id="content-wrapper" class="d-flex flex-column" style="">
        <div class="content-container">
            <h2 class="text-center font-bold font-up danger-text">{{ $data->passenger_name }}</h2>
            <div>
                <h5>Basic Information:</h5>
            </div>
            <div class="row card-body">
                <div class="col-md-3">
                    <label>Profile Image:</label>
                </div>
                <div class="col-md-3">
                    @if ($data->photo)
                        <img src="{{ asset('uploads/photo/' . $data->photo) }}" alt="Profile Image" style="max-width:100px;" />
                    @else
                        <span>N/A</span>
                    @endif
                </div>
                <div class="col-md-3">
                    <label>Full Name:</label>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control form-control-inline" value="{{ $data->passenger_name ?? 'N/A' }}" readonly>
                </div>
            </div>
            <div class="row card-body">
                <div class="col-md-3">
                    <label>CNIC:</label>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control form-control-inline" value="{{ $data->cnic ?? 'N/A' }}" readonly>
                </div>
                <div class="col-md-3">
                    <label>Contact:</label>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control form-control-inline" value="{{ $data->contact ?? 'N/A' }}" readonly>
                </div>
            </div>
            <div class="row card-body">
                <div class="col-md-3">
                    <label>Date of Birth:</label>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control form-control-inline" value="{{ $data->dob ?? 'N/A' }}" readonly>
                </div>
                <div class="col-md-3">
                    <label>Gender:</label>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control form-control-inline" value="{{ $data->gender ?? 'N/A' }}" readonly>
                </div>
            </div>
            <div class="row card-body">
                <div class="col-md-3">
                    <label>CNIC Type:</label>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control form-control-inline" value="{{ $data->cnic_type ?? 'N/A' }}" readonly>
                </div>
                <div class="col-md-3">
                    <label>CNIC Expiry:</label>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control form-control-inline" value="{{ $data->cnic_expiry ?? 'N/A' }}" readonly>
                </div>
            </div>
            <div class="row card-body">
                <div class="col-md-3">
                    <label>Category:</label>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control form-control-inline" value="{{ $data->category ?? 'N/A' }}" readonly>
                </div>
                <div class="col-md-3">
                    <label>Terms & Conditions:</label>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control form-control-inline" value="{{ $data->confirmation ?? 'N/A' }}" readonly>
                </div>
            </div>
            <div class="row card-body">
                <div class="col-md-3">
                    <label>CNIC Issuance</label>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control form-control-inline" value="{{ $data->cnic_issuance_date ?? 'N/A' }}" readonly>
                </div>
                <div class="col-md-3">
                    <label>Punjab Domicile:</label>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control form-control-inline" value="{{ $data->punjab_domicile ?? 'N/A' }}" readonly>
                </div>
            </div>

<h5>Guardian Information:</h5>
            <div class="row card-body">
                <div class="col-md-3">
                    <label>Guardian / Father Name</label>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control form-control-inline" value="{{ $data->guardian_name ?? 'N/A' }}" readonly>
                </div>
                <div class="col-md-3">
                    <label>Guardian CNIC Number</label>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control form-control-inline" value="{{ $data->guardian_cnic ?? 'N/A' }}" readonly>
                </div>
            </div>
            <div class="row card-body">
                <div class="col-md-3">
                    <label>Guardian CNIC Issuance Date</label>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control form-control-inline" value="{{ $data->guardian_cnic_issue ?? 'N/A' }}" readonly>
                </div>
                <div class="col-md-3">
                    <label>Guardian CNIC Expiry Date</label>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control form-control-inline" value="{{ $data->guardian_cnic_expiry ?? 'N/A' }}" readonly>
                </div>
            </div>

                        <h5>Institute Information:</h5>
        
            
            <div class="row card-body">
                <div class="col-md-3">
                    <label>Preferred station for card delivery:</label>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control form-control-inline" value="{{ $data->metro_stop ?? 'N/A' }}" readonly>
                </div>
                <div class="col-md-3">
                    <label>Grade:</label>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control form-control-inline" value="{{ $data->grade ?? 'N/A' }}" readonly>
                </div>
            </div>
            <div class="row card-body">
                <div class="col-md-3">
                    <label>Student Roll Number:</label>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control form-control-inline" value="{{ $data->sidnum ?? 'N/A' }}" readonly>
                </div>
                <div class="col-md-3">
                    <label>Start Session Year:</label>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control form-control-inline" value="{{ $data->start_year?? 'N/A' }}" readonly>
                </div>
            </div>
            <div class="row card-body">
                <div class="col-md-3">
                    <label>End Session Year:</label>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control form-control-inline" value="{{ $data->end_year ?? 'N/A' }}" readonly>
                </div>
                {{-- <div class="col-md-3">
                    <label>CNIC Expiry:</label>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control form-control-inline" value="{{ $data->cnic_expiry ?? 'N/A' }}" readonly>
                </div>
            </div>
            <div class="row card-body">
                <div class="col-md-3">
                    <label>Category:</label>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control form-control-inline" value="{{ $data->category ?? 'N/A' }}" readonly>
                </div>
                <div class="col-md-3">
                    <label>Confirmation:</label>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control form-control-inline" value="{{ $data->confirmation ?? 'N/A' }}" readonly>
                </div>
            </div>
            <div class="row card-body">
                <div class="col-md-3">
                    <label>CNIC Issuance</label>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control form-control-inline" value="{{ $data->category ?? 'N/A' }}" readonly>
                </div>
                <div class="col-md-3">
                    <label>Punjab Domicile:</label>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control form-control-inline" value="{{ $data->confirmation ?? 'N/A' }}" readonly>
                </div> --}}
            </div>
            


            <h5>Trip Information:</h5>
            <div class="row card-body">
                <div class="col-md-3">
                    <label>Card Type:</label>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control form-control-inline" value="{{ $data->card_type ?? 'N/A' }}" readonly>
                </div>
                <div class="col-md-3">
                    <label>District:</label>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control form-control-inline" value="{{ $data->district ?? 'N/A' }}" readonly>
                </div>
            </div>
            <div class="row card-body">
                <div class="col-md-3">
                    <label>Tehsil:</label>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control form-control-inline" value="{{ $data->tehsil ?? 'N/A' }}" readonly>
                </div>
                <div class="col-md-3">
                    <label>Institute Type:</label>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control form-control-inline" value="{{ $data->institute_type ?? 'N/A' }}" readonly>
                </div>
            </div>
            <div class="row card-body">
                <div class="col-md-3">
                    <label>Education Level:</label>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control form-control-inline" value="{{ $data->edu_level ?? 'N/A' }}" readonly>
                </div>
            </div>

            <div class="row card-body">
                <div class="col-md-3">
                    <label>Organization Name:</label>
                </div>
                <div class="col-md-9">
                    <input type="text" class="form-control form-control-inline" value="{{ $data->org_name ?? 'N/A' }}">
                </div>
            </div>

            <div class="row card-body">
                <div class="col-md-3">
                    <label>Address:</label>
                </div>
                <div class="col-md-9">
                    <input type="text" class="form-control form-control-inline" value="{{ $data->address ?? 'N/A' }}">
                </div>
            </div>


            <h5>Attachments:</h5>
            <div class="row card-body">
                @if ($data->cnic_front)
                    <div class="col-md-3">
                        <label>CNIC Front:</label>
                    </div>
                    <div class="col-md-3">
                        <img src="{{ asset('uploads/cnic_front/' . $data->cnic_front) }}" alt="CNIC Front" style="max-width:100px;" />
                    </div>
                @endif
                @if ($data->cnic_back)
                    <div class="col-md-3">
                        <label>CNIC Back:</label>
                    </div>
                    <div class="col-md-3">
                        <img src="{{ asset('uploads/cnic_back/' . $data->cnic_back) }}" alt="CNIC Back" style="max-width:100px;" />
                    </div>
                @endif
            </div>
            <div class="row card-body">
                @if ($data->bform)
                    <div class="col-md-3">
                        <label>B-Form:</label>
                    </div>
                    <div class="col-md-3">
                        <img src="{{ asset('uploads/bform/' . $data->bform) }}" alt="B-Form" style="max-width:100px;" />
                    </div>
                @endif
                @if ($data->student_id_card)
                    <div class="col-md-3">
                        <label>Student ID Card:</label>
                    </div>
                    <div class="col-md-3">
                        <img src="{{ asset('uploads/student_id_card/' . $data->student_id_card) }}" alt="Student ID Card" style="max-width:100px;" />
                    </div>
                @endif
            </div>

     @if (!$data->verified_users && $data->verified_users !== '0')

       <div class="row card-body verify-user-div" id="verify-user-{{ $data->user_id ?? 'default' }}">
    <!-- Validity period input -->
    <label class="fieldlabels">
        Expected validity period for student in this institution: <span>*</span>
    </label>
    <input type="month" 
           name="end_year_input" 
           id="end_year_{{ $data->user_id ?? 'default' }}" 
           class="form-control" 
           placeholder="Select Month and Year">

     <br>


<div class="form-group d-flex align-items-center">
        <input 
            type="checkbox" 
            name="confirmation" 
            id="confirmation_{{ $data->user_id ?? 'default' }}" 
            value="1" 
            required 
            class="mr-2" 
            style="width: 18px; height: 18px; cursor: pointer;">
        <label class="fieldlabels" 
               for="confirmation_{{ $data->user_id ?? 'default' }}" 
               style="cursor: pointer;">
            Please verify the guardian for this Student <span>*</span>
        </label>
    </div>




    <div class="col-md-12 text-center mt-3">
        <h5>Verify the user?</h5>
        <!-- VERIFY BUTTON -->
        <button class="btn btn-success verify-btn" 
                onclick="verifyUser('{{ $data->user_id ?? 'default' }}')" 
                {{ isset($data->user_id) && !$data->verified_users ? '' : 'disabled' }}>
            {{ $data->verified_users ? 'Verified' : 'Verify' }}
        </button>

        <!-- REJECT BUTTON -->
        <button class="btn btn-danger reject-btn" 
                onclick="rejectUser('{{ $data->user_id ?? 'default' }}')" 
                {{ isset($data->user_id) && $data->confirmation !== 'rejected' && !$data->verified_users ? '' : 'disabled' }}>
            Reject
        </button>

        <!-- REJECTION REASON COMMENT SECTION -->
<div id="reject-reason-section-{{ $data->user_id ?? 'default' }}" style="margin-top:10px;">
    @csrf
    <textarea id="reject-reason-text-{{ $data->user_id ?? 'default' }}" 
              placeholder="Enter rejection reason..."
              rows="3" style="width:100%;">{{ $data->rejection_reason ?? '' }}</textarea>
    <div style="margin-top:5px;">
        <button type="button" class="btn btn-success" 
                onclick="saveReject('{{ $data->user_id }}')">Save</button>
        <button type="button" class="btn btn-success" 
                onclick="editReject('{{ $data->user_id }}')">Edit</button>
        <button type="button" class="btn btn-danger" 
                onclick="deleteReject('{{ $data->user_id }}')">Delete</button>
    </div>
    <div id="reject-reason-message-{{ $data->user_id }}" style="margin-top:5px; color:green;"></div>
</div>


     

        <!-- HIDDEN VERIFY FORM -->
        <form id="verify-form-{{ $data->user_id ?? 'default' }}" 
              action="{{ route('verify.user', ['user_id' => $data->user_id ?? '']) }}" 
              method="POST" style="display: none;">
            @csrf
            <input type="hidden" name="end_year" id="verify-end-year-{{ $data->user_id ?? 'default' }}">
        </form>

        <!-- HIDDEN REJECT FORM -->
        <form id="reject-form-{{ $data->user_id ?? 'default' }}" 
              action="{{ route('reject.user', ['user_id' => $data->user_id ?? '']) }}" 
              method="POST" style="display: none;">
            @csrf
            <input type="hidden" name="end_year" id="reject-end-year-{{ $data->user_id ?? 'default' }}">
        </form>
    </div>
</div>
            @endif
        </div>
    </div>


<script>
function verifyUser(userId) {
    let input = document.getElementById('end_year_' + userId);
    let selectedDate = input.value;

    if (!selectedDate) {
        alert('Please select the expected validity period before verifying.');
        return;
    }

    // Set hidden input and submit form
    document.getElementById('verify-end-year-' + userId).value = selectedDate;
    document.getElementById('verify-form-' + userId).submit();
}

function rejectUser(userId) {
    let input = document.getElementById('end_year_' + userId);
    let selectedDate = input.value;

    if (!selectedDate) {
        alert('Please select the expected validity period before rejecting.');
        return;
    }

    // Set hidden input and submit form
    document.getElementById('reject-end-year-' + userId).value = selectedDate;
    document.getElementById('reject-form-' + userId).submit();
}
</script>
<script>
 
    function dontVerify() {
        if (confirm('Are you sure you want to skip verification?')) {
            alert('Verification skipped.');
        }
    }
    function printPage() {
        window.print();
    }


    function saveReject(userId) {
    fetch(`/reject/save/${userId}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('input[name=_token]').value
        },
        body: JSON.stringify({
            rejection_reason: document.getElementById('reject-reason-text-' + userId).value
        })
    })
    .then(res => res.json())
    .then(data => {
        document.getElementById('reject-reason-message-' + userId).innerText = data.message;
    });
}

function editReject(userId) {
    fetch(`/reject/edit/${userId}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('input[name=_token]').value
        },
        body: JSON.stringify({
            rejection_reason: document.getElementById('reject-reason-text-' + userId).value
        })
    })
    .then(res => res.json())
    .then(data => {
        document.getElementById('reject-reason-message-' + userId).innerText = data.message;
    });
}

function deleteReject(userId) {
    fetch(`/reject/delete/${userId}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('input[name=_token]').value
        }
    })
    .then(res => res.json())
    .then(data => {
        document.getElementById('reject-reason-text-' + userId).value = '';
        document.getElementById('reject-reason-message-' + userId).innerText = data.message;
    });
}

</script>
@endsection
