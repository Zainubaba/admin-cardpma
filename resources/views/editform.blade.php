@extends('design_main.master')
@section('content')


<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


<div  style = "padding-left:0%; font-size:14px;">
<form  method="POST" action="{{ route('updatep',$cardform->id) }}"
        style = "border:2px solid black; margin-left:280px; border-radius:30px; background-color:snow;  color: black; width:900px; height:1000px; margin-top:10px; margin-bottom:5px;">
        @method('patch')
        @csrf 
        <div class="col-sm-12" style="margin-left:50px;">
<div class ="content">
	<h3 style = ""> <u>Personalized Smart Card Application Form - OLMRTS </u></h3>
</div>

<div class ="row">
  {{-- \\ --}}
<div class="col-md-4" >
      <div id="checkbox"  >
	  <label ><b>*Select the category</b></label><br>
      <div class="form-check form-check-inline" style="margin-left:30px; line-height: 0.5;">

   
      <input  onchange="yesnoCheck2(this);" onclick="onlyOne(this);" class="form-check-input" name="category" type="checkbox" id="category" value="1" {{  ($cardform->category == 1 ? 'checked' : '') }}>
      <label class="form-check-label" for="studentcard">{{ __('Student Card') }}</label><br>
     </div><br>
     <div class="form-check form-check-inline" style="margin-left:30px; line-height: 0.5;"> 
      <input  onchange="yesnoCheck2(this);" onclick="onlyOne(this);" class="form-check-input" name="category" type="checkbox" id="category" value="2" {{  ($cardform->category == "2" ? 'checked' : '') }}>
      <label class="form-check-label" for="senior">{{ __('Senior Citizen Card') }}</label><br>
     </div><br>
     <div class="form-check form-check-inline" style="margin-left:30px; line-height: 0.5;"> 
      <input  onchange="yesnoCheck2(this);" onclick="onlyOne(this);" class="form-check-input" name="category" type="checkbox" id="category" value="3" {{  ($cardform->category == "3" ? 'checked' : '') }}>
      <label class="form-check-label" for="special">{{ __('Special Citizen Card') }}</label><br>
     </div><br>
     <div class="form-check form-check-inline" style="margin-left:30px; line-height: 0.5;"> 
      <input  onchange="yesnoCheck2(this);" onclick="onlyOne(this);" class="form-check-input" name="category" type="checkbox" id="category" value="4" {{  ($cardform->category == "4" ? 'checked' : '') }}>
      <label class="form-check-label" for="women">{{ __('Working Woman') }}</label><br>
     </div><br>
</div>
</div>

<div  class="checkbox2">

	  <b>*Near_by station:</b> 
    <select name='station_name' id="station_name"  value="station_name">
								<option value="Select one option" selected>{{ $cardform->near_station }}</option>
        @foreach ($station as $key => $value)
       <option value="">{{ $value->station_name }}</option>
              @endforeach
								</select>  
   
             
            	  
  
</div>
<div class="col-md-12" style="padding-left:0px; margin-top:10px;">             
	
	  <div class="form-holder"  id="pickup_station">
	  <label><b>*Select Your Preferred Station From Where You Collect Card and Make Payment:</b></label>
	  <select name='pickup_station' id="pickup_station"  value="pickup_station">
								<option value="Select one option" selected>{{ $cardform->pickup_station }}</option>
        @foreach ($station as $key => $value)
       <option value="{{ $value->station_name }}">{{ $value->station_name }}</option>
              @endforeach
								</select>  
  
</div>
<div class = "">
<div class = "row"><b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Daily Visiting Routes: </b></div>
<div style="color:black; margin-left:30px; line-height:2em;">
<div> <b> 1. </b>To 
<select name='to_route1' id="to_route1"  value="to_route1">
								<option value="Select one option" selected>{{ $cardform->to_route1}}</option>
        @foreach ($station as $key => $value)
       <option value="{{ $value->station_name }}">{{ $value->station_name }}</option>
              @endforeach
								</select>  
  
&nbsp;From
<select name='from_route1' id="from_route1"  value="from_route1">
								<option value="Select one option" selected>{{ $cardform->from_route1}}</option>
        @foreach ($station as $key => $value)
       <option value="{{ $value->station_name }}">{{ $value->station_name }}</option>
              @endforeach
								</select>  
  
</div>

<div> <b> 2. </b>To 
<select name='to_route2' id="to_route2"  value="to_route2">
								<option value="Select one option" selected>{{ $cardform->to_route2}}</option>
        @foreach ($station as $key => $value)
       <option value="{{ $value->station_name }}">{{ $value->station_name }}</option>
              @endforeach
								</select>  
  
&nbsp;From
<select name='from_route2' id="from_route2"  value="from_route2">
								<option value="Select one option" selected>{{ $cardform->from_route2}}</option>
        @foreach ($station as $key => $value)
       <option value="{{ $value->station_name }}">{{ $value->station_name }}</option>
              @endforeach
								</select>  
  
</div>

<div> <b> 3. </b>To 
<select name='to_route3' id="to_route3"  value="to_route3">
								<option value="Select one option" selected>{{ $cardform->to_route3}}</option>
        @foreach ($station as $key => $value)
       <option value="{{ $value->station_name }}">{{ $value->station_name }}</option>
              @endforeach
								</select>  
  
&nbsp;From
<select name='from_route3' id="from_route3"  value="from_route3">
								<option value="Select one option" selected>{{ $cardform->from_route3}}</option>
        @foreach ($station as $key => $value)
       <option value="{{ $value->station_name }}">{{ $value->station_name }}</option>
              @endforeach
								</select>  
  
</div>

</div>
 

<div class = "">
<div class="row">
                                <div class="col-md-3"><b> Name on card: </b> in Block/Capital letters</div>
                                  
					<input type="text" name="customer1" value="{{$arr1[0]}}" pattern="[A-Z]{1}" style="width: 25px; height:30px;"><input type="text" value="{{$arr1[1]}}" name="customer2" pattern="[A-Z]{1}" style="width: 25px; height:30px;"><input type="text" name="customer3" value="{{$arr1[2]}}" pattern="[A-Z]{1}" style="width: 25px; height:30px;"><input type="text" value="{{$arr1[3]}}" name="customer4" pattern="[A-Z]{1}" style="width: 25px; height:30px;"><input type="text" name="customer5" value="{{$arr1[4]}}" pattern="[A-Z]{1}" style="width: 25px; height:30px;"><input type="text" value="{{$arr1[5]}}" name="customer6" pattern="[A-Z]{1}" style="width: 25px; height:30px;"><input type="text" name="customer7" value="{{$arr1[6]}}" pattern="[A-Z]{1}" style="width: 25px; height:30px;"><input type="text" name="customer8" value="{{$arr1[7]}}" pattern="[A-Z]{1}" style="width: 25px; height:30px;"><input type="text" name="customer9" value="{{$arr1[8]}}" pattern="[A-Z]{1}" style="width: 25px; height:30px;"><input type="text" name="customer10" value="{{$arr1[9]}}" pattern="[A-Z]{1}" style="width: 25px; height:30px;"><input type="text" name="customer11" value="{{$arr1[10]}}" pattern="[A-Z]{1}" style="width: 25px; height:30px;"><input type="text" name="customer12" value="{{$arr1[11]}}" pattern="[A-Z]{1}" style="width: 25px; height:30px;"><input type="text" value="{{$arr1[12]}}" name="customer13" pattern="[A-Z]{1}" style="width: 25px; height:30px;"><input type="text" name="customer14" value="{{$arr1[13]}}" pattern="[A-Z]{1}" style="width: 25px; height:30px;"><input type="text" name="customer15" value="{{$arr1[14]}}" pattern="[A-Z]{1}" style="width: 25px; height:30px;"><input type="text" name="customer16" value="{{$arr1[15]}}" pattern="[A-Z]{1}" style="width: 25px; height:30px;"><input type="text" name="customer17" value="{{$arr1[16]}}" pattern="[A-Z]{1}" style="width: 25px; height:30px;"><input type="text" name="customer18" value="{{$arr1[17]}}" pattern="[A-Z]{1}" style="width: 25px; height:30px;"><input type="text" value="{{$arr1[18]}}" name="customer19" pattern="[A-Z]{1}" style="width: 25px; height:30px;"><input type="text" name="customer20" value="{{$arr1[19]}}" pattern="[A-Z]{1}" style="width: 25px; height:30px;">
				
                
    </div>

    </div>
<div class = "row">

<div class = "col-md-3"><b> Passenger Name: </b></div>
<div class = "col-md-2" style = "color:black; padding-left:0px;">{{$cardform->name}}</div>

<div class = "col-md-2">
 <b style="margin-left:6px">CNIC:</b></div>
 <div class = "col-md-2"  style = "color:black; padding-left:5px;">{{$cardform->cnic}}</div>
</div>


<div class = "row">

<div class = "col-md-3">
<b>Date of Birth:</b></div>
 <input type = "date" id="dob" name="dob" value="{{$cardform->dob}}" onchange="myFunction()" style= "border: none; border-color: transparent; border-bottom: 1px solid black;  width:170px;">
<div class = "col-md-2">
<b> CNIC Expiry Date: </b></div>
<input type = "date" value="{{$cardform->cnic_expiry_date}}" id="cnic_expiry_date" name="cnic_expiry_date" style= "border: none; border-color: transparent; border-bottom: 1px solid black; width:170px;">

&nbsp&nbsp&nbsp&nbsp&nbsp
<div id="life" style = "display:none;" >
<input   class="form-check-input" name="cnic_expiry_date" type="checkbox" id="cnic_expiry_date" value="LifeTime" >
      <label class="form-check-label" for="cnic_expiry_date">{{ __('Life Time') }}</label>

 </div>

<div class = "col-md-3"><b>
<label for="gender" > Select your Gender: </b></label></div>
<select name="gender" style="width:170px; margin-top:5px;">
	<option value="none">{{$cardform->gender}}</option>
	<option value="male">Male</option>
	<option value="female">Female</option>
	<option value="Transgender">Transgender</option>
</select>


  <div class = "col-md-2">
 <b>Contact #:</b></div>
 <div class = "col-md-2" style = "color:black; padding-left:0px;">{{$cardform->phone_number}}</div>
</div>

<div class = "row">
<div class = "col-sm-4">
    <b>Institute/Organization Name:</b></div>
    <input type = "text" id="org_name" name="org_name" value= "{{$cardform->org_name}}" style= "border: none; border-color: transparent; border-bottom: 1px solid black; width:406px;">  
</div>
<div class = "row">
<div class = "col-sm-4">
    <b>Full Address:</b></div>
    <input type = "text" id="faddress" name="faddress" value= "{{$cardform->faddress}}" style= "border: none; border-color: transparent; border-bottom: 1px solid black; width:406px;">  
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



<div class = "checkbox" style="margin-left:30px; line-height: 1;"> 
<label for="dcertificate" id="disability" style = "display:none;"> 	* Disability Certificate 	</label>
  <input type="file" id="disability_certificate" name="disability_certificate" accept="image/*" style = "margin-left:142px; display:none;">
 <a href="{{asset('/uploads/disability_certificate/'.$cardform->disability_certificate)}}" id="discer" name="discer" target="blank" alt="{{$cardform->disability_certificate}}" style="max-width:100px; display:none; padding-top:5%; ">Disability Certificate</a><br>

  <label for="photo"> * Photo 	(white background) </label>
  <input type="file" id="photo" name="photo" accept="image/*" style = "margin-left:103px;">
  <a href="{{asset('/uploads/photo/'.$cardform->photo)}}"  target="blank" alt="{{$cardform->photo}}" style="max-width:100px;">Photo</a><br>

  <label for="fcnic"> 	* CNIC Front	</label>
  <input type="file" id="cnic_front" name="cnic_front" accept="image/*" style = " margin-left:196px;">
  <a href="{{asset('/uploads/cnic_front/'.$cardform->cnic_front)}}"  target="blank" alt="{{$cardform->cnic_front}}" style="max-width:100px;">CNIC Front</a><br>


  <label for="bcnic"> 	* CNIC Back	</label>
  <input type="file" id="cnic_back" name="cnic_back" accept="image/*" style = " margin-left:200px;">
  <a href="{{asset('/uploads/cnic_back/'.$cardform->cnic_back)}}"  target="blank" alt="{{$cardform->cnic_back}}" style="max-width:100px;">CNIC Back</a><br>


  <label for="stfcertificate" id="student_front"  style = "display:none;"> * Student Identity Card Front	</label>
  <input type="file" id="student_id_card_front" name="student_id_card_front" accept="image/*" style = "margin-left:95px;display:none;">
  <a href="{{asset('/uploads/student_card_front/'.$cardform->student_id_card_front)}}" id="scardf" class="scardf" target="blank" alt="{{$cardform->student_id_card_front}}" style="max-width:100px;display:none; ">Student Card</a><br>

  <label for="stbcertificate" id="student_back" style = "display:none;"> 	* Student Identity Card Back	</label>
  <input type="file" id="student_id_card_back" name="student_id_card_back" accept="image/*" style = "margin-left:100px;display:none;">
  <a href="{{asset('/uploads/student_card_back/'.$cardform->student_id_card_back)}}" id="scardb" class="scardb"   target="blank" alt="{{$cardform->student_id_card_back}}" style="max-width:100px; display:none;">Student Card</a><br>

  
  <label for="saffidavite" id="saffidavite" style = "display:none;"> 	* Student Certificate </label>
  <input type="file" id="student_affidavite" name="student_affidavite" accept="image/*" style = "margin-left:149px; display:none;">
 <a href="{{asset('/uploads/empolyee_card/'.$cardform->student_affidavite)}}" id="aff" class="aff"  target="blank" alt="{{$cardform->student_affidavite}}" style="max-width:100px; display:none;"> Affidavite</a><br>

 <label for="empaffidavite" id="empaffidavite" style = "display:none;"> 	* Employement Certificate </label>
  <input type="file" id="empolyee_affidavite" name="empolyee_affidavite" accept="image/*" style = "margin-left:120px; display:none;">
 <a href="{{asset('/uploads/empolyee_card/'.$cardform->empolyee_affidavite)}}" id="emp_aff" class="emp_aff"  target="blank" alt="{{$cardform->empolyee_affidavite}}" style="max-width:100px; display:none;"> Affidavite</a><br>


  <label for="emcertificate" id="empolyee" style = "display:none;"> 	* Employment Card </label>
  <input type="file" id="empolyee_card" name="empolyee_card" accept="image/*" style = "margin-left:120px; display:none;">
 <a href="{{asset('/uploads/empolyee_card/'.$cardform->empolyee_card)}}" id="emp" class="emp"  target="blank" alt="{{$cardform->empolyee_card}}" style="max-width:100px; display:none;">Empolyee Card</a><br>

  


<b> <u>Terms and Conditions:</b></u><br>
<br>
<p style="">
  * A message alert will be sent for the collection of card from the selected station.<br>
  * The card will not be issued to passenger without  submission of application. <br>
  * Validity for Students and Working Women cards is one (01) year or till the validity of the tenure whichever is earlier.<br>
    &nbsp; &nbsp;Cards are renewable upon request.<br>
  * Personalized cards are non-refundable.<br>
  * Committing any of the following shall be Punishable under
  PMA Act.2015 with the fine upto Rs/500<br>
  &nbsp;  &nbsp;  &nbsp;  No 1. If applicant submits false information in his/her application.<br>
  &nbsp;  &nbsp;  &nbsp;  No 2. If applicant submits forged document with the application.<br>                                    
  *Once issued , cards can only be collected at the ticketing window of the preferred station.<br>
  <br>
  &nbsp;<input type="checkbox">
  <label for="">   I underatake that all of the information in the application is true to best of my knowledge and i accept </label><br>
  &nbsp;  &nbsp; all of the above mentioned Terms and Conditions 
</p><br>
        
</div>

</div>
</div>
<button type="submit" class="btn btn-danger" style = "margin-left:80%; margin-bottom:10%">Update</button>
</div>
</form>
</div>


<script>

[].forEach.call(document.querySelectorAll('input[name ="category"]:checked'), function(cb) {
if(cb.value == '1'){
  document.getElementById("student_id_card_front").style.display = "inline-block";
  document.getElementById("student_front").style.display = "inline-block";
  document.getElementById("student_id_card_back").style.display = "inline-block";
  document.getElementById("student_back").style.display = "inline-block";
  document.getElementById("scardf").style.display = "inline-block";
  document.getElementById("scardb").style.display = "inline-block";
  document.getElementById("student_affidavite").style.display = "inline-block";
  document.getElementById("saffidavite").style.display = "inline-block";
  document.getElementById("aff").style.display = "inline-block";
  
  document.getElementById("disability_certificate").style.display = "none";
  document.getElementById("disability").style.display = "none";
  document.getElementById("discer").style.display = "none";
  document.getElementById("empolyee_card").style.display = "none";
  document.getElementById("empolyee").style.display = "none";
  document.getElementById("emp").style.display = "none";
  document.getElementById("empaffidavite").style.display = "none";
  document.getElementById("empolyee_affidavite").style.display = "none";
  document.getElementById("emp_aff").style.display = "none";
  document.getElementById("regb").style.display = "none";
  document.getElementById("regd").style.display = "none";
  document.getElementById("regdt").style.display = "none";
  document.getElementById("pcrdp").style.display = "none";
  document.getElementById("reg").style.display = "none";
  document.getElementById("pb").style.display = "none";

}
else if (cb.value == "3") {


	document.getElementById("disability_certificate").style.display = "inline-block";
  document.getElementById("disability").style.display = "inline-block";
  document.getElementById("discer").style.display = "inline-block";
  document.getElementById("regb").style.display = "inline-block";
  document.getElementById("regd").style.display = "inline-block";
  document.getElementById("regdt").style.display = "inline-block";
  document.getElementById("pcrdp").style.display = "inline-block";
  document.getElementById("reg").style.display = "inline-block";
  document.getElementById("pb").style.display = "inline-block";

  document.getElementById("empolyee_card").style.display = "none";
  document.getElementById("empolyee").style.display = "none";
  document.getElementById("empolyee").style.display = "emp";
  document.getElementById("student_id_card_front").style.display = "none";
  document.getElementById("student_front").style.display = "none";
  document.getElementById("scardf").style.display = "none";
  document.getElementById("scardb").style.display = "none";
  
  document.getElementById("student_id_card_back").style.display = "none";
  document.getElementById("student_back").style.display = "none";
  document.getElementById("student_affidavite").style.display = "none";
  document.getElementById("saffidavite").style.display = "none";
  document.getElementById("aff").style.display = "none";
  document.getElementById("empaffidavite").style.display = "none";
  document.getElementById("empolyee_affidavite").style.display = "none";
  document.getElementById("emp_aff").style.display = "none";

}
else if (cb.value == "2"){
  document.getElementById("photo").style.display = "inline-block";
  document.getElementById("cnic_front").style.display = "inline-block";
  document.getElementById("cnic_back").style.display = "inline-block";

  document.getElementById("student_id_card_front").style.display = "none";
  document.getElementById("student_front").style.display = "none";
  document.getElementById("student_id_card_back").style.display = "none";
  document.getElementById("student_back").style.display = "none";
  document.getElementById("scardf").style.display = "none";
  document.getElementById("scardb").style.display = "none";
  document.getElementById("disability_certificate").style.display = "none";
  document.getElementById("disability").style.display = "none";
  document.getElementById("discer").style.display = "none";
  document.getElementById("empolyee_card").style.display = "none";
  document.getElementById("empolyee").style.display = "none";
  document.getElementById("emp").style.display = "none";
  document.getElementById("student_affidavite").style.display = "none";
  document.getElementById("saffidavite").style.display = "none";
  document.getElementById("aff").style.display = "none";
  document.getElementById("empaffidavite").style.display = "none";
  document.getElementById("empolyee_affidavite").style.display = "none";
  document.getElementById("emp_aff").style.display = "none";
  document.getElementById("regb").style.display = "none";
  document.getElementById("regd").style.display = "none";
  document.getElementById("regdt").style.display = "none";
  document.getElementById("pcrdp").style.display = "none";
  document.getElementById("reg").style.display = "none";
  document.getElementById("pb").style.display = "none";
 
  

}



else if (cb.value == "4") {

//alert("check");

	document.getElementById("empolyee_card").style.display = "inline-block";
  document.getElementById("empolyee").style.display = "inline-block";
  document.getElementById("emp").style.display = "inline-block";
  document.getElementById("empaffidavite").style.display = "inline-block";
  document.getElementById("empolyee_affidavite").style.display = "inline-block";
  document.getElementById("emp_aff").style.display = "inline-block";
  

  document.getElementById("student_id_card_front").style.display = "none";
  document.getElementById("student_front").style.display = "none";
  document.getElementById("student_id_card_back").style.display = "none";
  document.getElementById("student_back").style.display = "none";
  document.getElementById("disability_certificate").style.display = "none";
  document.getElementById("disability").style.display = "none";
  document.getElementById("discer").style.display = "none";
  document.getElementById("scardf").style.display = "none";
  document.getElementById("scardb").style.display = "none";
  document.getElementById("student_affidavite").style.display = "none";
  document.getElementById("saffidavite").style.display = "none";
  document.getElementById("aff").style.display = "none";
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

});


// category

function onlyOne(checkbox) {
    var checkboxes = document.getElementsByName('category')
    checkboxes.forEach((item) => {
        if (item !== checkbox) item.checked = false
    })
}


</script>

<script>  
function myFunction() {
  var dob1 = document.getElementById("dob").value;
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




