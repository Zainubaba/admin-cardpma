@extends('head_institute.master')



@section('content')
<div class="container-fluid mt-5">
    <div class="card shadow-lg mb-4">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0">Add New User</h5>
        </div>
        <div class="card-body">
            {{-- Validation Errors --}}
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Add User Form --}}
            <form action="{{ route('institute.users.store') }}" method="POST">
                @csrf
                <div class="form-row">
                    {{-- Name --}}
                    <div class="form-group col-md-6">
                        <label for="name">Full Name</label>
                        <input 
                            type="text" 
                            name="name" 
                            id="name" 
                            class="form-control" 
                            placeholder="Enter full name" 
                            required
                        >
                    </div>

                    {{-- Email --}}
                    <div class="form-group col-md-6">
                        <label for="email">Email Address</label>
                        <input 
                            type="email" 
                            name="email" 
                            id="email" 
                            class="form-control" 
                            placeholder="Enter email address" 
                            required
                        >
                    </div>

                    {{-- Password --}}
                    <div class="form-group col-md-6">
                        <label for="password">Password</label>
                        <input 
                            type="password" 
                            name="password" 
                            id="password" 
                            class="form-control" 
                            placeholder="Enter password" 
                            required
                        >
                    </div>

                    {{-- Confirm Password --}}
                    <div class="form-group col-md-6">
                        <label for="password_confirmation">Confirm Password</label>
                        <input 
                            type="password" 
                            name="password_confirmation" 
                            id="password_confirmation" 
                            class="form-control" 
                            placeholder="Re-enter password" 
                            required
                        >
                    </div>

                    {{-- Phone Number --}}
                    <div class="form-group col-md-6">
                        <label for="phone_number">Phone Number</label>
                        <input 
                            type="text" 
                            name="phone_number" 
                            id="phone_number" 
                            class="form-control" 
                            placeholder="03XX-XXXXXXX" 
                            required
                        >
                    </div>

                    {{-- CNIC --}}
                    <div class="form-group col-md-6">
                        <label for="cnic">CNIC</label>
                        <input 
                            type="text" 
                            name="cnic" 
                            id="cnic" 
                            class="form-control" 
                            placeholder="XXXXX-XXXXXXX-X" 
                            required
                        >
                    </div>

                    {{-- Organization --}}
                    <div class="form-group col-md-6">
                        <label for="org_name">Organization</label>
                        <select 
                            name="org_name" 
                            id="org_name" 
                            class="form-control" 
                            required
                        >
                            <option value="">-- Select Organization --</option>
                            @foreach($allOrganizations as $organization)
                                <option value="{{ $organization->org_name }}">
                                    {{ $organization->org_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="text-right">
                    <button type="submit" class="btn btn-success px-4">
                        {{-- <i class="fas fa-user-plus mr-1"></i>  --}}
                        Add User
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

