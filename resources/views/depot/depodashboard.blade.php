@extends('depot.master')
@section('content')


<body>
<div class="" style="height:400px; width:100%;"> 
<div class="" style=" margin-top:100px; margin-left:100px; ">
    <div class="row justify-content-center" style="margin-left:0%;margin-right:0%">
        <div class="col-xs-4" >
            {{-- <div class="card" style = "background-color:#905352; color:white; align-items:center;"> --}}

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                
                  {{-- <div class= "wel"> <b style = "text-align:center;">Welcome To Depot Dashboard</b></div> --}}
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</body>


@endsection