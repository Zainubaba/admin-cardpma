@extends('head_institute.master')
@section('content')



    {{-- <h1 class="text-center my-4 font-weight-bold" style="font-size: 3rem; color:gray;">PMA DASHBOARD</h1> --}}

    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row">
                       <div class="col-md-4 col-sm-6 col-12">
                                <div class="info-box" style="background-color: #4A90E2; color:white;">
                                    <span class="info-box-icon"><i class="fas fa-clipboard-list"></i></span>
                                    <a href="/viewstudlist">
                                        <div class="info-box-content" title="Total Submitted Applications">
                                            <span class="info-box-text" style=" color:white;">Total Submitted Applications</span>
                                            <span class="info-box-number" style=" color:white;">{{$submittedform}}</span>
                                        </div>
                                    </a>
                                    <!-- /.info-box-content -->
                                </div>
                            <!-- /.info-box -->
                        </div>
                        <!-- /.col -->
                            <div class="col-md-4 col-sm-6 col-12">
                                <div class="info-box" style="background-color: #F39C12; color:white;">
                                    <span class="info-box-icon" style=" color:white;">
                                        {{-- <i class="fas fa-hourglass-half"></i> --}}
                                    <img src="/images/pending2 (3).png" style="height:100%">
                                    </span>
                                    <a href="/viewplist">
                                        <div class="info-box-content">
                                            <span class="info-box-text" style=" color:white;">Pending at Department</span>
                                            <span class="info-box-number" style=" color:white;">{{  $pendingform }}</span>
                                        </div>
                                    </a>
                                    <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                            </div>

                             <div class="col-md-4 col-sm-6 col-12">
                                <div class="info-box" style="background-color: teal; color:white;">
                                    <span class="info-box-icon" style=" color:white;"><i class="fas fa-arrow-circle-right"></i></span>
                                    <a href="">
                                        <div class="info-box-content">
                                            <span class="info-box-text" style=" color:white;">Forwarded to Institute</span>
                                            <span class="info-box-number" style=" color:white;">{{ $forwardform }}</span>
                                        </div>
                                    </a>
                                    <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                            </div>

                            <div class="col-md-4 col-sm-6 col-12">
                                <div class="info-box" style="background-color:#25a725;">
                                    <span class="info-box-icon" style=" color:white;">
                                        {{-- <i class="fas fa-check-circle"></i> --}}
                                     <i class="fas fa-user-check"></i>
                                    </span>
                                    <a href="/verifylist">
                                        <div class="info-box-content" title="Verified By Institute">
                                            <span class="info-box-text" style=" color:white;">Verified Students By Institutes</span>
                                            <span class="info-box-number" style=" color:white;">{{ $verifiedbyinstitute }}</span>
                                        </div>
                                    </a>
                                    <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                            </div>

                             <div class="col-md-4 col-sm-6 col-12">
                                <div class="info-box" style="background-color: #E74C3C;">
                                    <span class="info-box-icon"  style=" color:white;"><i class="fas fa-times-circle"></i></span>
                                    <a href="/rejectedlist">
                                        <div class="info-box-content">
                                            <span class="info-box-text" style=" color:white;">Rejected Students By Institutes</span>
                                            <span class="info-box-number" style=" color:white;">{{ $rejected }}</span>
                                        </div>
                                    </a>
                                    <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                            </div>


                            <div class="col-md-4 col-sm-6 col-12">
                                <div class="info-box" style="background-color: #9B59B6;" >
                                    <span class="info-box-icon" style=" color:white;"><i class="fas fa-id-card"></i></span>
                                    <a href="/viewp2list">
                                        <div class="info-box-content" title="Card Issue">
                                            <span class="info-box-text" style=" color:white;">Pending at Department</span>
                                            <span class="info-box-number" style=" color:white;">{{ $aforwardform }}</span>
                                        </div>
                         
                    </div>
                </div>

                <div class="container mt-5">
    <div class="row justify-content-center">
        <!-- Pie Chart 1 -->
        <div class="col-md-4">
            <canvas id="pieChart1" width="400" height="200"></canvas>
            <p class="mt-2 text-center text-dark font-weight-bold">Gender</p>

        </div>
        <!-- Pie Chart 2 -->
        <div class="col-md-4">
            <canvas id="pieChart2" width="400" height="200"></canvas>
            <p class="mt-2 text-center text-dark font-weight-bold">Cities</p>
        </div>
        <!-- Pie Chart 3 -->
        <div class="row mt-4">
        
            <canvas id="" width="400" height="200"></canvas>
            <!-- <p class="mt-2 text-center text-dark font-weight-bold">HOD</p> -->
        </div>
    </div>
</div>
</div>

        </section>
    </div>
    <!-- AdminLTE App -->
    <script src="../../dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../../dist/js/demo.js"></script>

    <!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const pieData1 = {
        labels: ['Male', 'Female'],
        datasets: [{
            data: [{{ $maleCount }}, {{ $femaleCount }}],
            backgroundColor: ['#9B59B6', '#1ABC9C'],
        }]
    };

    const pieData2 = {
        labels: ['Lahore', 'Multan','Rawalpindi'],
        datasets: [{
            data: [{{ $lahoreCount }},{{ $multanCount }}, {{ $rawalpindiCount }} ],
            backgroundColor: ['#4A90E2', '#2ECC71', '#F39C12'],
        }]
    };

    const pieData3 = {
        labels: [ 'HED Colleges',  'TEVTA', 'SED Schools', 'PVTC'],
        datasets: [{
            data: [
                {{ $hedGovCount }},
            
                {{ $tevtaCount }},
                {{ $sedCount }},
                {{ $pvtcCount }}],
            backgroundColor: ['#4A90E2', '#2ECC71', '#F39C12', '#E74C3C', '#9B59B6', '#1ABC9C', '#34495E'],

            borderWidth: 1,
            borderHeight: 50,
        barThickness: 10,
        }]
    };

    new Chart(document.getElementById('pieChart1'), {
        type: 'pie',
        data: pieData1,
    });

    new Chart(document.getElementById('pieChart2'), {
        type: 'pie',
        data: pieData2,
    });

    new Chart(document.getElementById('pieChart3'), {
        type: 'bar',
        data: pieData3,
    });
</script>

@endsection




{{-- <div class="row">
                        <div class="col-12 col-sm-6 col-md-4 mb-3">
                            <div class="info-box" style="background-color: #D1FAE5;">
                                <span class="info-box-icon">
                                    <i class="fas fa-file-alt"></i>
                                </span>
                                <a href="/viewstudlist" class="text-decoration-none">
                                    <div class="info-box-content" title="Total Submitted Applications">
                                        <span class="info-box-text">Total Submitted Applications</span>
                                        <span class="info-box-number">{{ $submittedform }}</span>
                                    </div>
                                </a>
                                <div class="wave wave1"></div>
                                <div class="wave wave2"></div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4 mb-3">
                            <div class="info-box" style="background-color: #EDE9FE;">
                                <span class="info-box-icon">
                                    <i class="fas fa-hourglass-half"></i>
                                </span>
                                <a href="/viewplist" class="text-decoration-none">
                                    <div class="info-box-content">
                                        <span class="info-box-text">Pending at Department</span>
                                        <span class="info-box-number">{{ $pendingform }}</span>
                                    </div>
                                </a>
                                <div class="wave wave1"></div>
                                <div class="wave wave2"></div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4 mb-3">
                            <div class="info-box" style="background-color: #DBEAFE;">
                                <span class="info-box-icon">
                                    <i class="fas fa-arrow-circle-right"></i>
                                </span>
                                <a href="" class="text-decoration-none">
                                    <div class="info-box-content">
                                        <span class="info-box-text">Forwarded to Institute</span>
                                        <span class="info-box-number">{{ $submittedform }}</span>
                                    </div>
                                </a>
                                <div class="wave wave1"></div>
                                <div class="wave wave2"></div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4 mb-3">
                            <div class="info-box" style="background-color: #D4F4FA;">
                                <span class="info-box-icon">
                                    <i class="fas fa-check-circle"></i>
                                </span>
                                <a href="/verifylist" class="text-decoration-none">
                                    <div class="info-box-content" title="Verified Students">
                                        <span class="info-box-text">Verified Students By Institutes</span>
                                        <span class="info-box-number">{{ $verified }}</span>
                                    </div>
                                </a>
                                <div class="wave wave1"></div>
                                <div class="wave wave2"></div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4 mb-3">
                            <div class="info-box" style="background-color: #FEF3C7;">
                                <span class="info-box-icon">
                                    <i class="fas fa-times-circle"></i>
                                </span>
                                <a href="/rejectedlist" class="text-decoration-none">
                                    <div class="info-box-content">
                                        <span class="info-box-text">Rejected Students By Institutes</span>
                                        <span class="info-box-number">{{ $rejected }}</span>
                                    </div>
                                </a>
                                <div class="wave wave1"></div>
                                <div class="wave wave2"></div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4 mb-3">
                            <div class="info-box" style="background-color: #FEE2E2;">
                                <span class="info-box-icon">
                                    <i class="fas fa-clock"></i>
                                </span>
                                <a href="/viewp2list" class="text-decoration-none">
                                    <div class="info-box-content">
                                        <span class="info-box-text">Pending at Department</span>
                                        <span class="info-box-number"></span>
                                    </div>
                                </a>
                                <div class="wave wave1"></div>
                                <div class="wave wave2"></div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4 mb-3">
                            <div class="info-box" style="background-color: #F5F3FF;">
                                <span class="info-box-icon">
                                    <i class="fas fa-share-square"></i>
                                </span>
                                <a href="/rejectedlist" class="text-decoration-none">
                                    <div class="info-box-content">
                                        <span class="info-box-text">Forwarded to AFC</span>
                                        <span class="info-box-number">{{ $rejected }}</span>
                                    </div>
                                </a>
                                <div class="wave wave1"></div>
                                <div class="wave wave2"></div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4 mb-3">
                            <div class="info-box" style="background-color: #FCE7F3;">
                                <span class="info-box-icon">
                                    <i class="fas fa-university"></i>
                                </span>
                                <a href="/rejectedlist" class="text-decoration-none">
                                    <div class="info-box-content">
                                        <span class="info-box-text">Forwarded to BOP</span>
                                        <span class="info-box-number">{{ $rejected }}</span>
                                    </div>
                                </a>
                                <div class="wave wave1"></div>
                                <div class="wave wave2"></div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4 mb-3">
                            <div class="info-box" style="background-color: #E0F2FE;">
                                <span class="info-box-icon">
                                    <i class="fas fa-print"></i>
                                </span>
                                <a href="/rejectedlist" class="text-decoration-none">
                                    <div class="info-box-content">
                                        <span class="info-box-text">Card Printed</span>
                                        <span class="info-box-number">{{ $rejected }}</span>
                                    </div>
                                </a>
                                <div class="wave wave1"></div>
                                <div class="wave wave2"></div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4 mb-3">
                            <div class="info-box" style="background-color: #FFEDD5;">
                                <span class="info-box-icon">
                                    <i class="fas fa-id-card-alt"></i>
                                </span>
                                <a href="" class="text-decoration-none">
                                    <div class="info-box-content" title="Card Issue">
                                        <span class="info-box-text">Card Issued</span>
                                        <span class="info-box-number">{{ $rejected }}</span>
                                    </div>
                                </a>
                                <div class="wave wave1"></div>
                                <div class="wave wave2"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
 --}}
