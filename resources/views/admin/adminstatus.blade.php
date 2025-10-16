@extends('admin.master')
@section('content')
    
      <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
        <title>Status</title>
      </head>
      <body>
        <div class="flex-1 h-full min-h-screen">
            
        <style>



.progress-meter .progress-point.successer:before {

    background-color: green;

}



.progress-meter .progress-point.no_success:before {

    background-color: #259bdb;

}



.success {

    color: none;

}



#fi { display: none; }

@media screen  and (max-width: 959px){

#fi { display: inline-block;}

}

#fir_hide { display: none; }

@media screen  and (min-width: 960px){

#fir_hide { display: inline-block;}

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

    top: -28px;

    left: 76px;

    color:white; 
    
    border:1px solid white; 
    
    border-radius: 50%; 
    
    width: 25px;


    

}

.fi {

    font-size: 12px;

    font-weight: 300;

    text-align: center;

    color: rgb(248, 250, 248);

    background-color: none;

}

.dir {

position: absolute;

font-size: 12px;

font-weight: 600;

text-align: center;

color: rgb(248, 250, 248);

background-color: green;

line-height: 23px;

border-width: 50px;

top: -15px;

left: 35px;

color:white; 

border:1px solid white; 

border-radius: 50%; 

width: 25px;




}



</style>





            <style>
                .progress-meter {
                    width: 80%;
                    margin: 100px auto 300px auto;
                }
                /* ================= */
                .progress-meter .track {
                    position: relative;
                    height: 2px;
                    width: 390px;
                    background: #fff;
                    top: 50px;
                    left:10%;
                    margin-left: 20px;
                }
                /* =========== */
                .progress-meter .progress-points {
                    position: relative;
                    margin: -15px 0 0;
                    padding: auto;
                    list-style: none;
                    }
                
                    .progress-meter .progress-point.step-phone:before {
                        background: url("images/Form fill-01.png") no-repeat 0 0;
                        background-size: 100%;
                        background-origin: content-box, padding-box;
                        padding: 10px;
                    }
                
                    .progress-meter .progress-point.step-4:before {
                        background: url("images/Payment-01.png") no-repeat 0 0;
                        background-size: 100%;
                        background-origin: content-box, padding-box;
                        padding: 10px;
                    }
                    
                    .progress-meter .progress-point.step-5:before {
                        background: url("images/verification-01.png") no-repeat 0 0;
                        background-size: 100%;
                        background-origin: content-box, padding-box;
                        padding: 10px;
                    }
                
                    .progress-meter .progress-point.step-6:before {
                    content: "";
                    background: url("images/card -01.png") no-repeat 0 0;
                    background-size: 100%;
                    background-origin: content-box, padding-box;
                    padding: 10px;
                }
                    
                    .progress-meter .progress-point.no_suc:before{
                        background-color: green;
                    }
                    .progress-meter .progress-point.suc:before{
                        background-color: green;
                    }
                    
                    /* icon style */
                
                    .progress-meter .progress-point:before {
                    display: block;
                    margin: -16px auto 0;
                    content: " ";
                    /* font-size: 26px; */
                    /* font-family: FontAwesome; */
                    /* color: #fff; */
                    height: 60px;
                    padding: 11px 0 0 0;
                    width: 60px;
                    border: 2px solid white;
                    border-radius: 55px;
                    }
                    /* display all icon desktop */
                    .progress-meter .progress-point {
                    position: absolute;
                    display: block;
                    width: 20%;
                    margin-left: -60px;
                    text-align: center;
                    cursor: pointer;
                    color: green;
                    }
                
                    /* icon text */
                    .step-title {
                    font-weight: bold;
                    color:white;
                    font-size: 6px;
                    }
                    /* .ph12 {
                    font-size: 1px;
                    line-height: 150%;
                    font-family: 'museo500', Verdana, sans-serif;
                    margin: 0 0 6px 0;
                    } */
                    
                    /* icon numbers */
                    ol.progress-points {
                    list-style: none;
                    counter-reset: numList;
                    }
                    .progress-meter .progress-point:after {
                  
                    
                    position: absolute;
                    top: -20px;
                    right: 50px;
                    font-size: 16px;
                    text-align: center;
                    color: #fff;
                    background-color: #259bdb;
                    line-height: 23px;
                    width: 25px;
                    height: 25px;
                    border: 1px solid #fff;
                    border-radius: 100%;
                    }
                    

                @media (min-width: 1024px) {
                        .progress-meter {
                            width: 80%;
                            margin-left: 150px;
                        }
                            
                }   
                @media (max-width: 1023px) and (min-width: 961px) {
                        .progress-meter {
                            width: 90%;
                            margin-left: 160px;
                        }
                            
                }
                @media (max-width: 960px) and (min-width: 620px) {
                   
                    .progress-meter .track {
                    width: 2px;
                    position: absolute;
                    }
                    /* ===== */
                    /* icon align downward */
                        .progress-meter .progress-point {
                        position: static;
                        width: 100%;
                        margin-left: 60px;
                        text-align: left;
                        }
                        /* position of icons */
                        .progress-meter .progress-point:before {
                        margin: 0;
                        position: absolute;
                        margin-left: -86px;
                        padding: 8px 0 0 13px;
                        }
                        .ph12 {
                        font-size: 14px;
                        line-height: 110%;
                        font-family: 'museo500', Verdana, sans-serif;
                        margin: 0 0 6px 0;
                        }
                }
                
                @media (max-width: 619px) and (min-width: 0px) {
                    
                    /* ======== */
                    .progress-meter {
                        min-height: 350px;
                        width: 80%;
                    }
                    .progress-meter .progress-point {
                    position: static;
                    width: 90%;
                    margin-left: 60px;
                    text-align: left;
                    }
                    .progress-meter .progress-point:before {
                    margin: 0;
                    position: absolute;
                    margin-left: -86px;
                    padding: 8px 0 0 13px;
                    }
                
                }
                @media (max-width: 960px) {
                    /* .progress-meter {
                    min-height: 450px;
                    width: 75%;
                    } */
                    .progress-meter .track {
                    width: 2px;
                    height: 950px;
                    margin-left:0px;
                    position: absolute;
                    } 
                }
                
                /* font size */
                @media screen and (min-width: 960px){
                
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
                @media screen and (min-width: 992px){
                    .ph12 {
                    font-size: 12px;
                    }
                
                }
                @media screen and (min-width: 1200px){
                    /* icon text */
                    .ph12 {
                    font-size: 14px;
                    }
                }
            </style>
            <style>
                .meter_box{
                    /* background: rgba(0, 0, 0, 0.7); */
                    background: linear-gradient(to bottom, rgba(19, 14, 65, 0.6) 0%, rgba(19, 14, 65, 0.6)100%);

                    transition: opacity 500ms;
                    border-radius:10px; 
                    height:300px; 
                    padding-top:130px;
                }
                .progress-meter .track_down {
                    position: absolute;
                    width: 2px;
                    height: 57px;
                    left: 150px;
                    background: #fff;
                    top: -41px;
                }
                .sms {
                    position: absolute;
                }
                .sms:after {
                    position: absolute;
                    content: '';
                    font-size: 8px;
                    top: 0px;
                    left: 0px;
                }
                .progress-meter .track_down2 {
                    position: absolute;
                    width: 2px;
                    height: 57px;
                    left: 280px;
                    background: #fff;
                    top: -41px;
                }
                .sms2 {
                    position: absolute;
                }
                .sms2:after {
                    position: absolute;
                    content: '';
                    font-size: 8px;
                    top: 0px;
                    left: 230px;
                }
                .progress-meter .track_down3 {
                    position: absolute;
                    width: 2px;
                    height: 57px;
                    left: 420px;
                    background: #fff;
                    top: -41px;
                }
                .sms3 {
                    position: absolute;
                }
                .sms3:after {
                    position: absolute;
                    content: '';
                    font-size: 8px;
                    top: 0px;
                    left: 230px;
                }
                .sms, .sms2 , .sms3{
                height: 60px; 
                width:60px; 
                border-radius:50%; 
                background-color: #259bdb; 
                top:-100px; 
                border:2px solid white;
                }
                .sms img, .sms2 img, .sms3 img{
                    width: 60px; 
                    height:60px;
                }
                .sms{
                    left:120px; 
                }
                .sms2{
                    left:250px;
                }
                .sms3{
                    left:390px;
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
                color: green;
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
                color: green;
                }

                .popup .content {
                max-height: 30%;
                overflow: auto;
                }

                @media screen and (max-width: 700px){
                .box{
                    width: 70%;
                }
                .popup{
                    width: 70%;
                }
                }
            </style>
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
                    <section class="">
                        <div class="container pt-5 mb-4">
                            <div class="row">
                                <div class="col-md-12 " style="">
                                    <div class="" style="margin-left: 150px;">
                                        <div class="progress-meter meter_box" >
                                            {{-- progress line --}}
                                            <div class="" style="margin-left: 90px;">

                                                <div class="track "></div>
                                                <div >
                                                
                                                    <ol  class="progress-points mb-5 " >
                                                                    <li class="progress-point step-phone <?php
                                                                            if ($formbg == 1) 
                                                                            {
                                                                                echo 'suc';
                                                                            } else {
                                                                                echo 'no_suc';
                                                                            } 
                                                                        ?>" style="left:10%;">
                                                                        <div class="progress-step-meta">
                                                                        <div class="step-title ph12 ">
                                                                        <a class="progress-step-meta" href="/formstatus" style = "color:white">Form 
                                                                            <br>
                                                                            Submitted</div>
                                                                        </div></a>
                                                                        
                                                                        <span id="fir_hide" class="fir">
    
                                                                        {{$count}}</span>
    
                                                                    
                                                                    </li>
                                                                              
                                                                    <p class="sms"  style="">
                                                                      
                                                                        <span id="fir_hide" class="dir"> {{$msg['0']->sms_1}}</span>
                                                                        <a href="#sms">
                                                                        
                                                                            <span>
                                                                                <img src="images/SMS.png" style=""
                                                                                    alt="sms">
                                                                            </span>
                                                                        </a>
                                                                        
                                                                        <div class="track_down">
                                                                    </div>
                                                                    </p>
                                                                    
                                                                    <li class="progress-point step-4 <?php if(($paymentbg==1))
                                                                            {
                                                                                echo 'suc';
                                                                            } else {
                                                                                echo 'no_suc';
                                                                            } 
                                                                        ?>" style="left:30%" >
                                                                        <div class="progress-step-meta ">
                                                                             
                                                                            <div class="step-title ph12 ">
                                                                                <a class="progress-step-meta" href="/paystatus" style = "color:white">
                                                                        
                                                                                Payment
                                                                            <br> Recieved</div>
                                                                        </div></a>
                                                                        <span id="fir_hide" class="fir"> {{$count_pay}}</span>
                                                                        
                                                                    </li>
                                                                    <p class="sms2">
                                                                    <span id="fir_hide" class="dir"> {{$msg['0']->sms_2}}</span>
                                                                        <a href="#sms2">
                                                                            <span>
                                                                                <img src="images/SMS.png" 
                                                                                    alt="sms">
                                                                            </span>
                                                                        </a>
                                                                        <div class="track_down2"></div>
                                                                    </p>
                                                                    
                                                                    <li class="progress-point step-5 <?php if(($verificationbg==1))
                                                                            {
                                                                                echo 'suc';
                                                                            } else {
                                                                                echo 'no_suc';
                                                                            } 
                                                                        ?>" style="left:50%">
                                                                        <div class="progress-step-meta">
                                                                        <div class="step-title ph12 ">
                                                                        <a class="progress-step-meta" href="/verifystatus" style = "color:white">
    
                                                                            <br>
                                                                            Verified</div>
                                                                        </div></a>
                                                                        <span id="fir_hide" class="fir"  > {{$count_verify}}</span>
                                                                    </li>
                                                                    <p class="sms3">
                                                                    <span id="fir_hide" class="dir"> {{$msg['0']->sms_3}}</span>
                                                                        <a href="#sms3">
                                                                            <span>
                                                                                <img src="images/SMS.png"
                                                                                    alt="sms">
                                                                            </span>
                                                                        </a>
                                                                        <div class="track_down3"></div>
                                                                    </p>
                                                                    <li class="progress-point step-6 
                                                                            
                                                                            <?php if(($cardbg==1))
                                                                            {
                                                                                echo 'suc';
                                                                            } else {
                                                                                echo 'no_suc';
                                                                            } 
                                                                        ?>" style="left:70%">
                                                                        <div class="progress-step-meta">
                                                                        <div class="step-title ph12">
                                                                        <a class="progress-step-meta" href="/dispatchstatus" style = "color:white">
                                                                            Card 
                                                                            <br>
                                                                            Issued
                                                                        </div>
                                                                        </div></a>
                                                                        <span id="fir_hide" class="fir">  {{$count_card}}</span>
                                                                        
                                                                    </li>
                                                            {{-- =========== --}}
                                                    </ol>
                                                </div>  
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                         
                    
                        </section>
                        <div id="sms" class="overlay">
                            <div class="popup">
                                <a class="close" href="#">&times;</a>
                                <br>
                                <div class="content">
                                پرسنلائزڈکارڈ فارم جمع کروانےکا شکریہ۔   اس  لنک پر کلک کر کے آپ اپنے ای میل اور پاسورڈ کے ذریعے اپنی درخواست کی ٹریکنگ کر سکتے ہیں۔<a href="https://cards-pma.punjab.gov.pk">https://cards-pma.punjab.gov.pk</a>'
                                </div>
                            </div>
                        </div>
                        <div id="sms2" class="overlay">
                            <div class="popup">
                                <a class="close" href="#">&times;</a>
                                <br>
                                <div class="content">
                                پرسنلائزڈکارڈ فارم کی فیس وصول ہو گئی ہےشکریہ۔  اس لنک پر کلک کر کے آپ اپنے ای میل اور پاسورڈ کے ذریعے اپنی درخواست کی ٹریکنگ کر سکتے ہیں۔<a href="https://cards-pma.punjab.gov.pk">https://cards-pma.punjab.gov.pk</a>
                                </div>
                            </div>
                        </div>
                        <div id="sms3" class="overlay">
                            <div class="popup">
                                <a class="close" href="#">&times;</a>
                                <br>
                                <div class="content">
                                پرسنلائزڈکارڈ تیار ہو کر آپ کے متعلقہ اسٹیشن پر بھیج دیا گیا ہے .جلد از جلدوصول کر لیں شکریہ۔                                </div>
                            </div>
                        </div>
                        {{-- content end --}}
                    
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