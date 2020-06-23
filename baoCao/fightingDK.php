<?php include 'masterheader.php'; ?>
<div class="container-fluid">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-white">
            <li class="breadcrumb-item active" aria-current="page">Fighting DK</li>
        </ol>
    </nav>
    <nav class="navbar navbar-light bg-white">
        <div class="card card-body mb-3">
            <table class="table table-hover table-bordered" style="text-align:center">
                <thead>
                    <tr  class="text-white" style="background-color: darkblue;">
                        <th>#</th>
                        <th>DK name</th>
                        <th>Belong to</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="listDK"></tbody>
            </table>
        </div>
    </nav>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        phanTrang();
        $("#alertt").hide();
    });

    function phanTrang() {
        $.ajax({
            url: 'loadresultDK.php',
            type: 'POST',
            success: function(data) {
                $("#listDK").html(data);
            }

        });
    }
</script>
<?php include 'masterfooter.php'; ?>