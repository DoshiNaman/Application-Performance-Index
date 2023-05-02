<?php

  //database connection
  include '../../db.php';

  //check user & their profile exist
  if(!isset($_SESSION["id"]) OR !isset($_SESSION["dprofile"])){
    echo"
    <script>
        location.href = '../../index.php';
    </script>
    ";
  }

  if($_SESSION["dprofile"] != 1){
    echo"
    <script>
        location.href = 'profile.php';
    </script>
    ";
  }

  $dept="";
  $totalF=array();
  $a=$_SESSION["id"];

    $sql = "SELECT * FROM Profile WHERE role='Faculty'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            if(strlen($row["name"]) > 0){
            // array_push($totalF,$row["name"]=>$row["id"]);
            $currentF=array($row["name"]=>$row["id"]);
            $totalF=array_merge($totalF, $currentF);
            }
        }
        
    } 

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
                    <a class="nav-link linkclass" href="report.php">
                        <img
                        alt=""
                        src="../../assets/icons/info.png"
                        data-large="../../assets/icons/info.png"
                        class="goldicon blurry-load"
                        />
                        Report</a
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
              </ul>
            </div>
          </div>
        </div>
      </nav>

      
      <div class="row p-2">
        <div class="col-lg p-2 mb-1 bg-body rounded border border border-2">
          <div class="form-group">
            <div class="d-flex">
                <div class="input-group mb-3 border snip1337">
                    <span class="input-group-text">🔍</span>
                    <div class="form-floating">
                    <input
                        type="text"
                        class="form-control"
                        id="search"
                        placeholder="Email"
                        name="id"
                    />
                    <label for="floatingInputGroup1">Search By Faculty Name</label>
                    </div>


                </div>

                <div class="dropdown mb-3">
                        <button class="button-29 m-2 mt-3 dropdown-toggle" type="button" data-bs-toggle="dropdown" data-bs-auto-close="inside" aria-expanded="false"><span class="dropdown-text">(0) Selected Criteria</span>
                        <span class="caret"></span></button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a href="#" class="dropdown-item"><label><input type="checkbox" class="selectall" /><span class="select-text"> Select</span> All</label></a></li>
                            <li class="divider"></li>
                            <li><a class="dropdown-item" href="#"><label><input name='options[]' type="checkbox" class="option justone" value='TLP'/> Teaching Learning Process (TLP)</label></a></li>
                            <li><a href="#" class="dropdown-item"><label><input name='options[]' type="checkbox" class="option justone" value='GR'/> GTU Result (GR)</label></a></li>
                            <li><a href="#" class="dropdown-item"><label><input name='options[]' type="checkbox" class="option justone" value='DISC'/> Discipline (DISC)</label></a></li>
                            <li><a href="#" class="dropdown-item"><label><input name='options[]' type="checkbox" class="option justone" value='DP'/> Departmental Portfolio (DP)</label></a></li>
                            <li><a href="#" class="dropdown-item"><label><input name='options[]' type="checkbox" class="option justone" value='IP'/> Institute Portfolio (IP)</label></a></li>
                            <li><a href="#" class="dropdown-item"><label><input name='options[]' type="checkbox" class="option justone" value='CTS'/> Contribution to Society (CTS)</label></a></li>

                            <li><a href="#" class="dropdown-item"><label><input name='options[]' type="checkbox" class="option justone" value='RAA1'/> Seminar,Workshop, Technical or motivational Training organized (RAA1)</label></a></li>
                            <li><a href="#" class="dropdown-item"><label><input name='options[]' type="checkbox" class="option justone" value='RAA2'/> FDP/ STTP organized (RAA2)</label></a></li>
                            <li><a href="#" class="dropdown-item"><label><input name='options[]' type="checkbox" class="option justone" value='PRAA3'/> Participation in MOOCS courses (RAA3)</label></a></li>
                            <li><a href="#" class="dropdown-item"><label><input name='options[]' type="checkbox" class="option justone" value='RAA4'/> Membership of Associations or Professional Bodies (RAA4)</label></a></li>
                            <li><a href="#" class="dropdown-item"><label><input name='options[]' type="checkbox" class="option justone" value='RAA5'/> Research paper publication in peer reviewed journal (RAA5)</label></a></li>
                            <li><a href="#" class="dropdown-item"><label><input name='options[]' type="checkbox" class="option justone" value='RAA6'/> Research paper publication in Conference (RAA6)</label></a></li>
                            <li><a href="#" class="dropdown-item"><label><input name='options[]' type="checkbox" class="option justone" value='RAA7'/> Books authored (RAA7)</label></a></li>
                            <li><a href="#" class="dropdown-item"><label><input name='options[]' type="checkbox" class="option justone" value='RAA8'/> E-content (RAA8)</label></a></li>
                            <li><a href="#" class="dropdown-item"><label><input name='options[]' type="checkbox" class="option justone" value='RAA9'/> Patent (RAA9)</label></a></li>
                            <li><a href="#" class="dropdown-item"><label><input name='options[]' type="checkbox" class="option justone" value='RAA10'/> Research Guidance (RAA10)</label></a></li>

                            

                            <li><a href="#" class="dropdown-item"><label><input name='options[]' type="checkbox" class="option justone" value='INV'/> Invited For (INV)</label></a></li>
                            <li><a href="#" class="dropdown-item"><label><input name='options[]' type="checkbox" class="option justone" value='AO'/> Any other (AO)</label></a></li>

                        </ul>
                </div>
            </div>
            
            
            <form method="POST" action="" class="p-2" enctype="multipart/form-data" class="table-responsive">
                <table class="table table-hover" id="table23">
                <thead>
                  <tr>
                  <th scope="col">#</th>
                  <th scope="col">Name</th>
                  <th scope="col">Criteria</th>
                  <th scope="col">Element</th>
                  <th scope="col">Point</th>
                  <th scope="col">Comment</th>
                  <th scope="col">View</th>
                  <th scope="col">Verify</th>
                  <th scope="col">Reject</th>
                  </tr>
                </thead>
                <tbody>

                <?php

                    $i=1;
                    foreach($totalF as $name => $id) {

                    $sql = "SELECT * FROM TLP WHERE id='".$id."' AND log<'".date("Y")."-07-01' AND log>='".date("Y", time() - 60*60*24*365 )."-07-01' ORDER BY log DESC";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            if($row["locked"]==1){
                                
                            echo'    
                            <tr>
                                <td>'.$i.'</td>
                                <td class="name">'.$name.'</td>
                                <td>TLP</td>
                                <td>'.$row['subject'].'</td>
                                <td>'.$row['point'].'</td>
                                <td>
                                <div class="row">
                                <div class="col-auto">
                                <input type="text" class="form-control col-4" id="commentdata" name="commentdata'.$row["subject"].''.$row["id"].'TLP"  placeholder="Type comment.." value="'.$row["comment"].'" style="padding-y: 0.25rem;padding-x: 0.5rem;font-size: 0.875rem;border-radius: 0.25rem;">
                                <!--<input type="hidden" name="c_id" value="'.$row["id"].'"/>-->
                                </div>
                                <div class="col-auto">
                                <button type="submit" name="comment" id="commentBtn" value="'.$row["subject"].'_subject_TLP_'.$row["id"].'" class="button-31"><i class="fa-solid fa-square-plus fs-6"></i></button>
                                </div>
                                </div>
                                </td>
                                <td><button type="button" class="button-29" data-bs-toggle="modal" data-bs-target="#TLP'.$row["subject"].''.$row["id"].'"><i class="fa-solid fa-eye fs-6"></i></button></td><td>
                                ';
                                if($row["verify"]==1){
                                    echo'<button type="submit" name="v1" value="'.$row["subject"].'_subject_TLP" class="button-31" disabled><i class="fa-solid fa-circle-check fs-6"></i></button></td><td>';
                                }
                                else{
                                    echo'<button type="submit" name="verify" value="'.$row["subject"].'_subject_TLP_'.$row["id"].'" class="button-31"><i class="fa-solid fa-circle-check fs-6"></i></button></td><td>';
                                }
                                if($row["comment"]){
                                echo'<button type="submit" name="reject" value="'.$row["subject"].'_subject_TLP_'.$row["id"].'" class="button-30"><i class="fa-solid fa-circle-xmark fs-6"></i></button></td>    ';                     
                                }
                                else{
                                    echo'<button type="submit" name="reject" value="'.$row["subject"].'_subject_TLP_'.$row["id"].'" class="button-30" disabled><i class="fa-solid fa-circle-xmark fs-6"></i></button></td>';
                                }
                                echo'
                            </tr>
                            <!-- Modal -->
                            <div class="modal fade" id="TLP'.$row["subject"].''.$row["id"].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalCenterTitle">View Details</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!--<form method="POST" action="" class="p-2" enctype="multipart/form-data">-->
                                    <div class="alert alert-primary text-center p-1" role="alert">
                                    Teaching Learning Process
                                    </div>
                                    <div class="form-group p-2">
                                        <label for="sub">Sem</label>
                                        <input type="text" class="form-control" value="'.$row["sem"].'" id="sem" name="sem" readonly>
                                    </div>
                                    <div class="form-group p-2">
                                        <label for="sub">Subject Code</label>
                                        <input type="text" class="form-control" value="'.$row["subject"].'" id="sub" name="subCode" readonly>
                                    </div>
                                    <div class="form-group p-2">
                                        <label for="sub">Subject Name</label>
                                        <input type="text" class="form-control" value="'.$row["name"].'" id="subName" name="subName" readonly>
                                    </div>
                                    <div class="form-group p-2">
                                        <label for="schedule">No.of Scheduled classes/week</label>
                                        <input type="number" min="0" value="'.$row["scheduleClass"].'" class="form-control" id="schedule" name="scheduleClass" readonly>
                                    </div>
                                    <div class="form-group p-2">
                                        <label for="actual">No. of actual classes</label>
                                        <input type="number" min="0" value="'.$row["actualClass"].'" class="form-control" id="actual" name="actualClass" readonly>
                                    </div>
                                    <div class="form-group p-2">
                                        <label for="attach">Attachment &nbsp;
                                        <a href="../../document/'.$row["id"].'/'.$row["attachment"].'" target="_blank" >View</a></label>
                                    </div>
                                    
                                </div>
                                </div>
                            </div>
                            </div>
                            ';

                                $i=$i+1;
                            }
                        }
                        
                    } else {
                        //tlp no entry.
                    }

                    $sql = "SELECT * FROM GR WHERE id='".$id."' AND log<'".date("Y")."-07-01' AND log>='".date("Y", time() - 60*60*24*365 )."-07-01' ORDER BY log DESC";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        
                        while($row = mysqli_fetch_assoc($result)) {
                            if($row["locked"]==1){                                
                                echo ' <tr>

                                    <td>'.$i.'</td>
                                    <td class="name">'.$name.'</td>
                                    <td>GR</td>
                                    <td>'.$row['subject'].'</td>
                                    <td>'.$row['point'].'</td>
                                    <td>
                                    <div class="row">
                                    <div class="col-auto">
                                    <input type="text" class="form-control col-4" id="commentdata" name="commentdata'.$row["subject"].''.$row["id"].'GR"  placeholder="Type comment.." value="'.$row["comment"].'" style="padding-y: 0.25rem;padding-x: 0.5rem;font-size: 0.875rem;border-radius: 0.25rem;">
                                    <!--<input type="hidden" name="c_id" value="'.$row["id"].'"/>-->
                                    </div>
                                    <div class="col-auto">
                                    <button type="submit" name="comment" id="commentBtn" value="'.$row["subject"].'_subject_GR_'.$row["id"].'" class="button-31"><i class="fa-solid fa-square-plus fs-6"></i></button>
                                    </div>
                                    </div>
                                    </td>
                                    <td><button type="button" class="button-29" data-bs-toggle="modal" data-bs-target="#GR'.$row["subject"].''.$row["id"].'"><i class="fa-solid fa-eye fs-6"></i></button></td><td>
                                    ';
                                    if($row["verify"]==1){
                                        echo'<button type="submit" name="v1" value="'.$row["subject"].'_subject_GR" class="button-31" disabled><i class="fa-solid fa-circle-check fs-6"></i></button></td><td>';
                                    }
                                    else{
                                        echo'<button type="submit" name="verify" value="'.$row["subject"].'_subject_GR_'.$row["id"].'" class="button-31"><i class="fa-solid fa-circle-check fs-6"></i></button></td><td>';
                                    }
                                    
                                    if($row["comment"]){
                                        echo'<button type="submit" name="reject" value="'.$row["subject"].'_subject_GR_'.$row["id"].'" class="button-30"><i class="fa-solid fa-circle-xmark fs-6"></i></button></td>';                     
                                    }
                                    else{
                                        echo'<button type="submit" name="reject" class="button-30" disabled><i class="fa-solid fa-circle-xmark fs-6"></i></button></td>';
                                    }
                                    echo'
                                        
                                </tr>
                                <!-- Modal -->
                                <div class="modal fade" id="GR'.$row["subject"].''.$row["id"].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-dark" id="exampleModalCenterTitle">Edit Details</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </button>
                                        </button>
                                    </div>
                                    <div class="modal-body mt-0 pt-0">
                                        <div class="alert alert-primary text-center p-1" role="alert">
                                        GTU Result
                                    </div>
                                        <div class="form-group p-2">
                                            <label for="sub">Sem</label>
                                            <input type="text" class="form-control" value="'.$row["sem"].'" id="sem" name="sem" readonly>
                                        </div>
                                        <div class="form-group p-2">
                                            <label for="sub">Subject Code</label>
                                            <input type="text" class="form-control" value="'.$row["subject"].'" id="sub" name="subCode" readonly>
                                        </div>
                                        <div class="form-group p-2">
                                            <label for="sub">Subject Name</label>
                                            <input type="text" class="form-control" value="'.$row["subjectName"].'" id="subName" name="subName" readonly>
                                        </div>
                                        <div class="form-group p-2">
                                            <label for="rI">Result of subject (Institute)</label>
                                            <input type="number" min="0" max="100" class="form-control" value="'.$row["resultInstitute"].'" id="rI" name="resultInstitute" step="0.01" readonly>
                                        </div>
                                        <div class="form-group p-2">
                                            <label for="rG">Result of GTU</label>
                                            <input type="number" min="0" max="100" class="form-control" value="'.$row["resultGtu"].'" id="rG" name="resultGtu" step="0.01" readonly>
                                        </div>
                                        <div class="form-group p-2">
                                            <label for="attach">Attachment &nbsp; 
                                            <a href="../../document/'.$row["id"].'/'.$row["attachment"].'" target="_blank" >View</a></label>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                </div>
                                ';
                                $i=$i+1;
                            }
                        }
                        
                    } else {
                        //GR no entry.
                    }

                    $sql = "SELECT * FROM DP WHERE id='".$id."' AND log<'".date("Y")."-07-01' AND log>='".date("Y", time() - 60*60*24*365 )."-07-01' ORDER BY log DESC";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            if($row["locked"]==1){
                                echo ' <tr>

                                    <td>'.$i.'</td>
                                    <td class="name">'.$name.'</td>
                                    <td>DP</td>
                                    <td>'.$row['name'].'</td>
                                    <td>'.$row['point'].'</td>
                                    <td>
                                    <div class="row">
                                    <div class="col-auto">
                                    <input type="text" class="form-control col-4" id="commentdata" name="commentdata'.$row["name"].''.$row["id"].'DP"  placeholder="Type comment.." value="'.$row["comment"].'" style="padding-y: 0.25rem;padding-x: 0.5rem;font-size: 0.875rem;border-radius: 0.25rem;">
                                    <!--<input type="hidden" name="c_id" value="'.$row["id"].'"/>-->
                                    </div>
                                    <div class="col-auto">
                                    <button type="submit" name="comment" id="commentBtn" value="'.$row["name"].'_name_DP_'.$row["id"].'" class="button-31"><i class="fa-solid fa-square-plus fs-6"></i></button>
                                    </div>
                                    </div>
                                    </td>
                                    <td><button type="button" class="button-29" data-bs-toggle="modal" data-bs-target="#DP'.$row["name"].''.$row["id"].'"><i class="fa-solid fa-eye fs-6"></i></button></td><td>
                                    ';
                                    if($row["verify"]==1){
                                        echo'<button type="submit" name="v1" value="'.$row["name"].'_name_DP" class="button-31" disabled><i class="fa-solid fa-circle-check fs-6"></i></button></td><td>';
                                    }
                                    else{
                                        echo'<button type="submit" name="verify" value="'.$row["name"].'_name_DP_'.$row["id"].'" class="button-31"><i class="fa-solid fa-circle-check fs-6"></i></button></td><td>';
                                    }
                                    
                                    if($row["comment"]){
                                        echo'<button type="submit" name="reject" value="'.$row["name"].'_name_DP_'.$row["id"].'" class="button-30"><i class="fa-solid fa-circle-xmark fs-6"></i></button></td>    ';                     
                                    }
                                    else{
                                        echo'<button type="submit" name="reject" class="button-30" disabled><i class="fa-solid fa-circle-xmark fs-6"></i></button></td>';
                                    }
                                    echo'
                                        
                                    </tr>
                                <!-- Modal -->
                                <div class="modal fade" id="DP'.$row["name"].''.$row["id"].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalCenterTitle">Edit Details</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="alert alert-primary text-center p-1" role="alert">
                                        Departmental Portfolio
                                    </div>
                                        <div class="form-group p-2">
                                            <label for="sub">Subject Code</label>
                                            <input type="text" class="form-control" value="'.$row["name"].'" id="sub" name="port" readonly>
                                        </div>
                                        <div class="form-group p-2">
                                            <label for="sem">Role</label>
                                            <input type="text" class="form-control" value="'.$row["role"].'" id="sub" name="port" readonly>
                                        </div>
                                        <div class="form-group p-2">
                                            <label for="sem">Duration</label>
                                            <input type="text" class="form-control" value="'.$row["duration"].'" id="sub" name="port" readonly>
                                        </div>
                                        <div class="form-group p-2">
                                            <label for="attach">Attachment &nbsp;
                                            <a href="../../document/'.$row["id"].'/'.$row["attachment"].'" target="_blank" >View</a></label>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                </div>
                                ';
                                $i=$i+1;
                            }
                        }
                        
                    } else {
                        //dp no entry.
                    }

                    $sql = "SELECT * FROM IP WHERE id='".$id."' AND log<'".date("Y")."-07-01' AND log>='".date("Y", time() - 60*60*24*365 )."-07-01' ORDER BY log DESC";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            if($row["locked"]==1){
                                echo ' <tr>

                                    <td>'.$i.'</td>
                                    <td class="name">'.$name.'</td>
                                    <td>IP</td>
                                    <td>'.$row['name'].'</td>
                                    <td>'.$row['point'].'</td>
                                    <td>
                                    <div class="row">
                                    <div class="col-auto">
                                    <input type="text" class="form-control col-4" id="commentdata" name="commentdata'.$row["name"].''.$row["id"].'IP"  placeholder="Type comment.." value="'.$row["comment"].'" style="padding-y: 0.25rem;padding-x: 0.5rem;font-size: 0.875rem;border-radius: 0.25rem;">
                                    <!--<input type="hidden" name="c_id" value="'.$row["id"].'"/>-->
                                    </div>
                                    <div class="col-auto">
                                    <button type="submit" name="comment" id="commentBtn" value="'.$row["name"].'_name_IP_'.$row["id"].'" class="button-31"><i class="fa-solid fa-square-plus fs-6"></i></button>
                                    </div>
                                    </div>
                                    </td>
                                    <td><button type="button" class="button-29" data-bs-toggle="modal" data-bs-target="#IP'.$row["name"].''.$row["id"].'"><i class="fa-solid fa-eye fs-6"></i></button></td><td>
                                    ';
                                    if($row["verify"]==1){
                                        echo'<button type="submit" name="v1" value="'.$row["name"].'_name_IP" class="button-31" disabled><i class="fa-solid fa-circle-check fs-6"></i></button></td><td>';
                                    }
                                    else{
                                        echo'<button type="submit" name="verify" value="'.$row["name"].'_name_IP_'.$row["id"].'" class="button-31"><i class="fa-solid fa-circle-check fs-6"></i></button></td><td>';
                                    }
                                    
                                    if($row["comment"]){
                                        echo'<button type="submit" name="reject" value="'.$row["name"].'_name_IP_'.$row["id"].'" class="button-30"><i class="fa-solid fa-circle-xmark fs-6"></i></button></td>   ';                     
                                    }
                                    else{
                                        echo'<button type="submit" name="reject" class="button-30" disabled><i class="fa-solid fa-circle-xmark fs-6"></i></button></td>';
                                    }
                                    echo'
                                        
                                </tr>
                                <!-- Modal -->
                                <div class="modal fade" id="IP'.$row["name"].''.$row["id"].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalCenterTitle">Edit Details</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="alert alert-primary text-center p-1" role="alert">
                                        Institute Portfolio
                                    </div>
                                        <div class="form-group p-2">
                                            <label for="sub">Subject Code</label>
                                            <input type="text" class="form-control" value="'.$row["name"].'" id="sub" name="port" readonly>
                                        </div>
                                        <div class="form-group p-2">
                                            <label for="sem">Role</label>
                                            <input type="text" class="form-control" value="'.$row["role"].'" id="sub" name="port" readonly>
                                        </div>
                                        <div class="form-group p-2">
                                            <label for="sem">Duration</label>
                                            <input type="text" class="form-control" value="'.$row["duration"].'" id="sub" name="port" readonly>
                                        </div>
                                        <div class="form-group p-2">
                                            <label for="attach">Attachment &nbsp;
                                            <a href="../../document/'.$row["id"].'/'.$row["attachment"].'" target="_blank" >View</a></label>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                </div>
                                ';
                                $i=$i+1;
                            }
                        }
                        
                    } else {
                        //IP no entry.
                    }

                    $sql = "SELECT * FROM CTS WHERE id='".$id."' AND log<'".date("Y")."-07-01' AND log>='".date("Y", time() - 60*60*24*365 )."-07-01' ORDER BY log DESC";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        
                        while($row = mysqli_fetch_assoc($result)) {
                            if($row["locked"]==1){
                                echo ' <tr>
                                    <td>'.$i.'</td>
                                    <td class="name">'.$name.'</td>
                                    <td>CTS</td>
                                    <td>'.$row['date'].'</td>
                                    <td>'.$row['point'].'</td>
                                    <td>
                                    <div class="row">
                                    <div class="col-auto">
                                    <input type="text" class="form-control col-4" id="commentdata" name="commentdata'.$row["date"].''.$row["id"].'CTS"  placeholder="Type comment.." value="'.$row["comment"].'" style="padding-y: 0.25rem;padding-x: 0.5rem;font-size: 0.875rem;border-radius: 0.25rem;">
                                    <!--<input type="hidden" name="c_id" value="'.$row["id"].'"/>-->
                                    </div>
                                    <div class="col-auto">
                                    <button type="submit" name="comment" id="commentBtn" value="'.$row["date"].'_date_CTS_'.$row["id"].'" class="button-31"><i class="fa-solid fa-square-plus fs-6"></i></button>
                                    </div>
                                    </div>
                                    </td>
                                    <td><button type="button" class="button-29" data-bs-toggle="modal" data-bs-target="#CTS'.$row["date"].''.$row["id"].'"><i class="fa-solid fa-eye fs-6"></i></button></td><td>
                                    ';
                                    if($row["verify"]==1){
                                        echo'<button type="submit" name="v1" value="'.$row["date"].'_date_CTS" class="button-31" disabled><i class="fa-solid fa-circle-check fs-6"></i></button></td><td>';
                                    }
                                    else{
                                        echo'<button type="submit" name="verify" value="'.$row["date"].'_date_CTS_'.$row["id"].'" class="button-31"><i class="fa-solid fa-circle-check fs-6"></i></button></td><td>';
                                    }
                                    
                                    if($row["comment"]){
                                        echo'<button type="submit" name="reject" value="'.$row["date"].'_date_CTS_'.$row["id"].'" class="button-30"><i class="fa-solid fa-circle-xmark fs-6"></i></button></td>   ';                     
                                    }
                                    else{
                                        echo'<button type="submit" name="reject" class="button-30" disabled><i class="fa-solid fa-circle-xmark fs-6"></i></button></td>';
                                    }
                                    echo'
                                        
                                </tr>
                                <!-- Modal -->
                                <div class="modal fade" id="CTS'.$row["date"].''.$row["id"].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-dark" id="exampleModalCenterTitle">Edit Details</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </button>
                                        </button>
                                    </div>
                                    <div class="modal-body mt-0 pt-0">
                                        <form method="POST" action="" class="p-2" enctype="multipart/form-data">
                                        <div class="alert alert-primary text-center p-1" role="alert">
                                        Contribution to Society
                                    </div>
                                        <div class="form-group p-2">
                                            <label for="subC">Date</label>
                                            <input type="text" class="form-control" value="'.$row["date"].'" id="subC" name="date" readonly>
                                        </div>
                                        <div class="form-group p-2">
                                            <label for="subN">Name of Institute</label>
                                            <input type="text" class="form-control" value="'.$row["activity"].'" id="subN" name="activity" readonly>
                                        </div>
                                        <div class="form-group p-2">
                                            <label for="attach">Attachment &nbsp; 
                                            <a href="../../document/'.$row["id"].'/'.$row["attachment"].'" target="_blank" >View</a></label>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                </div>
                                ';
                                $i=$i+1;
                            }
                        }
                        
                    } else {
                        //CTS no entry.
                    }

                    $sql = "SELECT * FROM RAA1 WHERE id='".$id."' AND log<'".date("Y")."-07-01' AND log>='".date("Y", time() - 60*60*24*365 )."-07-01' ORDER BY log DESC";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        
                        while($row = mysqli_fetch_assoc($result)) {
                            if($row["locked"]==1){
                                echo ' <tr>
                                    <td>'.$i.'</td>
                                    <td class="name">'.$name.'</td>
                                    <td>RAA1</td>
                                    <td>'.$row['date'].'</td>
                                    <td>'.$row['point'].'</td>
                                    <td>
                                    <div class="row">
                                    <div class="col-auto">
                                    <input type="text" class="form-control col-4" id="commentdata" name="commentdata'.$row["date"].''.$row["id"].'RAA1"  placeholder="Type comment.." value="'.$row["comment"].'" style="padding-y: 0.25rem;padding-x: 0.5rem;font-size: 0.875rem;border-radius: 0.25rem;">
                                    <!--<input type="hidden" name="c_id" value="'.$row["id"].'"/>-->
                                    </div>
                                    <div class="col-auto">
                                    <button type="submit" name="comment" id="commentBtn" value="'.$row["date"].'_date_RAA1_'.$row["id"].'" class="button-31"><i class="fa-solid fa-square-plus fs-6"></i></button>
                                    </div>
                                    </div>
                                    </td>
                                    <td><button class="button-29" data-bs-toggle="modal" data-bs-target="#RAA1'.$row["date"].''.$row["id"].'"><i class="fa-solid fa-eye fs-6"></i></button></td><td>
                                    ';
                                    if($row["verify"]==1){
                                        echo'<button type="submit" name="v1" value="'.$row["date"].'_date_RAA1" class="button-31" disabled><i class="fa-solid fa-circle-check fs-6"></i></button></td><td>';
                                    }
                                    else{
                                        echo'<button type="submit" name="verify" value="'.$row["date"].'_date_RAA1_'.$row["id"].'" class="button-31"><i class="fa-solid fa-circle-check fs-6"></i></button></td><td>';
                                    }
                                    
                                    if($row["comment"]){
                                        echo'<button type="submit" name="reject" value="'.$row["date"].'_date_RAA1_'.$row["id"].'" class="button-30"><i class="fa-solid fa-circle-xmark fs-6"></i></button></td>    ';                     
                                    }
                                    else{
                                        echo'<button type="submit" name="reject" class="button-30" disabled><i class="fa-solid fa-circle-xmark fs-6"></i></button></td>';
                                    }
                                    echo'
                                        
                                </tr>
                                <!-- Modal -->
                                <div class="modal fade" id="RAA1'.$row["date"].''.$row["id"].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-dark" id="exampleModalCenterTitle">Edit Details</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </button>
                                        </button>
                                    </div>
                                    <div class="modal-body mt-0 pt-0">
                                        <div class="alert alert-primary text-center p-1" role="alert">
                                        Seminar, Workshop, Technical or motivational Training organized
                                    </div>
                                        <div class="form-group p-2">
                                            <label for="subC">Date</label>
                                            <input type="text" class="form-control" value="'.$row["date"].'" id="subC" name="date" readonly>
                                        </div>
                                        <div class="form-group p-2">
                                            <label for="subN">Activity</label>
                                            <input type="text" class="form-control" value="'.$row["name"].'" id="subN" name="name" readonly>
                                        </div>
                                        <div class="form-group p-2">
                                            <label for="sem">For</label>
                                            <input type="text" class="form-control" value="'.$row["considering"].'" id="subN" name="name" readonly>
                                        </div>
                                        <div class="form-group p-2">
                                            <label for="subN">No of participants</label>
                                            <input type="number" min="0" class="form-control" id="nop" name="nop" value="'.$row["participants"].'" readonly>
                                        </div>
                                        <div class="form-group p-2">
                                            <label for="sem">Level of Institute</label>
                                            <input type="text" class="form-control" value="'.$row["role"].'" id="subN" name="name" readonly>
                                        </div>
                                        <div class="form-group p-2">
                                            <label for="attach">Attachment &nbsp; 
                                            <a href="../../document/'.$row["id"].'/'.$row["attachment"].'" target="_blank" >View</a></label>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                </div>
                                ';
                                $i=$i+1;
                            }
                        }
                        
                    } else {
                        //RAA1 no entry.
                    }

                    $sql = "SELECT * FROM RAA2 WHERE id='".$id."' AND log<'".date("Y")."-07-01' AND log>='".date("Y", time() - 60*60*24*365 )."-07-01' ORDER BY log DESC";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        
                        while($row = mysqli_fetch_assoc($result)) {
                            if($row["locked"]==1){
                                echo ' <tr>
                                <td>'.$i.'</td>
                                <td class="name">'.$name.'</td>
                                <td>RAA2</td>
                                <td>'.$row['date'].'</td>
                                <td>'.$row['point'].'</td>
                                <td>
                                <div class="row">
                                <div class="col-auto">
                                <input type="text" class="form-control col-4" id="commentdata" name="commentdata'.$row["date"].''.$row["id"].'RAA2"  placeholder="Type comment.." value="'.$row["comment"].'" style="padding-y: 0.25rem;padding-x: 0.5rem;font-size: 0.875rem;border-radius: 0.25rem;">
                                <!--<input type="hidden" name="c_id" value="'.$row["id"].'"/>-->
                                </div>
                                <div class="col-auto">
                                <button type="submit" name="comment" id="commentBtn" value="'.$row["date"].'_date_RAA2_'.$row["id"].'" class="button-31"><i class="fa-solid fa-square-plus fs-6"></i></button>
                                </div>
                                </div>
                                </td>
                                <td><button type="button" class="button-29" data-bs-toggle="modal" data-bs-target="#RAA2'.$row["date"].''.$row["id"].'"><i class="fa-solid fa-eye fs-6"></i></button></td><td>
                                ';
                                if($row["verify"]==1){
                                    echo'<button type="submit" name="v1" value="'.$row["date"].'_date_RAA2" class="button-31" disabled><i class="fa-solid fa-circle-check fs-6"></i></button></td><td>';
                                }
                                else{
                                    echo'<button type="submit" name="verify" value="'.$row["date"].'_date_RAA2_'.$row["id"].'" class="button-31"><i class="fa-solid fa-circle-check fs-6"></i></button></td><td>';
                                }
                                
                                if($row["comment"]){
                                    echo'<button type="submit" name="reject" value="'.$row["date"].'_date_RAA2_'.$row["id"].'" class="button-30"><i class="fa-solid fa-circle-xmark fs-6"></i></button></td>    ';                     
                                }
                                else{
                                    echo'<button type="submit" name="reject" class="button-30" disabled><i class="fa-solid fa-circle-xmark fs-6"></i></button></td>';
                                }
                                echo'
                                </tr>
                                <!-- Modal -->
                                <div class="modal fade" id="RAA2'.$row["date"].''.$row["id"].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-dark" id="exampleModalCenterTitle">Edit Details</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </button>
                                        </button>
                                    </div>
                                    <div class="modal-body mt-0 pt-0">
                                        <div class="alert alert-primary text-center p-1" role="alert">
                                        FDP/ STTP organized
                                    </div>
                                        <div class="form-group p-2">
                                            <label for="subC">Date</label>
                                            <input type="text" class="form-control" value="'.$row["date"].'" id="subC" name="date" readonly>
                                        </div>
                                        <div class="form-group p-2">
                                            <label for="subN">Title</label>
                                            <input type="text" class="form-control" value="'.$row["title"].'" id="subN" name="title" readonly>
                                        </div>
                                        <div class="form-group p-2">
                                            <label for="subN">Place</label>
                                            <input type="text" class="form-control" value="'.$row["place"].'" id="subN" name="place" readonly>
                                        </div>
                                        <div class="form-group p-2">
                                            <label for="subN">Sponsoring Agency</label>
                                            <input type="text" class="form-control" value="'.$row["sponsoring_agency"].'" id="subN" name="sa" readonly>
                                        </div>
                                        <div class="form-group p-2">
                                            <label for="subN">No of participants</label>
                                            <input type="number" min="0" class="form-control" id="nop" name="nop" value="'.$row["participants"].'" readonly>
                                        </div>
                                        <div class="form-group p-2">
                                            <label for="subN">No of days</label>
                                            <input type="number" min="0" max="10" class="form-control" id="nop" name="nod" value="'.$row["days"].'" readonly>
                                        </div>
                                        <div class="form-group p-2">
                                            <label for="attach">Attachment &nbsp; 
                                            <a href="../../document/'.$row["id"].'/'.$row["attachment"].'" target="_blank" >View</a></label>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                </div>
                                ';
                                $i=$i+1;
                            }
                        }
                        
                    } else {
                        //RAA2 no entry.
                    }

                    $sql = "SELECT * FROM RAA3 WHERE id='".$id."' AND log<'".date("Y")."-07-01' AND log>='".date("Y", time() - 60*60*24*365 )."-07-01' ORDER BY log DESC";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        
                        while($row = mysqli_fetch_assoc($result)) {
                            if($row["locked"]==1){
                                echo ' <tr>
                                <td>'.$i.'</td>
                                <td class="name">'.$name.'</td>
                                <td>RAA3</td>
                                <td>'.$row['date'].'</td>
                                <td>'.$row['point'].'</td>
                                <td>
                                <div class="row">
                                <div class="col-auto">
                                <input type="text" class="form-control col-4" id="commentdata" name="commentdata'.$row["date"].''.$row["id"].'RAA3"  placeholder="Type comment.." value="'.$row["comment"].'" style="padding-y: 0.25rem;padding-x: 0.5rem;font-size: 0.875rem;border-radius: 0.25rem;">
                                <!--<input type="hidden" name="c_id" value="'.$row["id"].'"/>-->
                                </div>
                                <div class="col-auto">
                                <button type="submit" name="comment" id="commentBtn" value="'.$row["date"].'_date_RAA3_'.$row["id"].'" class="button-31"><i class="fa-solid fa-square-plus fs-6"></i></button>
                                </div>
                                </div>
                                </td>
                                <td><button type="button" class="button-29" data-bs-toggle="modal" data-bs-target="#RAA3'.$row["date"].''.$row["id"].'"><i class="fa-solid fa-eye fs-6"></i></button></td><td>
                                ';
                                if($row["verify"]==1){
                                    echo'<button type="submit" name="v1" value="'.$row["date"].'_date_RAA3" class="button-31" disabled><i class="fa-solid fa-circle-check fs-6"></i></button></td><td>';
                                }
                                else{
                                    echo'<button type="submit" name="verify" value="'.$row["date"].'_date_RAA3_'.$row["id"].'" class="button-31"><i class="fa-solid fa-circle-check fs-6"></i></button></td><td>';
                                }
                                
                                if($row["comment"]){
                                    
                                    echo'  <button type="submit" name="reject" value="'.$row["date"].'_date_RAA3_'.$row["id"].'" class="button-30"><i class="fa-solid fa-circle-xmark fs-6"></i></button></td>                                ';
                                }
                                else{
                                    echo'<button type="submit" name="reject" class="button-30" disabled><i class="fa-solid fa-circle-xmark fs-6"></i></button></td>';
                                }
                                echo'  
                                
                                </tr>
                                <!-- Modal -->
                                <div class="modal fade" id="RAA3'.$row["date"].''.$row["id"].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-dark" id="exampleModalCenterTitle">Edit Details</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </button>
                                        </button>
                                    </div>
                                    <div class="modal-body mt-0 pt-0">
                                        <div class="alert alert-primary text-center p-1" role="alert">
                                        Participation in MOOCS courses
                                    </div>
                                        <div class="form-group p-2">
                                            <label for="subC">Date</label>
                                            <input type="text" class="form-control" value="'.$row["date"].'" id="subC" name="date" readonly>
                                        </div>
                                        <div class="form-group p-2">
                                            <label for="subN">Name of course</label>
                                            <input type="text" class="form-control" value="'.$row["name"].'" id="subN" name="name" readonly>
                                        </div>
                                        <div class="form-group p-2">
                                            <label for="subN">Date of examination</label>
                                            <input type="date" class="form-control" max="'.date('Y-m-d').'" value="'.$row["date_of_examination"].'" id="subN" name="dateoe" readonly>
                                        </div>
                                        <div class="form-group p-2">
                                            <label for="subN">Duration</label>
                                            <input type="number" min="0" max="8" class="form-control" id="nop" name="nop" value="'.$row["duration"].'" readonly>
                                        </div>
                                        <div class="form-group p-2">
                                            <label for="attach">Attachment &nbsp; 
                                            <a href="../../document/'.$row["id"].'/'.$row["attachment"].'" target="_blank" >View</a></label>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                </div>
                                ';
                                $i=$i+1;
                            }
                        }
                        
                    } else {
                        //RAA3 no entry.
                    }

                    $sql = "SELECT * FROM RAA4 WHERE id='".$id."' AND log<'".date("Y")."-07-01' AND log>='".date("Y", time() - 60*60*24*365 )."-07-01' ORDER BY log DESC";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        
                        while($row = mysqli_fetch_assoc($result)) {
                            if($row["locked"]==1){
                                echo ' <tr>
                                <td>'.$i.'</td>
                                <td class="name">'.$name.'</td>
                                <td>RAA4</td>
                                <td>'.$row['date'].'</td>
                                <td>'.$row['point'].'</td>
                                <td>
                                <div class="row">
                                <div class="col-auto">
                                <input type="text" class="form-control col-4" id="commentdata" name="commentdata'.$row["date"].''.$row["id"].'RAA4"  placeholder="Type comment.." value="'.$row["comment"].'" style="padding-y: 0.25rem;padding-x: 0.5rem;font-size: 0.875rem;border-radius: 0.25rem;">
                                <!--<input type="hidden" name="c_id" value="'.$row["id"].'"/>-->
                                </div>
                                <div class="col-auto">
                                <button type="submit" name="comment" id="commentBtn" value="'.$row["date"].'_date_RAA4_'.$row["id"].'" class="button-31"><i class="fa-solid fa-square-plus fs-6"></i></button>
                                </div>
                                </div>
                                </td>
                                <td><button type="button" class="button-29" data-bs-toggle="modal" data-bs-target="#RAA4'.$row["date"].''.$row["id"].'"><i class="fa-solid fa-eye fs-6"></i></button></td><td>
                                ';
                                if($row["verify"]==1){
                                    echo'<button type="submit" name="v1" value="'.$row["date"].'_date_RAA4" class="button-31" disabled><i class="fa-solid fa-circle-check fs-6"></i></button></td><td>';
                                }
                                else{
                                    echo'<button type="submit" name="verify" value="'.$row["date"].'_date_RAA4_'.$row["id"].'" class="button-31"><i class="fa-solid fa-circle-check fs-6"></i></button></td><td>';
                                }
                                
                                if($row["comment"]){
                                    
                                    echo'<button type="submit" name="reject" value="'.$row["date"].'_date_RAA4_'.$row["id"].'" class="button-30"><i class="fa-solid fa-circle-xmark fs-6"></i></button></td>                              ';
                                }
                                else{
                                    echo'<button type="submit" name="reject" class="button-30" disabled><i class="fa-solid fa-circle-xmark fs-6"></i></button></td>';
                                }
                                echo'
                                </tr>
                                <!-- Modal -->
                                <div class="modal fade" id="RAA4'.$row["date"].''.$row["id"].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-dark" id="exampleModalCenterTitle">Edit Details</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </button>
                                        </button>
                                    </div>
                                    <div class="modal-body mt-0 pt-0">
                                        <div class="alert alert-primary text-center p-1" role="alert">
                                        Membership of Associations or Professional Bodies
                                    </div>
                                        <div class="form-group p-2">
                                            <label for="subC">Date</label>
                                            <input type="text" class="form-control" value="'.$row["date"].'" id="subC" name="date" readonly>
                                        </div>
                                        <div class="form-group p-2">
                                            <label for="subN">Activity</label>
                                            <input type="text" class="form-control" value="'.$row["name"].'" id="subN" name="name" readonly>
                                        </div>
                                        <div class="form-group p-2">
                                            <label for="sem">For</label>
                                            <input type="text" class="form-control" value="'.$row["type"].'" id="subN" name="name" readonly>
                                        </div>
                                        <div class="form-group p-2">
                                            <label for="subN">Membership Number</label>
                                            <input type="number" min="0" class="form-control" id="nom" name="nom" value="'.$row["membership"].'" readonly>
                                        </div>
                                        <div class="form-group p-2">
                                            <label for="attach">Attachment &nbsp; 
                                            <a href="../../document/'.$row["id"].'/'.$row["attachment"].'" target="_blank" >View</a></label>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                </div>
                                ';
                                $i=$i+1;
                            }
                        }
                        
                    } else {
                        //RAA4 no entry.
                    }

                    $sql = "SELECT * FROM RAA5 WHERE id='".$id."' AND log<'".date("Y")."-07-01' AND log>='".date("Y", time() - 60*60*24*365 )."-07-01' ORDER BY log DESC";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        
                        while($row = mysqli_fetch_assoc($result)) {
                            if($row["locked"]==1){
                                echo ' <tr>
                                <td>'.$i.'</td>
                                <td class="name">'.$name.'</td>
                                <td>RAA5</td>
                                <td>'.$row['name'].'</td>
                                <td>'.$row['point'].'</td>
                                <td>
                                <div class="row">
                                <div class="col-auto">
                                <input type="text" class="form-control col-4" id="commentdata" name="commentdata'.$row["name"].''.$row["id"].'RAA5"  placeholder="Type comment.." value="'.$row["comment"].'" style="padding-y: 0.25rem;padding-x: 0.5rem;font-size: 0.875rem;border-radius: 0.25rem;">
                                <!--<input type="hidden" name="c_id" value="'.$row["id"].'"/>-->
                                </div>
                                <div class="col-auto">
                                <button type="submit" name="comment" id="commentBtn" value="'.$row["name"].'_name_RAA5_'.$row["id"].'" class="button-31"><i class="fa-solid fa-square-plus fs-6"></i></button>
                                </div>
                                </div>
                                </td>
                                <td><button type="button" class="button-29" data-bs-toggle="modal" data-bs-target="#RAA5'.$row["name"].''.$row["id"].'"><i class="fa-solid fa-eye fs-6"></i></button></td><td>
                                ';
                                if($row["verify"]==1){
                                    echo'<button type="submit" name="v1" value="'.$row["name"].'_name_RAA5" class="button-31" disabled><i class="fa-solid fa-circle-check fs-6"></i></button></td><td>';
                                }
                                else{
                                    echo'<button type="submit" name="verify" value="'.$row["name"].'_name_RAA5_'.$row["id"].'" class="button-31"><i class="fa-solid fa-circle-check fs-6"></i></button></td><td>';
                                }
                                
                                if($row["comment"]){
                                    
                                    echo'<button type="submit" name="reject" value="'.$row["name"].'_name_RAA5_'.$row["id"].'" class="button-30"><i class="fa-solid fa-circle-xmark fs-6"></i></button></td>                              ';
                                }
                                else{
                                    echo'<button type="submit" name="reject" class="button-30" disabled><i class="fa-solid fa-circle-xmark fs-6"></i></button></td>';
                                }
                                echo'
                                </tr>
                                <!-- Modal -->
                                <div class="modal fade" id="RAA5'.$row["name"].''.$row["id"].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-dark" id="exampleModalCenterTitle">Edit Details</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </button>
                                        </button>
                                    </div>
                                    <div class="modal-body mt-0 pt-0">
                                        <div class="alert alert-primary text-center p-1" role="alert">
                                        Research paper publication in peer reviewed journal
                                    </div>
                                        <div class="form-group p-2">
                                            <label for="subC">Date</label>
                                            <input type="text" class="form-control" value="'.$row["name"].'" id="subC" name="name" readonly>
                                        </div>
                                        <div class="form-group p-2">
                                            <label for="subN">Activity</label>
                                            <input type="text" class="form-control" value="'.$row["title"].'" id="subN" name="title" readonly>
                                        </div>

                                        <div class="form-group p-2">
                                            <label for="sem">Indexing</label>
                                            <input type="text" class="form-control" value="'.$row["indexing"].'" id="subN" name="title" readonly>
                                        </div>
                                        <div class="form-group p-2">
                                            <label for="subN">ISSN no</label>
                                            <input type="text" class="form-control" id="issn" name="issn" value="'.$row["issn"].'" readonly>
                                        </div>
                                        <div class="form-group p-2">
                                            <label for="subN">Journal name</label>
                                            <input type="text" class="form-control" id="journal" name="journal" value="'.$row["journal"].'" readonly>
                                        </div>
                                        <div class="form-group p-2">
                                            <label for="subN">Volumn page</label>
                                            <input type="text" class="form-control" id="vpage" name="vpage" value="'.$row["vpage"].'" readonly>
                                        </div>
                                        <div class="form-group p-2">
                                            <label for="attach">Attachment &nbsp; 
                                            <a href="../../document/'.$row["id"].'/'.$row["attachment"].'" target="_blank" >View</a></label>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                </div>
                                ';
                                $i=$i+1;
                            }
                        }
                        
                    } else {
                        //RAA5 no entry.
                    }

                    $sql = "SELECT * FROM RAA6 WHERE id='".$id."' AND log<'".date("Y")."-07-01' AND log>='".date("Y", time() - 60*60*24*365 )."-07-01' ORDER BY log DESC";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        
                        while($row = mysqli_fetch_assoc($result)) {
                            if($row["locked"]==1){
                                echo ' <tr>
                                <td>'.$i.'</td>
                                <td class="name">'.$name.'</td>
                                <td>RAA6</td>
                                <td>'.$row['name'].'</td>
                                <td>'.$row['point'].'</td>
                                <td>
                                <div class="row">
                                <div class="col-auto">
                                <input type="text" class="form-control col-4" id="commentdata" name="commentdata'.$row["name"].''.$row["id"].'RAA6"  placeholder="Type comment.." value="'.$row["comment"].'" style="padding-y: 0.25rem;padding-x: 0.5rem;font-size: 0.875rem;border-radius: 0.25rem;">
                                <!--<input type="hidden" name="c_id" value="'.$row["id"].'"/>-->
                                </div>
                                <div class="col-auto">
                                <button type="submit" name="comment" id="commentBtn" value="'.$row["name"].'_name_RAA6_'.$row["id"].'" class="button-31"><i class="fa-solid fa-square-plus fs-6"></i></button>
                                </div>
                                </div>
                                </td>
                                <td><button type="button" class="button-29" data-bs-toggle="modal" data-bs-target="#RAA6'.$row["name"].''.$row["id"].'"><i class="fa-solid fa-eye fs-6"></i></button></td><td>
                                ';
                                if($row["verify"]==1){
                                    echo'<button type="submit" name="v1" value="'.$row["name"].'_name_RAA6" class="button-31" disabled><i class="fa-solid fa-circle-check fs-6"></i></button></td><td>';
                                }
                                else{
                                    echo'<button type="submit" name="verify" value="'.$row["name"].'_name_RAA6_'.$row["id"].'" class="button-31"><i class="fa-solid fa-circle-check fs-6"></i></button></td><td>';
                                }
                                
                                if($row["comment"]){
                                    
                                    echo'<button type="submit" name="reject" value="'.$row["name"].'_name_RAA6_'.$row["id"].'" class="button-30"><i class="fa-solid fa-circle-xmark fs-6"></i></button></td>                              ';
                                }
                                else{
                                    echo'<button type="submit" name="reject" class="button-30" disabled><i class="fa-solid fa-circle-xmark fs-6"></i></button></td>';
                                }
                                echo'
                                </tr>
                                <!-- Modal -->
                                <div class="modal fade" id="RAA6'.$row["name"].''.$row["id"].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-dark" id="exampleModalCenterTitle">Edit Details</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </button>
                                        </button>
                                    </div>
                                    <div class="modal-body mt-0 pt-0">
                                        <div class="alert alert-primary text-center p-1" role="alert">
                                        Research paper publication in Conference
                                    </div>
                                        <div class="form-group p-2">
                                            <label for="subC">Date</label>
                                            <input type="text" class="form-control" value="'.$row["name"].'" id="subC" name="name" readonly>
                                        </div>
                                        <div class="form-group p-2">
                                            <label for="subN">Publisher & Indexing</label>
                                            <input type="text" class="form-control" id="pi" value="'.$row["pi"].'" name="pi" readonly>
                                        </div>
                                        <div class="form-group p-2">
                                            <label for="subN">Name of conference,volumn,page</label>
                                            <input type="text" class="form-control" id="cvp" value="'.$row["cvp"].'" name="cvp" readonly>
                                        </div>

                                        <div class="form-group p-2">
                                            <label for="sem">Presented/Publish</label>
                                            <input type="text" class="form-control" id="cvp" value="'.$row["pp"].'" name="cvp" readonly>
                                        </div>
                                        <div class="form-group p-2">
                                            <label for="attach">Attachment &nbsp; 
                                            <a href="../../document/'.$row["id"].'/'.$row["attachment"].'" target="_blank" >View</a></label>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                </div>
                                ';
                                $i=$i+1;
                            }
                        }
                        
                    } else {
                        //RAA6 no entry.
                    }

                    $sql = "SELECT * FROM RAA7 WHERE id='".$id."' AND log<'".date("Y")."-07-01' AND log>='".date("Y", time() - 60*60*24*365 )."-07-01' ORDER BY log DESC";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        
                        while($row = mysqli_fetch_assoc($result)) {
                            if($row["locked"]==1){
                                echo ' <tr>
                                <td>'.$i.'</td>
                                <td class="name">'.$name.'</td>
                                <td>RAA7</td>
                                <td>'.$row['title'].'</td>
                                <td>'.$row['point'].'</td>
                                <td>
                                <div class="row">
                                <div class="col-auto">
                                <input type="text" class="form-control col-4" id="commentdata" name="commentdata'.$row["title"].''.$row["id"].'RAA7"  placeholder="Type comment.." value="'.$row["comment"].'" style="padding-y: 0.25rem;padding-x: 0.5rem;font-size: 0.875rem;border-radius: 0.25rem;">
                                <!--<input type="hidden" name="c_id" value="'.$row["id"].'"/>-->
                                </div>
                                <div class="col-auto">
                                <button type="submit" name="comment" id="commentBtn" value="'.$row["title"].'_title_RAA7_'.$row["id"].'" class="button-31"><i class="fa-solid fa-square-plus fs-6"></i></button>
                                </div>
                                </div>
                                </td>
                                <td><button type="button" class="button-29" data-bs-toggle="modal" data-bs-target="#RAA7'.$row["title"].''.$row["id"].'"><i class="fa-solid fa-eye fs-6"></i></button></td><td>
                                ';
                                if($row["verify"]==1){
                                    echo'<button type="submit" name="v1" value="'.$row["title"].'_title_RAA7" class="button-31" disabled><i class="fa-solid fa-circle-check fs-6"></i></button></td><td>';
                                }
                                else{
                                    echo'<button type="submit" name="verify" value="'.$row["title"].'_title_RAA7_'.$row["id"].'" class="button-31"><i class="fa-solid fa-circle-check fs-6"></i></button></td><td>';
                                }
                                
                                if($row["comment"]){
                                    
                                    echo'<button type="submit" name="reject" value="'.$row["title"].'_title_RAA7_'.$row["id"].'" class="button-30"><i class="fa-solid fa-circle-xmark fs-6"></i></button></td>                              ';
                                }
                                else{
                                    echo'<button type="submit" name="reject" class="button-30" disabled><i class="fa-solid fa-circle-xmark fs-6"></i></button></td>';
                                }
                                echo'
                                </tr>
                                <!-- Modal -->
                                <div class="modal fade" id="RAA7'.$row["title"].''.$row["id"].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-dark" id="exampleModalCenterTitle">Edit Details</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </button>
                                        </button>
                                    </div>
                                    <div class="modal-body mt-0 pt-0">
                                        <div class="alert alert-primary text-center p-1" role="alert">
                                        Books authored
                                    </div>
                                        <div class="form-group p-2">
                                            <label for="subC">Date</label>
                                            <input type="text" class="form-control" value="'.$row["title"].'" id="subC" name="title" readonly>
                                        </div>
                                        <div class="form-group p-2">
                                            <label for="subN">Year</label>
                                            <input type="text" class="form-control" id="year" name="year" value="'.$row["year"].'" readonly>
                                        </div>
                                        <div class="form-group p-2">
                                            <label for="subN">Authors</label>
                                            <input type="text" class="form-control" id="authors" name="authors" value="'.$row["authors"].'" readonly>
                                        </div>
                                        <div class="form-group p-2">
                                            <label for="sem">Publisher</label>
                                            <input type="text" class="form-control" id="authors" name="authors" value="'.$row["publisher"].'" readonly>
                                        </div>
                                        <div class="form-group p-2">
                                            <label for="attach">Attachment &nbsp; 
                                            <a href="../../document/'.$row["id"].'/'.$row["attachment"].'" target="_blank" >View</a></label>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                </div>
                                ';
                                $i=$i+1;
                            }
                        }
                        
                    } else {
                        //RAA7 no entry.
                    }

                    $sql = "SELECT * FROM RAA8 WHERE id='".$id."' AND log<'".date("Y")."-07-01' AND log>='".date("Y", time() - 60*60*24*365 )."-07-01' ORDER BY log DESC";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        
                        while($row = mysqli_fetch_assoc($result)) {
                            if($row["locked"]==1){
                                echo ' <tr>
                                <td>'.$i.'</td>
                                <td class="name">'.$name.'</td>
                                <td>RAA8</td>
                                <td>'.$row['subject'].'</td>
                                <td>'.$row['point'].'</td>
                                <td>
                                <div class="row">
                                <div class="col-auto">
                                <input type="text" class="form-control col-4" id="commentdata" name="commentdata'.$row["subject"].''.$row["id"].'RAA8"  placeholder="Type comment.." value="'.$row["comment"].'" style="padding-y: 0.25rem;padding-x: 0.5rem;font-size: 0.875rem;border-radius: 0.25rem;">
                                <!--<input type="hidden" name="c_id" value="'.$row["id"].'"/>-->
                                </div>
                                <div class="col-auto">
                                <button type="submit" name="comment" id="commentBtn" value="'.$row["subject"].'_subject_RAA8_'.$row["id"].'" class="button-31"><i class="fa-solid fa-square-plus fs-6"></i></button>
                                </div>
                                </div>
                                </td>
                                <td><button type="button" class="button-29" data-bs-toggle="modal" data-bs-target="#RAA8'.$row["subject"].''.$row["id"].'"><i class="fa-solid fa-eye fs-6"></i></button></td><td>
                                ';
                                if($row["verify"]==1){
                                    echo'<button type="submit" name="v1" value="'.$row["subject"].'_subject_RAA8" class="button-31" disabled><i class="fa-solid fa-circle-check fs-6"></i></button></td><td>';
                                }
                                else{
                                    echo'<button type="submit" name="verify" value="'.$row["subject"].'_subject_RAA8_'.$row["id"].'" class="button-31"><i class="fa-solid fa-circle-check fs-6"></i></button></td><td>';
                                }
                                
                                if($row["comment"]){
                                    
                                    echo'<button type="submit" name="reject" value="'.$row["subject"].'_subject_RAA8_'.$row["id"].'" class="button-30"><i class="fa-solid fa-circle-xmark fs-6"></i></button></td>                              ';
                                }
                                else{
                                    echo'<button type="submit" name="reject" class="button-30" disabled><i class="fa-solid fa-circle-xmark fs-6"></i></button></td>';
                                }
                                echo'
                                </tr>
                                <!-- Modal -->
                                <div class="modal fade" id="RAA8'.$row["subject"].''.$row["id"].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-dark" id="exampleModalCenterTitle">Edit Details</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </button>
                                        </button>
                                    </div>
                                    <div class="modal-body mt-0 pt-0">
                                        <div class="alert alert-primary text-center p-1" role="alert">
                                        E-content
                                    </div>
                                        <div class="form-group p-2">
                                            <label for="sub">Sem</label>
                                            <input type="text" class="form-control" value="'.$row["sem"].'" id="sem" name="sem" readonly>
                                        </div>
                                        <div class="form-group p-2">
                                            <label for="sub">Subject Code</label>
                                            <input type="text" class="form-control" value="'.$row["subject"].'" id="sub" name="subCode" readonly>
                                        </div>
                                        <div class="form-group p-2">
                                            <label for="sub">Subject Name</label>
                                            <input type="text" class="form-control" value="'.$row["name"].'" id="name" name="name" readonly>
                                        </div>
                                        <div class="form-group p-2">
                                            <label for="subN">Link</label>
                                            <input type="text" class="form-control" id="link" name="link" value="'.$row["link"].'" readonly>
                                        </div>
                                        <div class="form-group p-2">
                                            <label for="attach">Attachment &nbsp; 
                                            <a href="../../document/'.$row["id"].'/'.$row["attachment"].'" target="_blank" >View</a></label>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                </div>
                                ';
                                $i=$i+1;
                            }
                        }
                        
                    } else {
                        //RAA8 no entry.
                    }

                    $sql = "SELECT * FROM RAA9 WHERE id='".$id."' AND log<'".date("Y")."-07-01' AND log>='".date("Y", time() - 60*60*24*365 )."-07-01' ORDER BY log DESC";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        
                        while($row = mysqli_fetch_assoc($result)) {
                            if($row["locked"]==1){
                                echo ' <tr>
                                <td>'.$i.'</td>
                                    <td class="name">'.$name.'</td>
                                    <td>RAA9</td>
                                    <td>'.$row['name'].'</td>
                                    <td>'.$row['point'].'</td>
                                    <td>
                                    <div class="row">
                                    <div class="col-auto">
                                    <input type="text" class="form-control col-4" id="commentdata" name="commentdata'.$row["name"].''.$row["id"].'RAA9"  placeholder="Type comment.." value="'.$row["comment"].'" style="padding-y: 0.25rem;padding-x: 0.5rem;font-size: 0.875rem;border-radius: 0.25rem;">
                                    <!--<input type="hidden" name="c_id" value="'.$row["id"].'"/>-->
                                    </div>
                                    <div class="col-auto">
                                    <button type="submit" name="comment" id="commentBtn" value="'.$row["name"].'_name_RAA9_'.$row["id"].'" class="button-31"><i class="fa-solid fa-square-plus fs-6"></i></button>
                                    </div>
                                    </div>
                                    </td>
                                    <td><button class="button-29" data-bs-toggle="modal" data-bs-target="#RAA9'.$row["name"].''.$row["id"].'"><i class="fa-solid fa-eye fs-6"></i></button></td><td>
                                    ';
                                    if($row["verify"]==1){
                                        echo'<button type="submit" name="v1" value="'.$row["name"].'_name_RAA9" class="button-31" disabled><i class="fa-solid fa-circle-check fs-6"></i></button></td><td>';
                                    }
                                    else{
                                        echo'<button type="submit" name="verify" value="'.$row["name"].'_name_RAA9_'.$row["id"].'" class="button-31"><i class="fa-solid fa-circle-check fs-6"></i></button></td><td>';
                                    }
                                    
                                if($row["comment"]){
                                    
                                    echo'<button type="submit" name="reject" value="'.$row["name"].'_name_RAA9_'.$row["id"].'" class="button-30"><i class="fa-solid fa-circle-xmark fs-6"></i></button></td>';
                                }
                                else{
                                    echo'<button type="submit" name="reject" class="button-30" disabled><i class="fa-solid fa-circle-xmark fs-6"></i></button></td>';
                                }
                                echo' 
                                </tr>
                                <!-- Modal -->
                                <div class="modal fade" id="RAA9'.$row["name"].''.$row["id"].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-dark" id="exampleModalCenterTitle">Edit Details</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </button>
                                        </button>
                                    </div>
                                    <div class="modal-body mt-0 pt-0">
                                        <div class="alert alert-primary text-center p-1" role="alert">
                                        Patent
                                    </div>
                                        <div class="form-group p-2">
                                            <label for="sem">Patent\'s Name</label>
                                            <input type="text" class="form-control" id="link" name="link" value="'.$row["name"].'" readonly>
                                        </div>
                                        <div class="form-group p-2">
                                            <label for="sem">Option1</label>
                                            <input type="text" class="form-control" id="link" name="link" value="'.$row["type"].'" readonly>
                                        </div>
                                        <div class="form-group p-2">
                                            <label for="attach">Attachment &nbsp; 
                                            <a href="../../document/'.$row["id"].'/'.$row["attachment"].'" target="_blank" >View</a></label>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                </div>
                                ';
                                $i=$i+1;
                            }
                        }
                        
                    } else {
                        //RAA9 no entry.
                    }

                    $sql = "SELECT * FROM RAA10 WHERE id='".$id."' AND log<'".date("Y")."-07-01' AND log>='".date("Y", time() - 60*60*24*365 )."-07-01' ORDER BY log DESC";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        
                        while($row = mysqli_fetch_assoc($result)) {
                            if($row["locked"]==1){
                                echo ' <tr>
                                <td>'.$i.'</td>
                                <td class="name">'.$name.'</td>
                                <td>RAA10</td>
                                <td>'.$row['name'].'</td>
                                <td>'.$row['point'].'</td>
                                <td>
                                <div class="row">
                                <div class="col-auto">
                                <input type="text" class="form-control col-4" id="commentdata" name="commentdata'.$row["name"].''.$row["id"].'RAA10"  placeholder="Type comment.." value="'.$row["comment"].'" style="padding-y: 0.25rem;padding-x: 0.5rem;font-size: 0.875rem;border-radius: 0.25rem;">
                                <!--<input type="hidden" name="c_id" value="'.$row["id"].'"/>-->
                                </div>
                                <div class="col-auto">
                                <button type="submit" name="comment" id="commentBtn" value="'.$row["name"].'_name_RAA10_'.$row["id"].'" class="button-31"><i class="fa-solid fa-square-plus fs-6"></i></button>
                                </div>
                                </div>
                                </td>
                                <td><button type="button" class="button-29" data-bs-toggle="modal" data-bs-target="#RAA10'.$row["name"].''.$row["id"].'"><i class="fa-solid fa-eye fs-6"></i></button></td><td>
                                ';
                                if($row["verify"]==1){
                                    echo'<button type="submit" name="v1" value="'.$row["name"].'_name_RAA10" class="button-31" disabled><i class="fa-solid fa-circle-check fs-6"></i></button></td><td>';
                                }
                                else{
                                    echo'<button type="submit" name="verify" value="'.$row["name"].'_name_RAA10_'.$row["id"].'" class="button-31"><i class="fa-solid fa-circle-check fs-6"></i></button></td><td>';
                                }
                                
                                if($row["comment"]){
                                    
                                    echo'<button type="submit" name="reject" value="'.$row["name"].'_name_RAA10_'.$row["id"].'" class="button-30"><i class="fa-solid fa-circle-xmark fs-6"></i></button></td>                              ';
                                }
                                else{
                                    echo'<button type="submit" name="reject" class="button-30" disabled><i class="fa-solid fa-circle-xmark fs-6"></i></button></td>';
                                }
                                echo'
                                </tr>
                                <!-- Modal -->
                                <div class="modal fade" id="RAA10'.$row["name"].''.$row["id"].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-dark" id="exampleModalCenterTitle">Edit Details</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </button>
                                        </button>
                                    </div>
                                    <div class="modal-body mt-0 pt-0">
                                        
                                    <div class="modal-body mt-0 pt-0">
                                        <div class="alert alert-primary text-center p-1" role="alert">
                                        Research Guidance
                                    </div>
                                        <div class="form-group p-2">
                                            <label for="subN">Name</label>
                                            <input type="text" class="form-control" id="subCode" name="subCode" value="'.$row["name"].'" readonly>
                                        </div>
                                        <div class="form-group p-2">
                                            <label for="subN">No of candidate/team/group</label>
                                            <input type="number" min="0" class="form-control" id="noc" name="noc" value="'.$row["candidate"].'" readonly>
                                        </div>
                                        <div class="form-group p-2">
                                            <label for="subN">Name of University</label>
                                            <input type="text" class="form-control" id="name" name="nameou" value="'.$row["university"].'" readonly>
                                        </div>
                                        <div class="form-group p-2">
                                            <label for="attach">Attachment &nbsp; 
                                            <a href="../../document/'.$row["id"].'/'.$row["attachment"].'" target="_blank" >View</a></label>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                </div>
                                ';
                                $i=$i+1;
                            }
                        }
                        
                    } else {
                        //RAA10 no entry.
                    }

                    $sql = "SELECT * FROM INV WHERE id='".$id."' AND log<'".date("Y")."-07-01' AND log>='".date("Y", time() - 60*60*24*365 )."-07-01' ORDER BY log DESC";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        
                        while($row = mysqli_fetch_assoc($result)) {
                            if($row["locked"]==1){
                                echo ' <tr>
                                    <td>'.$i.'</td>
                                    <td class="name">'.$name.'</td>
                                    <td>INV</td>
                                    <td>'.$row['date'].'</td>
                                    <td>'.$row['point'].'</td>
                                    <td>
                                    <div class="row">
                                    <div class="col-auto">
                                    <input type="text" class="form-control col-4" id="commentdata" name="commentdata'.$row["date"].''.$row["id"].'INV"  placeholder="Type comment.." value="'.$row["comment"].'" style="padding-y: 0.25rem;padding-x: 0.5rem;font-size: 0.875rem;border-radius: 0.25rem;">
                                    <!--<input type="hidden" name="c_id" value="'.$row["id"].'"/>-->
                                    </div>
                                    <div class="col-auto">
                                    <button type="submit" name="comment" id="commentBtn" value="'.$row["date"].'_date_INV_'.$row["id"].'" class="button-31"><i class="fa-solid fa-square-plus fs-6"></i></button>
                                    </div>
                                    </div>
                                    </td>
                                    <td><button type="button" class="button-29" data-bs-toggle="modal" data-bs-target="#INV'.$row["date"].''.$row["id"].'"><i class="fa-solid fa-eye fs-6"></i></button></td><td>
                                    ';
                                    if($row["verify"]==1){
                                        echo'<button type="submit" name="v1" value="'.$row["date"].'_date_INV" class="button-31" disabled><i class="fa-solid fa-circle-check fs-6"></i></button></td><td>';
                                    }
                                    else{
                                        echo'<button type="submit" name="verify" value="'.$row["date"].'_date_INV_'.$row["id"].'" class="button-31"><i class="fa-solid fa-circle-check fs-6"></i></button></td><td>';
                                    }
                                    
                                if($row["comment"]){
                                    
                                    echo'<button type="submit" name="reject" value="'.$row["date"].'_date_INV_'.$row["id"].'" class="button-30"><i class="fa-solid fa-circle-xmark fs-6"></i></button></td>';
                                }
                                else{
                                    echo'<button type="submit" name="reject" class="button-30" disabled><i class="fa-solid fa-circle-xmark fs-6"></i></button></td>';
                                }
                                echo'             
                                </tr>
                                <!-- Modal -->
                                <div class="modal fade" id="INV'.$row["date"].''.$row["id"].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-dark" id="exampleModalCenterTitle">Edit Details</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </button>
                                        </button>
                                    </div>
                                    <div class="modal-body mt-0 pt-0">
                                    <div class="alert alert-primary text-center p-1" role="alert">
                                    Invited For
                                    </div>
                                        <div class="form-group p-2">
                                            <label for="subC">Date</label>
                                            <input type="text" class="form-control" value="'.$row["date"].'" id="subC" name="date" readonly>
                                        </div>
                                        <div class="form-group p-2">
                                            <label for="subN">Name of Institute</label>
                                            <input type="text" class="form-control" value="'.$row["name"].'" id="subN" name="nameIns" readonly>
                                        </div>
                                        <div class="form-group p-2">
                                            <label for="sem">Level of Institute</label>
                                            <input type="text" class="form-control" value="'.$row["level"].'" id="subN" name="nameIns" readonly>
                                        </div>
                                        <div class="form-group p-2">
                                            <label for="y">Topic name/Type of work</label>
                                            <input type="text" class="form-control" id="topic" name="topic" value="'.$row["topic"].'" readonly>
                                        </div>
                                        <div class="form-group p-2">
                                            <label for="attach">Attachment &nbsp; 
                                            <a href="../../document/'.$row["id"].'/'.$row["attachment"].'" target="_blank" >View</a></label>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                </div>
                                ';
                                $i=$i+1;
                            }
                        }
                        
                    } else {
                        //INV no entry.
                    }

                    $sql = "SELECT * FROM AO WHERE id='".$id."' AND log<'".date("Y")."-07-01' AND log>='".date("Y", time() - 60*60*24*365 )."-07-01' ORDER BY log DESC";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        
                        while($row = mysqli_fetch_assoc($result)) {
                            if($row["locked"]==1){
                                echo ' <tr>
                                    <td>'.$i.'</td>
                                    <td class="name">'.$name.'</td>
                                    <td>AO</td>
                                    <td>'.$row['title'].'</td>
                                    <td>'.$row['point'].'</td>
                                    <td>
                                    <div class="row">
                                    <div class="col-auto">
                                    <input type="text" class="form-control col-4" id="commentdata" name="commentdata'.$row["title"].''.$row["id"].'AO"  placeholder="Type comment.." value="'.$row["comment"].'" style="padding-y: 0.25rem;padding-x: 0.5rem;font-size: 0.875rem;border-radius: 0.25rem;">
                                    <!--<input type="hidden" name="c_id" value="'.$row["id"].'"/>-->
                                    </div>
                                    <div class="col-auto">
                                    <button type="submit" name="comment" id="commentBtn" value="'.$row["title"].'_title_AO_'.$row["id"].'" class="button-31"><i class="fa-solid fa-square-plus fs-6"></i></button>
                                    </div>
                                    </div>
                                    </td>
                                    <td><button type="button" class="button-29" data-bs-toggle="modal" data-bs-target="#AO'.$row["title"].''.$row["id"].'"><i class="fa-solid fa-eye fs-6"></i></button></td><td>
                                    ';
                                    if($row["verify"]==1){
                                        echo'<button type="submit" name="v1" value="'.$row["title"].'_title_AO" class="button-31" disabled><i class="fa-solid fa-circle-check fs-6"></i></button></td><td>';
                                    }
                                    else{
                                        echo'<button type="submit" name="verify" value="'.$row["title"].'_title_AO_'.$row["id"].'" class="button-31"><i class="fa-solid fa-circle-check fs-6"></i></button></td><td>';
                                    }
                                    
                                if($row["comment"]){
                                    
                                    echo'<button type="submit" name="reject" value="'.$row["title"].'_title_AO_'.$row["id"].'" class="button-30"><i class="fa-solid fa-circle-xmark fs-6"></i></button></td>';
                                }
                                else{
                                    echo'<button type="submit" name="reject" class="button-30" disabled><i class="fa-solid fa-circle-xmark fs-6"></i></button></td>';
                                }
                                echo'             
                                <!-- Modal -->
                                </tr>
                                <div class="modal fade" id="AO'.$row["title"].''.$row["id"].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-dark" id="exampleModalCenterTitle">Edit Details</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </button>
                                        </button>
                                    </div>
                                    <div class="modal-body mt-0 pt-0">
                                    <div class="alert alert-primary text-center p-1" role="alert">
                                    Any other
                                    </div>
                                        <div class="form-group p-2">
                                            <label for="subC">Title</label>
                                            <input type="text" class="form-control" value="'.$row["title"].'" id="title" name="title" readonly>
                                        </div>
                                        <div class="form-group p-2">
                                            <label for="attach">Attachment &nbsp; 
                                            <a href="../../document/'.$row["id"].'/'.$row["attachment"].'" target="_blank" >View</a></label>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                </div>
                                ';
                                $i=$i+1;
                            }
                        }
                        
                    } else {
                        //AO no entry.
                    }

                    }


                ?>

                </tbody>
                </table>
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
    <!-- <script src="../../assets/bootstrap-5.3.0-alpha1-dist/js/bootstrap.min.js"></script> -->
    <script src="../../assets/bootstrap-5.3.0-alpha1-dist/js/bootstrap.bundle.min.js"></script>
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

        $('body').on("click", ".dropdown-menu", function (e) {
            $(this).parent().is(".open") && e.stopPropagation();
        });

        $('.selectall').click(function() {
            if ($(this).is(':checked')) {
                $('.option').prop('checked', true);
                var total = $('input[name="options[]"]:checked').length;
                $(".dropdown-text").html('(' + total + ') Selected Criteria');
                $(".select-text").html(' Deselect');
            } else {
                $('.option').prop('checked', false);
                $(".dropdown-text").html('(0) Selected Criteria');
                $(".select-text").html(' Select');
            }
        });

        $("input[type='checkbox'].justone").change(function(){
            var a = $("input[type='checkbox'].justone");
            if(a.length == a.filter(":checked").length){
                $('.selectall').prop('checked', true);
                $(".select-text").html(' Deselect');
            }
            else {
                $('.selectall').prop('checked', false);
                $(".select-text").html(' Select');
            }
            var total = $('input[name="options[]"]:checked').length;
            $(".dropdown-text").html('(' + total + ') Selected Criteria');
        });

        function filter(){
            let search = $("#search");
            var total = $('input[name="options[]"]:checked').length;
            if(search.val().length > 0 && total > 0){

                let val = search.val()
                $("#table23 > tbody").children("tr").hide();
                $("input[type='checkbox'].justone:checked").each(function(i){
                    let v = $(this).val()
                    $(".name").each(function(){
                        var result = ($(this).text()).toLowerCase().indexOf(val.toLowerCase())>=0;
                        if(result && $(this).next().text() === v){
                            $(this).parent().show();
                        }
                    })
                })

            }
            else{
                if(total > 0){
                    $("#table23 > tbody").children("tr").hide();   

                    $("input[type='checkbox'].justone:checked").each(function(i){
                        let v = $(this).val()
                        $(".name").each(function(){
                            if($(this).next().text() === v){
                                $(this).parent().show();
                            }
                        })
                    });
                }
                else if($(this).val().length > 0){
                    let val = search.val()
                    $("#table23 > tbody").children("tr").hide();
                    $(".name").each(function(){
                        var result = ($(this).text()).toLowerCase().indexOf(val.toLowerCase())>=0;
                        if(result){
                            $(this).parent().show();
                        }
                    })
                }
                else{
                    $("#table23 > tbody").children("tr").show();
                }
            }
        }

        $("input[type='checkbox'].justone").click(filter);

        $("input[type='checkbox'].selectall").change(function(){
            let search = $("#search");
            if($(this).val().length > 0){
                let val = search.val()
                $("#table23 > tbody").children("tr").hide();
                $(".name").each(function(){
                    var result = ($(this).text()).toLowerCase().indexOf(val.toLowerCase())>=0;
                    if(result){
                        $(this).parent().show();
                    }
                })
            }
            else{
                $("#table23 > tbody").children("tr").show();
            }
        });
        
        $("#search").on("input",filter);

        
        $(".button-29").each(function(){
            if($(this).attr("data-bs-target")){
                $(this).attr("data-bs-target",$(this).attr("data-bs-target").replace(/[@.$%&^]/g,'-').replace(/\s+/g,'-'));
            }
        })

        $(".modal").each(function(){
            if($(this).attr("id")){
                $(this).attr("id",$(this).attr("id").replace(/[@.$%&^]/g,'-').replace(/\s+/g,'-'));
            }
        })

        $("#table23").find("tr").find("#commentdata").each(function(){
            if($(this).attr("name")){
            $(this).attr("name",$(this).attr("name").replace(/[@.$%&^]/g,'-').replace(/\s+/g,'-'));
            }
        })

    </script>
  </body>
</html>

<?php

  //HOD Operations
  include_once '../../assets/php/hod.php';

?>