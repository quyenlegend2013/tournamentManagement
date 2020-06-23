<?php
require("connect/connect.php");
session_start();
if ($_SESSION["user"] == "") {
  header("location:login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

  <title>Tournament Management</title>
  <link rel="SHORTCUT ICON" href="img/co.png">
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
  <!-- Custom styles for this template -->
  <link rel="stylesheet" type="text/css" href="css/simple-sidebar.css" />
  <script type="text/javascript" src="js/jquery-3.3.1.js"></script>
  <link rel="stylesheet" type="text/css" href="css/style.css" />
  <link rel="stylesheet" type="text/css" href="css/alertify.min.css" />
  <link rel="stylesheet" type="text/css" href="css/all.css" />
  <link rel="stylesheet" type="text/css" href="css/regular.css" />
  <link rel="stylesheet" type="text/css" href="css/sweetalert2.min.css" />

  <script src="js/Chart.min.js"></script>
  <style type="text/css">
    a {
      text-decoration: none !important;
    }

    button {
      text-decoration: none !important;
    }
  </style>
</head>

<body>

  <div class="container-fluid sticky-top">
    <div class="row align-items-center " style="background-color: darkblue;">
      <div class="col-10 text-white mt-2 mb-2">
        <h2><span style="color: #E67E22;">Tournament</span> <span style="color: blue;"> Management</span>
      </div>
      <div class="col-1 text-light"><?php echo $_SESSION["user"]; ?></div>
      <a href="logout.php" class="col-1" style="color: blue;">Logout</a>

    </div>
  </div>

  <div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <div class="border-right" style="background-color: darkblue;" id="sidebar-wrapper">
      <!-- <div class="sidebar-heading text-center"><b style="font-size:25px;">Teakwondo</b></div> -->
      <div class="list-group">

        <div id="accordion">

          <div class="card-header" style="background-color: darkblue;" id="headingOne">
            <h5 class="mb-0">
              <button class="btn btn-link collapsed text-light" onclick="location.href='dashboard.php'" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                Home
              </button>
            </h5>
          </div>


          <div class="card-header" style="background-color: darkblue;" id="headingTwo">
            <h5 class="mb-0">
              <button class="btn btn-link collapsed text-light" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                Tournament
              </button>
            </h5>
          </div>

          <div id="collapseTwo" class="collapse" style="background-color: darkblue;" aria-labelledby="headingTwo" data-parent="#accordion">
            <div class="card-body">
              <a href="exam.php" class="list-group-item text-primary" style="background-color: darkblue;">Tournament List</a>
              <a href="fighting.php" class="list-group-item text-primary" style="background-color: darkblue;">Fighting</a>
              <a href="result.php" class="list-group-item text-primary" style="background-color: darkblue;">Result</a>
            </div>
          </div>


          <div class="card-header" id="headingThree" style="background-color: darkblue;">
            <h5 class="mb-0">
              <button class="btn btn-link collapsed text-light" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                Tournament DK
              </button>
            </h5>
          </div>
          <div id="collapseThree" class="collapse" style="background-color: darkblue;" aria-labelledby="headingThree" data-parent="#accordion">
            <div class="card-body">
              <a href="dk.php" class="list-group-item text-primary" style="background-color: darkblue;">Tournament DK List</a>
              <a href="fightingDK.php" class="list-group-item text-primary" style="background-color: darkblue;">Fighting DK</a>
              <a href="resultDK.php" class="list-group-item text-primary" style="background-color: darkblue;">Result DK</a>
            </div>
          </div>

          <div class="card-header" style="background-color: darkblue;" id="headingFour">
            <h5 class="mb-0">
              <button class="btn btn-link collapsed text-light" onclick="location.href='content.php'" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
                Content
              </button>
            </h5>
          </div>

          <div class="card-header" style="background-color: darkblue;" id="headingFive">
            <h5 class="mb-0">
              <button class="btn btn-link collapsed text-light" onclick="location.href='team.php'" data-toggle="collapse" data-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive">
                Team
              </button>
            </h5>
          </div>

          <div class="card-header" style="background-color: darkblue;" id="headingSix">
            <h5 class="mb-0">
              <button class="btn btn-link collapsed text-light" onclick="location.href='pugilist.php'" data-toggle="collapse" data-target="#collapseSix" aria-expanded="true" aria-controls="collapseSix">
                Pugilist
              </button>
            </h5>
          </div>

        </div>


        <!-- <a href="dashboard.php" class="list-group-item text-light" style="background-color: darkblue;">Home</a> -->
        <!-- <a href="exam.php" class="list-group-item text-light" style="background-color: darkblue;">Tournament</a> -->
        <!-- <a href="dk.php" class="list-group-item text-light" style="background-color: darkblue;">Tournament DK</a> -->
        <!-- <a href="content.php" class="list-group-item text-light" style="background-color: darkblue;">Content</a> -->
        <!-- <a href="team.php" class="list-group-item text-light" style="background-color: darkblue;">Team</a> -->
        <!-- <a href="pugilist.php" class="list-group-item text-light" style="background-color: darkblue;">Pugilist</a> -->
        <!-- <a href="fighting.php" class="list-group-item text-light" style="background-color: darkblue;">Fighting</a> -->
        <!-- <a href="fightingDK.php" class="list-group-item text-light" style="background-color: darkblue;">Fighting DK</a> -->
        <!-- <a href="result.php" class="list-group-item text-light" style="background-color: darkblue;">Result</a> -->
        <!-- <a href="statistics.php" class="list-group-item text-light" style="background-color: darkblue;">Statistics</a> -->
      </div>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper" style="background-color: ghostwhite;">

      <nav class="navbar navbar-expand-lg navbar-light">
        <button class="btn btn-info" id="menu-toggle"><i class="fas fa-bars"></i></button>
        <!--<button class="btn btn-dark" id="menu-toggle" style="margin-left:8px">Theme</button>-->

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      </nav>