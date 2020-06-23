<?php include("masterheader.php") ?>
<?php
$dkID = $_GET["dkID"];
$tourID = $_GET["tourID"];
?>
<div class="comtainer-fuild">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-white">
            <li class="breadcrumb-item"><a href="dk.php">DK</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detail DK</li>
        </ol>
    </nav>
    <div class="container-fluid mb-2">
        <div class="col-2"> <button type="button" class="btn btn-success" onclick="location.href='finishDK.php?dkID=<?php echo $dkID; ?>'"><i class="fas fa-forward"></i></button> </div>
    </div>
    <nav class="navbar navbar-light bg-white">
        <div class="container-fluid">
            <div class="col-4" style="margin-left: 60%;">
                <input type="text" id="tim" class="form-control" placeholder="Search..." onclick="doSearch();">
            </div>
        </div>
    </nav>
<!-- load list -->
    <nav class="navbar navbar-light bg-white">
        <div class="card card-body mb-3">
            <div class="row ml-1 mb-2"><button class="btn btn-danger" name="btn_insert" id="btn_insert">Insert</button></div>
            <table class="table table-hover table-bordered" style="text-align:center">
                <thead>
                    <tr class="text-white" style="background-color: darkblue;">
                        <th><input type="checkbox" id="checkAll"></th>
                        <th>#</th>
                        <th>Pug Name</th>
                        <th>DOB</th>
                        <th>Team Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="listDetailDK"></tbody>
            </table>
        </div>
    </nav>
<!-- end load list -->

</div>
<script type="text/javascript">
    $(document).ready(function() {
        phanTrang();
    });

    $('#checkAll').click(function() {
        if ($("#checkAll").is(":checked")) {
            // do something if the checkbox is NOT checked
            $('input:checkbox').prop('checked', this.checked)
            //$("#btn_delete").show();
        } else {
            $('input:checkbox').prop('checked', false)
            //$("#btn_delete").hide();
        }

    });

    $('#btn_insert').click(function() {
        var id = [];
        $(':checkbox:checked').each(function(i) {
            id[i] = $(this).val();
        });
        if (id.length === 0) //tell you if the array is empty
        {
            // alert("Please Select atleast one checkbox");
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Please Select one checkbox to insert',
                //footer: '<a href>Why do I have this issue?</a>'
            })

        }
        //alert(JSON.stringify(id));
        else {
            var dkID = '<?php echo $dkID; ?>';
            //alert(dkID);
            $.ajax({
                url: 'insertMuliPugDK.php',
                method: 'POST',
                data: {
                    id: id,
                    dkID: dkID
                },
                success: function(data) {
                    //$("#countTeam").text(data);
                    Swal.fire({
                        position: 'top',
                        icon: 'success',
                        //title: 'Your work has been saved',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    phanTrang();
                }

            });
        }
    })


    function phanTrang() {
        var dkID = '<?php echo $dkID ?>';
        var tourID = '<?php echo $tourID ?>';
        $.ajax({
            url: 'loadDetailDK.php',
            type: 'POST',
            data: {
                dkID: dkID,
                tourID: tourID
            },
            success: function(data) {
                $("#listDetailDK").html(data);
            }
        });
    }

    function error() {
        alertify.error('You added it');
    }

    function insertDetailDK(pugID, dkID) {
        $.ajax({
            url: 'xuLyInsertDKPug.php',
            type: 'POST',
            data: {
                pugID: pugID,
                dkID: dkID
            },
            success: function(data) {
                phanTrang();
               
                alertify.success('Add Success');
            }
        })
    }

    function doSearch() {
        $("#tim").keyup(function() {
            var tim = $("#tim").val();
            var dkID = <?php echo $dkID ?>;
            $.ajax({
                url: 'searchDetailDK.php',
                type: 'POST',
                data: {
                    tim: tim,
                    dkID: dkID
                },
                success: function(data) {
                    if (tim == "") {
                        phanTrang();
                    } else {
                        $('#listDetailDK').html(data);
                    }

                }
            })

        })
    }
</script>
<?php include("masterfooter.php") ?>