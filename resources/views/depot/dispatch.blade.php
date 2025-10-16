@extends('depot.master')
@section('content')	
                        

<?php
 $i = 1;
?> 

<div class="container mt-4" style="margin-left:260px; color:">
<div class="card" style="width:1000px;">
    <div class="card-body" >
        <div class="row">

           

       
                 <div class="col-md-12">
                <h2 class="pt-2 pb-3 text-center font-bold font-up danger-text">LIST OF DISPATCHED CARDS

</h2></div>

          
        
<table id="Btable" class="table table-bordered red-border text-center"  style="margin-left:70px; margin-right:20px; margin-top:20px;">
    <select name='near_station' id="near_station"  value="near_station">
        <option value="Select one option" selected>Select one option</option>
@foreach ($sta as $key => $value)
<option value="{{ $value->station_name }}">{{ $value->station_name }}</option>
@endforeach
        </select> 
    <div class="search-container" style="margin-left:700px;">
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
                     <th style= "text-align:center;"><strong >Dispatch</strong></th>
                 </tr>
                 </thead>
                 
                              
     <tbody>  
     <?php 
        $i=1;
         ?>
  
                 <tr>
                 @foreach($cardforms as $card)          
                 <form class="form-register" id="form-register" action="/disupdate/{{$card->id}}" method="post" enctype="multipart/form-data">
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
                 <td style = "text-align:left;">{{$card->form_id}}</td>

                 <td style = "text-align:left;">{{$card->near_station}}</td>
                 <input type="hidden" value = "Yes" id="dispatch" name= "dispatch"/>
                 <td style = "text-align:center;">
                 <button type="submit" class="btn btn-dark" style = "">Dispatch
                 </button>
</td>

</form>
                </td>
                 
</tr>

@endif 
<?php 
        
        $i++; ?>
</tbody>
</form> 
@endforeach

         
</table>
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
