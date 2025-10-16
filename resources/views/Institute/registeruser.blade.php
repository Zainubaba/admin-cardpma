
@extends('design_main.minimal')

@section('content')

<style>

    /* @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap'); */

    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">

    body{
        font-family: 'Inter', sans-serif;
        overflow-x: hidden;
    }
    h1{
        /* font-family: 'Montserrat', sans-serif; */
    
    }

        label {
            font-size: 16px;
            font-weight: 800;
            color:#5d6164;
            /* margin-bottom: -10px;
            margin-top: -10px; */
        }

        input {
            margin-bottom: -15px;
            margin-top: -5px;
            background-color:#ccd4dc;
        }
        .navbar-brand span{
            font-weight: 900;
            font-size: 30px;
        }

            .bg-light{
                    height: 700px; margin-top:-50px; border-radius: 37px;
            }
        @media screen and (max-width: 991px) {

            .navbar-brand span{
                font-size: 22px;
                margin: 20px;
                padding: 0px;
            }
            .navbar-brand p{
                font-size: 20px;
                margin: 0px;
                padding: 0px;
            }
            .nav-item{
                margin-top: 40px;
            }

        }
        @media screen and (max-width: 480px) and (min-width: 0px) {
            .imgback{
                background: none;
            }
            .nav-item{
                margin-top: 60px;
            }
            .navbar-brand span{
                font-size: 18px;
                margin: 0px;
                padding: 0px;
            }
            .navbar-brand p{
                font-size: 16px;
                margin: 0px;
                padding: 0px;
            }
        }
        @media screen and (max-width:768px){
            .navbar-expand {

            }
        }
@media screen and (max-width:1024px){
    .imgback{
        margin-left: -100px;;
    }
}

        @media screen and (max-width: 800px) {
            .imgback{
                display: none;
            }
        }

    </style>



<body>
    
    @if (session('success'))
    <div class="alert alert-success" style="color:black">
        {{ session('success') }}
    </div>
    @endif

            <div class="d-flex justify-content-center align-items-center " style="min-height: 100vh;margin-top:150px">

                         <div class="col-md-6 col-sm-12 bg-light " style="">

                        <h1
                            style="text-align: center; font-weight: 700; font-size: 34px; color:rgb(68, 68, 68); margin-top:0px;">
                            Register Institute</h1>
                            @if ($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul class="mt-2 list-disc list-inside">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
                        <form method="POST" action="{{ route('Institute.storeuser') }}">
                            @csrf

                        <div class="row mt-4">

                            <div class="form-group col-md-6 pr-5 mt-3">
                                <label for="name">{{ __('Focal Person Name') }}</label>
                                <input id="name" type="text"
                                    class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                    pattern="[a-zA-Z\s]+" name="name" required style = "background-color:#ececf4;"
                                    >
                            </div>

                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif

                              <div class="form-group col-md-6 mt-3">
                                <label for="contactnumber">{{ __('Contact Number') }}</label>
                                <input id="phone_number" type="number"
                                    class="form-control{{ $errors->has('phone_number') ? ' is-invalid' : '' }}"
                                    name="phone_number" required pattern="[0-9]{13}"  min="00000000000" max="99999999999"  oninput="checkPhoneLength(this)" maxlength="11"
                                    placeholder="Start from 0"
                                    style=" background-color:#ececf4">
                            </div>
                            @if ($errors->has('phone_number'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('phone_number') }}</strong>
                                </span>
                            @endif

                            </div>


                        <div class="row">

                            <div class="form-group col-md-6 pr-5 mt-3">
                                <label for="cnic">{{ __('CNIC') }}</label>
                                <input id="cnic" type="number"
                                    class="form-control{{ $errors->has('cnic') ? ' is-invalid' : '' }}"
                                    name="cnic" min="1000000000000" max="9999999999999"  oninput="checkLength(this);" maxlength="13" required placeholder="Without dashes"
                                    style=" background-color: #ececf4;">
                            </div>
                            @if ($errors->has('cnic'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('cnic') }}</strong>
                                </span>
                            @endif

                              <div class="form-group col-md-6 mt-3">
                                <label for="">{{ __('E-mail') }}</label>
                                <input id="email" type="email"
                                    class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                    name="email" required
                                    style=" background-color:#ececf4">
                            </div>
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                            </div>
                        

                        <div class="row">

                            <div class="form-group col-md-6 pr-5 mt-3">
                                <label for="district">{{ __('District') }}</label>

                                  <select class="form-control" id="district" name="district" required="required" style="background-color:#ececf4">
                                      <option style=" background-color:#ececf4" value="">Select District First</option>
                                      @foreach (App\Models\District::all() as $key => $value)
                                      <option value="{{ $value->id }}">{{ $value->name }}</option>
                                      @endforeach
                                    </select>
                            </div>

                                {{-- <div class="form-group col-md-6 mt-3">
                                <label for="tehsil">{{ __('Tehsil') }}</label>

                            <select class="form-control" id="tehsil" name="tehsil" required="required" style="background-color:#ececf4"></select>

                            </div>
                        </div> --}}
                        
                            <div class="form-group col-md-6 mt-3">
                                <label for="institute_type">{{ __('Select Institute Type:') }}</label>

                                <select class="form-control" id="institute_type" name="institute_type" style="background-color:#ececf4"></select>

                            </div>
                            </div>

                        <div class="row">


                                <div class="form-group col-md-6 pr-5 mt-3 ">
                                <label for="edu_level">{{ __('Select Educational Level:') }}</label>

                                    <select class="form-control" id="edu_level" name="edu_level[]" multiple  style="background-color:#ececf4">
                            </select>
                            </div>
                        


                        

                            <div class="form-group col-md-6 mt-3">
                                <label for="hod_id">{{ __('Select Head of Department:') }}</label>

                         <select class="form-control" id="hod_id" name="hod_id" required="required" style="background-color:#ececf4">
                                      <option style=" background-color:#ececf4" value="">Select  Head of Department</option>
                                      @foreach ($hods as $hod)
                                      <option value="{{ $hod->id }}">{{ $hod->name }}</option>
                                      @endforeach
                                    </select>
                            </div>
                            </div>


                            <input type="hidden" name="hod_id" value="8">

                            

                             {{-- <div class="form-group col-md-6 pr-5 mt-3">

                                <label for="emis">{{ __('Enter EMIS Code:') }}</label>

                                    <input id="emis" class="form-control" name="emis" required placeholder="Enter EMIS Code" style=" background-color:#ececf4">
                            </div> --}}


                        


                            {{-- <div class="form-group">

                                <label for="org_name">{{ __('Enter Institute/Organization Name:') }}</label>

                                    <input id="org_name" class="form-control" name="org_name" required placeholder="Enter Institute/Organization Name" style=" background-color:#ececf4">
                            </div> --}}

                        {{-- <div class="form-group">
                               
                            <label for="org_name">{{ __('Select Institute/Organization Name:') }}</label>
                                 <select id="org_name" name="org_name" class="form-control" required style="background-color:#ececf4">
                                   <option value="">Select Organization Name</option>
                                   <option value="other">Other</option>
                                     </select>
                                       </div>

                                       <div class="form-group" id="other_org_container" style="display: none;">
    <label for="org_name">Enter Organization Name:</label>
    <input type="text" id="other_org_name" name="org_name" class="form-control" placeholder="Enter organization name" style="background-color:#ececf4">
</div> --}}

 <div class="row">
                        <div class="form-group col-md-6 mt-3">
                               
                            <label for="org_name">{{ __('Select Institute/Organization Name:') }}</label>
                                 <select id="org_name" name="org_name" class="form-control" required style="background-color:#ececf4">
                                   <option value="">Select Organization Name</option>
                                   {{-- <option value="other">Other</option> --}}
                                     </select>
                                       </div>

                                       

                                       <div class="form-group col-md-6 mt-3" id="other_org_container" style="display: none;">
    <label for="org_name">Enter Organization Name:</label>
    <input type="text" id="other_org_name" name="other_org_name" class="form-control" placeholder="Enter organization name" style="background-color:#ececf4">
</div>

<script>
    document.getElementById('org_name').addEventListener('change', function () {
        let otherContainer = document.getElementById('other_org_container');
        if (this.value === 'other') {
            otherContainer.style.display = 'block';
            document.getElementById('other_org_name').required = true;
        } else {
            otherContainer.style.display = 'none';
            document.getElementById('other_org_name').required = false;
        }
    });
</script>

<div class="form-group col-md-6 mt-3">
<label for="district">{{ __('Tehsil') }}</label>
<select id="tehsil" name="tehsil" class="form-control" required style="background-color:#ececf4">
    <option value="">Select Tehsil</option>
</select>
</div>
</div>


                    <div class="row">

                         <div class="form-group col-md-6 pr-5 mt-3">
                                <label for="">{{ __('Password') }}</label>
                                <input id="password" type="password"
                                    class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                    name="password" required placeholder="Alphanumeric minimum 8 characters"
                                    style=" background-color:#ececf4">
                            </div>
                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif

                            <div class="form-group col-md-6 mt-3">
                                <label for="password-confirm">{{ __('Confirm Password') }}</label>


                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" required
                                    style=" background-color:#ececf4">

                            </div>
                        


                            <input type="hidden" value="2" id="role" name="role"
                                style="text-align:center;">
     <div class="container">
    <div class="row mt-4">
        <div class="col-12 d-flex justify-content-center">
            <button type="submit"
                class="btn mt-3 mb-4"
                style="color:white; border-radius:10px; background-color:#029221; width:460px; height:50px;">
                <b>REGISTER</b>
            </button>
        </div>
    </div>
</div>



                    </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>

<script>
    function checkPhoneLength(input) {
      if (input.value.length > 11) {
        input.value = input.value.slice(0, 11); // Restrict to 13 digits
      }
    }

    function checkLength(input) {
    if (input.value.length > 13) {
      input.value = input.value.slice(0, 13); // Restrict to 13 digits
    }
  }
  </script>
  <script>
    document.getElementById('org_name').addEventListener('change', function () {
        let otherContainer = document.getElementById('other_org_container');
        if (this.value === 'other') {
            otherContainer.style.display = 'block';
            document.getElementById('other_org_name').required = true;
        } else {
            otherContainer.style.display = 'none';
            document.getElementById('other_org_name').required = false;
        }
    });
</script>

</body>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

          <script>
$(document).ready(function() {
    // Load tehsils on page load
    $.ajax({
        url: "{{ url('get-all-tehsils') }}",
        type: "GET",
        dataType: 'json',
        success: function(result) {
            console.log("Tehsils returned:", result);
            $('#tehsil').html('<option value="">Select Tehsil</option>');
            $.each(result.tehsils, function(key, value) {
                $("#tehsil").append('<option value="' + value.id + '">' + value.name + '</option>');
            });
        },
        error: function(xhr, status, error) {
            console.error("Error loading tehsils:", error);
        }
    });
});
</script>

<script>


                    $('#district').on('change', function() {

                    var city_id = this.value;

                    console.log(city_id)

                    $.ajax({

                        url: "{{ url('get-bdivisions-by-institute') }}",

                        type: "POST",

                        data: {

                            district_id : city_id,

                            _token: '{{ csrf_token() }}'

                        },

                        dataType: 'json',

                        success: function(result) {

                            console.log(result.institute_types)


                            $('#institute_type').html('<option value="">Select Institute Type</option>');

                             $.each(result.institute_types, function(key, value) {

                                 $("#institute_type").append('<option value="' + value.id + '">' +

                                    value.name + '</option>');


                            });

                        }

                    });

                    // The new function 

                    $.ajax({
        url: "{{ url('get-institutes-by-district') }}",
        type: "POST",
        data: {
            district_id: city_id,
            _token: '{{ csrf_token() }}'
        },
        dataType: 'json',
        success: function (result) {
            console.log("Institutes returned:", result);
            $('#org_name').html('<option value="">Select Organization Name</option>');
            $("#org_name").append('<option value="other">Other</option>');
            $.each(result.institutes, function (key, value) {
                $("#org_name").append('<option value="' + value.id + '">' + value.org_name + '</option>');
            });
            
        }
    });
});

                    // });

                    // $('#tehsil').on('change', function() {

                    // var tehsil = this.value;

                    // console.log('tehsil', tehsil)

                    // $.ajax({

                    //     url: "{{ url('get-bdivisions-by-institute') }}",

                    //     type: "POST",

                    //     data: {

                    //         _token: '{{ csrf_token() }}'

                    //     },

                    //     dataType: 'json',

                    //     success: function(result) {

                    //         $('#institute_type').html('<option value="">Select Institute Type</option>');

                    //         $.each(result.institute_types, function(key, value) {

                    //             $("#institute_type").append('<option value="' + value.id + '">' +

                    //                 value.name + '</option>');

                    //         });

                    //     }

                    // });

                    // });




                $('#institute_type').on('change', function() {

                var institute_type = this.value;

                console.log('institute_type', institute_type);

                $.ajax({

                    url: "{{ url('get-bdivisions-by-edulevel') }}",

                    type: "POST",

                    data: {
                        institute_type: institute_type,

                        _token: '{{ csrf_token() }}'

                    },

                    dataType: 'json',

                    success: function(result) {

                        $('#edu_level').html('<option value="">Select Educational Level</option>');

                        $.each(result.edu_levels, function(key, value) {

                            $("#edu_level").append('<option value="' + value.id + '">' +

                                value.name + '</option>');

                        });

                    }

                });

                });

                // $('#edu_level').on('change', function() {

                //     var edu_level = this.value;

                //       const instituteTypeSelect = document.getElementById('institute_type');
                //         const institute_id = instituteTypeSelect.value;

                    // const tehsilSelect = document.getElementById('tehsil');     keep these two lines always commented out
                        // const tehsil_id = tehsilSelect.value;



                //     console.log('Edu_level :', institute_id, edu_level)


                //     $.ajax({

                //         url: "{{ url('get-bdivisions-by-organization') }}",

                //         type: "POST",

                //         data: {

                //             // tehsil_id : tehsil_id,
                //             district_id: $('#district').val(),
                //             institute_type : institute_id,
                //             edu_level : edu_level,
                //             _token: '{{ csrf_token() }}'

                //         },

                //         dataType: 'json',

                //         success: function(result) {


                //             $('#org_name').html('<option value="">Select Organization Name</option>');

                //             $.each(result.organizations, function(key, value) {

                //              console.log(result.organizations)

                //                 $("#org_name").append('<option value="' + value.id + '">' +

                //                     value.org_name + '</option>');

                //             });
                //           $("#org_name").append('<option value="other">Other</option>');  

                //         }
                        

                //     });
                    

                // });



    </script>

@endsection
