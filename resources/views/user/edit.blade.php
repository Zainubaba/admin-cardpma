@extends('design_main.master')
@section('content')

<style>



@media screen and (max-width: 2000px){

.account{
  margin-left:450px;
  width:500px;
}

}
@media screen and (max-width: 500px){

  .account{
  margin-left:40px;
  margin-right:10px;
  width:350px;
  margin-top:50px;

}
}

</style>

@foreach ($user as $user)

<div class = "account" style="">
<form class="edit-account"  id="edit-account" action ="{{ route('update',$user->uid) }}"  method="post">

            @method('patch')
@csrf

<div class="row">

    <div class="col-md-12">
        <div class="pull-left">
            <h2 style="color: white; border:1px; border-radius:5px;width:250px; height:50px; text-align:center; background-color:#565985">Edit Account</h2>
        </div>

</div>
</div>


@if (count($errors) > 0)
  <div class="alert alert-danger">
    <strong>Whoops!</strong> There were some problems with your input.<br><br>
    <ul>
       @foreach ($errors->all() as $error)
         <li>{{ $error }}</li>
       @endforeach
    </ul>
  </div>
@endif



{!! Form::model($user, ['method' => 'PATCH','route' => ['update', $user->uid]]) !!}
<table class="table" style="background-color: rgba(67, 63, 109, 0.6); border-radius:10px; width:500px;">

 <tr>
    <tr>
   <th>Passenger Name:</th>
   <td><input type="text" class="form-control" id="name" name="name" value="{{$user->name}}"> </td>
</tr>
<tr>
    <th>Contact#</th>
    <td> <input type="number" class="form-control" id="phone_number" name="phone_number" value="{{$user->phone_number}}" ></td>
</tr>
   <tr><th>CNIC:</th>
   <td> <input type="number" class="form-control" id="cnic" name="cnic" value="{{$user->cnic}}" ></td>
</tr>

   <tr><th>City:</th>
   <td> <input type="text" class="form-control" id="city" name="city" value="{{$user->dis_name}}"></td>
</tr>
<tr><th>Email:</th>
   <td><input type="text" class="form-control" id="email" name="email" value="{{$user->email}}"  ></td>
</tr>
<tr><th>Password:</th>
   <td>
   {!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control')) !!}
</td>
</tr>
<tr><th>Confirm Password:</th>
   <td>
   {!! Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' => 'form-control')) !!}
</td>
</tr>

@endforeach

   </table>
   <button type="submit" class="btn btn-dark" style = "margin-left:80%; margin-bottom:5%; background-color:#565985" href="">Update</button>
</form>

@endsection
