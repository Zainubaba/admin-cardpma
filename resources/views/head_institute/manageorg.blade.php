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

    {{-- Flash Message --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    @endif

    {{-- Manage Organizations --}}
    <div id="manageOrganizationsSection">
        <div class="card mb-4">
            <div class="card-header bg-success text-white">
                Manage Organizations
            </div>

            <div class="card-body">
                <div id="organizationGrid" class="mt-3"></div>
            </div>
        </div>
    </div>

    {{-- Edit Organization Modals --}}
    @foreach ($allOrganizations as $org)
        <div class="modal fade" id="editOrgModal{{ $org->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <form action="{{ route('institute.organizations.update', $org->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-content">
                        <div class="modal-header bg-success text-white">
                            <h5 class="modal-title">Edit Organization</h5>
                            <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                        </div>

                        <div class="modal-body">
                            <div class="form-group">
                                <label>Organization Name</label>
                                <input type="text" name="org_name" value="{{ $org->org_name }}" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label>District</label>
                                <select name="district_id" class="form-control" required>
                                    @foreach($districts as $district)
                                        <option value="{{ $district->id }}" {{ $org->district_id == $district->id ? 'selected' : '' }}>
                                            {{ $district->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Tehsil</label>
                                <select name="tehsil_id" class="form-control" required>
                                    @foreach($tehsils as $tehsil)
                                        <option value="{{ $tehsil->id }}" {{ $org->tehsil_id == $tehsil->id ? 'selected' : '' }}>
                                            {{ $tehsil->tehsil_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Institute Type</label>
                                <select name="institute_type" class="form-control" required>
                                    <option value="1" {{ $org->institute_type == 1 ? 'selected' : '' }}>Public</option>
                                    <option value="2" {{ $org->institute_type == 2 ? 'selected' : '' }}>Private</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Education Level</label>
                                <select name="edu_level" class="form-control" required>
                                    @foreach($edu_levels as $edu)
                                        <option value="{{ $edu->id }}" {{ $org->edu_level == $edu->id ? 'selected' : '' }}>
                                            {{ $edu->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>HOD</label>
                                <select name="hod_id" class="form-control" required>
                                    @foreach($hods as $hod)
                                        <option value="{{ $hod->id }}" {{ $org->hod_id == $hod->id ? 'selected' : '' }}>
                                            {{ $hod->name }}
                                        </option>
                                    @endforeach
                                </select>
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
        const organizations = @json($allOrganizations);

        $("#organizationGrid").dxDataGrid({
            dataSource: organizations,
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
                placeholder: "Search organization..."
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
                        const worksheet = workbook.addWorksheet('Organizations');
                        DevExpress.excelExporter.exportDataGrid({
                            component: e.component,
                            worksheet,
                            autoFilterEnabled: true,
                        }).then(() => {
                            workbook.xlsx.writeBuffer().then(buffer => {
                                saveAs(new Blob([buffer]), 'Organizations.xlsx');
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
                            doc.save('Organizations.pdf');
                        });
                        e.cancel = true;
                    }
                } catch (err) {
                    console.error('Export error:', err);
                }
            },
            columns: [
                { dataField: "org_name", caption: "Organization Name", alignment: "center" },
                { dataField: "district_name", caption: "District", alignment: "center" },
                { dataField: "tehsil_name", caption: "Tehsil", alignment: "center" },
                { dataField: "institute_type", caption: "Type", alignment: "center",
                  calculateCellValue: d => d.institute_type == 1 ? 'Public' : 'Private' },
                { dataField: "edu_level_name", caption: "Education Level", alignment: "center" },
                { dataField: "hod_name", caption: "HOD", alignment: "center" },
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
                            .attr('data-target', '#editOrgModal' + id)
                            .appendTo(container);

                        $('<form>')
                            .attr('action', '/institute/organizations/' + id)
                            .attr('method', 'POST')
                            .addClass('d-inline')
                            .on('submit', function () { return confirm('Delete this organization?'); })
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
