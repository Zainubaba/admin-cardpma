@extends('head_institute.master')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg mb-4">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0">Add New Organization</h5>
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

            {{-- Add Organization Form --}}
            <form action="{{ route('institute.organizations.store') }}" method="POST">
                @csrf

                {{-- Organization Name --}}
                <div class="form-group">
                    <label for="org_name">Organization Name</label>
                    <input 
                        type="text" 
                        name="org_name" 
                        id="org_name" 
                        class="form-control" 
                        placeholder="Enter organization name" 
                        required
                    >
                </div>

                {{-- District --}}
                <div class="form-group">
                    <label for="district_id">District</label>
                    <select 
                        name="district_id" 
                        id="district_id" 
                        class="form-control" 
                        required
                    >
                        <option value="">-- Select District --</option>
                        @foreach($districts as $district)
                            <option value="{{ $district->id }}">{{ $district->name }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Tehsil --}}
                <div class="form-group">
                    <label for="tehsil_id">Tehsil</label>
                    <select 
                        name="tehsil_id" 
                        id="tehsil_id" 
                        class="form-control" 
                        required
                    >
                        <option value="">-- Select Tehsil --</option>
                        @foreach($tehsils as $tehsil)
                            <option value="{{ $tehsil->id }}">{{ $tehsil->tehsil_name }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Institute Type --}}
                <div class="form-group">
                    <label for="institute_type">Institute Type</label>
                    <select 
                        name="institute_type" 
                        id="institute_type" 
                        class="form-control" 
                        required
                    >
                        <option value="">-- Select Type --</option>
                        <option value="1">Public</option>
                        <option value="2">Private</option>
                    </select>
                </div>

                {{-- Education Level --}}
                <div class="form-group">
                    <label for="edu_level">Education Level</label>
                    <select 
                        name="edu_level" 
                        id="edu_level" 
                        class="form-control" 
                        required
                    >
                        <option value="">-- Select Education Level --</option>
                        @foreach($edu_levels as $edu)
                            <option value="{{ $edu->id }}">{{ $edu->name }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- HOD --}}
                <div class="form-group">
                    <label for="hod">Head of Department (HOD)</label>
                    <select 
                        name="hod_id" 
                        id="hod" 
                        class="form-control" 
                        required
                    >
                        <option value="">-- Select HOD --</option>
                        @foreach($hods as $hod)
                            <option value="{{ $hod->id }}">{{ $hod->name }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Submit Button --}}
                <div class="text-right">
                    <button type="submit" class="btn btn-success px-4">
                        {{-- <i class="fas fa-building mr-1"> --}}
                            {{-- </i>  --}}
                            Add Organization
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
