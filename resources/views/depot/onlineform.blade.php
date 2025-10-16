{{-- Dpot form --}}
@extends('depot.master')
@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<style>
@media screen and (max-width: 2000px){
.box{
    margin-left:280px; 
    width:950px;
    margin-top:10px;
    font-size:14px;
    height:550px; 
}
.form-box {
  margin-left:50px;
}


}
@media screen and (max-width: 500px){
  .box{
    margin-left:20px; 
    width:380px;
    margin-top:50px;
    height:600px; 
}
.form-box {
  margin-left:0px;
}
.content h3{
  font-size:25px;
}

}



</style>


    <div class = "box"  style = "padding-left:4%; font-size:14px; padding-top:-10px;">
<form  method="POST" action="{{ route('pmaform.store') }}" enctype="multipart/form-data"
        style = "border:2px solid black;  border-radius:10px; background-color:white;  color: black;  margin-bottom:5px; width">
        @csrf 
        <div class=" form-box col-sm-12" style="">
<div class ="content">
	<h3 style = "text-align:center; margin-top:10px; padding-right:70px;"> <u>Personalized Smart Card Application Form - OLMRTS</u></h3>
</div>

<input type="hidden"  value="Yes" id="verify_form" name="verify_form" >

<div class ="row"
style="border: 2px solid black ; margin-right:10%; border-radius:10px; padding-top:10px; margin-top:30px;">
  
<div class="col-md-4">
      <div id="checkbox">
	  <label><b>*Select the category</b></label><br>
      <div class="form-check form-check-inline" style="margin-left:30px; line-height: 0.5;"> 
      <input  onchange="yesnoCheck2(this);" onclick="onlyOne(this);" class="form-check-input" name="category" type="checkbox" id="category" value="1">
      <label class="form-check-label" for="studentcard">{{ __('Student Card') }}</label><br>
     </div><br>
     <div class="form-check form-check-inline" style="margin-left:30px; line-height: 0.5;"> 
      <input  onchange="yesnoCheck2(this);" onclick="onlyOne(this);" class="form-check-input" name="category" type="checkbox" id="category" value="2">
      <label class="form-check-label" for="senior">{{ __('Senior Citizen Card') }}</label><br>
     </div><br>
     <div class="form-check form-check-inline" style="margin-left:30px; line-height: 0.5;"> 
      <input  onchange="yesnoCheck2(this);" onclick="onlyOne(this);" class="form-check-input" name="category" type="checkbox" id="category" value="3">
      <label class="form-check-label" for="special">{{ __('Special Citizen Card') }}</label><br>
     </div><br>
     <div class="form-check form-check-inline" style="margin-left:30px; line-height: 0.5;"> 
      <input  onchange="yesnoCheck2(this);" onclick="onlyOne(this);" class="form-check-input" name="category" type="checkbox" id="category" value="4">
      <label class="form-check-label" for="women">{{ __('Working Woman') }}</label><br>
     </div><br>
</div>
</div>

      <div class="col-md-4">             
	
	  <div class="form-holder"  id="near_station">
	  <label><b>*Select your near_by station from home</b></label>
	  <select name='near_station' id="near_station"  value="near_station">
								<option value="Select one option" selected>Select one option</option>
        @foreach ($sta as $key => $value)
       <option value="{{ $value->station_name }}">{{ $value->station_name }}</option>
              @endforeach
								</select>  
  
</div>
</div>
</div>
<div class="col-md-12" style="padding-left:0px; margin-top:10px;">             
	
	  <div class="form-holder"  id="pickup_station">
	  <label><b>*Select your preferred station from where you collect card and make payment:</b></label>
	  <select name='pickup_station' id="pickup_station"  value="pickup_station">
								<option value="Select one option" selected>Select one option</option>
        @foreach ($sta as $key => $value)
       <option value="{{ $value->station_name }}">{{ $value->station_name }}</option>
              @endforeach
								</select>  
  
</div>
<div class = ""  >
  {{-- new div starting from daily routes --}}
 <div class="" style="border: 2px solid black ; margin-right:10%; border-radius:10px; padding-top:10px; padding-left:30px;">
<div class = "row" style="padding-left:0px;"><b> Daily Visiting Routes: </b></div>
<div style="color:black; margin-left:30px; line-height:2em; ">
<div> <b> 1. </b>To 
<select name='to_route1' id="to_route1"  value="to_route1">
								<option value="Select one option" selected>Select one option</option>
        @foreach ($sta as $key => $value)
       <option value="{{ $value->station_name }}">{{ $value->station_name }}</option>
              @endforeach
								</select>  
  
From
<select name='from_route1' id="from_route1"  value="from_route1">
								<option value="Select one option" selected>Select one option</option>
        @foreach ($sta as $key => $value)
       <option value="{{ $value->station_name }}">{{ $value->station_name }}</option>
              @endforeach
								</select>  
  
</div>

<div> <b> 2. </b>To 
<select name='to_route2' id="to_route2"  value="to_route2">
								<option value="Select one option" selected>Select one option</option>
        @foreach ($sta as $key => $value)
       <option value="{{ $value->station_name }}">{{ $value->station_name }}</option>
              @endforeach
								</select>  
  
From
<select name='from_route2' id="from_route2"  value="from_route2">
								<option value="Select one option" selected>Select one option</option>
        @foreach ($sta as $key => $value)
       <option value="{{ $value->station_name }}">{{ $value->station_name }}</option>
              @endforeach
								</select>  
  
</div>

<div> <b> 3. </b>To 
<select name='to_route3' id="to_route3"  value="to_route3">
								<option value="Select one option" selected>Select one option</option>
        @foreach ($sta as $key => $value)
       <option value="{{ $value->station_name }}">{{ $value->station_name }}</option>
              @endforeach
								</select>  
  
From
<select name='from_route3' id="from_route3"  value="from_route3">
								<option value="Select one option" selected>Select one option</option>
        @foreach ($sta as $key => $value)
       <option value="{{ $value->station_name }}">{{ $value->station_name }}</option>
              @endforeach
								</select>  
  
</div>

</div>

<div class = "col-md-8" style="padding-left:0px;"><b> Form ID: </b>
<input type = "text" id="form_id" name="form_id" style= "border: none; border-color: transparent; border-bottom: 1px solid black; margin-left:100px; "></div>  
               <div class="row">
                                <div class="col-md-3"><b> Name on card: </b> in Block/Capital letters</div>
                                  
					<input type="text" name="customer1" pattern="[A-Z]{1}" style="width: 25px; height:30px;"><input type="text" name="customer2" pattern="[A-Z]{1}" style="width: 25px; height:30px;"><input type="text" name="customer3" pattern="[A-Z]{1}" style="width: 25px; height:30px;"><input type="text" name="customer4" pattern="[A-Z]{1}" style="width: 25px; height:30px;"><input type="text" name="customer5" pattern="[A-Z]{1}" style="width: 25px; height:30px;"><input type="text" name="customer6" pattern="[A-Z]{1}" style="width: 25px; height:30px;"><input type="text" name="customer7" pattern="[A-Z]{1}" style="width: 25px; height:30px;"><input type="text" name="customer8" pattern="[A-Z]{1}" style="width: 25px; height:30px;"><input type="text" name="customer9" pattern="[A-Z]{1}" style="width: 25px; height:30px;"><input type="text" name="customer10" pattern="[A-Z]{1}" style="width: 25px; height:30px;"><input type="text" name="customer11" pattern="[A-Z]{1}" style="width: 25px; height:30px;"><input type="text" name="customer12" pattern="[A-Z]{1}" style="width: 25px; height:30px;"><input type="text" name="customer13" pattern="[A-Z]{1}" style="width: 25px; height:30px;"><input type="text" name="customer14" pattern="[A-Z]{1}" style="width: 25px; height:30px;"><input type="text" name="customer15" pattern="[A-Z]{1}" style="width: 25px; height:30px;"><input type="text" name="customer16" pattern="[A-Z]{1}" style="width: 25px; height:30px;"><input type="text" name="customer17" pattern="[A-Z]{1}" style="width: 25px; height:30px;"><input type="text" name="customer18" pattern="[A-Z]{1}" style="width: 25px; height:30px;"><input type="text" name="customer19" pattern="[A-Z]{1}" style="width: 25px; height:30px;"><input type="text" name="customer20" pattern="[A-Z]{1}" style="width: 25px; height:30px;">
				
                
    </div>

    </div>
<div class = "row">



<div class = "col-md-3"><b> Passenger Name: </b></div>
<input type = "text" pattern="[A-Za-z]{3,15}" value="" id="name" name="name" style= "border: none; border-color: transparent; border-bottom: 1px solid black;">   

<div class = "col-md-2">
 <b>CNIC:</b></div>
 <input type = "text" pattern="[0-9+]{5}-[0-9+]{7}-[0-9]{1}$"  id="cnic" name="cnic" style= "border: none; border-color: transparent; border-bottom: 1px solid black;">
</div>


<div class = "row">

<div class = "col-md-3">
 <b>Date of Birth:</b></div>
 <input type = "date" id="dob" name="dob" value="" onchange="myFunction()" style= "border: none; border-color: transparent; border-bottom: 1px solid black;  width:170px;">



<div class = "col-md-2"><b> CNIC Expiry Date: </b></div>
<input type = "date" value="" id="cnic_expiry_date" name="cnic_expiry_date" style= "border: none; border-color: transparent; border-bottom: 1px solid black; width:170px;">

&nbsp&nbsp&nbsp&nbsp&nbsp
<div id="life" style = "display:none;" >
<input   class="form-check-input" name="cnic_expiry_date" type="checkbox" id="cnic_expiry_date" value="LifeTime" >
      <label class="form-check-label" for="cnic_expiry_date">{{ __('Life Time') }}</label>
</div>



</div>

<div class = "row">

<div class = "col-md-3" ><b>
<label for="gender" > Select your Gender: </b></label></div>
<select name="gender" style="width:170px; margin-top:5px;">
	<option value="none">Gender</option>
	<option value="male">Male</option>
	<option value="female">Female</option>
	<option value="Transgender">Transgender</option>
</select>

<div class = "col-md-2">
 <b>Contact :</b></div>
 <input type = "phonenumber" id="phone_number" name="phone_number"  pattern="[0-9]{11}" style= "border: none; border-color: transparent; border-bottom: 1px solid black;">
</div>

<div class = "row">
<div class = "col-sm-3">
    <b>Institute/Organization Name:</b></div>
    <input type = "text" id="org_name" name="org_name" style= "border: none; border-color: transparent; border-bottom: 1px solid black; width:406px;">  
</div>
<div class = "row">
<div class = "col-sm-3">
    <b>Full Address:</b></div>
    <input type = "text" id="faddress" name="faddress" style= "border: none; border-color: transparent; border-bottom: 1px solid black; width:406px;">  
</div>

<b> *Check List</b><br>


  <div class="row" style = "margin-left:20px; margin-top:5px; margin-bottom:5px;" >
   <div class = "" id ="reg" name = "reg" style = "display:none">
      <b>Registration</b> &nbsp;
      
    <b>PCRDP</b>
</div>
    <div class="col-md-2">   
 <select class="form-control" id="regdt" name="regdt" style = "display:none">
<option value="">Select</option>
  @foreach (App\Models\Regdt::all() as $key => $value)
<option value="{{ $value->name }}">{{ $value->name }}</option>
                                @endforeach
                                </select>
                                </div>  
  <div class="col-md-2"> 

<select class="form-control" id="regd" name="regd" style = "display:none">
</select>
  </div> 
  <div class="col-md-2">
<select class="form-control" id="regb" name="regb" style = "display:none">
</select>  </div> <p style = "display:none" id = "pb" name = "pb">-PB-</p>
   <div class="col-md-2"> 
  <input type="number" placeholder="Reg num"  class="form-control" id="pcrdp" name="pcrdp" style = "display:none">  </div> 
</div>

<div class = "checkbox" style="margin-left:30px; line-height: 1; "> 
<label for="dcertificate" id="disability" style = "display:none;"> 	* Disability Certificate 	</label>
  <input type="file" id="disability_certificate" name="disability_certificate" accept="image/*" style = "margin-left:142px; display:none;"><br>

  <label for="photo"> * Photo 	(white background) </label>
  <input type="file" id="photo" name="photo"  style = "margin-left:103px;"><br>

  <label for="fcnic"> 	* CNIC Front	</label>
  <input type="file" id="cnic_front" name="cnic_front" accept="image/*" style = " margin-left:196px;"><br>

  <label for="bcnic"> 	* CNIC Back	</label>
  <input type="file" id="cnic_back" name="cnic_back" accept="image/*" style = " margin-left:200px;"><br>

  <label for="stfcertificate" id="student_front"  style = "display:none;"> * Student Identity Card Front	</label>
  <input type="file" id="student_id_card_front" name="student_id_card_front" accept="image/*" style = "margin-left:95px;display:none;"><br>

  <label for="stbcertificate" id="student_back" style = "display:none;"> 	* Student Identity Card Back	</label>
  <input type="file" id="student_id_card_back" name="student_id_card_back" accept="image/*" style = "margin-left:100px;display:none;"><br>

  <label for="saffidavite" id="saffidavite" style = "display:none;"> 	* Upload Student Certificate	</label>
  <input type="file" id="student_affidavite" name="student_affidavite" accept="image/*" style = "margin-left:100px;display:none;"><br>


  <label for="empaff" id="empaff" style = "display:none;"> 	* Upload Employment Certificate	</label>
  <input type="file" id="empolyee_affidavite" name="empolyee_affidavite" accept="image/*" style = "margin-left:70px;display:none;"><br>

  <label for="emcertificate" id="empolyee" style = "display:none;"> 	* Employment Card </label>
  <input type="file" id="empolyee_card" name="empolyee_card" accept="image/*" style = "margin-left:153px;display:none;"><br>


</div>
</div> 

{{-- end of daily route div border --}}


{{-- <div class="" style="border: 2px solid black; padding:7px; margin-bottom:6px; margin-top:6px; border-radius:20px"> --}}
  <div class="" style="border: 2px solid black ; margin-right:10%; border-radius:10px; padding-top:10px; padding-left:30px; margin-top:20px;">
<b> <u>Terms and Conditions:</b></u><br>
<p style="">
  * A message alert will be sent for the collection of card from the selected station.<br>
  * The card will not be issued to passenger without  submission of application. <br>
  * Validity for Students and Working Women cards is one (01) year or till the validity of the tenure whichever is earlier.
    Cards are renewable upon request.<br>
  * Personalized cards are non-refundable.<br>
  * Committing any of the following shall be Punishable under<br>
  &nbsp; &nbsp;PMA Act.2015 with the fine upto Rs/500<br>
  &nbsp;  &nbsp;  &nbsp;  No 1. If applicant submits false information in his/her application.<br>
  &nbsp;  &nbsp;  &nbsp;  No 2. If applicant submits forged document with the application.<br>                                    
  * Once issued , cards can only be collected at the ticketing window of the preferred station.<br>
  <br>
  &nbsp;<input type="checkbox" value="1" name="t_c" id="t_c" checked>
  <label for="">   I underatake that all of the information in the application is true to best of my knowledge and i accept </label><br>
  &nbsp;  &nbsp; all of the above mentioned Terms and Conditions 
</p><br>
</div>
</div>
<button type="submit" class="btn btn-dark" style = "margin-left:80%; margin-bottom:5%; margin-top:20px;">Submit</button>
</div>



</div>
</div>
</form>
<script>

  // stations
//   function onlyOne(checkbox) {
//     var checkboxes = document.getElementsByName('station')
//     checkboxes.forEach((item) => {
//         if (item !== checkbox) item.checked = false
//     })
// }

// function yesnoCheck1(that) {

// if (that.value == "2") {

// 	document.getElementById("station_name").style.display = "block";

// } else {

// 	document.getElementById("station_name").style.display = "none";	

// }

// }

// category

function onlyOne(checkbox) {
    var checkboxes = document.getElementsByName('category')
    checkboxes.forEach((item) => {
        if (item !== checkbox) item.checked = false
    })
}


function yesnoCheck2(that) {

if (that.value == "1") {

	document.getElementById("student_id_card_front").style.display = "inline-block";
  document.getElementById("student_front").style.display = "inline-block";
  document.getElementById("student_id_card_back").style.display = "inline-block";
  document.getElementById("student_back").style.display = "inline-block";
  document.getElementById("student_affidavite").style.display = "inline-block";
  document.getElementById("saffidavite").style.display = "inline-block";

  
  document.getElementById("disability_certificate").style.display = "none";
  document.getElementById("disability").style.display = "none";
  document.getElementById("empolyee_card").style.display = "none";
  document.getElementById("empolyee").style.display = "none";
  document.getElementById("empaff").style.display = "none";
  document.getElementById("empolyee_affidavite").style.display = "none";
  document.getElementById("regb").style.display = "none";
  document.getElementById("regd").style.display = "none";
  document.getElementById("regdt").style.display = "none";
  document.getElementById("pcrdp").style.display = "none";
  document.getElementById("reg").style.display = "none";
  document.getElementById("pb").style.display = "none";

} else if (that.value == "3") {

//alert("check");

	document.getElementById("disability_certificate").style.display = "inline-block";
  document.getElementById("disability").style.display = "inline-block";
  document.getElementById("regb").style.display = "inline-block";
  document.getElementById("regd").style.display = "inline-block";
  document.getElementById("regdt").style.display = "inline-block";
  document.getElementById("pcrdp").style.display = "inline-block";
  document.getElementById("reg").style.display = "inline-block";
  document.getElementById("pb").style.display = "inline-block";


  document.getElementById("empolyee_card").style.display = "none";
  document.getElementById("empolyee").style.display = "none";
  document.getElementById("student_id_card_front").style.display = "none";
  document.getElementById("student_front").style.display = "none";
  document.getElementById("student_id_card_back").style.display = "none";
  document.getElementById("student_back").style.display = "none";
  document.getElementById("student_affidavite").style.display = "none";
  document.getElementById("saffidavite").style.display = "none";
  document.getElementById("empaff").style.display = "none";
  document.getElementById("empolyee_affidavite").style.display = "none";

}
else if (that.value == "2"){
  document.getElementById("photo").style.display = "inline-block";
  document.getElementById("cnic_front").style.display = "inline-block";
  document.getElementById("cnic_back").style.display = "inline-block";

  document.getElementById("student_id_card_front").style.display = "none";
  document.getElementById("student_front").style.display = "none";
  document.getElementById("student_id_card_back").style.display = "none";
  document.getElementById("student_back").style.display = "none";
  document.getElementById("disability_certificate").style.display = "none";
  document.getElementById("disability").style.display = "none";
  document.getElementById("empolyee_card").style.display = "none";
  document.getElementById("empolyee").style.display = "none";
  document.getElementById("student_affidavite").style.display = "none";
  document.getElementById("saffidavite").style.display = "none";
  document.getElementById("empaff").style.display = "none";
  document.getElementById("empolyee_affidavite").style.display = "none";
  document.getElementById("regb").style.display = "none";
  document.getElementById("regd").style.display = "none";
  document.getElementById("regdt").style.display = "none";
  document.getElementById("pcrdp").style.display = "none";
  document.getElementById("reg").style.display = "none";
  document.getElementById("pb").style.display = "none";
}



else if (that.value == "4") {

//alert("check");

	document.getElementById("empolyee_card").style.display = "inline-block";
  document.getElementById("empolyee").style.display = "inline-block";
  document.getElementById("empaff").style.display = "inline-block";
  document.getElementById("empolyee_affidavite").style.display = "inline-block";

  document.getElementById("student_id_card_front").style.display = "none";
  document.getElementById("student_front").style.display = "none";
  document.getElementById("student_id_card_back").style.display = "none";
  document.getElementById("student_back").style.display = "none";
  document.getElementById("disability_certificate").style.display = "none";
  document.getElementById("disability").style.display = "none";
  document.getElementById("student_affidavite").style.display = "none";
  document.getElementById("saffidavite").style.display = "none";
  document.getElementById("regb").style.display = "none";
  document.getElementById("regd").style.display = "none";
  document.getElementById("regdt").style.display = "none";
  document.getElementById("pcrdp").style.display = "none";
  document.getElementById("reg").style.display = "none";
  document.getElementById("pb").style.display = "none";

}
else{
  document.getElementById("photo").style.display = "inline-block";
  document.getElementById("cnic_front").style.display = "inline-block";
  document.getElementById("cnic_back").style.display = "inline-block";

}

}

</script>

<script type="text/javascript"> 
function yesnoCheck2(that) {
 var ca = that.value;
 console.log(ca)
}
function myFunction() {
  var dob1 = document.getElementById("dob").value;
  console.log(dob1);
  var dob = new Date(dob1);  

    //calculate month difference from current date in time  
    var month_diff = Date.now() - dob.getTime();  
      
    //convert the calculated difference in date format  
    var age_dt = new Date(month_diff);   
      
    //extract year from date      
    var year = age_dt.getUTCFullYear();  
      
    //now calculate the age of the user  
    var age = Math.abs(year - 1970);  
      console.log(age)
    //display the calculated age  
    if(age>= 60) 
    {
      document.getElementById("life").style.display = "inline-block";
    }
else {

  window.alert("YOU ARE NOT ELIGILBLE!");

}
}
</script>  

<script>
  $(document).ready(function() {
  $('#regdt').on('change', function() {
  var regdt_id = this.value;
  $("#regd").html('');
  $.ajax({
  url:"{{url('Regd-b')}}",
  type: "POST",
  data: {
    regdt_id: regdt_id,
  _token: '{{csrf_token()}}'
  },
  dataType : 'json',
  success: function(result){
  $('#regd').html('<option value="">Select District</option>');
  $.each(result.regds,function(key,value){
  $("#regd").append('<option value="'+value.name+'">'+value.name+'</option>');
  });
  $('#regb').html('<option value="">Select District First</option>');
  }
  });
  });
  $('#regd').on('change', function() {
  var regd_id = this.value;
  $("#regb").html('');
  $.ajax({
  url:"{{url('Regb')}}",
  type: "POST",
  data: {
  regd_id: regd_id,
  _token: '{{csrf_token()}}'
  },
  dataType : 'json',
  success: function(result){
  $('#regb').html('<option value="">Select Medical Board</option>');
  $.each(result.regbs,function(key,value){
  $("#regb").append('<option value="'+value.name+'">'+value.name+'</option>');
  });
  }
  });
  });
  });
  </script>


@endsection