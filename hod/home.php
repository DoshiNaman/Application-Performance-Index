<?php

include '../db.php';
if(!isset($_SESSION["id"]) AND !isset($_SESSION["hprofile"]) AND $_SESSION["hprofile"] != 1){
    echo"
    <script>
        location.href = '../index.php';
    </script>
    ";
}
$dept="";
$totalF=array();
$a=$_SESSION["id"];
$sql = "SELECT * FROM Profile WHERE id='".$a."'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        $dept=$row["dept"];
    }
    
} else {
    //tlp no entry.
}

$sql = "SELECT * FROM Profile WHERE dept='".$dept."' AND role='Faculty'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        // array_push($totalF,$row["name"]=>$row["id"]);
        $currentF=array($row["name"]=>$row["id"]);
        $totalF=array_merge($totalF, $currentF);
    }
    
} else {
    //tlp no entry.
}

// echo var_dump($totalF);

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
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>-->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/simple-notify@0.5.5/dist/simple-notify.min.css" />
<script src="https://cdn.jsdelivr.net/npm/simple-notify@0.5.5/dist/simple-notify.min.js"></script>
</head>
<body>
    <div class="container">
        <br/><a href="profile.php">Profile</a><a class="ms-3 float-end" href="logout.php">Logout</a><hr>
        <div id="alertinner">
        
        </div>
        <div class="row p-2">
            <div class="col-lg m-2 p-2 shadow p-3 mb-1 bg-body rounded border border border-light">
                <form method="POST" action="" class="p-2" enctype="multipart/form-data">
                <table class="table table-hover" id="table22">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Element</th>
                    <th scope="col">Uniue</th>
                    <th scope="col">Point</th>
                    <th scope="col">Comment</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                ';
                $i=1;
                foreach($totalF as $name => $id) {

                    // echo "Key=" . $name . ", Value=" . $id;
                    $sql = "SELECT * FROM TLP WHERE id='".$id."'";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            if($row["locked"]==1){
                                
                            echo'    
                            <tr>
                                <td>'.$i.'</td>
                                <td>'.$name.'</td>
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
                                <button type="submit" name="comment" id="commentBtn" value="'.$row["subject"].'_subject_TLP_'.$row["id"].'" class="btn btn-outline-dark btn-sm">POST</button>
                                </div>
                                </div>
                                </td>
                                <td>
                                <div class="row">
                                <div class="col-auto"><button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#TLP'.$row["subject"].''.$row["id"].'">VIEW</button></div>
                                ';
                                if($row["verify"]==1){
                                    echo'<div class="col-auto"><button type="submit" name="v1" value="'.$row["subject"].'_subject_TLP" class="btn btn-success btn-sm" disabled>VERIFIED</button></div>';
                                }
                                else{
                                    echo'<div class="col-auto"><button type="submit" name="verify" value="'.$row["subject"].'_subject_TLP_'.$row["id"].'" class="btn btn-success btn-sm">VERIFY</button></div>';
                                }
                                echo'<div class="col-auto"><button type="submit" name="reject" value="'.$row["subject"].'_subject_TLP_'.$row["id"].'" class="btn btn-danger btn-sm">REJECT</button></div>                              
                                </div>
                                </td>
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
                                    <hr>
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
                                        <a href="../'.$row["id"].'/'.$row["attachment"].'" target="_blank" >View</a></label>
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

                    $sql = "SELECT * FROM GR WHERE id='".$id."'";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        
                        while($row = mysqli_fetch_assoc($result)) {
                            if($row["locked"]==1){                                
                                echo ' <tr>

                                    <td>'.$i.'</td>
                                    <td>'.$name.'</td>
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
                                    <button type="submit" name="comment" id="commentBtn" value="'.$row["subject"].'_subject_GR_'.$row["id"].'" class="btn btn-outline-dark btn-sm">POST</button>
                                    </div>
                                    </div>
                                    </td>
                                    <td>
                                    <div class="row">
                                    <div class="col-auto"><button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#GR'.$row["subject"].''.$row["id"].'">VIEW</button></div>
                                    ';
                                    if($row["verify"]==1){
                                        echo'<div class="col-auto"><button type="submit" name="v1" value="'.$row["subject"].'_subject_GR" class="btn btn-success btn-sm" disabled>VERIFIED</button></div>';
                                    }
                                    else{
                                        echo'<div class="col-auto"><button type="submit" name="verify" value="'.$row["subject"].'_subject_GR_'.$row["id"].'" class="btn btn-success btn-sm">VERIFY</button></div>';
                                    }
                                    echo'<div class="col-auto"><button type="submit" name="reject" value="'.$row["subject"].'_subject_GR_'.$row["id"].'" class="btn btn-danger btn-sm">REJECT</button></div>                               
                                    </div>
                                    </td>
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
                                        <hr>
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
                                            <a href="../'.$row["id"].'/'.$row["attachment"].'" target="_blank" >View</a></label>
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

                    // $sql = "SELECT * FROM DISC WHERE id='".$id."'";
                    // $result = mysqli_query($conn, $sql);
                    // if (mysqli_num_rows($result) > 0) {
                        
                    //     while($row = mysqli_fetch_assoc($result)) {
                    //         if($row["locked"]==1){
                    //             echo ' <tr>
                    //                 <td>'.$i.'</td>
                    //                 <td>'.$name.'</td>
                    //                 <td>DISC</td>
                    //                 <td>'.$row['id'].'</td>
                    //                 <td>'.$row['point'].'</td>
                    //                 <td>
                    //                 <div class="row">
                    //                 <div class="col-auto">
                    //                 <input type="text" class="form-control col-4" id="commentdata" name="commentdata'.$row["id"].'DISC"  placeholder="Type comment.." value="'.$row["comment"].'" style="padding-y: 0.25rem;padding-x: 0.5rem;font-size: 0.875rem;border-radius: 0.25rem;">
                    //                 <!--<input type="hidden" name="c_id" value="'.$row["id"].'"/>-->
                    //                 </div>
                    //                 <div class="col-auto">
                    //                 <button type="submit" name="comment" id="commentBtn" value="DISC_'.$row["id"].'" class="btn btn-outline-dark btn-sm">POST</button>
                    //                 </div>
                    //                 </div>
                    //                 </td>
                    //                 <td>
                    //                 <div class="row">
                    //                 <div class="col-auto"><button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#DISC'.$row["id"].'">VIEW</button></div>
                    //                 ';
                    //                 if($row["verify"]==1){
                    //                     echo'<div class="col-auto"><button type="submit" name="v1" value="'.$row["id"].'_DISC" class="btn btn-success btn-sm" disabled>VERIFIED</button></div>';
                    //                 }
                    //                 else{
                    //                     echo'<div class="col-auto"><button type="submit" name="verify" value="DISC_'.$row["id"].'" class="btn btn-success btn-sm">VERIFY</button></div>';
                    //                 }
                    //                 echo'<div class="col-auto"><button type="submit" name="reject" value="DISC_'.$row["id"].'" class="btn btn-danger btn-sm">REJECT</button></div>                              
                    //                 </div>
                    //                 </td>
                    //             </tr>
                    //             <!-- Modal -->
                    //             <div class="modal fade" id="DISC'.$row["id"].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    //             <div class="modal-dialog modal-dialog-centered" role="document">
                    //                 <div class="modal-content">
                    //                 <div class="modal-header">
                    //                     <h5 class="modal-title text-dark" id="exampleModalCenterTitle">Edit Details</h5>
                    //                     <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    //                     </button>
                    //                     </button>
                    //                 </div>
                    //                 <div class="modal-body mt-0 pt-0">
                    //                     <hr>
                    //                     <div class="form-group p-2">
                    //                         <label for="subC">Id</label>
                    //                         <input type="text" class="form-control" value="'.$row["id"].'" id="subC" name="subCode" readonly>
                    //                     </div>
                    //                     <div class="form-group p-2">
                    //                         <label for="subN">No of times Late Punch</label>
                    //                         <input type="number" min="0" max="100" value="'.$row["TLP"].'" class="form-control" id="nooftlp" name="nooftlp" readonly>
                    //                     </div>
                    //                     <div class="form-group p-2">
                    //                         <label for="subN">No. of LWP</label>
                    //                         <input type="number" min="0" max="100" value="'.$row["LWP"].'" class="form-control" id="nooflwp" name="nooflwp" readonly>
                    //                     </div>
                    //                     <div class="form-group p-2">
                    //                         <label for="subN">No. of Balanced leave</label>
                    //                         <input type="number" min="0" max="5" class="form-control" value="'.$row["BL"].'" id="noofbl" name="noofbl" readonly>
                    //                     </div>
                    //                     <div class="form-group p-2">
                    //                         <label for="subN">No .of memo/justification/clarification</label>
                    //                         <input type="number" min="0" max="100" class="form-control" value="'.$row["MJC"].'" id="noofm" name="noofm" readonly>
                    //                     </div>
                    //                     <div class="form-group p-2">
                    //                         <label for="subN">No .of Fine</label>
                    //                         <input type="number" min="0" max="100" value="'.$row["F"].'" class="form-control" id="nooff" name="nooff" readonly>
                    //                     </div>
                                        
                    //                 </div>
                    //                 </div>
                    //             </div>
                    //             </div>
                    //             ';
                    //             $i=$i+1;
                    //         }
                    //     }
                        
                    // } else {
                    //     //DISC no entry.
                    // }

                    $sql = "SELECT * FROM DP WHERE id='".$id."'";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            if($row["locked"]==1){
                                echo ' <tr>

                                    <td>'.$i.'</td>
                                    <td>'.$name.'</td>
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
                                    <button type="submit" name="comment" id="commentBtn" value="'.$row["name"].'_name_DP_'.$row["id"].'" class="btn btn-outline-dark btn-sm">POST</button>
                                    </div>
                                    </div>
                                    </td>
                                    <td>
                                    <div class="row">
                                    <div class="col-auto"><button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#DP'.$row["name"].''.$row["id"].'">VIEW</button></div>
                                    ';
                                    if($row["verify"]==1){
                                        echo'<div class="col-auto"><button type="submit" name="v1" value="'.$row["name"].'_name_DP" class="btn btn-success btn-sm" disabled>VERIFIED</button></div>';
                                    }
                                    else{
                                        echo'<div class="col-auto"><button type="submit" name="verify" value="'.$row["name"].'_name_DP_'.$row["id"].'" class="btn btn-success btn-sm">VERIFY</button></div>';
                                    }
                                    echo'<div class="col-auto"><button type="submit" name="reject" value="'.$row["name"].'_name_DP_'.$row["id"].'" class="btn btn-danger btn-sm">REJECT</button></div>                              
                                    </div>
                                    </td>
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
                                        <hr>
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
                                            <a href="../'.$row["id"].'/'.$row["attachment"].'" target="_blank" >View</a></label>
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

                    $sql = "SELECT * FROM IP WHERE id='".$id."'";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            if($row["locked"]==1){
                                echo ' <tr>

                                    <td>'.$i.'</td>
                                    <td>'.$name.'</td>
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
                                    <button type="submit" name="comment" id="commentBtn" value="'.$row["name"].'_name_IP_'.$row["id"].'" class="btn btn-outline-dark btn-sm">POST</button>
                                    </div>
                                    </div>
                                    </td>
                                    <td>
                                    <div class="row">
                                    <div class="col-auto"><button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#IP'.$row["name"].''.$row["id"].'">VIEW</button></div>
                                    ';
                                    if($row["verify"]==1){
                                        echo'<div class="col-auto"><button type="submit" name="v1" value="'.$row["name"].'_name_IP" class="btn btn-success btn-sm" disabled>VERIFIED</button></div>';
                                    }
                                    else{
                                        echo'<div class="col-auto"><button type="submit" name="verify" value="'.$row["name"].'_name_IP_'.$row["id"].'" class="btn btn-success btn-sm">VERIFY</button></div>';
                                    }
                                    echo'<div class="col-auto"><button type="submit" name="reject" value="'.$row["name"].'_name_IP_'.$row["id"].'" class="btn btn-danger btn-sm">REJECT</button></div>                              
                                    </div>
                                    </td>
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
                                        <hr>
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
                                            <a href="../'.$row["id"].'/'.$row["attachment"].'" target="_blank" >View</a></label>
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

                    $sql = "SELECT * FROM CTS WHERE id='".$id."'";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        
                        while($row = mysqli_fetch_assoc($result)) {
                            if($row["locked"]==1){
                                echo ' <tr>
                                    <td>'.$i.'</td>
                                    <td>'.$name.'</td>
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
                                    <button type="submit" name="comment" id="commentBtn" value="'.$row["date"].'_date_CTS_'.$row["id"].'" class="btn btn-outline-dark btn-sm">POST</button>
                                    </div>
                                    </div>
                                    </td>
                                    <td>
                                    <div class="row">
                                    <div class="col-auto"><button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#CTS'.$row["date"].''.$row["id"].'">VIEW</button></div>
                                    ';
                                    if($row["verify"]==1){
                                        echo'<div class="col-auto"><button type="submit" name="v1" value="'.$row["date"].'_date_CTS" class="btn btn-success btn-sm" disabled>VERIFIED</button></div>';
                                    }
                                    else{
                                        echo'<div class="col-auto"><button type="submit" name="verify" value="'.$row["date"].'_date_CTS_'.$row["id"].'" class="btn btn-success btn-sm">VERIFY</button></div>';
                                    }
                                    echo'<div class="col-auto"><button type="submit" name="reject" value="'.$row["date"].'_date_CTS_'.$row["id"].'" class="btn btn-danger btn-sm">REJECT</button></div>                              
                                    </div>
                                    </td>
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
                                        <hr>
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
                                            <a href="../'.$row["id"].'/'.$row["attachment"].'" target="_blank" >View</a></label>
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

                    $sql = "SELECT * FROM RAA1 WHERE id='".$id."'";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        
                        while($row = mysqli_fetch_assoc($result)) {
                            if($row["locked"]==1){
                                echo ' <tr>
                                    <td>'.$i.'</td>
                                    <td>'.$name.'</td>
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
                                    <button type="submit" name="comment" id="commentBtn" value="'.$row["date"].'_date_RAA1_'.$row["id"].'" class="btn btn-outline-dark btn-sm">POST</button>
                                    </div>
                                    </div>
                                    </td>
                                    <td>
                                    <div class="row">
                                    <div class="col-auto"><button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#RAA1'.$row["date"].''.$row["id"].'">VIEW</button></div>
                                    ';
                                    if($row["verify"]==1){
                                        echo'<div class="col-auto"><button type="submit" name="v1" value="'.$row["date"].'_date_RAA1" class="btn btn-success btn-sm" disabled>VERIFIED</button></div>';
                                    }
                                    else{
                                        echo'<div class="col-auto"><button type="submit" name="verify" value="'.$row["date"].'_date_RAA1_'.$row["id"].'" class="btn btn-success btn-sm">VERIFY</button></div>';
                                    }
                                    echo'<div class="col-auto"><button type="submit" name="reject" value="'.$row["date"].'_date_RAA1_'.$row["id"].'" class="btn btn-danger btn-sm">REJECT</button></div>                              
                                    </div>
                                    </td>
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
                                        <hr>
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
                                            <a href="../'.$row["id"].'/'.$row["attachment"].'" target="_blank" >View</a></label>
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

                    $sql = "SELECT * FROM RAA2 WHERE id='".$id."'";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        
                        while($row = mysqli_fetch_assoc($result)) {
                            if($row["locked"]==1){
                                echo ' <tr>
                                <td>'.$i.'</td>
                                <td>'.$name.'</td>
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
                                <button type="submit" name="comment" id="commentBtn" value="'.$row["date"].'_date_RAA2_'.$row["id"].'" class="btn btn-outline-dark btn-sm">POST</button>
                                </div>
                                </div>
                                </td>
                                <td>
                                <div class="row">
                                <div class="col-auto"><button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#RAA2'.$row["date"].''.$row["id"].'">VIEW</button></div>
                                ';
                                if($row["verify"]==1){
                                    echo'<div class="col-auto"><button type="submit" name="v1" value="'.$row["date"].'_date_RAA2" class="btn btn-success btn-sm" disabled>VERIFIED</button></div>';
                                }
                                else{
                                    echo'<div class="col-auto"><button type="submit" name="verify" value="'.$row["date"].'_date_RAA2_'.$row["id"].'" class="btn btn-success btn-sm">VERIFY</button></div>';
                                }
                                echo'<div class="col-auto"><button type="submit" name="reject" value="'.$row["date"].'_date_RAA2_'.$row["id"].'" class="btn btn-danger btn-sm">REJECT</button></div>                              
                                </div>
                                </td>
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
                                        <hr>
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
                                            <a href="../'.$row["id"].'/'.$row["attachment"].'" target="_blank" >View</a></label>
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

                    $sql = "SELECT * FROM RAA3 WHERE id='".$id."'";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        
                        while($row = mysqli_fetch_assoc($result)) {
                            if($row["locked"]==1){
                                echo ' <tr>
                                <td>'.$i.'</td>
                                <td>'.$name.'</td>
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
                                <button type="submit" name="comment" id="commentBtn" value="'.$row["date"].'_date_RAA3_'.$row["id"].'" class="btn btn-outline-dark btn-sm">POST</button>
                                </div>
                                </div>
                                </td>
                                <td>
                                <div class="row">
                                <div class="col-auto"><button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#RAA3'.$row["date"].''.$row["id"].'">VIEW</button></div>
                                ';
                                if($row["verify"]==1){
                                    echo'<div class="col-auto"><button type="submit" name="v1" value="'.$row["date"].'_date_RAA3" class="btn btn-success btn-sm" disabled>VERIFIED</button></div>';
                                }
                                else{
                                    echo'<div class="col-auto"><button type="submit" name="verify" value="'.$row["date"].'_date_RAA3_'.$row["id"].'" class="btn btn-success btn-sm">VERIFY</button></div>';
                                }
                                echo'  <div class="col-auto"><button type="submit" name="reject" value="'.$row["date"].'_date_RAA3_'.$row["id"].'" class="btn btn-danger btn-sm">REJECT</button></div>                                
                                </div>
                                </td>    
                                
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
                                        <hr>
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
                                            <a href="../'.$row["id"].'/'.$row["attachment"].'" target="_blank" >View</a></label>
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

                    $sql = "SELECT * FROM RAA4 WHERE id='".$id."'";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        
                        while($row = mysqli_fetch_assoc($result)) {
                            if($row["locked"]==1){
                                echo ' <tr>
                                <td>'.$i.'</td>
                                <td>'.$name.'</td>
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
                                <button type="submit" name="comment" id="commentBtn" value="'.$row["date"].'_date_RAA4_'.$row["id"].'" class="btn btn-outline-dark btn-sm">POST</button>
                                </div>
                                </div>
                                </td>
                                <td>
                                <div class="row">
                                <div class="col-auto"><button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#RAA4'.$row["date"].''.$row["id"].'">VIEW</button></div>
                                ';
                                if($row["verify"]==1){
                                    echo'<div class="col-auto"><button type="submit" name="v1" value="'.$row["date"].'_date_RAA4" class="btn btn-success btn-sm" disabled>VERIFIED</button></div>';
                                }
                                else{
                                    echo'<div class="col-auto"><button type="submit" name="verify" value="'.$row["date"].'_date_RAA4_'.$row["id"].'" class="btn btn-success btn-sm">VERIFY</button></div>';
                                }
                                echo'<div class="col-auto"><button type="submit" name="reject" value="'.$row["date"].'_date_RAA4_'.$row["id"].'" class="btn btn-danger btn-sm">REJECT</button></div>                              
                                </div>
                                </td>
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
                                        <hr>
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
                                            <a href="../'.$row["id"].'/'.$row["attachment"].'" target="_blank" >View</a></label>
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

                    $sql = "SELECT * FROM RAA5 WHERE id='".$id."'";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        
                        while($row = mysqli_fetch_assoc($result)) {
                            if($row["locked"]==1){
                                echo ' <tr>
                                <td>'.$i.'</td>
                                <td>'.$name.'</td>
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
                                <button type="submit" name="comment" id="commentBtn" value="'.$row["name"].'_name_RAA5_'.$row["id"].'" class="btn btn-outline-dark btn-sm">POST</button>
                                </div>
                                </div>
                                </td>
                                <td>
                                <div class="row">
                                <div class="col-auto"><button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#RAA5'.$row["name"].''.$row["id"].'">VIEW</button></div>
                                ';
                                if($row["verify"]==1){
                                    echo'<div class="col-auto"><button type="submit" name="v1" value="'.$row["name"].'_name_RAA5" class="btn btn-success btn-sm" disabled>VERIFIED</button></div>';
                                }
                                else{
                                    echo'<div class="col-auto"><button type="submit" name="verify" value="'.$row["name"].'_name_RAA5_'.$row["id"].'" class="btn btn-success btn-sm">VERIFY</button></div>';
                                }
                                echo'<div class="col-auto"><button type="submit" name="reject" value="'.$row["name"].'_name_RAA5_'.$row["id"].'" class="btn btn-danger btn-sm">REJECT</button></div>                              
                                </div>
                                </td>
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
                                        <hr>
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
                                            <a href="../'.$row["id"].'/'.$row["attachment"].'" target="_blank" >View</a></label>
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

                    $sql = "SELECT * FROM RAA6 WHERE id='".$id."'";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        
                        while($row = mysqli_fetch_assoc($result)) {
                            if($row["locked"]==1){
                                echo ' <tr>
                                <td>'.$i.'</td>
                                <td>'.$name.'</td>
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
                                <button type="submit" name="comment" id="commentBtn" value="'.$row["name"].'_name_RAA6_'.$row["id"].'" class="btn btn-outline-dark btn-sm">POST</button>
                                </div>
                                </div>
                                </td>
                                <td>
                                <div class="row">
                                <div class="col-auto"><button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#RAA6'.$row["name"].''.$row["id"].'">VIEW</button></div>
                                ';
                                if($row["verify"]==1){
                                    echo'<div class="col-auto"><button type="submit" name="v1" value="'.$row["name"].'_name_RAA6" class="btn btn-success btn-sm" disabled>VERIFIED</button></div>';
                                }
                                else{
                                    echo'<div class="col-auto"><button type="submit" name="verify" value="'.$row["name"].'_name_RAA6_'.$row["id"].'" class="btn btn-success btn-sm">VERIFY</button></div>';
                                }
                                echo'<div class="col-auto"><button type="submit" name="reject" value="'.$row["name"].'_name_RAA6_'.$row["id"].'" class="btn btn-danger btn-sm">REJECT</button></div>                              
                                </div>
                                </td>
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
                                        <hr>
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
                                            <a href="../'.$row["id"].'/'.$row["attachment"].'" target="_blank" >View</a></label>
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

                    $sql = "SELECT * FROM RAA7 WHERE id='".$id."'";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        
                        while($row = mysqli_fetch_assoc($result)) {
                            if($row["locked"]==1){
                                echo ' <tr>
                                <td>'.$i.'</td>
                                <td>'.$name.'</td>
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
                                <button type="submit" name="comment" id="commentBtn" value="'.$row["title"].'_title_RAA7_'.$row["id"].'" class="btn btn-outline-dark btn-sm">POST</button>
                                </div>
                                </div>
                                </td>
                                <td>
                                <div class="row">
                                <div class="col-auto"><button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#RAA7'.$row["title"].''.$row["id"].'">VIEW</button></div>
                                ';
                                if($row["verify"]==1){
                                    echo'<div class="col-auto"><button type="submit" name="v1" value="'.$row["title"].'_title_RAA7" class="btn btn-success btn-sm" disabled>VERIFIED</button></div>';
                                }
                                else{
                                    echo'<div class="col-auto"><button type="submit" name="verify" value="'.$row["title"].'_title_RAA7_'.$row["id"].'" class="btn btn-success btn-sm">VERIFY</button></div>';
                                }
                                echo'<div class="col-auto"><button type="submit" name="reject" value="'.$row["title"].'_title_RAA7_'.$row["id"].'" class="btn btn-danger btn-sm">REJECT</button></div>                              
                                </div>
                                </td>
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
                                        <hr>
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
                                            <a href="../'.$row["id"].'/'.$row["attachment"].'" target="_blank" >View</a></label>
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

                    $sql = "SELECT * FROM RAA8 WHERE id='".$id."'";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        
                        while($row = mysqli_fetch_assoc($result)) {
                            if($row["locked"]==1){
                                echo ' <tr>
                                <td>'.$i.'</td>
                                <td>'.$name.'</td>
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
                                <button type="submit" name="comment" id="commentBtn" value="'.$row["subject"].'_subject_RAA8_'.$row["id"].'" class="btn btn-outline-dark btn-sm">POST</button>
                                </div>
                                </div>
                                </td>
                                <td>
                                <div class="row">
                                <div class="col-auto"><button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#RAA8'.$row["subject"].''.$row["id"].'">VIEW</button></div>
                                ';
                                if($row["verify"]==1){
                                    echo'<div class="col-auto"><button type="submit" name="v1" value="'.$row["subject"].'_subject_RAA8" class="btn btn-success btn-sm" disabled>VERIFIED</button></div>';
                                }
                                else{
                                    echo'<div class="col-auto"><button type="submit" name="verify" value="'.$row["subject"].'_subject_RAA8_'.$row["id"].'" class="btn btn-success btn-sm">VERIFY</button></div>';
                                }
                                echo'<div class="col-auto"><button type="submit" name="reject" value="'.$row["subject"].'_subject_RAA8_'.$row["id"].'" class="btn btn-danger btn-sm">REJECT</button></div>                              
                                </div>
                                </td>
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
                                        <hr>
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
                                            <a href="../'.$row["id"].'/'.$row["attachment"].'" target="_blank" >View</a></label>
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

                    $sql = "SELECT * FROM RAA9 WHERE id='".$id."'";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        
                        while($row = mysqli_fetch_assoc($result)) {
                            if($row["locked"]==1){
                                echo ' <tr>
                                <td>'.$i.'</td>
                                    <td>'.$name.'</td>
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
                                    <button type="submit" name="comment" id="commentBtn" value="'.$row["name"].'_name_RAA9_'.$row["id"].'" class="btn btn-outline-dark btn-sm">POST</button>
                                    </div>
                                    </div>
                                    </td>
                                    <td>
                                    <div class="row">
                                    <div class="col-auto"><button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#RAA9'.$row["name"].''.$row["id"].'">VIEW</button></div>
                                    ';
                                    if($row["verify"]==1){
                                        echo'<div class="col-auto"><button type="submit" name="v1" value="'.$row["name"].'_name_RAA9" class="btn btn-success btn-sm" disabled>VERIFIED</button></div>';
                                    }
                                    else{
                                        echo'<div class="col-auto"><button type="submit" name="verify" value="'.$row["name"].'_name_RAA9_'.$row["id"].'" class="btn btn-success btn-sm">VERIFY</button></div>';
                                    }
                                    echo'<div class="col-auto"><button type="submit" name="reject" value="'.$row["name"].'_name_RAA9_'.$row["id"].'" class="btn btn-danger btn-sm">REJECT</button></div>                              
                                    </div>
                                    </td>
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
                                        <hr>
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
                                            <a href="../'.$row["id"].'/'.$row["attachment"].'" target="_blank" >View</a></label>
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

                    $sql = "SELECT * FROM RAA10 WHERE id='".$id."'";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        
                        while($row = mysqli_fetch_assoc($result)) {
                            if($row["locked"]==1){
                                echo ' <tr>
                                <td>'.$i.'</td>
                                <td>'.$name.'</td>
                                <td>RAA10</td>
                                <td>'.$row['enrollment'].'</td>
                                <td>'.$row['point'].'</td>
                                <td>
                                <div class="row">
                                <div class="col-auto">
                                <input type="text" class="form-control col-4" id="commentdata" name="commentdata'.$row["enrollment"].''.$row["id"].'RAA10"  placeholder="Type comment.." value="'.$row["comment"].'" style="padding-y: 0.25rem;padding-x: 0.5rem;font-size: 0.875rem;border-radius: 0.25rem;">
                                <!--<input type="hidden" name="c_id" value="'.$row["id"].'"/>-->
                                </div>
                                <div class="col-auto">
                                <button type="submit" name="comment" id="commentBtn" value="'.$row["enrollment"].'_enrollment_RAA10_'.$row["id"].'" class="btn btn-outline-dark btn-sm">POST</button>
                                </div>
                                </div>
                                </td>
                                <td>
                                <div class="row">
                                <div class="col-auto"><button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#RAA10'.$row["enrollment"].''.$row["id"].'">VIEW</button></div>
                                ';
                                if($row["verify"]==1){
                                    echo'<div class="col-auto"><button type="submit" name="v1" value="'.$row["enrollment"].'_enrollment_RAA10" class="btn btn-success btn-sm" disabled>VERIFIED</button></div>';
                                }
                                else{
                                    echo'<div class="col-auto"><button type="submit" name="verify" value="'.$row["enrollment"].'_enrollment_RAA10_'.$row["id"].'" class="btn btn-success btn-sm">VERIFY</button></div>';
                                }
                                echo'<div class="col-auto"><button type="submit" name="reject" value="'.$row["enrollment"].'_enrollment_RAA10_'.$row["id"].'" class="btn btn-danger btn-sm">REJECT</button></div>                              
                                </div>
                                </td>
                                </tr>
                                <!-- Modal -->
                                <div class="modal fade" id="RAA10'.$row["enrollment"].''.$row["id"].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-dark" id="exampleModalCenterTitle">Edit Details</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </button>
                                        </button>
                                    </div>
                                    <div class="modal-body mt-0 pt-0">
                                        <hr>
                                        <div class="form-group p-2">
                                            <label for="subN">Enrollment</label>
                                            <input type="text" class="form-control" id="subCode" name="subCode" value="'.$row["enrollment"].'" readonly>
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
                                            <a href="../'.$row["id"].'/'.$row["attachment"].'" target="_blank" >View</a></label>
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

                    $sql = "SELECT * FROM INV WHERE id='".$id."'";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        
                        while($row = mysqli_fetch_assoc($result)) {
                            if($row["locked"]==1){
                                echo ' <tr>
                                    <td>'.$i.'</td>
                                    <td>'.$name.'</td>
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
                                    <button type="submit" name="comment" id="commentBtn" value="'.$row["date"].'_date_INV_'.$row["id"].'" class="btn btn-outline-dark btn-sm">POST</button>
                                    </div>
                                    </div>
                                    </td>
                                    <td>
                                    <div class="row">
                                    <div class="col-auto"><button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#INV'.$row["date"].''.$row["id"].'">VIEW</button></div>
                                    ';
                                    if($row["verify"]==1){
                                        echo'<div class="col-auto"><button type="submit" name="v1" value="'.$row["date"].'_date_INV" class="btn btn-success btn-sm" disabled>VERIFIED</button></div>';
                                    }
                                    else{
                                        echo'<div class="col-auto"><button type="submit" name="verify" value="'.$row["date"].'_date_INV_'.$row["id"].'" class="btn btn-success btn-sm">VERIFY</button></div>';
                                    }
                                    echo'<div class="col-auto"><button type="submit" name="reject" value="'.$row["date"].'_date_INV_'.$row["id"].'" class="btn btn-danger btn-sm">REJECT</button></div>                              
                                    </div>
                                    </td>
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
                                        <hr>
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
                                            <a href="../'.$row["id"].'/'.$row["attachment"].'" target="_blank" >View</a></label>
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

                    $sql = "SELECT * FROM AO WHERE id='".$id."'";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        
                        while($row = mysqli_fetch_assoc($result)) {
                            if($row["locked"]==1){
                                echo ' <tr>
                                    <td>'.$i.'</td>
                                    <td>'.$name.'</td>
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
                                    <button type="submit" name="comment" id="commentBtn" value="'.$row["title"].'_title_AO_'.$row["id"].'" class="btn btn-outline-dark btn-sm">POST</button>
                                    </div>
                                    </div>
                                    </td>
                                    <td>
                                    <div class="row">
                                    <div class="col-auto"><button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#AO'.$row["title"].''.$row["id"].'">VIEW</button></div>
                                    ';
                                    if($row["verify"]==1){
                                        echo'<div class="col-auto"><button type="submit" name="v1" value="'.$row["title"].'_title_AO" class="btn btn-success btn-sm" disabled>VERIFIED</button></div>';
                                    }
                                    else{
                                        echo'<div class="col-auto"><button type="submit" name="verify" value="'.$row["title"].'_title_AO_'.$row["id"].'" class="btn btn-success btn-sm">VERIFY</button></div>';
                                    }
                                    echo'<div class="col-auto"><button type="submit" name="reject" value="'.$row["title"].'_title_AO_'.$row["id"].'" class="btn btn-danger btn-sm">REJECT</button></div>                              
                                    </div>
                                    </td>
                                </tr>
                                <!-- Modal -->
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
                                        <hr>
                                        <div class="form-group p-2">
                                            <label for="subC">Title</label>
                                            <input type="text" class="form-control" value="'.$row["title"].'" id="title" name="title" readonly>
                                        </div>
                                        <div class="form-group p-2">
                                            <label for="attach">Attachment &nbsp; 
                                            <a href="../'.$row["id"].'/'.$row["attachment"].'" target="_blank" >View</a></label>
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

                echo'
                
                </tbody>
                </table>
                </form>
            </div>
        </div>
        <button id="mybtn2" type="button" class="btn btn-sm btn-secondary position-fixed" style="bottom:30px;left:30px;"><i class="fa fa-info-circle" id="info"></i></button>
    </div>
    <script>            
    const alertBox = document.getElementById("alertinner")
    const handleAlerts = (type, text) =>{
    alertBox.innerHTML = `
    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
    <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
    </symbol>
    </svg>
    <div class="alert alert-${type} alert-dismissible fade show" role="alert" id="alertTry">
    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
    ${text}
    <button type="button" id="alertCLose" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>`   
    }

    
$("button:contains(\'VIEW\')").each(function(){
    $(this).attr("data-bs-target",$(this).attr("data-bs-target").replace(/[@.$%&^]/g,\'-\').replace(/\s+/g,\'-\'));
})

$(".modal").each(function(){
    $(this).attr("id",$(this).attr("id").replace(/[@.$%&^]/g,\'-\').replace(/\s+/g,\'-\'));
})
$("#table22").find("tr").find("#commentdata").each(function(){
    $(this).attr("name",$(this).attr("name").replace(/[@.$%&^]/g,\'-\').replace(/\s+/g,\'-\'));
})
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
</html>

";

//alert
if(isset($_SESSION["success"]) and $_SESSION["success"]!=""){
    echo'
    <script>            
    handleAlerts("success", "'.$_SESSION["success"].'")
    setTimeout(function(){
        $("#alertCLose").trigger("click");
        ';
        $_SESSION['success'] = "";
        echo'
    }, 5000);
    </script>
    ';
}
//alert
if(isset($_SESSION["danger"]) and $_SESSION["danger"]!=""){
    echo'
    <script>            
    handleAlerts("danger", "'.$_SESSION["danger"].'")
    setTimeout(function(){
        $("#alertCLose").trigger("click");
        ';
        $_SESSION['danger'] = "";
        echo'
    }, 5000);
    </script>
    ';
}


if(isset($_POST["comment"])){
    // $cid=$_POST["c_id"];
    // echo $cid;
    // echo "<hr>";
    // echo $cdata;
    $str=$_POST["comment"];
    $arr = preg_split("/[_]+/", $str);
    if(count($arr)==4){
        $element=$arr[0];
        $elementField=$arr[1];
        $tt=$arr[2];
        $cid=$arr[3];
        $abc="commentdata$element$id$tt";
        $abc= str_replace('@','-',$abc);
        $abc= str_replace('.','-',$abc);
        $abc= str_replace('$','-',$abc);
        $abc= str_replace('%','-',$abc);
        $abc= str_replace('&','-',$abc);
        $abc= str_replace('^','-',$abc);
        $abc= str_replace(' ','-',$abc);
        $cdata=$_POST[$abc];
        $sql = "UPDATE $tt SET comment='$cdata'  WHERE id='$cid' AND $elementField='$element'" ;
        if ($conn->query($sql) === TRUE) {
            $_SESSION["success"]=$cid.' Entry Updated Successfully';
            echo "<script>location.href = 'home.php';</script>";
        } else {
            $_SESSION["danger"]=$cid.'Entry Not Updated Successfully';
            echo "<script>location.href = 'home.php';</script>";
        }
    }
    elseif(count($arr)==2){
        $tt=$arr[0];
        $cid=$arr[1];
        $abc="commentdata$cid$tt";
        $cdata=$_POST[$abc];
        $sql = "UPDATE $tt SET comment='$cdata'  WHERE id='$cid'";
    
        if ($conn->query($sql) === TRUE) {
            $_SESSION["success"]=$cid.' Entry Updated Successfully';
            echo "<script>location.href = 'home.php';</script>";
        } else {
            $_SESSION["danger"]=$cid.'Entry Not Updated Successfully';
            echo "<script>location.href = 'home.php';</script>";
            //echo "Error updating record: " . $conn->error;
        }
    }
}

if(isset($_POST["verify"])){
    $str=$_POST["verify"];
    $arr = preg_split("/[_]+/", $str);
    if(count($arr)==4){
        $element=$arr[0];
        $elementField=$arr[1];
        $tt=$arr[2];
        $cid=$arr[3];
        $sql = "UPDATE $tt SET verify=1,vid='$a' WHERE id='$cid' AND $elementField='$element'" ;
        if ($conn->query($sql) === TRUE) {
            $_SESSION["success"]=$cid.' Verified Successfully';
            echo "<script>location.href = 'home.php'; </script>";
        } else {
            $_SESSION["danger"]=$cid.' Not Verified Successfully';
            echo "<script>location.href = 'home.php';</script>";
            //echo "Error updating record: " . $conn->error;
        }
    }
    elseif(count($arr)==2){
        $tt=$arr[0];
        $cid=$arr[1];
        $sql = "UPDATE $tt SET verify=1,vid='$a' WHERE id='$cid'" ;
        if ($conn->query($sql) === TRUE) {
            $_SESSION["success"]=$cid.' Verified Successfully';
            echo "<script>location.href = 'home.php'; </script>";
        } else {
            $_SESSION["danger"]=$cid.' Not Verified Successfully';
            echo "<script>location.href = 'home.php';</script>";
            //echo "Error updating record: " . $conn->error;
        }
    }
}

if(isset($_POST["reject"])){
    $str=$_POST["reject"];
    $arr = preg_split("/[_]+/", $str);
    if(count($arr)==4){
        $element=$arr[0];
        $elementField=$arr[1];
        $tt=$arr[2];
        $cid=$arr[3];
        $sql = "UPDATE $tt SET verify=0,vid='',locked=0 WHERE id='$cid' AND $elementField='$element'" ;
        if ($conn->query($sql) === TRUE) {
            $_SESSION["success"]=$cid.' Rejected Successfully';
            echo "<script>location.href = 'home.php'; </script>";
        } else {
            $_SESSION["danger"]=$cid.' Not Rejected Successfully';
            echo "<script>location.href = 'home.php';</script>";
            //echo "Error updating record: " . $conn->error;
        }
    }
    elseif(count($arr)==2){
        $tt=$arr[0];
        $cid=$arr[1];
        $sql = "UPDATE $tt SET verify=0,vid='',locked=0 WHERE id='$cid'" ;
        if ($conn->query($sql) === TRUE) {
            $_SESSION["success"]=$cid.' Rejected Successfully';
            echo "<script>location.href = 'home.php'; </script>";
        } else {
            $_SESSION["danger"]=$cid.' Not Rejected Successfully';
            echo "<script>location.href = 'home.php';</script>";
            //echo "Error updating record: " . $conn->error;
        }
    }
}



?>

