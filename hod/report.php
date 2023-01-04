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
// $id=$_GET['id'];

// if(isset($_GET['id'])){
//     $_GET['id']='';
// }
// else{
//     echo'<script>history.back()</script>';
// }


// echo var_dump($totalF);

echo '

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>HOD</title>
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
<style>
.imgcl {display: flex;justify-content: center;}
</style>
</head>
<body>
    <div class="container">
    <div class="d-flex justify-content-center"> <img src="../assets/img/GU-Logo-Report.png" height="70" /> </div>
    <h6 class="d-flex justify-content-center">Gandhinagar Institute Of Technology</h6>
    <a href="profile.php">Profile</a>&nbsp;<a href="home.php">Home</a><a class="ms-3 float-end" href="../logout.php">Logout</a><hr>
        <div id="alertinner">
        
        </div>
        <div class="row p-2">
            <div class="col-lg m-2 p-2 shadow p-3 mb-1 bg-body rounded border border border-light">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Faculty List</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
            ';
                $i=1;
                foreach($totalF as $name => $id) {
                   echo' <tr>
                        <td>'.$i.'</td>
                        <td>'.$id.'</td>                    
                        <td><button type="button" onclick="download(\''.$id.'\')" class="btn btn-primary">Download Report</button></td>                    
                    </tr>';
                    $i=$i+1;
                }
                echo'
                </tbody>
                </table>
            </div>
            ';
            $i=1;
            // style="display:None;"
            foreach($totalF as $name => $id) {
                $fpoint = 0;
                echo'
            <div class="col-lg m-2 p-2 shadow p-3 mb-1 bg-body rounded border border border-light" id="pdf'.$id.'" style="display: none;">
            
            
            ';
                    $sql = "SELECT * FROM Profile WHERE id='".$id."'";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        echo '<div class="imgcl"> <img src="../assets/img/GU-Logo-Report.png" width="250" height="150" /> </div>
                        <h6 class="imgcl">Gandhinagar Institute Of Technology</h6>
                        <h5 class="imgcl">'.$row['name'].'</h5>';
                    }
                    }
                echo'

                <table class="table table-hover">
                    <thead>
                    <tr><th scope="col" colspan="9" class="text-center"><h5>Teaching Learning Process (50)</h5></th></tr>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Semester</th>
                        <th scope="col">Subject Code</th>
                        <th scope="col">Subject Name</th>
                        <th scope="col">No of Scheduled Classes</th>
                        <th scope="col">No of Actually Classes</th>
                        <th scope="col">Points</th>
                        <th scope="col">Verified Name</th>
                        <th scope="col">Verified ID</th>
                    </tr>
                    </thead>
                    <tbody>
                    ';
                    $i=1;$point=0;
                    $sql = "SELECT * FROM TLP WHERE id='".$id."'";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            if($row["verify"]==1){
                                echo'    
                                <tr>
                                    <td>'.$i.'</td>
                                    <td>'.$row['sem'].'</td>
                                    <td>'.$row['subject'].'</td>
                                    <td>'.$row['name'].'</td>
                                    <td>'.$row['scheduleClass'].'</td>
                                    <td>'.$row['actualClass'].'</td>
                                    <td>'.$row['point'].'</td>
                                    ';
                                $sql2 = "SELECT * FROM Profile WHERE id='".$row['vid']."'";
                                $result2 = mysqli_query($conn, $sql2);
                                if (mysqli_num_rows($result2) > 0) {
                                    while($row2 = mysqli_fetch_assoc($result2)) {
                                        echo'<td>'.$row2['name'].'</td>';
                                    }
                                }
                                echo'
                                    <td>'.$row['vid'].'</td>
                                </tr>
                                ';
                                $i=$i+1;
                                $point=$point+$row['point'];
                            }
                        }
                        
                    }
                    $epoint=$point;
                    if($i==1){echo'<tr><td colspan="9" class="text-center">NO ENTRY</td></tr>';}
                    if($point>50){$point=50;}
                    $fpoint=$fpoint+$point;
                    echo'
                    <tr><td colspan="9" class="text-center"><i>Earned Point : '.$epoint.'</i> | <i>Considered Point : '.$point.'</i></td></tr>
                    <tr></tr>
                    </tbody>
                </table>

                <table class="table table-hover mt-5">
                    <thead>
                    <tr><th scope="col" colspan="10" class="text-center"><h5>GTU Result (100)</h5></th></tr>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Semester</th>
                        <th scope="col">Subject Code</th>
                        <th scope="col">Subject Name</th>
                        <th scope="col">Year</th>
                        <th scope="col">Result Of Institute</th>
                        <th scope="col">Result Of GTU</th>
                        <th scope="col">Points</th>
                        <th scope="col">Verified Name</th>
                        <th scope="col">Verified ID</th>
                    </tr>
                    </thead>
                    <tbody>
                    ';
                    $i=1;$point=0;
                    $sql = "SELECT * FROM GR WHERE id='".$id."'";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            if($row["verify"]==1){
                                echo'    
                                <tr>
                                    <td>'.$i.'</td>
                                    <td>'.$row['sem'].'</td>
                                    <td>'.$row['subject'].'</td>
                                    <td>'.$row['subjectName'].'</td>
                                    <td>'.$row['year'].'</td>
                                    <td>'.$row['resultInstitute'].'</td>
                                    <td>'.$row['resultGtu'].'</td>
                                    <td>'.$row['point'].'</td>
                                ';
                                $sql2 = "SELECT * FROM Profile WHERE id='".$row['vid']."'";
                                $result2 = mysqli_query($conn, $sql2);
                                if (mysqli_num_rows($result2) > 0) {
                                    while($row2 = mysqli_fetch_assoc($result2)) {
                                        echo'<td>'.$row2['name'].'</td>';
                                    }
                                }
                                echo'
                                    <td>'.$row['vid'].'</td>
                                </tr>
                                ';
                                $i=$i+1;
                                $point=$point+$row['point'];
                            }
                        }
                        
                    }
                    $epoint=$point;
                    if($i==1){echo'<tr><td colspan="10" class="text-center fw-light">NO ENTRY</td></tr>';}
                    if($point>100){$point=100;}
                    $fpoint=$fpoint+$point;
                    echo'
                    <tr><td colspan="10" class="text-center"><i>Earned Point : '.$epoint.'</i> | <i>Considered Point : '.$point.'</i></td></tr>
                    <tr></tr>
                    </tbody>
                </table>

                <table class="table table-hover mt-5">
                    <thead>
                    <tr><th scope="col" colspan="9" class="text-center"><h5>Discipline (40)</h5></th></tr>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Late Punch</th>
                        <th scope="col">Leave Without Pay</th>
                        <th scope="col">Balanced CL, Vacation Leave</th>
                        <th scope="col">Memo Justification</th>
                        <th scope="col">Fine</th>
                        <th scope="col">Points</th>
                        <th scope="col">Verified Name</th>
                        <th scope="col">Verified ID</th>
                    </tr>
                    </thead>
                    <tbody>
                    ';
                    $i=1;$point=0;
                    $sql = "SELECT * FROM DISC WHERE id='".$id."'";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            if($row["verify"]==1){
                                echo'    
                                <tr>
                                    <td>'.$i.'</td>
                                    <td>'.$row['TLP'].'</td>
                                    <td>'.$row['LWP'].'</td>
                                    <td>'.$row['BL'].'</td>
                                    <td>'.$row['MJC'].'</td>
                                    <td>'.$row['F'].'</td>
                                    <td>'.$row['point'].'</td>
                                    ';
                                $sql2 = "SELECT * FROM Profile WHERE id='".$row['vid']."'";
                                $result2 = mysqli_query($conn, $sql2);
                                if (mysqli_num_rows($result2) > 0) {
                                    while($row2 = mysqli_fetch_assoc($result2)) {
                                        echo'<td>'.$row2['name'].'</td>';
                                    }
                                }
                                echo'
                                    <td>'.$row['vid'].'</td>
                                </tr>
                                ';
                                $i=$i+1;
                                $point=$point+$row['point'];
                            }
                        }
                        
                    }
                    $epoint=$point;
                    if($i==1){echo'<tr><td colspan="9" class="text-center fw-light">NO ENTRY</td></tr>';}
                    if($point>40){$point=40;}
                    $fpoint=$fpoint+$point;
                    echo'
                    <tr><td colspan="9" class="text-center"><i>Earned Point : '.$epoint.'</i> | <i>Considered Point : '.$point.'</i></td></tr>
                    <tr></tr>
                    </tbody>
                </table>

                <table class="table table-hover mt-5">
                    <thead>
                    <tr><th scope="col" colspan="7" class="text-center"><h5>Department Portfolio (20)</h5></th></tr>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Portfolio Name</th>
                        <th scope="col">Role</th>
                        <th scope="col">Duration</th>
                        <th scope="col">Points</th>
                        <th scope="col">Verified Name</th>
                        <th scope="col">Verified ID</th>
                    </tr>
                    </thead>
                    <tbody>
                    ';
                    $i=1;$point=0;
                    $sql = "SELECT * FROM DP WHERE id='".$id."'";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            if($row["verify"]==1){
                                echo'    
                                <tr>
                                    <td>'.$i.'</td>
                                    <td>'.$row['name'].'</td>
                                    <td>'.$row['role'].'</td>
                                    <td>'.$row['duration'].'</td>
                                    <td>'.$row['point'].'</td>
                                    ';
                                $sql2 = "SELECT * FROM Profile WHERE id='".$row['vid']."'";
                                $result2 = mysqli_query($conn, $sql2);
                                if (mysqli_num_rows($result2) > 0) {
                                    while($row2 = mysqli_fetch_assoc($result2)) {
                                        echo'<td>'.$row2['name'].'</td>';
                                    }
                                }
                                echo'
                                    <td>'.$row['vid'].'</td>
                                </tr>
                                ';
                                $i=$i+1;
                                $point=$point+$row['point'];
                            }
                        }
                        
                    }
                    $epoint=$point;
                    if($i==1){echo'<tr><td colspan="7" class="text-center fw-light">NO ENTRY</td></tr>';}
                    if($point>20){$point=20;}
                    $fpoint=$fpoint+$point;
                    echo'
                    <tr><td colspan="7" class="text-center"><i>Earned Point : '.$epoint.'</i> | <i>Considered Point : '.$point.'</i></td></tr>
                    <tr></tr>
                    </tbody>
                </table>

                <table class="table table-hover mt-5">
                    <thead>
                    <tr><th scope="col" colspan="7" class="text-center"><h5>Institute Portfolio (20)</h5></th></tr>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Portfolio Name</th>
                        <th scope="col">Role</th>
                        <th scope="col">Duration</th>
                        <th scope="col">Points</th>
                        <th scope="col">Verified Name</th>
                        <th scope="col">Verified ID</th>
                    </tr>
                    </thead>
                    <tbody>
                    ';
                    $i=1;$point=0;
                    $sql = "SELECT * FROM IP WHERE id='".$id."'";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            if($row["verify"]==1){
                                echo'    
                                <tr>
                                    <td>'.$i.'</td>
                                    <td>'.$row['name'].'</td>
                                    <td>'.$row['role'].'</td>
                                    <td>'.$row['duration'].'</td>
                                    <td>'.$row['point'].'</td>
                                    ';
                                $sql2 = "SELECT * FROM Profile WHERE id='".$row['vid']."'";
                                $result2 = mysqli_query($conn, $sql2);
                                if (mysqli_num_rows($result2) > 0) {
                                    while($row2 = mysqli_fetch_assoc($result2)) {
                                        echo'<td>'.$row2['name'].'</td>';
                                    }
                                }
                                echo'
                                    <td>'.$row['vid'].'</td>
                                </tr>
                                ';
                                $i=$i+1;
                                $point=$point+$row['point'];
                            }
                        }
                        
                    }
                    $epoint=$point;
                    if($i==1){echo'<tr><td colspan="7" class="text-center fw-light">NO ENTRY</td></tr>';}
                    if($point>20){$point=20;}
                    $fpoint=$fpoint+$point;
                    echo'
                    <tr><td colspan="7" class="text-center"><i>Earned Point : '.$epoint.'</i> | <i>Considered Point : '.$point.'</i></td></tr>
                    <tr></tr>
                    </tbody>
                </table>

                <table class="table table-hover mt-5">
                    <thead>
                    <tr><th scope="col" colspan="6" class="text-center"><h5>Contribution to Society (10)</h5></th></tr>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Activity Name</th>
                        <th scope="col">Date</th>
                        <th scope="col">Points</th>
                        <th scope="col">Verified Name</th>
                        <th scope="col">Verified ID</th>
                    </tr>
                    </thead>
                    <tbody>
                    ';
                    $i=1;$point=0;
                    $sql = "SELECT * FROM CTS WHERE id='".$id."'";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            if($row["verify"]==1){
                                echo'    
                                <tr>
                                    <td>'.$i.'</td>
                                    <td>'.$row['activity'].'</td>
                                    <td>'.$row['date'].'</td>
                                    <td>'.$row['point'].'</td>
                                    ';
                                $sql2 = "SELECT * FROM Profile WHERE id='".$row['vid']."'";
                                $result2 = mysqli_query($conn, $sql2);
                                if (mysqli_num_rows($result2) > 0) {
                                    while($row2 = mysqli_fetch_assoc($result2)) {
                                        echo'<td>'.$row2['name'].'</td>';
                                    }
                                }
                                echo'
                                    <td>'.$row['vid'].'</td>
                                </tr>
                                ';
                                $i=$i+1;
                                $point=$point+$row['point'];
                            }
                        }
                        
                    }
                    $epoint=$point;
                    if($i==1){echo'<tr><td colspan="6" class="text-center fw-light">NO ENTRY</td></tr>';}
                    if($point>10){$point=10;}
                    $fpoint=$fpoint+$point;
                    echo'
                    <tr><td colspan="6" class="text-center"><i>Earned Point : '.$epoint.'</i> | <i>Considered Point : '.$point.'</i></td></tr>
                    <tr></tr>
                    </tbody>
                </table>

                <table class="table table-hover mt-5">
                    <thead>
                    <tr><th scope="col" colspan="9" class="text-center"><h5>Research and Alied activites (125)</h5></th></tr>
                    <tr><th scope="col" colspan="9" class="text-center"><h6>Seminar Workshop, Techinal / Motivational Training Organized (10)</h6></th></tr>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Activity Name</th>
                        <th scope="col">Date</th>
                        <th scope="col">For</th>
                        <th scope="col">No of Participates</th>
                        <th scope="col">Role</th>
                        <th scope="col">Points</th>
                        <th scope="col">Verified Name</th>
                        <th scope="col">Verified ID</th>
                    </tr>
                    </thead>
                    <tbody>
                    ';
                    $i=1;$point=0;
                    $sql = "SELECT * FROM RAA1 WHERE id='".$id."'";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            if($row["verify"]==1){
                                echo'    
                                <tr>
                                    <td>'.$i.'</td>
                                    <td>'.$row['name'].'</td>
                                    <td>'.$row['date'].'</td>
                                    <td>'.$row['considering'].'</td>
                                    <td>'.$row['participants'].'</td>
                                    <td>'.$row['role'].'</td>
                                    <td>'.$row['point'].'</td>
                                    ';
                                $sql2 = "SELECT * FROM Profile WHERE id='".$row['vid']."'";
                                $result2 = mysqli_query($conn, $sql2);
                                if (mysqli_num_rows($result2) > 0) {
                                    while($row2 = mysqli_fetch_assoc($result2)) {
                                        echo'<td>'.$row2['name'].'</td>';
                                    }
                                }
                                echo'
                                    <td>'.$row['vid'].'</td>
                                </tr>
                                ';
                                $i=$i+1;
                                $point=$point+$row['point'];
                            }
                        }
                        
                    }
                    $epoint=$point;
                    if($i==1){echo'<tr><td colspan="9" class="text-center fw-light">NO ENTRY</td></tr>';}
                    if($point>10){$point=10;}
                    $fpoint=$fpoint+$point;
                    echo'
                    <tr><td colspan="9" class="text-center"><i>Earned Point : '.$epoint.'</i> | <i>Considered Point : '.$point.'</i></td></tr>
                    <tr></tr>
                    </tbody>
                </table>

                <table class="table table-hover mt-5">
                    <thead>
                    <tr><th scope="col" colspan="10" class="text-center"><h6>Faculty Program FDP/STTP Organized (10)</h6></th></tr>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Activity Name</th>
                        <th scope="col">Date</th>
                        <th scope="col">Place</th>
                        <th scope="col">No of Participates</th>
                        <th scope="col">No of Days</th>
                        <th scope="col">Agency</th>
                        <th scope="col">Points</th>
                        <th scope="col">Verified Name</th>
                        <th scope="col">Verified ID</th>
                    </tr>
                    </thead>
                    <tbody>
                    ';
                    $i=1;$point=0;
                    $sql = "SELECT * FROM RAA2 WHERE id='".$id."'";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            if($row["verify"]==1){
                                echo'    
                                <tr>
                                    <td>'.$i.'</td>
                                    <td>'.$row['title'].'</td>
                                    <td>'.$row['date'].'</td>
                                    <td>'.$row['place'].'</td>
                                    <td>'.$row['participants'].'</td>
                                    <td>'.$row['days'].'</td>
                                    <td>'.$row['sponsoring_agency'].'</td>
                                    <td>'.$row['point'].'</td>
                                    ';
                                $sql2 = "SELECT * FROM Profile WHERE id='".$row['vid']."'";
                                $result2 = mysqli_query($conn, $sql2);
                                if (mysqli_num_rows($result2) > 0) {
                                    while($row2 = mysqli_fetch_assoc($result2)) {
                                        echo'<td>'.$row2['name'].'</td>';
                                    }
                                }
                                echo'
                                    <td>'.$row['vid'].'</td>
                                </tr>
                                ';
                                $i=$i+1;
                                $point=$point+$row['point'];
                            }
                        }
                        
                    }
                    $epoint=$point;
                    if($i==1){echo'<tr><td colspan="10" class="text-center fw-light">NO ENTRY</td></tr>';}
                    if($point>10){$point=10;}
                    $fpoint=$fpoint+$point;
                    echo'
                    <tr><td colspan="10" class="text-center"><i>Earned Point : '.$epoint.'</i> | <i>Considered Point : '.$point.'</i></td></tr>
                    <tr></tr>
                    </tbody>
                </table>

                <table class="table table-hover mt-5">
                    <thead>
                    <tr><th scope="col" colspan="8" class="text-center"><h6>Participation in MOOCS courses (10)</h6></th></tr>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Course Name</th>
                        <th scope="col">Date</th>
                        <th scope="col">Exam Date</th>
                        <th scope="col">Duration (week)</th>
                        <th scope="col">Points</th>
                        <th scope="col">Verified Name</th>
                        <th scope="col">Verified ID</th>
                    </tr>
                    </thead>
                    <tbody>
                    ';
                    $i=1;$point=0;
                    $sql = "SELECT * FROM RAA3 WHERE id='".$id."'";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            if($row["verify"]==1){
                                echo'    
                                <tr>
                                    <td>'.$i.'</td>
                                    <td>'.$row['name'].'</td>
                                    <td>'.$row['date'].'</td>
                                    <td>'.$row['date_of_examination'].'</td>
                                    <td>'.$row['duration'].'</td>
                                    <td>'.$row['point'].'</td>
                                    ';
                                $sql2 = "SELECT * FROM Profile WHERE id='".$row['vid']."'";
                                $result2 = mysqli_query($conn, $sql2);
                                if (mysqli_num_rows($result2) > 0) {
                                    while($row2 = mysqli_fetch_assoc($result2)) {
                                        echo'<td>'.$row2['name'].'</td>';
                                    }
                                }
                                echo'
                                    <td>'.$row['vid'].'</td>
                                </tr>
                                ';
                                $i=$i+1;
                                $point=$point+$row['point'];
                            }
                        }
                        
                    }
                    $epoint=$point;
                    if($i==1){echo'<tr><td colspan="8" class="text-center fw-light">NO ENTRY</td></tr>';}
                    if($point>10){$point=10;}
                    $fpoint=$fpoint+$point;
                    echo'
                    <tr><td colspan="8" class="text-center"><i>Earned Point : '.$epoint.'</i> | <i>Considered Point : '.$point.'</i></td></tr>
                    <tr></tr>
                    </tbody>
                </table>

                <table class="table table-hover mt-5">
                    <thead>
                    <tr><th scope="col" colspan="8" class="text-center"><h6>Membership of Associations or Professional Bodies (10)</h6></th></tr>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Org Name</th>
                        <th scope="col">Date</th>
                        <th scope="col">Type</th>
                        <th scope="col">Membership Number</th>
                        <th scope="col">Points</th>
                        <th scope="col">Verified Name</th>
                        <th scope="col">Verified ID</th>
                    </tr>
                    </thead>
                    <tbody>
                    ';
                    $i=1;$point=0;
                    $sql = "SELECT * FROM RAA4 WHERE id='".$id."'";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            if($row["verify"]==1){
                                echo'    
                                <tr>
                                    <td>'.$i.'</td>
                                    <td>'.$row['name'].'</td>
                                    <td>'.$row['date'].'</td>
                                    <td>'.$row['type'].'</td>
                                    <td>'.$row['membership'].'</td>
                                    <td>'.$row['point'].'</td>
                                    ';
                                $sql2 = "SELECT * FROM Profile WHERE id='".$row['vid']."'";
                                $result2 = mysqli_query($conn, $sql2);
                                if (mysqli_num_rows($result2) > 0) {
                                    while($row2 = mysqli_fetch_assoc($result2)) {
                                        echo'<td>'.$row2['name'].'</td>';
                                    }
                                }
                                echo'
                                    <td>'.$row['vid'].'</td>
                                </tr>
                                ';
                                $i=$i+1;
                                $point=$point+$row['point'];
                            }
                        }
                        
                    }
                    $epoint=$point;
                    if($i==1){echo'<tr><td colspan="8" class="text-center fw-light">NO ENTRY</td></tr>';}
                    if($point>10){$point=10;}
                    $fpoint=$fpoint+$point;
                    echo'
                    <tr><td colspan="8" class="text-center"><i>Earned Point : '.$epoint.'</i> | <i>Considered Point : '.$point.'</i></td></tr>
                    <tr></tr>
                    </tbody>
                </table>

                <table class="table table-hover mt-5">
                    <thead>
                    <!--<tr><th scope="col" colspan="10" class="text-center"><h6>Research Paper Publication (20)</h6></th></tr>-->
                    <tr><th scope="col" colspan="10" class="text-center"><h6>Research Paper Published in Peer Reviewed SCI/Scopus/JET or UGC listed Journals (10)</h6></th></tr>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Author Name</th>
                        <th scope="col">Title</th>
                        <th scope="col">Index</th>
                        <th scope="col">ISSN</th>
                        <th scope="col">Journal Name</th>
                        <th scope="col">Volume Page</th>
                        <th scope="col">Points</th>
                        <th scope="col">Verified Name</th>
                        <th scope="col">Verified ID</th>
                    </tr>
                    </thead>
                    <tbody>
                    ';
                    $i=1;$point=0;
                    $sql = "SELECT * FROM RAA5 WHERE id='".$id."'";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            if($row["verify"]==1){
                                echo'    
                                <tr>
                                    <td>'.$i.'</td>
                                    <td>'.$row['name'].'</td>
                                    <td>'.$row['title'].'</td>
                                    <td>'.$row['indexing'].'</td>
                                    <td>'.$row['issn'].'</td>
                                    <td>'.$row['journal'].'</td>
                                    <td>'.$row['vpage'].'</td>
                                    <td>'.$row['point'].'</td>
                                    ';
                                $sql2 = "SELECT * FROM Profile WHERE id='".$row['vid']."'";
                                $result2 = mysqli_query($conn, $sql2);
                                if (mysqli_num_rows($result2) > 0) {
                                    while($row2 = mysqli_fetch_assoc($result2)) {
                                        echo'<td>'.$row2['name'].'</td>';
                                    }
                                }
                                echo'
                                    <td>'.$row['vid'].'</td>
                                </tr>
                                ';
                                $i=$i+1;
                                $point=$point+$row['point'];
                            }
                        }
                        
                    }
                    $epoint=$point;
                    if($i==1){echo'<tr><td colspan="10" class="text-center fw-light">NO ENTRY</td></tr>';}
                    if($point>10){$point=10;}
                    $fpoint=$fpoint+$point;
                    echo'
                    <tr><td colspan="10" class="text-center"><i>Earned Point : '.$epoint.'</i> | <i>Considered Point : '.$point.'</i></td></tr>
                    <tr></tr>
                    </tbody>
                </table>

                <table class="table table-hover mt-5">
                    <thead>
                    <!--<tr><th scope="col" colspan="8" class="text-center"><h6>Research Paper Publication (20)</h6></th></tr>-->
                    <tr><th scope="col" colspan="8" class="text-center"><h6>Research Paper Publication in Conference (10)</h6></th></tr>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Author Name</th>
                        <th scope="col">Publisher & Index</th>
                        <th scope="col">Name of Conference, Volume Pages</th>
                        <th scope="col">Presented/Publish</th>
                        <th scope="col">Points</th>
                        <th scope="col">Verified Name</th>
                        <th scope="col">Verified ID</th>
                    </tr>
                    </thead>
                    <tbody>
                    ';
                    $i=1;$point=0;
                    $sql = "SELECT * FROM RAA6 WHERE id='".$id."'";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            if($row["verify"]==1){
                                echo'    
                                <tr>
                                    <td>'.$i.'</td>
                                    <td>'.$row['name'].'</td>
                                    <td>'.$row['pi'].'</td>
                                    <td>'.$row['cvp'].'</td>
                                    <td>'.$row['pp'].'</td>
                                    <td>'.$row['point'].'</td>
                                    ';
                                $sql2 = "SELECT * FROM Profile WHERE id='".$row['vid']."'";
                                $result2 = mysqli_query($conn, $sql2);
                                if (mysqli_num_rows($result2) > 0) {
                                    while($row2 = mysqli_fetch_assoc($result2)) {
                                        echo'<td>'.$row2['name'].'</td>';
                                    }
                                }
                                echo'
                                    <td>'.$row['vid'].'</td>
                                </tr>
                                ';
                                $i=$i+1;
                                $point=$point+$row['point'];
                            }
                        }
                        
                    }
                    $epoint=$point;
                    if($i==1){echo'<tr><td colspan="8" class="text-center fw-light">NO ENTRY</td></tr>';}
                    if($point>10){$point=10;}
                    $fpoint=$fpoint+$point;
                    echo'
                    <tr><td colspan="8" class="text-center"><i>Earned Point : '.$epoint.'</i> | <i>Considered Point : '.$point.'</i></td></tr>
                    <tr></tr>
                    </tbody>
                </table>

                <table class="table table-hover mt-5">
                    <thead>
                    <tr><th scope="col" colspan="8" class="text-center"><h6>Books authored  which are published by (10)</h6></th></tr>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title of book</th>
                        <th scope="col">Authors</th>
                        <th scope="col">Year</th>
                        <th scope="col">Publisher</th>
                        <th scope="col">Points</th>
                        <th scope="col">Verified Name</th>
                        <th scope="col">Verified ID</th>
                    </tr>
                    </thead>
                    <tbody>
                    ';
                    $i=1;$point=0;
                    $sql = "SELECT * FROM RAA7 WHERE id='".$id."'";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            if($row["verify"]==1){
                                echo'    
                                <tr>
                                    <td>'.$i.'</td>
                                    <td>'.$row['title'].'</td>
                                    <td>'.$row['authors'].'</td>
                                    <td>'.$row['year'].'</td>
                                    <td>'.$row['publisher'].'</td>
                                    <td>'.$row['point'].'</td>
                                    ';
                                $sql2 = "SELECT * FROM Profile WHERE id='".$row['vid']."'";
                                $result2 = mysqli_query($conn, $sql2);
                                if (mysqli_num_rows($result2) > 0) {
                                    while($row2 = mysqli_fetch_assoc($result2)) {
                                        echo'<td>'.$row2['name'].'</td>';
                                    }
                                }
                                echo'
                                    <td>'.$row['vid'].'</td>
                                </tr>
                                ';
                                $i=$i+1;
                                $point=$point+$row['point'];
                            }
                        }
                        
                    }
                    $epoint=$point;
                    if($i==1){echo'<tr><td colspan="8" class="text-center fw-light">NO ENTRY</td></tr>';}
                    if($point>10){$point=10;}
                    $fpoint=$fpoint+$point;
                    echo'
                    <tr><td colspan="8" class="text-center"><i>Earned Point : '.$epoint.'</i> | <i>Considered Point : '.$point.'</i></td></tr>
                    <tr></tr>
                    </tbody>
                </table>

                <table class="table table-hover mt-5">
                    <thead>
                    <tr><th scope="col" colspan="8" class="text-center"><h6>E-content (10)</h6></th></tr>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Sem</th>
                        <th scope="col">Subject Code</th>
                        <th scope="col">Subject Name</th>
                        <th scope="col">Link</th>
                        <th scope="col">Points</th>
                        <th scope="col">Verified Name</th>
                        <th scope="col">Verified ID</th>
                    </tr>
                    </thead>
                    <tbody>
                    ';
                    $i=1;$point=0;
                    $sql = "SELECT * FROM RAA8 WHERE id='".$id."'";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            if($row["verify"]==1){
                                echo'    
                                <tr>
                                    <td>'.$i.'</td>
                                    <td>'.$row['sem'].'</td>
                                    <td>'.$row['subject'].'</td>
                                    <td>'.$row['name'].'</td>
                                    <td>'.$row['link'].'</td>
                                    <td>'.$row['point'].'</td>
                                    ';
                                $sql2 = "SELECT * FROM Profile WHERE id='".$row['vid']."'";
                                $result2 = mysqli_query($conn, $sql2);
                                if (mysqli_num_rows($result2) > 0) {
                                    while($row2 = mysqli_fetch_assoc($result2)) {
                                        echo'<td>'.$row2['name'].'</td>';
                                    }
                                }
                                echo'
                                    <td>'.$row['vid'].'</td>
                                </tr>
                                ';
                                $i=$i+1;
                                $point=$point+$row['point'];
                            }
                        }
                        
                    }
                    $epoint=$point;
                    if($i==1){echo'<tr><td colspan="8" class="text-center fw-light">NO ENTRY</td></tr>';}
                    if($point>10){$point=10;}
                    $fpoint=$fpoint+$point;
                    echo'
                    <tr><td colspan="8" class="text-center"><i>Earned Point : '.$epoint.'</i> | <i>Considered Point : '.$point.'</i></td></tr>
                    <tr></tr>
                    </tbody>
                </table>

                <table class="table table-hover mt-5">
                    <thead>
                    <tr><th scope="col" colspan="6" class="text-center"><h6>Patents (20)</h6></th></tr>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Patent Name</th>
                        <th scope="col">Option</th>
                        <th scope="col">Points</th>
                        <th scope="col">Verified Name</th>
                        <th scope="col">Verified ID</th>
                    </tr>
                    </thead>
                    <tbody>
                    ';
                    $i=1;$point=0;
                    $sql = "SELECT * FROM RAA9 WHERE id='".$id."'";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            if($row["verify"]==1){
                                echo'    
                                <tr>
                                    <td>'.$i.'</td>
                                    <td>'.$row['name'].'</td>
                                    <td>'.$row['type'].'</td>
                                    <td>'.$row['point'].'</td>
                                    ';
                                $sql2 = "SELECT * FROM Profile WHERE id='".$row['vid']."'";
                                $result2 = mysqli_query($conn, $sql2);
                                if (mysqli_num_rows($result2) > 0) {
                                    while($row2 = mysqli_fetch_assoc($result2)) {
                                        echo'<td>'.$row2['name'].'</td>';
                                    }
                                }
                                echo'
                                    <td>'.$row['vid'].'</td>
                                </tr>
                                ';
                                $i=$i+1;
                                $point=$point+$row['point'];
                            }
                        }
                        
                    }
                    $epoint=$point;
                    if($i==1){echo'<tr><td colspan="6" class="text-center fw-light">NO ENTRY</td></tr>';}
                    if($point>20){$point=20;}
                    $fpoint=$fpoint+$point;
                    echo'
                    <tr><td colspan="6" class="text-center"><i>Earned Point : '.$epoint.'</i> | <i>Considered Point : '.$point.'</i></td></tr>
                    <tr></tr>
                    </tbody>
                </table>

                <table class="table table-hover mt-5">
                    <thead>
                    <tr><th scope="col" colspan="7" class="text-center"><h6>Research Guidance (30)</h6></th></tr>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Program</th>
                        <th scope="col">No of Candidate/team/group</th>
                        <th scope="col">Name of University</th>
                        <th scope="col">Points</th>
                        <th scope="col">Verified Name</th>
                        <th scope="col">Verified ID</th>
                    </tr>
                    </thead>
                    <tbody>
                    ';
                    $i=1;$point=0;
                    $sql = "SELECT * FROM RAA10 WHERE id='".$id."'";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            if($row["verify"]==1){
                                echo'    
                                <tr>
                                    <td>'.$i.'</td>
                                    <td>'.$row['name'].'</td>
                                    <td>'.$row['candidate'].'</td>
                                    <td>'.$row['university'].'</td>
                                    <td>'.$row['point'].'</td>
                                    ';
                                $sql2 = "SELECT * FROM Profile WHERE id='".$row['vid']."'";
                                $result2 = mysqli_query($conn, $sql2);
                                if (mysqli_num_rows($result2) > 0) {
                                    while($row2 = mysqli_fetch_assoc($result2)) {
                                        echo'<td>'.$row2['name'].'</td>';
                                    }
                                }
                                echo'
                                    <td>'.$row['vid'].'</td>
                                </tr>
                                ';
                                $i=$i+1;
                                $point=$point+$row['point'];
                            }
                        }
                        
                    }
                    $epoint=$point;
                    if($i==1){echo'<tr><td colspan="7" class="text-center fw-light">NO ENTRY</td></tr>';}
                    if($point>30){$point=30;}
                    $fpoint=$fpoint+$point;
                    echo'
                    <tr><td colspan="7" class="text-center"><i>Earned Point : '.$epoint.'</i> | <i>Considered Point : '.$point.'</i></td></tr>
                    <tr></tr>
                    </tbody>
                </table>

                <table class="table table-hover mt-5">
                    <thead>
                    <tr><th scope="col" colspan="8" class="text-center"><h5>Invited For Lectures (5)</h5></th></tr>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Institute Name</th>
                        <th scope="col">Institute Level</th>
                        <th scope="col">Date</th>
                        <th scope="col">Topic</th>
                        <th scope="col">Points</th>
                        <th scope="col">Verified Name</th>
                        <th scope="col">Verified ID</th>
                    </tr>
                    </thead>
                    <tbody>
                    ';
                    $i=1;$point=0;
                    $sql = "SELECT * FROM INV WHERE id='".$id."'";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            if($row["verify"]==1){
                                echo'    
                                <tr>
                                    <td>'.$i.'</td>
                                    <td>'.$row['name'].'</td>
                                    <td>'.$row['level'].'</td>
                                    <td>'.$row['date'].'</td>
                                    <td>'.$row['topic'].'</td>
                                    <td>'.$row['point'].'</td>
                                    ';
                                $sql2 = "SELECT * FROM Profile WHERE id='".$row['vid']."'";
                                $result2 = mysqli_query($conn, $sql2);
                                if (mysqli_num_rows($result2) > 0) {
                                    while($row2 = mysqli_fetch_assoc($result2)) {
                                        echo'<td>'.$row2['name'].'</td>';
                                    }
                                }
                                echo'
                                    <td>'.$row['vid'].'</td>
                                </tr>
                                ';
                                $i=$i+1;
                                $point=$point+$row['point'];
                            }
                        }
                        
                    }
                    $epoint=$point;
                    if($i==1){echo'<tr><td colspan="8" class="text-center fw-light">NO ENTRY</td></tr>';}
                    if($point>5){$point=5;}
                    $fpoint=$fpoint+$point;
                    echo'
                    <tr><td colspan="8" class="text-center"><i>Earned Point : '.$epoint.'</i> | <i>Considered Point : '.$point.'</i></td></tr>
                    <tr></tr>
                    </tbody>
                </table>

                <table class="table table-hover mt-5">
                    <thead>
                    <tr><th scope="col" colspan="5" class="text-center"><h5>Any Other (15)</h5></th></tr>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">title</th>
                        <th scope="col">Points</th>
                        <th scope="col">Verified Name</th>
                        <th scope="col">Verified ID</th>
                    </tr>
                    </thead>
                    <tbody>
                    ';
                    $i=1;$point=0;
                    $sql = "SELECT * FROM AO WHERE id='".$id."'";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            if($row["verify"]==1){
                                echo'    
                                <tr>
                                    <td>'.$i.'</td>
                                    <td>'.$row['title'].'</td>
                                    <td>'.$row['point'].'</td>
                                    ';
                                $sql2 = "SELECT * FROM Profile WHERE id='".$row['vid']."'";
                                $result2 = mysqli_query($conn, $sql2);
                                if (mysqli_num_rows($result2) > 0) {
                                    while($row2 = mysqli_fetch_assoc($result2)) {
                                        echo'<td>'.$row2['name'].'</td>';
                                    }
                                }
                                echo'
                                    <td>'.$row['vid'].'</td>
                                </tr>
                                ';
                                $i=$i+1;
                                $point=$point+$row['point'];
                            }
                        }
                        
                    }
                    $epoint=$point;
                    if($i==1){echo'<tr><td colspan="5" class="text-center fw-light">NO ENTRY</td></tr>';}
                    if($point>5){$point=5;}
                    $fpoint=$fpoint+$point;
                    echo'
                    <tr><td colspan="5" class="text-center"><i>Earned Point : '.$epoint.'</i> | <i>Considered Point : '.$point.'</i></td></tr>
                    <tr></tr>
                    </tbody>
                </table>

                <h3 class="mt-5 imgcl"><b><span class="highlight" style="background-image: linear-gradient(to right, #F27121cc, #E94057cc, #8A2387cc);border-radius: 6px;padding: 3px 6px;color: #fff;text-align: center;font-family: sans-serif;">FINAL POINT : '.$fpoint.'/400</span></b></h3>
            
            
            </div>
            ';
            $i=$i+1;
            }
            echo'
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

    function download(id) {
        var sTable = document.getElementById(`pdf${id}`).innerHTML;
    
        var style = "<style>";
        style = style + "table {width: 100%;font: 17px Calibri;}";
        style = style + ".h1, .h2, .h3, .h4, .h5, .h6, h1, h2, h3, h4, h5, h6 {margin-top: 0;margin-bottom: 0.5rem;font-weight: 500;line-height: 1.2;color: var(--bs-heading-color);}";
        style = style + ".h5, h5 {font-size: 1.25rem;font-weight: 700;}.h6, h6 {font-size: 1rem;font-weight: 500;}";
        style = style + ".mt-5 {margin-top: 3rem!important;}";
        style = style + "table, th, td {border: solid 1px #DDD; border-collapse: collapse;";
        style = style + "padding: 2px 3px;text-align: center;}";
        style = style + ".imgcl {display: flex;justify-content: center;}.cards-list {z-index: 0;width: 100%;display: flex;justify-content: space-around;flex-wrap: wrap;}.card {margin: 30px auto;width: 150px;height: 150px;border-radius: 40px;cursor: pointer;transition: 0.4s;}.card .card_image {width: inherit;height: inherit;border-radius: 40px;}.card .card_image img {width: inherit;height: inherit;border-radius: 40px;object-fit: cover;}.card .card_title {text-align: center;border-radius: 0px 0px 40px 40px;font-family: sans-serif;font-weight: bold;font-size: 20px;margin-top: -50px;height: 40px;}.title-white {color: white;}@media all and (max-width: 500px) {.card-list {flex-direction: column;}}.highlight-yellow {border-radius: 1em 0 1em 0;background-image: linear-gradient(-100deg,rgba(255, 224, 0, 0.2),rgba(255, 224, 0, 0.7) 95%,rgba(255, 224, 0, 0.1));}";
        style = style + "</style>";
    
        // CREATE A WINDOW OBJECT.
        var win = window.open("", "", "height=700,width=700");
    
        win.document.write("<html><head>");
        win.document.write(`<title>${id} API Report</title>`);   // <title> FOR PDF HEADER.
        win.document.write(style);          // ADD STYLE INSIDE THE HEAD TAG.
        win.document.write("</head>");
        win.document.write("<body>");
        win.document.write(sTable);         // THE TABLE CONTENTS INSIDE THE BODY TAG.
        win.document.write("</body></html>");
    
        win.document.close(); 	// CLOSE THE CURRENT WINDOW.
    
        win.print();    // PRINT THE CONTENTS.
    }

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



?>

