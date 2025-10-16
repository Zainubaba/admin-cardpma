@extends('depot.master')
@section('content')	
                        

<?php
 $i = 1;
?> 

<div class="container mt-4" style="margin-left:260px; padding-top:10px">
<div class="card" style="width:1000px;">
    <div class="card-body" >
        <div class="row">

           

       
                 <div class="col-md-12 ">
                <h2 class="pt-2 pb-3 text-center font-bold font-up danger-text">LIST OF PASSENGERS

</h2></div>

          
        
<table id="Btable" class="table table-bordered red-border text-center"  style="margin-left:20px; margin-right:20px; margin-top:20px;">
    
    <form action="/stationsort" method="GET">
        @csrf
        <select onchange="this.form.submit()" name="station">
            <option value="Select one option" selected>Select one option</option>
                @foreach ($sta as $key => $value)
                    <option value="{{ $value->station_name }}" >{{ $value->station_name }}</option>
                @endforeach
        </select>
    </form>
   

    <div class="search-container" style="margin-left:700px;">
        <form action="/verifysearch" method="POST">
            @csrf
          <input type="text" placeholder="Search by CNIC.." name="search">
          <button type="submit"><i class="fa fa-search"></i></button>
        </form>
  
          </div>
            <thead style="background-color: rgba(19, 14, 65, 0.6); color:white;" >
                <tr>
                <th style= "text-align:center;"><strong>Sr#</strong></th>
                <th style= "text-align:center;"><strong>Passenger Name</strong></th>
                    <th style= "text-align:center;"><strong>CNIC</strong></th>
                    <th style= "text-align:center;"><strong >Form ID</strong></th>
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
                 <form class="form-register" id="form-register" action="/verified/{id}" method="get" enctype="multipart/form-data">
@csrf       
                 @if(is_null($card->vcf))
                 <td style = "text-align:center;"> {{$i}}</td>
                 
                 <td style = "text-align:center;"> {{$card->name}}</td>

                 <td style = "text-align:center;">{{$card->cnic}}</td>

                 <td style = "text-align:center;">{{$card->form_id}}</td>

                 <td style = "text-align:center;">{{$card->pickup_station}}</td>
                 
                 <td style = "text-align:center;">
                 @if(is_null($card->vcf))
                 <a href="/verifiedform/{{$card->cid}}" style= "border: 1px solid; background-color:rgba(19, 14, 65, 0.6); color:white; padding:2px;">View Form</a>
                @endif
                </td>
                @endif
</tr>
<?php 
        
        $i++; ?>
</tbody>
</form> 
@endforeach

            
</table>
{{
    $cardforms->appends(request()->query())->links()
    }}
@endsection

