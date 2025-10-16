@extends('design_main.s')

@section('content')

<div class="container mt-5 ">
    <div class="row justify-content-center ">
        <div class="col-md-6" style="margin-bottom: 5rem;">

            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <div class="card shadow p-4 " style="background-color:lightgreen;">
                <h4 class="mb-4 text-center">When you successfully submitted your application, then check your status</h4>

                <form method="POST" action="{{ route('check.cnic') }}">
                    @csrf

                    <div class="form-group">
                        <label for="cnic">Enter your CNIC</label>
                        <input type="text" class="form-control" id="cnic" name="cnic" placeholder="xxxxxxxxxxxxx" required>
                    </div>
                    <button type="submit" class="btn mt-3 w-100" style="background-color:rgb(0, 122, 61); color: white;">
    Track Status
</button>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection
