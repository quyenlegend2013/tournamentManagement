<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tournament Management</title>
    <link rel="stylesheet" type="text/css" href="css/handsontable.full.min.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <script src="js/handsontable.full.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <script type="text/javascript" src="js/jquery-3.3.1.js"></script>
    <script type="text/javascript" src="js/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/alertify.min.css" />
    <script type="text/javascript" src="js/alertify.min.js"></script>
</head>
<script type="text/javascript">
    $(document).ready(function(e) {
        exportExam();
    });

    function exportExam() {
        var dkID = '<?php echo $_GET["dkID"]; ?>';
        $.ajax({
            url: 'DataHandsomeFightingDK.php',
            type: 'POST',
            data: {
                dkID: dkID
            },
            dataType: 'JSON',
            success: function(data) {
                var container = document.getElementById('example');
                var hot = new Handsontable(container, {
                    data: data,
                    autoWrapRow: true,
                    //rowHeaders: true,
                    colHeaders: true,
                    filters: true,
                    dropdownMenu: true,
                    manualRowMove: true,
                    manualColumnMove: true,
                    contextMenu: true,
                    maxRows: 100,
                    hiddenColumns: {
                        columns: [0],
                        indicators: true
                    },
                    colHeaders: [
                        'DK ID',
                        'Pugilist ID',
                        'Full name',
                        'DOB',
                        'Gender',
                        'Level',
                        'Team Name',
                        'Rank'
                    ],
                    columns: [{
                            data: 'dkID',
                            readOnly: true
                        },

                        {
                            data: 'pugID',
                            readOnly: true
                        },
                        {
                            data: 'pugName',
                            readOnly: true

                        },
                        {
                            data: 'dob',
                            readOnly: true
                        },
                        {
                            data: 'gender',
                            //dateFormat: 'MM/DD/YYYY'
                            readOnly: true

                        },

                        {
                            data: 'level',
                            readOnly: true

                        },
                        {
                            data: 'teamName',
                            readOnly: true
                        },
                        {
                            data: 'rank',
                            type: 'numeric',

                        }
                    ]

                });
                var exportFiles = document.getElementById('export');
                var exportPlugin1 = hot.getPlugin('exportFile');

                exportFiles.addEventListener('click', function() {
                    exportPlugin1.downloadFile('csv', {
                        bom: true,
                        columnDelimiter: ',',
                        columnHeaders: true,
                        exportHiddenColumns: true,
                        exportHiddenRows: true,
                        fileExtension: 'csv',
                        filename: 'report-CSV-file_[YYYY]-[MM]-[DD]',
                        mimeType: 'text/csv',
                        rowDelimiter: '\r\n',
                        rowHeaders: true
                    });
                });

                var save = document.getElementById('save');
                Handsontable.dom.addEvent(save, 'click', function() {
                    // save all cell's data
                    var saveData = JSON.stringify(hot.getData());
                    //alert(saveData);
                    $.ajax({
                        url: 'savedkpug.php',
                        type: 'POST',
                        data: {
                            saveData: saveData
                        },
                        success: function(data) {
                            Swal.fire({
                                position: 'end',
                                icon: 'success',
                                //title: 'Your work has been saved',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            //alertify.success('Add Success');
                        }
                    })

                });

            }
        })
    }
</script>

<body>
    <button type="button" id="export" class="btn btn-warning mt-2 ml-3">export file</button>
    <button type="button" id="save" class="btn btn-success mt-2 ml-3">Save</button>
    <div id="example" class="mt-2 ml-3"></div>
</body>

</html>