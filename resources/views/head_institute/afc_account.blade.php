@extends('afc_dashboard.master')
@section('content')

<div class = "" style="margin-left:500px; width:500px;">
<div class="row">

    <div class="col-md-12">
        <div class="pull-left">
            <h2 style="color: white; border:1px; border-radius:5px;width:200px; height:50px; text-align:center; background-color:#7d0000">AFC Account</h2>
        </div>
       
</div>
</div>
<table class="table" style="background-color: white; border-radius:10px;">

    <tr>
   <th>Passenger Name:</th>
   <td> </td>
</tr>
<tr>
    <th>Payment Receipt:</th>
    <td></td>
</tr>
   <tr><th>Date:</th>
   <td></td>
</tr>
<tr>
   <th> Station:</th>
   <td> </td>
</tr>
<tr>
   <th> Email Address:</th>
   <td> </td>
</tr>
<tr>
   <th> Phone Number:</th>
   <td> </td>
</tr>
  

   </table>
   <button type="submit" class="btn btn-dark" style = "margin-left:20%;">Approved</button>
   <button type="submit" class="btn btn-dark" style = "margin-right:%;";>Disapproved</button>



</div>



@endsection