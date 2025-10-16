@extends('admin.master')
@section('content')	
                        

<?php
 $i = 1;
?> 

<div class="container mt-4" style="margin-left:400px;">
<div class="card" style="width:900px;">
    <div class="card-body" >
        <div class="row">

           

       
                 <div class="col-md-12">
                <h2 class="pt-2 pb-3 text-center font-bold font-up danger-text">PASSENGERS PAYMENT LIST

</h2></div>

          
        
<table id="Btable" class="table table-bordered red-border text-center"  style="margin-left:20px; margin-right:20px; margin-top:20px;">


            <thead >
                <tr>
                <th style= "text-align:center;"><strong>Sr#</strong></th>
                <th style= "text-align:center;"><strong>Category</strong></th>
                <th style= "text-align:center;"><strong>Passenger Name</strong></th>
                    <th style= "text-align:center;"><strong>CNIC</strong></th>
                    <th style= "text-align:center;"><strong >Station Name</strong></th>
                 </tr>
                 </thead>
                 
                              
     <tbody>  
     <?php 
        $i=1;
         ?>
  
                 <tr>
                 @foreach($cardforms as $card)          
                 <form class="form-register" id="form-register" method="get" enctype="multipart/form-data">
@csrf       

                 <td style = "text-align:center;"> {{$i}}</td>

                 @foreach ($category as $categor)
                 @if($card->category == $categor->id)
                 <td style = "text-align:left;"> {{$categor->name}}</td>
                 @endif
                 @endforeach
                 
                 <td style = "text-align:left;"> {{$card->name}}</td>

                 <td style = "text-align:left;">{{$card->cnic}}</td>

                 <td style = "text-align:left;">{{$card->near_station}}</td>
                                  
                
</tr>
<?php 
        
        $i++; ?>
</tbody>
</form> 
@endforeach

            
</table>
@endsection