<?php

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

include '../db.php';
echo '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>API HOME</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>-->
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/simple-notify@0.5.5/dist/simple-notify.min.css" />
      <script src="https://cdn.jsdelivr.net/npm/simple-notify@0.5.5/dist/simple-notify.min.js"></script>
    <style>
    .circle {
      position: fixed;
      border-radius:40px;
      padding: 10px;
      bottom:30px;
      right:30px;
    }
    #circle1 {
      background:var(--bs-primary);
      color: white;
      
    }
    </style>
</head>
<body>
    <div class="container">
     <br/><a href="profile.php">Profile</a><a class="ms-3" href="home.php">Home</a><a class="ms-3 float-end" href="../logout.php">Logout</a><hr>
     <div class="form-group">
      <p class="form-control"> Verified or Locked Activity </p> 
      <table class="table table-hover" id="table2">
      <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Criteria</th>
        <th scope="col">Element</th>
        <th scope="col">Points</th>
        <th scope="col">Verify</th>
        <th scope="col">Locked</th>
        <th scope="col">Comment</th>
      </tr>
      </thead>
      <tbody>
      ';
      $i=1;

      if(isset($_SESSION["id"])){
        $a=$_SESSION["id"];
        //TLP
        $sql = "SELECT * FROM TLP WHERE id='".$a."'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
          while($row = mysqli_fetch_assoc($result)) {
            if($row["verify"]==1 or $row["locked"]==1){
              echo ' <tr>
              <th scope="row">'.$i.'</th>
              <td>TLP</td>
              <td>'.$row["subject"].'</td>
              <td>'.$row["point"].'</td>
              <td>'.$row["verify"].'</td>
              <td>'.$row["locked"].'</td>
              <td>'.$row["comment"].'</td>
              </tr>';
              $i=$i+1;
              $tpoint=$tpoint+$row["point"];
            }
            if($row["verify"]==1){$tlppoint=$tlppoint+$row["point"];}
          }
        }
        //GR
        $sql2 = "SELECT * FROM GR WHERE id='".$a."'";
        $result = mysqli_query($conn, $sql2);
        if (mysqli_num_rows($result) > 0) {
          while($row = mysqli_fetch_assoc($result)) {
            if($row["verify"]==1 or $row["locked"]==1){
              echo ' <tr>
              <th scope="row">'.$i.'</th>
              <td>GR</td>
              <td>'.$row["subject"].'</td>
              <td>'.$row["point"].'</td>
              <td>'.$row["verify"].'</td>
              <td>'.$row["locked"].'</td>
              <td>'.$row["comment"].'</td>
              </tr>';
              $i=$i+1;
              $tpoint=$tpoint+$row["point"];
            }
            if($row["verify"]==1){$grpoint=$grpoint+$row["point"];}
          }
        }
        //DISC
        $sql3 = "SELECT * FROM DISC WHERE id='".$a."'";
        $result = mysqli_query($conn, $sql3);
        if (mysqli_num_rows($result) > 0) {
          while($row = mysqli_fetch_assoc($result)) {
            if($row["verify"]==1 or $row["locked"]==1){
              echo ' <tr>
              <th scope="row">'.$i.'</th>
              <td>DISC</td>
              <td>'.$row["id"].'</td>
              <td>'.$row["point"].'</td>
              <td>'.$row["verify"].'</td>
              <td>'.$row["locked"].'</td>
              <td>'.$row["comment"].'</td>
              </tr>';
              $i=$i+1;
              $tpoint=$tpoint+$row["point"];
            }
            if($row["verify"]==1){$descpoint=$descpoint+$row["point"];}
          }
        }
        //DP
        $sql3 = "SELECT * FROM DP WHERE id='".$a."'";
        $result = mysqli_query($conn, $sql3);
        if (mysqli_num_rows($result) > 0) {
          while($row = mysqli_fetch_assoc($result)) {
            if($row["verify"]==1 or $row["locked"]==1){
              echo ' <tr>
              <th scope="row">'.$i.'</th>
              <td>DP</td>
              <td>'.$row["name"].'</td>
              <td>'.$row["point"].'</td>
              <td>'.$row["verify"].'</td>
              <td>'.$row["locked"].'</td>
              <td>'.$row["comment"].'</td>
              </tr>';
              $i=$i+1;
              $tpoint=$tpoint+$row["point"];
            }
            if($row["verify"]==1){$dppoint=$dppoint+$row["point"];}
          }
        }
        //IP
        $sql3 = "SELECT * FROM IP WHERE id='".$a."'";
        $result = mysqli_query($conn, $sql3);
        if (mysqli_num_rows($result) > 0) {
          while($row = mysqli_fetch_assoc($result)) {
            if($row["verify"]==1 or $row["locked"]==1){
              echo ' <tr>
              <th scope="row">'.$i.'</th>
              <td>IP</td>
              <td>'.$row["name"].'</td>
              <td>'.$row["point"].'</td>
              <td>'.$row["verify"].'</td>
              <td>'.$row["locked"].'</td>
              <td>'.$row["comment"].'</td>
              </tr>';
              $i=$i+1;
              $tpoint=$tpoint+$row["point"];
            }
            if($row["verify"]==1){$ippoint=$ippoint+$row["point"];}
          }
        }
        //CTC
        $sql3 = "SELECT * FROM CTS WHERE id='".$a."'";
        $result = mysqli_query($conn, $sql3);
        if (mysqli_num_rows($result) > 0) {
          while($row = mysqli_fetch_assoc($result)) {
            if($row["verify"]==1 or $row["locked"]==1){
              echo ' <tr>
              <th scope="row">'.$i.'</th>
              <td>CTS</td>
              <td>'.$row["date"].'</td>
              <td>'.$row["point"].'</td>
              <td>'.$row["verify"].'</td>
              <td>'.$row["locked"].'</td>
              <td>'.$row["comment"].'</td>
              </tr>';
              $i=$i+1;
              $tpoint=$tpoint+$row["point"];
            }
            if($row["verify"]==1){$ctspoint=$ctspoint+$row["point"];}
          }
        }
        //RAA1
        $sql3 = "SELECT * FROM RAA1 WHERE id='".$a."'";
        $result = mysqli_query($conn, $sql3);
        if (mysqli_num_rows($result) > 0) {
          while($row = mysqli_fetch_assoc($result)) {
            if($row["verify"]==1 or $row["locked"]==1){
              echo ' <tr>
              <th scope="row">'.$i.'</th>
              <td>RAA1</td>
              <td>'.$row["date"].'</td>
              <td>'.$row["point"].'</td>
              <td>'.$row["verify"].'</td>
              <td>'.$row["locked"].'</td>
              <td>'.$row["comment"].'</td>
              </tr>';
              $i=$i+1;
              $tpoint=$tpoint+$row["point"];
            }
            if($row["verify"]==1){$raa1point=$raa1point+$row["point"];}
          }
        }
        //RAA2
        $sql3 = "SELECT * FROM RAA2 WHERE id='".$a."'";
        $result = mysqli_query($conn, $sql3);
        if (mysqli_num_rows($result) > 0) {
          while($row = mysqli_fetch_assoc($result)) {
            if($row["verify"]==1 or $row["locked"]==1){
              echo ' <tr>
              <th scope="row">'.$i.'</th>
              <td>RAA2</td>
              <td>'.$row["date"].'</td>
              <td>'.$row["point"].'</td>
              <td>'.$row["verify"].'</td>
              <td>'.$row["locked"].'</td>
              <td>'.$row["comment"].'</td>
              </tr>';
              $i=$i+1;
              $tpoint=$tpoint+$row["point"];
            }
            if($row["verify"]==1){$raa2point=$raa2point+$row["point"];}
          }
        }
        //RAA3
        $sql3 = "SELECT * FROM RAA3 WHERE id='".$a."'";
        $result = mysqli_query($conn, $sql3);
        if (mysqli_num_rows($result) > 0) {
          while($row = mysqli_fetch_assoc($result)) {
            if($row["verify"]==1 or $row["locked"]==1){
              echo ' <tr>
              <th scope="row">'.$i.'</th>
              <td>RAA3</td>
              <td>'.$row["date"].'</td>
              <td>'.$row["point"].'</td>
              <td>'.$row["verify"].'</td>
              <td>'.$row["locked"].'</td>
              <td>'.$row["comment"].'</td>
              </tr>';
              $i=$i+1;
              $tpoint=$tpoint+$row["point"];
            }
            if($row["verify"]==1){$raa3point=$raa3point+$row["point"];}
          }
        }
        //RAA4
        $sql3 = "SELECT * FROM RAA4 WHERE id='".$a."'";
        $result = mysqli_query($conn, $sql3);
        if (mysqli_num_rows($result) > 0) {
          while($row = mysqli_fetch_assoc($result)) {
            if($row["verify"]==1 or $row["locked"]==1){
              echo ' <tr>
              <th scope="row">'.$i.'</th>
              <td>RAA4</td>
              <td>'.$row["date"].'</td>
              <td>'.$row["point"].'</td>
              <td>'.$row["verify"].'</td>
              <td>'.$row["locked"].'</td>
              <td>'.$row["comment"].'</td>
              </tr>';
              $i=$i+1;
              $tpoint=$tpoint+$row["point"];
            }
            if($row["verify"]==1){$raa4point=$raa4point+$row["point"];}
          }
        }
        //RAA5
        $sql3 = "SELECT * FROM RAA5 WHERE id='".$a."'";
        $result = mysqli_query($conn, $sql3);
        if (mysqli_num_rows($result) > 0) {
          while($row = mysqli_fetch_assoc($result)) {
            if($row["verify"]==1 or $row["locked"]==1){
              echo ' <tr>
              <th scope="row">'.$i.'</th>
              <td>RAA5</td>
              <td>'.$row["name"].'</td>
              <td>'.$row["point"].'</td>
              <td>'.$row["verify"].'</td>
              <td>'.$row["locked"].'</td>
              <td>'.$row["comment"].'</td>
              </tr>';
              $i=$i+1;
              $tpoint=$tpoint+$row["point"];
            }
            if($row["verify"]==1){$raa5point=$raa5point+$row["point"];}
          }
        }
        //RAA6
        $sql3 = "SELECT * FROM RAA6 WHERE id='".$a."'";
        $result = mysqli_query($conn, $sql3);
        if (mysqli_num_rows($result) > 0) {
          while($row = mysqli_fetch_assoc($result)) {
            if($row["verify"]==1 or $row["locked"]==1){
              echo ' <tr>
              <th scope="row">'.$i.'</th>
              <td>RAA6</td>
              <td>'.$row["name"].'</td>
              <td>'.$row["point"].'</td>
              <td>'.$row["verify"].'</td>
              <td>'.$row["locked"].'</td>
              <td>'.$row["comment"].'</td>
              </tr>';
              $i=$i+1;
              $tpoint=$tpoint+$row["point"];
            }
            if($row["verify"]==1){$raa6point=$raa6point+$row["point"];}
          }
        }
        //RAA7
        $sql3 = "SELECT * FROM RAA7 WHERE id='".$a."'";
        $result = mysqli_query($conn, $sql3);
        if (mysqli_num_rows($result) > 0) {
          while($row = mysqli_fetch_assoc($result)) {
            if($row["verify"]==1 or $row["locked"]==1){
              echo ' <tr>
              <th scope="row">'.$i.'</th>
              <td>RAA7</td>
              <td>'.$row["title"].'</td>
              <td>'.$row["point"].'</td>
              <td>'.$row["verify"].'</td>
              <td>'.$row["locked"].'</td>
              <td>'.$row["comment"].'</td>
              </tr>';
              $i=$i+1;
              $tpoint=$tpoint+$row["point"];
            }
            if($row["verify"]==1){$raa7point=$raa7point+$row["point"];}
          }
        }
        //RAA8
        $sql3 = "SELECT * FROM RAA8 WHERE id='".$a."'";
        $result = mysqli_query($conn, $sql3);
        if (mysqli_num_rows($result) > 0) {
          while($row = mysqli_fetch_assoc($result)) {
            if($row["verify"]==1 or $row["locked"]==1){
              echo ' <tr>
              <th scope="row">'.$i.'</th>
              <td>RAA8</td>
              <td>'.$row["subject"].'</td>
              <td>'.$row["point"].'</td>
              <td>'.$row["verify"].'</td>
              <td>'.$row["locked"].'</td>
              <td>'.$row["comment"].'</td>
              </tr>';
              $i=$i+1;
              $tpoint=$tpoint+$row["point"];
            }
            if($row["verify"]==1){$raa8point=$raa8point+$row["point"];}
          }
        }
        //RAA9
        $sql3 = "SELECT * FROM RAA9 WHERE id='".$a."'";
        $result = mysqli_query($conn, $sql3);
        if (mysqli_num_rows($result) > 0) {
          while($row = mysqli_fetch_assoc($result)) {
            if($row["verify"]==1 or $row["locked"]==1){
              echo ' <tr>
              <th scope="row">'.$i.'</th>
              <td>RAA9</td>
              <td>'.$row["name"].'</td>
              <td>'.$row["point"].'</td>
              <td>'.$row["verify"].'</td>
              <td>'.$row["locked"].'</td>
              <td>'.$row["comment"].'</td>
              </tr>';
              $i=$i+1;
              $tpoint=$tpoint+$row["point"];
            }
            if($row["verify"]==1){$raa9point=$raa9point+$row["point"];}
          }
        }
        //RAA10
        $sql3 = "SELECT * FROM RAA10 WHERE id='".$a."'";
        $result = mysqli_query($conn, $sql3);
        if (mysqli_num_rows($result) > 0) {
          while($row = mysqli_fetch_assoc($result)) {
            if($row["verify"]==1 or $row["locked"]==1){
              echo ' <tr>
              <th scope="row">'.$i.'</th>
              <td>RAA10</td>
              <td>'.$row["name"].'</td>
              <td>'.$row["point"].'</td>
              <td>'.$row["verify"].'</td>
              <td>'.$row["locked"].'</td>
              <td>'.$row["comment"].'</td>
              </tr>';
              $i=$i+1;
              $tpoint=$tpoint+$row["point"];
            }
            if($row["verify"]==1){$raa10point=$raa10point+$row["point"];}
          }
        }
        //INV
        $sql3 = "SELECT * FROM INV WHERE id='".$a."'";
        $result = mysqli_query($conn, $sql3);
        if (mysqli_num_rows($result) > 0) {
          while($row = mysqli_fetch_assoc($result)) {
            if($row["verify"]==1 or $row["locked"]==1){
              echo ' <tr>
              <th scope="row">'.$i.'</th>
              <td>INV</td>
              <td>'.$row["date"].'</td>
              <td>'.$row["point"].'</td>
              <td>'.$row["verify"].'</td>
              <td>'.$row["locked"].'</td>
              <td>'.$row["comment"].'</td>
              </tr>';
              $i=$i+1;
              $tpoint=$tpoint+$row["point"];
            }
            if($row["verify"]==1){$invpoint=$invpoint+$row["point"];}
          }
        }
        //AO
        $sql3 = "SELECT * FROM AO WHERE id='".$a."'";
        $result = mysqli_query($conn, $sql3);
        if (mysqli_num_rows($result) > 0) {
          while($row = mysqli_fetch_assoc($result)) {
            if($row["verify"]==1 or $row["locked"]==1){
              echo ' <tr>
              <th scope="row">'.$i.'</th>
              <td>AO</td>
              <td>'.$row["title"].'</td>
              <td>'.$row["point"].'</td>
              <td>'.$row["verify"].'</td>
              <td>'.$row["locked"].'</td>
              <td>'.$row["comment"].'</td>
              </tr>';
              $i=$i+1;
              $tpoint=$tpoint+$row["point"];
            }
            if($row["verify"]==1){$aopoint=$aopoint+$row["point"];}
          }
        }
      }
      else{
        echo"<script>location.href = '../index.php';</script>";
      }


      ($tlppoint < 50 )? $vpoint += $tlppoint : $vpoint += 50;
      ($grpoint < 100) ? $vpoint += $grpoint : $vpoint += 100;
      ($descpoint < 40) ? $vpoint += $descpoint : $vpoint += 40;
      ($dppoint < 20) ? $vpoint += $dppoint : $vpoint += 20;
      ($ippoint < 30) ? $vpoint += $ippoint : $vpoint += 30;
      ($ctspoint < 10) ? $vpoint += $ctspoint : $vpoint += 10;
      ($invpoint < 5) ? $vpoint += $invpoint : $vpoint += 5;
      ($aopoint < 15) ? $vpoint += $aopoint : $vpoint += 15;
      ($raa1point < 10) ? $vpoint += $raa10point : $vpoint += 10;
      ($raa2point < 10) ? $vpoint += $raa2point : $vpoint += 10;
      ($raa3point < 10) ? $vpoint += $raa3point : $vpoint += 10;
      ($raa4point < 10) ? $vpoint += $ctspoint : $vpoint += 10;
      ($raa5point < 10) ? $vpoint += $ctspoint : $vpoint += 10;
      ($raa6point < 10) ? $vpoint += $ctspoint : $vpoint += 10;
      ($raa7point < 10) ? $vpoint += $ctspoint : $vpoint += 10;
      ($raa8point < 10) ? $vpoint += $ctspoint : $vpoint += 10;
      ($raa9point < 20) ? $vpoint += $ctspoint : $vpoint += 20;
      ($raa10point < 30) ? $vpoint += $ctspoint : $vpoint += 30;

      echo'</tbody>
      </table>
      </div>
      <button id="mybtn2" type="button" class="btn btn-sm btn-secondary position-fixed" style="bottom:30px;left:30px;"><i class="fa fa-info-circle" id="info"></i></button>
      </div>
      <div id="circle1" class="circle"><span style="cursor:pointer;" data-toggle="tooltip" title="Verified Points">'.$vpoint.'</span>/<span style="cursor:pointer;" data-toggle="tooltip" title="Total Points">'.$tpoint.'</span></div>
      <script>
      $(document).ready(function() {
        $("body").tooltip({ selector: "[data-toggle=tooltip]" });
      });
      // const popoverTriggerList = document.querySelectorAll(\'[data-bs-toggle="popover"]\')
      // const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl))
      </script>
      ';

      echo"

      <script>
      function pushNotify() {
          new Notify({
            status: 'success',
            title: 'Developer Info',
            text: '<b>Naman</b><br>(200120107502) (GIT-CE)&nbsp;<a  href=\"https://www.linkedin.com/in/naman-doshi-007/\" target=\"_blank\"><i class=\'fa fa-linkedin\'></i></a>&nbsp;<a href=\"https://github.com/DoshiNaman/\" target=\"_blank\"><i class=\'fa fa-github\'></i></a>&nbsp;<a href=\"https://www.instagram.com/naman_d0shi/\" target=\"_blank\"><i class=\'fa fa-instagram\'></i></a>&nbsp;<a href=\"https://www.facebook.com/naman.doshi.5243/\" target=\"_blank\"><i class=\'fa fa-facebook\'></i></a>',
            effect: 'fade',
            speed: 300,
            customClass: null,
            customIcon: null,
            showIcon: true,
            showCloseButton: true,
            autoclose: true,
            autotimeout: 3000,
            gap: 20,
            distance: 20,
            type: 1,
            position: 'right top'
          })
        }

      $('#mybtn2').click(function(){
          pushNotify();
        });


      </script>


      </body>
      </html>";

      if($i==1){
        echo'<script>$("#table2").hide();$("#circle1").hide();</script>';
      }
      

      /*


if(isset($_SESSION["id"])){
  $a=$_SESSION["id"];
  $sql = "SELECT * FROM TLP WHERE id='".$a."'";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
      echo '      
      <form method="POST" action="" class="p-2" enctype="multipart/form-data">
      <table class="table table-hover">
      <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Criteria</th>
        <th scope="col">Subject</th>
        <th scope="col">Handle</th>
      </tr>
      </thead>
     <tbody>';
      while($row = mysqli_fetch_assoc($result)) {
          if($row["verify"]==1 or $row["locked"]==1){
          echo ' <tr>
                <th scope="row">1</th>
                <td>TLP</td>
                <td>'.$row["subject"].'</td>
                <td><!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#'.$row["subject"].'">EDIT</button>
                <button type="button" class="btn btn-success">Lock</button>
                <button type="submit" name="delTLP" value="'.$row["subject"].'" class="btn btn-danger">Del</button></td>
          </tr>
          <!-- Modal -->
          <div class="modal fade" id="'.$row["subject"].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalCenterTitle">Edit Details</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form method="POST" action="" class="p-2" enctype="multipart/form-data">
                    <hr>
                    <div class="form-group p-2">
                      <label for="sem">Semester</label>
                      <select class="form-control" name="semester" id="sem">
                          ';
                          
                          if($row["sem"]==1){
                              echo'
                              <option value="0">Select One</option>
                              <option value="1" selected>Sem 1</option>
                              <option value="2">Sem 2</option>
                              <option value="3">Sem 3</option>
                              <option value="4">Sem 4</option>
                              <option value="5">Sem 5</option>
                              <option value="6">Sem 6</option>
                              <option value="7">Sem 7</option>
                              <option value="8">Sem 8</option>';
                          }
                          elseif($row["sem"]==2){
                              echo'
                              <option value="0">Select One</option>
                              <option value="1">Sem 1</option>
                              <option value="2" selected>Sem 2</option>
                              <option value="3">Sem 3</option>
                              <option value="4">Sem 4</option>
                              <option value="5">Sem 5</option>
                              <option value="6">Sem 6</option>
                              <option value="7">Sem 7</option>
                              <option value="8">Sem 8</option>';
                          }
                          elseif($row["sem"]==3){
                              echo'
                              <option value="0">Select One</option>
                              <option value="1">Sem 1</option>
                              <option value="2">Sem 2</option>
                              <option value="3" selected>Sem 3</option>
                              <option value="4">Sem 4</option>
                              <option value="5">Sem 5</option>
                              <option value="6">Sem 6</option>
                              <option value="7">Sem 7</option>
                              <option value="8">Sem 8</option>';
                          }
                          elseif($row["sem"]==4){
                              echo'
                              <option value="0">Select One</option>
                              <option value="1">Sem 1</option>
                              <option value="2">Sem 2</option>
                              <option value="3">Sem 3</option>
                              <option value="4" selected>Sem 4</option>
                              <option value="5">Sem 5</option>
                              <option value="6">Sem 6</option>
                              <option value="7">Sem 7</option>
                              <option value="8">Sem 8</option>';
                          }
                          elseif($row["sem"]==5){
                              echo'
                              <option value="0">Select One</option>
                              <option value="1">Sem 1</option>
                              <option value="2">Sem 2</option>
                              <option value="3">Sem 3</option>
                              <option value="4">Sem 4</option>
                              <option value="5" selected>Sem 5</option>
                              <option value="6">Sem 6</option>
                              <option value="7">Sem 7</option>
                              <option value="8">Sem 8</option>';
                          }
                          elseif($row["sem"]==6){
                              echo'
                              <option value="0">Select One</option>
                              <option value="1">Sem 1</option>
                              <option value="2">Sem 2</option>
                              <option value="3">Sem 3</option>
                              <option value="4">Sem 4</option>
                              <option value="5">Sem 5</option>
                              <option value="6" selected>Sem 6</option>
                              <option value="7">Sem 7</option>
                              <option value="8">Sem 8</option>';
                          }
                          elseif($row["sem"]==7){
                              echo'
                              <option value="0">Select One</option>
                              <option value="1">Sem 1</option>
                              <option value="2">Sem 2</option>
                              <option value="3">Sem 3</option>
                              <option value="4">Sem 4</option>
                              <option value="5">Sem 5</option>
                              <option value="6">Sem 6</option>
                              <option value="7" selected>Sem 7</option>
                              <option value="8">Sem 8</option>';
                          }
                          elseif($row["sem"]==8){
                              echo'
                              <option value="0">Select One</option>
                              <option value="1">Sem 1</option>
                              <option value="2">Sem 2</option>
                              <option value="3">Sem 3</option>
                              <option value="4">Sem 4</option>
                              <option value="5">Sem 5</option>
                              <option value="6">Sem 6</option>
                              <option value="7">Sem 7</option>
                              <option value="8" selected>Sem 8</option>';
                          }
                          else{
                              echo'
                              <option value="0">Select One</option>
                              <option value="1">Sem 1</option>
                              <option value="2">Sem 2</option>
                              <option value="3">Sem 3</option>
                              <option value="4">Sem 4</option>
                              <option value="5">Sem 5</option>
                              <option value="6">Sem 6</option>
                              <option value="7">Sem 7</option>
                              <option value="8">Sem 8</option>';
                          }
                          
                          echo'
                      </select>
                    </div>
                    <div class="form-group p-2">
                      <label for="sub">Subject Code</label>
                      <input type="text" class="form-control" value="'.$row["subject"].'" id="sub" name="subCode" readonly>
                    </div>
                    <div class="form-group p-2">
                      <label for="schedule">No.of Scheduled classes/week</label>
                      <input type="number" min="0" value="'.$row["scheduleClass"].'" class="form-control" id="schedule" name="scheduleClass">
                    </div>
                    <div class="form-group p-2">
                      <label for="actual">No. of actual classes</label>
                      <input type="number" min="0" value="'.$row["actualClass"].'" class="form-control" id="actual" name="actualClass">
                    </div>
                    <div class="form-group p-2">
                      <label for="attach">Attachment &nbsp; 
                      <a href="'.$a.'/'.$row["attachment"].'" target="_blank" >View</a></label>
                      <input type="file" accept="application/pdf" class="form-control" id="attach" name="attachment">
                    </div>
                    <button type="submit" name="editTLP" value="'.$row["subject"].'" class="btn btn-primary p-2">Save</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
          
          ';
          }
      }
      echo'
      </form>
      </tbody>
      </table>';

}
else{
    echo"
    <script>
        location.href = 'login.php';
    </script>
    ";
}


mysqli_close($conn);
*/
?>