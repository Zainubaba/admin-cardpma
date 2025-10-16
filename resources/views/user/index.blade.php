{{-- responsive done --}}
@extends('design_main.master')
@section('content')
    <style>
        @media screen and (max-width: 2000px) {

            .account {
                margin-left: 500px;
                width: 500px;
            }

            .pull-left {
                width: 400px;
            }

        }
        /* //////////////////////////////////// */
@media screen and (min-width:700px)and (max-width:1015px){
    .account{
        margin-left: 255px;
        width: 60%;
    }
    .pull-left{
        width: 400px;
    }
}
/* ///////////////////////////////////////////// */
@media screen and (max-width:699px){
    .account{
        margin-left: 150px;
        width: 500px;
    }

}
/* ///////////////////////// */
@media screen  and (max-width:665px){
    .account{
        margin-left: 200px;
        width: 100px;
    }
    .pull-left{
        width: 350px;
    }
}
        @media screen and (max-width: 600px) {

            .account {
                margin-left: 200px;
                width: 350px;

            }

            .pull-left {
                width: 350px;

            }
        }

        @media screen and (max-width:425px){
            .account{
                width: 10px;
                margin-top: 10px;
                margin-left: 30px;
            }
            .pull-left{
                width: 350px;
            }
        }
        @media screen and (max-width:375px){
            .account{
               width: 20%;
                margin-left: 100px;
            }
            .pull-left h2{
                width: 240px;
                font-size: 20px;
                /* margin-left: 10px; */

            }
        }
        @media screen and (max-width:320px){
            .account{
               width: 20%;
                margin-left: 10px;
            }
            .pull-left h2{
                width: 240px;
                font-size: 20px;
                /* margin-left: 10px; */

            }
        }
    </style>

    <div class="account" >
        <div class="row">

            <div class="col-sm-9">
                <div class="pull-left">
                    <h2
                        style="color: white; border:1px; border-radius:5px; height:50px; text-align:center; background-color:rgba(19, 14, 65, 0.6) ">
                        Account Managment</h2>
                </div>

            </div>
        </div>

@foreach ($user as $user)

        <table class="table" style="background-color: rgba(56, 53, 78, 0.6); border-radius:10px;">

            <tr>
                <th style="color: white">Passenger Name:</th>
                <td> {{ $user->name }}</td>
            </tr>
            <tr>
                <th style="color: white">Contact#</th>
                <td> {{ $user->phone_number }}</td>
            </tr>
            <tr>
                <th style="color: white">CNIC:</th>
                <td> {{ $user->cnic }}</td>
            </tr>

            <tr>
                <th style="color: white">City:</th>
                <td> {{ $user->dis_name }}</td>
            </tr>
            <tr>
                <th style="color: white">Email:</th>
                <td> {{ $user->email }}</td>
            </tr>

@endforeach

        </table>
        <a class="btn btn-dark" style="margin-left:80%; margin-bottom:5%; background-color:rgba(19, 14, 65, 0.6)   "
            href="edit/{{ $user->uid }}">Edit</a>



    </div>
@endsection
