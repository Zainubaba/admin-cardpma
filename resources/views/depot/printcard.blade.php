@extends('depot.master')
@section('content')	


                        
                      



<?php
 $i = 1;
?> 

<div class="container mt-4" style="margin-left:230px;">
<div class="card" style="width:1100px;">
    <div class="card-body" >
        <div class="row">

           
    

       
                 <div class="col-md-12">
                <h2 class="pt-2 pb-3 text-center font-bold font-up danger-text">LIST OF PRINTED CARDS

</h2></div>

          
        
<table id="myTable" class="table table-bordered red-border text-center"  style="margin-left:20px; margin-right:20px; margin-top:20px;">
    <form action="/stationsort" method="GET">
        @csrf
        <select onchange="this.form.submit()" name="station">
            <option value="Select one option" selected>Select one option</option>
                @foreach ($sta as $key => $value)
                    <option value="{{ $value->station_name }}" >{{ $value->station_name }}</option>
                @endforeach
        </select>
    </form>
   
        
    <div class="search-container" style="margin-left:800px;">
        <form action="/verifysearch" method="POST">
            @csrf
          <input type="text" placeholder="Search by CNIC.." name="search">
          <button type="submit"><i class="fa fa-search"></i></button>
        </form>
          </div>

            <thead style="background-color: rgba(19, 14, 65, 0.6); color:white;">
                <tr>
                <th style= "text-align:center;"><strong>Sr#</strong></th>
                <th style= "text-align:center;"><strong>Category</strong></th>
                <th style= "text-align:center;"><strong>Passenger Name</strong></th>
                    <th style= "text-align:center;"><strong>CNIC</strong></th>
                    <th style= "text-align:center;"><strong>Form ID</strong></th>
                    <th style= "text-align:center;"><strong >Station Name</strong></th>
                     <th style= "text-align:center;"><strong >Action</strong></th>
                     
                 </tr>
                 </thead>
                 
                              
     <tbody>  
     <?php 
        $i=1;
         ?>
  
                 <tr>
                 @foreach($cardforms as $card)          
                 <form class="form-register" id="form-register" action="/printcard/{id}" method="get" enctype="multipart/form-data">
@csrf       

@if(is_null($card->dispatch)) 
                 <td style = "text-align:center;"> {{$i}}</td>

                 @foreach ($category as $categor)
                 @if($card->category == $categor->id)
                 <td style = "text-align:left;"> {{$categor->name}}</td>
                 @endif
                 @endforeach
                 
                 <td style = "text-align:left;"> {{$card->name}}</td>

                 <td style = "text-align:left;">{{$card->cnic}}</td>
                 <td style = "text-align:center;">{{$card->form_id}}</td>

                 <td style = "text-align:left;">{{$card->near_station}}</td>
                 
                 <td style = "text-align:center;">
                 <form method="get" action="/printcard/{{$card->id}}">
                    @csrf
                    
                    @if(is_null($card->cardnumber))                
                <input  type="text" name="cardnumber" placeholder="Card Number" style = "width:150px;">
  @else 
  <input  type="text" name="cardnumber" value = "{{$card->cardnumber}}" style = "width:150px;" readonly>

  @endif
  <input  type="hidden" name="cardid" placeholder="cardid" value="{{$card->id}}">
  <input type="submit" hidden="true" />
  <a href="/card/{{$card->id}}" style= "border: 1px solid; background-color:rgba(19, 14, 65, 0.6); color:white; padding:2px;">
                 Print Card</a>

</form>
                </td>
                 
</tr>

<?php 
        
        $i++; ?>

@endif  
</tbody>
</form> 
@endforeach

         
</table>
{{
    $cardforms->appends(request()->query())->links()
    }}
<script>
    $(document).ready(function() {

$('.submit_on_enter').keydown(function(event) {
  // enter has keyCode = 13, change it if you want to use another button
  this.form.submit();
//   if (event.keyCode == 13) {
//     this.form.submit();
//     return false;
//   }
});

});

    </script>



@endsection