@extends('afc_dashboard.master')
@section('content')

<div class = "account" style="margin-left:500px; width:500px;">
<div class="row">

    <div class="col-md-12">
        <div class="pull-left">
            <h2 style="color: white; border:1px; border-radius:5px;width:400px; height:50px; text-align:center; background-color:#7d0000">Account Management</h2>
        </div>
       
</div>
</div>


<table class="table" style="background-color: white; border-radius:10px;">

 <tr>

   <th>ID:</th>
  <td> </td> 
</tr>
    <tr>
   <th>Passenger Name:</th>
   <td></td> 
</tr>
<tr>
    <th>Contact#</th>
 <td> </td>
</tr>
   <tr><th>CNIC:</th>
   <td> </td> 
</tr>
  
   <tr><th>City:</th>
   <td> </td>
</tr>
<tr><th>Email:</th>
   <td></td>
</tr>

   </table>
   <a class="btn btn-dark" style = "margin-left:80%; margin-bottom:5%" href="">Edit</a>



</div>

@endsection








