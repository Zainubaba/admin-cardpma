@extends('Institute.master')
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
                                    <a href="/ViewUsers">
                                        <div class="info-box-content" title="Total Submitted Applications">
                                            <span class="info-box-text" style=" color:white;">Total Applications</span>
                                            <span class="info-box-number" style=" color:white;">{{$submittedform}}</span>
                                        </div>
                                    </a>
                                    <!-- /.info-box-content -->
                                </div>
                            <!-- /.info-box -->
                        </div>
                        <!-- /.col -->
                            {{-- <div class="col-md-4 col-sm-6 col-12">
                                <div class="info-box" style="background-color: #F39C12; color:white;">
                                    <span class="info-box-icon" style=" color:white;"><i class="fas fa-hand-holding-usd"></i></span>
                                    <a href="">
                                        <div class="info-box-content">
                                            <span class="info-box-text" style=" color:white;">Pending at Department</span>
                                            <span class="info-box-number" style=" color:white;">{{ $pending }}</span>
                                        </div>
                                    </a>
                                    <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                            </div> --}}

                             <div class="col-md-4 col-sm-6 col-12">
                                <div class="info-box" style="background-color: #F39C12; color:white;">
                                    <span class="info-box-icon" style=" color:white;"><i class="fas fa-hourglass-half"></i></span>
                                    <a href="">
                                        <div class="info-box-content">
                                            <span class="info-box-text" style=" color:white;">Pending at Institute</span>
                                            <span class="info-box-number" style=" color:white;">{{ $pending }}</span>
                                        </div>
                                    </a>
                                    <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                            </div>

                            <div class="col-md-4 col-sm-6 col-12">
                                <div class="info-box" style="background-color:#2ECC71;">
                                    <span class="info-box-icon" style=" color:white;"><i class="fas fa-user-check"></i></span>
                                    <a href="/VerifiedUsers">
                                        <div class="info-box-content" title="Verified By Institute">
                                            <span class="info-box-text" style=" color:white;">Verified</span>
                                            <span class="info-box-number" style=" color:white;">{{ $verifiedbyinstitute }}</span>
                                        </div>
                                    </a>
                                    <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                            </div>

                             {{-- <div class="col-md-4 col-sm-6 col-12">
                                <div class="info-box" style="background-color: #E74C3C;">
                                    <span class="info-box-icon"  style=" color:white;"><i class="fas fa-user-times"></i></span>
                                    <a href="/rejectedappli">
                                        <div class="info-box-content">
                                            <span class="info-box-text" style=" color:white;">Card at stations</span>
                                            <span class="info-box-number" style=" color:white;">{{ $station }}</span>
                                        </div>
                                    </a>
                                    <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                            </div>


                            <div class="col-md-4 col-sm-6 col-12">
                                <div class="info-box" style="background-color: #9B59B6;" >
                                    <span class="info-box-icon" style=" color:white;"><i class="fas fa-id-card"></i></span>
                                    <a href="">
                                        <div class="info-box-content" title="Card Issue">
                                            <span class="info-box-text" style=" color:white;">Handed Over Cards</span>
                                            <span class="info-box-number" style=" color:white;">0</span>
                                        </div>
                         
                    </div> --}}
                </div>


                                              {{-- IMPORTANT --}}

                {{-- <div class="" style="height:400px; width:100%;">
<div class="" style=" margin-top:100px; margin-left:100px; ">
    <div class="row justify-content-center" style="margin-left:0%;margin-right:0%">
        <div class="col-xs-4" >

    @if(Auth::user()->status == NULL )

            <div class="card-body">
                        <div class="alert alert-success" role="alert">
                                Wait For the Approval of Head of Department!
                        </div>


                </div>
    @elseif(Auth::user()->status == 'rejected')

            <div class="card-body">
                        <div class="alert alert-danger" role="alert">
                                Your Registration is Rejected by Head of Department!
                        </div>


                </div>

    @endif

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif


                </div>
            </div>
        </div>
    </div>
</div>
</div> --}}

                <div class="container mt-5">
    <div class="row justify-content-center">
        
        <!-- Pie Chart 1 -->
        <div class="col-md-4">
            <canvas id="pieChart1" width="400" height="200"></canvas>
            <p class="mt-2 text-center text-dark font-weight-bold">Gender</p>
        </div>

        <!-- Pie Chart 2 -->
        {{-- <div class="col-md-4">
            <canvas id="pieChart2" width="400" height="200"></canvas>
            <p class="mt-2 text-center text-dark font-weight-bold">Cities</p>
        </div> --}}
        <!-- Pie Chart 3 -->
        {{-- <div class="row mt-4"> --}}
        
            {{-- <canvas id="" width="400" height="200"></canvas> --}}
            <!-- <p class="mt-2 text-center text-dark font-weight-bold">HOD</p> -->
        {{-- </div> --}}
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

