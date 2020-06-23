<?php include 'masterheader.php'; ?>
<?php
$sql        =    "SELECT * FROM tournament";
$rs            =    mysqli_query($conn, $sql);
$rowtotal    =    mysqli_num_rows($rs);
$pagesize    =    10;
$num    = ceil($rowtotal / $pagesize);
?>
<div class="container-fluid">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-white">
            <li class="breadcrumb-item active" aria-current="page">Fighting</li>
        </ol>
    </nav>
    <nav class="navbar navbar-light bg-white">
        <div class="card card-body">
            <table class="table table-hover table-bordered" style="text-align:center">
                <thead>
                    <tr class="text-white" style="background-color: darkblue;">
                        <th>#</th>
                        <th>Tour name</th>
                        <th>Organnizers</th>
                        <th>Accusative</th>
                        <th>Active</th>
                        <th>Status</th>

                    </tr>
                </thead>
                <tbody class="danhsach"></tbody>
            </table>
            <div class="row" style="margin-left:78%;">
                <?php
                //$num	=ceil($rowtotal/$pagesize);
                for ($i = 1; $i <= $num; $i++) {
                    echo '<button id="anphantrang" type="button" class="btn btn-raised btn-secondary" onclick="phanTrang(' . $i . ');">' . $i . '</button>&nbsp;&nbsp;&nbsp;';
                }

                ?>
            </div>
        </div>
    </nav>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        phanTrang(1);
    });

    function errorSetting() {
        alertify.error('You can\'t Fighting this tour when it was the end');
    }

    function phanTrang(i) {
        $.ajax({
            url: 'loadFighting.php?i=' + i,
            type: 'POST',
            success: function(response) {
                $('.danhsach').html(response);
                //$("#delete").attr("disabled", true);
                //$("#edit").attr("disabled", true);

            }
        })
    }
</script>
<?php include 'masterfooter.php'; ?>