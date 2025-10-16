@extends('Institute.master')

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

{{-- @foreach ($dataata as $data) --}}
    <div id="content-wrapper" class="d-flex flex-column" style="">
        <div class="content-container">
            <h2 class="text-center font-bold font-up danger-text">{{ $data->passenger_name }}</h2>
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
                    @if ($data->photo)
                        <img src="{{ asset('uploads/photo/' . $data->photo) }}" alt="Profile Image" style="max-width:100px;" />
                    @else
                        <span>N/A</span>
                    @endif
                </div>
                <div class="col-md-3">
                    <label>Full Name:</label>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control form-control-inline" value="{{ $data->passenger_name ?? 'N/A' }}">
                </div>
            </div>
            <div class="row card-body">
                <div class="col-md-3">
                    <label>CNIC:</label>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control form-control-inline" value="{{ $data->cnic ?? 'N/A' }}">
                </div>
                <div class="col-md-3">
                    <label>Contact:</label>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control form-control-inline" value="{{ $data->contact ?? 'N/A' }}">
                </div>
            </div>
            <div class="row card-body">
                <div class="col-md-3">
                    <label>Date of Birth:</label>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control form-control-inline" value="{{ $data->dob ?? 'N/A' }}">
                </div>
                <div class="col-md-3">
                    <label>Gender:</label>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control form-control-inline" value="{{ $data->gender ?? 'N/A' }}">
                </div>
            </div>
            <div class="row card-body">
                <div class="col-md-3">
                    <label>CNIC Type:</label>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control form-control-inline" value="{{ $data->cnic_type ?? 'N/A' }}">
                </div>
                <div class="col-md-3">
                    <label>CNIC Expiry:</label>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control form-control-inline" value="{{ $data->cnic_expiry ?? 'N/A' }}">
                </div>
            </div>
            <div class="row card-body">
                <div class="col-md-3">
                    <label>Category:</label>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control form-control-inline" value="{{ $data->category ?? 'N/A' }}">
                </div>
                <div class="col-md-3">
                    <label>Confirmation:</label>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control form-control-inline" value="{{ $data->confirmation ?? 'N/A' }}">
                </div>
            </div>
            <h5>Trip Information:</h5>
            <div class="row card-body">
                <div class="col-md-3">
                    <label>Card Type:</label>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control form-control-inline" value="{{ $data->card_type ?? 'N/A' }}">
                </div>
                <div class="col-md-3">
                    <label>District:</label>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control form-control-inline" value="{{ $data->district ?? 'N/A' }}">
                </div>
            </div>
            <div class="row card-body">
                <div class="col-md-3">
                    <label>Tehsil:</label>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control form-control-inline" value="{{ $data->tehsil ?? 'N/A' }}">
                </div>
                <div class="col-md-3">
                    <label>Institute Type:</label>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control form-control-inline" value="{{ $data->institute_type ?? 'N/A' }}">
                </div>
            </div>
            <div class="row card-body">
                <div class="col-md-3">
                    <label>Education Level:</label>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control form-control-inline" value="{{ $data->edu_level ?? 'N/A' }}">
                </div>
                </div>

            <div class="row card-body">
                <div class="col-md-3">
                    <label>Organization Name:</label>
                </div>
                <div class="col-md-9">
                    <input type="text" class="form-control form-control-inline" value="{{ $data->org_name ?? 'N/A' }}">
                </div>
            </div>
            <div class="row card-body">
                <div class="col-md-3">
                    <label>Address:</label>
                </div>
                <div class="col-md-9">
                    <input type="text" class="form-control form-control-inline" value="{{ $data->address ?? 'N/A' }}">
                </div>
            </div>



            <h5>Attachments:</h5>
            <div class="row card-body">
                @if ($data->cnic_front)
                    <div class="col-md-3">
                        <label>CNIC Front:</label>
                    </div>
                    <div class="col-md-3">
                        <img src="{{ asset('uploads/cnic_front/' . $data->cnic_front) }}" alt="CNIC Front" style="max-width:100px;" />
                    </div>
                @endif
                @if ($data->cnic_back)
                    <div class="col-md-3">
                        <label>CNIC Back:</label>
                    </div>
                    <div class="col-md-3">
                        <img src="{{ asset('uploads/cnic_back/' . $data->cnic_back) }}" alt="CNIC Back" style="max-width:100px;" />
                    </div>
                @endif
            </div>
            <div class="row card-body">
                @if ($data->bform)
                    <div class="col-md-3">
                        <label>B-Form:</label>
                    </div>
                    <div class="col-md-3">
                        <img src="{{ asset('uploads/bform/' . $data->bform) }}" alt="B-Form" style="max-width:100px;" />
                    </div>
                @endif
                @if ($data->student_id_card)
                    <div class="col-md-3">
                        <label>Student ID Card:</label>
                    </div>
                    <div class="col-md-3">
                        <img src="{{ asset('uploads/student_id_card/' . $data->student_id_card) }}" alt="Student ID Card" style="max-width:100px;" />
                    </div>
                @endif
            </div>

@if($data->verified_users != NULL)
             <h5>Verification by Institute:</h5>
            <div class="row card-body">
                    <div class="col-md-3">
                        <label>Verify Status:</label>
                    </div>
                    <div class="col-md-3">
                        @if($data->verified_users == '1')
                    <input type="text" class="form-control form-control-inline" value="{{'Verified'}}">
                        @endif

                        @if($data->verified_users == '0')
                            <input type="text" class="form-control form-control-inline" value="{{'Rejected'}}">
                        @endif
                    </div>

                @if($data->feedback != NULL)

                    <div class="col-md-3">
                        <label>Feedback:</label>
                    </div>
                    <div class="col-md-3">

                            <input type="text" class="form-control form-control-inline" value="{{$data->feedback}}">
                    </div>
                @endif

                @if (!(int)$data->verified_users && (int)$data->verified_users !== '0')

               {{-- @if($data->verified_users != NULL) --}}

       <div class="row card-body verify-user-div" id="verify-user-{{ $data->user_id ?? 'default' }}">
    <!-- Validity period input -->
    <label class="fieldlabels">
        Expected validity period for student in this institution: <span>*</span>
    </label>
    <input type="month" 
           name="end_year_input" 
           id="end_year_{{ $data->user_id ?? 'default' }}" 
           class="form-control" 
           placeholder="Select Month and Year">

    <div class="col-md-12 text-center mt-3">
        <h5>Verify the user?</h5>
        <!-- VERIFY BUTTON -->
        <button type="button" class="btn btn-success verify-btn" 
                onclick="verifyUser('{{ $data->user_id ?? 'default' }}')" 
                {{ isset($data->user_id) && !$data->verified_users ? '' : 'disabled' }}>
            {{ $data->verified_users ? 'Verified' : 'Verify' }}
        </button>

        <!-- REJECT BUTTON -->
        <button type="button"  class="btn btn-danger reject-btn" 
                onclick="rejectUser('{{ $data->user_id ?? 'default' }}')" 
                {{ isset($data->user_id) && $data->confirmation !== '0' && !$data->verified_users ? '' : 'disabled' }}>
            Reject
        </button>

        <!-- REJECTION COMMENTS -->
<div class="form-group mt-3">
    <label for="rejection_reason_{{ $data->user_id ?? 'default' }}">
        Rejection Comments:
    </label>
    <textarea name="rejection_reason" 
              id="rejection_reason_{{ $data->user_id ?? 'default' }}" 
              class="form-control" 
              rows="3" 
              placeholder="Enter reason for rejection"></textarea>
</div>


        <!-- HIDDEN VERIFY FORM -->
        <form id="verify-form-{{ $data->user_id ?? 'default' }}" 
              action="{{ route('verify.user', ['user_id' => $data->user_id ?? '']) }}" 
              method="POST" style="display: none;">
            @csrf
            <input type="hidden" name="end_year" id="verify-end-year-{{ $data->user_id ?? 'default' }}">
        </form>

        <!-- HIDDEN REJECT FORM -->
        <form id="reject-form-{{ $data->user_id ?? 'default' }}" 
              action="{{ route('reject.user', ['user_id' => $data->user_id ?? '']) }}" 
              method="POST" style="display: none;">
            @csrf
            <input type="hidden" name="end_year" id="reject-end-year-{{ $data->user_id ?? 'default' }}">
            <input type="hidden" name="rejection_reason" id="reject-reason-{{ $data->user_id ?? 'default' }}">
        </form>
    </div>
</div>
            @endif

            </div>
        @endif

        </div>
    </div>
{{-- @endforeach --}}


<script>
    function printPage() {
        window.print();
    }
</script>
<script>
function verifyUser(userId) {
    let input = document.getElementById('end_year_' + userId);
    let selectedDate = input.value;

    if (!selectedDate) {
        alert('Please select the expected validity period before verifying.');
        return;
    }

    // Set hidden input and submit form
    document.getElementById('verify-end-year-' + userId).value = selectedDate;
    document.getElementById('verify-form-' + userId).submit();
}

function rejectUser(userId) {
    let input = document.getElementById('end_year_' + userId);
    let selectedDate = input.value;

    if (!selectedDate) {
        alert('Please select the expected validity period before rejecting.');
        return;
    }

    let reason = document.getElementById('rejection_reason_' + userId).value;

    if (!reason.trim()) {
        alert('Please provide rejection comments.');
        return;
    }

    // Set hidden input and submit form
    document.getElementById('reject-end-year-' + userId).value = selectedDate;
     document.getElementById('reject-reason-' + userId).value = reason;
    document.getElementById('reject-form-' + userId).submit();
}
</script>
<script>
 
    function dontVerify() {
        if (confirm('Are you sure you want to skip verification?')) {
            alert('Verification skipped.');
        }
    }
    function printPage() {
        window.print();
    }
</script>
@endsection



