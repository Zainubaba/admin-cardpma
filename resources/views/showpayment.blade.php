@extends('design_main.master')
@section('content')

<style>
@media screen and (max-width: 2000px){
.btn{
    margin-left:480px; 
    margin-top:30px;
}
.box{

  width:400px;
  height:300px; 
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


<form  method="POST" action="{{ route('payment.store') }}" enctype="multipart/form-data" class = "account">
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

                
<!-- @if($to >= 'futureDate')
<button type="submit" class="btn btn-dark" style = "">Renew</button>
@endif -->
</div>

</form>
       
    
@endsection