<?php

  //database connection
  include '../../db.php';

  //check user & their profile exist
  if(!isset($_SESSION["id"])){
    echo"
    <script>
        location.href = '../../index.php';
    </script>
    ";
  }

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

      
      <div class="row p-2">
        <div class="col-lg p-2 mb-1 bg-body rounded border border border-2">
          <div class="form-group">
            <div class="input-group mb-3 border snip1337">
                <span class="input-group-text">🔍</span>
                <div class="form-floating">
                  <input
                    type="text"
                    class="form-control"
                    id="search"
                    placeholder="Test"
                    name="id"
                  />
                  <label for="floatingInputGroup1">Search By Faculty Name</label>
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
                    
                        $sql = "SELECT * FROM DISC WHERE id='".$id."'";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            
                            while($row = mysqli_fetch_assoc($result)) {
                                if($row["locked"]==1){
                                    echo ' <tr>
                                        <td>'.$i.'</td>
                                        <td class="name">'.$name.'</td>
                                        <td>DISC</td>
                                        <td>'.$row['id'].'</td>
                                        <td>'.$row['point'].'</td>
                                        <td>
                                          <div class="row">
                                            <div class="col-auto">
                                            <input type="text" class="form-control col-4" id="commentdata" name="commentdata'.$row["id"].'DISC"  placeholder="Type comment.." value="'.$row["comment"].'" style="padding-y: 0.25rem;padding-x: 0.5rem;font-size: 0.875rem;border-radius: 0.25rem;">
                                            <!--<input type="hidden" name="c_id" value="'.$row["id"].'"/>-->
                                            </div>
                                            <div class="col-auto">
                                            <button type="submit" name="comment" id="commentBtn" value="DISC_'.$row["id"].'" class="button-31"><i class="fa-solid fa-square-plus fs-6"></i></button>
                                            </div>
                                          </div>
                                        </td>
                                        <td>
                                        <button type="button" class="button-29" data-bs-toggle="modal" data-bs-target="#DISC'.$row["id"].'"><i class="fa-solid fa-eye fs-6"></i></button></td><td>
                                        ';
                                        if($row["verify"]==1){
                                            echo'<button type="submit" name="v1" value="'.$row["id"].'_DISC" class="button-31" disabled><i class="fa-solid fa-circle-check fs-6"></i></button></td><td>';
                                        }
                                        else{
                                            echo'<button type="submit" name="verify" value="DISC_'.$row["id"].'" class="button-31"><i class="fa-solid fa-circle-check fs-6"></i></button></td><td>';
                                        }
                                        if($row["comment"]){
                                        
                                            echo'<button type="submit" name="reject" value="DISC_'.$row["id"].'" class="button-30"><i class="fa-solid fa-circle-xmark fs-6"></i></button></td>                              ';
                                        }
                                        else{
                                            echo'<button type="submit" name="reject" class="button-30" disabled><i class="fa-solid fa-circle-xmark fs-6"></i></button></td>';
                                        }
                                        echo' 
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
                                            <hr>
                                            <div class="form-group p-2">
                                                <label for="subC">Id</label>
                                                <input type="text" class="form-control" value="'.$row["id"].'" id="subC" name="subCode" readonly>
                                            </div>
                                            <div class="form-group p-2">
                                                <label for="subN">No of times Late Punch</label>
                                                <input type="number" min="0" max="100" value="'.$row["TLP"].'" class="form-control" id="nooftlp" name="nooftlp" readonly>
                                            </div>
                                            <div class="form-group p-2">
                                                <label for="subN">No. of LWP</label>
                                                <input type="number" min="0" max="100" value="'.$row["LWP"].'" class="form-control" id="nooflwp" name="nooflwp" readonly>
                                            </div>
                                            <div class="form-group p-2">
                                                <label for="subN">No. of Balanced leave</label>
                                                <input type="number" min="0" max="5" class="form-control" value="'.$row["BL"].'" id="noofbl" name="noofbl" readonly>
                                            </div>
                                            <div class="form-group p-2">
                                                <label for="subN">No .of memo/justification/clarification</label>
                                                <input type="number" min="0" max="100" class="form-control" value="'.$row["MJC"].'" id="noofm" name="noofm" readonly>
                                            </div>
                                            <div class="form-group p-2">
                                                <label for="subN">No .of Fine</label>
                                                <input type="number" min="0" max="100" value="'.$row["F"].'" class="form-control" id="nooff" name="nooff" readonly>
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
                            //DISC no entry.
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

      $("#search").on("input",function(e){
          if($(this).val().length > 0){
              let val = $(this).val()
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

    </script>
  </body>
</html>

<?php

  //HOD Operations
  include_once '../../assets/php/hod.php';

?>