@extends('design_main.master')
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
        <style>
            /* .card {
                            margin-top: 20px;
                            margin-bottom: 20px;
                            border-radius: 10px;
                            box-shadow: 3px 3px 6px;
                        }

                        .cardimages {
                            margin-top: 20px;
                            height: 80px;
                            width: 80px;
                        } */

            /* .colstyle {
                            text-align: center;
                            padding: 10px;
                        } */

            /* .footerlogo {
                            text-align: center;
                            height: 30px;
                            width: 30px;
                            margin: 20px;
                        } */

            /* .vl {
                            border-left: 4px solid white;
                            height: 50px;
                            position: absolute;
                            left: 50%;
                            top: 20px;
                        } */

            /* .card[data-clickable="true"] {
                            cursor: pointer;
                        } */

            @media (max-width: 576px) {
                /* .card {
                                width: 195px;
                                font-size: 14px;
                            } */
            }

            /* .nav {
                            margin-top: -20px;
                            display: block;
                            text-align: center;
                            font-family: 'Segoe UI';
                        }

                        .nav li {
                            display: inline-block;
                            list-style: none;
                        }

                        .nav .button-dropdown {
                            position: relative;
                        }

                        .nav li a {
                            display: block;
                            color: #333;
                            background-color: #fff;
                            padding: 10px 20px;
                            text-decoration: none;
                        }

                        .nav li a span {
                            display: inline-block;
                            margin-left: 5px;
                            font-size: 10px;
                            color: #999;
                        }

                        .nav li .dropdown-menu {
                            display: none;
                            position: absolute;
                            left: 0;
                            padding: 0;
                            margin: 0;
                            text-align: left;
                        }

                        .nav li .dropdown-menu.active {
                            display: block;
                        }

                        .nav li .dropdown-menu a {
                            width: 200px;
                        } */

            .box {
                direction: rtl;
                display: flex;
                justify-content: center;
            }
            
        </style>
    </head>
    
    <div class="d-flex justify-content-center" style="margin-left:100px">
        <div class="col-md-12">
            <div>
                <div class="progress-meter ">
                    {{-- progress line --}}
                    <div class="sms_track "></div>
                    <div class="track "></div>
                    {{-- <div class="sms_track2"></div> --}}
                    <div>
                        <ol class="progress-points mb-5 ">
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
                            </style>
                            @if ($pwdp_id == 1)
                                <a href="/userCertificate">
                                    <li class="progress-point step-list <?php
                                    if ($a == 1) {
                                        echo 'successer';
                                    } else {
                                        echo 'no_success';
                                    }
                                    ?>"
                                        style="left: 0%">
                                        <div class="progress-step-meta">
                                            <div class="step-title ph12 <?php if ($a == 1) {
                                                echo 'success';
                                            }
                                            ?>"> Form Fill

                                            </div>
                                        </div>
                                    </li>
                                </a>
                            @else
                                <li class="progress-point step-contact  
                                                    <?php
                                                    if ($a == 1) {
                                                        echo 'successer';
                                                    } else {
                                                        echo 'no_success';
                                                    }
                                                    ?>"
                                    style="left:0%">
                                    <div class="progress-step-meta">
                                        <div class="step-title ph12 <?php if ($a == 1) {
                                            echo 'success';
                                        }
                                        ?>">Payment
                                        </div>
                                    </div>
                                </li>
                            @endif

                            <style>
                                .succ:after {
                                    background-color: green;
                                }

                                .no_succ:after {
                                    background-color: #259bdb;
                                }
                            </style>

                            <a href="#popup2">
                                <div
                                    class="sms 
                                            <?php
                                            if ($a == 1) {
                                                echo 'succ';
                                            } elseif ($a == 0) {
                                                echo 'no_succ';
                                            }
                                            ?>">
                                </div>
                            </a>
                            <!--popup2-->
                            <div id="popup2" class="popup-container">
                                <div class="popup-content">
                                    <a href="#" class="close">&times;</a>
                                    <p>{{ $smsText }}</p>
                                    <p>
                                        <?php
                                        $txt = htmlspecialchars($smsTxt);
                                        $txt = rawurlencode($smsTxt);
                                        $html = file_get_contents('https://translate.google.com/translate_tts?ie=UTF-8&client=gtx&q=' . $txt . '&tl=ur-IN');
                                        $player = "<audio controls='controls'><source src='data:audio/mpeg;base64," . base64_encode($html) . "'></audio>";
                                        echo $player;
                                        ?>
                                    </p>
                                </div>
                            </div>
                            {{-- ======= --}}

                            <li class="progress-point step-offer <?php
                            if ($b == 1) {
                                echo 'successer';
                            } else {
                                echo 'no_success';
                            }
                            ?>" style="left:12%;">
                                <div class="progress-step-meta">
                                    <div class="step-title ph12 <?php if ($b == 1) {
                                        echo 'success';
                                    }
                                    ?>"> Verification

                                        <p class="sms_mobile" style="height: 30px; width:30px; ">
                                            <span>
                                                <a href="#popup2">
                                                    <img src="images/track/sms.png"
                                                        style="width: 30px; height:30px; "alt="">
                                                </a>
                                            </span>
                                        </p>
                                        <style>
                                            .succ:after {
                                                background-color: green;
                                            }

                                            .no_succ:after {
                                                background-color: #259bdb;
                                            }
                                        </style>
                                    </div>
                                </div>
                            </li>


                            <li class="progress-point step-4 
                                                <?php
                                                if ($c == 1) {
                                                    echo 'successer';
                                                } else {
                                                    echo 'no_success';
                                                }
                                                ?>
                                             "
                                style="left:24%">
                                <div class="progress-step-meta ">

                                    <div class="step-title ph12 <?php if ($c == 1) {
                                        echo 'success';
                                    }
                                    ?>">Card
                                    </div>
                                </div>
                            </li>

                            <li class="progress-point step-5 <?php
                            if ($e == 1) {
                                echo 'successer';
                            } else {
                                echo 'no_success';
                            }
                            ?>" style="left:36%">
                                <div class="progress-step-meta">
                                    <div class="step-title ph12 <?php if ($e == 1) {
                                        echo 'success';
                                    }
                                    ?>">Card
                                    </div>
                                </div>
                            </li>

                            <p class="sms2_mobile"
                                style="height: 30px; width:30px; border-radius:100% background-color:green;">
                                <a href="#popup1">
                                    <span>
                                        <img src="images/track/sms.png" style="width: 30px; height:30px;"
                                            alt="">
                                    </span>
                                </a>
                            </p>
                            <style>
                                .sms2_mobile {
                                    position: relative;
                                }

                                .sms2_mobile:after {
                                    position: absolute;
                                    content: '';
                                    font-size: 8px;
                                    top: 0px;
                                    left: 30px;
                                }

                                .popup-link {
                                    display: flex;
                                    flex-wrap: wrap;
                                }

                                .popup-container {
                                    visibility: hidden;
                                    opacity: 0;
                                    transition: all 0.3s ease-in-out;
                                    transform: scale(1.3);
                                    position: fixed;
                                    z-index: 1;
                                    left: 0;
                                    top: 0;
                                    width: 100%;
                                    height: 100%;
                                    background-color: rgba(21, 17, 17, 0.61);
                                    display: flex;
                                    align-items: center;
                                }

                                .popup-content {
                                    background-color: green;
                                    margin: auto;
                                    padding: 20px;
                                    border: 1px solid rgb(0, 0, 0);
                                    width: 50%;
                                }

                                .popup-content p {
                                    font-size: 17px;
                                    padding: 10px;
                                    line-height: 20px;
                                }

                                .popup-content a.close {
                                    color: #aaaaaa;
                                    float: right;
                                    font-size: 28px;
                                    font-weight: bold;
                                    background: none;
                                    padding: 0;
                                    margin: 0;
                                    text-decoration: none;
                                }

                                .popup-content a.close:hover {
                                    color: #333;
                                }

                                .popup-content span:hover,
                                .popup-content span:focus {
                                    color: #000;
                                    text-decoration: none;
                                    cursor: pointer;
                                }

                                .popup-container:target {
                                    visibility: visible;
                                    opacity: 1;
                                    transform: scale(1);
                                }
                            </style>

                    </div>
                </div>
                </li>

                <a href="#popup1">
                    <div
                        class="sms2
                                            <?php
                                            if ($all == 1) {
                                                echo 'succ';
                                            } elseif ($all == 0) {
                                                echo 'no_succ';
                                            }
                                            ?>
                                            ">
                        <div class="sms2_track"></div>
                    </div>
                </a>
                <!--popup1-->
            </ol>

            </div>
        </div>
        {{-- <div class="fill_form" style="border: 2px solid white; border-radius:50%; padding:7px; background-color:#259bdb; height:60px; width:60px;">
            <div class="justify-content-center text-align-center ">
                <img src="images/card -01.png" style="width: 40px; " alt="">
            </div>
        </div>
        <div class="" style="border: 2px solid white; border-radius:50%; padding:7px; background-color:#259bdb; height:60px; width:60px; margin-left:50px;">
            <div class="justify-content-center text-align-center">
                <img src="images/card -01.png" style="width: 40px; " alt="">
            </div>
        </div>
        <div class="" style="border: 2px solid white; border-radius:50%; padding:7px; background-color:#259bdb; height:60px; width:60px; margin-left:50px;">
            <div class="justify-content-center text-align-center">
                <img src="images/card -01.png" style="width: 40px; " alt="">
            </div>
        </div>
        <div class="" style="border: 2px solid white; border-radius:50%; padding:7px; background-color:#259bdb; height:60px; width:60px; margin-left:50px;">
            <div class="justify-content-center text-align-center">
                <img src="images/card -01.png" style="width: 40px; " alt="">
            </div>
        </div> --}}
    </div>

    <body>
        <div >
            <style>
                .middle {
                    text-align: center;
                    list-style-position: inside;
                }

                .box {
                    direction: rtl;
                    display: flex;
                    justify-content: center;
                }

                /* success class color change */
                #success_cls {
                    color: green;
                }

                .progress-meter {
                    width: 80%;
                    margin: 150px auto 0 auto;
                }

                /* usa */
                .progress-meter .track {
                    position: relative;
                    height: 2px;
                    width: 250px;
                    background: #fff;
                    margin-left: 20px;
                    top: 50px;
                }

                /* ================= */

                .sms2:after {
                    background: url("images/track/SMS.png") no-repeat 0 0;
                    background-size: 86%;
                    padding-left: 13px;
                    padding-top: 9px;
                    background-origin: content-box, padding-box;
                    content: '';
                    position: absolute;
                    top: -100px;
                    left: 802px;
                    width: 60px;
                    height: 60px;
                    border: 2px solid #fff;
                    border-radius: 100%;
                }

                .progress-meter .sms2_track {
                    position: absolute;
                    width: 2px;
                    height: 60px;
                    left: 830px;
                    background: #fff;
                    top: -44px;
                    /* margin-left: 20px; */
                }

                .progress-meter .sms_track {
                    position: relative;
                    width: 2px;
                    height: 60px;
                    left: 60px;
                    top: 50px;
                    background: #fff;
                    margin-left: 20px;
                }

                .sms:after {
                    background: url("images/track/SMS.png") no-repeat 0 0;
                    background-size: 86%;
                    padding-left: 13px;
                    padding-top: 9px;
                    background-origin: content-box, padding-box;
                    content: '';
                    position: absolute;
                    top: -100px;
                    left: 52px;
                    /* background-color: #259bdb; */
                    width: 60px;
                    height: 60px;
                    border: 2px solid #fff;
                    border-radius: 100%;
                }

                @media (max-width: 1199px) and (min-width: 1024px) {
                    .progress-meter .sms_track {
                        height: 60px;
                        left: 38px;
                    }

                    .sms:after {
                        position: absolute;
                        top: -100px;
                        left: 30px;
                    }

                    .sms2:after {
                        position: absolute;
                        top: -100px;
                        left: 650px;
                    }

                    .progress-meter .sms2_track {
                        left: 680px;
                    }
                }

                @media (max-width: 1023px) and (min-width: 991px) {
                    .progress-meter .sms_track {
                        height: 60px;
                        left: 53px;
                    }

                    .sms:after {
                        position: absolute;
                        top: -100px;
                        left: 45px;
                    }

                    .sms2:after {
                        position: absolute;
                        top: -100px;
                        left: 750px;
                    }

                    .progress-meter .sms2_track {
                        left: 780px;
                    }
                }

                @media (max-width: 990px) and (min-width: 961px) {
                    .progress-meter .sms_track {
                        height: 60px;
                        left: 18px;
                    }

                    .sms:after {
                        position: absolute;
                        top: -100px;
                        left: 10px;
                    }

                    .sms2:after {
                        position: absolute;
                        top: -100px;
                        left: 530px;
                    }

                    .progress-meter .sms2_track {
                        left: 560px;
                    }
                }

                @media (max-width: 960px) {
                    .progress-meter .sms_track {
                        display: none;
                    }

                    .sms:after {
                        display: none;

                    }

                    .sms a {
                        display: none;

                    }

                    .sms2:after {
                        display: none;

                    }

                    .sms2 a {
                        display: none;

                    }

                    .progress-meter .sms2_track {
                        display: none;
                    }

                }

                @media (min-width: 961px) {

                    .sms_mobile,
                    .sms2_mobile {
                        display: none;
                    }
                }

                /* =========== */
                .progress-meter .progress-points {
                    position: relative;
                    margin: -15px 0 0;
                    padding: auto;
                    list-style: none;
                }

                /* for list */

                .progress-meter .progress-point.step-list:before {
                    content: "\f129" !important;
                }

                /* 1 */
                .progress-meter .progress-point.step-contact:before {
                    content: "\f234" !important;
                }

                /* 2 */
                .progress-meter .progress-point.step-offer:before {
                    content: "\f274" !important;
                }

                /* 3 */
                .progress-meter .progress-point.step-configure:before {
                    content: "\f085" !important;
                }


                .progress-meter .progress-point.step-4:before {
                    content: "\f0fa" !important;

                }

                .progress-meter .progress-point.step-5:before {
                    /* content:"\f016"!important; */
                    content: "";
                    background: url("images/track/Mso-verification.png") no-repeat 0 0;
                    background-size: 70%;
                    padding-left: 13px;
                    padding-top: 13px;
                    background-origin: content-box, padding-box;
                }

                .progress-meter .progress-point.step-6:before {
                    /* content:"\f09d"!important; */
                    content: "";
                    /* background: url("images/track/TEVTA.png") no-repeat 0 0; */
                    background: url("images/track/TEVTA.png") no-repeat 0 0;
                    background-size: 85%;
                    background-origin: content-box, padding-box;
                    padding: 10px;
                }


                .progress-meter .progress-point.step-7:before {
                    /* content:"\f14b"!important; */
                    content: "";
                    background: url("images/track/labor.png") no-repeat 0 0;
                    background-size: 106%;

                    /* background-size: 60px;
                                padding: 0px;
                                background-origin: content-box, padding-box; */
                    /* background-origin: content-box, padding-box; */
                }

                .progress-meter .progress-point.step-8:before {
                    /* content:"\f080"!important; */
                    /* content: url(images/approval.png)!important; */
                    /* display: inline-block; */
                    content: "";
                    background: url("images/track/ms-approval.png") no-repeat 0 0;
                    background-size: 106%;
                    /* padding: 1px; */
                    /* background-origin: content-box, padding-box; */
                }

                .progress-meter .progress-point.bg-track:before {
                    background-color: #00FF7F;
                }

                .progress-meter .progress-point.step-9:before {
                    /* content:"\f7e6"!important; */
                    content: "";
                    background: url("images/track/dd.png") no-repeat 0 0;
                    background-size: 80%;
                    padding-left: 9px;
                    padding-top: 9px;
                    background-origin: content-box, padding-box;
                }

                .progress-meter .progress-point.step-phone:before {
                    /* content:"\f0f0 "!important; */
                    content: "";
                    background: url("images/track/View-certificate.png") no-repeat 0 0;
                    background-size: 70%;
                    padding-left: 13px;
                    padding-top: 13px;
                    background-origin: content-box, padding-box;
                }

                /* icon style */

                .progress-meter .progress-point:before {
                    display: block;
                    margin: -16px auto 0;
                    content: " ";
                    font-size: 26px;
                    font-family: FontAwesome;
                    color: #fff;
                    background-color: #259bdb;
                    height: 60px;
                    padding: 11px 0 0 0;
                    width: 60px;
                    border: 2px solid white;
                    border-radius: 55px;
                }

                .progress-step-meta {
                    margin-top: 15px;
                    min-height: 100px;
                }

                /* display all icon desktop */
                .progress-meter .progress-point {
                    position: absolute;
                    display: block;
                    width: 20%;
                    margin-left: -60px;
                    text-align: center;
                    cursor: pointer;
                    color: #999;
                }

                #green {
                    color: green;
                }

                /* icon text */
                .step-title {
                    font-weight: bold;
                    color: white;
                }

                .ph12 {
                    font-size: 14px;
                    line-height: 150%;
                    font-family: 'museo500', Verdana, sans-serif;
                    margin: 0 0 6px 0;
                }

                /* icon numbers */
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
                    color: #fff;
                    background-color: #259bdb;
                    line-height: 23px;
                    width: 25px;
                    height: 25px;
                    border: 1px solid #fff;
                    border-radius: 100%;
                }

                .footer {
                    position: fixed;
                    top: auto;
                    right: 0;
                    left: 0;
                    bottom: 0;
                    background-color: #efefef;
                    text-align: center;
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

                    /* ======== */
                    /* mobile view line */
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

                /* @media (max-width: 960px) {
                                .progress-meter .track {
                                    width: 2px;
                                    height: 950px;
                                    margin-left: 0px;
                                    top: 150px;
                                    position: absolute;
                                }
                            } */

                /* @media (max-width: 1023px) and (min-width: 961px) {
                                .progress-meter .track {
                                    height: 2px;
                                    width: 650px;
                                }
                            }

                            @media (max-width: 1279px) and (min-width: 1024px) {
                                .progress-meter .track {
                                    height: 2px;
                                    width: 770px;
                                }
                            }

                            @media (min-width: 7000px) and (min-width: 1280px) {
                                .progress-meter .track {
                                    height: 2px;
                                    width: 1000px;
                                }
                            } */
                /* font size */
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
                        font-size: 9px;
                    }

                }

                @media screen and (min-width: 1200px) {

                    /* icon text */
                    .ph12 {
                        font-size: 10px;
                    }
                }
            </style>
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
            <section class="">
                <div class="container ">
                    <div class="row">
                        <div class="col-md-12">
                            <div>
                                <div class="progress-meter ">
                                    {{-- progress line --}}
                                    <div class="sms_track "></div>
                                    <div class="track "></div>
                                    {{-- <div class="sms_track2"></div> --}}
                                    <div>
                                        <ol class="progress-points mb-5 ">
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
                                            </style>
                                            @if ($pwdp_id == 1)
                                                <a href="/userCertificate">
                                                    <li class="progress-point step-list <?php
                                                    if ($a == 1) {
                                                        echo 'successer';
                                                    } else {
                                                        echo 'no_success';
                                                    }
                                                    ?>"
                                                        style="left: 0%">
                                                        <div class="progress-step-meta">
                                                            <div class="step-title ph12 <?php if ($a == 1) {
                                                                echo 'success';
                                                            }
                                                            ?>"> Form Fill

                                                            </div>
                                                        </div>
                                                    </li>
                                                </a>
                                            @else
                                                <li class="progress-point step-contact  
                                                                    <?php
                                                                    if ($a == 1) {
                                                                        echo 'successer';
                                                                    } else {
                                                                        echo 'no_success';
                                                                    }
                                                                    ?>"
                                                    style="left:0%">
                                                    <div class="progress-step-meta">
                                                        <div class="step-title ph12 <?php if ($a == 1) {
                                                            echo 'success';
                                                        }
                                                        ?>">Payment
                                                        </div>
                                                    </div>
                                                </li>
                                            @endif

                                            <style>
                                                .succ:after {
                                                    background-color: green;
                                                }

                                                .no_succ:after {
                                                    background-color: #259bdb;
                                                }
                                            </style>

                                            <a href="#popup2">
                                                <div
                                                    class="sms 
                                                            <?php
                                                            if ($a == 1) {
                                                                echo 'succ';
                                                            } elseif ($a == 0) {
                                                                echo 'no_succ';
                                                            }
                                                            ?>">
                                                </div>
                                            </a>
                                            <!--popup2-->
                                            <div id="popup2" class="popup-container">
                                                <div class="popup-content">
                                                    <a href="#" class="close">&times;</a>
                                                    <p>{{ $smsText }}</p>
                                                    <p>
                                                        <?php
                                                        $txt = htmlspecialchars($smsTxt);
                                                        $txt = rawurlencode($smsTxt);
                                                        $html = file_get_contents('https://translate.google.com/translate_tts?ie=UTF-8&client=gtx&q=' . $txt . '&tl=ur-IN');
                                                        $player = "<audio controls='controls'><source src='data:audio/mpeg;base64," . base64_encode($html) . "'></audio>";
                                                        echo $player;
                                                        ?>
                                                    </p>
                                                </div>
                                            </div>
                                            {{-- ======= --}}

                                            <li class="progress-point step-offer <?php
                                            if ($b == 1) {
                                                echo 'successer';
                                            } else {
                                                echo 'no_success';
                                            }
                                            ?>" style="left:12%;">
                                                <div class="progress-step-meta">
                                                    <div class="step-title ph12 <?php if ($b == 1) {
                                                        echo 'success';
                                                    }
                                                    ?>"> Verification

                                                        <p class="sms_mobile" style="height: 30px; width:30px; ">
                                                            <span>
                                                                <a href="#popup2">
                                                                    <img src="images/track/sms.png"
                                                                        style="width: 30px; height:30px; "alt="">
                                                                </a>
                                                            </span>
                                                        </p>
                                                        <style>
                                                            .succ:after {
                                                                background-color: green;
                                                            }

                                                            .no_succ:after {
                                                                background-color: #259bdb;
                                                            }
                                                        </style>
                                                    </div>
                                                </div>
                                            </li>


                                            <li class="progress-point step-4 
                                                                <?php
                                                                if ($c == 1) {
                                                                    echo 'successer';
                                                                } else {
                                                                    echo 'no_success';
                                                                }
                                                                ?>
                                                             "
                                                style="left:24%">
                                                <div class="progress-step-meta ">

                                                    <div class="step-title ph12 <?php if ($c == 1) {
                                                        echo 'success';
                                                    }
                                                    ?>">Card
                                                    </div>
                                                </div>
                                            </li>

                                            <li class="progress-point step-5 <?php
                                            if ($e == 1) {
                                                echo 'successer';
                                            } else {
                                                echo 'no_success';
                                            }
                                            ?>" style="left:36%" >
                                                <div class="progress-step-meta">
                                                    <div class="step-title ph12 <?php if ($e == 1) {
                                                        echo 'success';
                                                    }
                                                    ?>">Card
                                                    </div>
                                                </div>
                                            </li>

                                            <p class="sms2_mobile"
                                                style="height: 30px; width:30px; border-radius:100% background-color:green;">
                                                <a href="#popup1">
                                                    <span>
                                                        <img src="images/track/sms.png" style="width: 30px; height:30px;"
                                                            alt="">
                                                    </span>
                                                </a>
                                            </p>
                                            <style>
                                                .sms2_mobile {
                                                    position: relative;
                                                }

                                                .sms2_mobile:after {
                                                    position: absolute;
                                                    content: '';
                                                    font-size: 8px;
                                                    top: 0px;
                                                    left: 30px;
                                                }

                                                .popup-link {
                                                    display: flex;
                                                    flex-wrap: wrap;
                                                }

                                                .popup-container {
                                                    visibility: hidden;
                                                    opacity: 0;
                                                    transition: all 0.3s ease-in-out;
                                                    transform: scale(1.3);
                                                    position: fixed;
                                                    z-index: 1;
                                                    left: 0;
                                                    top: 0;
                                                    width: 100%;
                                                    height: 100%;
                                                    background-color: rgba(21, 17, 17, 0.61);
                                                    display: flex;
                                                    align-items: center;
                                                }

                                                .popup-content {
                                                    background-color: green;
                                                    margin: auto;
                                                    padding: 20px;
                                                    border: 1px solid rgb(0, 0, 0);
                                                    width: 50%;
                                                }

                                                .popup-content p {
                                                    font-size: 17px;
                                                    padding: 10px;
                                                    line-height: 20px;
                                                }

                                                .popup-content a.close {
                                                    color: #aaaaaa;
                                                    float: right;
                                                    font-size: 28px;
                                                    font-weight: bold;
                                                    background: none;
                                                    padding: 0;
                                                    margin: 0;
                                                    text-decoration: none;
                                                }

                                                .popup-content a.close:hover {
                                                    color: #333;
                                                }

                                                .popup-content span:hover,
                                                .popup-content span:focus {
                                                    color: #000;
                                                    text-decoration: none;
                                                    cursor: pointer;
                                                }

                                                .popup-container:target {
                                                    visibility: visible;
                                                    opacity: 1;
                                                    transform: scale(1);
                                                }
                                            </style>

                                    </div>
                                </div>
                                </li>

                                <a href="#popup1">
                                    <div
                                        class="sms2
                                                            <?php
                                                            if ($all == 1) {
                                                                echo 'succ';
                                                            } elseif ($all == 0) {
                                                                echo 'no_succ';
                                                            }
                                                            ?>
                                                            ">
                                        <div class="sms2_track"></div>
                                    </div>
                                </a>
                                <!--popup1-->
                            </ol>

                            </div>
                        </div>
                    </div>
                </div>
        </div>
        </div>

        </section>



        </div>
    @endsection
</body>
<script>
    $(document).ready(() => {
        $(document.body).on("click", ".card[data-clickable=true]", (e) => {
            var href = $(e.currentTarget).data("href");
            window.location = href;
        });
    });
    jQuery(document).ready(function(e) {
        function t(t) {
            e(t).bind("click", function(t) {
                t.preventDefault();
                e(this).parent().fadeOut()
            })
        }
        e(".dropdown-toggle").click(function() {
            var t = e(this).parents(".button-dropdown").children(".dropdown-menu").is(":hidden");
            e(".button-dropdown .dropdown-menu").hide();
            e(".button-dropdown .dropdown-toggle").removeClass("active");
            if (t) {
                e(this).parents(".button-dropdown").children(".dropdown-menu").toggle().parents(
                    ".button-dropdown").children(".dropdown-toggle").addClass("active")
            }
        });
        e(document).bind("click", function(t) {
            var n = e(t.target);
            if (!n.parents().hasClass("button-dropdown")) e(".button-dropdown .dropdown-menu").hide();
        });
        e(document).bind("click", function(t) {
            var n = e(t.target);
            if (!n.parents().hasClass("button-dropdown")) e(".button-dropdown .dropdown-toggle")
                .removeClass("active");
        })
    });
</script>
