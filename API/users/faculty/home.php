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

  //subject name & subject code optimazied
  $subjectNameArr=array();
  echo '<script> var subjectNameArr = {};var semdict = {}</script>';
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
          semdict["'.$key.'"] = "'.$key1.'";
          </script>';
      }
  }

  //subject name & subject code optimazied
  echo "<script>
  function getName(p1){
      return subjectNameArr[p1];
  }
  function getKeyByValue(value) {
      var arr = [];
      for (var key in semdict)
          if (semdict.hasOwnProperty(key) && semdict[key] === value)
              arr.push(key);
      return arr;
  }
  // console.log(getKeyByValue('3'))
  // console.log(getName('3130004/3'))
  </script>";

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
                    <a class="nav-link linkclass" href="activity.php">
                        <img
                        alt=""
                        src="../../assets/icons/info.png"
                        data-large="../../assets/icons/info.png"
                        class="goldicon blurry-load"
                        />
                        Activity</a
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
            <select class="form-control snip1337" id="criteria">
                <option value="0">Add Activity Based On Criteria</option>
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
              <div class="input-group mb-3">
                <span class="input-group-text">📒</span>
                <div class="form-floating">
                  <select class="form-control" name="semester" id="sem">
                      <option value="0">Select</option>
                      <option value="1">Sem 1</option>
                      <option value="2">Sem 2</option>
                      <option value="3">Sem 3</option>
                      <option value="4">Sem 4</option>
                      <option value="5">Sem 5</option>
                      <option value="6">Sem 6</option>
                      <option value="7">Sem 7</option>
                      <option value="8">Sem 8</option>
                  </select>
                  <label for="sem">Semester</label>
                </div>
              </div>
              <div class="input-group mb-3">
                <span class="input-group-text">📘</span>
                <div class="form-floating">
                  <select class="form-control" name="subdrop" id="subdrop">
                    <option value="0">Select</option>
                  </select>
                  <label for="sem">Subject Code</label>
                </div>
              </div>
              <div class="input-group mb-3">
                <span class="input-group-text">📕</span>
                <div class="form-floating">
                  <input type="text" class="form-control" id="subNameTLP" name="subName" placeholder="subject name" required readonly>
                  <label for="sub">Subject Name</label>
                </div>
              </div>
              <div class="input-group mb-3">
                <span class="input-group-text">📝</span>
                <div class="form-floating">
                <input type="number" min="0" class="form-control" id="schedule" name="scheduleClass" placeholder="test" required>
                  <label for="schedule">No.of Scheduled Classes/Week</label>
                </div>
              </div>
              <div class="input-group mb-3">
                <span class="input-group-text">✍️</span>
                <div class="form-floating">
                <input type="number" min="0" class="form-control" id="actual" name="actualClass" placeholder="test" required>
                  <label for="actual">No. of Actual classes</label>
                </div>
              </div>
              <div class="input-group mb-3">
                <span class="input-group-text">📄</span>
                <span class="input-group-text">Attachment&nbsp;<i>(Max 2 MB PDF)</i></span>
                <input type="file" accept="application/pdf" class="form-control smalltext" id="attach" name="attachment" required>
              </div>

              <button type="submit" name="submitTLP" class="button-55">Submit</button>
            </form>

            <!--GR-->
            <form method="POST" action="" class="p-2" id="GR" enctype="multipart/form-data">
              <hr>
              <div class="input-group mb-3">
                <span class="input-group-text">📒</span>
                <div class="form-floating">
                <select class="form-control" name="semester" id="semGR">
                      <option value="0">Select</option>
                      <option value="1">Sem 1</option>
                      <option value="2">Sem 2</option>
                      <option value="3">Sem 3</option>
                      <option value="4">Sem 4</option>
                      <option value="5">Sem 5</option>
                      <option value="6">Sem 6</option>
                      <option value="7">Sem 7</option>
                      <option value="8">Sem 8</option>
                  </select>
                  <label for="sem">Semester</label>
                </div>
              </div>
              <div class="input-group mb-3">
                <span class="input-group-text">📕</span>
                <div class="form-floating">
                <select class="form-control" name="subdrop" id="subdrop">
                    <option value="0">Select</option>
                  </select>
                  <label for="sem">Subject Code</label>
                </div>
              </div>
              <div class="input-group mb-3">
                <span class="input-group-text">📘</span>
                <div class="form-floating">
                  <input type="text" class="form-control" id="subNameGR" name="subName" placeholder="subject name" required readonly>
                  <label for="sub">Subject Name</label>
                </div>
              </div>
              <div class="input-group mb-3">
                <span class="input-group-text">📅</span>
                <div class="form-floating">
                <input type="text" class="form-control" id="y" name="year" placeholder="test" required>
                  <label for="y">Academic Year</label>
                </div>
              </div>
              <div class="input-group mb-3">
                <span class="input-group-text">🏫</span>
                <div class="form-floating">
                <input type="number" min="0" max="100" class="form-control" id="rI" name="resultInstitute" step="0.01" placeholder="test" required>
                  <label for="rI">Result of subject (Institute)</label>
                </div>
              </div>
              <div class="input-group mb-3">
                <span class="input-group-text">🏫</span>
                <div class="form-floating">
                <input type="number" min="0" max="100" class="form-control" id="rG" name="resultGtu" step="0.01" placeholder="test" required>
                  <label for="rG">Result of subject (GTU)</label>
                </div>
              </div>
              <div class="input-group mb-3">
                <span class="input-group-text">📄</span>
                <span class="input-group-text smalltext">Attachment&nbsp;<i>(Max 2 MB PDF)</i></span>
                <input type="file" accept="application/pdf" class="form-control" id="attach" name="attachment" required>
              </div>
              <button type="submit" name="submitGR" class="button-55">Submit</button>
            </form>

            <!--DISC-->
            <form method="POST" action="" class="p-2" id="DISC" enctype="multipart/form-data">
              <hr>
              <div class="input-group mb-3">
                <span class="input-group-text">📓</span>
                <div class="form-floating">
                <input type="number" min="0" max="100" class="form-control" id="nooftlp" name="nooftlp" placeholder="test" required>
                  <label for="nooflwp">No of times Late Punch</label>
                </div>
              </div>
              <div class="input-group mb-3">
                <span class="input-group-text">📒</span>
                <div class="form-floating">
                <input type="number" min="0" max="100" class="form-control" id="nooflwp" name="nooflwp" placeholder="test" required>
                  <label for="nooflwp">No. of LWP</label>
                </div>
              </div>
              <div class="input-group mb-3">
                <span class="input-group-text">📕</span>
                <div class="form-floating">
                <input type="number" min="0" max="5" class="form-control" id="noofbl" name="noofbl" placeholder="test" required>
                  <label for="noofbl">No. of Balanced leave</label>
                </div>
              </div>
              <div class="input-group mb-3">
                <span class="input-group-text">📘</span>
                <div class="form-floating">
                <input type="number" min="0" max="5" class="form-control" id="noofm" name="noofm" placeholder="test" required>
                  <label for="noofm">No .of memo/justification/clarification</label>
                </div>
              </div>
              <div class="input-group mb-3">
                <span class="input-group-text">📙</span>
                <div class="form-floating">
                <input type="number" min="0" max="5" class="form-control" id="nooff" name="nooff" placeholder="test" required>
                  <label for="nooff">No .of Fine</label>
                </div>
              </div>
              <button type="submit" name="submitDISC" class="button-55">Submit</button>
            </form>

            <!--DP-->
            <form method="POST" action="" class="p-2" id="DP" enctype="multipart/form-data">
              <hr>

              <?php 

              $sqll = "SELECT * FROM Activity";
              $resultt = mysqli_query($conn, $sqll);
              if (mysqli_num_rows($resultt) > 0) {
                echo'
                <div class="input-group mb-3">
                <span class="input-group-text">📚</span>
                <div class="form-floating">
                <select class="form-control" name="port" id="port">
                      <option value="0">Select</option>';
                    while($roww = mysqli_fetch_assoc($resultt)) {
                        if($roww["type"]==0){
                            echo'<option value="'.$roww["name"].'">'.$roww["name"].'</option>';
                        }
                    }
                    echo'</select>
                    <label for="port">Portfolio</label>
                    </div>
                </div>';
              }

              ?>

              
              <div class="input-group mb-3">
                <span class="input-group-text">🧑‍🏫</span>
                <div class="form-floating">
                <select class="form-control" name="role" id="role">
                    <option value="0">Select</option>
                    <option value="1">Co-ordinator</option>
                    <option value="2">cocooordinator</option>
                    <option value="3">member</option>
                </select>
                  <label for="role">Role</label>
                </div>
              </div>
              <div class="input-group mb-3">
                <span class="input-group-text">📆</span>
                <div class="form-floating">
                <select class="form-control" name="duration" id="duration">
                    <option value="0">Select</option>
                    <option value="1">1 year</option>
                    <option value="2">0-6 month</option>
                </select>
                  <label for="duration">Duration</label>
                </div>
              </div>
              <div class="input-group mb-3">
                <span class="input-group-text">📄</span>
                <span class="input-group-text smalltext">Attachment&nbsp;<i>(Max 2 MB PDF)</i></span>
                <input type="file" accept="application/pdf" class="form-control" id="attach" name="attachment" required>
              </div>

              <button type="submit" name="submitDP" class="button-55">Submit</button>
            </form>

            <!--IP-->
            <form method="POST" action="" class="p-2" id="IP" enctype="multipart/form-data">
              <hr>

                <?php 

                $sqll = "SELECT * FROM Activity";
                $resultt = mysqli_query($conn, $sqll);
                if (mysqli_num_rows($resultt) > 0) {
                echo'
                <div class="input-group mb-3">
                <span class="input-group-text">📚</span>
                <div class="form-floating">
                <select class="form-control" name="port" id="port">
                        <option value="0">Select</option>';
                    while($roww = mysqli_fetch_assoc($resultt)) {
                        if($roww["type"]==1){
                            echo'<option value="'.$roww["name"].'">'.$roww["name"].'</option>';
                        }
                    }
                    echo'</select>
                    <label for="port">Portfolio</label>
                    </div>
                </div>';
                }

                ?>


                <div class="input-group mb-3">
                <span class="input-group-text">🧑‍🏫</span>
                <div class="form-floating">
                <select class="form-control" name="role" id="role">
                    <option value="0">Select</option>
                    <option value="1">Co-ordinator</option>
                    <option value="2">cocooordinator</option>
                    <option value="3">member</option>
                </select>
                    <label for="role">Role</label>
                </div>
                </div>
                <div class="input-group mb-3">
                <span class="input-group-text">📆</span>
                <div class="form-floating">
                <select class="form-control" name="duration" id="duration">
                    <option value="0">Select</option>
                    <option value="1">1 year</option>
                    <option value="2">0-6 month</option>
                </select>
                    <label for="duration">Duration</label>
                </div>
                </div>
                <div class="input-group mb-3">
                <span class="input-group-text">📄</span>
                <span class="input-group-text smalltext">Attachment&nbsp;<i>(Max 2 MB PDF)</i></span>
                <input type="file" accept="application/pdf" class="form-control" id="attach" name="attachment" required>
              </div>

              <button type="submit" name="submitIP" class="button-55">Submit</button>
            </form>

            <!--CTS-->
            <form method="POST" action="" class="p-2" id="CTS" enctype="multipart/form-data">
              <hr>
              <div class="input-group mb-3">
                <span class="input-group-text">📚</span>
                <div class="form-floating">
                
                <input type="text" class="form-control" id="activity" name="activity" placeholder="test" required>
                    <label for="activity">Activity</label>
                </div>
                </div>
                <div class="input-group mb-3">
                <span class="input-group-text">📆</span>
                <div class="form-floating">
                <input type="date" max="'.date('Y-m-d').'" class="form-control" id="date" name="date" placeholder="test" required>
                    <label for="date">Date</label>
                </div>
                </div>
                <div class="input-group mb-3">
                <span class="input-group-text">📄</span>
                <span class="input-group-text smalltext">Attachment&nbsp;<i>(Max 2 MB PDF)</i></span>
                <input type="file" accept="application/pdf" class="form-control" id="attach" name="attachment" required>
              </div>

              <button type="submit" name="submitCTS" class="button-55">Submit</button>
            </form>

            <!--RAA-->
            <div id="RAA" class="p-2">
              <hr>
                <select class="form-control snip1337" id="sraa">
                    <option value="ABC" selected>Select Criteria</option>
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

                    <div class="input-group mb-3">
                        <span class="input-group-text">🏫</span>
                        <div class="form-floating">
                        
                        <input type="text" class="form-control" id="activity" name="activity" placeholder="test" required>
                            <label for="activity">Activity</label>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">📆</span>
                        <div class="form-floating">
                        <input type="date" max="'.date('Y-m-d').'" class="form-control" id="date" name="date" placeholder="test" required>
                            <label for="date">Date</label>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text">🎚</span>
                        <div class="form-floating">
                        <select class="form-control" name="for" id="for">
                            <option value="0">Select</option>
                            <option value="1">Students</option>
                            <option value="2">Faculty</option>
                        </select>
                            <label for="date">For</label>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">🧑‍💼</span>
                        <div class="form-floating">
                        <input type="number" min="0" class="form-control" id="nop" name="nop" placeholder="test" required>
                            <label for="date">No of participants</label>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">🎚</span>
                        <div class="form-floating">
                        <select class="form-control" name="role" id="role">
                            <option value="0">Select</option>
                            <option value="1">Coordinator</option>
                            <option value="2">Co-coordinator</option>
                        </select>
                            <label for="date">Role</label>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">📄</span>
                        <span class="input-group-text smalltext">Attachment&nbsp;<i>(Max 2 MB PDF)</i></span>
                        <input type="file" accept="application/pdf" class="form-control" id="attach" name="attachment" required>
                    </div>

                    <button type="submit" name="submitRAA1" class="button-55">Submit</button>
                </form>

                <!--raa2-->
                <form method="POST" action="" class="p-2" id="raa2" enctype="multipart/form-data">
                    <hr>

                    <div class="input-group mb-3">
                        <span class="input-group-text">🏫</span>
                        <div class="form-floating">
                        
                        <input type="text" class="form-control" id="title" name="title" placeholder="test" required>
                            <label for="activity">Title</label>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">📆</span>
                        <div class="form-floating">
                        <input type="date" max="'.date('Y-m-d').'" class="form-control" id="date" name="date" placeholder="test" required>
                            <label for="date">Starting Date</label>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">🏫</span>
                        <div class="form-floating">
                        
                        <input type="text" class="form-control" id="place" name="place" placeholder="test" required>
                            <label for="activity">Place</label>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">📚</span>
                        <div class="form-floating">
                        
                        <input type="text" class="form-control" id="sa" name="sa" placeholder="test" required>
                            <label for="activity">Sponsoring Agency</label>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">🧑‍💼</span>
                        <div class="form-floating">
                        <input type="number" min="0" class="form-control" id="nop" name="nop" placeholder="test" required>
                            <label for="date">No of participants</label>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">🧑‍💼</span>
                        <div class="form-floating">
                        <input type="number" min="0" class="form-control" id="nod" name="nod" placeholder="test" required>
                            <label for="date">No of days</label>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">📄</span>
                        <span class="input-group-text smalltext">Attachment&nbsp;<i>(Max 2 MB PDF)</i></span>
                        <input type="file" accept="application/pdf" class="form-control" id="attach" name="attachment" required>
                    </div>

                    <button type="submit" name="submitRAA2" class="button-55">Submit</button>
                </form>

                <!--raa3-->
                <form method="POST" action="" class="p-2" id="raa3" enctype="multipart/form-data">
                    <hr>

                    <div class="input-group mb-3">
                        <span class="input-group-text">📘</span>
                        <div class="form-floating">
                        
                        <input type="text" class="form-control" id="name" name="name" placeholder="test" required>
                            <label for="activity">Name of Course</label>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">📆</span>
                        <div class="form-floating">
                        <input type="date" max="'.date('Y-m-d').'" class="form-control" id="date" name="date" placeholder="test" required>
                            <label for="date">Date</label>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">📆</span>
                        <div class="form-floating">
                        
                        <input type="number" min="0" max="8" class="form-control" id="nod" name="nod" placeholder="test" required>
                            <label for="activity">Duration in week</label>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">📆</span>
                        <div class="form-floating">
                        <input type="date" max="'.date('Y-m-d').'" class="form-control" id="dateoe" name="dateoe" placeholder="test" required>
                            <label for="date">Date of Examination</label>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">📄</span>
                        <span class="input-group-text smalltext">Attachment&nbsp;<i>(Max 2 MB PDF)</i></span>
                        <input type="file" accept="application/pdf" class="form-control" id="attach" name="attachment" required>
                    </div>

                    <button type="submit" name="submitRAA3" class="button-55">Submit</button>
                </form>

                <!--raa4-->
                <form method="POST" action="" class="p-2" id="raa4" enctype="multipart/form-data">
                    <hr>


                    <div class="input-group mb-3">
                        <span class="input-group-text">🏫</span>
                        <div class="form-floating">
                        
                        <input type="text" class="form-control" id="name" name="name" placeholder="test" required>
                            <label for="activity">Name of orgnization</label>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">📆</span>
                        <div class="form-floating">
                        <input type="date" max="'.date('Y-m-d').'" class="form-control" id="date" name="date" placeholder="test" required>
                            <label for="date">Date</label>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">📑</span>
                        <div class="form-floating">
                        <select class="form-control" name="type" id="type">
                            <option value="0">Select</option>
                            <option value="1">National</option>
                            <option value="2">International</option>
                        </select>
                            <label for="activity">Type</label>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">🔢</span>
                        <div class="form-floating">
                        <input  type="number" min="0" class="form-control" id="nom" name="nom" placeholder="test" required>
                            <label for="date">Membership Number</label>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">📄</span>
                        <span class="input-group-text smalltext">Attachment&nbsp;<i>(Max 2 MB PDF)</i></span>
                        <input type="file" accept="application/pdf" class="form-control" id="attach" name="attachment" required>
                    </div>

                    <button type="submit" name="submitRAA4" class="button-55">Submit</button>
                </form>

                <!--raa5-->
                <form method="POST" action="" class="p-2" id="raa5" enctype="multipart/form-data">
                    <hr>
                    <div class="input-group mb-3">
                        <span class="input-group-text">✍</span>
                        <div class="form-floating">
                        <input type="text" class="form-control" id="name" name="name" placeholder="test" required>
                            <label for="date">Name of authors</label>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">📑</span>
                        <div class="form-floating">
                        <input type="text" class="form-control" id="title" name="title" placeholder="test" required>
                            <label for="date">Page title</label>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">📘</span>
                        <div class="form-floating">
                        <select class="form-control" name="index" id="index">
                            <option value="0">Select</option>
                            <option value="1">SCi</option>
                            <option value="2">Scoupus</option>
                            <option value="3">UGC</option>
                            <option value="4">IJET</option>
                        </select>
                            <label for="date">Indexing</label>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">📑</span>
                        <div class="form-floating">
                        
                        <input type="text" class="form-control" id="issn" name="issn" placeholder="test" required>
                            <label for="activity">ISSN No</label>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">📔</span>
                        <div class="form-floating">
                        
                        <input type="text" class="form-control" id="journal" name="journal" placeholder="test" required>
                            <label for="activity">Journal name</label>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">📓</span>
                        <div class="form-floating">
                        
                        <input type="text" class="form-control" id="vpage" name="vpage" placeholder="test" required>
                            <label for="activity">Volumn page</label>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">📄</span>
                        <span class="input-group-text smalltext">Attachment&nbsp;<i>(Max 2 MB PDF)</i></span>
                        <input type="file" accept="application/pdf" class="form-control" id="attach" name="attachment" required>
                    </div>

                    <button type="submit" name="submitRAA5" class="button-55">Submit</button>
                </form>

                <!--raa6-->
                <form method="POST" action="" class="p-2" id="raa6" enctype="multipart/form-data">
                    <hr>

                    <div class="input-group mb-3">
                        <span class="input-group-text">✍</span>
                        <div class="form-floating">
                        <input type="text" class="form-control" id="name" name="name" placeholder="test" required>
                            <label for="date">Name of authors</label>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">📘</span>
                        <div class="form-floating">
                        <input type="text" class="form-control" id="pi" name="pi" placeholder="test" required>
                            <label for="date">Publisher & Indexing</label>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">📚</span>
                        <div class="form-floating">
                        <input type="text" class="form-control" id="cvp" name="cvp" placeholder="test" required>
                            <label for="date">Name of conference,volumn,page</label>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">📓</span>
                        <div class="form-floating">
                        <select class="form-control" name="pp" id="pp">
                            <option value="0">Select</option>
                            <option value="1">Presented International</option>
                            <option value="2">Presented National</option>
                            <option value="3">Publish</option>
                        </select>
                            <label for="date">Presented/Publish</label>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">📄</span>
                        <span class="input-group-text smalltext">Attachment&nbsp;<i>(Max 2 MB PDF)</i></span>
                        <input type="file" accept="application/pdf" class="form-control" id="attach" name="attachment" required>
                    </div>

                    <button type="submit" name="submitRAA6" class="button-55">Submit</button>
                </form>

                <!--raa7-->
                <form method="POST" action="" class="p-2" id="raa7" enctype="multipart/form-data">
                    <hr>

                    <div class="input-group mb-3">
                        <span class="input-group-text">📑</span>
                        <div class="form-floating">
                        <input type="text" class="form-control" id="title" name="title" placeholder="test" required>
                            <label for="date">Title of book</label>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">📆</span>
                        <div class="form-floating">
                        <input type="text" class="form-control" id="year" name="year" placeholder="test" required>
                            <label for="date">Year</label>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">✍</span>
                        <div class="form-floating">
                        <input type="text" class="form-control" id="authors" name="authors" placeholder="test" required>
                            <label for="date">Authors</label>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">📙</span>
                        <div class="form-floating">
                        <select class="form-control" name="pub" id="pub">
                            <option value="0">Select One</option>
                            <option value="1">International Publisher</option>
                            <option value="2">National Publisher</option>
                            <option value="3">chapter in edited book</option>
                            <option value="4">editor of book by international publisher</option>
                            <option value="5">editor of book by any publisher</option>
                        </select>
                            <label for="date">Publisher</label>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">📄</span>
                        <span class="input-group-text smalltext">Attachment&nbsp;<i>(Max 2 MB PDF)</i></span>
                        <input type="file" accept="application/pdf" class="form-control" id="attach" name="attachment" required>
                    </div>

                    <button type="submit" name="submitRAA7" class="button-55">Submit</button>
                </form>

                <!--raa8-->
                <form method="POST" action="" class="p-2" id="raa8" enctype="multipart/form-data">
                    <hr>
                    
                    <div class="input-group mb-3">
                        <span class="input-group-text">📒</span>
                        <div class="form-floating">
                        <select class="form-control" name="semester" id="sem">
                            <option value="0">Select</option>
                            <option value="1">Sem 1</option>
                            <option value="2">Sem 2</option>
                            <option value="3">Sem 3</option>
                            <option value="4">Sem 4</option>
                            <option value="5">Sem 5</option>
                            <option value="6">Sem 6</option>
                            <option value="7">Sem 7</option>
                            <option value="8">Sem 8</option>
                        </select>
                        <label for="sem">Semester</label>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">📘</span>
                        <div class="form-floating">
                        <select class="form-control" name="subdrop" id="subdrop">
                            <option value="0">Select</option>
                        </select>
                        <label for="sem">Subject Code</label>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">📕</span>
                        <div class="form-floating">
                        <input type="text" class="form-control" id="subNameraa8" name="subName" placeholder="subject name" required readonly>
                        <label for="sub">Subject Name</label>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text">🔗</span>
                        <div class="form-floating">
                        <input type="text" class="form-control" id="link" name="link" placeholder="test" required>
                            <label for="date">Link</label>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">📄</span>
                        <span class="input-group-text smalltext">Attachment&nbsp;<i>(Max 2 MB PDF)</i></span>
                        <input type="file" accept="application/pdf" class="form-control" id="attach" name="attachment" required>
                    </div>

                    <button type="submit" name="submitRAA8" class="button-55">Submit</button>
                </form>

                <!--raa9-->
                <form method="POST" action="" class="p-2" id="raa9" enctype="multipart/form-data">
                    <hr>

                    <div class="input-group mb-3">
                        <span class="input-group-text">📘</span>
                        <div class="form-floating">
                        <select class="form-control" name="name" id="name">
                            <option value="0">Select</option>
                        </select>
                        <label for="sem">Patent\'s Name</label>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">📒</span>
                        <div class="form-floating">
                        <select class="form-control" name="o1" id="o1">
                            <option value="0">Select One</option>
                            <option value="1">International Grant</option>
                            <option value="2">International Grant + Publish</option>
                            <option value="3">National Grant</option>
                            <option value="4">National Grant + Publish</option>
                        </select>
                        <label for="sem">Option</label>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">📄</span>
                        <span class="input-group-text smalltext">Attachment&nbsp;<i>(Max 2 MB PDF)</i></span>
                        <input type="file" accept="application/pdf" class="form-control" id="attach" name="attachment" required>
                    </div>

                    <button type="submit" name="submitRAA9" class="button-55">Submit</button>
                </form>

                <!--raa10-->
                <form method="POST" action="" class="p-2" id="raa10" enctype="multipart/form-data">
                    <hr>

                    <div class="input-group mb-3">
                        <span class="input-group-text">📒</span>
                        <div class="form-floating">
                        <select class="form-control" name="name" id="o1">
                            <option value="0">Select</option>
                            <option value="1">Ph.D</option>
                            <option value="2">Ph.D + Thesis</option>
                            <option value="3">PG Dissertiation</option>
                            <option value="4">UG Project</option>
                        </select>
                        <label for="sem">Program</label>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">🔢</span>
                        <div class="form-floating">
                        <input type="number" min="0" class="form-control" id="noc" name="noc" placeholder="test" required>
                        <label for="sem">No of candidate/team/group</label>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">🏫</span>
                        <div class="form-floating">
                        <input type="text" class="form-control" id="name" name="nameou" placeholder="test" required>
                        <label for="sem">Name of University</label>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">📄</span>
                        <span class="input-group-text smalltext">Attachment&nbsp;<i>(Max 2 MB PDF)</i></span>
                        <input type="file" accept="application/pdf" class="form-control" id="attach" name="attachment" required>
                    </div>

                    <button type="submit" name="submitRAA10" class="button-55">Submit</button>
                </form>
            </div>

            <!--INV-->
            <form method="POST" action="" class="p-2" id="INV" enctype="multipart/form-data">
                <hr>
                <div class="input-group mb-3">
                    <span class="input-group-text">🏫</span>
                    <div class="form-floating">
                    
                    <input type="text" class="form-control" id="subC" name="nameIns" placeholder="test" required>
                        <label for="activity">Name of Institute</label>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text">🎚</span>
                    <div class="form-floating">
                    <select class="form-control" name="levelIns" id="levelIns">
                        <option value="0">Select</option>
                        <option value="1">International</option>
                        <option value="2">National</option>
                        <option value="3">State/Uni/Local</option>
                    </select>
                        <label for="date">Level of institute</label>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text">📆</span>
                    <div class="form-floating">
                    <input type="date" max="'.date('Y-m-d').'" class="form-control" id="date" name="date" placeholder="test" required>
                        <label for="date">Date</label>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text">🧑‍💼</span>
                    <div class="form-floating">
                    <input type="text" class="form-control" id="topic" name="topic" placeholder="test" required>
                        <label for="date">Topic name/Type of work</label>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text">📄</span>
                    <span class="input-group-text smalltext">Attachment&nbsp;<i>(Max 2 MB PDF)</i></span>
                    <input type="file" accept="application/pdf" class="form-control" id="attach" name="attachment" required>
                </div>

              <button type="submit" name="submitINV" class="button-55">Submit</button>
            </form>

            <!--AO-->
            <form method="POST" action="" class="p-2" id="AO" enctype="multipart/form-data">
              <hr>

              <div class="input-group mb-3">
                    <span class="input-group-text">🧑‍💼</span>
                    <div class="form-floating">
                    <input type="text" class="form-control" id="work" name="work" placeholder="test" required>
                        <label for="date">Title Of Work</label>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text">📄</span>
                    <span class="input-group-text smalltext">Attachment&nbsp;<i>(Max 2 MB PDF)</i></span>
                    <input type="file" accept="application/pdf" class="form-control" id="attach" name="attachment" required>
                </div>
              <button type="submit" name="submitAO" class="button-55">Submit</button>
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


        <div class="col-lg p-2 mb-1 bg-body rounded border border border-2">
          <div class="form-group">
            <p class="form-control snip1337"> Editable Activity </p>
              <form method="POST" action="" class="p-2" enctype="multipart/form-data" class="table-responsive">
                <table class="table table-hover table-center text-center" id="table22">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Criteria</th>
                    <th scope="col">Element</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Lock</th>
                    <th scope="col">Delete</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 

                  $i=1;
                  $a=$_SESSION["id"];

                  $sql = "SELECT * FROM TLP WHERE id='".$a."' AND log<'".date("Y")."-07-01' AND log>='".date("Y", time() - 60*60*24*365 )."-07-01' ORDER BY log DESC";
                  $result = mysqli_query($conn, $sql);
                  if (mysqli_num_rows($result) > 0) {
                      while($row = mysqli_fetch_assoc($result)) {
                          if($row["locked"]==0){
                              if($row["comment"]!=""){
                                  echo '<tr class="bg-danger bg-opacity-25">';
                              }
                              else{
                                  echo '<tr >';
                              }
                              echo ' 
                                  <th scope="row" style="padding: 0 auto;">'.$i.'</th>
                                  <td data-bs-toggle="tooltip" data-bs-title="Teaching Learning Process" data-bs-placement="left">TLP</td>
                                  <td>'.$row["subject"].'</td>
                                  <td><!-- Button trigger modal -->
                                  <button type="button" class="button-29" data-bs-toggle="modal" data-bs-target="#TLP'.$row["subject"].'"><i class="fa-solid fa-pen fs-6"></i></button></td><td>
                                  <button type="submit" name="lock" value="'.$row["subject"].'_subject_TLP" class="button-31"><i class="fa-solid fa-lock fs-6"></i></button></td><td>
                                  <button type="submit" name="del" value="'.$row["subject"].'_subject_TLP" class="button-30"><i class="fa-solid fa-trash fs-6"></i></button></td>
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
                                          <input type="number" min="0" value="'.$row["scheduleClass"].'" class="form-control" id="schedule" name="scheduleClass">
                                      </div>
                                      <div class="form-group p-2">
                                          <label for="actual">No. of actual classes</label>
                                          <input type="number" min="0" value="'.$row["actualClass"].'" class="form-control" id="actual" name="actualClass">
                                      </div>
                                      <div class="form-group p-2">
                                          <label for="attach">Attachment <i>(Max 2 MB PDF)</i> &nbsp;&nbsp;
                                          <a class="float-end" href="../../document/'.$a.'/'.$row["attachment"].'" target="_blank" >View</a></label>
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
                                      <button type="submit" name="editTLP" value="'.$row["subject"].'" class="button-55 m-2">Update</button>
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

                  $sql = "SELECT * FROM GR WHERE id='".$a."' AND log<'".date("Y")."-07-01' AND log>='".date("Y", time() - 60*60*24*365 )."-07-01' ORDER BY log DESC";
                  $result = mysqli_query($conn, $sql);
                  if (mysqli_num_rows($result) > 0) {
                      
                      while($row = mysqli_fetch_assoc($result)) {
                          if($row["locked"]==0){
                              if($row["comment"]!=""){
                                  echo '<tr class="bg-danger bg-opacity-25">';
                              }
                              else{
                                  echo '<tr>';
                              }
                              echo ' 
                                  <th scope="row">'.$i.'</th>
                                  <td data-bs-toggle="tooltip" data-bs-title="GTU Result" data-bs-placement="left">GR</td>
                                  <td>'.$row["subject"].'</td>
                                  <td><!-- Button trigger modal -->
                                  <button type="button" class="button-29" data-bs-toggle="modal" data-bs-target="#GR'.$row["subject"].'"><i class="fa-solid fa-pen fs-6"></i></button></td><td>
                                  <button type="submit" name="lock" value="'.$row["subject"].'_subject_GR" class="button-31"><i class="fa-solid fa-lock fs-6"></i></button></td><td>
                                  <button type="submit" name="del" value="'.$row["subject"].'_subject_GR" class="button-30"><i class="fa-solid fa-trash fs-6"></i></button></button></td>
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
                                          <label for="attach">Attachment <i>(Max 2 MB PDF)</i> &nbsp; &nbsp; 
                                          <a href="../../document/'.$a.'/'.$row["attachment"].'" target="_blank" >View</a></label>
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
                                      <button type="submit" name="editGR" value="'.$row["subject"].'" class="button-55 m-2">Update</button>
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

                  $sql = "SELECT * FROM DISC WHERE id='".$a."' AND log<'".date("Y")."-07-01' AND log>='".date("Y", time() - 60*60*24*365 )."-07-01' ORDER BY log DESC";
                  $result = mysqli_query($conn, $sql);
                  if (mysqli_num_rows($result) > 0) {
                      
                      while($row = mysqli_fetch_assoc($result)) {
                          if($row["locked"]==0){
                              if($row["comment"]!=""){
                                  echo '<tr class="bg-danger bg-opacity-25">';
                              }
                              else{
                                  echo '<tr>';
                              }
                              echo ' 
                                  <th scope="row">'.$i.'</th>
                                  <td data-bs-toggle="tooltip" data-bs-title="Discipline" data-bs-placement="left">DISC</td>
                                  <td>'.$row["id"].'</td>
                                  <td><!-- Button trigger modal -->
                                  <button type="button" class="button-29" data-bs-toggle="modal" data-bs-target="#DISC'.$row["id"].'"><i class="fa-solid fa-pen fs-6"></i></button></td><td>
                                  <button type="submit" name="lock" value="DISC" class="button-31"><i class="fa-solid fa-lock fs-6"></i></button></td><td>
                                  <button type="submit" name="del" value="DISC" class="button-30"><i class="fa-solid fa-trash fs-6"></i></button></button></td>
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
                                      <div class="alert alert-primary text-center p-1" role="alert">
                                      Discipline
                                      </div>
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
                                      <button type="submit" name="editDISC" value="'.$row["id"].'" class="button-55 m-2">Update</button>
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

                  $sql = "SELECT * FROM DP WHERE id='".$a."' AND log<'".date("Y")."-07-01' AND log>='".date("Y", time() - 60*60*24*365 )."-07-01' ORDER BY log DESC";
                  $result = mysqli_query($conn, $sql);
                  if (mysqli_num_rows($result) > 0) {
                      while($row = mysqli_fetch_assoc($result)) {
                          if($row["locked"]==0){
                              if($row["comment"]!=""){
                                  echo '<tr class="bg-danger bg-opacity-25">';
                              }
                              else{
                                  echo '<tr>';
                              }
                              echo ' 
                                  <th scope="row">'.$i.'</th>
                                  <td data-bs-toggle="tooltip" data-bs-title="Departmental Portfolio" data-bs-placement="left">DP</td>
                                  <td>'.$row["name"].'</td>
                                  <td><!-- Button trigger modal -->
                                  <button type="button" class="button-29" data-bs-toggle="modal" data-bs-target="#DP'.$row["name"].'"><i class="fa-solid fa-pen fs-6"></i></button></td><td>
                                  <button type="submit" name="lock" value="'.$row["name"].'_name_DP" class="button-31"><i class="fa-solid fa-lock fs-6"></i></button></td><td>
                                  <button type="submit" name="del" value="'.$row["name"].'_name_DP" class="button-30"><i class="fa-solid fa-trash fs-6"></i></button></button></td>
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
                                      <div class="alert alert-primary text-center p-1" role="alert">
                                      Departmental Portfolio
                                      </div>
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
                                          <label for="attach">Attachment <i>(Max 2 MB PDF)</i> &nbsp; &nbsp;
                                          <a href="../../document/'.$a.'/'.$row["attachment"].'" target="_blank" >View</a></label>
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
                                      <button type="submit" name="editDP" value="'.$row["name"].'" class="button-55 m-2">Update</button>
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

                  $sql = "SELECT * FROM IP WHERE id='".$a."' AND log<'".date("Y")."-07-01' AND log>='".date("Y", time() - 60*60*24*365 )."-07-01' ORDER BY log DESC";
                  $result = mysqli_query($conn, $sql);
                  if (mysqli_num_rows($result) > 0) {
                      while($row = mysqli_fetch_assoc($result)) {
                          if($row["locked"]==0){
                              if($row["comment"]!=""){
                                  echo '<tr class="bg-danger bg-opacity-25">';
                              }
                              else{
                                  echo '<tr>';
                              }
                              echo ' 
                                  <th scope="row">'.$i.'</th>
                                  <td data-bs-toggle="tooltip" data-bs-title="Institute Portfolio" data-bs-placement="left">IP</td>
                                  <td>'.$row["name"].'</td>
                                  <td><!-- Button trigger modal -->
                                  <button type="button" class="button-29" data-bs-toggle="modal" data-bs-target="#IP'.$row["name"].'"><i class="fa-solid fa-pen fs-6"></i></button></td><td>
                                  <button type="submit" name="lock" value="'.$row["name"].'_name_IP" class="button-31"><i class="fa-solid fa-lock fs-6"></i></button></td><td>
                                  <button type="submit" name="del" value="'.$row["name"].'_name_IP" class="button-30"><i class="fa-solid fa-trash fs-6"></i></button></button></td>
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
                                      <div class="alert alert-primary text-center p-1" role="alert">
                                      Institute Portfolio
                                      </div>
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
                                          <label for="attach">Attachment <i>(Max 2 MB PDF)</i> &nbsp; &nbsp;
                                          <a href="../../document/'.$a.'/'.$row["attachment"].'" target="_blank" >View</a></label>
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
                                      <button type="submit" name="editIP" value="'.$row["name"].'" class="button-55 m-2">Update</button>
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

                  $sql = "SELECT * FROM CTS WHERE id='".$a."' AND log<'".date("Y")."-07-01' AND log>='".date("Y", time() - 60*60*24*365 )."-07-01' ORDER BY log DESC";
                  $result = mysqli_query($conn, $sql);
                  if (mysqli_num_rows($result) > 0) {
                      
                      while($row = mysqli_fetch_assoc($result)) {
                          if($row["locked"]==0){
                              if($row["comment"]!=""){
                                  echo '<tr class="bg-danger bg-opacity-25">';
                              }
                              else{
                                  echo '<tr>';
                              }
                              echo ' 
                                  <th scope="row">'.$i.'</th>
                                  <td data-bs-toggle="tooltip" data-bs-title="Contribution to Society" data-bs-placement="left">CTS</td>
                                  <td>'.$row["date"].'</td>
                                  <td><!-- Button trigger modal -->
                                  <button type="button" class="button-29" data-bs-toggle="modal" data-bs-target="#CTS'.$row["date"].'"><i class="fa-solid fa-pen fs-6"></i></button></td><td>
                                  <button type="submit" name="lock" value="'.$row["date"].'_date_CTS" class="button-31"><i class="fa-solid fa-lock fs-6"></i></button></td><td>
                                  <button type="submit" name="del" value="'.$row["date"].'_date_CTS" class="button-30"><i class="fa-solid fa-trash fs-6"></i></button></button></td>
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
                                      <div class="alert alert-primary text-center p-1" role="alert">
                                      Contribution to Society
                                      </div>
                                      <div class="form-group p-2">
                                          <label for="subC">Date</label>
                                          <input type="text" class="form-control" value="'.$row["date"].'" id="subC" name="date" readonly>
                                      </div>
                                      <div class="form-group p-2">
                                          <label for="subN">Name of Institute</label>
                                          <input type="text" class="form-control" value="'.$row["activity"].'" id="subN" name="activity">
                                      </div>
                                      <div class="form-group p-2">
                                          <label for="attach">Attachment <i>(Max 2 MB PDF)</i> &nbsp; &nbsp; 
                                          <a href="../../document/'.$a.'/'.$row["attachment"].'" target="_blank" >View</a></label>
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
                                      <button type="submit" name="editCTS" value="'.$row["date"].'" class="button-55 m-2">Update</button>
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

                  $sql = "SELECT * FROM RAA1 WHERE id='".$a."' AND log<'".date("Y")."-07-01' AND log>='".date("Y", time() - 60*60*24*365 )."-07-01' ORDER BY log DESC";
                  $result = mysqli_query($conn, $sql);
                  if (mysqli_num_rows($result) > 0) {
                      
                      while($row = mysqli_fetch_assoc($result)) {
                          if($row["locked"]==0){
                              if($row["comment"]!=""){
                                  echo '<tr class="bg-danger bg-opacity-25">';
                              }
                              else{
                                  echo '<tr>';
                              }
                              echo ' 
                                  <th scope="row">'.$i.'</th>
                                  <td data-bs-toggle="tooltip" data-bs-title="Seminar, Workshop, Technical or motivational Training organized" data-bs-placement="left">RAA1</td>
                                  <td>'.$row["date"].'</td>
                                  <td><!-- Button trigger modal -->
                                  <button type="button" class="button-29" data-bs-toggle="modal" data-bs-target="#RAA1'.$row["date"].'"><i class="fa-solid fa-pen fs-6"></i></button></td><td>
                                  <button type="submit" name="lock" value="'.$row["date"].'_date_RAA1" class="button-31"><i class="fa-solid fa-lock fs-6"></i></button></td><td>
                                  <button type="submit" name="del" value="'.$row["date"].'_date_RAA1" class="button-30"><i class="fa-solid fa-trash fs-6"></i></button></button></td>
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
                                      <div class="alert alert-primary text-center p-1" role="alert">
                                      Seminar, Workshop, Technical or motivational Training organized
                                      </div>
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
                                          <label for="attach">Attachment <i>(Max 2 MB PDF)</i> &nbsp; &nbsp; 
                                          <a href="../../document/'.$a.'/'.$row["attachment"].'" target="_blank" >View</a></label>
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
                                      <button type="submit" name="editRAA1" value="'.$row["date"].'" class="button-55 m-2">Update</button>
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

                  $sql = "SELECT * FROM RAA2 WHERE id='".$a."' AND log<'".date("Y")."-07-01' AND log>='".date("Y", time() - 60*60*24*365 )."-07-01' ORDER BY log DESC";
                  $result = mysqli_query($conn, $sql);
                  if (mysqli_num_rows($result) > 0) {
                      
                      while($row = mysqli_fetch_assoc($result)) {
                          if($row["locked"]==0){
                              if($row["comment"]!=""){
                                  echo '<tr class="bg-danger bg-opacity-25">';
                              }
                              else{
                                  echo '<tr>';
                              }
                              echo ' 
                                  <th scope="row">'.$i.'</th>
                                  <td data-bs-toggle="tooltip" data-bs-title="FDP/ STTP organized" data-bs-placement="left">RAA2</td>
                                  <td>'.$row["date"].'</td>
                                  <td><!-- Button trigger modal -->
                                  <button type="button" class="button-29" data-bs-toggle="modal" data-bs-target="#RAA2'.$row["date"].'"><i class="fa-solid fa-pen fs-6"></i></button></td><td>
                                  <button type="submit" name="lock" value="'.$row["date"].'_date_RAA2" class="button-31"><i class="fa-solid fa-lock fs-6"></i></button></td><td>
                                  <button type="submit" name="del" value="'.$row["date"].'_date_RAA2" class="button-30"><i class="fa-solid fa-trash fs-6"></i></button></button></td>
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
                                      <div class="alert alert-primary text-center p-1" role="alert">
                                      FDP/ STTP organized
                                      </div>
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
                                          <label for="attach">Attachment <i>(Max 2 MB PDF)</i> &nbsp; &nbsp; 
                                          <a href="../../document/'.$a.'/'.$row["attachment"].'" target="_blank" >View</a></label>
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
                                      <button type="submit" name="editRAA2" value="'.$row["date"].'" class="button-55 m-2">Update</button>
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

                  $sql = "SELECT * FROM RAA3 WHERE id='".$a."' AND log<'".date("Y")."-07-01' AND log>='".date("Y", time() - 60*60*24*365 )."-07-01' ORDER BY log DESC";
                  $result = mysqli_query($conn, $sql);
                  if (mysqli_num_rows($result) > 0) {
                      
                      while($row = mysqli_fetch_assoc($result)) {
                          if($row["locked"]==0){
                              if($row["comment"]!=""){
                                  echo '<tr class="bg-danger bg-opacity-25">';
                              }
                              else{
                                  echo '<tr>';
                              }
                              echo ' 
                                  <th scope="row">'.$i.'</th>
                                  <td data-bs-toggle="tooltip" data-bs-title="Participation in MOOCS courses" data-bs-placement="left">RAA3</td>
                                  <td>'.$row["date"].'</td>
                                  <td><!-- Button trigger modal -->
                                  <button type="button" class="button-29" data-bs-toggle="modal" data-bs-target="#RAA3'.$row["date"].'"><i class="fa-solid fa-pen fs-6"></i></button></td><td>
                                  <button type="submit" name="lock" value="'.$row["date"].'_date_RAA3" class="button-31"><i class="fa-solid fa-lock fs-6"></i></button></td><td>
                                  <button type="submit" name="del" value="'.$row["date"].'_date_RAA3" class="button-30"><i class="fa-solid fa-trash fs-6"></i></button></button></td>
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
                                      <div class="alert alert-primary text-center p-1" role="alert">
                                      Participation in MOOCS courses
                                      </div>
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
                                          <label for="attach">Attachment <i>(Max 2 MB PDF)</i> &nbsp; &nbsp; 
                                          <a href="../../document/'.$a.'/'.$row["attachment"].'" target="_blank" >View</a></label>
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
                                      <button type="submit" name="editRAA3" value="'.$row["date"].'" class="button-55 m-2">Update</button>
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

                  $sql = "SELECT * FROM RAA4 WHERE id='".$a."' AND log<'".date("Y")."-07-01' AND log>='".date("Y", time() - 60*60*24*365 )."-07-01' ORDER BY log DESC";
                  $result = mysqli_query($conn, $sql);
                  if (mysqli_num_rows($result) > 0) {
                      
                      while($row = mysqli_fetch_assoc($result)) {
                          if($row["locked"]==0){
                              if($row["comment"]!=""){
                                  echo '<tr class="bg-danger bg-opacity-25">';
                              }
                              else{
                                  echo '<tr>';
                              }
                              echo ' 
                                  <th scope="row">'.$i.'</th>
                                  <td data-bs-toggle="tooltip" data-bs-title="Membership of Associations or Professional Bodies" data-bs-placement="left">RAA4</td>
                                  <td>'.$row["date"].'</td>
                                  <td><!-- Button trigger modal -->
                                  <button type="button" class="button-29" data-bs-toggle="modal" data-bs-target="#RAA4'.$row["date"].'"><i class="fa-solid fa-pen fs-6"></i></button></td><td>
                                  <button type="submit" name="lock" value="'.$row["date"].'_date_RAA4" class="button-31"><i class="fa-solid fa-lock fs-6"></i></button></td><td>
                                  <button type="submit" name="del" value="'.$row["date"].'_date_RAA4" class="button-30"><i class="fa-solid fa-trash fs-6"></i></button></button></td>
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
                                      <div class="alert alert-primary text-center p-1" role="alert">
                                      Membership of Associations or Professional Bodies
                                      </div>
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
                                          <label for="attach">Attachment <i>(Max 2 MB PDF)</i> &nbsp; &nbsp; 
                                          <a href="../../document/'.$a.'/'.$row["attachment"].'" target="_blank" >View</a></label>
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
                                      <button type="submit" name="editRAA4" value="'.$row["date"].'" class="button-55 m-2">Update</button>
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

                  $sql = "SELECT * FROM RAA5 WHERE id='".$a."' AND log<'".date("Y")."-07-01' AND log>='".date("Y", time() - 60*60*24*365 )."-07-01' ORDER BY log DESC";
                  $result = mysqli_query($conn, $sql);
                  if (mysqli_num_rows($result) > 0) {
                      
                      while($row = mysqli_fetch_assoc($result)) {
                          if($row["locked"]==0){
                              if($row["comment"]!=""){
                                  echo '<tr class="bg-danger bg-opacity-25">';
                              }
                              else{
                                  echo '<tr>';
                              }
                              echo ' 
                                  <th scope="row">'.$i.'</th>
                                  <td data-bs-toggle="tooltip" data-bs-title="Research paper publication in peer reviewed journal" data-bs-placement="left">RAA5</td>
                                  <td>'.$row["name"].'</td>
                                  <td><!-- Button trigger modal -->
                                  <button type="button" class="button-29" data-bs-toggle="modal" data-bs-target="#RAA5'.$row["name"].'"><i class="fa-solid fa-pen fs-6"></i></button></td><td>
                                  <button type="submit" name="lock" value="'.$row["name"].'_name_RAA5" class="button-31"><i class="fa-solid fa-lock fs-6"></i></button></td><td>
                                  <button type="submit" name="del" value="'.$row["name"].'_name_RAA5" class="button-30"><i class="fa-solid fa-trash fs-6"></i></button></button></td>
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
                                      <div class="alert alert-primary text-center p-1" role="alert">
                                      Research paper publication in peer reviewed journal
                                      </div>
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
                                          <label for="attach">Attachment <i>(Max 2 MB PDF)</i> &nbsp; &nbsp; 
                                          <a href="../../document/'.$a.'/'.$row["attachment"].'" target="_blank" >View</a></label>
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
                                      <button type="submit" name="editRAA5" value="'.$row["name"].'" class="button-55 m-2">Update</button>
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

                  $sql = "SELECT * FROM RAA6 WHERE id='".$a."' AND log<'".date("Y")."-07-01' AND log>='".date("Y", time() - 60*60*24*365 )."-07-01' ORDER BY log DESC";
                  $result = mysqli_query($conn, $sql);
                  if (mysqli_num_rows($result) > 0) {
                      
                      while($row = mysqli_fetch_assoc($result)) {
                          if($row["locked"]==0){
                              if($row["comment"]!=""){
                                  echo '<tr class="bg-danger bg-opacity-25">';
                              }
                              else{
                                  echo '<tr>';
                              }
                              echo ' 
                                  <th scope="row">'.$i.'</th>
                                  <td data-bs-toggle="tooltip" data-bs-title="Research paper publication in Conference" data-bs-placement="left">RAA6</td>
                                  <td>'.$row["name"].'</td>
                                  <td><!-- Button trigger modal -->
                                  <button type="button" class="button-29" data-bs-toggle="modal" data-bs-target="#RAA6'.$row["name"].'"><i class="fa-solid fa-pen fs-6"></i></button></td><td>
                                  <button type="submit" name="lock" value="'.$row["name"].'_name_RAA6" class="button-31"><i class="fa-solid fa-lock fs-6"></i></button></td><td>
                                  <button type="submit" name="del" value="'.$row["name"].'_name_RAA6" class="button-30"><i class="fa-solid fa-trash fs-6"></i></button></button></td>
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
                                      <div class="alert alert-primary text-center p-1" role="alert">
                                      Research paper publication in Conference
                                      </div>
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
                                          <label for="attach">Attachment <i>(Max 2 MB PDF)</i> &nbsp; &nbsp; 
                                          <a href="../../document/'.$a.'/'.$row["attachment"].'" target="_blank" >View</a></label>
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
                                      <button type="submit" name="editRAA6" value="'.$row["name"].'" class="button-55 m-2">Update</button>
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

                  $sql = "SELECT * FROM RAA7 WHERE id='".$a."' AND log<'".date("Y")."-07-01' AND log>='".date("Y", time() - 60*60*24*365 )."-07-01' ORDER BY log DESC";
                  $result = mysqli_query($conn, $sql);
                  if (mysqli_num_rows($result) > 0) {
                      
                      while($row = mysqli_fetch_assoc($result)) {
                          if($row["locked"]==0){
                              if($row["comment"]!=""){
                                  echo '<tr class="bg-danger bg-opacity-25">';
                              }
                              else{
                                  echo '<tr>';
                              }
                              echo ' 
                                  <th scope="row">'.$i.'</th>
                                  <td data-bs-toggle="tooltip" data-bs-title="Books authored" data-bs-placement="left">RAA7</td>
                                  <td>'.$row["title"].'</td>
                                  <td><!-- Button trigger modal -->
                                  <button type="button" class="button-29" data-bs-toggle="modal" data-bs-target="#RAA7'.$row["title"].'"><i class="fa-solid fa-pen fs-6"></i></button></td><td>
                                  <button type="submit" name="lock" value="'.$row["title"].'_title_RAA7" class="button-31"><i class="fa-solid fa-lock fs-6"></i></button></td><td>
                                  <button type="submit" name="del" value="'.$row["title"].'_title_RAA7" class="button-30"><i class="fa-solid fa-trash fs-6"></i></button></button></td>
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
                                      <div class="alert alert-primary text-center p-1" role="alert">
                                      Books authored
                                      </div>
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
                                          <label for="attach">Attachment <i>(Max 2 MB PDF)</i> &nbsp; &nbsp; 
                                          <a href="../../document/'.$a.'/'.$row["attachment"].'" target="_blank" >View</a></label>
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
                                      <button type="submit" name="editRAA7" value="'.$row["title"].'" class="button-55 m-2">Update</button>
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

                  $sql = "SELECT * FROM RAA8 WHERE id='".$a."' AND log<'".date("Y")."-07-01' AND log>='".date("Y", time() - 60*60*24*365 )."-07-01' ORDER BY log DESC";
                  $result = mysqli_query($conn, $sql);
                  if (mysqli_num_rows($result) > 0) {
                      
                      while($row = mysqli_fetch_assoc($result)) {
                          if($row["locked"]==0){
                              if($row["comment"]!=""){
                                  echo '<tr class="bg-danger bg-opacity-25">';
                              }
                              else{
                                  echo '<tr>';
                              }
                              echo ' 
                                  <th scope="row">'.$i.'</th>
                                  <td data-bs-toggle="tooltip" data-bs-title="E-content" data-bs-placement="left">RAA8</td>
                                  <td>'.$row["subject"].'</td>
                                  <td><!-- Button trigger modal -->
                                  <button type="button" class="button-29" data-bs-toggle="modal" data-bs-target="#RAA8'.$row["subject"].'"><i class="fa-solid fa-pen fs-6"></i></button></td><td>
                                  <button type="submit" name="lock" value="'.$row["subject"].'_subject_RAA8" class="button-31"><i class="fa-solid fa-lock fs-6"></i></button></td><td>
                                  <button type="submit" name="del" value="'.$row["subject"].'_subject_RAA8" class="button-30"><i class="fa-solid fa-trash fs-6"></i></button></button></td>
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
                                          <input type="text" class="form-control" id="link" name="link" value="'.$row["link"].'" required>
                                      </div>
                                      <div class="form-group p-2">
                                          <label for="attach">Attachment <i>(Max 2 MB PDF)</i> &nbsp; &nbsp; 
                                          <a href="../../document/'.$a.'/'.$row["attachment"].'" target="_blank" >View</a></label>
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
                                      <button type="submit" name="editRAA8" value="'.$row["subject"].'" class="button-55 m-2">Update</button>
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

                  $sql = "SELECT * FROM RAA9 WHERE id='".$a."' AND log<'".date("Y")."-07-01' AND log>='".date("Y", time() - 60*60*24*365 )."-07-01' ORDER BY log DESC";
                  $result = mysqli_query($conn, $sql);
                  if (mysqli_num_rows($result) > 0) {
                      
                      while($row = mysqli_fetch_assoc($result)) {
                          if($row["locked"]==0){
                              if($row["comment"]!=""){
                                  echo '<tr class="bg-danger bg-opacity-25">';
                              }
                              else{
                                  echo '<tr>';
                              }
                              echo ' 
                                  <th scope="row">'.$i.'</th>
                                  <td data-bs-toggle="tooltip" data-bs-title="Patent" data-bs-placement="left">RAA9</td>
                                  <td>'.$row["name"].'</td>
                                  <td><!-- Button trigger modal -->
                                  <button type="button" class="button-29" data-bs-toggle="modal" data-bs-target="#RAA9'.$row["name"].'"><i class="fa-solid fa-pen fs-6"></i></button></td><td>
                                  <button type="submit" name="lock" value="'.$row["name"].'_name_RAA9" class="button-31"><i class="fa-solid fa-lock fs-6"></i></button></td><td>
                                  <button type="submit" name="del" value="'.$row["name"].'_name_RAA9" class="button-30"><i class="fa-solid fa-trash fs-6"></i></button></button></td>
                              </tr>
                              <!-- Modal -->
                              <div class="modal fade" id="RAA9'.$row["name"].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                                      Patent
                                      </div>
                                      <div class="form-group p-2">
                                        <label for="subN">Patent\'s Name</label>
                                        <input type="text" class="form-control" id="name" name="name" readonly value="'.$row["name"].'">
                                      </div>
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
                                          <label for="attach">Attachment <i>(Max 2 MB PDF)</i> &nbsp; &nbsp; 
                                          <a href="../../document/'.$a.'/'.$row["attachment"].'" target="_blank" >View</a></label>
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
                                      <button type="submit" name="editRAA9" value="'.$row["id"].'" class="button-55 m-2">Update</button>
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

                  $sql = "SELECT * FROM RAA10 WHERE id='".$a."' AND log<'".date("Y")."-07-01' AND log>='".date("Y", time() - 60*60*24*365 )."-07-01' ORDER BY log DESC";
                  $result = mysqli_query($conn, $sql);
                  if (mysqli_num_rows($result) > 0) {
                      
                      while($row = mysqli_fetch_assoc($result)) {
                          if($row["locked"]==0){
                              if($row["comment"]!=""){
                                  echo '<tr class="bg-danger bg-opacity-25">';
                              }
                              else{
                                  echo '<tr>';
                              }
                              echo ' 
                                  <th scope="row">'.$i.'</th>
                                  <td data-bs-toggle="tooltip" data-bs-title="Research Guidance" data-bs-placement="left">RAA10</td>
                                  <td>'.$row["name"].'</td>
                                  <td><!-- Button trigger modal -->
                                  <button type="button" class="button-29" data-bs-toggle="modal" data-bs-target="#RAA10'.$row["name"].'"><i class="fa-solid fa-pen fs-6"></i></button></td><td>
                                  <button type="submit" name="lock" value="'.$row["name"].'_name_RAA10" class="button-31"><i class="fa-solid fa-lock fs-6"></i></button></td><td>
                                  <button type="submit" name="del" value="'.$row["name"].'_name_RAA10" class="button-30"><i class="fa-solid fa-trash fs-6"></i></button></button></td>
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
                                      <div class="alert alert-primary text-center p-1" role="alert">
                                      Research Guidance
                                      </div>
                                      <div class="form-group p-2">
                                          <label for="subN">Name</label>
                                          <input type="text" class="form-control" id="name" name="name" value="'.$row["name"].'" readonly required>
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
                                          <label for="attach">Attachment <i>(Max 2 MB PDF)</i> &nbsp; &nbsp; 
                                          <a href="../../document/'.$a.'/'.$row["attachment"].'" target="_blank" >View</a></label>
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
                                      <button type="submit" name="editRAA10" value="'.$row["name"].'" class="button-55 m-2">Update</button>
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
                  
                  $sql = "SELECT * FROM INV WHERE id='".$a."' AND log<'".date("Y")."-07-01' AND log>='".date("Y", time() - 60*60*24*365 )."-07-01' ORDER BY log DESC";
                  $result = mysqli_query($conn, $sql);
                  if (mysqli_num_rows($result) > 0) {
                      
                      while($row = mysqli_fetch_assoc($result)) {
                          if($row["locked"]==0){
                              if($row["comment"]!=""){
                                  echo '<tr class="bg-danger bg-opacity-25">';
                              }
                              else{
                                  echo '<tr>';
                              }
                              echo ' 
                                  <th scope="row">'.$i.'</th>
                                  <td data-bs-toggle="tooltip" data-bs-title="Invited For" data-bs-placement="left">INV</td>
                                  <td>'.$row["date"].'</td>
                                  <td><!-- Button trigger modal -->
                                  <button type="button" class="button-29" data-bs-toggle="modal" data-bs-target="#INV'.$row["date"].'"><i class="fa-solid fa-pen fs-6"></i></button></td><td>
                                  <button type="submit" name="lock" value="'.$row["date"].'_date_INV" class="button-31"><i class="fa-solid fa-lock fs-6"></i></button></td><td>
                                  <button type="submit" name="del" value="'.$row["date"].'_date_INV" class="button-30"><i class="fa-solid fa-trash fs-6"></i></button></button></td>
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
                                      <div class="alert alert-primary text-center p-1" role="alert">
                                      Invited For
                                      </div>
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
                                          <label for="attach">Attachment <i>(Max 2 MB PDF)</i> &nbsp; &nbsp; 
                                          <a href="../../document/'.$a.'/'.$row["attachment"].'" target="_blank" >View</a></label>
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
                                      <button type="submit" name="editINV" value="'.$row["date"].'" class="button-55 m-2">Update</button>
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

                  $sql = "SELECT * FROM AO WHERE id='".$a."' AND log<'".date("Y")."-07-01' AND log>='".date("Y", time() - 60*60*24*365 )."-07-01' ORDER BY log DESC";
                  $result = mysqli_query($conn, $sql);
                  if (mysqli_num_rows($result) > 0) {
                      
                      while($row = mysqli_fetch_assoc($result)) {
                          if($row["locked"]==0){
                              if($row["comment"]!=""){
                                  echo '<tr class="bg-danger bg-opacity-25">';
                              }
                              else{
                                  echo '<tr>';
                              }
                              echo ' 
                                  <th scope="row">'.$i.'</th>
                                  <td data-bs-toggle="tooltip" data-bs-title="Any other" data-bs-placement="left">AO</td>
                                  <td>'.$row["title"].'</td>
                                  <td><!-- Button trigger modal -->
                                  <button type="button" class="button-29" data-bs-toggle="modal" data-bs-target="#AO'.$row["title"].'"><i class="fa-solid fa-pen fs-6"></i></button></td><td>
                                  <button type="submit" name="lock" value="'.$row["title"].'_title_AO" class="button-31"><i class="fa-solid fa-lock fs-6"></i></button></td><td>
                                  <button type="submit" name="del" value="'.$row["title"].'_title_AO" class="button-30"><i class="fa-solid fa-trash fs-6"></i></button></button></td>
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
                                      <div class="alert alert-primary text-center p-1" role="alert">
                                      Any other
                                      </div>
                                      <div class="form-group p-2">
                                          <label for="subC">Title</label>
                                          <input type="text" class="form-control" value="'.$row["title"].'" id="title" name="title" readonly>
                                      </div>
                                      <div class="form-group p-2">
                                          <label for="attach">Attachment <i>(Max 2 MB PDF)</i> &nbsp; &nbsp; 
                                          <a href="../../document/'.$a.'/'.$row["attachment"].'" target="_blank" >View</a></label>
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
                                      <button type="submit" name="editAO" value="'.$row["title"].'" class="button-55 m-2">Update</button>
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


      $('#TLP').find('#sem').on('change', function() {
          if(this.value != '0'){
              let sem = this.value;
              let subdrop = $('#TLP').find('#subdrop');
              $('#TLP').find('#subNameTLP').val('');
              if($('#TLP').find('#subdrop').children().length <= 0){
                  let arr = getKeyByValue(sem)
                  subdrop.append('<option value=\'0\'>Select</option>');
                  for(var i in arr){
                      subdrop.append('<option value='+arr[i]+'>'+arr[i]+'</option>');
                  }
              }
              else{
                  $('#TLP').find('#subdrop').empty()
                  let arr = getKeyByValue(sem)
                  subdrop.append('<option value=\'0\'>Select</option>');
                  for(var i in arr){
                      subdrop.append('<option value='+arr[i]+'>'+arr[i]+'</option>');
                  }
              }
          }
          else{
              let subdrop = $('#TLP').find('#subdrop');
              $('#TLP').find('#subdrop').empty()
              subdrop.append('<option value=\'0\'>Select</option>');
              $('#TLP').find('#subNameTLP').val('');
          }
      });


      $('#TLP').find('#subdrop').on('change', function() {
          if(this.value != '0'){
              let code = this.value
              let sem = $('#TLP').find('#sem').find(':selected').val();
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
      });

      $('#GR').find('#semGR').on('change', function() {
          if(this.value != '0'){
              let sem = this.value;
              let subdrop = $('#GR').find('#subdrop');
              $('#GR').find('#subNameGR').val('');
              if($('#GR').find('#subdrop').children().length <= 0){
                  let arr = getKeyByValue(sem)
                  subdrop.append('<option value=\'0\'>Select</option>');
                  for(var i in arr){
                      subdrop.append('<option value='+arr[i]+'>'+arr[i]+'</option>');
                  }
              }
              else{
                  $('#GR').find('#subdrop').empty()
                  let arr = getKeyByValue(sem)
                  subdrop.append('<option value=\'0\'>Select</option>');
                  for(var i in arr){
                      subdrop.append('<option value='+arr[i]+'>'+arr[i]+'</option>');
                  }
              }
          }
          else{
              let subdrop = $('#GR').find('#subdrop');
              $('#GR').find('#subdrop').empty()
              subdrop.append('<option value=\'0\'>Select</option>');
              $('#GR').find('#subNameGR').val('');
          }
      });


      $('#GR').find('#subdrop').on('change', function() {
          if(this.value != '0'){
              let code = this.value
              let sem = $('#GR').find('#semGR').find(':selected').val();
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
      });


      $('#raa8').find('#sem').on('change', function() {
          if(this.value != '0'){
              let sem = this.value;
              let subdrop = $('#raa8').find('#subdrop');
              $('#raa8').find('#subNameraa8').val('');
              if($('#raa8').find('#subdrop').children().length <= 0){
                  let arr = getKeyByValue(sem)
                  subdrop.append('<option value=\'0\'>Select</option>');
                  for(var i in arr){
                      subdrop.append('<option value='+arr[i]+'>'+arr[i]+'</option>');
                  }
              }
              else{
                  $('#raa8').find('#subdrop').empty()
                  let arr = getKeyByValue(sem)
                  subdrop.append('<option value=\'0\'>Select</option>');
                  for(var i in arr){
                      subdrop.append('<option value='+arr[i]+'>'+arr[i]+'</option>');
                  }
              }
          }
          else{
              let subdrop = $('#raa8').find('#subdrop');
              $('#raa8').find('#subdrop').empty()
              subdrop.append('<option value=\'0\'>Select</option>');
              $('#raa8').find('#subNameraa8').val('');
          }
      });


      $('#raa8').find('#subdrop').on('change', function() {
          if(this.value != '0'){
              let code = this.value
              let sem = $('#raa8').find('#sem').find(':selected').val();
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
      });

      
        $("button:contains('EDIT')").each(function(){
            if($(this).attr("data-bs-target")){
                $(this).attr("data-bs-target",$(this).attr("data-bs-target").replace(/[@.$%&^]/g,'-').replace(/\s+/g,'-'));
            }
        })

        $(".modal").each(function(){
            if($(this).attr("id")){
                $(this).attr("id",$(this).attr("id").replace(/[@.$%&^]/g,'-').replace(/\s+/g,'-'));
            }
        })

    </script>
  </body>
</html>

<?php

  //Faculty Operations
  include_once '../../assets/php/fac.php';

?>