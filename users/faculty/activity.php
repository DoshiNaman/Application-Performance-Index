<?php

  //database connection
  include '../../db.php';

  //check user & their profile exist
  if(!isset($_SESSION["id"]) OR !isset($_SESSION["fprofile"])){
    echo"
    <script>
        location.href = '../../index.php';
    </script>
    ";
  }

  
  if($_SESSION["fprofile"] != 1){
    echo"
    <script>
        location.href = 'profile.php';
    </script>
    ";
  }

  $tpoint=0;
  $vpoint=0;

  $tlppoint=0;
  $grpoint=0;
  $descpoint=0;
  $dppoint=0;
  $ippoint=0;
  $ctspoint=0;
  $raa1point=0;
  $raa2point=0;
  $raa3point=0;
  $raa4point=0;
  $raa5point=0;
  $raa6point=0;
  $raa7point=0;
  $raa8point=0;
  $raa9point=0;
  $raa10point=0;
  $invpoint=0;
  $aopoint=0;

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>API</title>
    <!--Bootstrap CSS-->
    <link
      rel="stylesheet"
      href="../../assets/bootstrap-5.3.0-alpha1-dist/css/bootstrap.min.css"
    />
    <!--Blury Image CSS-->
    <link rel="stylesheet" href="../../assets/css/blurry-load.min.css" />
    <!--Font CSS-->
    <link href="../../assets/icons/fontawesome-free-6.3.0-web/css/fontawesome.css" rel="stylesheet">
    <link href="../../assets/icons/fontawesome-free-6.3.0-web/css/brands.css" rel="stylesheet">
    <link href="../../assets/icons/fontawesome-free-6.3.0-web/css/solid.css" rel="stylesheet">
    <!--External CSS-->
    <link rel="stylesheet" href="../../assets/css/base.css" />
    <link rel="apple-touch-icon" sizes="180x180" href="../../assets/icons/favicon_io/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../../assets/icons/favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../../assets/icons/favicon_io/favicon-16x16.png">
    <link rel="manifest" href="../../assets/icons/favicon_io/site.webmanifest">
    <!--JQuery JS-->
    <script src="../../assets/js/jquery-3.6.3.min.js"></script>
  </head>
  <body>
    <div class="toast-container position-fixed top-0 end-0 p-3">
      <div id="danger" class="toast border bg-danger bg-gradient bg-opacity-75 text-white" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex" data-bs-theme="dark">
          <div class="toast-body toastmsg">
            Hello, world! This is a toast message.
          </div>
          <button type="button" class="btn-close me-2 m-auto fw-bolder" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
      </div>
      <div id="success" class="toast border bg-success bg-gradient bg-opacity-75 text-white" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex" data-bs-theme="dark">
          <div class="toast-body toastmsg">
            Hello, world! This is a toast message.
          </div>
          <button type="button" class="btn-close me-2 m-auto fw-bolder" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
      </div>
    </div>
    <div class="container mt-5 mb-5 rounded shadow-lg base">
      <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
          <img
            src="../../assets/img/gu-logo.png"
            data-large="../../assets/img/gu-logo.png"
            alt="GU LOGO"
            class="navbar-brand blurry-load"
            height="70"
            role="button"
            onclick="location.href = '../../index.php';"
          />
          <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="offcanvas"
            data-bs-target="#navbarOffcanvasLg"
            aria-controls="navbarOffcanvasLg"
          >
            <span class="navbar-toggler-icon"></span>
          </button>
          <div
            class="offcanvas offcanvas-end"
            tabindex="-1"
            id="navbarOffcanvasLg"
            aria-labelledby="navbarOffcanvasLgLabel"
          >
            <div class="offcanvas-header">
              <h5 class="offcanvas-title" id="offcanvasNavbarLabel">API</h5>
              <button
                type="button"
                class="btn-close"
                data-bs-dismiss="offcanvas"
                aria-label="Close"
              ></button>
            </div>
            <div class="offcanvas-body">
              <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                <li class="nav-item">
                    <a class="nav-link linkclass" href="home.php">
                        <img
                        alt=""
                        src="../../assets/icons/home.png"
                        data-large="../../assets/icons/home.png"
                        class="goldicon goldicon1 blurry-load"
                        />
                        Home</a
                    >
                </li>
                <li class="nav-item">
                    <a class="nav-link linkclass" href="profile.php">
                        <img
                        alt=""
                        src="../../assets/icons/person.png"
                        data-large="../../assets/icons/person.png"
                        class="goldicon goldicon1 blurry-load"
                        />
                        Profile</a
                    >
                </li>
                <li class="nav-item">
                    <a class="nav-link linkclass" href="../../logout.php">
                        <img
                        alt=""
                        src="../../assets/icons/allout.png"
                        data-large="../../assets/icons/allout.png"
                        class="goldicon blurry-load"
                        />
                        LogOut</a
                    >
                </li>
                <?php 
                if(isset($_SESSION["id"]) && isset($_SESSION["role"])){
                  echo '';
                }
                ?>
              </ul>
            </div>
          </div>
        </div>
      </nav>
      
      <div class="row p-2 gap-4">
        <div class="col-lg p-2 mb-1 bg-body rounded border border border-2">
          <div class="form-group">
            <p class="form-control snip1337"> Verified or Locked Activity </p>
            <form method="POST" action="" class="p-2" enctype="multipart/form-data" class="table-responsive">
                <table class="table table-hover" id="table22">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Criteria</th>
                    <th scope="col">Element</th>
                    <th scope="col">Points</th>
                    <th scope="col">Verify</th>
                    <th scope="col">Comment</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $i=1;
                    $a=$_SESSION["id"];
                    //TLP
                    $sql = "SELECT * FROM TLP WHERE id='".$a."' AND log<'".date("Y")."-07-01' AND log>='".date("Y", time() - 60*60*24*365 )."-07-01' ORDER BY log DESC";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                      while($row = mysqli_fetch_assoc($result)) {
                        if($row["verify"]==1 or $row["locked"]==1){
                          echo ' <tr>
                          <th scope="row">'.$i.'</th>
                          <td>TLP</td>
                          <td>'.$row["subject"].'</td>
                          ';
                          if($row["point"]>0){
                            echo '<td><i class="fa-solid fa-plus" style="color: #73ff5a;"></i>&nbsp;'.number_format((float)$row["point"], 2, '.', '').'</td>';
                          }
                          else if($row["point"]<0){
                            echo '<td><i class="fa-solid fa-minus" style="color: #ff5a91;"></i>&nbsp;'.number_format((float)$row["point"], 2, '.', '').'</td>';
                          }
                          else{
                            echo '<td>&nbsp;&nbsp;&nbsp;&nbsp;'.number_format((float)$row["point"], 2, '.', '').'</td>';
                          }
                          
                          
                          if($row["verify"] == 1){
                            echo '<td><i class="fa-solid fa-circle-check fs-5"></i></td>';
                          }
                          else{
                            echo '<td>-</td>';
                          }

                          if($row["comment"]){
                          echo'<td>'.$row["comment"].'</td>';
                          }else{
                            echo'<td>-</td>';

                          }
                          echo'
                          </tr>';
                          $i=$i+1;
                          $tpoint=$tpoint+$row["point"];
                        }
                        if($row["verify"]==1){$tlppoint=$tlppoint+$row["point"];}
                      }
                    }
                    //GR
                    $sql2 = "SELECT * FROM GR WHERE id='".$a."' AND log<'".date("Y")."-07-01' AND log>='".date("Y", time() - 60*60*24*365 )."-07-01' ORDER BY log DESC";
                    $result = mysqli_query($conn, $sql2);
                    if (mysqli_num_rows($result) > 0) {
                      while($row = mysqli_fetch_assoc($result)) {
                        if($row["verify"]==1 or $row["locked"]==1){
                          echo ' <tr>
                          <th scope="row">'.$i.'</th>
                          <td>GR</td>
                          <td>'.$row["subject"].'</td>
                          ';
                          if($row["point"]>0){
                            echo '<td><i class="fa-solid fa-plus" style="color: #73ff5a;"></i>&nbsp;'.number_format((float)$row["point"], 2, '.', '').'</td>';
                          }
                          else if($row["point"]<0){
                            echo '<td><i class="fa-solid fa-minus" style="color: #ff5a91;"></i>&nbsp;'.number_format((float)$row["point"], 2, '.', '').'</td>';
                          }
                          else{
                            echo '<td>&nbsp;&nbsp;&nbsp;&nbsp;'.number_format((float)$row["point"], 2, '.', '').'</td>';
                          }
                          if($row["verify"] == 1){
                            echo '<td><i class="fa-solid fa-circle-check fs-5"></i></td>';
                          }
                          else{
                            echo '<td>-</td>';
                          }

                          if($row["comment"]){
                            echo'<td>'.$row["comment"].'</td>';
                          }else{
                            echo'<td>-</td>';
                          }
                          echo'
                          </tr>';
                          $i=$i+1;
                          $tpoint=$tpoint+$row["point"];
                        }
                        if($row["verify"]==1){$grpoint=$grpoint+$row["point"];}
                      }
                    }
                    //DISC
                    $sql3 = "SELECT * FROM DISC WHERE id='".$a."' AND log<'".date("Y")."-07-01' AND log>='".date("Y", time() - 60*60*24*365 )."-07-01' ORDER BY log DESC";
                    $result = mysqli_query($conn, $sql3);
                    if (mysqli_num_rows($result) > 0) {
                      while($row = mysqli_fetch_assoc($result)) {
                        if($row["verify"]==1 or $row["locked"]==1){
                          echo ' <tr>
                          <th scope="row">'.$i.'</th>
                          <td>DISC</td>
                          <td>'.$row["id"].'</td>
                          ';
                          if($row["point"]>0){
                            echo '<td><i class="fa-solid fa-plus" style="color: #73ff5a;"></i>&nbsp;'.number_format((float)$row["point"], 2, '.', '').'</td>';
                          }
                          else if($row["point"]<0){
                            echo '<td><i class="fa-solid fa-minus" style="color: #ff5a91;"></i>&nbsp;'.number_format((float)$row["point"], 2, '.', '').'</td>';
                          }
                          else{
                            echo '<td>&nbsp;&nbsp;&nbsp;&nbsp;'.number_format((float)$row["point"], 2, '.', '').'</td>';
                          }
                          if($row["verify"] == 1){
                            echo '<td><i class="fa-solid fa-circle-check fs-5"></i></td>';
                          }
                          else{
                            echo '<td>-</td>';
                          }

                          if($row["comment"]){
                            echo'<td>'.$row["comment"].'</td>';
                          }else{
                            echo'<td>-</td>';
                          }
                          echo'
                          </tr>';
                          $i=$i+1;
                          $tpoint=$tpoint+$row["point"];
                        }
                        if($row["verify"]==1){$descpoint=$descpoint+$row["point"];}
                      }
                    }
                    //DP
                    $sql3 = "SELECT * FROM DP WHERE id='".$a."' AND log<'".date("Y")."-07-01' AND log>='".date("Y", time() - 60*60*24*365 )."-07-01' ORDER BY log DESC";
                    $result = mysqli_query($conn, $sql3);
                    if (mysqli_num_rows($result) > 0) {
                      while($row = mysqli_fetch_assoc($result)) {
                        if($row["verify"]==1 or $row["locked"]==1){
                          echo ' <tr>
                          <th scope="row">'.$i.'</th>
                          <td>DP</td>
                          <td>'.$row["name"].'</td>
                          ';
                          if($row["point"]>0){
                            echo '<td><i class="fa-solid fa-plus" style="color: #73ff5a;"></i>&nbsp;'.number_format((float)$row["point"], 2, '.', '').'</td>';
                          }
                          else if($row["point"]<0){
                            echo '<td><i class="fa-solid fa-minus" style="color: #ff5a91;"></i>&nbsp;'.number_format((float)$row["point"], 2, '.', '').'</td>';
                          }
                          else{
                            echo '<td>&nbsp;&nbsp;&nbsp;&nbsp;'.number_format((float)$row["point"], 2, '.', '').'</td>';
                          }
                          if($row["verify"] == 1){
                            echo '<td><i class="fa-solid fa-circle-check fs-5"></i></td>';
                          }
                          else{
                            echo '<td>-</td>';
                          }

                          if($row["comment"]){
                            echo'<td>'.$row["comment"].'</td>';
                          }else{
                            echo'<td>-</td>';
                          }
                          echo'
                          </tr>';
                          $i=$i+1;
                          $tpoint=$tpoint+$row["point"];
                        }
                        if($row["verify"]==1){$dppoint=$dppoint+$row["point"];}
                      }
                    }
                    //IP
                    $sql3 = "SELECT * FROM IP WHERE id='".$a."' AND log<'".date("Y")."-07-01' AND log>='".date("Y", time() - 60*60*24*365 )."-07-01' ORDER BY log DESC";
                    $result = mysqli_query($conn, $sql3);
                    if (mysqli_num_rows($result) > 0) {
                      while($row = mysqli_fetch_assoc($result)) {
                        if($row["verify"]==1 or $row["locked"]==1){
                          echo ' <tr>
                          <th scope="row">'.$i.'</th>
                          <td>IP</td>
                          <td>'.$row["name"].'</td>
                          ';
                          if($row["point"]>0){
                            echo '<td><i class="fa-solid fa-plus" style="color: #73ff5a;"></i>&nbsp;'.number_format((float)$row["point"], 2, '.', '').'</td>';
                          }
                          else if($row["point"]<0){
                            echo '<td><i class="fa-solid fa-minus" style="color: #ff5a91;"></i>&nbsp;'.number_format((float)$row["point"], 2, '.', '').'</td>';
                          }
                          else{
                            echo '<td>&nbsp;&nbsp;&nbsp;&nbsp;'.number_format((float)$row["point"], 2, '.', '').'</td>';
                          }
                          if($row["verify"] == 1){
                            echo '<td><i class="fa-solid fa-circle-check fs-5"></i></td>';
                          }
                          else{
                            echo '<td>-</td>';
                          }

                          if($row["comment"]){
                            echo'<td>'.$row["comment"].'</td>';
                          }else{
                            echo'<td>-</td>';
                          }
                          echo'
                          </tr>';
                          $i=$i+1;
                          $tpoint=$tpoint+$row["point"];
                        }
                        if($row["verify"]==1){$ippoint=$ippoint+$row["point"];}
                      }
                    }
                    //CTC
                    $sql3 = "SELECT * FROM CTS WHERE id='".$a."' AND log<'".date("Y")."-07-01' AND log>='".date("Y", time() - 60*60*24*365 )."-07-01' ORDER BY log DESC";
                    $result = mysqli_query($conn, $sql3);
                    if (mysqli_num_rows($result) > 0) {
                      while($row = mysqli_fetch_assoc($result)) {
                        if($row["verify"]==1 or $row["locked"]==1){
                          echo ' <tr>
                          <th scope="row">'.$i.'</th>
                          <td>CTS</td>
                          <td>'.$row["date"].'</td>
                          ';
                          if($row["point"]>0){
                            echo '<td><i class="fa-solid fa-plus" style="color: #73ff5a;"></i>&nbsp;'.number_format((float)$row["point"], 2, '.', '').'</td>';
                          }
                          else if($row["point"]<0){
                            echo '<td><i class="fa-solid fa-minus" style="color: #ff5a91;"></i>&nbsp;'.number_format((float)$row["point"], 2, '.', '').'</td>';
                          }
                          else{
                            echo '<td>&nbsp;&nbsp;&nbsp;&nbsp;'.number_format((float)$row["point"], 2, '.', '').'</td>';
                          }
                          if($row["verify"] == 1){
                            echo '<td><i class="fa-solid fa-circle-check fs-5"></i></td>';
                          }
                          else{
                            echo '<td>-</td>';
                          }

                          if($row["comment"]){
                            echo'<td>'.$row["comment"].'</td>';
                          }else{
                            echo'<td>-</td>';
                          }
                          echo'
                          </tr>';
                          $i=$i+1;
                          $tpoint=$tpoint+$row["point"];
                        }
                        if($row["verify"]==1){$ctspoint=$ctspoint+$row["point"];}
                      }
                    }
                    //RAA1
                    $sql3 = "SELECT * FROM RAA1 WHERE id='".$a."' AND log<'".date("Y")."-07-01' AND log>='".date("Y", time() - 60*60*24*365 )."-07-01' ORDER BY log DESC";
                    $result = mysqli_query($conn, $sql3);
                    if (mysqli_num_rows($result) > 0) {
                      while($row = mysqli_fetch_assoc($result)) {
                        if($row["verify"]==1 or $row["locked"]==1){
                          echo ' <tr>
                          <th scope="row">'.$i.'</th>
                          <td>RAA1</td>
                          <td>'.$row["date"].'</td>
                          ';
                          if($row["point"]>0){
                            echo '<td><i class="fa-solid fa-plus" style="color: #73ff5a;"></i>&nbsp;'.number_format((float)$row["point"], 2, '.', '').'</td>';
                          }
                          else if($row["point"]<0){
                            echo '<td><i class="fa-solid fa-minus" style="color: #ff5a91;"></i>&nbsp;'.number_format((float)$row["point"], 2, '.', '').'</td>';
                          }
                          else{
                            echo '<td>&nbsp;&nbsp;&nbsp;&nbsp;'.number_format((float)$row["point"], 2, '.', '').'</td>';
                          }
                          if($row["verify"] == 1){
                            echo '<td><i class="fa-solid fa-circle-check fs-5"></i></td>';
                          }
                          else{
                            echo '<td>-</td>';
                          }

                          if($row["comment"]){
                            echo'<td>'.$row["comment"].'</td>';
                          }else{
                            echo'<td>-</td>';
                          }
                          echo'
                          </tr>';
                          $i=$i+1;
                          $tpoint=$tpoint+$row["point"];
                        }
                        if($row["verify"]==1){$raa1point=$raa1point+$row["point"];}
                      }
                    }
                    //RAA2
                    $sql3 = "SELECT * FROM RAA2 WHERE id='".$a."' AND log<'".date("Y")."-07-01' AND log>='".date("Y", time() - 60*60*24*365 )."-07-01' ORDER BY log DESC";
                    $result = mysqli_query($conn, $sql3);
                    if (mysqli_num_rows($result) > 0) {
                      while($row = mysqli_fetch_assoc($result)) {
                        if($row["verify"]==1 or $row["locked"]==1){
                          echo ' <tr>
                          <th scope="row">'.$i.'</th>
                          <td>RAA2</td>
                          <td>'.$row["date"].'</td>
                          ';
                          if($row["point"]>0){
                            echo '<td><i class="fa-solid fa-plus" style="color: #73ff5a;"></i>&nbsp;'.number_format((float)$row["point"], 2, '.', '').'</td>';
                          }
                          else if($row["point"]<0){
                            echo '<td><i class="fa-solid fa-minus" style="color: #ff5a91;"></i>&nbsp;'.number_format((float)$row["point"], 2, '.', '').'</td>';
                          }
                          else{
                            echo '<td>&nbsp;&nbsp;&nbsp;&nbsp;'.number_format((float)$row["point"], 2, '.', '').'</td>';
                          }
                          if($row["verify"] == 1){
                            echo '<td><i class="fa-solid fa-circle-check fs-5"></i></td>';
                          }
                          else{
                            echo '<td>-</td>';
                          }

                          if($row["comment"]){
                            echo'<td>'.$row["comment"].'</td>';
                          }else{
                            echo'<td>-</td>';
                          }
                          echo'
                          </tr>';
                          $i=$i+1;
                          $tpoint=$tpoint+$row["point"];
                        }
                        if($row["verify"]==1){$raa2point=$raa2point+$row["point"];}
                      }
                    }
                    //RAA3
                    $sql3 = "SELECT * FROM RAA3 WHERE id='".$a."' AND log<'".date("Y")."-07-01' AND log>='".date("Y", time() - 60*60*24*365 )."-07-01' ORDER BY log DESC";
                    $result = mysqli_query($conn, $sql3);
                    if (mysqli_num_rows($result) > 0) {
                      while($row = mysqli_fetch_assoc($result)) {
                        if($row["verify"]==1 or $row["locked"]==1){
                          echo ' <tr>
                          <th scope="row">'.$i.'</th>
                          <td>RAA3</td>
                          <td>'.$row["date"].'</td>
                          ';
                          if($row["point"]>0){
                            echo '<td><i class="fa-solid fa-plus" style="color: #73ff5a;"></i>&nbsp;'.number_format((float)$row["point"], 2, '.', '').'</td>';
                          }
                          else if($row["point"]<0){
                            echo '<td><i class="fa-solid fa-minus" style="color: #ff5a91;"></i>&nbsp;'.number_format((float)$row["point"], 2, '.', '').'</td>';
                          }
                          else{
                            echo '<td>&nbsp;&nbsp;&nbsp;&nbsp;'.number_format((float)$row["point"], 2, '.', '').'</td>';
                          }
                          if($row["verify"] == 1){
                            echo '<td><i class="fa-solid fa-circle-check fs-5"></i></td>';
                          }
                          else{
                            echo '<td>-</td>';
                          }

                          if($row["comment"]){
                            echo'<td>'.$row["comment"].'</td>';
                          }else{
                            echo'<td>-</td>';
                          }
                          echo'
                          </tr>';
                          $i=$i+1;
                          $tpoint=$tpoint+$row["point"];
                        }
                        if($row["verify"]==1){$raa3point=$raa3point+$row["point"];}
                      }
                    }
                    //RAA4
                    $sql3 = "SELECT * FROM RAA4 WHERE id='".$a."' AND log<'".date("Y")."-07-01' AND log>='".date("Y", time() - 60*60*24*365 )."-07-01' ORDER BY log DESC";
                    $result = mysqli_query($conn, $sql3);
                    if (mysqli_num_rows($result) > 0) {
                      while($row = mysqli_fetch_assoc($result)) {
                        if($row["verify"]==1 or $row["locked"]==1){
                          echo ' <tr>
                          <th scope="row">'.$i.'</th>
                          <td>RAA4</td>
                          <td>'.$row["date"].'</td>
                          ';
                          if($row["point"]>0){
                            echo '<td><i class="fa-solid fa-plus" style="color: #73ff5a;"></i>&nbsp;'.number_format((float)$row["point"], 2, '.', '').'</td>';
                          }
                          else if($row["point"]<0){
                            echo '<td><i class="fa-solid fa-minus" style="color: #ff5a91;"></i>&nbsp;'.number_format((float)$row["point"], 2, '.', '').'</td>';
                          }
                          else{
                            echo '<td>&nbsp;&nbsp;&nbsp;&nbsp;'.number_format((float)$row["point"], 2, '.', '').'</td>';
                          }
                          if($row["verify"] == 1){
                            echo '<td><i class="fa-solid fa-circle-check fs-5"></i></td>';
                          }
                          else{
                            echo '<td>-</td>';
                          }

                          if($row["comment"]){
                            echo'<td>'.$row["comment"].'</td>';
                          }else{
                            echo'<td>-</td>';
                          }
                          echo'
                          </tr>';
                          $i=$i+1;
                          $tpoint=$tpoint+$row["point"];
                        }
                        if($row["verify"]==1){$raa4point=$raa4point+$row["point"];}
                      }
                    }
                    //RAA5
                    $sql3 = "SELECT * FROM RAA5 WHERE id='".$a."' AND log<'".date("Y")."-07-01' AND log>='".date("Y", time() - 60*60*24*365 )."-07-01' ORDER BY log DESC";
                    $result = mysqli_query($conn, $sql3);
                    if (mysqli_num_rows($result) > 0) {
                      while($row = mysqli_fetch_assoc($result)) {
                        if($row["verify"]==1 or $row["locked"]==1){
                          echo ' <tr>
                          <th scope="row">'.$i.'</th>
                          <td>RAA5</td>
                          <td>'.$row["name"].'</td>
                          ';
                          if($row["point"]>0){
                            echo '<td><i class="fa-solid fa-plus" style="color: #73ff5a;"></i>&nbsp;'.number_format((float)$row["point"], 2, '.', '').'</td>';
                          }
                          else if($row["point"]<0){
                            echo '<td><i class="fa-solid fa-minus" style="color: #ff5a91;"></i>&nbsp;'.number_format((float)$row["point"], 2, '.', '').'</td>';
                          }
                          else{
                            echo '<td>&nbsp;&nbsp;&nbsp;&nbsp;'.number_format((float)$row["point"], 2, '.', '').'</td>';
                          }
                          if($row["verify"] == 1){
                            echo '<td><i class="fa-solid fa-circle-check fs-5"></i></td>';
                          }
                          else{
                            echo '<td>-</td>';
                          }

                          if($row["comment"]){
                            echo'<td>'.$row["comment"].'</td>';
                          }else{
                            echo'<td>-</td>';
                          }
                          echo'
                          </tr>';
                          $i=$i+1;
                          $tpoint=$tpoint+$row["point"];
                        }
                        if($row["verify"]==1){$raa5point=$raa5point+$row["point"];}
                      }
                    }
                    //RAA6
                    $sql3 = "SELECT * FROM RAA6 WHERE id='".$a."' AND log<'".date("Y")."-07-01' AND log>='".date("Y", time() - 60*60*24*365 )."-07-01' ORDER BY log DESC";
                    $result = mysqli_query($conn, $sql3);
                    if (mysqli_num_rows($result) > 0) {
                      while($row = mysqli_fetch_assoc($result)) {
                        if($row["verify"]==1 or $row["locked"]==1){
                          echo ' <tr>
                          <th scope="row">'.$i.'</th>
                          <td>RAA6</td>
                          <td>'.$row["name"].'</td>
                          ';
                          if($row["point"]>0){
                            echo '<td><i class="fa-solid fa-plus" style="color: #73ff5a;"></i>&nbsp;'.number_format((float)$row["point"], 2, '.', '').'</td>';
                          }
                          else if($row["point"]<0){
                            echo '<td><i class="fa-solid fa-minus" style="color: #ff5a91;"></i>&nbsp;'.number_format((float)$row["point"], 2, '.', '').'</td>';
                          }
                          else{
                            echo '<td>&nbsp;&nbsp;&nbsp;&nbsp;'.number_format((float)$row["point"], 2, '.', '').'</td>';
                          }
                          if($row["verify"] == 1){
                            echo '<td><i class="fa-solid fa-circle-check fs-5"></i></td>';
                          }
                          else{
                            echo '<td>-</td>';
                          }

                          if($row["comment"]){
                            echo'<td>'.$row["comment"].'</td>';
                          }else{
                            echo'<td>-</td>';
                          }
                          echo'
                          </tr>';
                          $i=$i+1;
                          $tpoint=$tpoint+$row["point"];
                        }
                        if($row["verify"]==1){$raa6point=$raa6point+$row["point"];}
                      }
                    }
                    //RAA7
                    $sql3 = "SELECT * FROM RAA7 WHERE id='".$a."' AND log<'".date("Y")."-07-01' AND log>='".date("Y", time() - 60*60*24*365 )."-07-01' ORDER BY log DESC";
                    $result = mysqli_query($conn, $sql3);
                    if (mysqli_num_rows($result) > 0) {
                      while($row = mysqli_fetch_assoc($result)) {
                        if($row["verify"]==1 or $row["locked"]==1){
                          echo ' <tr>
                          <th scope="row">'.$i.'</th>
                          <td>RAA7</td>
                          <td>'.$row["title"].'</td>
                          ';
                          if($row["point"]>0){
                            echo '<td><i class="fa-solid fa-plus" style="color: #73ff5a;"></i>&nbsp;'.number_format((float)$row["point"], 2, '.', '').'</td>';
                          }
                          else if($row["point"]<0){
                            echo '<td><i class="fa-solid fa-minus" style="color: #ff5a91;"></i>&nbsp;'.number_format((float)$row["point"], 2, '.', '').'</td>';
                          }
                          else{
                            echo '<td>&nbsp;&nbsp;&nbsp;&nbsp;'.number_format((float)$row["point"], 2, '.', '').'</td>';
                          }
                          if($row["verify"] == 1){
                            echo '<td><i class="fa-solid fa-badge-check"></i></td>';
                          }
                          else{
                            echo '<td>-</td>';
                          }
                          echo'
                          ';
                          if($row["verify"] == 1){
                            echo '<td><i class="fa-solid fa-circle-check fs-5"></i></td>';
                          }
                          else{
                            echo '<td>-</td>';
                          }

                          if($row["comment"]){
                            echo'<td>'.$row["comment"].'</td>';
                          }else{
                            echo'<td>-</td>';
                          }
                          echo'
                          </tr>';
                          $i=$i+1;
                          $tpoint=$tpoint+$row["point"];
                        }
                        if($row["verify"]==1){$raa7point=$raa7point+$row["point"];}
                      }
                    }
                    //RAA8
                    $sql3 = "SELECT * FROM RAA8 WHERE id='".$a."' AND log<'".date("Y")."-07-01' AND log>='".date("Y", time() - 60*60*24*365 )."-07-01' ORDER BY log DESC";
                    $result = mysqli_query($conn, $sql3);
                    if (mysqli_num_rows($result) > 0) {
                      while($row = mysqli_fetch_assoc($result)) {
                        if($row["verify"]==1 or $row["locked"]==1){
                          echo ' <tr>
                          <th scope="row">'.$i.'</th>
                          <td>RAA8</td>
                          <td>'.$row["subject"].'</td>
                          ';
                          if($row["point"]>0){
                            echo '<td><i class="fa-solid fa-plus" style="color: #73ff5a;"></i>&nbsp;'.number_format((float)$row["point"], 2, '.', '').'</td>';
                          }
                          else if($row["point"]<0){
                            echo '<td><i class="fa-solid fa-minus" style="color: #ff5a91;"></i>&nbsp;'.number_format((float)$row["point"], 2, '.', '').'</td>';
                          }
                          else{
                            echo '<td>&nbsp;&nbsp;&nbsp;&nbsp;'.number_format((float)$row["point"], 2, '.', '').'</td>';
                          }
                          if($row["verify"] == 1){
                            echo '<td><i class="fa-solid fa-circle-check fs-5"></i></td>';
                          }
                          else{
                            echo '<td>-</td>';
                          }

                          if($row["comment"]){
                            echo'<td>'.$row["comment"].'</td>';
                          }else{
                            echo'<td>-</td>';
                          }
                          echo'
                          </tr>';
                          $i=$i+1;
                          $tpoint=$tpoint+$row["point"];
                        }
                        if($row["verify"]==1){$raa8point=$raa8point+$row["point"];}
                      }
                    }
                    //RAA9
                    $sql3 = "SELECT * FROM RAA9 WHERE id='".$a."' AND log<'".date("Y")."-07-01' AND log>='".date("Y", time() - 60*60*24*365 )."-07-01' ORDER BY log DESC";
                    $result = mysqli_query($conn, $sql3);
                    if (mysqli_num_rows($result) > 0) {
                      while($row = mysqli_fetch_assoc($result)) {
                        if($row["verify"]==1 or $row["locked"]==1){
                          echo ' <tr>
                          <th scope="row">'.$i.'</th>
                          <td>RAA9</td>
                          <td>'.$row["name"].'</td>
                          ';
                          if($row["point"]>0){
                            echo '<td><i class="fa-solid fa-plus" style="color: #73ff5a;"></i>&nbsp;'.number_format((float)$row["point"], 2, '.', '').'</td>';
                          }
                          else if($row["point"]<0){
                            echo '<td><i class="fa-solid fa-minus" style="color: #ff5a91;"></i>&nbsp;'.number_format((float)$row["point"], 2, '.', '').'</td>';
                          }
                          else{
                            echo '<td>&nbsp;&nbsp;&nbsp;&nbsp;'.number_format((float)$row["point"], 2, '.', '').'</td>';
                          }
                          if($row["verify"] == 1){
                            echo '<td><i class="fa-solid fa-circle-check fs-5"></i></td>';
                          }
                          else{
                            echo '<td>-</td>';
                          }

                          if($row["comment"]){
                            echo'<td>'.$row["comment"].'</td>';
                          }else{
                            echo'<td>-</td>';
                          }
                          echo'
                          </tr>';
                          $i=$i+1;
                          $tpoint=$tpoint+$row["point"];
                        }
                        if($row["verify"]==1){$raa9point=$raa9point+$row["point"];}
                      }
                    }
                    //RAA10
                    $sql3 = "SELECT * FROM RAA10 WHERE id='".$a."' AND log<'".date("Y")."-07-01' AND log>='".date("Y", time() - 60*60*24*365 )."-07-01' ORDER BY log DESC";
                    $result = mysqli_query($conn, $sql3);
                    if (mysqli_num_rows($result) > 0) {
                      while($row = mysqli_fetch_assoc($result)) {
                        if($row["verify"]==1 or $row["locked"]==1){
                          echo ' <tr>
                          <th scope="row">'.$i.'</th>
                          <td>RAA10</td>
                          <td>'.$row["name"].'</td>
                          ';
                          if($row["point"]>0){
                            echo '<td><i class="fa-solid fa-plus" style="color: #73ff5a;"></i>&nbsp;'.number_format((float)$row["point"], 2, '.', '').'</td>';
                          }
                          else if($row["point"]<0){
                            echo '<td><i class="fa-solid fa-minus" style="color: #ff5a91;"></i>&nbsp;'.number_format((float)$row["point"], 2, '.', '').'</td>';
                          }
                          else{
                            echo '<td>&nbsp;&nbsp;&nbsp;&nbsp;'.number_format((float)$row["point"], 2, '.', '').'</td>';
                          }
                          if($row["verify"] == 1){
                            echo '<td><i class="fa-solid fa-circle-check fs-5"></i></td>';
                          }
                          else{
                            echo '<td>-</td>';
                          }

                          if($row["comment"]){
                            echo'<td>'.$row["comment"].'</td>';
                          }else{
                            echo'<td>-</td>';
                          }
                          echo'
                          </tr>';
                          $i=$i+1;
                          $tpoint=$tpoint+$row["point"];
                        }
                        if($row["verify"]==1){$raa10point=$raa10point+$row["point"];}
                      }
                    }
                    //INV
                    $sql3 = "SELECT * FROM INV WHERE id='".$a."' AND log<'".date("Y")."-07-01' AND log>='".date("Y", time() - 60*60*24*365 )."-07-01' ORDER BY log DESC";
                    $result = mysqli_query($conn, $sql3);
                    if (mysqli_num_rows($result) > 0) {
                      while($row = mysqli_fetch_assoc($result)) {
                        if($row["verify"]==1 or $row["locked"]==1){
                          echo ' <tr>
                          <th scope="row">'.$i.'</th>
                          <td>INV</td>
                          <td>'.$row["date"].'</td>
                          ';
                          if($row["point"]>0){
                            echo '<td><i class="fa-solid fa-plus" style="color: #73ff5a;"></i>&nbsp;'.number_format((float)$row["point"], 2, '.', '').'</td>';
                          }
                          else if($row["point"]<0){
                            echo '<td><i class="fa-solid fa-minus" style="color: #ff5a91;"></i>&nbsp;'.number_format((float)$row["point"], 2, '.', '').'</td>';
                          }
                          else{
                            echo '<td>&nbsp;&nbsp;&nbsp;&nbsp;'.number_format((float)$row["point"], 2, '.', '').'</td>';
                          }
                          if($row["verify"] == 1){
                            echo '<td><i class="fa-solid fa-circle-check fs-5"></i></td>';
                          }
                          else{
                            echo '<td>-</td>';
                          }

                          if($row["comment"]){
                            echo'<td>'.$row["comment"].'</td>';
                          }else{
                            echo'<td>-</td>';
                          }
                          echo'
                          </tr>';
                          $i=$i+1;
                          $tpoint=$tpoint+$row["point"];
                        }
                        if($row["verify"]==1){$invpoint=$invpoint+$row["point"];}
                      }
                    }
                    //AO
                    $sql3 = "SELECT * FROM AO WHERE id='".$a."' AND log<'".date("Y")."-07-01' AND log>='".date("Y", time() - 60*60*24*365 )."-07-01' ORDER BY log DESC";
                    $result = mysqli_query($conn, $sql3);
                    if (mysqli_num_rows($result) > 0) {
                      while($row = mysqli_fetch_assoc($result)) {
                        if($row["verify"]==1 or $row["locked"]==1){
                          echo ' <tr>
                          <th scope="row">'.$i.'</th>
                          <td>AO</td>
                          <td>'.$row["title"].'</td>
                          ';
                          if($row["point"]>0){
                            echo '<td><i class="fa-solid fa-plus" style="color: #73ff5a;"></i>&nbsp;'.number_format((float)$row["point"], 2, '.', '').'</td>';
                          }
                          else if($row["point"]<0){
                            echo '<td><i class="fa-solid fa-minus" style="color: #ff5a91;"></i>&nbsp;'.number_format((float)$row["point"], 2, '.', '').'</td>';
                          }
                          else{
                            echo '<td>&nbsp;&nbsp;&nbsp;&nbsp;'.number_format((float)$row["point"], 2, '.', '').'</td>';
                          }
                          if($row["verify"] == 1){
                            echo '<td><i class="fa-solid fa-circle-check fs-5"></i></td>';
                          }
                          else{
                            echo '<td>-</td>';
                          }

                          if($row["comment"]){
                            echo'<td>'.$row["comment"].'</td>';
                          }else{
                            echo'<td>-</td>';
                          }
                          echo'
                          </tr>';
                          $i=$i+1;
                          $tpoint=$tpoint+$row["point"];
                        }
                        if($row["verify"]==1){$aopoint=$aopoint+$row["point"];}
                      }
                    }
                    
                    ($tlppoint < 50 )? $vpoint += $tlppoint : $vpoint += 50;
                    ($grpoint < 100) ? $vpoint += $grpoint : $vpoint += 100;
                    ($descpoint < 35) ? $vpoint += $descpoint : $vpoint += 35;
                    ($dppoint < 15) ? $vpoint += $dppoint : $vpoint += 15;
                    ($ippoint < 25) ? $vpoint += $ippoint : $vpoint += 25;
                    ($ctspoint < 10) ? $vpoint += $ctspoint : $vpoint += 10;
                    ($invpoint < 5) ? $vpoint += $invpoint : $vpoint += 5;
                    ($aopoint < 15) ? $vpoint += $aopoint : $vpoint += 15;
                    ($raa1point < 10) ? $vpoint += $raa10point : $vpoint += 10;
                    ($raa2point < 10) ? $vpoint += $raa2point : $vpoint += 10;
                    ($raa3point < 10) ? $vpoint += $raa3point : $vpoint += 10;
                    ($raa4point < 10) ? $vpoint += $ctspoint : $vpoint += 10;
                    ($raa5point < 20) ? $vpoint += $ctspoint : $vpoint += 20;
                    ($raa6point < 15) ? $vpoint += $ctspoint : $vpoint += 15;
                    ($raa7point < 10) ? $vpoint += $ctspoint : $vpoint += 10;
                    ($raa8point < 10) ? $vpoint += $ctspoint : $vpoint += 10;
                    ($raa9point < 20) ? $vpoint += $ctspoint : $vpoint += 20;
                    ($raa10point < 30) ? $vpoint += $ctspoint : $vpoint += 30;

                  ?>
                  
                </tbody>
                </table>
                <div class="d-flex justify-content-center text-center fixed-bottom">
                  <?php echo'<p class="button-55 mt-2"><i>Total Points : <b>'.$tpoint.'</b> | Verified Points : <b>'.$vpoint.'</b></i></p>'; ?>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="container mb-5 footer">
      <div class="m-2 p-0 row footertext">
        <div class="col-md-4">
          <img
            src="../../assets/img/gu-logo.png"
            data-large="../../assets/img/gu-logo.png"
            alt="GU LOGO"
            height="60"
            class="blurry-load"
            role="button"
            onclick="location.href = '../../index.php';"
          />
        </div>
        <div class="col-md-4">
          <a
            href="https://www.linkedin.com/in/naman-doshi-007/"
            target="_blank"
            class="linkclass"
            >Much Obliged To Naman</a
          >
        </div>
        <div class="col-md-4">© 2023 API/GU. all rights reserved</div>
      </div>
      <div class="row m-3">
        <div class="col"></div>
        <div class="col"></div>
        <div class="col"></div>
        <div class="col"></div>
      </div>
    </div>
    <!--Bootstrap JS-->
    <script src="../../assets/bootstrap-5.3.0-alpha1-dist/js/bootstrap.min.js"></script>
    <!--Blurry Image JS-->
    <script src="../../assets/js/blury-load.min.js"></script>
    <!--External JS-->
    <script src="../../assets/js/main.js"></script>

    <script>
      const handleAlerts = (type, text) =>{
        $(".toastmsg").html(`${text}`);  
        const toastLiveExample = $(`#${type}`)
        const toast = new bootstrap.Toast(toastLiveExample).show() 
      }
    </script>
  </body>
</html>