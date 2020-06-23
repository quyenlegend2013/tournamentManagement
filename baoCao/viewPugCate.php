<?php include 'masterheader.php'; ?>
<?php
$tourcateID = $_GET["tourcateID"];
$tourID = $_GET["tourID"];
//$cateID = $_GET["cateID"];
$cateSex = $_GET["cateSex"];
$sqlCateName = "SELECT c.cateName FROM categories c INNER JOIN tourcate tc ON tc.cateID=c.cateID WHERE tc.tourcateID='$tourcateID'";
$queryCateName = mysqli_query($conn, $sqlCateName);
$revalCateName = mysqli_fetch_array($queryCateName);
?>
<div class="container-fluid">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-white">
            <li class="breadcrumb-item"><a href="exam.php">Tournament</a></li>
            <li class="breadcrumb-item"><a href="detailTour.php?tourID=<?php echo $tourID; ?>">Detail tournament</a></li>
            <li class="breadcrumb-item active" aria-current="page">Insert pugilist of categories</li>
        </ol>
    </nav>
    <div class="container-fluid">

    </div>
    <nav class="navbar navbar-light bg-white">
        <div class="card card-body">
            <!-- <h3>Puglist of team</h3> -->

            <div class="row">
                <div class="col-7">
                    <h3>Puglist of team</h3>
                </div>
            </div>
            <div class="row mb-1">
                <div class="col-2" style="margin-left: 2%;"><button class="btn btn-warning" name="btn_insert" id="btn_insert">Insert</button></div>
                <div class="col-5" style="margin-left: 35%;">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search..." id="tim" onClick="searchPug();" aria-label="Recipient's username" aria-describedby="basic-addon2">
                    </div>
                </div>

            </div>

            <table class="table table-hover table-bordered" style="text-align:center">
                <thead>
                    <tr class="text-white" style="background-color: darkblue;">
                        <th><input type="checkbox" id="checkAll"></th>
                        <th>#</th>
                        <th>Pug name</th>
                        <th>Dob</th>
                        <th>Gender</th>
                        <th>Active</th>
                    </tr>
                </thead>
                <tbody class="listShowPug"></tbody>
            </table>
        </div>
    </nav>
    <nav class="navbar navbar-light bg-white">
        <div class="card card-body">
            <h3>Puglist added in <?php echo $revalCateName["cateName"]; ?></h3>
            <table class="table" style="text-align:center">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Pug name</th>
                        <th>Dob</th>
                        <th>Gender</th>
                        <th>Active</th>
                    </tr>
                </thead>
                <tbody class="listShowPugAdded"></tbody>
            </table>
        </div>
    </nav>
    <div class="row mt-2 mb-2" style="margin-left:85%;">
        <button type="button" class="btn btn-primary" onclick="location.href='detailTour.php?tourID=<?php echo $tourID; ?>'"><i class="fas fa-caret-square-left"></i></button>
    </div>



    <script type="text/javascript">
        $(document).ready(function() {
            listShowPug();
            listShowPugAdded();
        });

        $('#checkAll').click(function() {
            if ($("#checkAll").is(":checked")) {
                // do something if the checkbox is NOT checked
                $('input:checkbox').prop('checked', this.checked)
                //$("#btn_delete").show();
            } else {
                $('input:checkbox').prop('checked', false)
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
                var tourcateID = '<?php echo $tourcateID; ?>'
                $.ajax({
                    url: 'insertMuliPugCate.php',
                    method: 'POST',
                    data: {
                        id: id,
                        tourcateID: tourcateID
                    },
                    success: function(data) {
                        listShowPug();
                        listShowPugAdded();
                        //alert(data);
                        //$("#countContent").text(data);
                        Swal.fire({
                            position: 'top',
                            icon: 'success',
                            //title: 'Your work has been saved',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }

                });

            }
        })

        function listShowPug() {
            var tourcateID = '<?php echo $tourcateID ?>';
            var tourID = '<?php echo $tourID ?>';
            var cateSex = '<?php echo $cateSex ?>';

            $.ajax({
                url: 'showTourPug.php',
                type: 'POST',
                data: {
                    tourcateID: tourcateID,
                    tourID: tourID,
                    cateSex: cateSex
                },
                success: function(response) {
                    $('.listShowPug').html(response);
                    //$("#delete").attr("disabled", true);
                    //$("#edit").attr("disabled", true);
                    listShowPugAdded();
                }
            })
        }

        function listShowPugAdded() {
            var tourcateID = "<?php echo $tourcateID ?>";

            $.ajax({
                url: 'showTourPugAdded.php',
                type: 'POST',
                data: {
                    tourcateID: tourcateID,
                },
                success: function(response) {
                    $('.listShowPugAdded').html(response);
                    //$("#delete").attr("disabled", true);
                    //$("#edit").attr("disabled", true);

                }
            })
        }

        function deletePugAdded(pugID, tourcateID) {
            //alert(pugID+"-"+tourcateID);
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
                        url: 'deletePugCateAdded.php',
                        method: 'POST',
                        data: {
                            pugID: pugID,
                            tourcateID: tourcateID
                        },
                        success: function(data) {

                            listShowPugAdded();
                            listShowPug();
                        },

                    });
                    Swal.fire(
                        'Deleted!',
                        'success'
                    )
                }
            })
        }

        function error() {
            alertify.error('You added this pugilist');
        }

        function insertTourPugCate(pugID, tourcateID) {
            //alert(pugID+"-"+tourcateID);
            $.ajax({
                url: 'xulyViewPugCate.php',
                type: 'POST',
                data: {
                    tourcateID: tourcateID,
                    pugID: pugID
                },
                success: function(data) {
                    listShowPug();
                    // Swal.fire({
                    //     position: 'end',
                    //     icon: 'success',
                    //     //title: 'Your work has been saved',
                    //     showConfirmButton: false,
                    //     timer: 1500
                    // })
                    alertify.success('Add Success');

                }
            });
        }
    </script>
    <?php include 'masterfooter.php'; ?>