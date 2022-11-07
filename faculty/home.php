<?php

include '../db.php';
if(!isset($_SESSION["id"]) AND !isset($_SESSION["fprofile"]) AND $_SESSION["fprofile"] != 1){
    echo"
    <script>
        location.href = '../index.php';
    </script>
    ";
}

$subjectNameArr=array();
echo '<script> var subjectNameArr = {}; </script>';
$sqll = "SELECT * FROM Subject order by sem,code";
$resultt = mysqli_query($conn, $sqll);
if (mysqli_num_rows($resultt) > 0) {
    while($row = mysqli_fetch_assoc($resultt)) {
        $key1 = $row['sem'];
        $key = $row['code'];
        $value = $row['name'];
        $subjectNameArr[$key1][$key] = $value;
        echo '<script>
        subjectNameArr["'.$key.'/'.$key1.'"] = "'.$value.'";
         </script>';
    }
}

echo "<script>
function getName(p1){
    return subjectNameArr[p1];
}
// console.log(getName('3130004/3'))
</script>";

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
     <br/><a href="profile.php">Profile</a><a class="ms-3" href="activity.php">Activity</a><a class="ms-3 float-end" href="logout.php">Logout</a><hr>
        <div id="alertinner">
        
        </div>
        <div class="row p-2">
            <div class="col-lg m-2 p-2 shadow p-3 mb-1 bg-body rounded border border border-light">
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
                <div class="form-group">
                <select class="form-control" id="criteria">
                    <option value="0">Select Criteria</option>
                    <option value="1">Teaching Learning Process</option>
                    <option value="2">GTU Result</option>
                    <option value="3">Discipline</option>
                    <option value="4">Departmental Portfolio</option>
                    <option value="5">Institute Portfolio</option>
                    <option value="6">Contribution to Society</option>
                    <option value="7">Research and allied activities</option>
                    <option value="8">Invited For</option>
                    <option value="9">Any other</option>
                </select>

                <!--TLP-->
                <form method="POST" action="" class="p-2" id="TLP" enctype="multipart/form-data">
                  <hr>
                  <div class="form-group p-2">
                    <label for="sem">Semester</label>
                    <select class="form-control" name="semester" id="sem">
                        <option value="0">Select One</option>
                        <option value="1">Sem 1</option>
                        <option value="2">Sem 2</option>
                        <option value="3">Sem 3</option>
                        <option value="4">Sem 4</option>
                        <option value="5">Sem 5</option>
                        <option value="6">Sem 6</option>
                        <option value="7">Sem 7</option>
                        <option value="8">Sem 8</option>
                    </select>
                  </div>
                  <div class="form-group p-2">
                    <label for="sub">Subject Code</label>
                    <input type="text" class="form-control" id="sub" name="subCode" required>
                  </div>
                  <div class="form-group p-2">
                    <label for="sub">Subject Name</label>
                    <input type="text" class="form-control" id="subNameTLP" name="subName" required readonly>
                  </div>
                  <div class="form-group p-2">
                    <label for="schedule">No.of Scheduled classes/week</label>
                    <input type="number" min="0" class="form-control" id="schedule" name="scheduleClass" required>
                  </div>
                  <div class="form-group p-2">
                    <label for="actual">No. of actual classes</label>
                    <input type="number" min="0" class="form-control" id="actual" name="actualClass" required>
                  </div>
                  <div class="form-group p-2">
                    <label for="attach">Attachment</label>
                    <input type="file" accept="application/pdf" class="form-control" id="attach" name="attachment" required>
                  </div>
                  <button type="submit" name="submitTLP" class="btn btn-primary p-2 btn-sm">Submit</button>
                </form>

                <!--GR-->
                <form method="POST" action="" class="p-2" id="GR" enctype="multipart/form-data">
                  <hr>
                  <div class="form-group p-2">
                    <label for="sem">Semester</label>
                    <select class="form-control" name="semester" id="semGR">
                        <option value="0">Select One</option>
                        <option value="1">Sem 1</option>
                        <option value="2">Sem 2</option>
                        <option value="3">Sem 3</option>
                        <option value="4">Sem 4</option>
                        <option value="5">Sem 5</option>
                        <option value="6">Sem 6</option>
                        <option value="7">Sem 7</option>
                        <option value="8">Sem 8</option>
                    </select>
                  </div>
                  <div class="form-group p-2">
                    <label for="subC">Subject Code</label>
                    <input type="text" class="form-control" id="subC" name="subCode" required>
                  </div>
                  <div class="form-group p-2">
                    <label for="subN">Subject Name</label>
                    <input type="text" class="form-control" id="subNameGR" name="subName" required readonly>
                  </div>
                  <div class="form-group p-2">
                    <label for="y">Academic Year</label>
                    <input type="text" class="form-control" id="y" name="year" required>
                  </div>
                  <div class="form-group p-2">
                    <label for="rI">Result of subject (Institute)</label>
                    <input type="number" min="0" max="100" class="form-control" id="rI" name="resultInstitute" step="0.01" required>
                  </div>
                  <div class="form-group p-2">
                    <label for="rG">Result of GTU</label>
                    <input type="number" min="0" max="100" class="form-control" id="rG" name="resultGtu" step="0.01" required>
                  </div>
                  <div class="form-group p-2">
                    <label for="attach">Attachment</label>
                    <input type="file" accept="application/pdf" class="form-control" id="attach" name="attachment" required>
                  </div>
                  <button type="submit" name="submitGR" class="btn btn-sm btn-primary p-2">Submit</button>
                </form>

                <!--DISC-->
                <form method="POST" action="" class="p-2" id="DISC" enctype="multipart/form-data">
                  <hr>
                  <div class="form-group p-2">
                    <label for="subN">No of times Late Punch</label>
                    <input type="number" min="0" max="100" class="form-control" id="nooftlp" name="nooftlp" required>
                  </div>
                  <div class="form-group p-2">
                    <label for="subN">No. of LWP</label>
                    <input type="number" min="0" max="100" class="form-control" id="nooflwp" name="nooflwp" required>
                  </div>
                  <div class="form-group p-2">
                    <label for="subN">No. of Balanced leave</label>
                    <input type="number" min="0" max="5" class="form-control" id="noofbl" name="noofbl" required>
                  </div>
                  <div class="form-group p-2">
                    <label for="subN">No .of memo/justification/clarification</label>
                    <input type="number" min="0" max="100" class="form-control" id="noofm" name="noofm" required>
                  </div>
                  <div class="form-group p-2">
                    <label for="subN">No .of Fine</label>
                    <input type="number" min="0" max="100" class="form-control" id="nooff" name="nooff" required>
                  </div>
                  <button type="submit" name="submitDISC" class="btn btn-sm btn-primary p-2">Submit</button>
                </form>

                <!--DP-->
                <form method="POST" action="" class="p-2" id="DP" enctype="multipart/form-data">
                  <hr>
                  ';
                  $sqll = "SELECT * FROM Activity";
                  $resultt = mysqli_query($conn, $sqll);
                  if (mysqli_num_rows($resultt) > 0) {
                    echo'<div class="form-group p-2">
                    <label for="sem">Portfolioes</label>
                    <select class="form-control" name="port" id="port">
                        <option value="0">Select One</option>';
                        while($roww = mysqli_fetch_assoc($resultt)) {
                        if($roww["type"]==0){
                            echo'<option value="'.$roww["name"].'">'.$roww["name"].'</option>';
                        }
                      }
                      echo'</select></div>';
                  }
                  echo'
                  <div class="form-group p-2">
                    <label for="sem">Role</label>
                    <select class="form-control" name="role" id="role">
                        <option value="0">Select One</option>
                        <option value="1">Co-ordinator</option>
                        <option value="2">cocooordinator</option>
                        <option value="3">member</option>
                    </select>
                  </div>
                  <div class="form-group p-2">
                    <label for="sem">Duration</label>
                    <select class="form-control" name="duration" id="duration">
                        <option value="0">Select One</option>
                        <option value="1">1 year</option>
                        <option value="2">6 month</option>
                    </select>
                  </div>
                  <div class="form-group p-2">
                    <label for="attach">Attachment</label>
                    <input type="file" accept="application/pdf" class="form-control" id="attach" name="attachment" required>
                  </div>
                  <button type="submit" name="submitDP" class="btn btn-sm btn-primary p-2">Submit</button>
                </form>

                <!--IP-->
                <form method="POST" action="" class="p-2" id="IP" enctype="multipart/form-data">
                  <hr>
                  ';
                  $sqll = "SELECT * FROM Activity";
                  $resultt = mysqli_query($conn, $sqll);
                  if (mysqli_num_rows($resultt) > 0) {
                    echo'<div class="form-group p-2">
                    <label for="sem">Portfolioes</label>
                    <select class="form-control" name="port" id="port">
                        <option value="0">Select One</option>';
                        while($roww = mysqli_fetch_assoc($resultt)) {
                        if($roww["type"]==1){
                            echo'<option value="'.$roww["name"].'">'.$roww["name"].'</option>';
                        }
                      }
                      echo'</select></div>';
                  }
                  echo'
                  <div class="form-group p-2">
                    <label for="sem">Role</label>
                    <select class="form-control" name="role" id="role">
                        <option value="0">Select One</option>
                        <option value="1">Co-ordinator</option>
                        <option value="2">cocooordinator</option>
                        <option value="3">member</option>
                    </select>
                  </div>
                  <div class="form-group p-2">
                    <label for="sem">Duration</label>
                    <select class="form-control" name="duration" id="duration">
                        <option value="0">Select One</option>
                        <option value="1">1 year</option>
                        <option value="2">6 month</option>
                    </select>
                  </div>
                  <div class="form-group p-2">
                    <label for="attach">Attachment</label>
                    <input type="file" accept="application/pdf" class="form-control" id="attach" name="attachment" required>
                  </div>
                  <button type="submit" name="submitIP" class="btn btn-sm btn-primary p-2">Submit</button>
                </form>

                <!--CTS-->
                <form method="POST" action="" class="p-2" id="CTS" enctype="multipart/form-data">
                  <hr>
                  <div class="form-group p-2">
                    <label for="subN">Activity</label>
                    <input type="text" class="form-control" id="activity" name="activity" required>
                  </div>
                  <div class="form-group p-2">
                    <label for="subN">Date</label>
                    <input type="date" max="'.date('Y-m-d').'" class="form-control" id="date" name="date" required>
                  </div>
                  <div class="form-group p-2">
                    <label for="attach">Attachment</label>
                    <input type="file" accept="application/pdf" class="form-control" id="attach" name="attachment" required>
                  </div>
                  <button type="submit" name="submitCTS" class="btn btn-sm btn-primary p-2">Submit</button>
                </form>

                <!--RAA-->
                <div id="RAA" class="p-2">
                  <hr>
                    <select class="form-control" id="sraa">
                        <option value="ABC" selected>Select One</option>
                        <option value="0">Seminar,Workshop, Technical or motivational Training organized</option>
                        <option value="1">FDP/ STTP organized</option>
                        <option value="2">Participation in MOOCS courses</option>
                        <option value="3">Membership of Associations or Professional Bodies</option>
                        <option value="4">Research paper publication in peer reviewed journal</option>
                        <option value="5">Research paper publication in Conference</option>
                        <option value="6">Books authored</option>
                        <option value="7">E-content</option>
                        <option value="8">Patent</option>
                        <option value="9">Research Guidance</option>
                    </select>

                    <!--raa1-->
                    <form method="POST" action="" class="p-2" id="raa1" enctype="multipart/form-data">
                        <hr>
                        <div class="form-group p-2">
                            <label for="subN">Activity</label>
                            <input type="text" class="form-control" id="activity" name="activity" required>
                        </div>
                        <div class="form-group p-2">
                            <label for="subN">Date</label>
                            <input type="date" max="'.date('Y-m-d').'" class="form-control" id="date" name="date" required>
                        </div>
                        <div class="form-group p-2">
                            <label for="sem">For</label>
                            <select class="form-control" name="for" id="for">
                                <option value="0">Select One</option>
                                <option value="1">Students</option>
                                <option value="2">Faculty</option>
                            </select>
                        </div>
                        <div class="form-group p-2">
                            <label for="subN">No of participants</label>
                            <input type="number" min="0" class="form-control" id="nop" name="nop" required>
                        </div>
                        <div class="form-group p-2">
                            <label for="sem">Role</label>
                            <select class="form-control" name="role" id="role">
                                <option value="0">Select One</option>
                                <option value="1">Coordinator</option>
                                <option value="2">Co-coordinator</option>
                            </select>
                        </div>
                        <div class="form-group p-2">
                            <label for="attach">Attachment</label>
                            <input type="file" accept="application/pdf" class="form-control" id="attach" name="attachment" required>
                        </div>
                        <button type="submit" name="submitRAA1" class="btn btn-sm btn-primary p-2">Submit</button>
                    </form>

                    <!--raa2-->
                    <form method="POST" action="" class="p-2" id="raa2" enctype="multipart/form-data">
                        <hr>
                        <div class="form-group p-2">
                            <label for="subN">Title</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                        <div class="form-group p-2">
                            <label for="subN">Starting Date</label>
                            <input type="date" max="'.date('Y-m-d').'" class="form-control" id="date" name="date" required>
                        </div>
                        <div class="form-group p-2">
                            <label for="subN">Place</label>
                            <input type="text" class="form-control" id="place" name="place" required>
                        </div>
                        <div class="form-group p-2">
                            <label for="subN">Sponsoring Agency</label>
                            <input type="text" class="form-control" id="sa" name="sa" required>
                        </div>
                        <div class="form-group p-2">
                            <label for="subN">No of participants</label>
                            <input type="number" min="0" class="form-control" id="nop" name="nop" required>
                        </div>
                        <div class="form-group p-2">
                            <label for="subN">No of days</label>
                            <input type="number" min="0" max="10" class="form-control" id="nod" name="nod" required>
                        </div>
                        <div class="form-group p-2">
                            <label for="attach">Attachment</label>
                            <input type="file" accept="application/pdf" class="form-control" id="attach" name="attachment" required>
                        </div>
                        <button type="submit" name="submitRAA2" class="btn btn-sm btn-primary p-2">Submit</button>
                    </form>

                    <!--raa3-->
                    <form method="POST" action="" class="p-2" id="raa3" enctype="multipart/form-data">
                        <hr>
                        <div class="form-group p-2">
                            <label for="subN">Name of Course</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group p-2">
                            <label for="subN">Date</label>
                            <input type="date" max="'.date('Y-m-d').'" class="form-control" id="date" name="date" required>
                        </div>
                        <div class="form-group p-2">
                            <label for="subN">Duration (week)</label>
                            <input type="number" min="0" max="8" class="form-control" id="nod" name="nod" required>
                        </div>
                        <div class="form-group p-2">
                            <label for="subN">Date of Examination</label>
                            <input type="date" max="'.date('Y-m-d').'" class="form-control" id="dateoe" name="dateoe" required>
                        </div>
                        <div class="form-group p-2">
                            <label for="attach">Attachment</label>
                            <input type="file" accept="application/pdf" class="form-control" id="attach" name="attachment" required>
                        </div>
                        <button type="submit" name="submitRAA3" class="btn btn-sm btn-primary p-2">Submit</button>
                    </form>

                    <!--raa4-->
                    <form method="POST" action="" class="p-2" id="raa4" enctype="multipart/form-data">
                        <hr>
                        <div class="form-group p-2">
                            <label for="subN">Name of oegnization</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group p-2">
                            <label for="subN">Date</label>
                            <input type="date" max="'.date('Y-m-d').'" class="form-control" id="date" name="date" required>
                        </div>
                        <div class="form-group p-2">
                            <label for="sem">Type</label>
                            <select class="form-control" name="type" id="type">
                                <option value="0">Select One</option>
                                <option value="1">National</option>
                                <option value="2">International</option>
                            </select>
                        </div>
                        <div class="form-group p-2">
                            <label for="subN">Membership Number</label>
                            <input type="number" min="0" class="form-control" id="nom" name="nom" required>
                        </div>
                        <div class="form-group p-2">
                            <label for="attach">Attachment</label>
                            <input type="file" accept="application/pdf" class="form-control" id="attach" name="attachment" required>
                        </div>
                        <button type="submit" name="submitRAA4" class="btn btn-sm btn-primary p-2">Submit</button>
                    </form>

                    <!--raa5-->
                    <form method="POST" action="" class="p-2" id="raa5" enctype="multipart/form-data">
                        <hr>
                        <div class="form-group p-2">
                            <label for="subN">Name of authors</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group p-2">
                            <label for="subN">Page title</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                        <div class="form-group p-2">
                            <label for="sem">Indexing</label>
                            <select class="form-control" name="index" id="index">
                                <option value="0">Select One</option>
                                <option value="1">SCi</option>
                                <option value="2">Scoupus</option>
                                <option value="3">UGC</option>
                                <option value="4">IJET</option>
                            </select>
                        </div>
                        <div class="form-group p-2">
                            <label for="subN">ISSN no</label>
                            <input type="text" class="form-control" id="issn" name="issn" required>
                        </div>
                        <div class="form-group p-2">
                            <label for="subN">Journal name</label>
                            <input type="text" class="form-control" id="journal" name="journal" required>
                        </div>
                        <div class="form-group p-2">
                            <label for="subN">Volumn page</label>
                            <input type="text" class="form-control" id="vpage" name="vpage" required>
                        </div>
                        <div class="form-group p-2">
                            <label for="attach">Attachment</label>
                            <input type="file" accept="application/pdf" class="form-control" id="attach" name="attachment" required>
                        </div>
                        <button type="submit" name="submitRAA5" class="btn btn-sm btn-primary p-2">Submit</button>
                    </form>

                    <!--raa6-->
                    <form method="POST" action="" class="p-2" id="raa6" enctype="multipart/form-data">
                        <hr>
                        <div class="form-group p-2">
                            <label for="subN">Name of authors</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group p-2">
                            <label for="subN">Publisher & Indexing</label>
                            <input type="text" class="form-control" id="pi" name="pi" required>
                        </div>
                        <div class="form-group p-2">
                            <label for="subN">Name of conference,volumn,page</label>
                            <input type="text" class="form-control" id="cvp" name="cvp" required>
                        </div>
                        <div class="form-group p-2">
                            <label for="sem">Presented/Publish</label>
                            <select class="form-control" name="pp" id="pp">
                                <option value="0">Select One</option>
                                <option value="1">Presented International</option>
                                <option value="2">Presented National</option>
                                <option value="3">Publish</option>
                            </select>
                        </div>
                        <div class="form-group p-2">
                            <label for="attach">Attachment</label>
                            <input type="file" accept="application/pdf" class="form-control" id="attach" name="attachment" required>
                        </div>
                        <button type="submit" name="submitRAA6" class="btn btn-sm btn-primary p-2">Submit</button>
                    </form>

                    <!--raa7-->
                    <form method="POST" action="" class="p-2" id="raa7" enctype="multipart/form-data">
                        <hr>
                        <div class="form-group p-2">
                            <label for="subN">Title of book</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                        <div class="form-group p-2">
                            <label for="subN">Year</label>
                            <input type="text" class="form-control" id="year" name="year" required>
                        </div>
                        <div class="form-group p-2">
                            <label for="subN">Authors</label>
                            <input type="text" class="form-control" id="authors" name="authors" required>
                        </div>
                        <div class="form-group p-2">
                            <label for="sem">Publisher</label>
                            <select class="form-control" name="pub" id="pub">
                                <option value="0">Select One</option>
                                <option value="1">International Publisher</option>
                                <option value="2">National Publisher</option>
                                <option value="3">chapter in edited book</option>
                                <option value="4">editor of book by international publisher</option>
                                <option value="5">editor of book by any publisher</option>
                            </select>
                        </div>
                        <div class="form-group p-2">
                            <label for="attach">Attachment</label>
                            <input type="file" accept="application/pdf" class="form-control" id="attach" name="attachment" required>
                        </div>
                        <button type="submit" name="submitRAA7" class="btn btn-sm btn-primary p-2">Submit</button>
                    </form>

                    <!--raa8-->
                    <form method="POST" action="" class="p-2" id="raa8" enctype="multipart/form-data">
                        <hr>
                        <div class="form-group p-2">
                          <label for="sem">Semester</label>
                          <select class="form-control" name="semester" id="sem">
                              <option value="0">Select One</option>
                              <option value="1">Sem 1</option>
                              <option value="2">Sem 2</option>
                              <option value="3">Sem 3</option>
                              <option value="4">Sem 4</option>
                              <option value="5">Sem 5</option>
                              <option value="6">Sem 6</option>
                              <option value="7">Sem 7</option>
                              <option value="8">Sem 8</option>
                          </select>
                        </div>
                        <div class="form-group p-2">
                            <label for="subN">Name of subject</label>
                            <input type="text" class="form-control" id="subNameraa8" name="subName" required readonly>
                        </div>
                        <div class="form-group p-2">
                            <label for="subN">Subject code</label>
                            <input type="text" class="form-control" id="subC" name="subCode" required>
                        </div>
                        <div class="form-group p-2">
                            <label for="subN">Link</label>
                            <input type="text" class="form-control" id="link" name="link" required>
                        </div>
                        <div class="form-group p-2">
                            <label for="attach">Attachment</label>
                            <input type="file" accept="application/pdf" class="form-control" id="attach" name="attachment" required>
                        </div>
                        <button type="submit" name="submitRAA8" class="btn btn-sm btn-primary p-2">Submit</button>
                    </form>

                    <!--raa9-->
                    <form method="POST" action="" class="p-2" id="raa9" enctype="multipart/form-data">
                        <hr>
                        <div class="form-group p-2">
                            <label for="sem">Option1</label>
                            <select class="form-control" name="o1" id="o1">
                                <option value="0">Select One</option>
                                <option value="1">International Grant</option>
                                <option value="2">International Grant + Publish</option>
                                <option value="3">National Grant</option>
                                <option value="4">National Grant + Publish</option>
                            </select>
                        </div>
                        <div class="form-group p-2">
                            <label for="attach">Attachment</label>
                            <input type="file" accept="application/pdf" class="form-control" id="attach" name="attachment" required>
                        </div>
                        <button type="submit" name="submitRAA9" class="btn btn-sm btn-primary p-2">Submit</button>
                    </form>

                    <!--raa10-->
                    <form method="POST" action="" class="p-2" id="raa10" enctype="multipart/form-data">
                        <hr>
                        <div class="form-group p-2">
                            <label for="sem">Program</label>
                            <select class="form-control" name="name" id="o1">
                                <option value="0">Select One</option>
                                <option value="1">Degree</option>
                                <option value="2">Degree + Thesis</option>
                                <option value="3">PhD</option>
                            </select>
                        </div>
                        <div class="form-group p-2">
                            <label for="subN">No of candidate/team/group</label>
                            <input type="number" min="0" class="form-control" id="noc" name="noc" required>
                        </div>
                        <div class="form-group p-2">
                            <label for="subN">Name of University</label>
                            <input type="text" class="form-control" id="name" name="nameou" required>
                        </div>
                        <div class="form-group p-2">
                            <label for="attach">Attachment</label>
                            <input type="file" accept="application/pdf" class="form-control" id="attach" name="attachment" required>
                        </div>
                        <button type="submit" name="submitRAA10" class="btn btn-sm btn-primary p-2">Submit</button>
                    </form>
                </div>

                <!--INV-->
                <form method="POST" action="" class="p-2" id="INV" enctype="multipart/form-data">
                  <hr>
                  <div class="form-group p-2">
                    <label for="subC">Name of Institute</label>
                    <input type="text" class="form-control" id="subC" name="nameIns" required>
                  </div>
                  <div class="form-group p-2">
                    <label for="sem">Level of institute</label>
                    <select class="form-control" name="levelIns" id="levelIns">
                        <option value="0">Select One</option>
                        <option value="1">International</option>
                        <option value="2">National</option>
                        <option value="3">State/Uni/Local</option>
                    </select>
                  </div>
                  <div class="form-group p-2">
                    <label for="subN">Date</label>
                    <input type="date" max="'.date('Y-m-d').'" class="form-control" id="date" name="date" required>
                  </div>
                  <div class="form-group p-2">
                    <label for="y">Topic name/Type of work</label>
                    <input type="text" class="form-control" id="topic" name="topic" required>
                  </div>
                  <div class="form-group p-2">
                    <label for="attach">Attachment</label>
                    <input type="file" accept="application/pdf" class="form-control" id="attach" name="attachment" required>
                  </div>
                  <button type="submit" name="submitINV" class="btn btn-sm btn-primary p-2">Submit</button>
                </form>

                <!--AO-->
                <form method="POST" action="" class="p-2" id="AO" enctype="multipart/form-data">
                  <hr>
                  <div class="form-group p-2">
                    <label for="subN">Title of work</label>
                    <input type="text" class="form-control" id="work" name="work" required>
                  </div>
                  <div class="form-group p-2">
                    <label for="attach">Attachment</label>
                    <input type="file" accept="application/pdf" class="form-control" id="attach" name="attachment" required>
                  </div>
                  <button type="submit" name="submitAO" class="btn btn-sm btn-primary p-2">Submit</button>
                </form>

                <script>
                    $("#TLP").hide();
                    $("#GR").hide();
                    $("#DISC").hide();
                    $("#DP").hide();
                    $("#IP").hide();
                    $("#CTS").hide();
                    $("#RAA").hide();
                    $("#INV").hide();
                    $("#AO").hide();
                    $("#criteria").on("change", function() {
                      //alert( this.value );
                      if(this.value == 1){
                          $("#TLP").show();
                          $("#GR").hide();
                          $("#DISC").hide();
                          $("#DP").hide();
                          $("#IP").hide();
                          $("#CTS").hide();
                          $("#RAA").hide();
                          $("#INV").hide();
                          $("#AO").hide();
                      }
                      else if(this.value == 2){
                        $("#GR").show();
                        $("#TLP").hide();
                        $("#DISC").hide();
                        $("#DP").hide();
                        $("#IP").hide();
                        $("#CTS").hide();
                        $("#RAA").hide();
                        $("#INV").hide();
                        $("#AO").hide();
                      }
                      else if(this.value == 3){
                        $("#TLP").hide();
                        $("#GR").hide();
                        $("#DISC").show();
                        $("#DP").hide();
                        $("#IP").hide();
                        $("#CTS").hide();
                        $("#RAA").hide();
                        $("#INV").hide();
                        $("#AO").hide();
                      }
                      else if(this.value == 4){
                        $("#GR").hide();
                        $("#TLP").hide();
                        $("#DISC").hide();
                        $("#DP").show();
                        $("#IP").hide();
                        $("#CTS").hide();
                        $("#RAA").hide();
                        $("#INV").hide();
                        $("#AO").hide();
                      }
                      else if(this.value == 5){
                        $("#GR").hide();
                        $("#TLP").hide();
                        $("#DISC").hide();
                        $("#DP").hide();
                        $("#IP").show();
                        $("#CTS").hide();
                        $("#RAA").hide();
                        $("#INV").hide();
                        $("#AO").hide();
                      }
                      else if(this.value == 6){
                        $("#GR").hide();
                        $("#TLP").hide();
                        $("#DISC").hide();
                        $("#DP").hide();
                        $("#IP").hide();
                        $("#CTS").show();
                        $("#RAA").hide();
                        $("#INV").hide();
                        $("#AO").hide();
                      }
                      else if(this.value == 7){
                        $("#TLP").hide();
                        $("#GR").hide();
                        $("#DISC").hide();
                        $("#DP").hide();
                        $("#IP").hide();
                        $("#CTS").hide();
                        $("#RAA").show();
                        $("#INV").hide();
                        $("#AO").hide();
                      }
                      else if(this.value == 8){
                        $("#TLP").hide();
                        $("#GR").hide();
                        $("#DISC").hide();
                        $("#DP").hide();
                        $("#IP").hide();
                        $("#CTS").hide();
                        $("#RAA").hide();
                        $("#INV").show();
                        $("#AO").hide();
                      }
                      else if(this.value == 9){
                        $("#TLP").hide();
                        $("#GR").hide();
                        $("#DISC").hide();
                        $("#DP").hide();
                        $("#IP").hide();
                        $("#CTS").hide();
                        $("#RAA").hide();
                        $("#INV").hide();
                        $("#AO").show();
                      }else{
                          $("#TLP").hide();
                          $("#GR").hide();
                          $("#DISC").hide();
                          $("#DP").hide();
                          $("#IP").hide();
                          $("#CTS").hide();
                          $("#RAA").hide();
                          $("#INV").hide();
                          $("#AO").hide();
                      }
                    });
                    
                    $("#raa1").hide();
                    $("#raa2").hide();
                    $("#raa3").hide();
                    $("#raa4").hide();
                    $("#raa5").hide();
                    $("#raa6").hide();
                    $("#raa7").hide();
                    $("#raa8").hide();
                    $("#raa9").hide();
                    $("#raa10").hide();
                    $("#sraa").on("change", function() {
                        if(this.value == 0){
                            $("#raa1").show();
                            $("#raa2").hide();
                            $("#raa3").hide();
                            $("#raa4").hide();
                            $("#raa5").hide();
                            $("#raa6").hide();
                            $("#raa7").hide();
                            $("#raa8").hide();
                            $("#raa9").hide();
                            $("#raa10").hide();
                        }
                        else if(this.value == 1){
                            $("#raa1").hide();
                            $("#raa2").show();
                            $("#raa3").hide();
                            $("#raa4").hide();
                            $("#raa5").hide();
                            $("#raa6").hide();
                            $("#raa7").hide();
                            $("#raa8").hide();
                            $("#raa9").hide();
                            $("#raa10").hide();
                        }
                        else if(this.value == 2){
                            $("#raa1").hide();
                            $("#raa2").hide();
                            $("#raa3").show();
                            $("#raa4").hide();
                            $("#raa5").hide();
                            $("#raa6").hide();
                            $("#raa7").hide();
                            $("#raa8").hide();
                            $("#raa9").hide();
                            $("#raa10").hide();
                        }
                        else if(this.value == 3){
                            $("#raa1").hide();
                            $("#raa2").hide();
                            $("#raa3").hide();
                            $("#raa4").show();
                            $("#raa5").hide();
                            $("#raa6").hide();
                            $("#raa7").hide();
                            $("#raa8").hide();
                            $("#raa9").hide();
                            $("#raa10").hide();
                        }
                        else if(this.value == 4){
                            $("#raa1").hide();
                            $("#raa2").hide();
                            $("#raa3").hide();
                            $("#raa4").hide();
                            $("#raa5").show();
                            $("#raa6").hide();
                            $("#raa7").hide();
                            $("#raa8").hide();
                            $("#raa9").hide();
                            $("#raa10").hide();
                        }
                        else if(this.value == 5){
                            $("#raa1").hide();
                            $("#raa2").hide();
                            $("#raa3").hide();
                            $("#raa4").hide();
                            $("#raa5").hide();
                            $("#raa6").show();
                            $("#raa7").hide();
                            $("#raa8").hide();
                            $("#raa9").hide();
                            $("#raa10").hide();
                        }
                        else if(this.value == 6){
                            $("#raa1").hide();
                            $("#raa2").hide();
                            $("#raa3").hide();
                            $("#raa4").hide();
                            $("#raa5").hide();
                            $("#raa6").hide();
                            $("#raa7").show();
                            $("#raa8").hide();
                            $("#raa9").hide();
                            $("#raa10").hide();
                        }
                        else if(this.value == 7){
                            $("#raa1").hide();
                            $("#raa2").hide();
                            $("#raa3").hide();
                            $("#raa4").hide();
                            $("#raa5").hide();
                            $("#raa6").hide();
                            $("#raa7").hide();
                            $("#raa8").show();
                            $("#raa9").hide();
                            $("#raa10").hide();
                        }
                        else if(this.value == 8){
                            $("#raa1").hide();
                            $("#raa2").hide();
                            $("#raa3").hide();
                            $("#raa4").hide();
                            $("#raa5").hide();
                            $("#raa6").hide();
                            $("#raa7").hide();
                            $("#raa8").hide();
                            $("#raa9").show();
                            $("#raa10").hide();
                        }
                        else if(this.value == 9){
                            $("#raa1").hide();
                            $("#raa2").hide();
                            $("#raa3").hide();
                            $("#raa4").hide();
                            $("#raa5").hide();
                            $("#raa6").hide();
                            $("#raa7").hide();
                            $("#raa8").hide();
                            $("#raa9").hide();
                            $("#raa10").show();
                        }
                        else{
                            $("#raa1").hide();
                            $("#raa2").hide();
                            $("#raa3").hide();
                            $("#raa4").hide();
                            $("#raa5").hide();
                            $("#raa6").hide();
                            $("#raa7").hide();
                            $("#raa8").hide();
                            $("#raa9").hide();
                            $("#raa10").hide();
                        }
                    });
                </script>
                </div>
            </div>
            <div class="col-lg m-2 p-2 shadow p-3 mb-1 bg-body rounded border border border-light">
              <div class="form-group">
                <p class="form-control"> Unlocked Activity </p>
                    <form method="POST" action="" class="p-2" enctype="multipart/form-data">
                    <table class="table table-hover" id="table22">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Criteria</th>
                      <th scope="col">Element</th>
                      <th scope="col">Handle</th>
                    </tr>
                  </thead>
                   <tbody>';
                   $i=1;
                   $a=$_SESSION["id"];

                $sql = "SELECT * FROM TLP WHERE id='".$a."'";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        if($row["locked"]==0){
                            echo ' <tr>
                                <th scope="row">'.$i.'</th>
                                <td>TLP</td>
                                <td>'.$row["subject"].'</td>
                                <td><!-- Button trigger modal -->
                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#TLP'.$row["subject"].'">EDIT</button>
                                <button type="submit" name="lock" value="'.$row["subject"].'_subject_TLP" class="btn btn-sm btn-success">Lock</button>
                                <button type="submit" name="del" value="'.$row["subject"].'_subject_TLP" class="btn btn-sm btn-danger">Del</button></td>
                            </tr>
                            <!-- Modal -->
                            <div class="modal fade" id="TLP'.$row["subject"].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalCenterTitle">Edit Details</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="" class="p-2" enctype="multipart/form-data">
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
                                        <input type="number" min="0" value="'.$row["scheduleClass"].'" class="form-control" id="schedule" name="scheduleClass">
                                    </div>
                                    <div class="form-group p-2">
                                        <label for="actual">No. of actual classes</label>
                                        <input type="number" min="0" value="'.$row["actualClass"].'" class="form-control" id="actual" name="actualClass">
                                    </div>
                                    <div class="form-group p-2">
                                        <label for="attach">Attachment &nbsp;
                                        <a href="../document/'.$a.'/'.$row["attachment"].'" target="_blank" >View</a></label>
                                        <input type="file" accept="application/pdf" class="form-control" id="attach" name="attachment">
                                    </div>';
                                    if($row["comment"]!=""){
                                        echo'
                                        <div class="form-group p-2">
                                            <label for="sub">Comment</label>
                                            <input type="text" class="form-control" value="'.$row["comment"].'" id="comment" name="comment" readonly>
                                        </div>';
                                    }
                                    echo'
                                    <button type="submit" name="editTLP" value="'.$row["subject"].'" class="btn btn-sm btn-primary p-2">Save</button>
                                    </form>
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

                $sql = "SELECT * FROM GR WHERE id='".$a."'";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    
                    while($row = mysqli_fetch_assoc($result)) {
                        if($row["locked"]==0){
                            echo ' <tr>
                                <th scope="row">'.$i.'</th>
                                <td>GR</td>
                                <td>'.$row["subject"].'</td>
                                <td><!-- Button trigger modal -->
                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#GR'.$row["subject"].'">EDIT</button>
                                <button type="submit" name="lock" value="'.$row["subject"].'_subject_GR" class="btn btn-sm btn-success">Lock</button>
                                <button type="submit" name="del" value="'.$row["subject"].'_subject_GR" class="btn btn-sm btn-danger">Del</button></td>
                            </tr>
                            <!-- Modal -->
                            <div class="modal fade" id="GR'.$row["subject"].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                                        <label for="y">Academic Year</label>
                                        <input type="text" class="form-control" id="y" value="'.$row["year"].'" name="year">
                                    </div>
                                    <div class="form-group p-2">
                                        <label for="rI">Result of subject (Institute)</label>
                                        <input type="number" min="0" max="100" class="form-control" value="'.$row["resultInstitute"].'" id="rI" name="resultInstitute" step="0.01">
                                    </div>
                                    <div class="form-group p-2">
                                        <label for="rG">Result of GTU</label>
                                        <input type="number" min="0" max="100" class="form-control" value="'.$row["resultGtu"].'" id="rG" name="resultGtu" step="0.01">
                                    </div>
                                    <div class="form-group p-2">
                                        <label for="attach">Attachment &nbsp; 
                                        <a href="../document/'.$a.'/'.$row["attachment"].'" target="_blank" >View</a></label>
                                        <input type="file" accept="application/pdf" class="form-control" id="attach" name="attachment">
                                    </div>
                                    ';
                                    if($row["comment"]!=""){
                                        echo'
                                        <div class="form-group p-2">
                                            <label for="sub">Comment</label>
                                            <input type="text" class="form-control" value="'.$row["comment"].'" id="comment" name="comment" readonly>
                                        </div>';
                                    }

                                    echo'
                                    <button type="submit" name="editGR" value="'.$row["subject"].'" class="btn btn-sm btn-primary p-2">Submit</button>
                                    </form>
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

                $sql = "SELECT * FROM DISC WHERE id='".$a."'";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    
                    while($row = mysqli_fetch_assoc($result)) {
                        if($row["locked"]==0){
                            echo ' <tr>
                                <th scope="row">'.$i.'</th>
                                <td>DISC</td>
                                <td>'.$row["id"].'</td>
                                <td><!-- Button trigger modal -->
                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#DISC'.$row["id"].'">EDIT</button>
                                <button type="submit" name="lock" value="DISC" class="btn btn-sm btn-success">Lock</button>
                                <button type="submit" name="del" value="DISC" class="btn btn-sm btn-danger">Del</button></td>
                            </tr>
                            <!-- Modal -->
                            <div class="modal fade" id="DISC'.$row["id"].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                                        <label for="subC">Id</label>
                                        <input type="text" class="form-control" value="'.$row["id"].'" id="subC" name="subCode" readonly>
                                    </div>
                                    <div class="form-group p-2">
                                        <label for="subN">No of times Late Punch</label>
                                        <input type="number" min="0" max="100" value="'.$row["TLP"].'" class="form-control" id="nooftlp" name="nooftlp" required>
                                    </div>
                                    <div class="form-group p-2">
                                        <label for="subN">No. of LWP</label>
                                        <input type="number" min="0" max="100" value="'.$row["LWP"].'" class="form-control" id="nooflwp" name="nooflwp" required>
                                    </div>
                                    <div class="form-group p-2">
                                        <label for="subN">No. of Balanced leave</label>
                                        <input type="number" min="0" max="5" class="form-control" value="'.$row["BL"].'" id="noofbl" name="noofbl" required>
                                    </div>
                                    <div class="form-group p-2">
                                        <label for="subN">No .of memo/justification/clarification</label>
                                        <input type="number" min="0" max="100" class="form-control" value="'.$row["MJC"].'" id="noofm" name="noofm" required>
                                    </div>
                                    <div class="form-group p-2">
                                        <label for="subN">No .of Fine</label>
                                        <input type="number" min="0" max="100" value="'.$row["F"].'" class="form-control" id="nooff" name="nooff" required>
                                    </div>
                                    ';
                                    if($row["comment"]!=""){
                                        echo'
                                        <div class="form-group p-2">
                                            <label for="sub">Comment</label>
                                            <input type="text" class="form-control" value="'.$row["comment"].'" id="comment" name="comment" readonly>
                                        </div>';
                                    }

                                    echo'
                                    <button type="submit" name="editDISC" value="'.$row["id"].'" class="btn btn-sm btn-primary p-2">Submit</button>
                                    </form>
                                </div>
                                </div>
                            </div>
                            </div>
                            ';
                            $i=$i+1;
                        }
                    }
                    
                } else {
                    //DISC no entry.
                }

                $sql = "SELECT * FROM DP WHERE id='".$a."'";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        if($row["locked"]==0){
                            echo ' <tr>
                                <th scope="row">'.$i.'</th>
                                <td>DP</td>
                                <td>'.$row["name"].'</td>
                                <td><!-- Button trigger modal -->
                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#DP'.$row["name"].'">EDIT</button>
                                <button type="submit" name="lock" value="'.$row["name"].'_name_DP" class="btn btn-sm btn-success">Lock</button>
                                <button type="submit" name="del" value="'.$row["name"].'_name_DP" class="btn btn-sm btn-danger">Del</button></td>
                            </tr>
                            <!-- Modal -->
                            <div class="modal fade" id="DP'.$row["name"].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalCenterTitle">Edit Details</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="" class="p-2" enctype="multipart/form-data">
                                    <hr>
                                    <div class="form-group p-2">
                                        <label for="sub">Subject Code</label>
                                        <input type="text" class="form-control" value="'.$row["name"].'" id="sub" name="port" readonly>
                                    </div>
                                    <div class="form-group p-2">
                                        <label for="sem">Role</label>
                                        <select class="form-control" name="role" id="role">
                                            ';
                                            if($row["role"]=="coordinator"){
                                                echo'
                                                <option value="1" selected>Co-ordinator</option>
                                                <option value="2">cocooordinator</option>
                                                <option value="3">member</option>';
                                            }
                                            elseif($row["role"]=="cocooordinator"){
                                                echo'
                                                <option value="1">Co-ordinator</option>
                                                <option value="2" selected>cocooordinator</option>
                                                <option value="3">member</option>';
                                            }
                                            elseif($row["role"]=="member"){
                                                echo'
                                                <option value="1">Co-ordinator</option>
                                                <option value="2">cocooordinator</option>
                                                <option value="3" selected>member</option>';
                                            }
                                            
                                            echo'
                                        </select>
                                    </div>
                                    <div class="form-group p-2">
                                        <label for="sem">Duration</label>
                                        <select class="form-control" name="duration" id="duration">
                                            ';
                                            if($row["duration"]=="1year"){
                                                echo'
                                                <option value="1" selected>1 year</option>
                                                <option value="2">6 month</option>';
                                            }
                                            elseif($row["duration"]=="6month"){
                                                echo'
                                                <option value="1">1 year</option>
                                                <option value="2" selected>6 month</option>';
                                            }
                                            
                                            echo'
                                        </select>
                                    </div>
                                    <div class="form-group p-2">
                                        <label for="attach">Attachment &nbsp;
                                        <a href="../document/'.$a.'/'.$row["attachment"].'" target="_blank" >View</a></label>
                                        <input type="file" accept="application/pdf" class="form-control" id="attach" name="attachment">
                                    </div>';
                                    if($row["comment"]!=""){
                                        echo'
                                        <div class="form-group p-2">
                                            <label for="sub">Comment</label>
                                            <input type="text" class="form-control" value="'.$row["comment"].'" id="comment" name="comment" readonly>
                                        </div>';
                                    }
                                    echo'
                                    <button type="submit" name="editDP" value="'.$row["name"].'" class="btn btn-sm btn-primary p-2">Save</button>
                                    </form>
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

                $sql = "SELECT * FROM IP WHERE id='".$a."'";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        if($row["locked"]==0){
                            echo ' <tr>
                                <th scope="row">'.$i.'</th>
                                <td>IP</td>
                                <td>'.$row["name"].'</td>
                                <td><!-- Button trigger modal -->
                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#IP'.$row["name"].'">EDIT</button>
                                <button type="submit" name="lock" value="'.$row["name"].'_name_IP" class="btn btn-sm btn-success">Lock</button>
                                <button type="submit" name="del" value="'.$row["name"].'_name_IP" class="btn btn-sm btn-danger">Del</button></td>
                            </tr>
                            <!-- Modal -->
                            <div class="modal fade" id="IP'.$row["name"].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalCenterTitle">Edit Details</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="" class="p-2" enctype="multipart/form-data">
                                    <hr>
                                    <div class="form-group p-2">
                                        <label for="sub">Portfolio Name</label>
                                        <input type="text" class="form-control" value="'.$row["name"].'" id="sub" name="port" readonly>
                                    </div>
                                    <div class="form-group p-2">
                                        <label for="sem">Role</label>
                                        <select class="form-control" name="role" id="role">
                                            ';
                                            if($row["role"]=="coordinator"){
                                                echo'
                                                <option value="1" selected>Co-ordinator</option>
                                                <option value="2">cocooordinator</option>
                                                <option value="3">member</option>';
                                            }
                                            elseif($row["role"]=="cocooordinator"){
                                                echo'
                                                <option value="1">Co-ordinator</option>
                                                <option value="2" selected>cocooordinator</option>
                                                <option value="3">member</option>';
                                            }
                                            elseif($row["role"]=="member"){
                                                echo'
                                                <option value="1">Co-ordinator</option>
                                                <option value="2">cocooordinator</option>
                                                <option value="3" selected>member</option>';
                                            }
                                            
                                            echo'
                                        </select>
                                    </div>
                                    <div class="form-group p-2">
                                        <label for="sem">Duration</label>
                                        <select class="form-control" name="duration" id="duration">
                                            ';
                                            if($row["duration"]=="1year"){
                                                echo'
                                                <option value="1" selected>1 year</option>
                                                <option value="2">6 month</option>';
                                            }
                                            elseif($row["duration"]=="6month"){
                                                echo'
                                                <option value="1">1 year</option>
                                                <option value="2" selected>6 month</option>';
                                            }
                                            
                                            echo'
                                        </select>
                                    </div>
                                    <div class="form-group p-2">
                                        <label for="attach">Attachment &nbsp;
                                        <a href="../document/'.$a.'/'.$row["attachment"].'" target="_blank" >View</a></label>
                                        <input type="file" accept="application/pdf" class="form-control" id="attach" name="attachment">
                                    </div>';
                                    if($row["comment"]!=""){
                                        echo'
                                        <div class="form-group p-2">
                                            <label for="sub">Comment</label>
                                            <input type="text" class="form-control" value="'.$row["comment"].'" id="comment" name="comment" readonly>
                                        </div>';
                                    }
                                    echo'
                                    <button type="submit" name="editIP" value="'.$row["name"].'" class="btn btn-sm btn-primary p-2">Save</button>
                                    </form>
                                </div>
                                </div>
                            </div>
                            </div>
                            ';
                            $i=$i+1;
                        }
                    }
                    
                } else {
                    //ip no entry.
                }

                $sql = "SELECT * FROM CTS WHERE id='".$a."'";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    
                    while($row = mysqli_fetch_assoc($result)) {
                        if($row["locked"]==0){
                            echo ' <tr>
                                <th scope="row">'.$i.'</th>
                                <td>CTS</td>
                                <td>'.$row["date"].'</td>
                                <td><!-- Button trigger modal -->
                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#CTS'.$row["date"].'">EDIT</button>
                                <button type="submit" name="lock" value="'.$row["date"].'_date_CTS" class="btn btn-sm btn-success">Lock</button>
                                <button type="submit" name="del" value="'.$row["date"].'_date_CTS" class="btn btn-sm btn-danger">Del</button></td>
                            </tr>
                            <!-- Modal -->
                            <div class="modal fade" id="CTS'.$row["date"].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                                        <input type="text" class="form-control" value="'.$row["activity"].'" id="subN" name="activity">
                                    </div>
                                    <div class="form-group p-2">
                                        <label for="attach">Attachment &nbsp; 
                                        <a href="../document/'.$a.'/'.$row["attachment"].'" target="_blank" >View</a></label>
                                        <input type="file" accept="application/pdf" class="form-control" id="attach" name="attachment">
                                    </div>
                                    ';
                                    if($row["comment"]!=""){
                                        echo'
                                        <div class="form-group p-2">
                                            <label for="sub">Comment</label>
                                            <input type="text" class="form-control" value="'.$row["comment"].'" id="comment" name="comment" readonly>
                                        </div>';
                                    }

                                    echo'
                                    <button type="submit" name="editCTS" value="'.$row["date"].'" class="btn btn-sm btn-primary p-2">Submit</button>
                                    </form>
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

                $sql = "SELECT * FROM RAA1 WHERE id='".$a."'";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    
                    while($row = mysqli_fetch_assoc($result)) {
                        if($row["locked"]==0){
                            echo ' <tr>
                                <th scope="row">'.$i.'</th>
                                <td>RAA1</td>
                                <td>'.$row["date"].'</td>
                                <td><!-- Button trigger modal -->
                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#RAA1'.$row["date"].'">EDIT</button>
                                <button type="submit" name="lock" value="'.$row["date"].'_date_RAA1" class="btn btn-sm btn-success">Lock</button>
                                <button type="submit" name="del" value="'.$row["date"].'_date_RAA1" class="btn btn-sm btn-danger">Del</button></td>
                            </tr>
                            <!-- Modal -->
                            <div class="modal fade" id="RAA1'.$row["date"].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                                        <label for="subN">Activity</label>
                                        <input type="text" class="form-control" value="'.$row["name"].'" id="subN" name="name">
                                    </div>
                                    <div class="form-group p-2">
                                        <label for="sem">For</label>
                                        <select class="form-control" name="for" id="for">
                                            ';
                                            
                                            if($row["considering"]=="Students"){
                                                echo'
                                                <option value="0">Select One</option>
                                                <option value="1" selected>Students</option>
                                                <option value="2">Faculty</option>';
                                            }
                                            elseif($row["considering"]=="Faculty"){
                                                echo'
                                                <option value="0">Select One</option>
                                                <option value="1">Students</option>
                                                <option value="2" selected>Faculty</option>';
                                            }
                                    echo'
                                        </select>
                                    </div>
                                    <div class="form-group p-2">
                                        <label for="subN">No of participants</label>
                                        <input type="number" min="0" class="form-control" id="nop" name="nop" value="'.$row["participants"].'" required>
                                    </div>
                                    <div class="form-group p-2">
                                        <label for="sem">Level of Institute</label>
                                        <select class="form-control" name="role" id="role">
                                            ';
                                            
                                            if($row["role"]=="Coordinator"){
                                                echo'
                                                <option value="0">Select One</option>
                                                <option value="1" selected>Coordinator</option>
                                                <option value="2">Co-coordinator</option>>';
                                            }
                                            elseif($row["role"]=="Co-coordinator"){
                                                echo'
                                                <option value="0">Select One</option>
                                                <option value="1">Coordinator</option>
                                                <option value="2" selected>Co-coordinator</option>';
                                            }
                                    echo'
                                        </select>
                                    </div>
                                    <div class="form-group p-2">
                                        <label for="attach">Attachment &nbsp; 
                                        <a href="../document/'.$a.'/'.$row["attachment"].'" target="_blank" >View</a></label>
                                        <input type="file" accept="application/pdf" class="form-control" id="attach" name="attachment">
                                    </div>
                                    ';
                                    if($row["comment"]!=""){
                                        echo'
                                        <div class="form-group p-2">
                                            <label for="sub">Comment</label>
                                            <input type="text" class="form-control" value="'.$row["comment"].'" id="comment" name="comment" readonly>
                                        </div>';
                                    }

                                    echo'
                                    <button type="submit" name="editRAA1" value="'.$row["date"].'" class="btn btn-sm btn-primary p-2">Submit</button>
                                    </form>
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

                $sql = "SELECT * FROM RAA2 WHERE id='".$a."'";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    
                    while($row = mysqli_fetch_assoc($result)) {
                        if($row["locked"]==0){
                            echo ' <tr>
                                <th scope="row">'.$i.'</th>
                                <td>RAA2</td>
                                <td>'.$row["date"].'</td>
                                <td><!-- Button trigger modal -->
                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#RAA2'.$row["date"].'">EDIT</button>
                                <button type="submit" name="lock" value="'.$row["date"].'_date_RAA2" class="btn btn-sm btn-success">Lock</button>
                                <button type="submit" name="del" value="'.$row["date"].'_date_RAA2" class="btn btn-sm btn-danger">Del</button></td>
                            </tr>
                            <!-- Modal -->
                            <div class="modal fade" id="RAA2'.$row["date"].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                                        <label for="subN">Title</label>
                                        <input type="text" class="form-control" value="'.$row["title"].'" id="subN" name="title">
                                    </div>
                                    <div class="form-group p-2">
                                        <label for="subN">Place</label>
                                        <input type="text" class="form-control" value="'.$row["place"].'" id="subN" name="place">
                                    </div>
                                    <div class="form-group p-2">
                                        <label for="subN">Sponsoring Agency</label>
                                        <input type="text" class="form-control" value="'.$row["sponsoring_agency"].'" id="subN" name="sa">
                                    </div>
                                    <div class="form-group p-2">
                                        <label for="subN">No of participants</label>
                                        <input type="number" min="0" class="form-control" id="nop" name="nop" value="'.$row["participants"].'" required>
                                    </div>
                                    <div class="form-group p-2">
                                        <label for="subN">No of days</label>
                                        <input type="number" min="0" max="10" class="form-control" id="nop" name="nod" value="'.$row["days"].'" required>
                                    </div>
                                    <div class="form-group p-2">
                                        <label for="attach">Attachment &nbsp; 
                                        <a href="../document/'.$a.'/'.$row["attachment"].'" target="_blank" >View</a></label>
                                        <input type="file" accept="application/pdf" class="form-control" id="attach" name="attachment">
                                    </div>
                                    ';
                                    if($row["comment"]!=""){
                                        echo'
                                        <div class="form-group p-2">
                                            <label for="sub">Comment</label>
                                            <input type="text" class="form-control" value="'.$row["comment"].'" id="comment" name="comment" readonly>
                                        </div>';
                                    }

                                    echo'
                                    <button type="submit" name="editRAA2" value="'.$row["date"].'" class="btn btn-sm btn-primary p-2">Submit</button>
                                    </form>
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

                $sql = "SELECT * FROM RAA3 WHERE id='".$a."'";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    
                    while($row = mysqli_fetch_assoc($result)) {
                        if($row["locked"]==0){
                            echo ' <tr>
                                <th scope="row">'.$i.'</th>
                                <td>RAA3</td>
                                <td>'.$row["date"].'</td>
                                <td><!-- Button trigger modal -->
                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#RAA3'.$row["date"].'">EDIT</button>
                                <button type="submit" name="lock" value="'.$row["date"].'_date_RAA3" class="btn btn-sm btn-success">Lock</button>
                                <button type="submit" name="del" value="'.$row["date"].'_date_RAA3" class="btn btn-sm btn-danger">Del</button></td>
                            </tr>
                            <!-- Modal -->
                            <div class="modal fade" id="RAA3'.$row["date"].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                                        <label for="subN">Name of course</label>
                                        <input type="text" class="form-control" value="'.$row["name"].'" id="subN" name="name">
                                    </div>
                                    <div class="form-group p-2">
                                        <label for="subN">Date of examination</label>
                                        <input type="date" class="form-control" max="'.date('Y-m-d').'" value="'.$row["date_of_examination"].'" id="subN" name="dateoe">
                                    </div>
                                    <div class="form-group p-2">
                                        <label for="subN">Duration</label>
                                        <input type="number" min="0" max="8" class="form-control" id="nop" name="nop" value="'.$row["duration"].'" required>
                                    </div>
                                    <div class="form-group p-2">
                                        <label for="attach">Attachment &nbsp; 
                                        <a href="../document/'.$a.'/'.$row["attachment"].'" target="_blank" >View</a></label>
                                        <input type="file" accept="application/pdf" class="form-control" id="attach" name="attachment">
                                    </div>
                                    ';
                                    if($row["comment"]!=""){
                                        echo'
                                        <div class="form-group p-2">
                                            <label for="sub">Comment</label>
                                            <input type="text" class="form-control" value="'.$row["comment"].'" id="comment" name="comment" readonly>
                                        </div>';
                                    }

                                    echo'
                                    <button type="submit" name="editRAA3" value="'.$row["date"].'" class="btn btn-sm btn-primary p-2">Submit</button>
                                    </form>
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

                $sql = "SELECT * FROM RAA4 WHERE id='".$a."'";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    
                    while($row = mysqli_fetch_assoc($result)) {
                        if($row["locked"]==0){
                            echo ' <tr>
                                <th scope="row">'.$i.'</th>
                                <td>RAA4</td>
                                <td>'.$row["date"].'</td>
                                <td><!-- Button trigger modal -->
                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#RAA4'.$row["date"].'">EDIT</button>
                                <button type="submit" name="lock" value="'.$row["date"].'_date_RAA4" class="btn btn-sm btn-success">Lock</button>
                                <button type="submit" name="del" value="'.$row["date"].'_date_RAA4" class="btn btn-sm btn-danger">Del</button></td>
                            </tr>
                            <!-- Modal -->
                            <div class="modal fade" id="RAA4'.$row["date"].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                                        <label for="subN">Activity</label>
                                        <input type="text" class="form-control" value="'.$row["name"].'" id="subN" name="name">
                                    </div>
                                    <div class="form-group p-2">
                                        <label for="sem">For</label>
                                        <select class="form-control" name="type" id="for">
                                            ';
                                            
                                            if($row["type"]=="National"){
                                                echo'
                                                <option value="0">Select One</option>
                                                <option value="1" selected>National</option>
                                                <option value="2">International</option>';
                                            }
                                            elseif($row["type"]=="International"){
                                                echo'
                                                <option value="0">Select One</option>
                                                <option value="1">National</option>
                                                <option value="2" selected>International</option>';
                                            }
                                    echo'
                                        </select>
                                    </div>
                                    <div class="form-group p-2">
                                        <label for="subN">Membership Number</label>
                                        <input type="number" min="0" class="form-control" id="nom" name="nom" value="'.$row["membership"].'" required>
                                    </div>
                                    <div class="form-group p-2">
                                        <label for="attach">Attachment &nbsp; 
                                        <a href="../document/'.$a.'/'.$row["attachment"].'" target="_blank" >View</a></label>
                                        <input type="file" accept="application/pdf" class="form-control" id="attach" name="attachment">
                                    </div>
                                    ';
                                    if($row["comment"]!=""){
                                        echo'
                                        <div class="form-group p-2">
                                            <label for="sub">Comment</label>
                                            <input type="text" class="form-control" value="'.$row["comment"].'" id="comment" name="comment" readonly>
                                        </div>';
                                    }

                                    echo'
                                    <button type="submit" name="editRAA4" value="'.$row["date"].'" class="btn btn-sm btn-primary p-2">Submit</button>
                                    </form>
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

                $sql = "SELECT * FROM RAA5 WHERE id='".$a."'";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    
                    while($row = mysqli_fetch_assoc($result)) {
                        if($row["locked"]==0){
                            echo ' <tr>
                                <th scope="row">'.$i.'</th>
                                <td>RAA5</td>
                                <td>'.$row["name"].'</td>
                                <td><!-- Button trigger modal -->
                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#RAA5'.$row["name"].'">EDIT</button>
                                <button type="submit" name="lock" value="'.$row["name"].'_name_RAA5" class="btn btn-sm btn-success">Lock</button>
                                <button type="submit" name="del" value="'.$row["name"].'_name_RAA5" class="btn btn-sm btn-danger">Del</button></td>
                            </tr>
                            <!-- Modal -->
                            <div class="modal fade" id="RAA5'.$row["name"].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                                        <input type="text" class="form-control" value="'.$row["name"].'" id="subC" name="name" readonly>
                                    </div>
                                    <div class="form-group p-2">
                                        <label for="subN">Activity</label>
                                        <input type="text" class="form-control" value="'.$row["title"].'" id="subN" name="title">
                                    </div>

                                    <div class="form-group p-2">
                                        <label for="sem">Indexing</label>
                                        <select class="form-control" name="index" id="index">
                                        ';
                                        if($row["indexing"]=="SCi"){
                                            echo'
                                            <option value="0">Select One</option>
                                            <option value="1" selected>SCi</option>
                                            <option value="2">Scoupus</option>
                                            <option value="3">UGC</option>
                                            <option value="4">IJET</option>';
                                        }
                                        elseif($row["indexing"]=="Scoupus"){
                                            echo'
                                            <option value="0">Select One</option>
                                            <option value="1">SCi</option>
                                            <option value="2" selected>Scoupus</option>
                                            <option value="3">UGC</option>
                                            <option value="4">IJET</option>';
                                        }
                                        elseif($row["indexing"]=="UGC"){
                                            echo'
                                            <option value="0">Select One</option>
                                            <option value="1">SCi</option>
                                            <option value="2">Scoupus</option>
                                            <option value="3" selected>UGC</option>
                                            <option value="4">IJET</option>';
                                        }
                                        elseif($row["indexing"]=="IJET"){
                                            echo'
                                            <option value="0">Select One</option>
                                            <option value="1">SCi</option>
                                            <option value="2">Scoupus</option>
                                            <option value="3">UGC</option>
                                            <option value="4" selected>IJET</option>';
                                        }
                                    echo'
                                        </select>
                                    </div>
                                    <div class="form-group p-2">
                                        <label for="subN">ISSN no</label>
                                        <input type="text" class="form-control" id="issn" name="issn" value="'.$row["issn"].'" required>
                                    </div>
                                    <div class="form-group p-2">
                                        <label for="subN">Journal name</label>
                                        <input type="text" class="form-control" id="journal" name="journal" value="'.$row["journal"].'" required>
                                    </div>
                                    <div class="form-group p-2">
                                        <label for="subN">Volumn page</label>
                                        <input type="text" class="form-control" id="vpage" name="vpage" value="'.$row["vpage"].'" required>
                                    </div>
                                    <div class="form-group p-2">
                                        <label for="attach">Attachment &nbsp; 
                                        <a href="../document/'.$a.'/'.$row["attachment"].'" target="_blank" >View</a></label>
                                        <input type="file" accept="application/pdf" class="form-control" id="attach" name="attachment">
                                    </div>
                                    ';
                                    if($row["comment"]!=""){
                                        echo'
                                        <div class="form-group p-2">
                                            <label for="sub">Comment</label>
                                            <input type="text" class="form-control" value="'.$row["comment"].'" id="comment" name="comment" readonly>
                                        </div>';
                                    }

                                    echo'
                                    <button type="submit" name="editRAA5" value="'.$row["name"].'" class="btn btn-sm btn-primary p-2">Submit</button>
                                    </form>
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

                $sql = "SELECT * FROM RAA6 WHERE id='".$a."'";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    
                    while($row = mysqli_fetch_assoc($result)) {
                        if($row["locked"]==0){
                            echo ' <tr>
                                <th scope="row">'.$i.'</th>
                                <td>RAA6</td>
                                <td>'.$row["name"].'</td>
                                <td><!-- Button trigger modal -->
                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#RAA6'.$row["name"].'">EDIT</button>
                                <button type="submit" name="lock" value="'.$row["name"].'_name_RAA6" class="btn btn-sm btn-success">Lock</button>
                                <button type="submit" name="del" value="'.$row["name"].'_name_RAA6" class="btn btn-sm btn-danger">Del</button></td>
                            </tr>
                            <!-- Modal -->
                            <div class="modal fade" id="RAA6'.$row["name"].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                                        <input type="text" class="form-control" value="'.$row["name"].'" id="subC" name="name" readonly>
                                    </div>
                                    <div class="form-group p-2">
                                        <label for="subN">Publisher & Indexing</label>
                                        <input type="text" class="form-control" id="pi" value="'.$row["pi"].'" name="pi" required>
                                    </div>
                                    <div class="form-group p-2">
                                        <label for="subN">Name of conference,volumn,page</label>
                                        <input type="text" class="form-control" id="cvp" value="'.$row["cvp"].'" name="cvp" required>
                                    </div>

                                    <div class="form-group p-2">
                                        <label for="sem">Presented/Publish</label>
                                        <select class="form-control" name="pp" id="pp">
                                        ';
                                        if($row["pp"]=="Presented International"){
                                            echo'
                                            <option value="0">Select One</option>
                                            <option value="1" selected>Presented International</option>
                                            <option value="2">Presented National</option>
                                            <option value="3">Publish</option>';
                                        }
                                        elseif($row["pp"]=="Presented National"){
                                            echo'
                                            <option value="0">Select One</option>
                                            <option value="1">Presented International</option>
                                            <option value="2" selected>Presented National</option>
                                            <option value="3">Publish</option>';
                                        }
                                        elseif($row["pp"]=="Publish"){
                                            echo'
                                            <option value="0">Select One</option>
                                            <option value="1">Presented International</option>
                                            <option value="2">Presented National</option>
                                            <option value="3" selected>Publish</option>';
                                        }
                                    echo'
                                        </select>
                                    </div>
                                    <div class="form-group p-2">
                                        <label for="attach">Attachment &nbsp; 
                                        <a href="../document/'.$a.'/'.$row["attachment"].'" target="_blank" >View</a></label>
                                        <input type="file" accept="application/pdf" class="form-control" id="attach" name="attachment">
                                    </div>
                                    ';
                                    if($row["comment"]!=""){
                                        echo'
                                        <div class="form-group p-2">
                                            <label for="sub">Comment</label>
                                            <input type="text" class="form-control" value="'.$row["comment"].'" id="comment" name="comment" readonly>
                                        </div>';
                                    }

                                    echo'
                                    <button type="submit" name="editRAA6" value="'.$row["name"].'" class="btn btn-sm btn-primary p-2">Submit</button>
                                    </form>
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

                $sql = "SELECT * FROM RAA7 WHERE id='".$a."'";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    
                    while($row = mysqli_fetch_assoc($result)) {
                        if($row["locked"]==0){
                            echo ' <tr>
                                <th scope="row">'.$i.'</th>
                                <td>RAA7</td>
                                <td>'.$row["title"].'</td>
                                <td><!-- Button trigger modal -->
                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#RAA7'.$row["title"].'">EDIT</button>
                                <button type="submit" name="lock" value="'.$row["title"].'_title_RAA7" class="btn btn-sm btn-success">Lock</button>
                                <button type="submit" name="del" value="'.$row["title"].'_title_RAA7" class="btn btn-sm btn-danger">Del</button></td>
                            </tr>
                            <!-- Modal -->
                            <div class="modal fade" id="RAA7'.$row["title"].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                                        <input type="text" class="form-control" value="'.$row["title"].'" id="subC" name="title" readonly>
                                    </div>
                                    <div class="form-group p-2">
                                        <label for="subN">Year</label>
                                        <input type="text" class="form-control" id="year" name="year" value="'.$row["year"].'" required>
                                    </div>
                                    <div class="form-group p-2">
                                        <label for="subN">Authors</label>
                                        <input type="text" class="form-control" id="authors" name="authors" value="'.$row["authors"].'" required>
                                    </div>
                                    <div class="form-group p-2">
                                        <label for="sem">Publisher</label>
                                        <select class="form-control" name="pub" id="pub">
                                    ';
                                        if($row["publisher"]=="International Publisher"){
                                            echo'
                                            <option value="0">Select One</option>
                                            <option value="1" selected>International Publisher</option>
                                            <option value="2">National Publisher</option>
                                            <option value="3">chapter in edited book</option>
                                            <option value="4">editor of book by international publisher</option>
                                            <option value="5">editor of book by any publisher</option>';
                                        }
                                        elseif($row["publisher"]=="National Publisher"){
                                            echo'
                                            <option value="0">Select One</option>
                                            <option value="1">International Publisher</option>
                                            <option value="2" selected>National Publisher</option>
                                            <option value="3">chapter in edited book</option>
                                            <option value="4">editor of book by international publisher</option>
                                            <option value="5">editor of book by any publisher</option>';
                                        }
                                        elseif($row["publisher"]=="chapter in edited book"){
                                            echo'
                                            <option value="0">Select One</option>
                                            <option value="1">International Publisher</option>
                                            <option value="2">National Publisher</option>
                                            <option value="3" selected>chapter in edited book</option>
                                            <option value="4">editor of book by international publisher</option>
                                            <option value="5">editor of book by any publisher</option>';
                                        }
                                        elseif($row["publisher"]=="editor of book by international publisher"){
                                            echo'
                                            <option value="0">Select One</option>
                                            <option value="1">International Publisher</option>
                                            <option value="2">National Publisher</option>
                                            <option value="3">chapter in edited book</option>
                                            <option value="4" selected>editor of book by international publisher</option>
                                            <option value="5">editor of book by any publisher</option>';
                                        }
                                        elseif($row["publisher"]=="editor of book by any publisher"){
                                            echo'
                                            <option value="0">Select One</option>
                                            <option value="1">International Publisher</option>
                                            <option value="2">National Publisher</option>
                                            <option value="3">chapter in edited book</option>
                                            <option value="4">editor of book by international publisher</option>
                                            <option value="5" selected>editor of book by any publisher</option>';
                                        }
                                    echo'
                                        </select>
                                    </div>
                                    <div class="form-group p-2">
                                        <label for="attach">Attachment &nbsp; 
                                        <a href="../document/'.$a.'/'.$row["attachment"].'" target="_blank" >View</a></label>
                                        <input type="file" accept="application/pdf" class="form-control" id="attach" name="attachment">
                                    </div>
                                    ';
                                    if($row["comment"]!=""){
                                        echo'
                                        <div class="form-group p-2">
                                            <label for="sub">Comment</label>
                                            <input type="text" class="form-control" value="'.$row["comment"].'" id="comment" name="comment" readonly>
                                        </div>';
                                    }

                                    echo'
                                    <button type="submit" name="editRAA7" value="'.$row["title"].'" class="btn btn-sm btn-primary p-2">Submit</button>
                                    </form>
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

                $sql = "SELECT * FROM RAA8 WHERE id='".$a."'";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    
                    while($row = mysqli_fetch_assoc($result)) {
                        if($row["locked"]==0){
                            echo ' <tr>
                                <th scope="row">'.$i.'</th>
                                <td>RAA8</td>
                                <td>'.$row["subject"].'</td>
                                <td><!-- Button trigger modal -->
                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#RAA8'.$row["subject"].'">EDIT</button>
                                <button type="submit" name="lock" value="'.$row["subject"].'_subject_RAA8" class="btn btn-sm btn-success">Lock</button>
                                <button type="submit" name="del" value="'.$row["subject"].'_subject_RAA8" class="btn btn-sm btn-danger">Del</button></td>
                            </tr>
                            <!-- Modal -->
                            <div class="modal fade" id="RAA8'.$row["subject"].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                                        <input type="text" class="form-control" id="link" name="link" value="'.$row["link"].'" required>
                                    </div>
                                    <div class="form-group p-2">
                                        <label for="attach">Attachment &nbsp; 
                                        <a href="../document/'.$a.'/'.$row["attachment"].'" target="_blank" >View</a></label>
                                        <input type="file" accept="application/pdf" class="form-control" id="attach" name="attachment">
                                    </div>
                                    ';
                                    if($row["comment"]!=""){
                                        echo'
                                        <div class="form-group p-2">
                                            <label for="sub">Comment</label>
                                            <input type="text" class="form-control" value="'.$row["comment"].'" id="comment" name="comment" readonly>
                                        </div>';
                                    }

                                    echo'
                                    <button type="submit" name="editRAA8" value="'.$row["subject"].'" class="btn btn-sm btn-primary p-2">Submit</button>
                                    </form>
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

                $sql = "SELECT * FROM RAA9 WHERE id='".$a."'";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    
                    while($row = mysqli_fetch_assoc($result)) {
                        if($row["locked"]==0){
                            echo ' <tr>
                                <th scope="row">'.$i.'</th>
                                <td>RAA9</td>
                                <td>'.$row["id"].'</td>
                                <td><!-- Button trigger modal -->
                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#RAA9'.$row["id"].'">EDIT</button>
                                <button type="submit" name="lock" value="RAA9" class="btn btn-sm btn-success">Lock</button>
                                <button type="submit" name="del" value="RAA9" class="btn btn-sm btn-danger">Del</button></td>
                            </tr>
                            <!-- Modal -->
                            <div class="modal fade" id="RAA9'.$row["id"].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                                        <label for="sem">Option1</label>
                                        <select class="form-control" name="o1" id="o1">
                                    ';
                                        if($row["type"]=="International Grant"){
                                            echo'
                                            <option value="0">Select One</option>
                                            <option value="1" selected>International Grant</option>
                                            <option value="2">International Grant + Publish</option>
                                            <option value="3">National Grant</option>
                                            <option value="4">National Grant + Publish</option>';
                                        }
                                        elseif($row["type"]=="International Grant + Publish"){
                                            echo'
                                            <option value="0">Select One</option>
                                            <option value="1">International Grant</option>
                                            <option value="2" selected>International Grant + Publish</option>
                                            <option value="3">National Grant</option>
                                            <option value="4">National Grant + Publish</option>';
                                        }
                                        elseif($row["type"]=="National Grant"){
                                            echo'
                                            <option value="0">Select One</option>
                                            <option value="1" selected>International Grant</option>
                                            <option value="2">International Grant + Publish</option>
                                            <option value="3" selected>National Grant</option>
                                            <option value="4">National Grant + Publish</option>';
                                        }
                                        elseif($row["type"]=="National Grant + Publish"){
                                            echo'
                                            <option value="0">Select One</option>
                                            <option value="1" selected>International Grant</option>
                                            <option value="2">International Grant + Publish</option>
                                            <option value="3">National Grant</option>
                                            <option value="4" selected>National Grant + Publish</option>';
                                        }
                                    echo'
                                        </select>
                                    </div>
                                    <div class="form-group p-2">
                                        <label for="attach">Attachment &nbsp; 
                                        <a href="../document/'.$a.'/'.$row["attachment"].'" target="_blank" >View</a></label>
                                        <input type="file" accept="application/pdf" class="form-control" id="attach" name="attachment">
                                    </div>';
                                    if($row["comment"]!=""){
                                        echo'
                                        <div class="form-group p-2">
                                            <label for="sub">Comment</label>
                                            <input type="text" class="form-control" value="'.$row["comment"].'" id="comment" name="comment" readonly>
                                        </div>';
                                    }

                                    echo'
                                    <button type="submit" name="editRAA9" value="'.$row["id"].'" class="btn btn-sm btn-primary p-2">Submit</button>
                                    </form>
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

                $sql = "SELECT * FROM RAA10 WHERE id='".$a."'";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    
                    while($row = mysqli_fetch_assoc($result)) {
                        if($row["locked"]==0){
                            echo ' <tr>
                                <th scope="row">'.$i.'</th>
                                <td>RAA10</td>
                                <td>'.$row["name"].'</td>
                                <td><!-- Button trigger modal -->
                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#RAA10'.$row["name"].'">EDIT</button>
                                <button type="submit" name="lock" value="'.$row["name"].'_name_RAA10" class="btn btn-sm btn-success">Lock</button>
                                <button type="submit" name="del" value="'.$row["name"].'_name_RAA10" class="btn btn-sm btn-danger">Del</button></td>
                            </tr>
                            <!-- Modal -->
                            <div class="modal fade" id="RAA10'.$row["name"].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                                        <label for="subN">Name</label>
                                        <input type="text" class="form-control" id="subCode" name="subCode" value="'.$row["name"].'" readonly required>
                                    </div>
                                    <div class="form-group p-2">
                                        <label for="subN">No of candidate/team/group</label>
                                        <input type="number" min="0" class="form-control" id="noc" name="noc" value="'.$row["candidate"].'" required>
                                    </div>
                                    <div class="form-group p-2">
                                        <label for="subN">Name of University</label>
                                        <input type="text" class="form-control" id="name" name="nameou" value="'.$row["university"].'" required>
                                    </div>
                                    <div class="form-group p-2">
                                        <label for="attach">Attachment &nbsp; 
                                        <a href="../document/'.$a.'/'.$row["attachment"].'" target="_blank" >View</a></label>
                                        <input type="file" accept="application/pdf" class="form-control" id="attach" name="attachment">
                                    </div>
                                    ';
                                    if($row["comment"]!=""){
                                        echo'
                                        <div class="form-group p-2">
                                            <label for="sub">Comment</label>
                                            <input type="text" class="form-control" value="'.$row["comment"].'" id="comment" name="comment" readonly>
                                        </div>';
                                    }

                                    echo'
                                    <button type="submit" name="editRAA10" value="'.$row["name"].'" class="btn btn-sm btn-primary p-2">Submit</button>
                                    </form>
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
                
                $sql = "SELECT * FROM INV WHERE id='".$a."'";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    
                    while($row = mysqli_fetch_assoc($result)) {
                        if($row["locked"]==0){
                            echo ' <tr>
                                <th scope="row">'.$i.'</th>
                                <td>INV</td>
                                <td>'.$row["date"].'</td>
                                <td><!-- Button trigger modal -->
                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#INV'.$row["date"].'">EDIT</button>
                                <button type="submit" name="lock" value="'.$row["date"].'_date_INV" class="btn btn-sm btn-success">Lock</button>
                                <button type="submit" name="del" value="'.$row["date"].'_date_INV" class="btn btn-sm btn-danger">Del</button></td>
                            </tr>
                            <!-- Modal -->
                            <div class="modal fade" id="INV'.$row["date"].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                                        <input type="text" class="form-control" value="'.$row["name"].'" id="subN" name="nameIns">
                                    </div>
                                    <div class="form-group p-2">
                                        <label for="sem">Level of Institute</label>
                                        <select class="form-control" name="levelIns" id="sem">
                                            ';
                                            
                                            if($row["level"]=="international"){
                                                echo'
                                                <option value="1" selected>International</option>
                                                <option value="2">National</option>
                                                <option value="3">State/Uni/Local</option>';
                                            }
                                            elseif($row["level"]=="national"){
                                                echo'
                                                <option value="1">International</option>
                                                <option value="2" selected>National</option>
                                                <option value="3">State/Uni/Local</option>';
                                            }
                                            elseif($row["level"]=="local"){
                                                echo'
                                                <option value="1">International</option>
                                                <option value="2">National</option>
                                                <option value="3" selected>State/Uni/Local</option>';
                                            }
                                    echo'
                                        </select>
                                    </div>
                                    <div class="form-group p-2">
                                        <label for="y">Topic name/Type of work</label>
                                        <input type="text" class="form-control" id="topic" name="topic" value="'.$row["topic"].'" required>
                                    </div>
                                    <div class="form-group p-2">
                                        <label for="attach">Attachment &nbsp; 
                                        <a href="../document/'.$a.'/'.$row["attachment"].'" target="_blank" >View</a></label>
                                        <input type="file" accept="application/pdf" class="form-control" id="attach" name="attachment">
                                    </div>
                                    ';
                                    if($row["comment"]!=""){
                                        echo'
                                        <div class="form-group p-2">
                                            <label for="sub">Comment</label>
                                            <input type="text" class="form-control" value="'.$row["comment"].'" id="comment" name="comment" readonly>
                                        </div>';
                                    }

                                    echo'
                                    <button type="submit" name="editINV" value="'.$row["date"].'" class="btn btn-sm btn-primary p-2">Submit</button>
                                    </form>
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

                $sql = "SELECT * FROM AO WHERE id='".$a."'";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    
                    while($row = mysqli_fetch_assoc($result)) {
                        if($row["locked"]==0){
                            echo ' <tr>
                                <th scope="row">'.$i.'</th>
                                <td>AO</td>
                                <td>'.$row["title"].'</td>
                                <td><!-- Button trigger modal -->
                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#AO'.$row["title"].'">EDIT</button>
                                <button type="submit" name="lock" value="'.$row["title"].'_title_AO" class="btn btn-sm btn-success">Lock</button>
                                <button type="submit" name="del" value="'.$row["title"].'_title_AO" class="btn btn-sm btn-danger">Del</button></td>
                            </tr>
                            <!-- Modal -->
                            <div class="modal fade" id="AO'.$row["title"].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                                        <label for="subC">Title</label>
                                        <input type="text" class="form-control" value="'.$row["title"].'" id="title" name="title" readonly>
                                    </div>
                                    <div class="form-group p-2">
                                        <label for="attach">Attachment &nbsp; 
                                        <a href="../document/'.$a.'/'.$row["attachment"].'" target="_blank" >View</a></label>
                                        <input type="file" accept="application/pdf" class="form-control" id="attach" name="attachment">
                                    </div>
                                    ';
                                    if($row["comment"]!=""){
                                        echo'
                                        <div class="form-group p-2">
                                            <label for="sub">Comment</label>
                                            <input type="text" class="form-control" value="'.$row["comment"].'" id="comment" name="comment" readonly>
                                        </div>';
                                    }

                                    echo'
                                    <button type="submit" name="editAO" value="'.$row["title"].'" class="btn btn-sm btn-primary p-2">Submit</button>
                                    </form>
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
                
                echo'
                </form>
                </tbody>
                </table>
              </div>
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
        $(this).attr("data-bs-target",$(this).attr("data-bs-target").replace(/\@/g,\'-\'));
        $(this).attr("data-bs-target",$(this).attr("data-bs-target").replace(/\./g,\'-\'));
    })
    
    $(".modal").each(function(){
        $(this).attr("id",$(this).attr("id").replace(/\@/g,\'-\'));
        $(this).attr("id",$(this).attr("id").replace(/\./g,\'-\'));
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


$('#TLP').find('#sem').on('change', function() {
    if(this.value != '0'){
        let sem = this.value;
        let code = $('#TLP').find('#sub').val();
        let p1 = code+'/'+sem;
        if(code.length > 0){
            if(getName(p1) === undefined){
                $('#TLP').find('#subNameTLP').val('Invalid');
            }
            else{
                $('#TLP').find('#subNameTLP').val(getName(p1));
            }
        }
        else{
            $('#TLP').find('#subNameTLP').val('');
        }
    }
    else{
        $('#TLP').find('#subNameTLP').val('');

    }
});


$('#TLP').find('#sub').keyup(function() {
    console.log($(this).val());
    if($(this).val().length > 0){
        if($('#TLP').find('#sem').find(':selected').val()!= '0'){
            let sem = $('#TLP').find('#sem').find(':selected').val();
            let code = $(this).val();
            let p1 = code+'/'+sem;
            if(getName(p1) === undefined){
                $('#TLP').find('#subNameTLP').val('Invalid');
            }
            else{
                $('#TLP').find('#subNameTLP').val(getName(p1));
            }
        }
        else{
            $('#TLP').find('#subNameTLP').val('');
        }
    }
    else{
        $('#TLP').find('#subNameTLP').val('');
    }
});

$('#GR').find('#semGR').on('change', function() {
    if(this.value != '0'){
        let sem = this.value;
        let code = $('#GR').find('#subC').val();
        let p1 = code+'/'+sem;
        if(code.length > 0){
            if(getName(p1) === undefined){
                $('#GR').find('#subNameGR').val('Invalid');
            }
            else{
                $('#GR').find('#subNameGR').val(getName(p1));
            }
        }
        else{
            $('#GR').find('#subNameGR').val('');
        }
    }
    else{
        $('#GR').find('#subNameGR').val('');

    }
});


$('#GR').find('#subC').keyup(function() {
    console.log($(this).val());
    if($(this).val().length > 0){
        if($('#GR').find('#semGR').find(':selected').val()!= '0'){
            let sem = $('#GR').find('#semGR').find(':selected').val();
            let code = $(this).val();
            let p1 = code+'/'+sem;
            if(getName(p1) === undefined){
                $('#GR').find('#subNameGR').val('Invalid');
            }
            else{
                $('#GR').find('#subNameGR').val(getName(p1));
            }
        }
        else{
            $('#GR').find('#subNameGR').val('');
        }
    }
    else{
        $('#GR').find('#subNameGR').val('');
    }
});

$('#raa8').find('#sem').on('change', function() {
    if(this.value != '0'){
        let sem = this.value;
        let code = $('#raa8').find('#subC').val();
        let p1 = code+'/'+sem;
        if(code.length > 0){
            if(getName(p1) === undefined){
                $('#raa8').find('#subNameraa8').val('Invalid');
            }
            else{
                $('#raa8').find('#subNameraa8').val(getName(p1));
            }
        }
        else{
            $('#raa8').find('#subNameraa8').val('');
        }
    }
    else{
        $('#raa8').find('#subNameraa8').val('');

    }
});


$('#raa8').find('#subC').keyup(function() {
    console.log($(this).val());
    if($(this).val().length > 0){
        if($('#raa8').find('#sem').find(':selected').val()!= '0'){
            let sem = $('#raa8').find('#sem').find(':selected').val();
            let code = $(this).val();
            let p1 = code+'/'+sem;
            if(getName(p1) === undefined){
                $('#raa8').find('#subNameraa8').val('Invalid');
            }
            else{
                $('#raa8').find('#subNameraa8').val(getName(p1));
            }
        }
        else{
            $('#raa8').find('#subNameraa8').val('');
        }
    }
    else{
        $('#TLP').find('#subNameTLP').val('');
    }
});

</script>";



// <script>
// $('#TLP').find('#sem').on('change', function() {
//     console.log( $(this).value );
//     if($('#TLP').find('#subC').val().length > 0){
//         getName(echo '<scr>')
//       $('#TLP').find('#subN').val(getName("$(this).value","$('#TLP').find('#subC').val()")+");
//     }
// });
// </script>

echo"

</body>
</html>

";

if($i==1){
    echo'<script>$("#table22").hide();</script>';
}

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

/* Submit */ 

if(isset($_POST["submitTLP"])){
    $n=$_POST["subName"];
    $b=$_POST["subCode"];
    $c=$_POST["scheduleClass"];
    $d=$_POST["actualClass"];
    $e=$_POST["semester"];
    $point=($d/$c)*50;
    $point=round($point,2);
    if($e=="0"){
        $_SESSION["danger"]='Select Sem';
        echo "<script>location.href = 'home.php';</script>";
    }
    elseif($n=="Invalid" or $n==""){
        $_SESSION["danger"]='Invalid Subject Code';
        echo "<script>location.href = 'home.php';</script>";
    }
    else{
        $sql = "SELECT * FROM TLP WHERE id='".$a."' AND subject='".$b."'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $_SESSION["danger"]='Entry already there';
            echo "<script>location.href = 'home.php';</script>";
        } else {
            $fpdfname=$b."-TLP.pdf";
            $attachment=$_FILES['attachment']['name'];
            $attachment_type=$_FILES['attachment']['type'];
            $attachment_size=$_FILES['attachment']['size'];
            $attachment_tem_loc=$_FILES['attachment']['tmp_name'];
            $attachment_store="../document/".$a."/".$attachment;
            move_uploaded_file($attachment_tem_loc,$attachment_store);
            $newpath="../document/".$a."/".$fpdfname;
            rename($attachment_store, $newpath);
            $sql = "INSERT INTO TLP VALUES ('$a', '$b','$n',$point,0,'','$e',$c,$d,'$fpdfname',0, '')";
            if (mysqli_query($conn, $sql)) {
                $_SESSION["success"]='TLP Entry Successfully';
                echo "<script>location.href = 'home.php';</script>";
            } else {
                $_SESSION["danger"]='TLP Denied Successfully';
                echo "<script>location.href = 'home.php';</script>";
            }
        }
    }
}

if(isset($_POST["submitGR"])){
    $b=$_POST["subCode"];
    $c=$_POST["subName"];
    $d=$_POST["year"];
    $e=$_POST["resultInstitute"];
    $f=$_POST["resultGtu"];
    $g=$_POST["semester"];
    if(($e-$f) < 0 ){
        $point=($e-$f)*2;
    }
    else{
        $point=($e-$f)*4;
    }
    if($g=="0"){
        $_SESSION["danger"]='Select Sem';
        echo "<script>location.href = 'home.php';</script>";
    }
    elseif($c=="Invalid" or $c==""){
        $_SESSION["danger"]='Invalid Subject Code';
        echo "<script>location.href = 'home.php';</script>";
    }
    else{
        $sql = "SELECT * FROM GR WHERE id='".$a."' AND subject='".$b."'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $_SESSION["danger"]='Entry already there';
            echo "<script>location.href = 'home.php';</script>";
        } else {
            $fpdfname=$b."-GR.pdf";
            $attachment=$_FILES['attachment']['name'];
            $attachment_type=$_FILES['attachment']['type'];
            $attachment_size=$_FILES['attachment']['size'];
            $attachment_tem_loc=$_FILES['attachment']['tmp_name'];
            $attachment_store="../document/".$a."/".$attachment;
            move_uploaded_file($attachment_tem_loc,$attachment_store);
            $newpath="../document/".$a."/".$fpdfname;
            rename($attachment_store, $newpath);
            $sql = "INSERT INTO GR VALUES ('$a', '$b', '$c', '$d', $point, $e, $f, 0, $g, '$fpdfname', 0, '', '')";
            if (mysqli_query($conn, $sql)) {
                $_SESSION["success"]='GR Entry Successfully';
                echo "<script>location.href = 'home.php';</script>";
            } else {
                $_SESSION["danger"]='GR Denied Successfully';
                echo "<script>location.href = 'home.php';</script>";
                #echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }
    
    }
    
}

if(isset($_POST["submitDISC"])){
    $b=$_POST["nooftlp"];
    $c=$_POST["nooflwp"];
    $d=$_POST["noofbl"];
    $e=$_POST["noofm"];
    $f=$_POST["nooff"];
    $point=0;

    if($b==0){ $point=$point+5;}
    elseif($b==1){ $point=$point+4;}
    elseif($b==2){ $point=$point+3;}
    else{$point=$point+0;}

    if($c==0){ $point=$point+5;}
    elseif($c==1){ $point=$point+4;}
    elseif($c==2){ $point=$point+3;}
    elseif($c==3){ $point=$point+2;}
    else{$point=$point+0;}

    $point=$point+($d*2);

    if($e==0){ $point=$point+15;}
    elseif($e==1){ $point=$point+10;}
    elseif($e==2){ $point=$point+5;}
    else{$point=$point+0;}

    if($f==0){ $point=$point+5;}
    elseif($f==1){ $point=$point+0;}
    else{$point=$point+(-5);}



    $sql = "SELECT * FROM DISC WHERE id='".$a."'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $_SESSION["danger"]='Entry already there';
        echo "<script>location.href = 'home.php';</script>";
    } else {
        $sql = "INSERT INTO DISC VALUES ('$a', $b, $c, $d, $e, $f, $point, 0, '', 0, '')";
        if (mysqli_query($conn, $sql)) {
            $_SESSION["success"]='DISC Entry Successfully';
            echo "<script>location.href = 'home.php';</script>";
        } else {
            $_SESSION["danger"]='DISC Denied Successfully';
            echo "<script>location.href = 'home.php';</script>";
            #echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
}

if(isset($_POST["submitDP"])){
    $b=$_POST["port"];
    $c=$_POST["role"];
    $d=$_POST["duration"];
    $point=0;
    if($b=="0"){
        $_SESSION["danger"]='Select Portfolio';
        echo "<script>location.href = 'home.php';</script>";
    }
    else if($c=="0"){
        $_SESSION["danger"]='Select Role';
        echo "<script>location.href = 'home.php';</script>";
    }
    else if($d=="0"){
        $_SESSION["danger"]='Select Duration';
        echo "<script>location.href = 'home.php';</script>";
    }
    else{
        $dur="";
        $rr="";
        if($d==1 and $c==1){
            $point=5*1;
            $dur="1year";
            $rr="coordinator";
        }
        else if($d==1 and $c==2){
            $point=2*1;
            $dur="1year";
            $rr="cocooordinator";
        }
        else if($d==1 and $c==3){
            $point=2*1;
            $dur="1year";
            $rr="member";
        }
        else if($d==2 and $c==1){
            $point=5*(0.5);
            $dur="6month";
            $rr="coordinator";
        }
        else if($d==2 and $c==2){
            $point=2*(0.5);
            $dur="6month";
            $rr="cocooordinator";
        }
        else if($d==2 and $c==3){
            $point=2*(0.5);
            $dur="6month";
            $rr="member";
        }

        $sql = "SELECT * FROM DP WHERE id='".$a."' AND name='".$b."'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $_SESSION["danger"]='Entry already there';
            echo "<script>location.href = 'home.php';</script>";
        } else {
            $fpdfname=$b."-DP.pdf";
            $attachment=$_FILES['attachment']['name'];
            $attachment_type=$_FILES['attachment']['type'];
            $attachment_size=$_FILES['attachment']['size'];
            $attachment_tem_loc=$_FILES['attachment']['tmp_name'];
            $attachment_store="../document/".$a."/".$attachment;
            move_uploaded_file($attachment_tem_loc,$attachment_store);
            $newpath="../document/".$a."/".$fpdfname;
            rename($attachment_store, $newpath);
            $sql = "INSERT INTO DP VALUES ('$a','$b',$point,'$rr','$dur','',0,0,'$fpdfname','')";
            if (mysqli_query($conn, $sql)) {
                $_SESSION["success"]='DP Entry Successfully';
                echo "<script>location.href = 'home.php';</script>";
            } else {
                $_SESSION["danger"]='DP Denied Successfully';
                echo "<script>location.href = 'home.php';</script>";
            }
        }
    }
}

if(isset($_POST["submitIP"])){
    $b=$_POST["port"];
    $c=$_POST["role"];
    $d=$_POST["duration"];
    $point=0;
    if($b=="0"){
        $_SESSION["danger"]='Select Portfolio';
        echo "<script>location.href = 'home.php';</script>";
    }
    else if($c=="0"){
        $_SESSION["danger"]='Select Role';
        echo "<script>location.href = 'home.php';</script>";
    }
    else if($d=="0"){
        $_SESSION["danger"]='Select Duration';
        echo "<script>location.href = 'home.php';</script>";
    }
    else{
        $dur="";
        $rr="";
        if($d==1 and $c==1){
            $point=5*1;
            $dur="1year";
            $rr="coordinator";
        }
        else if($d==1 and $c==2){
            $point=2*1;
            $dur="1year";
            $rr="cocooordinator";
        }
        else if($d==1 and $c==3){
            $point=2*1;
            $dur="1year";
            $rr="member";
        }
        else if($d==2 and $c==1){
            $point=5*(0.5);
            $dur="6month";
            $rr="coordinator";
        }
        else if($d==2 and $c==2){
            $point=2*(0.5);
            $dur="6month";
            $rr="cocooordinator";
        }
        else if($d==2 and $c==3){
            $point=2*(0.5);
            $dur="6month";
            $rr="member";
        }

        $sql = "SELECT * FROM IP WHERE id='".$a."' AND name='".$b."'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $_SESSION["danger"]='Entry already there';
            echo "<script>location.href = 'home.php';</script>";
        } else {
            $fpdfname=$b."-IP.pdf";
            $attachment=$_FILES['attachment']['name'];
            $attachment_type=$_FILES['attachment']['type'];
            $attachment_size=$_FILES['attachment']['size'];
            $attachment_tem_loc=$_FILES['attachment']['tmp_name'];
            $attachment_store="../document/".$a."/".$attachment;
            move_uploaded_file($attachment_tem_loc,$attachment_store);
            $newpath="../document/".$a."/".$fpdfname;
            rename($attachment_store, $newpath);
            $sql = "INSERT INTO IP VALUES ('$a','$b',$point,'$rr','$dur','',0,0,'$fpdfname','')";
            if (mysqli_query($conn, $sql)) {
                $_SESSION["success"]='IP Entry Successfully';
                echo "<script>location.href = 'home.php';</script>";
            } else {
                $_SESSION["danger"]='IP Denied Successfully';
                echo "<script>location.href = 'home.php';</script>";
            }
        }
    }
}

if(isset($_POST["submitCTS"])){
    $b=$_POST["activity"];
    $d=$_POST["date"];
    $point=0;
   
    $sql = "SELECT * FROM CTS WHERE id='".$a."' AND date='".$d."'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $_SESSION["danger"]='Entry already there';
        echo "<script>location.href = 'home.php';</script>";
    } else {
        $fpdfname=$d."-CTS.pdf";
        $attachment=$_FILES['attachment']['name'];
        $attachment_type=$_FILES['attachment']['type'];
        $attachment_size=$_FILES['attachment']['size'];
        $attachment_tem_loc=$_FILES['attachment']['tmp_name'];
        $attachment_store="../document/".$a."/".$attachment;
        move_uploaded_file($attachment_tem_loc,$attachment_store);
        $newpath="../document/".$a."/".$fpdfname;
        rename($attachment_store, $newpath);
        $sql = "INSERT INTO CTS VALUES ('$a','$b','$d',$point,'',0,0,'$fpdfname','')";
        if (mysqli_query($conn, $sql)) {
            $_SESSION["success"]='CTS Entry Successfully';
            echo "<script>location.href = 'home.php';</script>";
        } else {
            $_SESSION["danger"]='CTS Denied Successfully';
            echo "<script>location.href = 'home.php';</script>";
        }
    }
    
}

if(isset($_POST["submitRAA1"])){
    $b=$_POST["activity"];
    $c=$_POST["date"];
    $d=$_POST["for"];
    $e=$_POST["nop"];
    $f=$_POST["role"];
    $point=0;
    if($d=="0"){
        $_SESSION["danger"]='Select for';
        echo "<script>location.href = 'home.php';</script>";
    }
    else if($f=="0"){
        $_SESSION["danger"]='Select role';
        echo "<script>location.href = 'home.php';</script>";
    }
    else{
        $for="";
        $rol="";
        if($d==1){$for="Students";}
        elseif($d==2){$for="Faculty";}
        
        if($f==1){$point=5;$rol="Coordinator";}
        elseif($f==2){$point=2;$rol="Co-coordinator";}
        

        $sql = "SELECT * FROM RAA1 WHERE id='".$a."' AND date='".$c."'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $_SESSION["danger"]='Entry already there';
            echo "<script>location.href = 'home.php';</script>";
        } else {
            $fpdfname=$c."-RAA1.pdf";
            $attachment=$_FILES['attachment']['name'];
            $attachment_type=$_FILES['attachment']['type'];
            $attachment_size=$_FILES['attachment']['size'];
            $attachment_tem_loc=$_FILES['attachment']['tmp_name'];
            $attachment_store="../document/".$a."/".$attachment;
            move_uploaded_file($attachment_tem_loc,$attachment_store);
            $newpath="../document/".$a."/".$fpdfname;
            rename($attachment_store, $newpath);
            $sql = "INSERT INTO RAA1 VALUES ('$a','$b','$for','$c','$rol','$e',$point,'',0,0,'$fpdfname','')";
            if (mysqli_query($conn, $sql)) {
                $_SESSION["success"]='RAA1 Entry Successfully';
                echo "<script>location.href = 'home.php';</script>";
            } else {
                $_SESSION["danger"]='RAA1 Denied Successfully';
                echo "<script>location.href = 'home.php';</script>";
            }
        }
    }
}

if(isset($_POST["submitRAA2"])){
    $b=$_POST["title"];
    $c=$_POST["date"];
    $d=$_POST["place"];
    $e=$_POST["sa"];
    $f=$_POST["nop"];
    $g=$_POST["nod"];
    $point=$g;
    
    $sql = "SELECT * FROM RAA2 WHERE id='".$a."' AND date='".$c."'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $_SESSION["danger"]='Entry already there';
        echo "<script>location.href = 'home.php';</script>";
    } else {
        $fpdfname=$c."-RAA2.pdf";
        $attachment=$_FILES['attachment']['name'];
        $attachment_type=$_FILES['attachment']['type'];
        $attachment_size=$_FILES['attachment']['size'];
        $attachment_tem_loc=$_FILES['attachment']['tmp_name'];
        $attachment_store="../document/".$a."/".$attachment;
        move_uploaded_file($attachment_tem_loc,$attachment_store);
        $newpath="../document/".$a."/".$fpdfname;
        rename($attachment_store, $newpath);
        $sql = "INSERT INTO RAA2 VALUES ('$a','$b','$d','$c','$e','$f','$g',$point,'',0,0,'$fpdfname','')";
        if (mysqli_query($conn, $sql)) {
            $_SESSION["success"]='RAA2 Entry Successfully';
            echo "<script>location.href = 'home.php';</script>";
        } else {
            $_SESSION["danger"]='RAA2 Denied Successfully';
            echo "<script>location.href = 'home.php';</script>";
        }
    }
}

if(isset($_POST["submitRAA3"])){
    $b=$_POST["name"];
    $c=$_POST["date"];
    $d=$_POST["nod"];
    $e=$_POST["dateoe"];
    $point=$d*1.25;
    
    $sql = "SELECT * FROM RAA3 WHERE id='".$a."' AND date='".$c."'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $_SESSION["danger"]='Entry already there';
        echo "<script>location.href = 'home.php';</script>";
    } else {
        $fpdfname=$c."-RAA3.pdf";
        $attachment=$_FILES['attachment']['name'];
        $attachment_type=$_FILES['attachment']['type'];
        $attachment_size=$_FILES['attachment']['size'];
        $attachment_tem_loc=$_FILES['attachment']['tmp_name'];
        $attachment_store="../document/".$a."/".$attachment;
        move_uploaded_file($attachment_tem_loc,$attachment_store);
        $newpath="../document/".$a."/".$fpdfname;
        rename($attachment_store, $newpath);
        $sql = "INSERT INTO RAA3 VALUES ('$a','$b','$c','$e','$d',$point,'',0,0,'$fpdfname','')";
        if (mysqli_query($conn, $sql)) {
            $_SESSION["success"]='RAA3 Entry Successfully';
            echo "<script>location.href = 'home.php';</script>";
        } else {
            $_SESSION["danger"]='RAA3 Denied Successfully';
            echo "<script>location.href = 'home.php';</script>";
        }
    }
}

if(isset($_POST["submitRAA4"])){
    $b=$_POST["name"];
    $c=$_POST["date"];
    $d=$_POST["type"];
    $e=$_POST["nom"];
    $point=10;
    if($d=="0"){
        $_SESSION["danger"]='Select type';
        echo "<script>location.href = 'home.php';</script>";
    }
    else{
        $type="";
        if($d==1){$type="National";}
        elseif($d==2){$type="International";}
       
        $sql = "SELECT * FROM RAA4 WHERE id='".$a."' AND date='".$c."'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $_SESSION["danger"]='Entry already there';
            echo "<script>location.href = 'home.php';</script>";
        } else {
            $fpdfname=$c."-RAA4.pdf";
            $attachment=$_FILES['attachment']['name'];
            $attachment_type=$_FILES['attachment']['type'];
            $attachment_size=$_FILES['attachment']['size'];
            $attachment_tem_loc=$_FILES['attachment']['tmp_name'];
            $attachment_store="../document/".$a."/".$attachment;
            move_uploaded_file($attachment_tem_loc,$attachment_store);
            $newpath="../document/".$a."/".$fpdfname;
            rename($attachment_store, $newpath);
            $sql = "INSERT INTO RAA4 VALUES ('$a','$b','$c','$type','$e',$point,'',0,0,'$fpdfname','')";
            if (mysqli_query($conn, $sql)) {
                $_SESSION["success"]='RAA4 Entry Successfully';
                echo "<script>location.href = 'home.php';</script>";
            } else {
                $_SESSION["danger"]='RAA4 Denied Successfully';
                echo "<script>location.href = 'home.php';</script>";
            }
        }
    }
}

if(isset($_POST["submitRAA5"])){
    $b=$_POST["name"];
    $b=strtolower($b);
    $b=str_replace(' ', '-', $b);
    $g=$_POST["title"];
    $c=$_POST["index"];
    $d=$_POST["issn"];
    $e=$_POST["journal"];
    $f=$_POST["vpage"];
    $point=5;
    if($c=="0"){
        $_SESSION["danger"]='Select index';
        echo "<script>location.href = 'home.php';</script>";
    }
    else{
        $index="";
        if($c==1){$index="SCi";}
        elseif($c==2){$index="Scoupus";}
        elseif($c==3){$index="UGC";}
        elseif($c==4){$index="IJET";}
       
        $sql = "SELECT * FROM RAA5 WHERE id='".$a."' AND name='".$b."'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $_SESSION["danger"]='Entry already there';
            echo "<script>location.href = 'home.php';</script>";
        } else {
            $fpdfname=$b."-RAA5.pdf";
            $attachment=$_FILES['attachment']['name'];
            $attachment_type=$_FILES['attachment']['type'];
            $attachment_size=$_FILES['attachment']['size'];
            $attachment_tem_loc=$_FILES['attachment']['tmp_name'];
            $attachment_store="../document/".$a."/".$attachment;
            move_uploaded_file($attachment_tem_loc,$attachment_store);
            $newpath="../document/".$a."/".$fpdfname;
            rename($attachment_store, $newpath);
            $sql = "INSERT INTO RAA5 VALUES ('$a','$b','$g','$index','$d','$e','$f',$point,'',0,0,'$fpdfname','')";
            if (mysqli_query($conn, $sql)) {
                $_SESSION["success"]='RAA5 Entry Successfully';
                echo "<script>location.href = 'home.php';</script>";
            } else {
                $_SESSION["danger"]='RAA5 Denied Successfully';
                echo "<script>location.href = 'home.php';</script>";
            }
        }
    }
}

if(isset($_POST["submitRAA6"])){
    $b=$_POST["name"];
    $b=strtolower($b);
    $b=str_replace(' ', '-', $b);
    $g=$_POST["pi"];
    $c=$_POST["pp"];
    $d=$_POST["cvp"];
    $point=0;
    if($c=="0"){
        $_SESSION["danger"]='Select Presented/Publish';
        echo "<script>location.href = 'home.php';</script>";
    }
    else{
        $index="";
        if($c==1){$point=3;$index="Presented International";}
        elseif($c==2){$point=2;$index="Presented National";}
        elseif($c==3){$point=1;$index="Publish";}
       
        $sql = "SELECT * FROM RAA6 WHERE id='".$a."' AND name='".$b."'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $_SESSION["danger"]='Entry already there';
            echo "<script>location.href = 'home.php';</script>";
        } else {
            $fpdfname=$b."-RAA6.pdf";
            $attachment=$_FILES['attachment']['name'];
            $attachment_type=$_FILES['attachment']['type'];
            $attachment_size=$_FILES['attachment']['size'];
            $attachment_tem_loc=$_FILES['attachment']['tmp_name'];
            $attachment_store="../document/".$a."/".$attachment;
            move_uploaded_file($attachment_tem_loc,$attachment_store);
            $newpath="../document/".$a."/".$fpdfname;
            rename($attachment_store, $newpath);
            $sql = "INSERT INTO RAA6 VALUES ('$a','$b','$g','$d','$index',$point,'',0,0,'$fpdfname','')";
            if (mysqli_query($conn, $sql)) {
                $_SESSION["success"]='RAA6 Entry Successfully';
                echo "<script>location.href = 'home.php';</script>";
            } else {
                $_SESSION["danger"]='RAA6 Denied Successfully';
                echo "<script>location.href = 'home.php';</script>";
            }
        }
    }
}

if(isset($_POST["submitRAA7"])){
    $b=$_POST["title"];
    $b=strtolower($b);
    $b=str_replace(' ', '-', $b);
    $g=$_POST["year"];
    $c=$_POST["pub"];
    $d=$_POST["authors"];
    $point=0;
    if($c=="0"){
        $_SESSION["danger"]='Select Publisher';
        echo "<script>location.href = 'home.php';</script>";
    }
    else{
        $index="";
        if($c==1){$point=10;$index="International Publisher";}
        elseif($c==2){$point=5;$index="National Publisher";}
        elseif($c==3){$point=3;$index="chapter in edited book";}
        elseif($c==4){$point=10;$index="editor of book by international publisher";}
        elseif($c==5){$point=5;$index="editor of book by any publisher";}
       
        $sql = "SELECT * FROM RAA7 WHERE id='".$a."' AND title='".$b."'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $_SESSION["danger"]='Entry already there';
            echo "<script>location.href = 'home.php';</script>";
        } else {
            $fpdfname=$b."-RAA7.pdf";
            $attachment=$_FILES['attachment']['name'];
            $attachment_type=$_FILES['attachment']['type'];
            $attachment_size=$_FILES['attachment']['size'];
            $attachment_tem_loc=$_FILES['attachment']['tmp_name'];
            $attachment_store="../document/".$a."/".$attachment;
            move_uploaded_file($attachment_tem_loc,$attachment_store);
            $newpath="../document/".$a."/".$fpdfname;
            rename($attachment_store, $newpath);
            $sql = "INSERT INTO RAA7 VALUES ('$a','$b','$g','$d','$index',$point,'',0,0,'$fpdfname','')";
            if (mysqli_query($conn, $sql)) {
                $_SESSION["success"]='RAA7 Entry Successfully';
                echo "<script>location.href = 'home.php';</script>";
            } else {
                $_SESSION["danger"]='RAA7 Denied Successfully';
                echo "<script>location.href = 'home.php';</script>";
            }
        }
    }
}

if(isset($_POST["submitRAA8"])){
    $n=$_POST["subName"];
    $b=$_POST["subCode"];
    $c=$_POST["link"];
    $e=$_POST["semester"];
    $point=5;
    $index="";
    if($e=="0"){
        $_SESSION["danger"]='Select Sem';
        echo "<script>location.href = 'home.php';</script>";
    }
    elseif($n=="Invalid" or $n==""){
        $_SESSION["danger"]='Invalid Subject Code';
        echo "<script>location.href = 'home.php';</script>";
    }
    else{
        $sql = "SELECT * FROM RAA8 WHERE id='".$a."' AND subject='".$b."'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $_SESSION["danger"]='Entry already there';
            echo "<script>location.href = 'home.php';</script>";
        } else {
            $fpdfname=$b."-RAA8.pdf";
            $attachment=$_FILES['attachment']['name'];
            $attachment_type=$_FILES['attachment']['type'];
            $attachment_size=$_FILES['attachment']['size'];
            $attachment_tem_loc=$_FILES['attachment']['tmp_name'];
            $attachment_store="../document/".$a."/".$attachment;
            move_uploaded_file($attachment_tem_loc,$attachment_store);
            $newpath="../document/".$a."/".$fpdfname;
            rename($attachment_store, $newpath);
            $sql = "INSERT INTO RAA8 VALUES ('$a','$n','$b',$e,'$c',$point,'',0,0,'$fpdfname','')";
            if (mysqli_query($conn, $sql)) {
                $_SESSION["success"]='RAA8 Entry Successfully';
                echo "<script>location.href = 'home.php';</script>";
            } else {
                $_SESSION["danger"]='RAA8 Denied Successfully';
                echo "<script>location.href = 'home.php';</script>";
            }
        }
    }
    
    
}

if(isset($_POST["submitRAA9"])){
    $b=$_POST["o1"];
    $point=0;
    if($b=="0"){
        $_SESSION["danger"]='Select Option 1';
        echo "<script>location.href = 'home.php';</script>";
    }
    else{
        $index="";
        if($b==1){$point=20;$index="International Grant";}
        elseif($b==2){$point=30;$index="International Grant + Publish";}
        elseif($b==3){$point=10;$index="National Grant";}
        elseif($b==4){$point=14;$index="National Grant + Publish";}
       
        $sql = "SELECT * FROM RAA9 WHERE id='".$a."'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $_SESSION["danger"]='Entry already there';
            echo "<script>location.href = 'home.php';</script>";
        } else {
            $fpdfname=$a."-RAA9.pdf";
            $attachment=$_FILES['attachment']['name'];
            $attachment_type=$_FILES['attachment']['type'];
            $attachment_size=$_FILES['attachment']['size'];
            $attachment_tem_loc=$_FILES['attachment']['tmp_name'];
            $attachment_store="../document/".$a."/".$attachment;
            move_uploaded_file($attachment_tem_loc,$attachment_store);
            $newpath="../document/".$a."/".$fpdfname;
            rename($attachment_store, $newpath);
            $sql = "INSERT INTO RAA9 VALUES ('$a','$index',$point,'',0,0,'$fpdfname','')";
            if (mysqli_query($conn, $sql)) {
                $_SESSION["success"]='RAA9 Entry Successfully';
                echo "<script>location.href = 'home.php';</script>";
            } else {
                $_SESSION["danger"]='RAA9 Denied Successfully';
                echo "<script>location.href = 'home.php';</script>";
            }
        }
    }
}

if(isset($_POST["submitRAA10"])){
    $b=$_POST["name"];
    $g=$_POST["noc"];
    $c=$_POST["nameou"];
    $point=0;
    if($b=="0"){
        $_SESSION["danger"]='Select Program';
        echo "<script>location.href = 'home.php';</script>";
    }
    else{
        $index="";
        if($b==1){$point=10;$index="Degree";}
        elseif($b==2){$point=15;$index="Degree Thesis";}
        elseif($b==3){$point=3;$index="PhD";}
        $index=strtolower($index);
        $index=str_replace(' ', '-', $index);

        $sql = "SELECT * FROM RAA10 WHERE id='".$a."' AND name='".$index."'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $_SESSION["danger"]='Entry already there';
            echo "<script>location.href = 'home.php';</script>";
        } else {
            $fpdfname=$index."-RAA10.pdf";
            $attachment=$_FILES['attachment']['name'];
            $attachment_type=$_FILES['attachment']['type'];
            $attachment_size=$_FILES['attachment']['size'];
            $attachment_tem_loc=$_FILES['attachment']['tmp_name'];
            $attachment_store="../document/".$a."/".$attachment;
            move_uploaded_file($attachment_tem_loc,$attachment_store);
            $newpath="../document/".$a."/".$fpdfname;
            rename($attachment_store, $newpath);
            $sql = "INSERT INTO RAA10 VALUES ('$a','$index','$g','$c',$point,'',0,0,'$fpdfname','')";
            if (mysqli_query($conn, $sql)) {
                $_SESSION["success"]='RAA10 Entry Successfully';
                echo "<script>location.href = 'home.php';</script>";
            } else {
                $_SESSION["danger"]='RAA10 Denied Successfully';
                echo "<script>location.href = 'home.php';</script>";
            }
        }
    }
}

if(isset($_POST["submitINV"])){
    $b=$_POST["nameIns"];
    $c=$_POST["levelIns"];
    $d=$_POST["date"];
    $e=$_POST["topic"];
    $point=0;
    if($c=="0"){
        $_SESSION["danger"]='Select level of institute';
        echo "<script>location.href = 'home.php';</script>";
    }
    else{
        $rol="";
        if($c==1){$point=5;$rol="international";}
        elseif($c==2){$point=3;$rol="national";}
        else{$point=2;$rol="local";}
        

        $sql = "SELECT * FROM INV WHERE id='".$a."' AND date='".$d."'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $_SESSION["danger"]='Entry already there';
            echo "<script>location.href = 'home.php';</script>";
        } else {
            $fpdfname=$d."-INV.pdf";
            $attachment=$_FILES['attachment']['name'];
            $attachment_type=$_FILES['attachment']['type'];
            $attachment_size=$_FILES['attachment']['size'];
            $attachment_tem_loc=$_FILES['attachment']['tmp_name'];
            $attachment_store="../document/".$a."/".$attachment;
            move_uploaded_file($attachment_tem_loc,$attachment_store);
            $newpath="../document/".$a."/".$fpdfname;
            rename($attachment_store, $newpath);
            $sql = "INSERT INTO INV VALUES ('$a','$b','$rol','$d','$e',$point,'',0,0,'$fpdfname','')";
            if (mysqli_query($conn, $sql)) {
                $_SESSION["success"]='INV Entry Successfully';
                echo "<script>location.href = 'home.php';</script>";
            } else {
                $_SESSION["danger"]='INV Denied Successfully';
                echo "<script>location.href = 'home.php';</script>";
            }
        }
    }
}

if(isset($_POST["submitAO"])){
    $b=$_POST["work"];
    $b=strtolower($b);
    $b=str_replace(' ', '-', $b);
    $point=3;
    $sql = "SELECT * FROM AO WHERE id='".$a."' AND title='".$b."'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $_SESSION["danger"]='Entry already there';
        echo "<script>location.href = 'home.php';</script>";
    } else {
        $fpdfname=$b."-AO.pdf";
        $attachment=$_FILES['attachment']['name'];
        $attachment_type=$_FILES['attachment']['type'];
        $attachment_size=$_FILES['attachment']['size'];
        $attachment_tem_loc=$_FILES['attachment']['tmp_name'];
        $attachment_store="../document/".$a."/".$attachment;
        move_uploaded_file($attachment_tem_loc,$attachment_store);
        $newpath="../document/".$a."/".$fpdfname;
        rename($attachment_store, $newpath);
        $sql = "INSERT INTO AO VALUES ('$a', '$b', $point, 0, '', 0, '$fpdfname', '')";
        if (mysqli_query($conn, $sql)) {
            $_SESSION["success"]='AO Entry Successfully';
            echo "<script>location.href = 'home.php';</script>";
        } else {
            $_SESSION["danger"]='AO Denied Successfully';
            echo "<script>location.href = 'home.php';</script>";
            #echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
}


/* Edit */
if(isset($_POST["editTLP"])){
    $n=$_POST["subName"];
    $b=$_POST["subCode"];
    $c=$_POST["scheduleClass"];
    $d=$_POST["actualClass"];
    $e=$_POST["sem"];
    $point=($d/$c)*50;
    $point=round($point,2);
    if($_FILES['attachment']['name'] == "") {
        $sql = "UPDATE TLP SET point='$point',scheduleClass='$c',actualClass='$d'  WHERE id='$a' AND subject='$b'" ;
    }
    else{
        $fpdfname=$b."-TLP.pdf";
        $attachment=$_FILES['attachment']['name'];
        $attachment_type=$_FILES['attachment']['type'];
        $attachment_size=$_FILES['attachment']['size'];
        $attachment_tem_loc=$_FILES['attachment']['tmp_name'];
        $attachment_store="../document/".$a."/".$attachment;
        move_uploaded_file($attachment_tem_loc,$attachment_store);
        $newpath="../document/".$a."/".$fpdfname;
        rename($attachment_store, $newpath);
        $sql = "UPDATE TLP SET point='$point',scheduleClass='$c',actualClass='$d',attachment='$fpdfname'  WHERE id='$a' AND subject='$b'" ;
    }
    if ($conn->query($sql) === TRUE) {
        $_SESSION["success"]='TLP Updated Successfully';
        echo "<script>location.href = 'home.php'; </script>";
    } else {
        $_SESSION["danger"]='TLP Not Updated Successfully';
        echo "<script>location.href = 'home.php';</script>";
        //echo "Error updating record: " . $conn->error;
    }
}

if(isset($_POST["editGR"])){
    $b=$_POST["subCode"];
    $c=$_POST["subName"];
    $d=$_POST["year"];
    $e=$_POST["resultInstitute"];
    $f=$_POST["resultGtu"];
    if(($e-$f) < 0 ){
        $point=($e-$f)*2;
    }
    else{
        $point=($e-$f)*4;
    }
    
    if($_FILES['attachment']['name'] == "") {
        $sql = "UPDATE GR SET point='$point', resultInstitute='$e', resultGtu='$f', year='$d'  WHERE id='$a' AND subject='$b'" ;
    }
    else{
        $fpdfname=$b."-GR.pdf";
        $attachment=$_FILES['attachment']['name'];
        $attachment_type=$_FILES['attachment']['type'];
        $attachment_size=$_FILES['attachment']['size'];
        $attachment_tem_loc=$_FILES['attachment']['tmp_name'];
        $attachment_store="../document/".$a."/".$attachment;
        move_uploaded_file($attachment_tem_loc,$attachment_store);
        $newpath="../document/".$a."/".$fpdfname;
        rename($attachment_store, $newpath);
        $sql = "UPDATE GR SET point='$point', resultInstitute='$e', resultGtu='$f', year='$d', attachment='$fpdfname' WHERE id='$a' AND subject='$b'";
    }

    if ($conn->query($sql) === TRUE) {
        $_SESSION["success"]='GR Updated Successfully';
        echo "<script>location.href = 'home.php';</script>";
    } else {
        $_SESSION["danger"]='GR Not Updated Successfully';
        echo "<script>location.href = 'home.php';</script>";
        //echo "Error updating record: " . $conn->error;
    }

}
if(isset($_POST["editDISC"])){
    $b=$_POST["nooftlp"];
    $c=$_POST["nooflwp"];
    $d=$_POST["noofbl"];
    $e=$_POST["noofm"];
    $f=$_POST["nooff"];
    $point=0;

    if($b==0){ $point=$point+5;}
    elseif($b==1){ $point=$point+4;}
    elseif($b==2){ $point=$point+3;}
    else{$point=$point+0;}

    if($c==0){ $point=$point+5;}
    elseif($c==1){ $point=$point+4;}
    elseif($c==2){ $point=$point+3;}
    elseif($c==3){ $point=$point+2;}
    else{$point=$point+0;}

    $point=$point+($d*2);

    if($e==0){ $point=$point+15;}
    elseif($e==1){ $point=$point+10;}
    elseif($e==2){ $point=$point+5;}
    else{$point=$point+0;}

    if($f==0){ $point=$point+5;}
    elseif($f==1){ $point=$point+0;}
    else{$point=$point+(-5);}

    $sql = "UPDATE DISC SET TLP='$b', point='$point', LWP='$c', BL='$d', MJC='$e', F='$f' WHERE id='".$a."'";
    if ($conn->query($sql) === TRUE) {
        $_SESSION["success"]='DISC Updated Successfully';
        echo "<script>location.href = 'home.php';</script>";
    } else {
        $_SESSION["danger"]='DISC Not Updated Successfully';
        echo "<script>location.href = 'home.php';</script>";
        //echo "Error updating record: " . $conn->error;
    }

}

if(isset($_POST["editDP"])){
    $b=$_POST["port"];
    $c=$_POST["role"];
    $d=$_POST["duration"];
    $point=0;
    $dur="";
    $rr="";
    if($d==1 and $c==1){
        $point=5*1;
        $dur="1year";
        $rr="coordinator";
    }
    else if($d==1 and $c==2){
        $point=2*1;
        $dur="1year";
        $rr="cocooordinator";
    }
    else if($d==1 and $c==3){
        $point=2*1;
        $dur="1year";
        $rr="member";
    }
    else if($d==2 and $c==1){
        $point=5*(0.5);
        $dur="6month";
        $rr="coordinator";
    }
    else if($d==2 and $c==2){
        $point=2*(0.5);
        $dur="6month";
        $rr="cocooordinator";
    }
    else if($d==2 and $c==3){
        $point=2*(0.5);
        $dur="6month";
        $rr="member";
    }

    if($_FILES['attachment']['name'] == "") {
        $sql = "UPDATE DP SET role='$rr', point='$point', duration='$dur'  WHERE id='$a' AND name='$b'" ;
    }
    else{
        $fpdfname=$b."-DP.pdf";
        $attachment=$_FILES['attachment']['name'];
        $attachment_type=$_FILES['attachment']['type'];
        $attachment_size=$_FILES['attachment']['size'];
        $attachment_tem_loc=$_FILES['attachment']['tmp_name'];
        $attachment_store="../document/".$a."/".$attachment;
        move_uploaded_file($attachment_tem_loc,$attachment_store);
        $newpath="../document/".$a."/".$fpdfname;
        rename($attachment_store, $newpath);
        $sql = "UPDATE DP SET role='$rr', point='$point', duration='$dur', attachment='$fpdfname'  WHERE id='$a' AND name='$b'" ;
    }

    if ($conn->query($sql) === TRUE) {
        $_SESSION["success"]='DP Updated Successfully';
        echo "<script>location.href = 'home.php';</script>";
    } else {
        $_SESSION["danger"]='DP Not Updated Successfully';
        echo "<script>location.href = 'home.php';</script>";
        //echo "Error updating record: " . $conn->error;
    }
    

}

if(isset($_POST["editIP"])){
    $b=$_POST["port"];
    $c=$_POST["role"];
    $d=$_POST["duration"];
    $point=0;
    $dur="";
    $rr="";
    if($d==1 and $c==1){
        $point=5*1;
        $dur="1year";
        $rr="coordinator";
    }
    else if($d==1 and $c==2){
        $point=2*1;
        $dur="1year";
        $rr="cocooordinator";
    }
    else if($d==1 and $c==3){
        $point=2*1;
        $dur="1year";
        $rr="member";
    }
    else if($d==2 and $c==1){
        $point=5*(0.5);
        $dur="6month";
        $rr="coordinator";
    }
    else if($d==2 and $c==2){
        $point=2*(0.5);
        $dur="6month";
        $rr="cocooordinator";
    }
    else if($d==2 and $c==3){
        $point=2*(0.5);
        $dur="6month";
        $rr="member";
    }

    if($_FILES['attachment']['name'] == "") {
        $sql = "UPDATE IP SET role='$rr', point='$point', duration='$dur'  WHERE id='$a' AND name='$b'" ;
    }
    else{
        $fpdfname=$b."-DP.pdf";
        $attachment=$_FILES['attachment']['name'];
        $attachment_type=$_FILES['attachment']['type'];
        $attachment_size=$_FILES['attachment']['size'];
        $attachment_tem_loc=$_FILES['attachment']['tmp_name'];
        $attachment_store="../document/".$a."/".$attachment;
        move_uploaded_file($attachment_tem_loc,$attachment_store);
        $newpath="../document/".$a."/".$fpdfname;
        rename($attachment_store, $newpath);
        $sql = "UPDATE IP SET role='$rr', point='$point', duration='$dur', attachment='$fpdfname'  WHERE id='$a' AND name='$b'" ;
    }

    if ($conn->query($sql) === TRUE) {
        $_SESSION["success"]='IP Updated Successfully';
        echo "<script>location.href = 'home.php';</script>";
    } else {
        $_SESSION["danger"]='IP Not Updated Successfully';
        echo "<script>location.href = 'home.php';</script>";
        //echo "Error updating record: " . $conn->error;
    }
    

}

if(isset($_POST["editRAA1"])){
    $b=$_POST["name"];
    $c=$_POST["date"];
    $d=$_POST["for"];
    $e=$_POST["nop"];
    $f=$_POST["role"];
    $point=0;
    if($d=="0"){
        $_SESSION["danger"]='Select for';
        echo "<script>location.href = 'home.php';</script>";
    }
    else if($f=="0"){
        $_SESSION["danger"]='Select role';
        echo "<script>location.href = 'home.php';</script>";
    }
    else{
        $for="";
        $rol="";
        if($d==1){$for="Students";}
        elseif($d==2){$for="Faculty";}
        
        if($f==1){$point=5;$rol="Coordinator";}
        elseif($f==2){$point=2;$rol="Co-coordinator";}
        
        if($_FILES['attachment']['name'] == "") {
            $sql = "UPDATE RAA1 SET name='$b',considering='$for',role='$rol',participants='$e',point='$point'  WHERE id='$a' AND date='$c'" ;
        }
        else{
            $fpdfname=$c."-RAA1.pdf";
            $attachment=$_FILES['attachment']['name'];
            $attachment_type=$_FILES['attachment']['type'];
            $attachment_size=$_FILES['attachment']['size'];
            $attachment_tem_loc=$_FILES['attachment']['tmp_name'];
            $attachment_store="../document/".$a."/".$attachment;
            move_uploaded_file($attachment_tem_loc,$attachment_store);
            $newpath="../document/".$a."/".$fpdfname;
            rename($attachment_store, $newpath);
            $sql = "UPDATE RAA1 SET name='$b',considering='$for',role='$rol',participants='$e',point='$point',attachment='$fpdfname'  WHERE id='$a' AND date='$c'" ;
        }

        if ($conn->query($sql) === TRUE) {
            $_SESSION["success"]='RAA1 Updated Successfully';
            echo "<script>location.href = 'home.php';</script>";
        } else {
            $_SESSION["danger"]='RAA1 Not Updated Successfully';
            echo "<script>location.href = 'home.php';</script>";
            //echo "Error updating record: " . $conn->error;
        }
    }
}

if(isset($_POST["editRAA2"])){
    $b=$_POST["title"];
    $c=$_POST["date"];
    $d=$_POST["place"];
    $e=$_POST["sa"];
    $f=$_POST["nop"];
    $g=$_POST["nod"];
    $point=$g;
    if($_FILES['attachment']['name'] == "") {
        $sql = "UPDATE RAA2 SET title='$b',place='$d',sponsoring_agency='$e',participants='$f',days='$g',point='$point'  WHERE id='$a' AND date='$c'" ;
    }
    else{
        $fpdfname=$c."-RAA2.pdf";
        $attachment=$_FILES['attachment']['name'];
        $attachment_type=$_FILES['attachment']['type'];
        $attachment_size=$_FILES['attachment']['size'];
        $attachment_tem_loc=$_FILES['attachment']['tmp_name'];
        $attachment_store="../document/".$a."/".$attachment;
        move_uploaded_file($attachment_tem_loc,$attachment_store);
        $newpath="../document/".$a."/".$fpdfname;
        rename($attachment_store, $newpath);
        $sql = "UPDATE RAA2 SET title='$b',place='$d',sponsoring_agency='$e',participants='$f',days='$g',point='$point',attachment='$fpdfname'  WHERE id='$a' AND date='$c'" ;
    }

    if ($conn->query($sql) === TRUE) {
        $_SESSION["success"]='RAA2 Updated Successfully';
        echo "<script>location.href = 'home.php';</script>";
    } else {
        $_SESSION["danger"]='RAA2 Not Updated Successfully';
        echo "<script>location.href = 'home.php';</script>";
        //echo "Error updating record: " . $conn->error;
    }   
}

if(isset($_POST["editRAA3"])){
    $b=$_POST["name"];
    $c=$_POST["date"];
    $d=$_POST["nop"];
    $e=$_POST["dateoe"];
    $point=$d*1.25;
    if($_FILES['attachment']['name'] == "") {
        $sql = "UPDATE RAA3 SET name='$b',date_of_examination='$e',duration='$d',point='$point'  WHERE id='$a' AND date='$c'" ;
    }
    else{
        $fpdfname=$c."-RAA3.pdf";
        $attachment=$_FILES['attachment']['name'];
        $attachment_type=$_FILES['attachment']['type'];
        $attachment_size=$_FILES['attachment']['size'];
        $attachment_tem_loc=$_FILES['attachment']['tmp_name'];
        $attachment_store="../document/".$a."/".$attachment;
        move_uploaded_file($attachment_tem_loc,$attachment_store);
        $newpath="../document/".$a."/".$fpdfname;
        rename($attachment_store, $newpath);
        $sql = "UPDATE RAA3 SET name='$b',date_of_examination='$e',duration='$d',point='$point',attachment='$fpdfname'  WHERE id='$a' AND date='$c'" ;
    }

    if ($conn->query($sql) === TRUE) {
        $_SESSION["success"]='RAA3 Updated Successfully';
        echo "<script>location.href = 'home.php';</script>";
    } else {
        $_SESSION["danger"]='RAA3 Not Updated Successfully';
        echo "<script>location.href = 'home.php';</script>";
        //echo "Error updating record: " . $conn->error;
    }   
}

if(isset($_POST["editRAA4"])){
    $b=$_POST["name"];
    $c=$_POST["date"];
    $d=$_POST["type"];
    $e=$_POST["nom"];
    $point=10;
    if($d=="0"){
        $_SESSION["danger"]='Select type';
        echo "<script>location.href = 'home.php';</script>";
    }
    else{
        $type="";
        if($d==1){$type="National";}
        elseif($d==2){$type="International";}
        
        if($_FILES['attachment']['name'] == "") {
            $sql = "UPDATE RAA4 SET name='$b',type='$type',membership='$e',point='$point'  WHERE id='$a' AND date='$c'" ;
        }
        else{
            $fpdfname=$c."-RAA4.pdf";
            $attachment=$_FILES['attachment']['name'];
            $attachment_type=$_FILES['attachment']['type'];
            $attachment_size=$_FILES['attachment']['size'];
            $attachment_tem_loc=$_FILES['attachment']['tmp_name'];
            $attachment_store="../document/".$a."/".$attachment;
            move_uploaded_file($attachment_tem_loc,$attachment_store);
            $newpath="../document/".$a."/".$fpdfname;
            rename($attachment_store, $newpath);
            $sql = "UPDATE RAA4 SET name='$b',type='$type',membership='$e',point='$point',attachment='$fpdfname'  WHERE id='$a' AND date='$c'" ;
        }

        if ($conn->query($sql) === TRUE) {
            $_SESSION["success"]='RAA4 Updated Successfully';
            echo "<script>location.href = 'home.php';</script>";
        } else {
            $_SESSION["danger"]='RAA4 Not Updated Successfully';
            echo "<script>location.href = 'home.php';</script>";
            //echo "Error updating record: " . $conn->error;
        }
    }
}

if(isset($_POST["editRAA5"])){
    $b=$_POST["name"];
    $b=strtolower($b);
    $b=str_replace(' ', '-', $b);
    $g=$_POST["title"];
    $c=$_POST["index"];
    $d=$_POST["issn"];
    $e=$_POST["journal"];
    $f=$_POST["vpage"];
    $point=5;
    $point=0;
    if($c=="0"){
        $_SESSION["danger"]='Select index';
        echo "<script>location.href = 'home.php';</script>";
    }
    else{
        $index="";
        if($c==1){$index="SCi";}
        elseif($c==2){$index="Scoupus";}
        elseif($c==3){$index="UGC";}
        elseif($c==4){$index="IJET";}
        
        if($_FILES['attachment']['name'] == "") {
            $sql = "UPDATE RAA5 SET title='$g',indexing='$index',issn='$d',journal='$e',vpage='$f',point='$point'  WHERE id='$a' AND name='$b'" ;
        }
        else{
            $fpdfname=$b."-RAA5.pdf";
            $attachment=$_FILES['attachment']['name'];
            $attachment_type=$_FILES['attachment']['type'];
            $attachment_size=$_FILES['attachment']['size'];
            $attachment_tem_loc=$_FILES['attachment']['tmp_name'];
            $attachment_store="../document/".$a."/".$attachment;
            move_uploaded_file($attachment_tem_loc,$attachment_store);
            $newpath="../document/".$a."/".$fpdfname;
            rename($attachment_store, $newpath);
            $sql = "UPDATE RAA5 SET title='$g',indexing='$index',issn='$d',journal='$e',vpage='$f',point='$point',attachment='$fpdfname'  WHERE id='$a' AND name='$b'" ;
        }

        if ($conn->query($sql) === TRUE) {
            $_SESSION["success"]='RAA5 Updated Successfully';
            echo "<script>location.href = 'home.php';</script>";
        } else {
            $_SESSION["danger"]='RAA5 Not Updated Successfully';
            echo "<script>location.href = 'home.php';</script>";
            //echo "Error updating record: " . $conn->error;
        }
    }
}

if(isset($_POST["editRAA6"])){
    $b=$_POST["name"];
    $b=strtolower($b);
    $b=str_replace(' ', '-', $b);
    $g=$_POST["pi"];
    $c=$_POST["pp"];
    $d=$_POST["cvp"];
    $point=0;
    if($c=="0"){
        $_SESSION["danger"]='Select Presented/Publish';
        echo "<script>location.href = 'home.php';</script>";
    }
    else{
        $index="";
        if($c==1){$point=3;$index="Presented International";}
        elseif($c==2){$point=2;$index="Presented National";}
        elseif($c==3){$point=1;$index="Publish";}
        
        if($_FILES['attachment']['name'] == "") {
            $sql = "UPDATE RAA6 SET pi='$g',cvp='$d',pp='$index',point='$point'  WHERE id='$a' AND name='$b'" ;
        }
        else{
            $fpdfname=$b."-RAA6.pdf";
            $attachment=$_FILES['attachment']['name'];
            $attachment_type=$_FILES['attachment']['type'];
            $attachment_size=$_FILES['attachment']['size'];
            $attachment_tem_loc=$_FILES['attachment']['tmp_name'];
            $attachment_store="../document/".$a."/".$attachment;
            move_uploaded_file($attachment_tem_loc,$attachment_store);
            $newpath="../document/".$a."/".$fpdfname;
            rename($attachment_store, $newpath);
            $sql = "UPDATE RAA6 SET pi='$g',cvp='$d',pp='$index',point='$point',attachment='$fpdfname'  WHERE id='$a' AND name='$b'" ;
        }

        if ($conn->query($sql) === TRUE) {
            $_SESSION["success"]='RAA6 Updated Successfully';
            echo "<script>location.href = 'home.php';</script>";
        } else {
            $_SESSION["danger"]='RAA6 Not Updated Successfully';
            echo "<script>location.href = 'home.php';</script>";
            //echo "Error updating record: " . $conn->error;
        }
    }
}

if(isset($_POST["editRAA7"])){
    $b=$_POST["title"];
    $b=strtolower($b);
    $b=str_replace(' ', '-', $b);
    $g=$_POST["year"];
    $c=$_POST["pub"];
    $d=$_POST["authors"];
    $point=0;
    if($c=="0"){
        $_SESSION["danger"]='Select Publisher';
        echo "<script>location.href = 'home.php';</script>";
    }
    else{
        $index="";
        if($c==1){$point=10;$index="International Publisher";}
        elseif($c==2){$point=5;$index="National Publisher";}
        elseif($c==3){$point=3;$index="chapter in edited book";}
        elseif($c==4){$point=10;$index="editor of book by international publisher";}
        elseif($c==5){$point=5;$index="editor of book by any publisher";}
        
        if($_FILES['attachment']['name'] == "") {
            $sql = "UPDATE RAA7 SET year='$g',authors='$d',publisher='$index',point='$point'  WHERE id='$a' AND title='$b'" ;
        }
        else{
            $fpdfname=$b."-RAA7.pdf";
            $attachment=$_FILES['attachment']['name'];
            $attachment_type=$_FILES['attachment']['type'];
            $attachment_size=$_FILES['attachment']['size'];
            $attachment_tem_loc=$_FILES['attachment']['tmp_name'];
            $attachment_store="../document/".$a."/".$attachment;
            move_uploaded_file($attachment_tem_loc,$attachment_store);
            $newpath="../document/".$a."/".$fpdfname;
            rename($attachment_store, $newpath);
            $sql = "UPDATE RAA7 SET year='$g',authors='$d',publisher='$index',point='$point',attachment='$fpdfname'  WHERE id='$a' AND title='$b'" ;
        }

        if ($conn->query($sql) === TRUE) {
            $_SESSION["success"]='RAA7 Updated Successfully';
            echo "<script>location.href = 'home.php';</script>";
        } else {
            $_SESSION["danger"]='RAA7 Not Updated Successfully';
            echo "<script>location.href = 'home.php';</script>";
            //echo "Error updating record: " . $conn->error;
        }
    }
}

if(isset($_POST["editRAA8"])){
    $b=$_POST["subCode"];
    $c=$_POST["name"];
    $d=$_POST["link"];
    $point=5;
    if($_FILES['attachment']['name'] == "") {
        $sql = "UPDATE RAA8 SET link='$d',point='$point'  WHERE id='$a' AND subject='$b'" ;
    }
    else{
        $fpdfname=$b."-RAA8.pdf";
        $attachment=$_FILES['attachment']['name'];
        $attachment_type=$_FILES['attachment']['type'];
        $attachment_size=$_FILES['attachment']['size'];
        $attachment_tem_loc=$_FILES['attachment']['tmp_name'];
        $attachment_store="../document/".$a."/".$attachment;
        move_uploaded_file($attachment_tem_loc,$attachment_store);
        $newpath="../document/".$a."/".$fpdfname;
        rename($attachment_store, $newpath);
        $sql = "UPDATE RAA8 SET link='$d',point='$point',attachment='$fpdfname'  WHERE id='$a' AND subject='$b'" ;
    }

    if ($conn->query($sql) === TRUE) {
        $_SESSION["success"]='RAA8 Updated Successfully';
        echo "<script>location.href = 'home.php';</script>";
    } else {
        $_SESSION["danger"]='RAA8 Not Updated Successfully';
        echo "<script>location.href = 'home.php';</script>";
    }   
}

if(isset($_POST["editRAA9"])){
    $b=$_POST["o1"];
    $point=0;
    if($b=="0"){
        $_SESSION["danger"]='Select Option 1';
        echo "<script>location.href = 'home.php';</script>";
    }
    else{
        $index="";
        if($b==1){$point=20;$index="International Grant";}
        elseif($b==2){$point=30;$index="International Grant + Publish";}
        elseif($b==3){$point=10;$index="National Grant";}
        elseif($b==4){$point=14;$index="National Grant + Publish";}
        
        if($_FILES['attachment']['name'] == "") {
            $sql = "UPDATE RAA9 SET type='$index',point='$point'  WHERE id='$a'" ;
        }
        else{
            $fpdfname=$a."-RAA9.pdf";
            $attachment=$_FILES['attachment']['name'];
            $attachment_type=$_FILES['attachment']['type'];
            $attachment_size=$_FILES['attachment']['size'];
            $attachment_tem_loc=$_FILES['attachment']['tmp_name'];
            $attachment_store="../document/".$a."/".$attachment;
            move_uploaded_file($attachment_tem_loc,$attachment_store);
            $newpath="../document/".$a."/".$fpdfname;
            rename($attachment_store, $newpath);
            $sql = "UPDATE RAA9 SET type='$index',point='$point',attachment='$fpdfname'  WHERE id='$a'" ;
        }

        if ($conn->query($sql) === TRUE) {
            $_SESSION["success"]='RAA9 Updated Successfully';
            echo "<script>location.href = 'home.php';</script>";
        } else {
            $_SESSION["danger"]='RAA9 Not Updated Successfully';
            echo "<script>location.href = 'home.php';</script>";
            //echo "Error updating record: " . $conn->error;
        }
    }
}

if(isset($_POST["editRAA10"])){
    $b=$_POST["subCode"];
    $c=$_POST["noc"];
    $d=$_POST["nameou"];
    if($_FILES['attachment']['name'] == "") {
        $sql = "UPDATE RAA10 SET candidate='$c',university='$d'  WHERE id='$a' AND name='$b'" ;
    }
    else{
        $fpdfname=$b."-RAA10.pdf";
        $attachment=$_FILES['attachment']['name'];
        $attachment_type=$_FILES['attachment']['type'];
        $attachment_size=$_FILES['attachment']['size'];
        $attachment_tem_loc=$_FILES['attachment']['tmp_name'];
        $attachment_store="../document/".$a."/".$attachment;
        move_uploaded_file($attachment_tem_loc,$attachment_store);
        $newpath="../document/".$a."/".$fpdfname;
        rename($attachment_store, $newpath);
        $sql = "UPDATE RAA10 SET candidate='$c',university='$d',attachment='$fpdfname'  WHERE id='$a' AND name='$b'" ;
    }

    if ($conn->query($sql) === TRUE) {
        $_SESSION["success"]='RAA10 Updated Successfully';
        echo "<script>location.href = 'home.php';</script>";
    } else {
        $_SESSION["danger"]='RAA10 Not Updated Successfully';
        echo "<script>location.href = 'home.php';</script>";
        //echo "Error updating record: " . $conn->error;
    }   
}

if(isset($_POST["editINV"])){
    $b=$_POST["nameIns"];
    $c=$_POST["levelIns"];
    $d=$_POST["date"];
    $e=$_POST["topic"];
    $point=0;
    $rol="";
    if($c==1){$point=5;$rol="international";}
    elseif($c==2){$point=3;$rol="national";}
    else{$point=2;$rol="local";}

    if($_FILES['attachment']['name'] == "") {
        $sql = "UPDATE INV SET name='$b',level='$rol',topic='$e',point='$point'  WHERE id='$a' AND date='$d'" ;
    }
    else{
        $fpdfname=$d."-INV.pdf";
        $attachment=$_FILES['attachment']['name'];
        $attachment_type=$_FILES['attachment']['type'];
        $attachment_size=$_FILES['attachment']['size'];
        $attachment_tem_loc=$_FILES['attachment']['tmp_name'];
        $attachment_store="../document/".$a."/".$attachment;
        move_uploaded_file($attachment_tem_loc,$attachment_store);
        $newpath="../document/".$a."/".$fpdfname;
        rename($attachment_store, $newpath);
        $sql = "UPDATE INV SET name='$b',level='$rol',topic='$e',point='$point',attachment='$fpdfname'  WHERE id='$a' AND date='$d'" ;
    }

    if ($conn->query($sql) === TRUE) {
        $_SESSION["success"]='INV Updated Successfully';
        echo "<script>location.href = 'home.php';</script>";
    } else {
        $_SESSION["danger"]='INV Not Updated Successfully';
        echo "<script>location.href = 'home.php';</script>";
        //echo "Error updating record: " . $conn->error;
    }
    

}

if(isset($_POST["editAO"])){
    $b=$_POST["title"];
    $b=strtolower($b);
    $b=str_replace(' ', '-', $b);
    $fpdfname=$b."-AO.pdf";
    $attachment=$_FILES['attachment']['name'];
    $attachment_type=$_FILES['attachment']['type'];
    $attachment_size=$_FILES['attachment']['size'];
    $attachment_tem_loc=$_FILES['attachment']['tmp_name'];
    $attachment_store="../document/".$a."/".$attachment;
    move_uploaded_file($attachment_tem_loc,$attachment_store);
    $newpath="../document/".$a."/".$fpdfname;
    rename($attachment_store, $newpath);
    $sql = "UPDATE AO SET attachment='$fpdfname'  WHERE id='$a' AND title='$b'" ;
    
    if ($conn->query($sql) === TRUE) {
        $_SESSION["success"]='AO Updated Successfully';
        echo "<script>location.href = 'home.php';</script>";
    } else {
        $_SESSION["danger"]='AO Not Updated Successfully';
        echo "<script>location.href = 'home.php';</script>";
        //echo "Error updating record: " . $conn->error;
    }
    
}

/*Delete
if(isset($_POST["delTLP"])){
    $b=$_POST["delTLP"];
    $sql = "DELETE FROM TLP WHERE id='$a' AND subject='$b'";
    if (mysqli_query($conn, $sql)) {
        $_SESSION["success"]='TLP Deleted Successfully';
        echo "<script>location.href = 'home.php';</script>";
    } else {
        $_SESSION["danger"]='TLP Not Deleted Successfully';
        echo "<script>location.href = 'home.php';</script>";
    }
}

if(isset($_POST["delGR"])){
    $b=$_POST["delGR"];
    $sql = "DELETE FROM GR WHERE id='$a' AND subject='$b'";
    if (mysqli_query($conn, $sql)) {
        $_SESSION["success"]='GR Deleted Successfully';
        echo "<script>location.href = 'home.php';</script>";
    } else {
        $_SESSION["danger"]='GR Not Deleted Successfully';
        echo "<script>location.href = 'home.php';</script>";
        //echo "Error deleting record: " . mysqli_error($conn);
    }
}

if(isset($_POST["delDISC"])){
    $b=$_POST["delDISC"];
    $sql = "DELETE FROM DISC WHERE id='$b'";
    if (mysqli_query($conn, $sql)) {
        $_SESSION["success"]='DISC Deleted Successfully';
        echo "<script>location.href = 'home.php';</script>";
    } else {
        $_SESSION["danger"]='DISC Not Deleted Successfully';
        echo "<script>location.href = 'home.php';</script>";
        //echo "Error deleting record: " . mysqli_error($conn);
    }
}

if(isset($_POST["delDP"])){
    $b=$_POST["delDP"];
    $sql = "DELETE FROM DP WHERE id='$a' AND name='$b'";
    if (mysqli_query($conn, $sql)) {
        $_SESSION["success"]='DP Deleted Successfully';
        echo "<script>location.href = 'home.php';</script>";
    } else {
        $_SESSION["danger"]='DP Not Deleted Successfully';
        echo "<script>location.href = 'home.php';</script>";
        //echo "Error deleting record: " . mysqli_error($conn);
    }
}

if(isset($_POST["delIP"])){
    $b=$_POST["delIP"];
    $sql = "DELETE FROM IP WHERE id='$a' AND name='$b'";
    if (mysqli_query($conn, $sql)) {
        $_SESSION["success"]='IP Deleted Successfully';
        echo "<script>location.href = 'home.php';</script>";
    } else {
        $_SESSION["danger"]='IP Not Deleted Successfully';
        echo "<script>location.href = 'home.php';</script>";
        //echo "Error deleting record: " . mysqli_error($conn);
    }
}

if(isset($_POST["delINV"])){
    $b=$_POST["delINV"];
    $sql = "DELETE FROM INV WHERE id='$a' AND date='$b'";
    if (mysqli_query($conn, $sql)) {
        $_SESSION["success"]='INV Deleted Successfully';
        echo "<script>location.href = 'home.php';</script>";
    } else {
        $_SESSION["danger"]='INV Not Deleted Successfully';
        echo "<script>location.href = 'home.php';</script>";
        //echo "Error deleting record: " . mysqli_error($conn);
    }
}

if(isset($_POST["delAO"])){
    $b=$_POST["delAO"];
    $b=strtolower($b);
    $b=str_replace(' ', '-', $b);
    $sql = "DELETE FROM AO WHERE id='$a' AND title='$b'";
    if (mysqli_query($conn, $sql)) {
        $_SESSION["success"]='AO Deleted Successfully';
        echo "<script>location.href = 'home.php';</script>";
    } else {
        $_SESSION["danger"]='AO Not Deleted Successfully';
        echo "<script>location.href = 'home.php';</script>";
        //echo "Error deleting record: " . mysqli_error($conn);
    }
    
}*/

if(isset($_POST["del"])){
    $str=$_POST["del"];
    $arr = preg_split("/[_]+/", $str);
    if(count($arr)==3){
        $element=$arr[0];
        $elementField=$arr[1];
        $tt=$arr[2];
        $sql = "DELETE FROM $tt WHERE id='$a' AND $elementField='$element'" ;
        if ($conn->query($sql) === TRUE) {
            $_SESSION["success"]=$tt.' Deleted Successfully';
            echo "<script>location.href = 'home.php'; </script>";
        } else {
            $_SESSION["danger"]=$tt.' Not Deleted Successfully';
            echo "<script>location.href = 'home.php';</script>";
            //echo "Error updating record: " . $conn->error;
        }
    }
    elseif(count($arr)==1){
        $tt=$arr[0];
        $sql = "DELETE FROM $tt WHERE id='$a'" ;
    
        if ($conn->query($sql) === TRUE) {
            $_SESSION["success"]=$tt.' Deleted Successfully';
            echo "<script>location.href = 'home.php'; </script>";
        } else {
            $_SESSION["danger"]=$tt.' Not Deleted Successfully';
            echo "<script>location.href = 'home.php';</script>";
            //echo "Error updating record: " . $conn->error;
        }
    }
}

if(isset($_POST["lock"])){
    $str=$_POST["lock"];
    $arr = preg_split("/[_]+/", $str);
    if(count($arr)==3){
        $element=$arr[0];
        $elementField=$arr[1];
        $tt=$arr[2];
        $sql = "UPDATE $tt SET locked=1 WHERE id='$a' AND $elementField='$element'" ;
        if ($conn->query($sql) === TRUE) {
            $_SESSION["success"]=$tt.' locked Successfully';
            echo "<script>location.href = 'home.php'; </script>";
        } else {
            $_SESSION["danger"]=$tt.' Not locked Successfully';
            echo "<script>location.href = 'home.php';</script>";
            //echo "Error updating record: " . $conn->error;
        }
    }
    elseif(count($arr)==1){
        $tt=$arr[0];
        $sql = "UPDATE $tt SET locked=1 WHERE id='$a'" ;
    
        if ($conn->query($sql) === TRUE) {
            $_SESSION["success"]=$tt.' locked Successfully';
            echo "<script>location.href = 'home.php'; </script>";
        } else {
            $_SESSION["danger"]=$tt.' Not locked Successfully';
            echo "<script>location.href = 'home.php';</script>";
            //echo "Error updating record: " . $conn->error;
        }
    }
}


?>