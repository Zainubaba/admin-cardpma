@extends('design_main.master')
@section('content')


<link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<style>
    /* General styling */
    body {
        overflow-x: hidden;
        font-family: 'Montserrat', sans-serif;
    }

    .action-button {
    width: 100px;
    background: #198754 !important;
    }
    .montserrat-form {
        font-family: 'Montserrat', sans-serif;
        color: rgb(0, 122, 61);
    }

    /* Ensure fieldsets and container take full width */
    .container-fluid.montserrat-form {
        width: 100%;
        max-width: 1000px;
        padding: 0 15px;
    }

    .row.justify-content-center {
        width: 100%;
        margin: 0;
    }

    .col-11.col-lg-10 {
        width: 100%;
        max-width: 100%;
        padding: 0;
    }

    fieldset {
        width: 100%;
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        background: transparent;
    }

    .d-flex.flex-wrap {
        display: flex;
        flex-wrap: nowrap;
        width: 100%;
    }

    .col-md-5 {
        flex: 1 1 50%;
        box-sizing: border-box;
        padding: 1rem;
    }

    /* Form styling */
    label {
        font-size: 14px;
        font-weight: 700;
        font-family: 'Montserrat', sans-serif;
    }

    input, select {
        margin-bottom: 5px;
        margin-top: 3px;
        background-color: #ccd4dc;
        font-family: 'Montserrat', sans-serif;
        width: 100% !important;
        font-size: 14px; /* Smaller font size */
    padding: 6px; /* Reduced padding for smaller input fields */
    height: 32px;
    }

    .form-control {
        width: 100% !important;
    }

    .select2-container {
        width: 100% !important;
    }

    .select2-container--default .select2-selection--single {
        background-color: #ccd4dc;
        border: 1px solid #ced4da;
        height: 32px;
        display: flex;
        align-items: center;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 32px;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 38px;
    }

    span {
        color: red;
    }

    /* Error styling */
    .error {
        border: 2px solid red;
    }

    /* Progress bar (hidden as per original design) */
    #progressbar {
        display: none;
    }

    .progress-bar {
        background-color: rgb(0, 122, 61);
    }

    /* Navbar and responsive adjustments */
    .navbar-brand span {
        font-weight: 900;
        font-size: 24px;
        font-family: 'Montserrat', sans-serif;
        color: rgb(0, 122, 61);
    }

    .bg-light {
        height: 500px;
        margin-top: -30px;
        border-radius: 25px;
    }

    @media screen and (max-width: 991px) {
        .navbar-brand span {
            font-size: 22px;
            margin: 20px;
            padding: 0;
        }
        .navbar-brand p {
            font-size: 20px;
            margin: 0;
            padding: 0;
        }
        .nav-item {
            margin-top: 40px;
        }
    }

    @media screen and (max-width: 480px) {
        .imgback {
            background: none;
        }
        .nav-item {
            margin-top: 60px;
        }
        .navbar-brand span {
            font-size: 18px;
            margin: 0;
            padding: 0;
        }
        .navbar-brand p {
            font-size: 16px;
            margin: 0;
            padding: 0;
        }
    }

    @media screen and (max-width: 800px) {
        .imgback {
            display: none;
        }
        .d-flex.flex-wrap {
            flex-wrap: wrap;
        }
        .col-md-6 {
            flex: 1 1 100%;
        }
    }

    @media screen and (max-width: 1024px) {
        .imgback {
            margin-left: -100px;
        }
    }
</style>

<body>
    @if($rejectionComment)
    <div class="alert alert-danger alert-dismissible fade show shadow-sm rounded-lg mt-3 text-center" 
         role="alert" 
         style="color: #fff; background-color: #dc3545; border-color: #dc3545;">
        <strong>Application Rejected:</strong><br>
        {{ $rejectionComment }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="color:#fff; position:absolute; right:10px; top:10px;">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif


@if($showReapplyPrompt)
  <div class="alert alert-warning text-center rounded-lg shadow-sm my-3">
    <strong>Your previous application expired ({{ \Carbon\Carbon::parse($archived->valid_until)->format('Y-m-d') }}).</strong>
    Please <a href="{{ route('pmaform') }}">re-apply</a>.
  </div>
@endif




<div class="container-fluid montserrat-form">
    <div class="row justify-content-center">
        {{-- <div class="col-11 col-lg-10 mt-5 shadow-lg rounded overflow-hidden"> smaller size  --}}
            <div class="col-12 mt-5 shadow-lg rounded overflow-hidden px-3 px-lg-5" style="margin-left:200px">

            <div id="msform">
                <!-- Progress Bar (Hidden) -->
                <div style="position: absolute; left: -9999px; visibility: hidden;">
                    <ul id="progressbar">
                        <li class="active" id="account"><strong>Basic Information</strong></li>
                        <li id="personal"><strong>Institute Information</strong></li>
                        <li id="payment"><strong>Attachments</strong></li>
                        <li id="confirm"><strong>Guidelines</strong></li>
                    </ul>
                    <div class="progress">
                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
<?php
                    $basicInfo = \App\Models\BasicInfo::where('user_id', Auth::user()->id)->first();
                    ?>
                <!-- Step 1: Basic Information -->
<fieldset id="step1">
    <input type="hidden" name="step" id="step" value="1" />
    {{-- <div class="d-flex flex-wrap" style="min-height: 600px;"> --}}
        <div class="d-flex justify-content-center align-items-start" style="min-height: 600px;">
        <!-- Form -->
           {{-- <div class="col-md-8 bg-white py-3"> smaller size --}}
          <div class="w-100 bg-white py-3" style="max-width: none; margin: 0 20px;">
            <div class="text-center mb-4">
            <h2 class="text-success font-weight-bold">Step 1 - Basic Info</h2>
            </div>
            <form id="msform1" method="POST" enctype="multipart/form-data">
                @csrf
                {{-- <input type="hidden" name="category" value="Student Card" /> --}}

                   <input type="hidden" name="category" placeholder="Enter Your Name" value="Student Card"/>
                            <input type="hidden" name="user_id" value="{{Auth::user()->id}}"/>

                <div class="form-row justify-content-center">
                    <div class="form-group col-md-5 mr-5">
                        <label class="font-weight-bold">Gender <span>*</span></label>
                        <select name="gender" id="genderDropdown" class="form-control" required>
                            <option value="{{ $basicInfo ? $basicInfo->gender : '' }}">{{ $basicInfo ? $basicInfo->gender : 'Select Gender' }}</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                    <div class="form-group col-md-5">
                        <label class="font-weight-bold">CNIC Type <span>*</span></label>
                        <select id="cnic_type" name="cnic_type" class="form-control" required>
                            <option value="{{ $basicInfo ? $basicInfo->cnic_type : '' }}">{{ $basicInfo ? $basicInfo->cnic_type : 'Select CNIC Type' }}</option>
                            <option value="CNIC">CNIC</option>
                            <option value="Bform">B-form</option>
                        </select>
                    </div>

                    <div class="form-group col-md-5 mr-5">
                        <label class="font-weight-bold">Student Name <span>*</span></label>
                        <input type="text" name="passenger_name" id="passenger_name" value="{{ $basicInfo ? $basicInfo->passenger_name : '' }}" maxlength="20" class="form-control"
                               placeholder="Enter Your Name" required />
                    </div>
                    <div class="form-group col-md-5">
                        <label class="font-weight-bold">CNIC / B-form No <span>*</span></label>
                        <input type="number" id="old_cnic" name="cnic" min="1000000000000" max="9999999999999"
                               oninput="checkLength(this); validateEvenLastDigit(this);"
                               class="form-control" value ="{{ $basicInfo ? $basicInfo->cnic : '' }}" placeholder="XXXXXXXXXXXXX" maxlength="13" required>
                    </div>

                    <!-- CNIC Dates (hidden initially) -->
                     <div id="cnicExpiryContainer"  class="form-row justify-content-center" style="display: none;">
                            <div class="form-row">
                    <div  class="form-group col-md-5 mr-5 ml-4" >
                        <label class="font-weight-bold">CNIC Issuance Date <span>*</span></label>
                        <input type="date" name="cnic_issuance_date" class="form-control" value="{{ $basicInfo ? $basicInfo->cnic_issuance_date : '' }}">
                    </div>
                    <div class="form-group col-md-5" >
                        <label class="font-weight-bold">CNIC Expiry Date <span>*</span></label>
                        <input type="date" name="cnic_expiry" id="cnic_expiry" value ="{{ $basicInfo ? $basicInfo->cnic_expiry : '' }}" class="form-control">
                    </div>
                </div>
                      </div>
                    {{-- <div class="form-group col-md-5 mr-5">
                        <label class="font-weight-bold">Email <span>*</span></label>
                        <input id="email" type="email" name="email" class="form-control" placeholder="Enter your email" required value="{{ $basicInfo ? $basicInfo->email : '' }}" />
                    </div> --}}
                    <input type="hidden" name="email" value="{{ Auth::user()->email }}">
                    <div class="form-group col-md-5 mr-5">
                        <label class="font-weight-bold">Contact No <span>*</span></label>
                        <input type="tel" name="contact" id="contact" pattern="[0-9]{11}" class="form-control" value ="{{ $basicInfo ? $basicInfo->contact : '' }}" maxlength="11"
                               placeholder="XXXXXXXXXXX" required>
                    </div>

                    <div class="form-group col-md-5">
    <label class="font-weight-bold">Punjab Domicile <span>*</span></label>
    <select name="punjab_domicile" class="form-control" required>
        <option value="">Select an option</option>
        <option value="Yes" {{ old('punjab_domicile', $basicInfo->punjab_domicile ?? '') === 'Yes' ? 'selected' : '' }}>Yes</option>
        <option value="No"  {{ old('punjab_domicile', $basicInfo->punjab_domicile ?? '') === 'No' ? 'selected' : '' }}>No</option>
    </select>
</div>


                    <div class="form-group col-md-5 mr-5" >
                    <label class="font-weight-bold">Date of Birth <span>*</span></label>
                        <input type="date" name="dob" id="dob" class="form-control" required value ="{{ $basicInfo ? $basicInfo->dob : '' }}" >                        
                    </div>

<div class="form-group col-md-5">
    <label class="font-weight-bold">District <span>*</span></label>
    <select id="district" name="district" class="form-control" required>
        <option value="">Select District</option>
        @foreach ($districts as $district)
            <option value="{{ $district->id }}"
                @if((string) old('district', $tripInfo->district ?? '') === (string) $district->id) selected @endif>
                {{ $district->name }}
            </option>
        @endforeach
    </select>
</div>






                    {{-- <div class="form-group col-md-5 mr-5">
                        <label class="font-weight-bold">Password <span>*</span></label>
                        <input id="password" type="password" name="password" class="form-control" required placeholder="Minimum 8 characters">
                    </div>
                    <div class="form-group col-md-5" >
                        <label class="font-weight-bold">Confirm Password <span>*</span></label>
                        <input id="password-confirm" type="password" name="password_confirmation" class="form-control" required>
                    </div> --}}
                </div>

                <!-- Guardian Fields (optional) -->
<div id="guardianFields" class="form-row justify-content-center" style="display: none;">
    <!-- Guardian Relation -->
<div class="form-group col-md-5 mr-5 ml-4">
    <label class="font-weight-bold">Select Relation <span>*</span></label>
    <select name="guardian_relation" id="guardianRelation" class="form-control">
        <option value="">-- Select --</option>
        <option value="Father" {{ (old('guardian_relation', $guardian->guardian_relation ?? '') == 'Father') ? 'selected' : '' }}>Father</option>
        <option value="Mother" {{ (old('guardian_relation', $guardian->guardian_relation ?? '') == 'Mother') ? 'selected' : '' }}>Mother</option>
        <option value="Guardian" {{ (old('guardian_relation', $guardian->guardian_relation ?? '') == 'Guardian') ? 'selected' : '' }}>Guardian</option>
    </select>
</div>

<!-- Appointment File Upload -->
{{-- <div id="courtOrderSection" class="form-group col-md-5 ml-4">
    <label class="font-weight-bold">Court Order for Appointment <span>*</span></label>
    <input type="file" name="appointment" class="form-control-file" accept=".pdf,.jpg,.jpeg,.png">
    
    @if(isset($guardian) && $guardian->appointment)
        <small class="form-text text-success">
            File already uploaded: <a href="{{ asset('storage/' . $guardian->appointment) }}" target="_blank">View File</a>
        </small>
    @endif
</div> --}}

    
    <div class="form-row">
    <div class="form-group col-md-5 mr-5 ml-4">
        <label class="font-weight-bold">Guardian / Father Name <span>*</span></label>
        <input type="text" name="guardian_name" class="form-control" placeholder="Enter Guardian Name" value="{{ $guardian ? $guardian->guardian_name : '' }}">
    </div>
    <div class="form-group col-md-5">
        <label class="font-weight-bold">Guardian CNIC Number <span>*</span></label>
        <input type="number" name="guardian_cnic" class="form-control" placeholder="XXXXXXXXXXXXX" maxlength="13"
               min="1000000000000" max="9999999999999" oninput="checkLength(this);" value="{{ $guardian ? $guardian->guardian_cnic : '' }}">
    </div>
    </div>
    <div class="form-row">
    <div class="form-group col-md-5 mr-5 ml-4">
        <label class="font-weight-bold">Guardian CNIC Issuance Date <span>*</span></label>
        <input type="date" name="guardian_cnic_issue" class="form-control" value="{{ $guardian ? $guardian->guardian_cnic_issue : '' }}">
    </div>
    <div class="form-group col-md-5">
        <label class="font-weight-bold">Guardian CNIC Expiry Date <span>*</span></label>
        <input type="date" name="guardian_cnic_expiry" class="form-control" value="{{ $guardian ? $guardian->guardian_cnic_expiry : '' }}">
    </div>
    </div>
</div>

                <button type="button" name="next" class="btn btn-success btn-block next mt-3">Next</button>
            </form>
        </div>

        <!-- Image Section -->
        {{-- <div class="col-md-4 p-4 text-white d-flex flex-column justify-content-center align-items-start"
     style="background: linear-gradient(to right, #006a4e, #00b870, #7ed957);">
    <h2 class="font-weight-bold">Welcome, Student!</h2>
    <p style="color: white;">Fill out your basic details to get started with your personalized T Cash Card application.</p>
    
    <ul style="
        text-align: left;
        margin-top: 1rem;
        padding-left: 2rem;
        list-style-type: disc;
        color: white;
    ">
        <li>Must be studying in a Punjab institute, technical school, or madrassa</li>
        <li>Must have a Punjab domicile</li>
        <li>Must have completed education from 6th grade up to 18 years of education (or equivalent)</li>
    </ul>
</div> --}}
    </div>
</fieldset>

<?php
                    $tripInfo = \App\Models\TripInfo::where('user_id', Auth::user()->id)->first();
                    ?>

                <!-- Step 2: Institute Information -->
                <fieldset id="step2" style="display: none;">
                    <input type="hidden" name="step" id="step" value="2" />
                    <input type="hidden" id="basicInfoId1" name="user_id">

                    <input type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}" />
                    {{-- <div class="d-flex flex-wrap" style="min-height: 600px;"> --}}
                           <div class="d-flex  justify-content-center align-items-start" style="min-height: 600px;">

                       
                        <!-- Form -->
                        {{-- <div class="col-md-8 bg-white py-3"> --}}
                            <div class="w-100 bg-white py-3" style="max-width: none; margin: 0 20px;">
            <div class="text-center mb-4">
                            <h2 class="text-success font-weight-bold">Step 2 - Institute Information</h2>
            </div>
                            <form id="msform2" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="card_type" id="card_type" value="Plastic Card">

                                <!-- District -->
                                <div class="form-row justify-content-center">
                    <div class="form-group col-md-5 mr-5">
                                    <label class="font-weight-bold">District <span>*</span></label>
                                    <select class="form-control" id="district" name="district" required>
                                        <option value="">Select District First</option>
                                        @foreach (App\Models\District::all() as $key => $value)
                                           <option {{ isset($tripInfo) && $tripInfo->district == $value->id ? 'selected' : '' }}
                                                            value="{{ $value->id }}">
                                                            {{ $value->name }}
                                        @endforeach
       
                                    </select>
                                </div>

                                <!-- Preferred Metro Bus Station -->
                                <div class="form-group col-md-5">
                                    <label class="font-weight-bold">Preferred Station for Card Delivery <span>*</span></label>
                                    <select class="form-control" name="metro_stop" id="metro_stop" required>
                                      <option value="{{ $tripInfo ? $tripInfo->metro_stop : '' }}">{{ $tripInfo ? $tripInfo->metro_stop : 'Select Station' }}</option>
                                    </select>
                                </div>

                                <!-- Tehsil -->
                                <div class="form-group col-md-5 mr-5">
                                    <label class="font-weight-bold">Tehsil <span>*</span></label>
                                    <select class="form-control" id="tehsil" name="tehsil" required>
                                        <option value="{{ $tripInfo ? $tripInfo->tehsil : '' }}">{{ $tripInfo ? $tripInfo->tehsil  : 'Select Tehsil Name' }}</option>
                                    </select>
                                </div>

                                <!-- Institute Type -->
                                <div class="form-group col-md-5">
                                    <label class="font-weight-bold">Institute Type <span>*</span></label>
                                    <select class="form-control" id="institute_type" name="institute_type" required>
                                        <option value="{{ $tripInfo ? $tripInfo->institute_type : '' }}">{{ $tripInfo ? $tripInfo->institute_type : 'Select Institute Type' }}</option>
                                    </select>
                                </div>

                                <!-- Education Level -->
                                <div class="form-group col-md-5 mr-5">
                                    <label class="font-weight-bold">Education Level <span>*</span></label>
                                    <select class="form-control" id="edu_level" name="edu_level" required>
                                        <option value="{{ $tripInfo ? $tripInfo->edu_level : '' }}">{{ $tripInfo ? $tripInfo->edu_level : 'Select Education Level' }}</option>
                                        @foreach ($eduLevels as $level)
                                            <option value="{{ $level->id }}">{{ $level->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Grade -->
                                <div class="form-group col-md-5">
                                    <label class="font-weight-bold">Grade <span>*</span></label>
                                    <select class="form-control" id="grade" name="grade" required>
                                        <option value="{{ $tripInfo ? $tripInfo->grade : '' }}">{{ $tripInfo ? $tripInfo->grade : 'Select Grade' }}</option>
                                    </select>
                                </div>

                                <!-- Institute/Organization Name -->
                                <div class="form-group col-md-5 mr-5">
                                    <label class="font-weight-bold">Institute/Organization Name <span>*</span></label>
                                    <select class="form-control" id="org_name" name="org_name" required>

                                        <option value="{{ $tripInfo ? $tripInfo->org_name : '' }}">{{ $tripInfo ? $tripInfo->org_name : 'Select Organization Name' }}</option>
                                    </select>
                                </div>

                                <!-- Student Roll Number -->
                                <div class="form-group col-md-5">
                                    <label class="font-weight-bold">Student Roll Number <span>*</span></label>
                                    <input type="text" name="sidnum" class="form-control" placeholder="Enter Enrollment number" required value="{{ $tripInfo ? $tripInfo->sidnum : '' }}">
                                </div>

                                <!-- Start Session Year -->
                                <div class="form-group col-md-5 mr-5">
                                    <label class="font-weight-bold">Start Session Year <span>*</span></label>
                                    <input type="month" name="start_year" id="start_year" class="form-control" required value="{{ $tripInfo ? $tripInfo->start_year : '' }}">
                                </div>

                                <!-- End Session Year -->
                                <div class="form-group col-md-5">
                                    <label class="font-weight-bold">End Session Year <span>*</span></label>
                                    <input type="month" name="end_year" id="end_year" class="form-control" required value="{{ $tripInfo ? $tripInfo->end_year : '' }}">
                                </div>

                                <!-- Current Residential Address -->
                                <div class="form-group col-md-5 mr-5">
                                    <label class="font-weight-bold">Current Residential Address <span>*</span></label>
                                    <input type="text" name="address" class="form-control" placeholder="Enter Current Residential Address" required value ="{{ $tripInfo ? $tripInfo->address : '' }}">
                                </div>
</div>
                                

                                <!-- Navigation Buttons -->
                                <button type="button" name="next" class="btn btn-success btn-block next action-button">Next</button>
                                <button type="button" name="previous" class="btn btn-outline-secondary btn-block previous action-button-previous">Previous</button>
                            </form>
                        </div>
                        <!-- Image Section -->
                        {{-- <div class="col-md-4 p-4 text-white d-flex flex-column justify-content-center align-items-center"
                             style="background: linear-gradient(to right, #006a4e, #00b870, #7ed957);">
                            <h2 class="font-weight-bold">Institute Details</h2>
                            <p class="text-center" style=" color: white !important;">Provide your institute information to continue with your T Cash Card application.</p> --}}
                            {{-- <img src="{{ asset('images/institute_icon.png') }}" alt="institute" class="img-fluid mt-3" style="max-height: 180px;">
                        </div> --}}
                    </div>
                </fieldset>

 <?php
                    $attachments = \App\Models\Attachment::where('user_id', Auth::user()->id)->first();
                    ?>

    @if($attachments)
<fieldset id="step3" style="display: none;">
    <input type="hidden" name="step" id="step" value="3" />
    <input type="hidden" id="basicInfoId2" name="user_id">
    <input type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}" />
    {{-- <div class="d-flex flex-wrap" style="min-height: 600px;"> --}}
<div class="d-flex justify-content-center align-items-start" style="min-height: 600px;">

         
        <!-- Form -->
        <div class="col-md-8 bg-white py-3">
            <div class="text-center mb-4">
                <h2 class="text-success font-weight-bold">Step 3 - Attachments</h2>
            </div>
            <form id="msform3" method="POST" enctype="multipart/form-data">
                @csrf
                <!-- Profile Photo -->
                <div class="form-group">
                    <label class="font-weight-bold">Profile Photo (White background) <span>*</span></label>
                    <input type="file" name="photo" class="form-control" accept=".png,.jpg,.jpeg" required>
                </div>
                @if ($attachments->photo != null)
                    <input type="hidden" name="photo1" value="{{ $attachments->photo }}">
                    <img src="{{ asset('Uploads/photo/' . $attachments->photo) }}"
                         alt="Image {{ $attachments->photo }}"
                         style="max-width:100px;" /><br>
                @endif

                @if (isset($basicInfo) && $basicInfo->cnic_type == 'CNIC')
                    <!-- CNIC Front -->
                    <div id="cnic_front_group" class="form-group" style="display: none;">
                        <label class="font-weight-bold">CNIC Front <span>*</span></label>
                        <input type="file" name="cnic_front" class="form-control" accept=".png,.jpg,.jpeg">
                    </div>
                    @if ($attachments->cnic_front != null)
                        <input type="hidden" name="cnic_front1" value="{{ $attachments->cnic_front }}">
                        <img src="{{ asset('Uploads/cnic_front/' . $attachments->cnic_front) }}"
                             alt="Image {{ $attachments->cnic_front }}"
                             style="max-width:100px;" /><br>
                    @endif
                    <!-- CNIC Back -->
                    <div id="cnic_back_group" class="form-group" style="display: none;">
                        <label class="font-weight-bold">CNIC Back <span>*</span></label>
                        <input type="file" name="cnic_back" class="form-control" accept=".png,.jpg,.jpeg">
                    </div>
                    @if ($attachments->cnic_back != null)
                        <input type="hidden" name="cnic_back1" value="{{ $attachments->cnic_back }}">
                        <img src="{{ asset('Uploads/cnic_back/' . $attachments->cnic_back) }}"
                             alt="Image {{ $attachments->cnic_back }}"
                             style="max-width:100px;" /><br>
                    @endif
                @endif

                @if (isset($basicInfo) && $basicInfo->cnic_type == 'Bform')
                    <!-- B-Form -->
                    <div id="bform_group" class="form-group" style="display: none;">
                        <label class="font-weight-bold">B-Form <span>*</span></label>
                        <input type="file" name="bform" class="form-control" accept=".png,.jpg,.jpeg">
                    </div>
                    @if ($attachments->bform != null)
                        <input type="hidden" name="bform1" value="{{ $attachments->bform }}">
                        <img src="{{ asset('Uploads/bform/' . $attachments->bform) }}"
                             alt="Image {{ $attachments->bform }}"
                             style="max-width:100px;" /><br>
                    @endif
                @endif

                <!-- Student Identity Card -->
                <div class="form-group">
                    <label class="font-weight-bold">Student Identity Card <span>*</span></label>
                    <input type="file" name="student_id_card" class="form-control" accept=".png,.jpg,.jpeg" required>
                </div>
                @if ($attachments->student_id_card != null)
                    <input type="hidden" name="student_id_card1" value="{{ $attachments->student_id_card }}">
                    <img src="{{ asset('Uploads/student_id_card/' . $attachments->student_id_card) }}"
                         alt="Image {{ $attachments->student_id_card }}"
                         style="max-width:100px;" /><br>
                @endif

                <!-- Navigation Buttons -->
                <button type="button" name="next" class="btn btn-success btn-block next action-button">Next</button>
                <button type="button" name="previous" class="btn btn-outline-secondary btn-block previous action-button-previous">Previous</button>
            </form>
        </div>
        <!-- Image Section -->
        {{-- <div class="col-md-4 p-4 text-white d-flex flex-column justify-content-center align-items-center"
             style="background: linear-gradient(to right, #006a4e, #00b870, #7ed957);">
            <h2 class="font-weight-bold">Upload Attachments</h2>
            <p class="text-center" style="color: white !important;">Upload the required documents to complete your T Cash Card application.</p>
        </div> --}}
    </div>
</fieldset>
@else

<fieldset id="step3">
    <input type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}" />
    <div class="form-card">
        <div class="row">
            <div class="col-7">
                <h2 class="fs-title">Attachments:</h2>
            </div>
            <div class="col-5">
                <h2 class="steps">Step 3 - 4</h2>
            </div>
        </div>

        <label for="photo"> Profile Photo (White background) <span>* </span> </label>

        <input type="file" name="photo" class=""
        placeholder="Enter place of issue" accept=".png,.jpg,.jpeg" required><br>


        @if (isset($basicInfo) && $basicInfo->cnic_type == 'CNIC')

        <label for="fcnic">   CNIC Front <span>* </span></label>
        <input type="file" name="cnic_front" class=""
        placeholder="Enter place of issue" accept=".png,.jpg,.jpeg"><br>


        <label for="bcnic">CNIC Back <span>* </span></label>

        <input type="file" name="cnic_back" class=""
        placeholder="Enter place of issue" accept=".png,.jpg,.jpeg">

        @endif

        @if (isset($basicInfo) && $basicInfo->cnic_type == 'Bform')

        <label for="bform"> Bform <span>* </span></label>

        <input type="file" name="bform" class=""
        placeholder="Enter place of issue" accept=".png,.jpg,.jpeg">

        @endif



        <label for="stfcertificate" id="student_front" style=""> Student
            Identity Card <span>* </span> </label>
        <input type="file" name="student_id_card" class=""
        placeholder="Enter place of issue" accept=".png,.jpg,.jpeg" required>

        


                                <!-- Navigation Buttons -->
                                <button type="button" name="next" class="btn btn-success btn-block next action-button">Next</button>
                                <button type="button" name="previous" class="btn btn-outline-secondary btn-block previous action-button-previous">Previous</button>
                            </form>
                        </div>
                        <!-- Image Section -->
                        {{-- <div class="col-md-4 p-4 text-white d-flex flex-column justify-content-center align-items-center"
                             style="background: linear-gradient(to right, #006a4e, #00b870, #7ed957);">
                            <h2 class="font-weight-bold">Upload Attachments</h2>
                            <p class="text-center" style=" color: white !important;">Upload the required documents to complete your T Cash Card application.</p> --}}
                            {{-- <img src="{{ asset('images/attachments_icon.png') }}" alt="attachments" class="img-fluid mt-3" style="max-height: 180px;"> --}}
                        {{-- </div> --}}
                    </div>
                </fieldset>
                @endif

                <!-- Step 4: Guidelines -->
                <fieldset id="step4" style="display: none;">
                    <input type="hidden" name="step" id="step" value="4" />

                    <input type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}" />
                    
                    <div class="d-flex flex-wrap" style="min-height: 600px;">
                        <!-- Form -->
                        {{-- <div class="col-md-8 bg-white py-3"> --}}
                            <div class="w-100 bg-white py-3" style="max-width: none; margin: 0 20px;">
                            <div class="text-center mb-4">
                            <h2 class="text-success font-weight-bold">Step 4 - Important Guidelines</h2>
                            </div>
                            <form id="msform4" action="{{ route('opstore.check') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" id="basicInfoId3" name="user_id">

                                <!-- Guidelines -->
                                <div class="form-group">
                                    <p style="line-height: 1.6; font-weight: bold;">
                                        <b>1.</b> The applicant will receive a text message alert on the cell phone indicated in the application to collect the T-Cash card from the BOP branch selected by the applicant.<br>
                                        <b>2.</b> Information submitted in the application cannot be changed.<br>
                                        <b>3.</b> Validity of the T-Cash card for students will be indicated by BOP. However, the card will not be usable in the following instances:<br>
                                        &nbsp;&nbsp;&nbsp;&nbsp;a) On Saturdays and Sundays<br>
                                        &nbsp;&nbsp;&nbsp;&nbsp;b) Summer and winter holidays<br>
                                        &nbsp;&nbsp;&nbsp;&nbsp;c) Public holidays<br>
                                        &nbsp;&nbsp;&nbsp;&nbsp;d) Exit/Graduation from institution as indicated by the relevant organization on PMA portal<br>
                                        &nbsp;&nbsp;&nbsp;&nbsp;e) Change of institute<br>
                                        <b>4.</b> Cards are renewable on submission of a new application on the PMA portal.<br>
                                        <b>5.</b> T-Cash cards for student cards are non-refundable.<br>
                                        <b>6.</b> Committing any of the following actions shall be punishable under PMA Act 2015 with a fine of up to PKR 130/-.<br>
                                        &nbsp;&nbsp;&nbsp;&nbsp;a. If the applicant submits false information in their application.<br>
                                        &nbsp;&nbsp;&nbsp;&nbsp;b. If the applicant submits forged documents with the application.<br>
                                    </p>
                                </div>

                                <!-- Confirmation Checkbox -->
                                
    <div>
        <input type="checkbox" name="confirmation" value="1" required
               />
        <label style="font-weight: bold; line-height: 1.5;">
            I undertake that all of the information in the application is true to the best of my knowledge.
        </label>
    </div>


                                <!-- Navigation Buttons -->
                                <button type="submit" name="submit" class="btn btn-success btn-block action-button">Submit</button>
                                <button type="button" name="previous" class="btn btn-outline-secondary btn-block previous action-button-previous">Previous</button>
                            </form>
                        </div>
                        <!-- Image Section -->
                        {{-- <div class="col-md-4 p-4 text-white d-flex flex-column justify-content-center align-items-center"
                             style="background: linear-gradient(to right, #006a4e, #00b870, #7ed957);">
                            <h2 class="font-weight-bold">Review Guidelines</h2>
                            <p class="text-center" style=" color: white !important;">Please read the guidelines carefully and confirm your agreement to proceed with your T Cash Card application.</p> --}}
                            {{-- <img src="{{ asset('images/guidelines_icon.png') }}" alt="guidelines" class="img-fluid mt-3" style="max-height: 180px;"> --}}
                        {{-- </div> --}}
                    </div>
                </fieldset>
            </div>
        </div>
    </div>
</div>

<!-- Dependencies -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="your-custom-scripts.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/compressorjs@1.1.1/dist/compressor.min.js"></script>


<script>
    
  
  const today = new Date().toISOString().split('T')[0];
  document.getElementById("cnic_expiry").setAttribute('min', today);
</script>
<script>
    $(document).ready(function() {
          $(document).on('click', '.next', function(e) {
            e.preventDefault();

            // Get the current step value
            let currentStep = parseInt($('#step').val());

            console.log("AJAX handler triggered for step", currentStep);


            // Check if step equals 5 to show the loader
            if (currentStep === 3) {
                $('#loadingDiv').show();
            }

            // Create a FormData object to handle file inputs
            let formData = new FormData();

            // Append form data and file inputs to FormData object
            $('#step' + currentStep + ' :input').each(function() {
                if (this.type === 'file' && this.files.length > 0) {
                    formData.append(this.name, this.files[0]);
                } else {
                    formData.append(this.name, $(this).val());
                }
            });

            // Add the current step and CSRF token
            formData.append('step', currentStep);
            formData.append('_token', '{{ csrf_token() }}');
              console.log(formData)
            // Send AJAX request
            $.ajax({
                url: "{{ route('pmaform.opstore') }}",
                type: "POST",
                data: formData,
                processData: false, // Don't process the data
                contentType: false,
                success: function(response) {
                    alert('Step ' + currentStep + ' saved successfully!');
                           $('#basicInfoId'+ currentStep).val(response.data.user_id);
                           console.log(response.data.user_id,currentStep)
                           console.log(response.data)
                    // Move to the next step
                    $('#step').val(currentStep + 1);
                    $('#step' + currentStep).hide();
                    $('#step' + (currentStep + 1)).show();

                    // Hide the loader if it was shown
                    if (currentStep === 3) {
                        $('#loadingDiv').fadeOut(2000, function() {
                            $('#loadingDiv').hide();
                        });
                    }
                },
                error: function(response) {
                    console.log(response.responseText)
                    alert('Error: ' + response.responseText);

                    // Hide the loader in case of error
                    if (currentStep === 3) {
                        $('#loadingDiv').hide();
                    }
                }
            });
        });

        $('.previous').click(function() {
            let currentStep = parseInt($('#step').val());

            // Move to the previous step
            $('#step').val(currentStep - 1);
            $('#step' + currentStep).hide();
            $('#step' + (currentStep - 1)).show();
        });
    });
</script>

<!-- partial -->

<script src='https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js'></script>
<script src='https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js'></script>



<script>
  document.getElementById('district').addEventListener('change', function() {
      var  degreeSelect = document.getElementById('district');
      var  degreeInput = document.getElementById('schoolInput1');
        console.log(degreeSelect);

  });
</script>

<script>
  document.getElementById('dob').addEventListener('change', function () {
    const dob = new Date(this.value);
    const today = new Date();

    let age = today.getFullYear() - dob.getFullYear();
    const m = today.getMonth() - dob.getMonth();

    // Adjust if birthday hasn't occurred yet this year
    if (m < 0 || (m === 0 && today.getDate() < dob.getDate())) {
      age--;
    }

    const errorMsg = document.getElementById('dobError');
    if (age < 8) {
      errorMsg.style.display = 'block';
      this.value = ''; // optional: clear the input
    } else {
      errorMsg.style.display = 'none';
    }
  });
</script>

<script>
    document.getElementById('contact').addEventListener('input', function () {
        var contactInput = this.value;
        var errorMessage = document.getElementById('error-message');

        if (contactInput.length === 11 && /^[1-9][0-9]{10}$/.test(contactInput)) {
            errorMessage.style.display = 'none';
        }
    });
</script>



        {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> --}}

<script>
$(document).ready(function () {
    var city_id = @json($tripInfo->district ?? 0);
    var tehsil = @json($tripInfo->tehsil ?? 0);
    var institute_type = @json($tripInfo->institute_type ?? 0);
    var edu_level = @json($tripInfo->edu_level ?? 0);
    var org_name = @json($tripInfo->org_name ?? 0);

    var tehsil_value = 0;
    var bdistrict_value = 0;
    var mboard_value = 0;

    // Load Tehsils
    $.ajax({
        url: "{{ url('get-bdivisions-by-tehsil') }}",
        type: "POST",
        data: {
            district_id: city_id,
            _token: '{{ csrf_token() }}'
        },
        dataType: 'json',
        success: function (result) {
            $('#tehsil').html('<option value="">Select Tehsil Name</option>');
            $.each(result.tehsils, function (key, value) {
                if (tehsil == value.id) {
                    tehsil_value = value.id;
                    $("#tehsil").append(`<option selected value="${value.id}">${value.tehsil_name}</option>`);
                } else {
                    $("#tehsil").append(`<option value="${value.id}">${value.tehsil_name}</option>`);
                }
            });

            // Load Institute Types
            $.ajax({
                url: "{{ url('get-bdivisions-by-institute') }}",
                type: "POST",
                data: { _token: '{{ csrf_token() }}' },
                dataType: 'json',
                success: function (result) {
                    $('#institute_type').html('<option value="">Select Institute Type</option>');
                    $.each(result.institute_types, function (key, value) {
                        if (institute_type == value.id) {
                            bdistrict_value = value.id;
                            $("#institute_type").append(`<option selected value="${value.id}">${value.name}</option>`);
                        } else {
                            $("#institute_type").append(`<option value="${value.id}">${value.name}</option>`);
                        }
                    });

                    // Load Education Levels
                    $.ajax({
                        url: "{{ url('get-bdivisions-by-edulevel') }}",
                        type: "POST",
                        data: { _token: '{{ csrf_token() }}' },
                        dataType: 'json',
                        success: function (result) {
                            $('#edu_level').html('<option value="">Select Educational Level</option>');
                            $.each(result.edu_levels, function (key, value) {
                                if (edu_level == value.id) {
                                    mboard_value = value.id;
                                    $("#edu_level").append(`<option selected value="${value.id}">${value.name}</option>`);
                                } else {
                                    $("#edu_level").append(`<option value="${value.id}">${value.name}</option>`);
                                }
                            });

                            // Load Organizations

                            console.log({
    tehsil_id: tehsil_value,
    institute_type: bdistrict_value,
    edu_level: mboard_value
});

                            $.ajax({
                                url: "{{ url('get-bdivisions-by-organization') }}",
                                type: "POST",
                                data: {
                                    tehsil_id: tehsil_value,
                                    institute_type: bdistrict_value,
                                    edu_level: mboard_value,
                                    _token: '{{ csrf_token() }}'
                                },
                                dataType: 'json',
                                success: function (result) {
                                    $('#org_name').html('<option value="">Select Organization Name</option>');
                                    $.each(result.organizations, function (key, value) {
                                        if (org_name == value.id) {
                                            $("#org_name").append(`<option selected value="${value.id}">${value.org_name}</option>`);
                                        } else {
                                            $("#org_name").append(`<option value="${value.id}">${value.org_name}</option>`);
                                        }
                                    });
                                }
                            });
                        }
                    });
                }
            });
        }
    });

    // On district change
    $('#district').on('change', function () {
        var city_id = this.value;

        $.ajax({
            url: "{{ url('get-metro-stops-by-district') }}",
            type: "POST",
            data: { district_id: city_id, _token: '{{ csrf_token() }}' },
            dataType: 'json',
            success: function (result) {
                $('#metro_stop').html('<option value="">Select Station</option>');
                $.each(result.stops, function (key, value) {
                    $("#metro_stop").append(`<option value="${value}">${value}</option>`);
                });
            }
        });

        $.ajax({
            url: "{{ url('get-bdivisions-by-tehsil') }}",
            type: "POST",
            data: { district_id: city_id, _token: '{{ csrf_token() }}' },
            dataType: 'json',
            success: function (result) {
                $('#tehsil').html('<option value="">Select Tehsil Name</option>');
                $.each(result.tehsils, function (key, value) {
                    $("#tehsil").append(`<option value="${value.id}">${value.tehsil_name}</option>`);
                });
            }
        });
    });

    // On tehsil change
    $('#tehsil').on('change', function () {
        $.ajax({
            url: "{{ url('get-bdivisions-by-institute') }}",
            type: "POST",
            data: { _token: '{{ csrf_token() }}' },
            dataType: 'json',
            success: function (result) {
                $('#institute_type').html('<option value="">Select Institute Type</option>');
                $.each(result.institute_types, function (key, value) {
                    $("#institute_type").append(`<option value="${value.id}">${value.name}</option>`);
                });
            }
        });
    });

    // On institute type change
    $('#institute_type').on('change', function () {
        $.ajax({
            url: "{{ url('get-bdivisions-by-edulevel') }}",
            type: "POST",
            data: { _token: '{{ csrf_token() }}' },
            dataType: 'json',
            success: function (result) {
                $('#edu_level').html('<option value="">Select Educational Level</option>');
                $.each(result.edu_levels, function (key, value) {
                    $("#edu_level").append(`<option value="${value.id}">${value.name}</option>`);
                });
            }
        });
    });

    //  On edu_level change: Fetch Grades + Organizations
    $('#edu_level').on('change', function () {
        var edu_level_id = this.value;
        var institute_id = $('#institute_type').val();
        var tehsil_id = $('#tehsil').val();

        // Fetch Grades
        $.ajax({
            url: "{{ url('get-grades-by-edu-level') }}",
            type: "POST",
            data: { edu_level_id: edu_level_id, _token: '{{ csrf_token() }}' },
            dataType: 'json',
            success: function (result) {
                $('#grade').html('<option value="">Select Grade</option>');
                $.each(result.grades, function (key, value) {
                    $('#grade').append(`<option value="${value.id}">${value.name}</option>`);
                });
            }
        });

        // Fetch Organizations
        $.ajax({
            url: "{{ url('get-bdivisions-by-organization') }}",
            type: "POST",
            data: {
                tehsil_id: tehsil_id,
                institute_type: institute_id,
                edu_level: edu_level_id,
                _token: '{{ csrf_token() }}'
            },
            dataType: 'json',
            success: function (result) {
                $('#org_name').html('<option value="">Select Organization Name</option>');
                $.each(result.organizations, function (key, value) {
                    $("#org_name").append(`<option value="${value.id}">${value.org_name}</option>`);
                });
            }
        });
    });
});
</script>



</body>
</html>


             


<style>
    .select2-container--default .select2-selection--single {
        background-color: #ececf4; /* Light blue background */
    }
</style>


<script>
$(document).ready(function() {
    var current_fs, next_fs, previous_fs; // fieldsets
    var opacity;
    var current = 1;
    var steps = $("fieldset").length;

    setProgressBar(current);

    // Next button handler
    $(document).on('click', '.next', function(e) {
        e.preventDefault();

        current_fs = $(this).closest('fieldset');
        next_fs = current_fs.next();
        let currentStep = parseInt(current_fs.find('#step').val());
        let isValid = true;

        // Validate required fields
        current_fs.find("input[required], textarea[required], select[required]").each(function() {
            if ($(this).val() === '') {
                isValid = false;
                $(this).addClass('error');
            } else {
                $(this).removeClass('error');
            }
        });

        current_fs.find("input[type=radio][required]").each(function() {
            var name = $(this).attr('name');
            if ($("input[name=" + name + "]:checked").length === 0) {
                isValid = false;
                $("input[name=" + name + "]").addClass('error');
            } else {
                $("input[name=" + name + "]").removeClass('error');
            }
        });

        if (!isValid) {
            alert('Please fill in all required fields');
            return false;
        }

        // Show loader for step 3
        if (currentStep === 3) {
            $('#loadingDiv').show();
        }

        // Create FormData for AJAX
        let formData = new FormData();
        current_fs.find(':input').each(function() {
            if (this.type === 'file' && this.files.length > 0) {
                formData.append(this.name, this.files[0]);
            } else {
                formData.append(this.name, $(this).val());
            }
        });
        formData.append('step', currentStep);
        formData.append('_token', '{{ csrf_token() }}');

        // Send AJAX request
        $.ajax({
            url: "{{ route('pmaform.opstore') }}",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                alert('Step ' + currentStep + ' saved successfully!');
                $('#basicInfoId' + currentStep).val(response.data.user_id);

                // Update progress bar
                $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

                // Smooth transition to next fieldset
                next_fs.show();
                current_fs.animate({opacity: 0}, {
                    step: function(now) {
                        opacity = 1 - now;
                        current_fs.css({'display': 'none', 'position': 'relative'});
                        next_fs.css({'opacity': opacity});
                    },
                    duration: 500,
                    complete: function() {
                        $('#step').val(currentStep + 1);
                        setProgressBar(++current);
                        if (currentStep === 3) {
                            $('#loadingDiv').fadeOut(2000, function() {
                                $('#loadingDiv').hide();
                            });
                        }
                    }
                });
            },
            error: function(response) {
                console.log(response.responseText);
                alert('Error: ' + response.responseText);
                if (currentStep === 3) {
                    $('#loadingDiv').hide();
                }
            }
        });
    });

    // Previous button handler
    $(document).on('click', '.previous', function() {
        current_fs = $(this).closest('fieldset');
        previous_fs = current_fs.prev();
        let currentStep = parseInt(current_fs.find('#step').val());

        // Remove active class from progress bar
        $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

        // Smooth transition to previous fieldset
        previous_fs.show();
        current_fs.animate({opacity: 0}, {
            step: function(now) {
                opacity = 1 - now;
                current_fs.css({'display': 'none', 'position': 'relative'});
                previous_fs.css({'opacity': opacity});
            },
            duration: 500,
            complete: function() {
                $('#step').val(currentStep - 1);
                setProgressBar(--current);
            }
        });
    });

    function setProgressBar(curStep) {
        var percent = parseFloat(100 / steps) * curStep;
        percent = percent.toFixed();
        $(".progress-bar").css("width", percent + "%");
    }
});
</script>


<script>
   document.getElementById('dob').addEventListener('change', function () {
    const dob = new Date(this.value);
    const today = new Date();
    let age = today.getFullYear() - dob.getFullYear();
    const m = today.getMonth() - dob.getMonth();
    if (m < 0 || (m === 0 && today.getDate() < dob.getDate())) {
      age--;
    }

    const guardianFields = document.getElementById('guardianFields');
    const cnicTypeSelect = document.getElementById('cnic_type');

    if (age >= 18) {
      guardianFields.style.display = 'none';
      alert("You are 18 or older. Please select CNIC instead of B-form.");
      cnicTypeSelect.value = "CNIC";
       if (cnicTypeSelect.value === 'CNIC') {
        expiryContainer.style.display = 'block';
        expiryInput.required = true;
      } else {
        expiryContainer.style.display = 'none';
        expiryInput.required = false;
        expiryInput.value = '';
      }
      cnicTypeSelect.dispatchEvent(new Event('change'));
    } else {
      guardianFields.style.display = 'block';
      cnicTypeSelect.value = "Bform";
       if (cnicTypeSelect.value === 'CNIC') {
        expiryContainer.style.display = 'block';
        expiryInput.required = true;
      } else {
        expiryContainer.style.display = 'none';
        expiryInput.required = false;
        expiryInput.value = '';
      }
      cnicTypeSelect.dispatchEvent(new Event('change'));
    }
  });
</script>
<script>
    const cnicTypeSelect = document.querySelector('select[name="cnic_type"]');
    const expiryContainer = document.getElementById('cnicExpiryContainer');
    const expiryInput = document.getElementById('cnic_expiry');

    function toggleExpiryField() {
      if (cnicTypeSelect.value === 'CNIC') {
        expiryContainer.style.display = 'block';
        expiryInput.required = true;
      } else {
        expiryContainer.style.display = 'none';
        expiryInput.required = false;
        expiryInput.value = '';
      }
    }

    // Run once on page load (in case old value is retained)
    toggleExpiryField();

    // Attach change listener
    cnicTypeSelect.addEventListener('change', toggleExpiryField);
  </script>


<script>
    $(document).ready(function() {
        // Capture screen size
        // Optionally, send screen size to the server (if needed)
        $.ajax({
            url: '/storecheck',  // Ensure this URL exists on your backend
            method: 'POST',       // Use POST for CSRF protection
            data: {
                _token: "{{ csrf_token() }}",

                 // Ensure this renders correctly in your template
            },
            success: function(response) {
                console.log(response.message); // Handle the response
            },
            error: function(xhr, status, error) {
                console.error("Error occurred: " + error); // Handle errors
            }
        });
    });
</script>
{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
<script>
// For Male CNIC input
$('#old_cnic').on('change', function() {
  var cnicValue = $(this).val();
  if (cnicValue.length >= 13) {

    fetchBasicInfo(cnicValue);
  } else {
    alert('Please enter a valid f 13-digit CNIC.');
  }
});

// For Female CNIC input
// $('#old_cnic').on('change', function() {
//   var cnicValue = $(this).val();
//   if (cnicValue.length >= 13) {

//     fetchBasicInfo(cnicValue);
//   } else {
//     alert('Please enter a valid m 13-digit CNIC.');
//   }
// });

// Shared AJAX function
function fetchBasicInfo(cnicValue) {
  $.ajax({
    url: '/get-basic-info-by-cnic/' + cnicValue,
    type: 'GET',
    dataType: 'json',
    success: function(response) {

      if (response.success) {
          alert('Record found for this CNIC.');
        $('#old_cnic').val(response.data[0].cnic || '');
        $('#passenger_name').val(response.data[0].passenger_name || '');
        $('#contact').val(response.data[0].contact || '');
        $('#dob').val(response.data[0].dob || '');
        
      } else {
        alert('No record found for this CNIC.');
      }
    },
    error: function(xhr) {
      alert('Error fetching info.');
      console.log(xhr.responseText);
    }
  });
}

</script>
<script>
  // Listen for change event
  document.getElementById('cnic_type').addEventListener('change', function() {
    var selectedType = this.value; // store the selected value
    console.log('Selected Type:', selectedType);

    if (selectedType === 'CNIC') {
      console.log('CNIC option chosen');
      // show CNIC message, hide Bform
      document.getElementById('cnic_front_group').style.display = 'block';
      document.getElementById('cnic_back_group').style.display = 'block';
      document.getElementById('bform_group').style.display = 'none';

    } else if (selectedType === 'Bform') {
      console.log('B-form option chosen');
      // show Bform message, hide CNIC
      document.getElementById('bform_group').style.display = 'block';
    document.getElementById('cnic_front_group').style.display = 'none';
      document.getElementById('cnic_back_group').style.display = 'none';

    } else {
      console.log('Nothing selected');
      // hide both if nothing
       document.getElementById('bform_group').style.display = 'none';
    document.getElementById('cnic_front_group').style.display = 'none';
      document.getElementById('cnic_back_group').style.display = 'none';    }
  });
</script>
@endsection



  