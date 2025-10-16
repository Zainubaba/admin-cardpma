@extends('pma.design.master')

@section('content')
<style>
    body {
        background-color: #f8f9fa;
    }
    #content-wrapper {
        background-color: #f8f9fa;
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
    .card-body label {
        font-weight: bold;
    }
    .card-body .form-control {
        display: inline-block;
        margin-left: 10px;
        border: none;
        border-bottom: 1px solid black;
        border-radius: 0;
    }
    .card-body .form-control-inline {
        display: inline-block;
    }
    .footerlogo {
        text-align: center;
        height: 30px;
        width: 30px;
        margin: 20px;
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
    }
    @media (max-width: 576px) {
        .card {
            width: 195px;
            font-size: 14px;
        }
        .var {
            font-size: 13px;
        }
    }
    .box {
        direction: rtl;
        display: flex;
        justify-content: center;
    }
    .card-body {
        padding: 0.10rem;
    }
    h5 {
        background-color: #090f29;
        color: white;
        padding: 10px;
        width: max-content;
        border-radius: 5px;
    }
    .print-button {
        margin: 5px 0;
        background-color: #090f29;
        color: white;
        border: none;
        border-radius: 5px;
        padding: 10px 15px;
        cursor: pointer;
        font-size: 16px;
        transition: background-color 0.3s ease;
    }
    .print-button:hover {
        background-color: #090f29;
    }
    .content-container {
        max-width: 960px;
        margin: 0 auto;
    }
    @media print {
        .print-button {
            display: none !important;
        }
        body {
            margin: 0;
            padding: 20px;
            font-size: 12pt;
            background-color: #ffffff;
        }
        .container-fluid {
            width: 100% !important;
            padding: 0 !important;
        }
        .content-container {
            max-width: 100% !important;
            margin: 0 !important;
        }
        h5 {
            padding: 1px;
        }
        .row {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }
        .col-md-3 {
            flex: 0 0 23%;
            margin-bottom: 10px;
            page-break-inside: avoid;
        }
        element.style {
            margin-left: 1%;
        }
        .sidebar {
            display: none !important;
        }
        .menu-icon {
            display: none !important;
        }
        * {
            page-break-inside: avoid !important;
        }
    }
</style>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script async src="https://www.googletagmanager.com/gtag/js?id=G-MEJMNHHFKH"></script>
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

@foreach ($data as $d)
    <div id="content-wrapper" class="d-flex flex-column" style="">
        <div class="content-container">
            <h2 class="text-center font-bold font-up danger-text">{{ $d->passenger_name }}</h2>
            <div>
                {{-- <div class="d-flex print justify-content-end">
                    <button class="print-button" onclick="printPage()">
                        <i class="fas fa-print"></i> Print
                    </button>
                </div> --}}
                <h5>Basic Information:</h5>
            </div>
            <div class="row card-body">
                <div class="col-md-3">
                    <label>Profile Image:</label>
                </div>
                <div class="col-md-3">
                    @if ($d->photo)
                        <img src="{{ asset('uploads/photo/' . $d->photo) }}" alt="Profile Image" style="max-width:100px;" />
                    @else
                        <span>N/A</span>
                    @endif
                </div>
                <div class="col-md-3">
                    <label>Full Name:</label>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control form-control-inline" value="{{ $d->passenger_name ?? 'N/A' }}">
                </div>
            </div>
            <div class="row card-body">
                <div class="col-md-3">
                    <label>CNIC:</label>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control form-control-inline" value="{{ $d->cnic ?? 'N/A' }}">
                </div>
                <div class="col-md-3">
                    <label>Contact:</label>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control form-control-inline" value="{{ $d->contact ?? 'N/A' }}">
                </div>
            </div>
            <div class="row card-body">
                <div class="col-md-3">
                    <label>Date of Birth:</label>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control form-control-inline" value="{{ $d->dob ?? 'N/A' }}">
                </div>
                <div class="col-md-3">
                    <label>Gender:</label>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control form-control-inline" value="{{ $d->gender ?? 'N/A' }}">
                </div>
            </div>
            <div class="row card-body">
                <div class="col-md-3">
                    <label>CNIC Type:</label>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control form-control-inline" value="{{ $d->cnic_type ?? 'N/A' }}">
                </div>
                <div class="col-md-3">
                    <label>CNIC Expiry:</label>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control form-control-inline" value="{{ $d->cnic_expiry ?? 'N/A' }}">
                </div>
            </div>
            <div class="row card-body">
                <div class="col-md-3">
                    <label>Category:</label>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control form-control-inline" value="{{ $d->category ?? 'N/A' }}">
                </div>
                <div class="col-md-3">
                    <label>Confirmation:</label>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control form-control-inline" value="{{ $d->confirmation ?? 'N/A' }}">
                </div>
            </div>
            <h5>Trip Information:</h5>
            <div class="row card-body">
                <div class="col-md-3">
                    <label>Card Type:</label>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control form-control-inline" value="{{ $d->card_type ?? 'N/A' }}">
                </div>
                <div class="col-md-3">
                    <label>District:</label>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control form-control-inline" value="{{ $d->district ?? 'N/A' }}">
                </div>
            </div>
            <div class="row card-body">
                <div class="col-md-3">
                    <label>Tehsil:</label>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control form-control-inline" value="{{ $d->tehsil ?? 'N/A' }}">
                </div>
                <div class="col-md-3">
                    <label>Institute Type:</label>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control form-control-inline" value="{{ $d->institute_type ?? 'N/A' }}">
                </div>
            </div>
            <div class="row card-body">
                <div class="col-md-3">
                    <label>Education Level:</label>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control form-control-inline" value="{{ $d->edu_level ?? 'N/A' }}">
                </div>
            </div>

            <div class="row card-body">
                <div class="col-md-3">
                    <label>Organization Name:</label>
                </div>
                <div class="col-md-9">
                    <input type="text" class="form-control form-control-inline" value="{{ $d->org_name ?? 'N/A' }}">
                </div>
            </div>
            <div class="row card-body">
                <div class="col-md-3">
                    <label>Address:</label>
                </div>
                <div class="col-md-9">
                    <input type="text" class="form-control form-control-inline" value="{{ $d->address ?? 'N/A' }}">
                </div>
            </div>

            <h5>Attachments:</h5>
            <div class="row card-body">
                @if ($d->cnic_front)
                    <div class="col-md-3">
                        <label>CNIC Front:</label>
                    </div>
                    <div class="col-md-3">
                        <img src="{{ asset('uploads/cnic_front/' . $d->cnic_front) }}" alt="CNIC Front" style="max-width:100px;" />
                    </div>
                @endif
                @if ($d->cnic_back)
                    <div class="col-md-3">
                        <label>CNIC Back:</label>
                    </div>
                    <div class="col-md-3">
                        <img src="{{ asset('uploads/cnic_back/' . $d->cnic_back) }}" alt="CNIC Back" style="max-width:100px;" />
                    </div>
                @endif
            </div>
            <div class="row card-body">
                @if ($d->bform)
                    <div class="col-md-3">
                        <label>B-Form:</label>
                    </div>
                    <div class="col-md-3">
                        <img src="{{ asset('uploads/bform/' . $d->bform) }}" alt="B-Form" style="max-width:100px;" />
                    </div>
                @endif
                @if ($d->student_id_card)
                    <div class="col-md-3">
                        <label>Student ID Card:</label>
                    </div>
                    <div class="col-md-3">
                        <img src="{{ asset('uploads/student_id_card/' . $d->student_id_card) }}" alt="Student ID Card" style="max-width:100px;" />
                    </div>
                @endif
            </div>


            @if($d->forward == NULL)

                  <form action="{{ route('store.forwardstatus') }}" method="POST" enctype="multipart/form-data">
      @csrf

            <input type="hidden" name="user_id" id="user_id" value="{{$d->uid}}" />

               <div class="col-md-12">
                        <h5>Forward to BOP for Card:</h5>
                </div>

                    <div class="container">
                         <div class="row justify-content-center">
                            <div class="col-10 col-md-10 col-lg-10 p-0" >
                                <div class="card px-4 py-3">
                                    <div class="form-card">


                                                       <div class="align-items-center my-4">

                                            <div class="col-md-12">
                                                <label>Forward Status:</label>

                                                <div class="form-check col-md-4">
                                                    <input type="radio" id="verify_concern" value="Yes" name="forward" class="form-check-input" required  style="">
                                                    <label class="form-check-label" for="verified">Forward</label>
                                                </div>
                                                <div class="form-check col-md-4">
                                                    <input type="radio" id="reject_concern" value="No" name="forward" class="form-check-input" required  style="">
                                                    <label class="form-check-label" for="rejected">Not Forward</label>
                                                </div>
                                            </div>
<br>
                                              <div class="col-md-12">
                                                <label>Add Remarks:</label>

                                                <div class="form-check">
                                                       <input type="text" class="form-control form-control-inline" id="feedback" name = "feedback" value="" placeholder="Add Remarks">
                                                </div>

                                            </div>
                                        </div>

                             <button type="submit" class="btn btn-success pull-right" style="">Submit</button>
                                    </div>
                                          </div>
                                    </div>
                                    </div>
                                    </div>
                </form>
                @endif

                  @if($d->forward != NULL)
             <h5>Forward To BOP:</h5>
            <div class="row card-body">
                    <div class="col-md-3">
                        <label>Forward Status:</label>
                    </div>
                    <div class="col-md-3">

                    <input type="text" class="form-control form-control-inline" value="{{$d->forward}}">


                @endif





        </div>
    </div>
@endforeach


<script>
    function printPage() {
        window.print();
    }
</script>
@endsection
