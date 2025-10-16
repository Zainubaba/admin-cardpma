@extends('head_institute.master')
@section('content')

{{-- <meta http-equiv="refresh" content="30"> --}}

    <script src="https://cdnjs.cloudflare.com/ajax/libs/babel-polyfill/7.4.0/polyfill.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/exceljs/4.1.1/exceljs.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.2/FileSaver.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.0.0/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.9/jspdf.plugin.autotable.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/devextreme/21.1.4/css/dx.light.css" rel="stylesheet" />
    <style>

        .hovertext {
            position: relative;
            display: inline-block;
        }

        .hovertext:before {
            content: attr(data-hover);
            visibility: hidden;
            opacity: 0;
            width: 140px;
            background-color: black;
            color: #fff;
            text-align: center;
            border-radius: 5px;
            padding: 5px 0;
            transition: opacity 1s ease-in-out;

            position: absolute;
            z-index: 1;
            left: 0;
            top: 110%;
        }

        .hovertext:hover:before {
            opacity: 1;
            visibility: visible;
        }

        .hover-box {
            display: none;
            position: absolute;
            background-color: black;
            /* Set background color to black */
            color: white;
            /* Set text color to white */
            border: 1px solid #ccc;
            /* Set your preferred border style */
            padding: 10px;
            /* Set your preferred padding */
            width: 200px;
            /* Set your preferred width */
            max-height: 200px;
            /* Set your preferred maximum height */
            overflow-y: auto;
            /* Enable vertical scrollbar if needed */
            white-space: pre-wrap;
            /* Allow text to wrap to the next line */
            z-index: 999;
            /* Ensure the hover box is above other elements */
        }
        .print-button {
        text-align: center;
        display: inline-block;
        cursor: pointer;
        color: white;
        text-decoration: none;
        font-size: 16px;
        border-radius: 3px;
        transition: .3s;
    }

    @media print {
        #print-button {
            display: none !important;
        }

        #breadcrumb{
            display: none !important;
        }
        #cms{
            margin-left:100px;
        }
        #gridContainer{
            margin-left:-100px !important;
            padding:0px !important;

        }
        #sign{
            margin-left:700px !important;
        }

    }

    </style>
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header" style="display: flex; justify-content: space-between;">
                            <h3 class="card-title" style="font-weight: bold;">
                                <a>Registered Students</a>
                            </h3>


                        </div>
                        <div class="dx-viewport demo-container">
                            <div class="table-responsive p-0" id="gridContainer">

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <script src="https://code.jquery.com/jquery-3.6.0.min.js"
                integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
            <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/devextreme/21.1.4/js/dx.all.js"></script> -->
            <script src="https://cdn3.devexpress.com/jslib/23.1.3/js/dx.all.js"></script>
            <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
        </section>
        <script>
            window.jsPDF = window.jspdf.jsPDF;

            $(() => {
                $('#gridContainer').dxDataGrid({
                    dataSource: @json($data),
                    paging: {
                        pageSize: 5,
                    },
                    pager: {
                        showPageSizeSelector: true,
                        allowedPageSizes: [10, 20, 50],
                    },
                    remoteOperations: false,
                    searchPanel: {
                        visible: true,
                        highlightCaseSensitive: true,
                    },
                    groupPanel: {
                        visible: false
                    },
                    grouping: {
                        autoExpandAll: false,
                    },
                    // selection: {
                    //     mode: 'multiple',
                    // },
                    export: {
                        enabled: true,
                        formats: ['pdf', 'xlsx'],
                        // allowExportSelectedData: true,
                    },
                    onExporting(e) {
                        if (e.format === 'xlsx') {
                            const workbook = new ExcelJS.Workbook();
                            const worksheet = workbook.addWorksheet('Members');
                            DevExpress.excelExporter.exportDataGrid({
                                component: e.component,
                                worksheet,
                                autoFilterEnabled: true,
                            }).then(() => {
                                workbook.xlsx.writeBuffer().then((buffer) => {
                                    saveAs(new Blob([buffer], {
                                        type: 'application/octet-stream'
                                    }), 'Complain.xlsx');
                                });
                            });
                        } else if (e.format === 'pdf') {
                            const doc = new jsPDF();
                            DevExpress.pdfExporter.exportDataGrid({
                                jsPDFDocument: doc,
                                component: e.component,

                            }).then(() => {
                                doc.save('Complain.pdf');
                            });
                        }
                    },
                    allowColumnReordering: true,
                    rowAlternationEnabled: true,
                    showBorders: true,
                    columns: [
                        {
                            dataField: 'passenger_name',
                            caption: 'Name',
                            alignment: 'center',
                            cssClass: 'bullet',
                            // width: 100,
                        },
                        {
                            dataField: 'cnic',
                            caption: 'CNIC ',
                            alignment: 'center',
                            cssClass: 'bullet',
                        },
                        {
                        dataField: 'contact',
                        caption: 'Contact',
                        alignment: 'center',
                        cssClass: 'bullet',
                    },
                     {
                        dataField: 'dname',
                        caption: 'District',
                        alignment: 'center',
                        cssClass: 'bullet',
                    }, {
                        dataField: 'teh_name',
                        caption: 'Tehsil',
                        alignment: 'center',
                        cssClass: 'bullet',
                    },

                    {
                        dataField: 'org_name',
                        caption: 'Organization',
                        alignment: 'center',
                        cssClass: 'bullet',
                    },
                        {
                            dataField: '',
                            caption: 'Action',
                            alignment: 'center',
                            dataType: 'string',
                            cssClass: 'bullet',
                            cellTemplate: function(container, options) {
                                console.log(options.data.id);
                                $('<a style="color:white;" class="btn btn-sm btn-primary">')
                                    .attr('href', '/viewdetailappli/' + options.data.uid)
                                    .text('View Details')
                                    .appendTo(container);
                            },
                        }

                    ],
                    headerFilter: {
                        visible: true,
                        allowSearch: true,
                        showRelevantValues: true,
                    },
                    summary: {
                        totalItems: [{
                            column: "id", // Specify the column you want to count (you can change this to match your actual data field)
                            summaryType: "count",
                            displayFormat: "Total Count: {0}",
                        }, ],
                    },
                    onContentReady: function(e) {
                        $(e.element).find('.dx-datagrid-headers .bullet').css('background-color',
                            '#F0F8FF');
                    },
                });
            });
        </script>

    </div>
    </section>
    </div>

<script>
    $('.js__action--print').click(function() {
        // Hide elements with id 'none'
        $('#gridContainer #none').addClass('d');

        // Modify gridContainer classes
        $('#gridContainer').removeClass('container').addClass('container-fluid m');
        $('#breadcrumb').css('display', 'block');

        // Set landscape orientation for printing
        var css = '@page { size: landscape; }',
            head = document.head || document.getElementsByTagName('head')[0],
            style = document.createElement('style');

        style.type = 'text/css';
        style.media = 'print';

        if (style.styleSheet){
            style.styleSheet.cssText = css;
        } else {
            style.appendChild(document.createTextNode(css));
        }

        head.appendChild(style);

        // Wait for 3 seconds and then initiate printing
        setTimeout(() => {
            window.print();

            // Revert changes after printing
            $('#gridContainer #none').removeClass('d');
            $('#gridContainer').removeClass('container-fluid m').addClass('container');
            $('#breadcrumb').css('display', 'block');
        }, 3000);
    });
</script>


@endsection
