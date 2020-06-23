<?php include("masterheader.php") ?>
<?php
$sql        =    " SELECT * FROM dkpug ddk INNER JOIN pugilist p ON ddk.pugID=p.pugID";
$rs           =    mysqli_query($conn, $sql);
$rowtotal    =    mysqli_num_rows($rs);
$pagesize    =    10;
$num    = ceil($rowtotal / $pagesize);
$dkID = $_GET["dkID"];
?>
<div class="container-fluid">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-white">
            <li class="breadcrumb-item"><a href="dk.php">DK</a></li>
            <li class="breadcrumb-item"><a href="detailDK.php?dkID=<?php echo $dkID; ?>">Detail DK</a></li>
            <li class="breadcrumb-item active" aria-current="page">Finish</li>
        </ol>
    </nav>
    <nav class="navbar navbar-light bg-white">
        <div class="container-fluid">
            <div class="col-2"><button type="button" class="btn btn-success" onclick="location.href='dk.php'"><i class="fa fa-check"></i></button></div>
        </div>
    </nav>
    <!-- load list -->
    <nav class="navbar navbar-light bg-white">
        <div class="card card-body">
            <table class="table table-hover table-bordered" style="text-align:center">
                <thead>
                    <tr class="text-white" style="background-color: darkblue;">
                        <th>#</th>
                        <th>Pug Name</th>
                        <th>Dob</th>
                        <th>Team Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="listFinishDetailDK"></tbody>
            </table>
        </div>
    </nav>
    <!-- end load list -->
</div>
<script type="text/javascript">
    $(document).ready(function() {
        phanTrang(1);
    });

    function phanTrang(i) {
        var dkID = "<?php echo $dkID; ?>";
        //alert(dkID);
        $.ajax({
            url: 'loadListFinishDetailDK.php',
            type: 'POST',
            data: {
                i: i,
                dkID: dkID
            },
            success: function(data) {
                $("#listFinishDetailDK").html(data);
            }
        })
    }

    function deletedkpug(pugID, dkID) {
        // alert(pugID+"-"+dkID);
        Swal.fire({
            title: 'Are you sure delete this it?',
            // text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#00a550',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: 'deletepugDK.php',
                    method: 'POST',
                    data: {
                        pugID: pugID,
                        dkID: dkID
                    },
                    success: function(data) {

                        phanTrang(1);
                    },

                });
                Swal.fire(
                    'Deleted!',
                    'success'
                )
            }
        })
    }
</script>

<?php include("masterfooter.php") ?>