@extends('head_institute.master')

@section('content')

<!-- Google Font: Inter -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/css/all.min.css">

<!-- DevExtreme -->
<link rel="stylesheet" href="https://cdn3.devexpress.com/jslib/23.1.3/css/dx.light.css">
<script src="https://cdn3.devexpress.com/jslib/23.1.3/js/jquery.min.js"></script>
<script src="https://cdn3.devexpress.com/jslib/23.1.3/js/jszip.min.js"></script>
<script src="https://cdn3.devexpress.com/jslib/23.1.3/js/dx.all.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdn3.devexpress.com/jslib/23.1.3/js/exceljs.min.js"></script>

<style>
    body {
        font-family: 'Inter', sans-serif;
    }

    .pagination .page-link {
        color: #28a745;
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
</style>

<div class="container py-4">

    {{-- Flash message --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    @endif

    {{-- Manage Users Section --}}
    <div id="manageUsersSection">
        <div class="card mb-4">
            <div class="card-header bg-success text-white">
                Manage Users
            </div>

            <div class="card-body">
                <div id="userGrid" class="mt-3"></div>
            </div>
        </div>
    </div>

    {{-- Edit User Modals --}}
    @foreach ($roleTwoUsers as $user)
        <div class="modal fade" id="editUserModal{{ $user->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <form action="{{ route('institute.users.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-content">
                        <div class="modal-header bg-success text-white">
                            <h5 class="modal-title">Edit User</h5>
                            <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
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
                                <label>New Password (optional)</label>
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
    @endforeach

</div>

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

            sorting: { mode: "multiple" },
            paging: { pageSize: 10 },
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
                allowSearch: true
            },
            export: {
                enabled: true,
                formats: ['pdf', 'xlsx']
            },
            onExporting(e) {
                try {
                    if (e.format === 'xlsx') {
                        const workbook = new ExcelJS.Workbook();
                        const worksheet = workbook.addWorksheet('Users');
                        DevExpress.excelExporter.exportDataGrid({
                            component: e.component,
                            worksheet,
                            autoFilterEnabled: true,
                        }).then(() => {
                            workbook.xlsx.writeBuffer().then(buffer => {
                                saveAs(new Blob([buffer]), 'Users.xlsx');
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
                            doc.save('Users.pdf');
                        });
                        e.cancel = true;
                    }
                } catch (err) {
                    console.error('Export error:', err);
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
                    cellTemplate(container, options) {
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
                            .on('submit', function () { return confirm('Delete this user?'); })
                            .append(`@csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="fas fa-trash-alt mr-1"></i>Delete
                                </button>`)
                            .appendTo(container);
                    }
                }
            ]
        });
    });
</script>

@endsection
