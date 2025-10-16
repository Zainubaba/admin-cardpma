@extends('head_institute.master')

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
        /* margin-left: 10px; */
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
        background-color: #4f1614;
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
            /* margin-left: 1%; */
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

@foreach ($data as $d)
    <div id="content-wrapper" class="d-flex flex-column" style="padding:50px;">
        <div class="content-container">
            <div>
                {{-- <div class="d-flex print justify-content-end">
                    <button class="print-button" onclick="printPage()">
                        <i class="fas fa-print"></i> Print
                    </button>
                </div> --}}
                <h5>Institute Information:</h5>
            </div>
            <div class="row card-body">

                <div class="col-md-3">
                    <label>Name:</label>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control form-control-inline" value="{{ $d->name ?? 'N/A' }}">
                </div>

                <div class="col-md-3">
                    <label>CNIC:</label>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control form-control-inline" value="{{ $d->cnic ?? 'N/A' }}">
                </div>
            </div>

            <div class="row card-body">

                <div class="col-md-3">
                    <label>Contact:</label>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control form-control-inline" value="{{ $d->phone_number ?? 'N/A' }}">
                </div>

                <div class="col-md-3">
                    <label>Email:</label>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control form-control-inline" value="{{ $d->email ?? 'N/A' }}">
                </div>

            </div>

            <div class="row card-body">

                <div class="col-md-3">
                    <label>District:</label>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control form-control-inline" value="{{ $d->dname ?? 'N/A' }}">
                </div>

                <div class="col-md-3">
                    <label>Tehsil:</label>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control form-control-inline" value="{{ $d->tehsil_name ?? 'N/A' }}">
                </div>
            </div>

            <div class="row card-body">

                <div class="col-md-3">
                    <label>Institute Type:</label>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control form-control-inline" value="{{ $d->institute_name ?? 'N/A' }}">
                </div>

                <div class="col-md-3">
                    <label>Education Level:</label>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control form-control-inline" value="{{ $d->edu_level_name ?? 'N/A' }}">
                </div>
            </div>

            <div class="row card-body">

                <div class="col-md-3">
                    <label>Head of Department:</label>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control form-control-inline" value="{{ $d->hod_name ?? 'N/A' }}">
                </div>
            </div>

            <div class="row card-body">

                <div class="col-md-3">
                    <label>Organization Name:</label>
                </div>
                <div class="col-md-9">
                    <input type="text" class="form-control form-control-inline" value="{{$d->emis}} | {{ $d->org_name ?? 'N/A' }}">
                </div>
            </div>

  @if ($d->status == NULL)

                          <form id="" action="{{ route('update.status', $d->uid) }}" method="POST" style="">
                                @csrf


              <div class="container col-md-12" style="border: 1px solid black; padding: 10px;">
                        <h5>Institute Verification:</h5>

                        <div class="col-md-12">
                            <label>Do you verify the institute?</label>
                        </div>

                        <div class="col-md-12">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="verifyCheck" name="status" value="verified">
                                <label class="form-check-label" for="verifyCheck">Verified</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="rejectCheck" name="status" value="rejected">
                                <label class="form-check-label" for="rejectCheck">Rejected</label>
                            </div>
                        </div>

                    <div class="col-md-12 d-flex justify-content-end mt-3">
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </div>

                    </form>

            @endif


@if($d->status != NULL)
             <h5>Verification by Institute:</h5>
            <div class="row card-body">
                    <div class="col-md-3">
                        <label>Verify Status:</label>
                    </div>
                    <div class="col-md-3">
                        @if($d->status == '1')
                    <input type="text" class="form-control form-control-inline" value="{{'Verified'}}">
                        @endif

                        @if($d->status == '0')
                            <input type="text" class="form-control form-control-inline" value="{{'Rejected'}}">
                        @endif
                    </div>


            </div>
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
