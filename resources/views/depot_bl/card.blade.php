@extends('depot.master')
@section('content')	


    <div  style = "padding-left:0%; font-size:14px;">
<form  method="POST" action=""
        style = "border:1px solid black; margin-left:380px; border-radius:30px; background-color:white;  color: black; width:800px; height:750px; margin-top:10px; margin-bottom:15px;">
        @csrf 
        <div class="col-sm-12" style="margin-left:10px;">
<div class ="content">
	<h3 style = "text-align:center;"> <u>Personalized Smart Card Application Form - OLMRTS </u></h3>
</div>


</div>
@foreach($cardforms as $card) 

<div class = "row" style = "margin-left:350px;">
<a class="nav-link collapsed" style="display:block;"  href="/fill-pdf/{{$card->id}}">
      
      <span style="">front</span>
    </a>
    <a class="nav-link collapsed" style="display:block;"  href="/fillb-pdf/{{$card->id}}">
      
      <span style="">back</span>
    </a>
</div>

<div class="container" style="width:467px; height: 350px; position: relative; text-align: center; color: white;">
<div class="bg" style="background-image: url('/images/s1.jpg'); width:325px; height: 204px; background-size:cover;  background-position: right center;"> 

<div class="row">
    <div class="col-12">
        <div class="top-right" style="position: absolute; top: 6px; right: 16px;margin-bottom:200px">
            <img src="{{asset('/uploads/photo/'.$card->photo)}}" alt="student img" style="width: px; height: 30px; float:right;  margin-right:10px;">
          

            <h6 style="color:black; text-align:right; margin-top: 30px;margin-right:20px; font-size:11px;">  {{$card->name}}
            @foreach ($category as $categor)
                 @if($card->category == $categor->id)
            <br> {{$categor->name}}
            @endif
                 @endforeach
          </h6>
        </div>
    </div>
   
  </div>
</div>
  
  
  <div class="row">
    <div class="col-12">
        <div class="bottom-right" style="position: absolute; bottom: 8px; right: 16px;">
            <h5 style="color: black; margin-bottom:10px; margin-right:200px; font-size:15px"> {{$card->cnic}}</h5>
        </div>
    </div>  
</div>
</div>


<div class="container" style="width:467px; height: 350px; position: relative; text-align: center; color: white;">
<div class="bg" style="background-image: url('/images/s2.jpg');width:325px; height: 204px; background-size:cover;  background-position: right center;"> 

<div class="row">
    <div class="col-6">
        <div class="top-left" style="position: absolute; top: 8px; left: 16px;">
        <h6 style="color:black; text-align:left; margin-top: 50px;margin-left: 20px;font-size:11px"> {{$card->name}} <br>  @foreach ($category as $categor)
                 @if($card->category == $categor->id)
             {{$categor->name}}
            @endif
                 @endforeach
      
      </h6>
        </div>
        <div class="col-6">
        <img src="{{asset('/uploads/photo/'.$card->photo)}}" alt="student img" style="width: px; height: 50px;  margin-top:51px; margin-left:140px;">
        
            
   
  </div>
  <div class="top-right" style="position: absolute; top: 8px; right: 16px;">
        <h5 style="color: black; text-align:right; margin-top:50px; margin-right:-130px; font-size:15px"> {{$card->cnic}}</h5> 
        </div>

  </div>

  
  
</div>
@endforeach




</div>
</form>
</div>

@endsection