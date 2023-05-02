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

  $a = $_SESSION["id"];
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
      <?php
        if($_SESSION['fprofile']==0){
          echo '<nav class="navbar navbar-expand-lg blurrr">';
        }
        else if($_SESSION['fprofile']==1){
          echo '<nav class="navbar navbar-expand-lg">';
        }
      ?>
      
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
      <div class="row ms-0 me-0 column-gap-3 layout2 d-flex justify-content-center text-center">
        <div class="p-2 col m-auto">
          <img
            class="blurry-load img-fluid"
            src="../../assets/img/profile.jpg"
            data-large="../../assets/img/profile.jpg"
          />
        </div>
          <!-- <div class="col blurrr"> -->
          <div class="col">
          <?php
            if($_SESSION['fprofile']==0){
              echo '
              <form class="loginform" action="" method="post" enctype="multipart/form-data">
                <div class="input-group mb-3">
                  <span class="input-group-text">🧑‍🏫</span>
                  <div class="form-floating">
                    <select class="form-control" name="title" id="title">
                      <option value="Dr." selected>Dr.</option>
                      <option value="Mr.">Mr.</option>
                      <option value="Ms.">Ms.</option>
                      <option value="Mrs.">Mrs.</option>
                      <option value="Miss.">Miss.</option>
                      <option value="Prof.">Prof.</option>
                    </select>
                    <label for="floatingInputGroup1">Title</label>
                  </div>
                </div>
                <div class="input-group mb-3">
                  <span class="input-group-text">😁</span>
                  <div class="form-floating">
                  <input type="text" name="fname" class="form-control" id="fnameType" placeholder="test" required>
                    <label for="floatingInputGroup1">First Name</label>
                  </div>
                </div>
                <div class="input-group mb-3">
                  <span class="input-group-text">😇</span>
                  <div class="form-floating">
                  <input type="text" name="mname" class="form-control" id="mnameType" maxlength="1" placeholder="test" required>
                    <label for="floatingInputGroup1">Middle Name</label>
                  </div>
                </div>
                <div class="input-group mb-3">
                  <span class="input-group-text">🥹</span>
                  <div class="form-floating">
                  <input type="text" name="lname" class="form-control" id="lnameType" placeholder="test" required>
                    <label for="floatingInputGroup1">Last Name</label>
                  </div>
                </div>
                <div class="input-group mb-3">
                  <span class="input-group-text pt-3 pb-3">📄</span>
                  <span class="input-group-text pt-3 pb-3">Avatar&nbsp;<i>(Only Image)</i></span>
                  <input type="file" name="attachment" accept="image/png, image/jpg, image/jpeg" class="form-control pt-3 pb-3" id="image" required>
                </div>
                <button type="submit" name="submit" class="button-55 mt-2">
                  Create Profile
                </button>
              </form> 
              ';
            }
            else if($_SESSION['fprofile']==1){
              $sql = "SELECT * FROM Profile WHERE id='".$a."'";
              $result = mysqli_query($conn, $sql);
              if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                  
                  echo '
                  <form class="loginform" action="" method="post" enctype="multipart/form-data">
                  <img src="../../document/'.$a.'/'.$row["dp"].'" class="img-thumbnail mb-3">
                    <div class="input-group mb-3">
                      <span class="input-group-text">🧑‍🏫</span>
                      <div class="form-floating">
                      <input type="text" name="title" class="form-control" id="fnameType" placeholder="test" readonly required value="'.$row['name'].'">
                        <label for="floatingInputGroup1">Name</label>
                      </div>
                    </div>
                    <div class="input-group mb-3">
                      <span class="input-group-text">😁</span>
                      <div class="form-floating">
                      <input type="text" name="dept" class="form-control" id="fnameType" placeholder="test" readonly required value="'.$row['dept'].'">
                        <label for="floatingInputGroup1">Department</label>
                      </div>
                    </div>
                    <div class="input-group mb-3">
                      <span class="input-group-text">😇</span>
                      <div class="form-floating">
                      <input type="text" name="role" class="form-control" id="mnameType" maxlength="1" placeholder="test" readonly required value="'.$row['role'].'">
                        <label for="floatingInputGroup1">Role</label>
                      </div>
                    </div>
                    <div class="input-group mb-3">
                      <span class="input-group-text pt-3 pb-3">📄</span>
                      <span class="input-group-text pt-3 pb-3">Avatar&nbsp;<i>(Only Image)</i></span>
                      <input type="file" name="attachment" accept="image/png, image/jpg, image/jpeg" class="form-control pt-3 pb-3" id="image" required>
                    </div>
                    <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" class="button-55 mt-2">
                      Change Password
                    </button>
                    <button type="submit" name="update" class="button-55 mt-2">
                      Update Avtar
                    </button>
                  </form> 
                  ';
                }
              }
            }
          ?>
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
    <!-- Model -->
    
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
      
        <form class="m-3" action="" method="POST">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Change Password</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
          <div class="mb-3">
              <input type="password" placeholder="old password" name="pass" class="form-control" id="idType" required>
          </div>
          <div class="mb-3">
              <input type="password" placeholder="new password" name="pass1" class="form-control" id="passType" required>
          </div>
          <div class="">
              <input type="password" placeholder="confirm new password" name="pass2" class="form-control" id="passType2" required>
          </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" name="savepassword" class="btn btn-primary">Save changes</button>
          </div>
        </div>
        </form>
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

<?php

include_once '../../assets/php/profile.php';

?>