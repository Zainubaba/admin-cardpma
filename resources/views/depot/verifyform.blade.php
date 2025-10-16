@extends('depot.master')
@section('content')

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
.checkbox2{
margin-left:350px;
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
.checkbox2{
margin-left:35px;
}
}

</style>

<div  class = "box" style = "padding-left:0%; ">
<form method="get" action="/saveformverified/{{$id}}" enctype="multipart/form-data" style = "border:2px solid black; border-radius:20px; background-color:white;  color: black;  margin-bottom:5px;">
    
        <div class="form-box col-sm-12" style="">
<div class ="content">
	{{-- <h3 style = "text-align:center;"> <u>Personalized Smart Card Application Form - OLMRTS </u></h3> --}}
</div>

@foreach($cardforms as $cardform)
<div class ="row">
<div  class="checkbox" style="margin-top: 5%;">
	  <b>*Select the category</b><br>
      <div class="form-check form-check-inline" style="margin-left:30px;"> 
      @foreach ($category as $categor)
      @if($cardform->category == $categor->id)
      <td >{{$categor->name}}</td>
       @endif
       @endforeach</div><div>
     </div><br>

</div>


<div  class="checkbox2" style="margin-top: 5%;">

	  <b>*preferred station:</b>
	  {{ $cardform->pickup_station }}    
             
            	  
  
</div>
</div>

<div class = "">
<div style="border: 2px solid black ; margin-right:10%; border-radius:10px; padding-top:10px; margin-top:30px; padding-left:30px;">
<div class="row">
<div class = "col-sm-3"><b> Card Name: </b></div>
<div class = "col-sm-7" style= "border: none; border-color: transparent; border-bottom: 1px solid black; width:110px;">{{$cardform->card_name}}</div>

</div>
<div class = "row">

<div class = "col-sm-3"><b> Passenger Name: </b></div>
<div class = "col-sm-2" style= "border: none; border-color: transparent; border-bottom: 1px solid black; width:110px;">{{$cardform->name}}</div>


<div class = "col-sm-2">
 <b>CNIC:</b></div>
 <div class = "col-sm-2" style= "border: none; border-color: transparent; border-bottom: 1px solid black; width:110px;">{{$cardform->cnic}}
 </div>
</div>


<div class = "row">

<div class = "col-md-3" style="margin-top:15px;">

 <b>Date of Birth:</b></div>

 <div class = "col-sm-2" style= "border: none; border-color: transparent; border-bottom: 1px solid black;width:110px;margin-top: 20px;"> 
 {{$cardform->dob}}

  @if($cardform->category == "2")
   
 {{$years->y}} Years
 @endif
</div>


 
<div class = "col-md-2" style="margin-top: 5px;"><b> CNIC Expiry Date: </b></div>
<div class = "col-sm-2" style= "border: none; border-color: transparent; border-bottom: 1px solid black; width:110px;margin-top: 20px;">{{$cardform->cnic_expiry_date}}

</div>
</div>

<div class = "row">

<div class = "col-md-3" style=margin-top:5px;>
  <b> Gender: </b></div>
<div class = "col-sm-2" style= "border: none; border-color: transparent; border-bottom: 1px solid black; width:110px;margin-top: 10px;">{{$cardform->gender}}
</div>


<div class = "col-md-2" style="margin-top:15px;">
 <b>Contact #:</b></div>
 <div class = "col-sm-2" style= "border: none; border-color: transparent; border-bottom: 1px solid black; width:110px;margin-top:15px;">{{$cardform->phone_number}}
</div>
</div>

<div class = "row">
<div class = "col-md-3">
    <b>Institute/Organization Name:</b></div>
    <div class = "col-md-6" style= "border: none; border-color: transparent; border-bottom: 1px solid black; width:110px;margin-top: 15px;">{{$cardform->org_name}}</div></div>
<div class = "row">
<div class = "col-md-3" style="margin-top:15px;">
    <b>Full Address:</b></div>
    <div class = "col-md-6" style= "border: none; border-color: transparent; border-bottom: 1px solid black; width:110px; margin-top:15px; margin-bottom:15px;">{{$cardform->faddress}}</a></div></div>
    @if($cardform->category == "3")  
    Submiting PCRDP is verified: {{$pccheck}} 
    
    <br>

    <div class = "row">
    <div class = "col-md-3"> 	* PCRDP Registration &nbsp;&nbsp;Number:	</div>
<div class = "col-md-4">{{$cardform->pcrdp}}</div>
</div>
@endif

<b> *Check List</b><br>
<div class = "checkbox" style="margin-left:30px; "> 
<div class = "row">
    @if($cardform->category == "3")  
              
          
<div class = "col-md-3"> 	* Disability Certificate 	</div>
<div class = "col-md-4">{{$cardform->disability_certificate}}</div>
<a href="{{asset('/uploads/disability_certificate/'.$cardform->disability_certificate)}}" id="discer" name="discer" target="blank" alt="{{$cardform->disability_certificate}}"
style="max-width:170px; margin-left:100px; "><label>&nbsp;Disability Certificate</label>&nbsp;<input type="checkbox"  name="verify_disability" id="verify_disability"></a><br>


@endif
</div>

<div class = "row">
  <div class = "col-md-3"> * Photo 	(white &nbsp;&nbsp;&nbsp;background) </div>
  <div class = "col-md-4">{{$cardform->photo}} </div>
  <a href="{{asset('/uploads/photo/'.$cardform->photo)}}"  target="blank" alt="{{$cardform->photo}}" style="max-width:150px; padding-left:10%;margin-left:20px;"><label>&nbsp;Photo</label>&nbsp;<input type="checkbox" name="verify_photo" id="verify_photo"></a><br>
 
</div>

<div class = "row">
  <div class = "col-md-3"> 	* CNIC Front	</div>
  <div class = "col-md-4" >{{$cardform->cnic_front}}</div>
  <a href="{{asset('/uploads/cnic_front/'.$cardform->cnic_front)}}"  target="blank" alt="{{$cardform->cnic_front}}" style="max-width:200px;  padding-left:10%;margin-left:20px;"><label>CNIC Front</label>&nbsp;<input type="checkbox" name="verify_CNIC_Front" id="verify_CNIC_Front"> </a><br>


</div>

<div class = "row">
  <div class = "col-md-3"> 	* CNIC Back	</div>
  <div class = "col-md-4">{{$cardform->cnic_back}}</div>
  <a href="{{asset('/uploads/cnic_back/'.$cardform->cnic_back)}}"  target="blank" alt="{{$cardform->cnic_back}}" style="max-width:200px;  padding-left:10%;margin-left:20px;"><label>CNIC Back</label>&nbsp;<input type="checkbox" name="verify_CNIC_Back" id="verify_CNIC_Back" ></a><br>

</div>

<div class = "row">
    @if($cardform->category == "1")  
  <div class = "col-md-3"> * Student Identity Card &nbsp;&nbsp;&nbsp;Front	</div>
  <div class = "col-md-4">{{$cardform->student_id_card_front}}</div>
  <a href="{{asset('/uploads/student_card_front/'.$cardform->student_id_card_front)}}" id="scardf" class="scardf" target="blank" alt="{{$cardform->student_id_card_front}}" style="max-width:200px;  padding-left:10%;"><label>Student Card</label>&nbsp;<input type="checkbox" name="verify_Student_Card_Front" id="verify_Student_Card_Front" ></a><br>

</div>

<div class = "row">
  <div class = "col-md-3"> 	* Student Identity Card &nbsp;&nbsp;&nbsp;Back	</div>
  <div class = "col-md-4">{{$cardform->student_id_card_back}}</div>
  <a href="{{asset('/uploads/student_card_back/'.$cardform->student_id_card_back)}}" id="scardb" class="scardb"   target="blank" alt="{{$cardform->student_id_card_back}}" style="max-width:200px;  padding-left:10%;"><label>Student Card</label>&nbsp;<input type="checkbox" name="verify_Student_Card_Back" id="verify_Student_Card_Back"></a><br>

</div>

  <div class = "row">
  <div class = "col-md-3"> 	* Student Certificate	</div>
  <div class = "col-md-4">{{$cardform->student_affidavite}}</div>
  <a href="{{asset('/uploads/empolyee_card/'.$cardform->student_affidavite)}}" id="aff" class="aff"  target="blank" alt="{{$cardform->student_affidavite}}" style="max-width:200px;  padding-left:10%;"><label>Affidavite</label>&nbsp;<input type="checkbox" name="verify_Student_Affidavite" id="verify_Student_Affidavite" ></a><br>

  @endif
</div>

<div class = "row">
@if($cardform->category == "4")  
  <div class = "col-md-3"> 	* Employment Card </div>
  <div class = "col-md-4">{{$cardform->empolyee_card}}</div>
 <a href="{{asset('/uploads/empolyee_card/'.$cardform->empolyee_card)}}" id="emp" class="emp"  target="blank" alt="{{$cardform->empolyee_card}}" style="max-width:150px; margin-left:100px;"><label>Employee Card</label>&nbsp;<input type="checkbox" ></a><br>

  </div>

  <div class = "row">
  <div class = "col-md-3"> 	* Empolyment &nbsp;&nbsp;Certificate	</div>
  <div class = "col-md-4">{{$cardform->empolyee_affidavite}}</div>
 <a href="{{asset('/uploads/empolyee_card/'.$cardform->empolyee_affidavite)}}" id="emp_aff" class="emp_aff"  target="blank" alt="{{$cardform->empolyee_affidavite}}" style="max-width:100px;margin-left:100px;"><label>Affidavite</label>&nbsp;<input type="checkbox" ></a><br>

  @endif
</div>

</div>
</div>
<div style="border: 2px solid black ; margin-right:10%; border-radius:10px; padding-top:10px; margin-top:30px; padding-left:30px;">
<b> <u>Terms and Conditions:</b></u><br>
<p style="">
  * A message alert will be sent for the collection of card from the selected station.<br>
  * The card will not be issued to passenger without  submission of application. <br>
  * Validity for Students and Working Women cards is one (01) year or till the validity of the tenure whichever is &nbsp;&nbsp;earlier.
   Cards are renewable upon request.<br>
  * Personalized cards are non-refundable.<br>
  * Committing any of the following shall be Punishable under
     PMA Act.2015 with the fine upto Rs/500<br>
  &nbsp;  &nbsp;  &nbsp;  No 1. If applicant submits false information in his/her application.<br>
  &nbsp;  &nbsp;  &nbsp;  No 2. If applicant submits forged document with the application.<br>                                    
  * Once issued , cards can only be collected at the ticketing window of the preferred station.<br>
  <br>
  {{-- checkbox --}}
  @if($cardform->t_c == "0")
    <input type="checkbox" name="t_c" value="0" readonly onclick="return false;">
    @else
    <input type="checkbox" name="t_c" value="1" checked onclick="return false;">
    @endif
    <label>I underatake that all of the information in the application is true to best of my knowledge and i accept </label><br>
    &nbsp;  &nbsp; all of the above mentioned Terms and Conditions </label>
  </div>

    @endforeach
 

</div>
<div class="d-flex flex-column" style="position: relative;">
<div id="checkbox" style="margin-top:10px;width:50%">
	  <label><b>* Form Verification</b></label><br>
      <div class="form-check form-check-inline" style="margin-left:30px; line-height: 0.5;"> 
      <input  onchange="yesnoCheck2(this);" onclick="onlyOne(this);" class="form-check-input" name="verify_form" type="checkbox" id="payment" value="Yes">
      <label class="form-check-label" for="studentcard">{{ __('Verified') }}</label><br>
     </div><br>
     <div class="form-check form-check-inline" style="margin-left:30px; line-height: 0.5;"> 
      <input  onchange="yesnoCheck2(this);" onclick="onlyOne(this);" class="form-check-input" name="verify_form" type="checkbox" id="payment" value="No">
      <label class="form-check-label" for="senior">{{ __('Not Verified') }}</label><br>
     </div><br>
    
</div>
<div id="checkbox" style="margin-top:10px;margin-right:50%;right:0;position:absolute;">
  <label><b>* Payment</b></label><br>
    <div class="form-check form-check-inline" style="margin-left:30px; line-height: 0.5;"> 
    <input  onchange="yesnoCheck9(this);" onclick="onlyOne9(this);" class="form-check-input" name="verify_payment" type="checkbox" id="verify_payment" value="Yes">
    <label class="form-check-label" for="studentcard">{{ __('Verified') }}</label><br>
   </div><br>
   <div class="form-check form-check-inline" style="margin-left:30px; line-height: 0.5;"> 
    <input  onchange="yesnoCheck9(this);" onclick="onlyOne9(this);" class="form-check-input" name="verify_payment" type="checkbox" id="verify_payment" value="No">
    <label class="form-check-label" for="senior">{{ __('Not Verified') }}</label><br>
   </div><br>
  
</div>


</div>
</div>
<div class="row">
  <div class="col-6">
<div class = "checkbox " style="margin-left:30px; line-height: 1; "> 
<label for="remarks" id="remark" style = "display:none; margin-top:3px; "> 	* Remarks:	</label><br>
<textarea id="remarks" name="remarks" rows="2" cols="30" style = "display:none;"></textarea>
</div>
</div>
<div class="col-6">
<div class = "col-6" style=" margin-left: 10%; ">
<label for="remarks2" id="remark2" style = "display:none; margin-top:3px; "> 	*Payment Remarks:	</label><br>
<textarea  id="remarks2" name="remarks2" rows="1" cols="30" style = "display:none;"></textarea>
<button type="submit" class="btn btn-dark" style = "margin-left:100%; margin-bottom:5%">Submit</button>  
</div>        
</div>
</div>

</div>

</form>
</div>

<script>
function onlyOne(checkbox) {
    var checkboxes = document.getElementsByName('verify_form')
    checkboxes.forEach((item) => {
        if (item !== checkbox) item.checked = false
    })
}


function yesnoCheck2(that) {

if (that.value == "No") {

	document.getElementById("remarks").style.display = "inline-block";
    document.getElementById("remark").style.display = "inline-block";

} else  {

    document.getElementById("remarks").style.display = "none";
    document.getElementById("remark").style.display = "none";

}
}
</script>     
<script>
  function onlyOne9(checkbox) {
      var checkboxes = document.getElementsByName('verify_payment')
      checkboxes.forEach((item) => {
          if (item !== checkbox) item.checked = false
      })
  }
  
  
  function yesnoCheck9(that) {
  
  if (that.value == "No") {
  
    document.getElementById("remarks2").style.display = "inline-block";
      document.getElementById("remark2").style.display = "inline-block";
  
  } else  {
  
      document.getElementById("remarks2").style.display = "none";
      document.getElementById("remark2").style.display = "none";
  
  }
  }
  </script>     
   
@endsection