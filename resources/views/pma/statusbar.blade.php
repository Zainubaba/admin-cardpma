@extends('pma.design.master')
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
                                    /* success class color change */
                    #success_cls {
                        color: green;
                    }

                    .progress-meter {
                        width: 80%;
                        margin: 150px auto 0 auto;
                    }

                    .progress-meter .track {
                        position: relative;
                        height: 2px;
                        background: #dd6325;
                        margin-left: -20px;
                        top: 50px;
                        /* width: 100%; */
                    }

                    /* ================= */

                    .sms2:after {
                        background: url("images/track/sms1.png") no-repeat 0 0;
                        background-size: 86%;
                        padding-left: 13px;
                        padding-top: 9px;
                        background-origin: content-box, padding-box;
                        content: '';
                        position: absolute;
                        top: -100px;
                        left: 935px;
                        width: 60px;
                        height: 60px;
                        border: 2px solid #fff;
                        border-radius: 100%;
                    }

                    .sms2 a {
                        position: absolute;
                        font-size: 12px;
                        font-weight: 500;
                        text-align: center;
                        color: rgb(248, 250, 248);
                        background-color: none;
                        line-height: 23px;
                        top: -130px;
                        left: 950px;
                    }

                    .progress-meter .sms2_track {
                        position: absolute;
                        width: 2px;
                        height: 60px;
                        left: 964px;
                        background: #fff;
                        top: -46px;
                        /* margin-left: 20px; */
                    }

                    .progress-meter .sms_track {
                        position: relative;
                        width: 2px;
                        height: 60px;
                        left: 45px;
                        top: 50px;
                        background: #fff;
                        margin-left: 20px;
                    }
                    .progress-meter .sms_track1 {
                        position: relative;
                        width: 2px;
                        height: 70px;
                        left: 137px;
                        top: -150px;
                        background: #fff;
                        margin-left: 20px;
                    }

                    .sms:after {
                        background: url("images/track/sms1.png") no-repeat 0 0;
                        background-size: 86%;
                        padding-left: 13px;
                        padding-top: 9px;
                        background-origin: content-box, padding-box;
                        content: '';
                        position: absolute;
                        top: -100px;
                        left: 40px;

                        width: 60px;
                        height: 60px;
                        border: 2px solid #fff;
                        border-radius: 100%;
                    }
                    .sms4:after {
                        background: url("images/track/sms1.png") no-repeat 0 0;
                        background-size: 86%;
                        padding-left: 13px;
                        padding-top: 9px;
                        background-origin: content-box, padding-box;
                        content: '';
                        position: absolute;
                        top: -100px;
                        left: 128px;

                        width: 60px;
                        height: 60px;
                        border: 2px solid #fff;
                        border-radius: 100%;
                    }

                    .sms a {
                        position: absolute;
                        font-size: 12px;
                        font-weight: 500;
                        text-align: center;
                        color: rgb(248, 250, 248);
                        background-color: none;
                        line-height: 23px;
                        top: -130px;
                        left: 99px;
                    }

                    @media (max-width: 1023px) and (min-width: 961px) {
                        .progress-meter .sms_track {
                            height: 60px;
                            left: 30px;
                        }

                        .sms:after {
                            position: absolute;
                            top: -100px;
                            left: 22px;
                        }

                        .sms a {
                            top: -130px;
                            left: 42px;
                        }

                        .sms2:after {
                            position: absolute;
                            top: -100px;
                            left: 600px;
                        }

                        .sms2 a {
                            top: -130px;
                            left: 600px;
                        }

                        .progress-meter .sms2_track {
                            left: 630px;
                        }
                    }

                    @media (max-width: 1279px) and (min-width: 1024px) {
                        .progress-meter .sms_track {
                            height: 60px;
                            left: 50px;
                        }

                        .sms:after {
                            position: absolute;
                            top: -100px;
                            left: 43px;
                        }

                        .sms a {
                            top: -130px;
                            left: 65px;
                        }

                        .sms2:after {
                            position: absolute;
                            top: -100px;
                            left: 730px;
                        }

                        .sms2 a {
                            top: -130px;
                            left: 750px;
                        }

                        .progress-meter .sms2_track {
                            left: 760px;
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
                         background-color: #6286c2;
                    }

                    /* 1 */
                    .progress-meter .progress-point.step-contact:before {
                        content: "" !important;
                        background: url("images/Form fill-01.png") no-repeat 0 0  ;
                        background-size: 100%;
                        background-origin: content-box, padding-box;
                        padding: 10px;
                        background-color: #6286c2;
                    }

                    .progress-meter .progress-point.step-ii:before{
                        content: "" !important;
                        background: url("images/Payment-01.png") no-repeat 0 0  ;
                        background-size: 90%;
                        background-origin: content-box, padding-box;
                        padding: 10px;
                        background-color: #6286c2;
                    }
                    /* 2 */
                    .progress-meter .progress-point.step-offer:before {
                        content: "" !important;
                        background: url("images/verification-01.png") no-repeat 0 0  ;
                        background-size: 90%;
                        background-origin: content-box, padding-box;
                        padding: 10px;
                        background-color: #6286c2;
                    }

                    /* 3 */
                    .progress-meter .progress-point.step-configure:before {
                        /* content: "\f085" !important; */

                    }


                    .progress-meter .progress-point.step-4:before {
                        content: "" !important;
                        background: url("images/verification-01.png") no-repeat 0 0  ;
                        background-size: 90%;
                        background-origin: content-box, padding-box;
                        padding: 10px;
                        background-color: #6286c2 ;

                    }

                    .progress-meter .progress-point.step-5:before {
                        /* content:"\f016"!important; */
                        content: "!important";
                        background: url("images/card -01.png") no-repeat 0 0 ;
                        background-size: 100%;
                        background-origin: content-box, padding-box;
                        padding: 10px;
                        background-color: #6286c2 ;
                    }


                    /* icon style */

                    .progress-meter .progress-point:before {
                        display: block;
                        margin: -16px auto 0;
                        content: " ";
                        font-size: 26px;
                        font-family: FontAwesome;
                        color: #fff !important;
                        background-color: #6286c2;
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
                        color: rgb(1, 39, 1);
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

        background-color: #6286c2;
    }

    .progress-meter .progress-point[data-query-type="aa"]:after {
    counter-reset: stepaa;
        content: counter(stepaa);
        counter-increment: stepaa {{$submittedform}}

}

  .progress-meter .progress-point[data-query-type="ii"]:after {
        counter-reset: stepii;
        content: counter(stepii);
        counter-increment: stepii {{ $verified }};
    }

    .progress-meter .progress-point[data-query-type="bb"]:after {

    counter-reset: stepbb;
        content: counter(stepbb);
        counter-increment: stepbb {{ $pending }};
}

.progress-meter .progress-point[data-query-type="cc"]:after {
    counter-reset: stepcc;
        content: counter(stepcc);
        counter-increment: stepcc {{ $forward }}
;
}

.progress-meter .progress-point[data-query-type="dd"]:after {
    counter-reset: stepdd;
        content: counter(stepdd);
        counter-increment: stepdd {{ $forward }};
}


    /* Add the rest of your styles as needed */


                    .progress-meter .progress-point:after {


                        position: absolute;
                        top: -20px;
                        right: 85px;
                        font-size: 16px;
                        text-align: center;
                        color: #fff;
                        background-color: #6286c2;
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

                    @media (m-width: 1024px) {
                        .progress-meter {
                            width: 80%;
                        }


                    }

                    @media (max-width: 1023px) and (min-width: 961px) {
                        .progress-meter {
                            width: 80%;
                        }

                        .ph12 {
                            font-size: 10px;
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
                            background-color: #6286c2;
                        }

                        /* position of icons */
                        .progress-meter .progress-point:before {
                            margin: 0;
                            position: absolute;
                            margin-left: -86px;
                            padding: 8px 0 0 13px;
                            background-color: #6286c2;
                        }

                        .ph12 {
                            font-size: 14px;
                            line-height: 110%;
                            font-family: 'museo500', Verdana, sans-serif;
                            margin: 0 0 6px 0;

                        }
                    }

                    @media (max-width: 1110px) and (min-width: 965px) {
                        .container {
                            width: 80%;
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

                    @media (max-width: 960px) {
                        .progress-meter .track {
                            margin-top: 100px;
                            width: 2px;
                            height: 850px;
                            margin-left: 0px;
                            position: absolute;
                        }

                        .container {
                            margin: 20 auto;
                            height: 1120px !important;
                        }
                        .ph12{
                            padding-top: 15px !important;
                        }
                        .progress-meter .progress-point:after{

                            display: none;
                        }
                        .col-md-12{
                            padding-left: 300px !important;
                        }
                        .text-center{
                            margin-right: auto;
                        }
                        .sms4:after{
                            display: none !important;
                        }
                        .sms_track1{
                            display: none;
                        }
                    }
                    @media (max-width:768px){
                        .col-md-12{
                            padding-left: 200px !important;
                        }
                        h2 span{
                            margin-left: 120px !important;
                        }
                    }
                    @media (max-width:425px){
                        .col-md-12{
                            padding-left: 50px !important;
                        }
                        h2 span{
                            margin-left: 2px !important;
                        }
                    }
                    @media (max-width:375px){
                        h2 span{
                            /* margin-left: 50px !important; */
                        }
                    }
                    @media (max-width:320px){
                        .col-md-12{
                            padding-left: 30px !important;
                        }
                        h2 span{
                            font-size: 16px !important;
                            /* margin-left:64px !important; */
                        }
                    }
                    @media (max-width:575px){
                        .container{
                            width: 80%;
                        }
                    }

                    @media (max-width: 1023px) and (min-width: 961px) {
                        .progress-meter .track {
                            height: 2px;
                            width: 537px;
                        }
                    }

                    @media (max-width: 1279px) and (min-width: 1024px) {
                        .progress-meter .track {
                            height: 2px;
                            width: 577px;
                        }
                    }

                    /* @media (min-width: 7000px) and (min-width: 1280px) {
                        .progress-meter .track {
                            height: 10px;
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


                    @media screen and (min-width: 1200px) {

                        /* icon text */
                        .ph12 {
                            font-size: 10px;
                        }
                    }

                    /* @media screen and (min-width: 320px) {

                        /* icon text */
                        .ph12 {
                            margin-top: 20px;
                        }


                    @media screen and (max-width: 1440px) and(min-width:1098px) {
                        .progress-meter .track {
                            width: 800px;
                        }
                        h2 span{
                            margin:0 auto !important;
                        }
                    }
    </style>

            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
                    <section class="">


 <div class="text-center" style="margin-left:330px; margin-top:-6%; background-color:white; width:150vh; height:50vh">
                        <div class="progress-meter" style="height: 30vh;">
                            <div class="sms_track"></div>
                            <div class="track" style="width:700px; background-color:#6286c2"></div>
                            <div>
                                <ol class="progress-points mb-5">
                                    <!-- Your existing tracking bar code goes here -->
                                    <style>
                                                .progress-meter.successer::before {
                                                     background-color: green; */
                                                     background-image: url("images/approval.png") no-repeat 0 0;
                                                     background-image: url('images/checked.png');
                                                }

                                                .progress-meter .progress-point.successer:before {
                                                    background-color: green;
                                                }

                                                .progress-meter .progress-point.no_success:before {
                                                    background-color: #6286c2;
                                                }
                                                .progress-point.step-4:before  {
                                                    background-color: #6286c2;
                                                }
                                           .progress-point .step-offer::before {
                                                    background-color: #6286c2;
                                                }


                                                .success {
                                                    background-color: #6286c2;
                                                }
                                            </style>
                                            <!-- pwd---->
                                            <li class="progress-point step-contact" data-query-type="aa"

                        style="left:-4%">
                        <div class="progress-step-meta">
                            <div class="step-title ph12 " style="color:black; font-weight: bold"> Submitted <br>
                                Forms

                     </div>


        </div>
    </li>
    <li class="progress-point step-ii" data-query-type="ii"
        style="left:18%; color: #6286c2">
        <div class="progress-step-meta">
            <div class="step-title ph12 " style="color: black; font-weight: bold">Verified
            <br>
            Students
      </div>

        </div>
    </li>


                                            <!-- pwd end -->
                                            <!--SWO start -->
                                            <li class="progress-point step-offer" data-query-type="bb"
        style="left:40% ">
        <div class="progress-step-meta">
            <div class="step-title ph12 " style="color: black; font-weight: bold">Pending
            <br>
            Students  </div>

        </div>
    </li>



                                            <!--dd start -->
                                            <li class="progress-point step-offer step-4" data-query-type="cc"


                                                style="left:62%">
                                                <div class="progress-step-meta ">

                                                    <div class="step-title ph12" style="color: black; font-weight: bold">Forward to
                                                    <br>
                                                   BOP</div>

    </div>

                                            </li>

                                            <li class="progress-point step-offer step-5" data-query-type="dd" style="left:85%">
                                                <div class="progress-step-meta">
                                                    <div class="step-title ph12" style="color: black; font-weight: bold">Cards Issue
                                                    </div>



                                                </div>
                                            </li>

                                </ol>
                            </div>
                        </div>
                    </div>



                        </section>



                  </div>

                </body>

                <script> $(document).ready(function () {
    $(".progress-point").on("click", function () {
        var queryType = $(this).data("query-type");

        switch (queryType) {
            case 'aa':
                window.location.href = "/regappli";
                break;
            case 'bb':
                window.location.href = "/pendappli";
                break;
            case 'cc':
                window.location.href = "/forwardappli";
                break;
            case 'dd':
                window.location.href = "";
                break;
            case 'ee':
                window.location.href = "";
                break;
            case 'ff':
                window.location.href = "";
                break;
            case 'ii':
                window.location.href = "/verifyappli";
                break;
            default:
                // Handle default case or do nothing
                break;
        }
    });
});
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


@endsection
