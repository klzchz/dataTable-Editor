<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>DataTable Teste</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css">
        <link rel="stylesheet" href="https://editor.datatables.net/extensions/Editor/css/editor.dataTables.min.css">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
    <input type="text" id="_token" name="_token" value="{{ csrf_token() }}">
        <table id="example" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Position</th>
                    <th>Office</th>
                    <th>Extn.</th>
                    <th>Start date</th>
                    <th>Salary</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>Name</th>
                    <th>Position</th>
                    <th>Office</th>
                    <th>Extn.</th>
                    <th>Start date</th>
                    <th>Salary</th>
                </tr>
            </tfoot>
        </table>
        <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
        <script src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js"></script>
        <script src="https://editor.datatables.net/extensions/Editor/js/dataTables.editor.min.js"></script>
            <script src="{{url('js/dataTables.editor.js')}}"></script>
            {{-- <script src="{{url('js/dataTables.bootstrap.js')}}"></script> --}}
           
        <script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
        });
        
        var editor; // use a global for the submit and return data rendering in the examples
        
        $(document).ready(function() {
            editor = new $.fn.dataTable.Editor( {
                ajax: {
                    //  data:$('#_token').val(),
                    create: {
                        type: 'POST',
                        url:  "{{route('ajaxPost')}}",
                        data: $('#_token').val()
                    },
                    edit: {
                        type: 'POST',
                        url:  "{{route('ajaxPost')}}",
                        data: $('#_token').val()
                    },
                    remove: {
                        type: 'POST',
                        url:  "{{route('ajaxPost')}}",
                        data: $('#_token').val()
                    }
                },
                table: "#example",
                
                fields: [ {
                        label: "First name:",
                        name: "first_name"
                    }, {
                        label: "Last name:",
                        name: "last_name"
                    }, {
                        label: "Position:",
                        name: "position"
                    }, {
                        label: "Office:",
                        name: "office"
                    }, {
                        label: "Extension:",
                        name: "extn"
                    }, {
                        label: "Start date:",
                        name: "start_date",
                        type: "datetime"
                    }, {
                        label: "Salary:",
                        name: "salary"
                    }
                ]
            } );
        
            $('#example').DataTable( {
                dom: "Bfrtip",
                ajax: "{{route('ajax')}}",
                columns: [
                    { data: null, render: function ( data, type, row ) {
                        // Combine the first and last names into a single table field
                        return data.first_name+' '+data.last_name;
                    } },
                    { data: "position" },
                    { data: "office" },
                    { data: "extn" },
                    { data: "start_date" },
                    { data: "salary", render: $.fn.dataTable.render.number( ',', '.', 0, '$' ) }
                ],
                select: true,
                buttons: [
                    { extend: "create", editor: editor },
                    { extend: "edit",   editor: editor },
                    { extend: "remove", editor: editor }
                ]
            } );
        } );
        </script>
    </body>
</html>
