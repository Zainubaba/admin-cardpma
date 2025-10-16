@extends('depot.master')
@section('content')	

<style>
@media screen and (max-width: 2000px){
.btn{
    margin-left:480px; 
    margin-top:30px;
}
.box{

  width:400px;
  height:380px; 
}

.account{
    margin-left:450px; 
    width:500px; 
}
}
@media screen and (max-width: 500px){

  .box{
  width:350px; 
  height:400px; 
}
.btn{
    margin-left:220px; 
   
}

.account{
    margin-left:50px; 
    width:500px;
}
.pull-left{
    margin-top:60px;
}
}

</style>


<form  method="get" action="/saveverified/{{$id}}" enctype="multipart/form-data" class = "account">
 @csrf
<div class="row">

    <div class="col-md-12">
        <div class="pull-left">
            <h2 style="color: white; border:1px; border-radius:5px;width:350px; height:50px; text-align:center; background-color:#7d0000">Payment Management</h2>
        </div>
       
</div>
</div>


<div class="box" style="background-color: white; border-radius:10px; border: 1px; padding:10px;">
<b> Price</b><br>

                <b style = "margin-left:30px;">Card Payment:</b>  Rs 500
    
   
     <div >
	  <b>Payment Station:</b>

      @foreach($cardforms as $cardform)

      {{$cardform->station_name}}

      @endforeach

      </div>               



  <h5 style="color: white; border:1px; border-radius:5px; width:150px; height:30px; text-align:center; background-color:#7d0000; margin-left:100px; margin-top:10px;">*After Payment</h5><br>
  <div class = "row">
  <div class ="col-md-6">
         <b> Add Receipt Number:  </b></div>
         <div class ="col-md-3">
         @foreach($payment as $pay)

        {{$pay->receipt}}<br> 
</div>
</div>

<div class = "row">
  <div class ="col-md-6">
        <b> Paid Date: </b></div>
        <div class ="col-md-4">
       {{$pay->date}}
        @endforeach
</div>
</div>
<div id="checkbox" style="margin-top:10px;">
	  <label><b>* Form Verification</b></label><br>
      <div class="form-check form-check-inline" style="margin-left:30px; line-height: 0.5;"> 
      <input  onchange="yesnoCheck2(this);" onclick="onlyOne(this);" class="form-check-input" name="verify_payment" type="checkbox" id="verify_payment" value="Yes">
      <label class="form-check-label" for="studentcard">{{ __('Verified') }}</label><br>
     </div><br>
     <div class="form-check form-check-inline" style="margin-left:30px; line-height: 0.5;"> 
      <input  onchange="yesnoCheck2(this);" onclick="onlyOne(this);" class="form-check-input" name="verify_payment" type="checkbox" id="verify_payment" value="No">
      <label class="form-check-label" for="senior">{{ __('Not Verified') }}</label><br>
     </div><br>
</div>

<div class = "checkbox" style="margin-left:30px; line-height: 1; "> 
<label for="remarks" id="remark" style = "display:none; margin-top:3px; "> 	* Remarks:	</label><br>
<textarea id="remarks" name="remarks" rows="2" cols="30" style = "display:none;"></textarea>


<button type="submit" class="btn btn-dark" style = "margin-left:40%; margin-bottom:5%">Submit</button>          
</div>

</form>

<script>
function onlyOne(checkbox) {
    var checkboxes = document.getElementsByName('verify_payment')
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
    
@endsection
