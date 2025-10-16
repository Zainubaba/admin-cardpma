@extends('head_institute.master')

@section('content')

<!-- Google Font: Inter -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/css/all.min.css">

<!-- AdminLTE CSS -->
{{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css"> --}}

<!-- Apply Inter font globally -->
<style>
    body {
        font-family: 'Inter', sans-serif;
    }

    .pagination .page-link {
        color: #28a745;  /* Bootstrap 'success' green */
    }

    .pagination .page-link:hover {
        background-color: #28a745;
        color: white;
    }

    .pagination .active .page-link {
        background-color: #28a745;
        border-color: #28a745;
        color: white;
    }
 .dx-datagrid-headers .dx-header-row > td {
        background-color: #e0f0ff; 
        color: #000;
        font-weight: bold;
        text-align: center !important;
    }


    .dx-datagrid .dx-data-row > td {
        text-align: center;
    }

    
    .dx-sort-up::after,
    .dx-sort-down::after {
        color: #000;
    }

</style>

<!-- DevExtreme -->
<link rel="stylesheet" href="https://cdn3.devexpress.com/jslib/23.1.3/css/dx.light.css">
<script src="https://cdn3.devexpress.com/jslib/23.1.3/js/jquery.min.js"></script>
<script src="https://cdn3.devexpress.com/jslib/23.1.3/js/jszip.min.js"></script>
<script src="https://cdn3.devexpress.com/jslib/23.1.3/js/dx.all.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdn3.devexpress.com/jslib/23.1.3/js/exceljs.min.js"></script>


<div class="container py-4">
    {{-- Flash Message --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif


    <div id="addUserSection" style="display: none;">  {{-- hidden --}}
    {{-- Add New User --}}
    <div class="card mb-4">
        <div class="card-header bg-success text-white">
            Add New User
        </div>
        <div class="card-body">
            @if($errors->any())
    <div class="text-red-500 bg-red-100 border border-red-300 p-2 rounded mb-4">
        <ul class="list-disc pl-4">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

            <form action="{{ route('institute.users.store') }}" method="POST">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="password_confirmation">Confirm Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="phone_number">Phone Number</label>
                        <input type="text" name="phone_number" id="phone_number" class="form-control" required>
                    </div>
                    <div class="form-group col-md-6">
    <label for="cnic">CNIC</label>
    <input type="text" name="cnic" id="cnic" class="form-control" required>
</div>
<div class="form-group col-md-6">
    <label for="org_name">Organization</label>
    <select name="org_name" id="org_name" class="form-control" required>
        <option value="">-- Select Organization --</option>
        @foreach($allOrganizations as $organization)
            <option value="{{ $organization->org_name }}">{{ $organization->org_name }}</option>
        @endforeach
    </select>
</div>

                </div>
                <button type="submit" class="btn btn-success">
                    <i class=""></i> Add User
                </button>
            </form>
        </div>
    </div>
    </div>

<div id="manageUsersSection" style="display: none;">  {{-- hidden --}}
    {{-- Manage Users --}}
    <div class="card mb-4">
        <div class="card-header bg-success text-white">
            Manage Users
        </div>


        
        {{-- <div class="card-body table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="thead-light">
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th style="width: 160px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                   @forelse($roleTwoUsers as $user)
    <tr>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>{{ $user->phone_number }}</td>
        <td class="d-flex">
            <!-- Edit button (triggers modal) -->
            <button type="button" class="btn btn-sm btn-success mr-2" data-toggle="modal" data-target="#editUserModal{{ $user->id }}">
                <i class="fas fa-edit mr-1"></i> Edit
            </button>

            <!-- Delete form -->
            <form action="{{ route('institute.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Delete this user?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger">
                    <i class="fas fa-trash-alt mr-1"></i> Delete
                </button>
            </form>
        </td>
    </tr> --}}
    <div id="userGrid" class="mt-4"></div>

<!-- Include modals for each user -->
{{-- @foreach ($roleTwoUsers as $user) --}}
    {{-- @include('partials.edit_user_modal', ['user' => $user]) --}}
{{-- @endforeach  --}}

<script>
    $(function () {
        const users = @json($roleTwoUsers);

        $("#userGrid").dxDataGrid({
            dataSource: users,
            keyExpr: "id",
            showBorders: true,
            columnAutoWidth: true,
            allowColumnResizing: true,
            allowColumnReordering: true,
            sorting: {
                mode: 'multiple'
            },
            paging: {
                pageSize: 10
            },
            pager: {
                showPageSizeSelector: true,
                allowedPageSizes: [5, 10, 20],
                showInfo: true
            },
            searchPanel: {
                visible: true,
                width: 240,
                placeholder: "Search..."
            },
                                headerFilter: {
    visible: true,
    allowSearch: true,
    showRelevantValues: true,
},
            export: {
                        enabled: true,
                        formats: ['pdf', 'xlsx'],
                    },

                onExporting(e) {
    try {
        if (e.format === 'xlsx') {
            const workbook = new ExcelJS.Workbook();
            const worksheet = workbook.addWorksheet('Institutes');
            DevExpress.excelExporter.exportDataGrid({
                component: e.component,
                worksheet,
                autoFilterEnabled: true,
            }).then(() => {
                workbook.xlsx.writeBuffer().then((buffer) => {
                    saveAs(new Blob([buffer], {
                        type: 'application/octet-stream'
                    }), 'Institutes.xlsx');
                });
            });
            e.cancel = true; 
        } else if (e.format === 'pdf') {
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF();
            DevExpress.pdfExporter.exportDataGrid({
                jsPDFDocument: doc,
                component: e.component,
            }).then(() => {
                doc.save('Institutes.pdf');
            });
            e.cancel = true;
        }
    } catch (error) {
        console.error('Export error:', error);
    }
},


            columns: [
                { dataField: "name", caption: "Name", alignment: "center" },
                { dataField: "email", caption: "Email", alignment: "center" },
                { dataField: "phone_number", caption: "Phone", alignment: "center" },
                {
                    caption: "Actions",
                    alignment: "center",
                    width: 180,
                    
                    cellTemplate: function (container, options) {
                        const id = options.data.id;

                        $('<button>')
                            .addClass('btn btn-sm btn-success mr-2')
                            .html('<i class="fas fa-edit mr-1"></i>Edit')
                            .attr('data-toggle', 'modal')
                            .attr('data-target', '#editUserModal' + id)
                            .appendTo(container);

                        $('<form>')
                            .attr('action', '/institute/users/' + id)
                            .attr('method', 'POST')
                            .addClass('d-inline')
                            .on('submit', function () {
                                return confirm('Delete this user?');
                            })
                            .append(`
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="fas fa-trash-alt mr-1"></i>Delete
                                </button>
                            `).appendTo(container);
                    }
                }
            ]
        });
    });
</script>


    <!-- Edit Modal -->
    @foreach ($roleTwoUsers as $user)
    <div class="modal fade" id="editUserModal{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="editUserLabel{{ $user->id }}" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{ route('institute.users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title" id="editUserLabel{{ $user->id }}">Edit User</h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" value="{{ $user->name }}" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" value="{{ $user->email }}" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Phone</label>
                            <input type="text" name="phone_number" value="{{ $user->phone_number }}" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>CNIC</label>
                            <input type="text" name="cnic" value="{{ $user->cnic }}" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>New Password (leave blank to keep current)</label>
                            <input type="password" name="password" class="form-control">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Update</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
{{-- @empty
    <tr>
        <td colspan="4" class="text-center text-muted">No users found.</td>
    </tr>
@endforelse
                </tbody>
            </table>
        </div> --}}
    </div>
    </div>

    @endforeach
    
<div id="addOrganizationSection" style="display: none;"> {{-- hidden --}}
    {{-- Add New Organization --}}
<div class="card mb-4">
    <div class="card-header bg-success text-white">
        Add New Organization
    </div>
    <div class="card-body">
        <form action="{{ route('institute.organizations.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="org_name">Organization Name</label>
                <input type="text" name="org_name" id="org_name" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="district_id">District</label>
                <select name="district_id" id="district_id" class="form-control" required>
                    @foreach($districts as $district)
                        <option value="{{ $district->id }}">{{ $district->name }}</option>
                    @endforeach
                </select>
            </div>

 <div class="form-group">
                <label for="tehsil_id">Tehsil</label>
                <select name="tehsil_id" id="tehsil_id" class="form-control" required>
                    @foreach($tehsils as $tehsil)
                        <option value="{{ $tehsil->id }}">{{ $tehsil->tehsil_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="institute_type">Institute Type</label>
                <select name="institute_type" id="institute_type" class="form-control" required>
                    <option value="1">Public</option>
                    <option value="2">Private</option>
                </select>
            </div>
            <div class="form-group">
    <label for="edu_level">Education Level</label>
    <select name="edu_level" id="edu_level" class="form-control" required>
        <option value="">Select Education Level</option>
        @foreach($edu_levels as $edu)
            <option value="{{ $edu->id }}">{{ $edu->name }}</option>
        @endforeach
    </select>
</div>
       <div class="form-group">
    <label for="hod">HOD</label>
    <select name="hod_id" id="hod" class="form-control" required>
        <option value="">Select Education Level</option>
        @foreach($hods as $hod)
            <option value="{{ $hod->id }}">{{ $hod->name }}</option>

        @endforeach
    </select>
</div>

            <button type="submit" class="btn btn-success">
                <i class=""></i> Add Organization
            </button>
        </form>
    </div>
</div>
</div>

<div id="manageOrganizationsSection" style="max-width: 1000px; margin: auto;" style="display: none;">
{{-- Manage Organizations --}}
    <div class="card mb-4">
        <div class="card-header bg-success text-white">
            Manage Organizations
        </div>
        {{-- <div class="card-body table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="thead-light">
                    <tr>
                        <th>Organization Name</th>
                        <th>District</th>
                        <th style="width: 160px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($organizations as $org)
                        <tr>
                            <td>{{ $org->org_name }}</td>
                            <td>{{ $org->district->name ?? 'N/A' }}</td>
                            <td class="d-flex">
                                <button type="button" class="btn btn-sm btn-success mr-2" data-toggle="modal" data-target="#editModal{{ $org->id }}">
                                    <i class="fas fa-edit mr-1"></i> Edit
                                </button>

                                <form action="{{ route('institute.organizations.destroy', $org->id) }}" method="POST" onsubmit="return confirm('Delete this organization?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash-alt mr-1"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr> --}}
<div id="organizationGrid" class="mt-4"></div>



                        <script>
                            const organizations = @json($organizations);
    $(function () {
        $("#organizationGrid").dxDataGrid({
            dataSource: organizations,
            keyExpr: "id",
            showBorders: true,
            columnAutoWidth: true,
            paging: {
                pageSize: 10
            },
            pager: {
                showPageSizeSelector: true,
                allowedPageSizes: [5, 10, 20],
                showInfo: true
            },
            searchPanel: {
                visible: true,
                width: 240,
                placeholder: "Search organizations..."
            },
            
            headerFilter: {
                visible: true,
                allowSearch: true
            },
            
            sorting: {
                mode: "multiple"
            },

 export: {
                        enabled: true,
                        formats: ['pdf', 'xlsx'],
                    },

                onExporting(e) {
    try {
        if (e.format === 'xlsx') {
            const workbook = new ExcelJS.Workbook();
            const worksheet = workbook.addWorksheet('Institutes');
            DevExpress.excelExporter.exportDataGrid({
                component: e.component,
                worksheet,
                autoFilterEnabled: true,
            }).then(() => {
                workbook.xlsx.writeBuffer().then((buffer) => {
                    saveAs(new Blob([buffer], {
                        type: 'application/octet-stream'
                    }), 'Institutes.xlsx');
                });
            });
            e.cancel = true; 
        } else if (e.format === 'pdf') {
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF();
            DevExpress.pdfExporter.exportDataGrid({
                jsPDFDocument: doc,
                component: e.component,
            }).then(() => {
                doc.save('Institutes.pdf');
            });
            e.cancel = true;
        }
    } catch (error) {
        console.error('Export error:', error);
    }
},

            columns: [
                {
                    dataField: "org_name",
                    caption: "Organization Name",
                    alignment: "center"
                },
                {
                    dataField: "district.name", // nested relation
                    caption: "District",
                    alignment: "center"
                },
                {
                    caption: "Actions",
                    alignment: "center",
                    width: 180,
                    allowFiltering: false,
                    cellTemplate: function (container, options) {
                        const id = options.data.id;

                        $('<button>')
                            .addClass('btn btn-sm btn-success mr-2')
                            .html('<i class="fas fa-edit mr-1"></i>Edit')
                            .attr('data-toggle', 'modal')
                            .attr('data-target', '#editModal' + id)
                            .appendTo(container);

                        const form = $('<form>', {
                            action: `/institute/organizations/${id}`,
                            method: 'POST',
                            class: 'd-inline',
                            onsubmit: 'return confirm("Delete this organization?");'
                        });

                        form.append('@csrf')
                            .append('@method("DELETE")')
                            .append(`
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="fas fa-trash-alt mr-1"></i>Delete
                                </button>
                            `);

                        container.append(form);
                    }
                }
            ]
        });
    });
</script>

@foreach ($organizations as $org)
                        {{-- Edit Modal --}}
                        <div class="modal fade" id="editModal{{ $org->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel{{ $org->id }}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <form action="{{ route('institute.organizations.update', $org->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-content">
                                        <div class="modal-header bg-success text-white">
                                            <h5 class="modal-title">Edit Organization</h5>
                                            <button type="button" class="close text-white" data-dismiss="modal">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="org_name_{{ $org->id }}">Organization Name</label>
                                                <input type="text" name="org_name" class="form-control" value="{{ $org->org_name }}" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="district_id_{{ $org->id }}">District</label>
                                                <select name="district_id" class="form-control" required>
                                                    @foreach($districts as $district)
                                                        <option value="{{ $district->id }}" {{ $district->id == $org->district_id ? 'selected' : '' }}>
                                                            {{ $district->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group">
                <label for="tehsil_id">Tehsil</label>
                <select name="tehsil_id" id="tehsil_id" class="form-control" required>
                    @foreach($tehsils as $tehsil)
                        <option value="{{ $tehsil->id }}">{{ $tehsil->tehsil_name }}</option>
                    @endforeach
                </select>
            </div>

                                            <div class="form-group">
                                                <label for="institute_type_{{ $org->id }}">Institute Type</label>
                                                <select name="institute_type" class="form-control" required>
                                                    <option value="Public" {{ $org->institute_type == 'Public' ? 'selected' : '' }}>Public</option>
                                                    <option value="Private" {{ $org->institute_type == 'Private' ? 'selected' : '' }}>Private</option>
                                                </select>
                                            </div>
                                        </div>
     <div class="form-group">
    <label for="hod_{{ $org->id }}">HOD</label>
    <select class="form-control" name="hod_id" id="hod_{{ $org->id }}" required>
        @foreach($hods as $hod)
            <option value="{{ $hod->id }}">{{ $hod->name }}</option>

        @endforeach
    </select>
</div>


                                        <div class="form-group">
    <label for="edu_level_{{ $org->id }}">Education Level</label>
    <select class="form-control" name="edu_level" id="edu_level_{{ $org->id }}" required>
        @foreach($edu_levels as $edu)
            <option value="{{ $edu->name }}" {{ $org->edu_level == $edu->name ? 'selected' : '' }}>
                {{ $edu->name }}
            </option>
        @endforeach
    </select>
</div>

                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-success">Save Changes</button>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    {{-- @empty
                        <tr>
                            <td colspan="3" class="text-center text-muted">No organizations found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table> --}}
        </div>
@endforeach        

        {{-- <div class="d-flex justify-content-center mt-3">
            {{ $organizations->links() }}
        </div> --}}
    </div>
</div>
</div>

<script>
    function showSection(sectionId) {

   
        const sections = [
            'addUserSection',
            'manageUsersSection',
            'addOrganizationSection',
            'manageOrganizationsSection'
        ];

        sections.forEach(id => {
            const el = document.getElementById(id);
            if (el) el.style.display = 'none';
        });

        const target = document.getElementById(sectionId);
        if (target) {
            target.style.display = 'block';
            target.scrollIntoView({ behavior: 'smooth' });
        }
    }
</script>
<script>
window.addEventListener('DOMContentLoaded', () => {
    const params = new URLSearchParams(window.location.search);
    const section = params.get('section');
    if (section) {
        showSection(section);
    }
});
</script>




@endsection
