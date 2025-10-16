<?php
header('X-Frame-Options: ALLOW-FROM https://swbm-mis.punjab.gov.pk/');
header("Content-Security-Policy: frame-ancestors 'self' https://swbm-mis.punjab.gov.pk/;");
?>
@extends('dashboard_design.design.master')
@section('content')
 <script>
        if (window.self !== window.top) {
            // If the page is inside an iframe, hide the navbar
            document.addEventListener("DOMContentLoaded", function() {
                document.querySelector("nav.navbar").style.display = "none"; // Hide the navbar
            });
        }
    </script>
    <script>
        function sendHeight() {
            setTimeout(() => {
                const height = document.documentElement.scrollHeight;
                window.parent.postMessage({
                    iframeHeight: height
                }, "https://swbm-mis.punjab.gov.pk/");
            }, 100);
        }

        window.onload = sendHeight;
        window.onresize = sendHeight; // Adjust on window resize
        setInterval(sendHeight, 500); // Adjust height dynamically
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">


    <script src="https://cdnjs.cloudflare.com/ajax/libs/babel-polyfill/7.4.0/polyfill.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/exceljs/4.1.1/exceljs.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.2/FileSaver.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.0.0/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.9/jspdf.plugin.autotable.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/devextreme/21.1.4/css/dx.light.css" rel="stylesheet" />

    <head>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


        <style>

/* new style */
            .background {
            border solid 1px: grey;
            }

            .table td{
                padding:4px !important;
            }

            body {
                background-color: #EBEEF1;
            }


            .container-fluid {
                margin-left: 20%;
                width: 77%;
            }

            .info-box {
                height: 70px;
                border-radius: 7px;
                padding: 10px;
                margin-bottom: 10px;
                color: white;
                display: flex;
                flex-direction: column;
            }

            .additional-info {
                margin-top: 5px;
                font-size: 14px;
                /* border: 2px solid white; */
                margin-left: 11.5%;
            }

            a {
                text-decoration: none;
                color: white;
            }

            /* Card Header Styling */
            .card-header {
                color: white;
                background-color: #111a33;
                height: 50px;
                display: flex;
                align-items: center;
                overflow: hidden;
            }

            .card-header h6 {
                margin: 0;
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
                max-width: 80%;
            }

            /* Responsive adjustments */
            @media (max-width: 768px) {
                .sidebar {
                    display: none;
                    /* Hide sidebar on medium and small screens */
                }

                .container-fluid {
                    width: 95%;
                    /* Increase width slightly for smaller screens */
                    margin-left: 5%;
                    /* Remove left margin */
                }
            }

            @media (max-width: 1280px) {
                .sidebar {
                    display: block;
                }

                .container-fluid {
                    width: 75%;
                    margin-left: 23%;
                }
            }

            @media (max-width: 1024px) {
                .sidebar {
                    display: none;
                }

                .container-fluid {
                    width: 75%;
                    margin-left: 15%;
                }
            }

            .full-image {
                width: 100%;
                height: 100%;
                object-fit: cover;
            }


            .breadcrumb-item+.breadcrumb-item::before {
    content: "" !important; /* Removes the separator */
}

.active-breadcrumb {
    background-color: #111a33;
    color: white !important;
    padding: 5px;
}

.active-breadcrumb a {
    color: white !important; /* Ensures link text is also white */
    text-decoration: none;
}

.inactive-breadcrumb a {
    color: #111a33 !important;
    text-decoration: none;
    padding: 5px;
}

        </style>

    </head>



    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-auto col-md-9">
                <h3 class="text-dark mb-4 mt-3">Dashboard</h3>
            </div>

        </div>



        <div class="row info-box-row">
            <!-- Custom CSS for styling -->
            <style>
                .info-box {
                    display: flex;
                    align-items: start;
                    justify-content: center;
                    text-align: start;
                    height: 80px;
                    width: 100%;
                    border-radius: 8px;
                    color: white;
                }

                .info-icon {
                    font-size: 1.5rem;
                    background-color: rgba(255, 255, 255, 0.33);
                    padding: 5px;
                    border-radius: 10%;
                    margin-bottom: 10px;
                }

                .info-box-text {
                    font-weight: bold;
                    font-size: 0.9rem;
                }

                .bottom b {
                    font-size: 0.9rem;
                }

                .additional-info {
                    font-size: 1rem;
                    margin-top: 5px;
                }
            </style>
            <style>
                .info-box {
                    min-height: 60px;
                    padding: 5px;
                }
            </style>
            <div class="col-md-4 col-sm-6 col-12">
                <div class="info-box" style="background-color: #FF8203;">
                    <div class="infox-box-content"
                        style="width: 100%;display: flex; align-items: center;justify-content: start">
                        <div class="top">
                            <i class="bi bi-file-earmark-text-fill info-icon"></i>
                        </div>
                        <a href= "/districtwisedata">
                        <div class="bottom" style="margin-left: 10px;display: flex;flex-direction: column">
                            <span class="info-box-text">Total Submitted Applications</span>
                            <b>Total: {{ $submittedappli }}</b>
                        </div>
                    </a>

                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 col-12">
                <div class="info-box" style="background-color: #aea905;">
                    <div class="infox-box-content"
                        style="width: 100%;display: flex; align-items: center;justify-content: start">
                        <div class="top">
                            <i class="bi bi-file-earmark-text-fill info-icon"></i>
                        </div>

                    <a href= "/districtwiseverifieddata">
                        <div class="bottom" style="margin-left: 10px;display: flex;flex-direction: column">
                            <span class="info-box-text">Verified Applications </span>
                            <b>
                                Total: {{ $verified }}
                                {{-- Phase-1: {{$phase1}} <br> Phase-2: {{$phase2}}<br> --}}

                            </b>
                        </div>
                    </a>

                    </div>
                </div>
            </div>

              <div class="col-md-4 col-sm-6 col-12">
                <div class="info-box" style="background-color:  #bf558a;">
                    <div class="infox-box-content"
                        style="width: 100%;display: flex; align-items: center;justify-content: start">
                        <div class="top">
                            <i class="bi bi-arrow-right-circle-fill info-icon"></i>
                        </div>

                        <a href= "/districtwiseforwardeddata">
                        <div class="bottom" style="margin-left: 10px;display: flex;flex-direction: column">
                            <span class="info-box-text">Request Forward to BOP</span>
                            <b>Total: {{ $forwardtobop }}</b>
                        </div>
                    </a>

                    </div>
                </div>
            </div>

        </div>


        <div class="row mt-5 flex-1 items-center justify-content-between">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h6 class="card-title"><b>Gender-Wise Applications</b></h6>
                        <div class="card-tools">

                        </div>
                    </div>
                    <div class="card-body">
                        <canvas id="myPieChart"
                            style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%; display: block; width: 400px;"
                            width="334" height="250" class="chartjs-render-monitor"></canvas>

                        <script>
                            // Dynamic chart data
                            var labels = {!! json_encode($labels) !!};
                            var dataValues = {!! json_encode($dataValues) !!};
                            var colors = ["#FFD700", "#FF69B4", "#71439C"];

                            // Get the context of the canvas element
                            var ctx = document.getElementById('myPieChart').getContext('2d');

                            // Create a pie chart
                            var myPieChart = new Chart(ctx, {
                                type: 'pie',
                                data: {
                                    labels: labels,
                                    datasets: [{
                                        data: dataValues,
                                        backgroundColor: colors
                                    }]
                                },
                                options: {
                                    title: {
                                        display: true,
                                        text: "Data from Database Pie Chart",
                                        fontColor: '#ffffff' // White title for contrast
                                    }
                                }
                            });
                        </script>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card" id="barChartCard">
                    <div class="card-header">
                        <h6 class="card-title"><b>Institute-Wise Applications</b></h6>
                        <div class="card-tools">

                        </div>
                    </div>
                    <div class="card-body">
                        <canvas id="myPieChart2"
                            style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%; display: block; width: 334px;"
                            width="334" height="250" class="chartjs-render-monitor"></canvas>

                        <script>
                            var rlabels = {!! json_encode($rlabels) !!};
                            var rdataValues = {!! json_encode($rdataValues) !!};

                            var barColors = ["#109421", "#FE0000", "#072AC9", "#FF8203", "#bf558a"];

                            var cty = document.getElementById('myPieChart2').getContext('2d');

                            // Create a pie chart
                            var myPieChart = new Chart(cty, {
                                type: 'pie',
                                data: {
                                    labels: rlabels,
                                    datasets: [{
                                        data: rdataValues,
                                        backgroundColor: barColors
                                    }]
                                },
                                options: {
                                    title: {
                                        display: true,
                                        text: "Data from Database Pie Chart",
                                        fontColor: '#ffffff' // White title for contrast
                                    }
                                }
                            });
                        </script>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card" id="barChartCard">
                    <div class="card-header">
                        <h6 class="card-title"><b>City-Wise Applications</b></h6>
                        <div class="card-tools">

                        </div>
                    </div>
                    <div class="card-body">
                        <canvas id="myPieChart3"
                            style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%; display: block; width: 334px;"
                            width="334" height="250" class="chartjs-render-monitor"></canvas>

                        <script>
                            var clabels = {!! json_encode($clabels) !!};
                            var cdataValues = {!! json_encode($cdataValues) !!};

                            var barColors = ["#109421", "#FE0000", "#072AC9", "#FF8203", "#bf558a"];

                            var cty = document.getElementById('myPieChart3').getContext('2d');

                            // Create a pie chart
                            var myPieChart = new Chart(cty, {
                                type: 'pie',
                                data: {
                                    labels: clabels,
                                    datasets: [{
                                        data: cdataValues,
                                        backgroundColor: barColors
                                    }]
                                },
                                options: {
                                    title: {
                                        display: true,
                                        text: "Data from Database Pie Chart",
                                        fontColor: '#ffffff' // White title for contrast
                                    }
                                }
                            });
                        </script>
                    </div>
                </div>
            </div>



        </div>
    </div>
@endsection

