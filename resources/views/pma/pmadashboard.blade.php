@extends('pma.design.master')
@section('content')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>


<style>
    .loader-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        display: none;
        justify-content: center;
        align-items: center;
        z-index: 9999;
    }

    .hourglass-loader {
        position: relative;
        width: 80px;
        height: 120px;
        transform: rotate(0deg); /* Adjusted to match upright hourglass */
    }

    .hourglass-loader::before,
    .hourglass-loader::after {
        content: '';
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
        width: 60px;
        height: 60px;
        background: #fff;
        border: 10px solid #4A90E2;
        border-radius: 50%;
    }

    .hourglass-loader::before {
        top: 0;
        border-bottom-color: transparent;
    }

    .hourglass-loader::after {
        bottom: 0;
        border-top-color: transparent;
    }

    .hourglass-loader .sand {
        position: absolute;
        top: 50%;
        left: 50%;
        width: 40px;
        height: 0;
        background: #F39C12;
        transform: translate(-50%, -50%);
        animation: dropSand 2s infinite linear;
    }

    @keyframes dropSand {
        0% { height: 0; }
        50% { height: 40px; }
        100% { height: 0; }
    }
    #gridContainer {
    width: 1050px;
}
@media (max-width: 3024px) {
    #gridContainer {
        width: 1200px;
        overflow-x: auto;
    }
}


@media (max-width: 600px) {
    #gridContainer, #pending-gridContainer, #inst-gridContainer, #verified-gridContainer, #station-gridContainer {
        width: 100%;
        padding: 0 10px;
        overflow-x: auto;
    }

    #breakdown-panel, #pending-breakdown-panel, #institute-breakdown-panel, #verified-breakdown-panel, #station-breakdown-panel {
    position: relative;
    z-index: 10;
}
.content-header,
.container-fluid,
.row {
    overflow: visible !important;
}


}
/* Light blue background for header cells */
.dx-datagrid-headers .dx-header-row > td {
    background-color: #D6EAF8 !important;  /* light blue */
    color: #000;  /* optional: black text for contrast */
    font-weight: bold; /* optional: make headers stand out */
}


#gridContainer, #pending-gridContainer, #inst-gridContainer, #verified-gridContainer, #station-gridContainer, #handedover-gridContainer {
        width: 1050px;
    }
@media (max-width: 3024px) {
        #gridContainer, #pending-gridContainer, #inst-gridContainer, #verified-gridContainer, #station-gridContainer, #handedover-gridContainer {
            width: 1200px;
            overflow-x: auto;
        }
}
@media (max-width: 600px) {
     #gridContainer, #pending-gridContainer, #inst-gridContainer, #verified-gridContainer, #station-gridContainer, #handedover-gridContainer {
            width: 100%;
            padding: 0 10px;
            overflow-x: auto;
        }
    #breakdown-panel, #pending-breakdown-panel, #institute-breakdown-panel, #verified-breakdown-panel, #station-breakdown-panel, #handedover-breakdown-panel {
            position: relative;
            z-index: 10;
        }
}
#department-breakdown, #pending-department-breakdown, #inst-department-breakdown, #verified-department-breakdown, #station-department-breakdown, #handedover-department-breakdown {
        display: block !important;
        visibility: visible !important;
        opacity: 1 !important;
        min-height: 50px;
    }
.department-tile, .pending-department-subtile, .inst-department-subtile, .verified-department-subtile, .station-department-subtile, .handedover-department-subtile {
        display: inline-block !important;
        visibility: visible !important;
        opacity: 1 !important;
    }

    /* .district-tile, .pending-district-tile, .inst-district-tile, .verified-district-tile, .station-district-tile, .handedover-district-tile {
    max-width: 300px; 
    width: 100%; 
    font-size: 1rem; 
    padding: 0.5rem 1rem; 
} */
/* .btn.district-tile, .btn.pending-district-tile, .btn.inst-district-tile, .btn.verified-district-tile, .btn.station-district-tile, .btn.handedover-district-tile {
    padding: 0.375rem 0.75rem; 
    font-size: 0.9rem; 
} */


</style>

<div class="content-wrapper">
    <!-- Loader Overlay -->
    <div class="loader-overlay" id="loader">
        <div class="hourglass-loader">
            <div class="sand"></div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="content-header">
            <div class="container-fluid">
                <!-- Info Boxes -->
<div class="row">
    <!-- Total Applications -->
    <div class="col-md-4 col-sm-6 col-12">
        <div class="info-box" style="background-color: #4A90E2; color:white; cursor:pointer;"
             onclick="toggleBreakdownPanel('breakdown-panel')">
            <span class="info-box-icon"><i class="fas fa-clipboard-list"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Total Applications</span>
                <span class="info-box-number">{{ $submittedform }}</span>
            </div>
        </div>
        </div>

        

    <!-- Pending at Department -->
    <div class="col-md-4 col-sm-6 col-12">
        <div class="info-box" style="background-color: #F39C12; color:white; cursor:pointer;"
             onclick="toggleBreakdownPanel('pending-breakdown-panel')">
            <span class="info-box-icon" style="color:white;">
                <img src="/images/pending2 (3).png" style="height:80%">
            </span>
            <div class="info-box-content">
                <span class="info-box-text">Pending at Department</span>
                <span class="info-box-number">{{ $pending }}</span>
            </div>
        </div>
        </div>


    <!-- Pending at Institute -->
    <div class="col-md-4 col-sm-6 col-12">
        <div class="info-box" style="background-color: teal; color:white; cursor:pointer;"
             onclick="toggleBreakdownPanel('institute-breakdown-panel')">
            <span class="info-box-icon" style="color:white;">
                <img src="/images/pending2 (1).png" style="height:100%">
            </span>
            <div class="info-box-content">
                <span class="info-box-text">Pending at Institute</span>
                <span class="info-box-number">{{ $pendinginstitute }}</span>
            </div>
        </div>
        </div>
        </div>
        








        <div id="institute-breakdown-panel" style="display:none; margin-top:15px;">
            <div class="row">
                @foreach($institute_districts as $district)
                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                        <button class="btn btn-primary w-100 rounded-pill px-4 py-2 inst-district-tile"
                                data-district="{{ $district->id }}">
                            {{ $district->name }}: {{ $district->total }}
                        </button>
                    </div>
                @endforeach
            </div>
            <div id="inst-department-breakdown" class="mt-1"></div>
            <div id="inst-institute-breakdown" class="mt-1"></div>
            <div class="dx-viewport demo-container mt-1">
                <div class="table-responsive p-0" id="inst-gridContainer"></div>
            </div>
        </div>
    



        <div id="pending-breakdown-panel" style="display:none; margin-top:15px;">
            <div class="row">
                @foreach($districts as $district)
                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                        <button class="btn btn-primary w-100 rounded-pill px-3 py-2 pending-district-tile"
                                data-district="{{ $district->id }}">
                            {{ $district->name }}: {{ $district->total }}
                        </button>
                    </div>
                @endforeach
            </div>
            <div id="pending-department-breakdown" class="mt-1"></div>
            <div id="pending-institute-breakdown" class="mt-1"></div>
            <div class="dx-viewport demo-container mt-1">
                <div class="table-responsive p-0" id="pending-gridContainer"></div>
            </div>
        </div>
    

    <div id="breakdown-panel" style="display:none; margin-top:15px;">
            <div class="row">
                @foreach($districts as $district)
                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                        <button class="btn btn-primary w-100 rounded-pill px-3 py-2 district-tile"
                                data-district="{{ $district->id }}">
                            {{ $district->name }}: {{ $district->total }}
                        </button>
                    </div>
                @endforeach
            </div>
            <div id="department-breakdown" class="mt-1"></div>
            <div id="institute-breakdown" class="mt-1"></div>
            <div class="dx-viewport demo-container mt-1">
                <div class="table-responsive p-0" id="gridContainer"></div>
            </div>
              </div>
    
    
    

<div class="row">
    <!-- Verified -->
    <div class="col-md-4 col-sm-6 col-12">
        <div class="info-box" style="background-color:#25a725; color:white; cursor:pointer;"
             onclick="toggleBreakdownPanel('verified-breakdown-panel')">
            <span class="info-box-icon" style="color:white;"><i class="fas fa-user-check"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Verified</span>
                <span class="info-box-number">{{ $verifiedbyinstitute }}</span>
            </div>
        </div>
        </div>


    <!-- Card at Station -->
    <div class="col-md-4 col-sm-6 col-12">
        <div class="info-box" style="background-color: #E74C3C; color:white;cursor:pointer;"
             onclick="toggleBreakdownPanel('station-breakdown-panel')">
            <span class="info-box-icon" style="color:white;"><i class="fas fa-user-times"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Card at Stations</span>
                <span class="info-box-number">{{ $station }}</span>
            </div>
        </div>
    </div>

        
    <!-- Handed Over Cards -->
    <div class="col-md-4 col-sm-6 col-12">
        <div class="info-box" style="background-color: #9B59B6; color:white;cursor:pointer;"
             onclick="toggleBreakdownPanel('handedover-breakdown-panel')">
            <span class="info-box-icon" style="color:white;"><i class="fas fa-id-card"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Handed Over Cards</span>
                <span class="info-box-number">{{ $handover }}</span>
            </div>
        </div>
        </div>



        
        <div id="verified-breakdown-panel" style="display:none; margin-top:15px;">
            <div class="row">
                @foreach($verified_districts as $district)
                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                        <button class="btn btn-primary w-100 rounded-pill px-3 py-2 verified-district-tile"
                                data-district="{{ $district->id }}">
                            {{ $district->name }}: {{ $district->total }}
                        </button>
                    </div>
                @endforeach
            </div>
            <div id="verified-department-breakdown" class="mt-4"></div>
            <div id="verified-institute-breakdown" class="mt-4"></div>
            <div class="dx-viewport demo-container mt-4">
                <div class="table-responsive p-0" id="verified-gridContainer"></div>
            </div>
        </div>


        <div id="station-breakdown-panel" style="display:none; margin-top:15px;">
            <div class="row">
                @foreach($station_districts as $district)
                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                        <button class="btn btn-primary w-100 rounded-pill px-3 py-2 station-district-tile"
                                data-district="{{ $district->id }}">
                            {{ $district->name }}: {{ $district->total }}
                        </button>
                    </div>
                @endforeach
            </div>
            <div id="station-department-breakdown" class="mt-4"></div>
            <div id="station-institute-breakdown" class="mt-4"></div>
            <div class="dx-viewport demo-container mt-4">
                <div class="table-responsive p-0" id="station-gridContainer"></div>
            </div>
        </div>
    

    

        <div id="handedover-breakdown-panel" style="display:none; margin-top:15px;">
            <div class="row">
                @foreach($handedover_districts as $district)
                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                        <button class="btn btn-primary w-100 rounded-pill px-3 py-2 handedover-district-tile"
                                data-district="{{ $district->id }}">
                            {{ $district->name }}: {{ $district->total }}
                        </button>
                    </div>
                @endforeach
            </div>
            <div id="handedover-department-breakdown" class="mt-4"></div>
            <div id="handedover-institute-breakdown" class="mt-4"></div>
            <div class="dx-viewport demo-container mt-4">
                <div class="table-responsive p-0" id="handedover-gridContainer"></div>
            </div>
        </div>
    </div>
</div>


                    <div class="container mt-5">
                        <div class="row justify-content-center">
                            <div class="col-md-4">
                                <canvas id="pieChart1" width="400" height="200"></canvas>
                                <p class="mt-2 text-center text-dark font-weight-bold">Gender</p>
                            </div>
                            <div class="col-md-4">
                                <canvas id="pieChart2" width="400" height="200"></canvas>
                                <p class="mt-2 text-center text-dark font-weight-bold">Cities</p>
                            </div>
                            <div class="row mt-4">
                                <canvas id="pieChart3" width="400" height="200"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    {{-- <script src="../../dist/js/adminlte.min.js"></script> --}}
    <!-- Removed demo.js to avoid the alert -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script src="https://cdn3.devexpress.com/jslib/23.1.3/js/dx.all.js"></script>
    <link rel="stylesheet" href="https://cdn3.devexpress.com/jslib/23.1.3/css/dx.light.css" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/exceljs/4.3.0/exceljs.min.js"></script>


    <script>
        const pieData1 = {
            labels: ['Male', 'Female'],
            datasets: [{
                data: [{{ $maleCount }}, {{ $femaleCount }}],
                backgroundColor: ['#9B59B6', '#1ABC9C'],
            }]
        };

        const pieData2 = {
            labels: ['Lahore', 'Multan', 'Rawalpindi'],
            datasets: [{
                data: [{{ $lahoreCount }}, {{ $multanCount }}, {{ $rawalpindiCount }}],
                backgroundColor: ['#4A90E2', '#2ECC71', '#F39C12'],
            }]
        };

        const pieData3 = {
            labels: ['HED Colleges', 'TEVTA', 'SED Schools', 'PVTC'],
            datasets: [{
                data: [{{ $hedGovCount }}, {{ $tevtaCount }}, {{ $sedCount }}, {{ $pvtcCount }}],
                backgroundColor: ['#4A90E2', '#2ECC71', '#F39C12', '#E74C3C', '#9B59B6', '#1ABC9C', '#34495E'],
                borderWidth: 1,
                barThickness: 10,
            }]
        };

        new Chart(document.getElementById('pieChart1'), {
            type: 'pie',
            data: pieData1,
        });

        new Chart(document.getElementById('pieChart2'), {
            type: 'pie',
            data: pieData2,
        });

        new Chart(document.getElementById('pieChart3'), {
            type: 'bar',
            data: pieData3,
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.dataset.label + ': ' + context.raw;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Applications Count'
                        }
                    }
                }
            }
        });

    </script>
 <script>
// function toggleBreakdownPanel() {
//     const panel = document.getElementById('breakdown-panel');
//     panel.style.display = panel.style.display === 'none' ? 'block' : 'none';
// }

function toggleBreakdownPanel(panelId) {
    console.log('Toggling panel:', panelId);
    const panels = ['breakdown-panel', 'pending-breakdown-panel', 'institute-breakdown-panel', 'verified-breakdown-panel', 'station-breakdown-panel','handedover-breakdown-panel'];
    panels.forEach(id => {
        const panel = document.getElementById(id);
        console.log('Setting display for', id, ':', id === panelId && panel.style.display === 'none' ? 'block' : 'none');
        panel.style.display = id === panelId && panel.style.display === 'none' ? 'block' : 'none';
    });
}

$(document).ready(function () {
    $(document).on('click', '.district-tile', function () {
        const districtId = $(this).data('district');

        $.ajax({
            url: '/get-department-breakdown-inline/' + districtId,
            type: 'GET',
            success: function (data) {
                $('#department-breakdown').html(data);
            },
            error: function (xhr) {
                alert('Error loading departments.');
                console.error(xhr.responseText);
            }
        });
    });
});

</script>
<script>

// $(document).on('click', '.department-tile', function () {
//     const districtId = $(this).data('district');
//     const departmentId = $(this).data('department');

//     $.ajax({
//         url: '/get-institute-breakdown/' + districtId + '/' + departmentId,
//         type: 'GET',
//         success: function (data) {
//             // Optional: scroll into view or visually separate
//             $('#institute-breakdown').html(data);

            
//         },
//         error: function (xhr) {
//             alert('Error loading institutes.');
//             console.error(xhr.responseText);
//         }
//     });
// });



$(document).on('click', '.department-tile', function () {
    const districtId = $(this).data('district');
    const departmentId = $(this).data('department');

    $.ajax({
        url: '/get-institute-breakdown/' + districtId + '/' + departmentId,
        type: 'GET',
        success: function (data) {
            
console.log('Grid Data:', data);
            // Render dxDataGrid
            $('#gridContainer').dxDataGrid({
                 loadPanel: {
        enabled: true,
        text: "Loading data...",
        showIndicator: false,
        showPane: true
    },
                    dataSource: data,
                    paging: { pageSize: 5 },
                    pager: {
                        showPageSizeSelector: true,
                        allowedPageSizes: [10, 20, 50],
                        showInfo: true
                    },
                    searchPanel: {
                        visible: true,
                        highlightCaseSensitive: true,
                    },
                    headerFilter: {
    visible: true,
    allowSearch: true,
    showRelevantValues: true,
},
sorting: {
    mode: 'multiple' // or 'single' if you want only one column sorted at a time
},
keyExpr: 'org_id', // Unique row key for expansion

// filterRow: {
//     visible: true,
//     applyFilter: "auto",
// },

                    export: {
                        enabled: true,
                        formats: ['pdf', 'xlsx'],
                    },
                    onExporting(e) {
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
                        } else if (e.format === 'pdf') {
                            const doc = new jsPDF();
                            DevExpress.pdfExporter.exportDataGrid({
                                jsPDFDocument: doc,
                                component: e.component,
                            }).then(() => {
                                doc.save('Institutes.pdf');
                            });
                        }
                    },
                    allowColumnReordering: true,
                    rowAlternationEnabled: true,
                    showBorders: true,
                    columns: [
                         {
        caption: '#',
        alignment: 'center',
        width: 50,
        cellTemplate: function (container, options) {
            container.text(options.rowIndex + 1);
        }
    },
                        // { dataField: 'passenger_name', caption: 'Name', alignment: 'center' },
                        // { dataField: 'cnic', caption: 'CNIC', alignment: 'center' },
                        // { dataField: 'contact', caption: 'Contact', alignment: 'center' },
                        { dataField: 'district_id', caption: 'District', alignment: 'center',width: 200 },
                        { dataField: 'tehsil_id', caption: 'Tehsil', alignment: 'center',width: 200 },
                        { dataField: 'institute_name', caption: 'Organization', alignment: 'left', width: 400 },
                        {
    dataField: 'submitted_applications',
    caption: 'Submitted Applications',
    alignment: 'center',
    width: 200,
    cellTemplate: function (container, options) {
        $('<a href="#" style="text-decoration: underline;">')
            .text(options.value)
            .on('click', function (e) {
                e.preventDefault();
                const grid = $('#gridContainer').dxDataGrid('instance');
                const key = options.key;
                if (grid.isRowExpanded(key)) {
                    grid.collapseRow(key);
                } else {
                    grid.expandRow(key);
                }
            })
            .appendTo(container);
    }
}
,
                     
                    ],
                    masterDetail: {
    enabled: true,
    template: function (container, options) {
        const instituteName = options.data.institute_name;
        const districtId = options.data.districtID;
const tehsilId = options.data.tehsilID;
        const orgId = options.data.org_id;
        

        console.log({
    org_id: orgId,
    district_id: districtId,
    tehsil_id: tehsilId
});

        $('<div>')
            .addClass('detail-grid')
            .appendTo(container)
            .dxDataGrid({
                width: '100%',
                dataSource: {
                    load: function () {
                        return $.getJSON('/get-users-by-institute', {
                            org_id: orgId,
                            district_id: districtId,
                            tehsil_id: tehsilId
                        });
                    }
                },
                columns: [
                    { dataField: 'passenger_name', caption: 'Name', alignment: 'center' },
                    { dataField: 'cnic', caption: 'CNIC', alignment: 'center' },
                    { dataField: 'contact', caption: 'Contact', alignment: 'center' },
                   
                    {
                        caption: 'Action',
                        alignment: 'center',
                        cellTemplate: function (container, options) {
                            $('<a>')
                                .addClass('btn btn-sm btn-primary text-white')
                                .text('View Details')
                                .attr('href', '/pmashowform/' + (options.data.user_id ?? ''))
                                .appendTo(container);
                        }}
                ],
                export: {
                        enabled: true,
                        formats: ['pdf', 'xlsx'],
                    },
                    onExporting(e) {
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
                        } else if (e.format === 'pdf') {
                            const doc = new jsPDF();
                            DevExpress.pdfExporter.exportDataGrid({
                                jsPDFDocument: doc,
                                component: e.component,
                            }).then(() => {
                                doc.save('Institutes.pdf');
                            });
                        }
                    },
                    allowColumnReordering: true,
                    rowAlternationEnabled: true,
                    showBorders: true,
                showBorders: true,
                paging: { pageSize: 5 },
                searchPanel: { visible: true },
                headerFilter: {
                    visible: true,
                    allowSearch: true
                },
                sorting: {
                    mode: 'multiple'
                }
            });
    }
},

                    
                
            });
        },
        error: function (xhr) {
            alert('Error loading institutes.');
            console.error(xhr.responseText);
        }
});
});

// Pending at Department Click
// Pending at Department District Click
$(document).on('click', '.pending-district-tile', function () {
    const districtId = $(this).data('district');
    console.log('Clicked district ID:', districtId);

    $.ajax({
        url: '/get-pending-department-breakdown/' + districtId,
        type: 'GET',
        success: function (data) {
            $('#pending-department-breakdown').html(data);
        },
        error: function (xhr) {
            alert('Error loading departments.');
            console.error(xhr.responseText);
        }
    });
});

// Pending Department (SED/HED) Click
$(document).on('click', '.pending-department-subtile', function () {
    const districtId = $(this).data('district');
    const departmentId = $(this).data('department');

    $.ajax({
        url: '/get-pending-institute-breakdown/' + districtId + '/' + departmentId,
        type: 'GET',
        success: function (data) {
            console.log('Pending Grid Data:', data);
            $('#pending-institute-breakdown').html(''); // Clear previous institute breakdown
            $('#pending-gridContainer').dxDataGrid({
                loadPanel: {
                    enabled: true,
                    text: "Loading data...",
                    showIndicator: false,
                    showPane: true
                },
                dataSource: data,
                paging: { pageSize: 5 },
                pager: {
                    showPageSizeSelector: true,
                    allowedPageSizes: [10, 20, 50],
                    showInfo: true
                },
                searchPanel: {
                    visible: true,
                    highlightCaseSensitive: true,
                },
                headerFilter: {
                    visible: true,
                    allowSearch: true,
                    showRelevantValues: true,
                },
                sorting: {
                    mode: 'multiple'
                },
                keyExpr: 'org_id',
                export: {
                    enabled: true,
                    formats: ['pdf', 'xlsx'],
                },
                onExporting(e) {
                    if (e.format === 'xlsx') {
                        const workbook = new ExcelJS.Workbook();
                        const worksheet = workbook.addWorksheet('Pending Institutes');
                        DevExpress.excelExporter.exportDataGrid({
                            component: e.component,
                            worksheet,
                            autoFilterEnabled: true,
                        }).then(() => {
                            workbook.xlsx.writeBuffer().then((buffer) => {
                                saveAs(new Blob([buffer], {
                                    type: 'application/octet-stream'
                                }), 'Pending_Institutes.xlsx');
                            });
                        });
                    } else if (e.format === 'pdf') {
                        const doc = new jsPDF();
                        DevExpress.pdfExporter.exportDataGrid({
                            jsPDFDocument: doc,
                            component: e.component,
                        }).then(() => {
                            doc.save('Pending_Institutes.pdf');
                        });
                    }
                },
                allowColumnReordering: true,
                rowAlternationEnabled: true,
                showBorders: true,
                columns: [
                    {
                        caption: '#',
                        alignment: 'center',
                        width: 50,
                        cellTemplate: function (container, options) {
                            container.text(options.rowIndex + 1);
                        }
                    },
                    { dataField: 'district_id', caption: 'District', alignment: 'center', width: 200 },
                    { dataField: 'tehsil_id', caption: 'Tehsil', alignment: 'center', width: 200 },
                    { dataField: 'institute_name', caption: 'Organization', alignment: 'left', width: 400 },
                    {
                        dataField: 'submitted_applications',
                        caption: 'Pending Applications',
                        alignment: 'center',
                        width: 200,
                        cellTemplate: function (container, options) {
                            $('<a href="#" style="text-decoration: underline;">')
                                .text(options.value)
                                .on('click', function (e) {
                                    e.preventDefault();
                                    const grid = $('#pending-gridContainer').dxDataGrid('instance');
                                    const key = options.key;
                                    if (grid.isRowExpanded(key)) {
                                        grid.collapseRow(key);
                                    } else {
                                        grid.expandRow(key);
                                    }
                                })
                                .appendTo(container);
                        }
                    }
                ],
                masterDetail: {
                    enabled: true,
                    template: function (container, options) {
                        const instituteName = options.data.institute_name;
                        const districtId = options.data.districtID;
                        const tehsilId = options.data.tehsilID;
                        const orgId = options.data.org_id;
                        $('<div>')
                            .addClass('detail-grid')
                            .appendTo(container)
                            .dxDataGrid({
                                width: '100%',
                                dataSource: {
                                    load: function () {
                                        return $.getJSON('/get-pending-users-by-institute', {
                                            org_id: orgId,
                                            district_id: districtId,
                                            tehsil_id: tehsilId
                                        });
                                    }
                                },
                                columns: [
                                    { dataField: 'passenger_name', caption: 'Name', alignment: 'center' },
                                    { dataField: 'cnic', caption: 'CNIC', alignment: 'center' },
                                    { dataField: 'contact', caption: 'Contact', alignment: 'center' },
                                    {
                                        caption: 'Action',
                                        alignment: 'center',
                                        cellTemplate: function (container, options) {
                                            $('<a>')
                                                .addClass('btn btn-sm btn-primary text-white')
                                                .text('View Details')
                                                .attr('href', '/pmashowform/' + (options.data.user_id ?? ''))
                                                .appendTo(container);
                                        }
                                    }
                                ],
                                export: {
                                    enabled: true,
                                    formats: ['pdf', 'xlsx'],
                                },
                                onExporting(e) {
                                    if (e.format === 'xlsx') {
                                        const workbook = new ExcelJS.Workbook();
                                        const worksheet = workbook.addWorksheet('Pending Institutes');
                                        DevExpress.excelExporter.exportDataGrid({
                                            component: e.component,
                                            worksheet,
                                            autoFilterEnabled: true,
                                        }).then(() => {
                                            workbook.xlsx.writeBuffer().then((buffer) => {
                                                saveAs(new Blob([buffer], {
                                                    type: 'application/octet-stream'
                                                }), 'Pending_Institutes.xlsx');
                                            });
                                        });
                                    } else if (e.format === 'pdf') {
                                        const doc = new jsPDF();
                                        DevExpress.pdfExporter.exportDataGrid({
                                            jsPDFDocument: doc,
                                            component: e.component,
                                        }).then(() => {
                                            doc.save('Pending_Institutes.pdf');
                                        });
                                    }
                                },
                                allowColumnReordering: true,
                                rowAlternationEnabled: true,
                                showBorders: true,
                                paging: { pageSize: 5 },
                                searchPanel: { visible: true },
                                headerFilter: {
                                    visible: true,
                                    allowSearch: true
                                },
                                sorting: {
                                    mode: 'multiple'
                                }
                            });
                    }
                }
            });
        },
        error: function (xhr) {
            alert('Error loading pending institutes.');
            console.error(xhr.responseText);
        }
    });
});

//pending at institute

$(document).ready(function () {
    $(document).on('click', '.district-tile', function () {
        const districtId = $(this).data('district');

        $.ajax({
            url: '/get-department-breakdown-inline/' + districtId,
            type: 'GET',
            success: function (data) {
                $('#department-breakdown').html(data);
            },
            error: function (xhr) {
                alert('Error loading departments.');
                console.error(xhr.responseText);
            }
        });
    });
});

</script>
<script>

// $(document).on('click', '.department-tile', function () {
//     const districtId = $(this).data('district');
//     const departmentId = $(this).data('department');

//     $.ajax({
//         url: '/get-institute-breakdown/' + districtId + '/' + departmentId,
//         type: 'GET',
//         success: function (data) {
//             // Optional: scroll into view or visually separate
//             $('#institute-breakdown').html(data);

            
//         },
//         error: function (xhr) {
//             alert('Error loading institutes.');
//             console.error(xhr.responseText);
//         }
//     });
// });



$(document).on('click', '.inst-district-tile', function () {
    const districtId = $(this).data('district');
    console.log('Clicked institute district ID:', districtId);

    $.ajax({
        url: '/get-institute-department-breakdown/' + districtId,
        type: 'GET',
        success: function (data) {
            $('#inst-department-breakdown').html(data); // Show department subtile HTML
            $('#inst-institute-breakdown').html('');     // Clear institute view
        },
        error: function (xhr) {
            console.error('Error loading institute departments:', xhr.responseText);
            $('#inst-department-breakdown').html('<div class="alert alert-danger">Error loading departments.</div>');
        }
    });
});
$(document).on('click', '.inst-department-subtile', function () {
    const districtId = $(this).data('district');
    const departmentId = $(this).data('department');
    $.ajax({
        url: '/get-institute-grid/' + districtId + '/' + departmentId,
        type: 'GET',
        success: function (data) {
            $('#inst-institute-breakdown').html('');
            $('#inst-gridContainer').dxDataGrid({
                loadPanel: {
                    enabled: true,
                    text: "Loading data...",
                },
                dataSource: data,
                paging: { pageSize: 5 },
                pager: {
                    showPageSizeSelector: true,
                    allowedPageSizes: [10, 20, 50],
                    showInfo: true
                },
                searchPanel: { visible: true },
                headerFilter: { visible: true, allowSearch: true },
                sorting: { mode: 'multiple' },
                keyExpr: 'org_id',
                export: {
                    enabled: true,
                    formats: ['pdf', 'xlsx'],
                },
                onExporting(e) {
                    if (e.format === 'xlsx') {
                        const workbook = new ExcelJS.Workbook();
                        const worksheet = workbook.addWorksheet('Pending_Institutes');
                        DevExpress.excelExporter.exportDataGrid({
                            component: e.component,
                            worksheet,
                            autoFilterEnabled: true,
                        }).then(() => {
                            workbook.xlsx.writeBuffer().then((buffer) => {
                                saveAs(new Blob([buffer], { type: 'application/octet-stream' }), 'Pending_Institutes.xlsx');
                            });
                        });
                    } else if (e.format === 'pdf') {
                        const doc = new jsPDF();
                        DevExpress.pdfExporter.exportDataGrid({
                            jsPDFDocument: doc,
                            component: e.component,
                        }).then(() => {
                            doc.save('Pending_Institutes.pdf');
                        });
                    }
                },
                columns: [
                    {
                        caption: '#',
                        alignment: 'center',
                        width: 50,
                        cellTemplate: function (container, options) {
                            container.text(options.rowIndex + 1); 
                        }
                    },
                    { dataField: 'district_id', caption: 'District', alignment: 'center', width: 200 },
                    { dataField: 'tehsil_id', caption: 'Tehsil', alignment: 'center', width: 200 },
                    { dataField: 'institute_name', caption: 'Organization', alignment: 'left', width: 400 },
                    {
                        dataField: 'submitted_applications',
                        caption: 'Pending Applications',
                        alignment: 'center',
                        width: 200,
                        cellTemplate: function (container, options) {
                            $('<a href="#" style="text-decoration: underline;">')
                                .text(options.value)
                                .on('click', function (e) {
                                    e.preventDefault();
                                    const grid = $('#inst-gridContainer').dxDataGrid('instance');
                                    const key = options.key;
                                    if (grid.isRowExpanded(key)) {
                                        grid.collapseRow(key);
                                    } else {
                                        grid.expandRow(key);
                                    }
                                })
                                .appendTo(container);
                        }
                    }
                ],
                masterDetail: {
                    enabled: true,
                    template: function (container, options) {
                        const orgId = options.data.org_id;
                        const districtId = options.data.districtID; // Updated
                        const tehsilId = options.data.tehsilID;   // Updated
                        $('<div>')
                            .addClass('detail-grid')
                            .appendTo(container)
                            .dxDataGrid({
                                dataSource: {
                                    load: function () {
                                        return $.getJSON('/get-institute-users-by-institute', { // Updated route
                                            org_id: orgId,
                                            district_id: districtId,
                                            tehsil_id: tehsilId
                                        });
                                    }
                                },
                                columns: [
                                    { dataField: 'passenger_name', caption: 'Name', alignment: 'center' },
                                    { dataField: 'cnic', caption: 'CNIC', alignment: 'center' },
                                    { dataField: 'contact', caption: 'Contact', alignment: 'center' },
                                    {
                                        caption: 'Action',
                                        alignment: 'center',
                                        cellTemplate: function (container, options) {
                                            $('<a>')
                                                .addClass('btn btn-sm btn-primary text-white')
                                                .text('View Details')
                                                .attr('href', '/pmashowform/' + (options.data.user_id ?? ''))
                                                .appendTo(container);
                                        }
                                    }
                                ],
                                export: {
                                    enabled: true,
                                    formats: ['pdf', 'xlsx'],
                                },
                                onExporting(e) {
                                    if (e.format === 'xlsx') {
                                        const workbook = new ExcelJS.Workbook();
                                        const worksheet = workbook.addWorksheet('Pending_Users');
                                        DevExpress.excelExporter.exportDataGrid({
                                            component: e.component,
                                            worksheet,
                                            autoFilterEnabled: true,
                                        }).then(() => {
                                            workbook.xlsx.writeBuffer().then((buffer) => {
                                                saveAs(new Blob([buffer], { type: 'application/octet-stream' }), 'Pending_Users.xlsx');
                                            });
                                        });
                                    } else if (e.format === 'pdf') {
                                        const doc = new jsPDF();
                                        DevExpress.pdfExporter.exportDataGrid({
                                            jsPDFDocument: doc,
                                            component: e.component,
                                        }).then(() => {
                                            doc.save('Pending_Users.pdf');
                                        });
                                    }
                                },
                                paging: { pageSize: 5 },
                                searchPanel: { visible: true },
                                headerFilter: { visible: true, allowSearch: true },
                                sorting: { mode: 'multiple' },
                                rowAlternationEnabled: true,
                                showBorders: true
                            });
                    }
                }
            });
        },
        error: function (xhr) {
            console.error('Error loading institute data:', xhr.responseText);
            $('#inst-institute-breakdown').html('<div class="alert alert-danger">Error loading institutes.</div>');
        }
    });
});

            // Verified Department Click
            $(document).on('click', '.verified-district-tile', function () {
    const districtId = $(this).data('district');
    console.log('Clicked verified district ID:', districtId);
    $.ajax({
        url: '/get-verified-department-breakdown/' + districtId,
        type: 'GET',
        success: function (data) {
            $('#verified-department-breakdown').html(data);
            $('#verified-institute-breakdown').html('');
        },
        error: function (xhr) {
            console.error('Error loading verified departments:', xhr.responseText);
            $('#verified-department-breakdown').html('<div class="alert alert-danger mt-3">Error loading departments. Please try again.</div>');
        }
    });
});
            $(document).on('click', '.verified-department-subtile', function () {
                const districtId = $(this).data('district');
                const departmentId = $(this).data('department');
                console.log('Clicked verified department ID:', departmentId, 'for district ID:', districtId);
                $.ajax({
                    url: '/get-verified-institute-grid/' + districtId + '/' + departmentId,
                    type: 'GET',
                    success: function (data) {
                        $('#verified-institute-breakdown').html('');
                        $('#verified-gridContainer').dxDataGrid({
                            loadPanel: {
                                enabled: true,
                                text: "Loading data...",
                                showIndicator: false,
                                showPane: true
                            },
                            dataSource: data,
                            paging: { pageSize: 5 },
                            pager: {
                                showPageSizeSelector: true,
                                allowedPageSizes: [10, 20, 50],
                                showInfo: true
                            },
                            searchPanel: { visible: true },
                            headerFilter: { visible: true, allowSearch: true },
                            sorting: { mode: 'multiple' },
                            keyExpr: 'org_id',
                            export: {
                                enabled: true,
                                formats: ['pdf', 'xlsx'],
                            },
                            onExporting(e) {
                                if (e.format === 'xlsx') {
                                    const workbook = new ExcelJS.Workbook();
                                    const worksheet = workbook.addWorksheet('Verified_Institutes');
                                    DevExpress.excelExporter.exportDataGrid({
                                        component: e.component,
                                        worksheet,
                                        autoFilterEnabled: true,
                                    }).then(() => {
                                        workbook.xlsx.writeBuffer().then((buffer) => {
                                            saveAs(new Blob([buffer], { type: 'application/octet-stream' }), 'Verified_Institutes.xlsx');
                                        });
                                    });
                                } else if (e.format === 'pdf') {
                                    const doc = new jsPDF();
                                    DevExpress.pdfExporter.exportDataGrid({
                                        jsPDFDocument: doc,
                                        component: e.component,
                                    }).then(() => {
                                        doc.save('Verified_Institutes.pdf');
                                    });
                                }
                            },
                            allowColumnReordering: true,
                            rowAlternationEnabled: true,
                            showBorders: true,
                            columns: [
                                {
                                    caption: '#',
                                    alignment: 'center',
                                    width: 50,
                                    cellTemplate: function (container, options) {
                                        container.text(options.rowIndex + 1);
                                    }
                                },
                                { dataField: 'district_id', caption: 'District', alignment: 'center', width: 200 },
                                { dataField: 'tehsil_id', caption: 'Tehsil', alignment: 'center', width: 200 },
                                { dataField: 'institute_name', caption: 'Organization', alignment: 'left', width: 400 },
                                {
                                    dataField: 'verified_applications',
                                    caption: 'Verified Applications',
                                    alignment: 'center',
                                    width: 200,
                                    cellTemplate: function (container, options) {
                                        $('<a href="#" style="text-decoration: underline;">')
                                            .text(options.value)
                                            .on('click', function (e) {
                                                e.preventDefault();
                                                const grid = $('#verified-gridContainer').dxDataGrid('instance');
                                                const key = options.key;
                                                if (grid.isRowExpanded(key)) {
                                                    grid.collapseRow(key);
                                                } else {
                                                    grid.expandRow(key);
                                                }
                                            })
                                            .appendTo(container);
                                    }
                                }
                            ],
                            masterDetail: {
                                enabled: true,
                                template: function (container, options) {
                                    const districtId = options.data.districtID;
                                    const tehsilId = options.data.tehsilID;
                                    const orgId = options.data.org_id;
                                    $('<div>')
                                        .addClass('detail-grid')
                                        .appendTo(container)
                                        .dxDataGrid({
                                            dataSource: {
                                                load: function () {
                                                    return $.getJSON('/get-verified-users-by-institute', {
                                                        org_id: orgId,
                                                        district_id: districtId,
                                                        tehsil_id: tehsilId
                                                    });
                                                }
                                            },
                                            columns: [
                                                { dataField: 'passenger_name', caption: 'Name', alignment: 'center' },
                                                { dataField: 'cnic', caption: 'CNIC', alignment: 'center' },
                                                { dataField: 'contact', caption: 'Contact', alignment: 'center' },
                                                {
                                                    caption: 'Action',
                                                    alignment: 'center',
                                                    cellTemplate: function (container, options) {
                                                        $('<a>')
                                                            .addClass('btn btn-sm btn-primary text-white')
                                                            .text('View Details')
                                                            .attr('href', '/pmashowform/' + (options.data.user_id ?? ''))
                                                            .appendTo(container);
                                                    }
                                                }
                                            ],
                                            export: {
                                                enabled: true,
                                                formats: ['pdf', 'xlsx'],
                                            },
                                            onExporting(e) {
                                                if (e.format === 'xlsx') {
                                                    const workbook = new ExcelJS.Workbook();
                                                    const worksheet = workbook.addWorksheet('Verified_Users');
                                                    DevExpress.excelExporter.exportDataGrid({
                                                        component: e.component,
                                                        worksheet,
                                                        autoFilterEnabled: true,
                                                    }).then(() => {
                                                        workbook.xlsx.writeBuffer().then((buffer) => {
                                                            saveAs(new Blob([buffer], { type: 'application/octet-stream' }), 'Verified_Users.xlsx');
                                                        });
                                                    });
                                                } else if (e.format === 'pdf') {
                                                    const doc = new jsPDF();
                                                    DevExpress.pdfExporter.exportDataGrid({
                                                        jsPDFDocument: doc,
                                                        component: e.component,
                                                    }).then(() => {
                                                        doc.save('Verified_Users.pdf');
                                                    });
                                                }
                                            },
                                            allowColumnReordering: true,
                                            rowAlternationEnabled: true,
                                            showBorders: true,
                                            paging: { pageSize: 5 },
                                            searchPanel: { visible: true },
                                            headerFilter: { visible: true, allowSearch: true },
                                            sorting: { mode: 'multiple' }
                                        });
                                }
                            }
                        });
                    },
                    error: function (xhr) {
                        console.error('Error loading verified institutes:', xhr.responseText);
                        $('#verified-institute-breakdown').html('<div class="alert alert-danger mt-3">Error loading institutes. Please try again.</div>');
                    }
                });
            });
        $(document).on('click', '.station-district-tile', function () {
    const districtId = $(this).data('district');
    console.log('Clicked station district ID:', districtId);
    $.ajax({
        url: '/get-station-department-breakdown/' + districtId,
        type: 'GET',
        success: function (data) {
            $('#station-department-breakdown').html(data);
            $('#station-institute-breakdown').html('');
        },
        error: function (xhr) {
            console.error('Error loading station departments:', xhr.responseText);
            $('#station-department-breakdown').html('<div class="alert alert-danger mt-3">Error loading departments. Please try again.</div>');
        }
    });
});

            $(document).on('click', '.station-department-subtile', function () {
    const districtId = $(this).data('district');
    const departmentId = $(this).data('department');
    console.log('Clicked station department ID:', departmentId, 'for district ID:', districtId);
    $.ajax({
        url: '/get-station-institute-grid/' + districtId + '/' + departmentId,
        type: 'GET',
        success: function (data) {
            $('#station-institute-breakdown').html('');
            $('#station-gridContainer').dxDataGrid({
                loadPanel: {
                    enabled: true,
                    text: "Loading data...",
                    showIndicator: false,
                    showPane: true
                },
                dataSource: data,
                paging: { pageSize: 5 },
                pager: {
                    showPageSizeSelector: true,
                    allowedPageSizes: [10, 20, 50],
                    showInfo: true
                },
                searchPanel: { visible: true },
                headerFilter: { visible: true, allowSearch: true },
                sorting: { mode: 'multiple' },
                keyExpr: 'org_id',
                export: {
                    enabled: true,
                    formats: ['pdf', 'xlsx'],
                },
                onExporting(e) {
                    if (e.format === 'xlsx') {
                        const workbook = new ExcelJS.Workbook();
                        const worksheet = workbook.addWorksheet('Station_Institutes');
                        DevExpress.excelExporter.exportDataGrid({
                            component: e.component,
                            worksheet,
                            autoFilterEnabled: true,
                        }).then(() => {
                            workbook.xlsx.writeBuffer().then((buffer) => {
                                saveAs(new Blob([buffer], { type: 'application/octet-stream' }), 'Station_Institutes.xlsx');
                            });
                        });
                    } else if (e.format === 'pdf') {
                        const doc = new jsPDF();
                        DevExpress.pdfExporter.exportDataGrid({
                            jsPDFDocument: doc,
                            component: e.component,
                        }).then(() => {
                            doc.save('Station_Institutes.pdf');
                        });
                    }
                },
                allowColumnReordering: true,
                rowAlternationEnabled: true,
                showBorders: true,
                columns: [
                    {
                        caption: '#',
                        alignment: 'center',
                        width: 50,
                        cellTemplate: function (container, options) {
                            container.text(options.rowIndex + 1);
                        }
                    },
                    { dataField: 'district_id', caption: 'District', alignment: 'center', width: 200 },
                    { dataField: 'tehsil_id', caption: 'Tehsil', alignment: 'center', width: 200 },
                    { dataField: 'institute_name', caption: 'Organization', alignment: 'left', width: 400 },
                    {
                        dataField: 'station_applications',
                        caption: 'Applications at Stations',
                        alignment: 'center',
                        width: 200,
                        cellTemplate: function (container, options) {
                            $('<a href="#" style="text-decoration: underline;">')
                                .text(options.value)
                                .on('click', function (e) {
                                    e.preventDefault();
                                    const grid = $('#station-gridContainer').dxDataGrid('instance');
                                    const key = options.key;
                                    if (grid.isRowExpanded(key)) {
                                        grid.collapseRow(key);
                                    } else {
                                        grid.expandRow(key);
                                    }
                                })
                                .appendTo(container);
                        }
                    }
                ],
                masterDetail: {
                    enabled: true,
                    template: function (container, options) {
                        const districtId = options.data.districtID;
                        const tehsilId = options.data.tehsilID;
                        const orgId = options.data.org_id;
                        $('<div>')
                            .addClass('detail-grid')
                            .appendTo(container)
                            .dxDataGrid({
                                dataSource: {
                                    load: function () {
                                        return $.getJSON('/get-station-users-by-institute', {
                                            org_id: orgId,
                                            district_id: districtId,
                                            tehsil_id: tehsilId
                                        });
                                    }
                                },
                                columns: [
                                    { dataField: 'passenger_name', caption: 'Name', alignment: 'center' },
                                    { dataField: 'cnic', caption: 'CNIC', alignment: 'center' },
                                    { dataField: 'contact', caption: 'Contact', alignment: 'center' },
                                    {
                                        caption: 'Action',
                                        alignment: 'center',
                                        cellTemplate: function (container, options) {
                                            $('<a>')
                                                .addClass('btn btn-sm btn-primary text-white')
                                                .text('View Details')
                                                .attr('href', '/pmashowform/' + (options.data.user_id ?? ''))
                                                .appendTo(container);
                                        }
                                    }
                                ],
                                export: {
                                    enabled: true,
                                    formats: ['pdf', 'xlsx'],
                                },
                                onExporting(e) {
                                    if (e.format === 'xlsx') {
                                        const workbook = new ExcelJS.Workbook();
                                        const worksheet = workbook.addWorksheet('Station_Users');
                                        DevExpress.excelExporter.exportDataGrid({
                                            component: e.component,
                                            worksheet,
                                            autoFilterEnabled: true,
                                        }).then(() => {
                                            workbook.xlsx.writeBuffer().then((buffer) => {
                                                saveAs(new Blob([buffer], { type: 'application/octet-stream' }), 'Station_Users.xlsx');
                                            });
                                        });
                                    } else if (e.format === 'pdf') {
                                        const doc = new jsPDF();
                                        DevExpress.pdfExporter.exportDataGrid({
                                            jsPDFDocument: doc,
                                            component: e.component,
                                        }).then(() => {
                                            doc.save('Station_Users.pdf');
                                        });
                                    }
                                },
                                allowColumnReordering: true,
                                rowAlternationEnabled: true,
                                showBorders: true,
                                paging: { pageSize: 5 },
                                searchPanel: { visible: true },
                                headerFilter: { visible: true, allowSearch: true },
                                sorting: { mode: 'multiple' }
                            });
                    }
                }
            });
        },
        error: function (xhr) {
            console.error('Error loading station institutes:', xhr.responseText);
            $('#station-institute-breakdown').html('<div class="alert alert-danger mt-3">Error loading institutes. Please try again.</div>');
        }
    });
});


// Handed Over Cards: District Click
            $(document).on('click', '.handedover-district-tile', function () {
                const districtId = $(this).data('district');
                console.log('Clicked handed over district ID:', districtId);
                $.ajax({
                    url: '/get-handedover-department-breakdown/' + districtId,
                    type: 'GET',
                    success: function (data) {
                        $('#handedover-department-breakdown').html(data);
                        $('#handedover-institute-breakdown').html('');
                    },
                    error: function (xhr) {
                        console.error('Error loading handed over departments:', xhr.responseText);
                        $('#handedover-department-breakdown').html('<div class="alert alert-danger mt-3">Error loading departments. Please try again.</div>');
                    }
                });
            });

            // Handed Over Cards: Department Click
            $(document).on('click', '.handedover-department-subtile', function () {
                const districtId = $(this).data('district');
                const departmentId = $(this).data('department');
                console.log('Clicked handed over department ID:', departmentId, 'for district ID:', districtId);
                $.ajax({
                    url: '/get-handedover-institute-grid/' + districtId + '/' + departmentId,
                    type: 'GET',
                    success: function (data) {
                        $('#handedover-institute-breakdown').html('');
                        $('#handedover-gridContainer').dxDataGrid({
                            loadPanel: {
                                enabled: true,
                                text: "Loading data...",
                                showIndicator: false,
                                showPane: true
                            },
                            dataSource: data,
                            paging: { pageSize: 5 },
                            pager: {
                                showPageSizeSelector: true,
                                allowedPageSizes: [10, 20, 50],
                                showInfo: true
                            },
                            searchPanel: { visible: true },
                            headerFilter: { visible: true, allowSearch: true },
                            sorting: { mode: 'multiple' },
                            keyExpr: 'org_id',
                            export: {
                                enabled: true,
                                formats: ['pdf', 'xlsx'],
                            },
                            onExporting(e) {
                                if (e.format === 'xlsx') {
                                    const workbook = new ExcelJS.Workbook();
                                    const worksheet = workbook.addWorksheet('HandedOver_Institutes');
                                    DevExpress.excelExporter.exportDataGrid({
                                        component: e.component,
                                        worksheet,
                                        autoFilterEnabled: true,
                                    }).then(() => {
                                        workbook.xlsx.writeBuffer().then((buffer) => {
                                            saveAs(new Blob([buffer], { type: 'application/octet-stream' }), 'HandedOver_Institutes.xlsx');
                                        });
                                    });
                                } else if (e.format === 'pdf') {
                                    const doc = new jsPDF();
                                    DevExpress.pdfExporter.exportDataGrid({
                                        jsPDFDocument: doc,
                                        component: e.component,
                                    }).then(() => {
                                        doc.save('HandedOver_Institutes.pdf');
                                    });
                                }
                            },
                            allowColumnReordering: true,
                            rowAlternationEnabled: true,
                            showBorders: true,
                            columns: [
                                {
                                    caption: '#',
                                    alignment: 'center',
                                    width: 50,
                                    cellTemplate: function (container, options) {
                                        container.text(options.rowIndex + 1);
                                    }
                                },
                                { dataField: 'district_id', caption: 'District', alignment: 'center', width: 200 },
                                { dataField: 'tehsil_id', caption: 'Tehsil', alignment: 'center', width: 200 },
                                { dataField: 'institute_name', caption: 'Organization', alignment: 'left', width: 400 },
                                {
                                    dataField: 'handedover_applications',
                                    caption: 'Handed Over Applications',
                                    alignment: 'center',
                                    width: 200,
                                    cellTemplate: function (container, options) {
                                        $('<a href="#" style="text-decoration: underline;">')
                                            .text(options.value)
                                            .on('click', function (e) {
                                                e.preventDefault();
                                                const grid = $('#handedover-gridContainer').dxDataGrid('instance');
                                                const key = options.key;
                                                if (grid.isRowExpanded(key)) {
                                                    grid.collapseRow(key);
                                                } else {
                                                    grid.expandRow(key);
                                                }
                                            })
                                            .appendTo(container);
                                    }
                                }
                            ],
                            masterDetail: {
                                enabled: true,
                                template: function (container, options) {
                                    const districtId = options.data.districtID;
                                    const tehsilId = options.data.tehsilID;
                                    const orgId = options.data.org_id;
                                    $('<div>')
                                        .addClass('detail-grid')
                                        .appendTo(container)
                                        .dxDataGrid({
                                            dataSource: {
                                                load: function () {
                                                    return $.getJSON('/get-handedover-users-by-institute', {
                                                        org_id: orgId,
                                                        district_id: districtId,
                                                        tehsil_id: tehsilId
                                                    });
                                                }
                                            },
                                            columns: [
                                                { dataField: 'passenger_name', caption: 'Name', alignment: 'center' },
                                                { dataField: 'cnic', caption: 'CNIC', alignment: 'center' },
                                                { dataField: 'contact', caption: 'Contact', alignment: 'center' },
                                                {
                                                    caption: 'Action',
                                                    alignment: 'center',
                                                    cellTemplate: function (container, options) {
                                                        $('<a>')
                                                            .addClass('btn btn-sm btn-primary text-white')
                                                            .text('View Details')
                                                            .attr('href', '/pmashowform/' + (options.data.user_id ?? ''))
                                                            .appendTo(container);
                                                    }
                                                }
                                            ],
                                            export: {
                                                enabled: true,
                                                formats: ['pdf', 'xlsx'],
                                            },
                                            onExporting(e) {
                                                if (e.format === 'xlsx') {
                                                    const workbook = new ExcelJS.Workbook();
                                                    const worksheet = workbook.addWorksheet('HandedOver_Users');
                                                    DevExpress.excelExporter.exportDataGrid({
                                                        component: e.component,
                                                        worksheet,
                                                        autoFilterEnabled: true,
                                                    }).then(() => {
                                                        workbook.xlsx.writeBuffer().then((buffer) => {
                                                            saveAs(new Blob([buffer], { type: 'application/octet-stream' }), 'HandedOver_Users.xlsx');
                                                        });
                                                    });
                                                } else if (e.format === 'pdf') {
                                                    const doc = new jsPDF();
                                                    DevExpress.pdfExporter.exportDataGrid({
                                                        jsPDFDocument: doc,
                                                        component: e.component,
                                                    }).then(() => {
                                                        doc.save('HandedOver_Users.pdf');
                                                    });
                                                }
                                            },
                                            allowColumnReordering: true,
                                            rowAlternationEnabled: true,
                                            showBorders: true,
                                            paging: { pageSize: 5 },
                                            searchPanel: { visible: true },
                                            headerFilter: { visible: true, allowSearch: true },
                                            sorting: { mode: 'multiple' }
                                        });
                                }
                            }
                        });
                    },
                    error: function (xhr) {
                        console.error('Error loading handed over institutes:', xhr.responseText);
                        $('#handedover-institute-breakdown').html('<div class="alert alert-danger mt-3">Error loading institutes. Please try again.</div>');
                    }
                });
            });
        

</script>


@endsection