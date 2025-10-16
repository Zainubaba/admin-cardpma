@extends('afc_dashboard.master')
@section('content')



    <div  style = "padding-left:0%; font-size:14px;">
<form  method="POST" action="{{ route('pmaform.store') }}" enctype="multipart/form-data"
        style = "border:1px solid black; margin-left:280px; border-radius:30px; background-color:white;  color: #7d0000; width:950px; height:630px; margin-top:10px; margin-bottom:5px;">
        @csrf 
        <div class="col-sm-12" style="margin-left:50px;">
<div class ="content">
	<h3 style = "text-align:center;"> <u>Personalized Smart Card Application Form - OLMRTS </u></h3>
</div>

<div class ="row">
<div class="col-md-6">
      <div id="checkbox"  >
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

      <div class="col-md-6">
      <div id="checkbox">
	  <label><b>*Select Card Pick-up Options:</b></label><br>
      <div class="form-check form-check-inline" style="margin-left:30px; line-height: 0.5;"> 
      <input  onchange="yesnoCheck1(this);" onclick="onlyOne(this);" class="form-check-input" name="station" type="checkbox" id="station" value="1">
      <label class="form-check-label" for="delivery">{{ __('Home Delivery') }}</label><br>
     </div><br>
	  <div class="form-check form-check-inline" style="margin-left:30px; line-height: 0.5;">
	 <input  onchange="yesnoCheck1(this);"onclick="onlyOne(this);" class="form-check-input" name="station" type="checkbox" id="station" value="2">
     <label class="form-check-label"for="station">{{ __('Pick-up From Station') }}</label>
     </div> 

      </div>               
	
	  <div class="form-holder"  id="station_name" style="display:none;">
	  <label><b>*Select your near_by station</b></label>
	  <select name='station_name' id="station_name"  value="station_name">
								<option value="Select one option" selected>Select one option</option>
        @foreach ($station as $key => $value)
       <option value="{{ $value->station_name }}">{{ $value->station_name }}</option>
              @endforeach
								</select>  
  
</div>
</div>
</div>
<div class = "">
<div class = "row">

<div class = "col-md-3"><b> Passenger Name: </b></div>
<input type = "text" id="name" name="name" style= "border: none; border-color: transparent; border-bottom: 1px solid black;">   

<div class = "col-md-2">
 <b>CNIC:</b></div>
 <input type = "number" id="cnic" name="cnic" style= "border: none; border-color: transparent; border-bottom: 1px solid black;">
</div>


<div class = "row">

<div class = "col-md-3"><b> CNIC Expiry Date: </b></div>
<input type = "date" id="cnic_expiry_date" name="cnic_expiry_date" style= "border: none; border-color: transparent; border-bottom: 1px solid black;width:170px;">    
<div class = "col-md-2">
 <b>Contact #:</b></div>
 <input type = "phonenumber" id="phone_number" name="phone_number" value="" style= "border: none; border-color: transparent; border-bottom: 1px solid black;">
</div>

<div class = "row">
<div class = "col-sm-4">
    <b>Institute/Organization Name:</b></div>
    <input type = "text" id="org_name" name="org_name" style= "border: none; border-color: transparent; border-bottom: 1px solid black; width:406px;">  
</div>
<div class = "row">
<div class = "col-sm-4">
    <b>Full Address:</b></div>
    <input type = "text" id="faddress" name="faddress" style= "border: none; border-color: transparent; border-bottom: 1px solid black; width:406px;">  
</div>

<b> *Check List</b><br>
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

  <label for="emcertificate" id="empolyee" style = "display:none;"> 	* Employment Certificate </label>
  <input type="file" id="empolyee_certificate" name="empolyee_certificate" accept="image/*" style = "margin-left:120px;display:none;"><br>

  
</div>

<b> <u>Terms and Conditions:</b></u><br>
<p style ="">
* Attach all documents with this form <br>
* Card can be collected after X working days from same Station <br>
* Card will not be issued to passenger without application form <br>
* Validity for Student and Working Woman Card is 1 year / validity of the tenure whichever is earlier. (Extendable upon request) <br>
* Personalized cards are non-refundable <br>
* Form can be downloaded from the website: https://pma.punjab.gov.pk/  <br> </p>

<button type="submit" class="btn btn-dark" style = "margin-left:80%; margin-bottom:5%";>Submit</button>
</div>
</form>
</div>
</div>

<script>

  // stations
  function onlyOne(checkbox) {
    var checkboxes = document.getElementsByName('station')
    checkboxes.forEach((item) => {
        if (item !== checkbox) item.checked = false
    })
}

function yesnoCheck1(that) {

if (that.value == "2") {

	document.getElementById("station_name").style.display = "block";

} else {

	document.getElementById("station_name").style.display = "none";	

}

}

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
  
  document.getElementById("disability_certificate").style.display = "none";
  document.getElementById("disability").style.display = "none";
  document.getElementById("empolyee_certificate").style.display = "none";
  document.getElementById("empolyee").style.display = "none";

} else if (that.value == "3") {

//alert("check");

	document.getElementById("disability_certificate").style.display = "inline-block";
  document.getElementById("disability").style.display = "inline-block";

  document.getElementById("empolyee_certificate").style.display = "none";
  document.getElementById("empolyee").style.display = "none";
  document.getElementById("student_id_card_front").style.display = "none";
  document.getElementById("student_front").style.display = "none";
  document.getElementById("student_id_card_back").style.display = "none";
  document.getElementById("student_back").style.display = "none";

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
  document.getElementById("empolyee_certificate").style.display = "none";
  document.getElementById("empolyee").style.display = "none";

}



else if (that.value == "4") {

//alert("check");

	document.getElementById("empolyee_certificate").style.display = "inline-block";
  document.getElementById("empolyee").style.display = "inline-block";

  document.getElementById("student_id_card_front").style.display = "none";
  document.getElementById("student_front").style.display = "none";
  document.getElementById("student_id_card_back").style.display = "none";
  document.getElementById("student_back").style.display = "none";
  document.getElementById("disability_certificate").style.display = "none";
  document.getElementById("disability").style.display = "none";

}
else{
  document.getElementById("photo").style.display = "inline-block";
  document.getElementById("cnic_front").style.display = "inline-block";
  document.getElementById("cnic_back").style.display = "inline-block";

}

}

</script>










@endsection