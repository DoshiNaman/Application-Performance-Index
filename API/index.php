<?php

  //database connection
  include 'db.php';

  //below code create user name folder if not exist (LOC 6-18)
  $sql = "SELECT id FROM Profile";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
    $a = 'document/'.$row["id"];
      if(!file_exists($a)){
        mkdir($a, 0777, true);
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
      href="assets/bootstrap-5.3.0-alpha1-dist/css/bootstrap.min.css"
    />
    <!--Blury Image CSS-->
    <link rel="stylesheet" href="assets/css/blurry-load.min.css" />
    <!--External CSS-->
    <link rel="stylesheet" href="assets/css/base.css" />
    <link rel="apple-touch-icon" sizes="180x180" href="assets/icons/favicon_io/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/icons/favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/icons/favicon_io/favicon-16x16.png">
    <link rel="manifest" href="assets/icons/favicon_io/site.webmanifest">
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
            src="assets/img/gu-logo.png"
            data-large="assets/img/gu-logo.png"
            alt="GU LOGO"
            class="navbar-brand blurry-load"
            role="button"
            height="70"
            onclick="location.href = 'index.php';"
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
                  <a class="nav-link linkclass" href="developer_info.php">
                    <img
                      alt=""
                      src="assets/icons/person.png"
                      data-large="assets/icons/person.png"
                      class="goldicon goldicon1 blurry-load"
                    />
                    Developer Info</a
                  >
                </li>
                <li class="nav-item">
                  <a class="nav-link linkclass" href="feedback.php">
                    <img
                      alt=""
                      src="assets/icons/feedback.png"
                      data-large="assets/icons/feedback.png"
                      class="goldicon blurry-load"
                    />
                    Give Feedback</a
                  >
                </li>
                <?php 
                if(isset($_SESSION["id"]) && isset($_SESSION["role"])){
                  echo '<li class="nav-item">
                    <a class="nav-link linkclass" href="users/'.strtolower($_SESSION["role"]).'/home.php">
                      <img
                        alt=""
                        src="assets/icons/dashboard.png"
                        data-large="assets/icons/dashboard.png"
                        class="goldicon blurry-load"
                      />
                      Dashboard</a
                    >
                  </li>
                  <li class="nav-item">
                    <a class="nav-link linkclass" href="logout.php">
                      <img
                        alt=""
                        src="assets/icons/allout.png"
                        data-large="assets/icons/allout.png"
                        class="goldicon blurry-load"
                      />
                      LogOut</a
                    >
                  </li>';
                }
                ?>
              </ul>
            </div>
          </div>
        </div>
      </nav>
      <div class="row ms-0 me-0 column-gap-3 layout1 d-flex justify-content-center text-center">
        <div class="p-2 col">
          <img
            class="blurry-load img-fluid"
            src="assets/img/finalone.png"
            data-large="assets/img/finalone.png"
          />
        </div>
          <?php 
            if(isset($_SESSION["id"]) && isset($_SESSION["role"])){
              echo '<div class="col blurrr">';
            }
            else{
              echo '<div class="col">';
            }
          ?>
          <form class="loginform" action="" method="post">
            <div class="input-group mb-3">
              <span class="input-group-text">📧</span>
              <div class="form-floating">
                <input
                  type="text"
                  class="form-control"
                  id="floatingInputGroup1"
                  placeholder="Email"
                  name="id"
                />
                <label for="floatingInputGroup1">Email</label>
              </div>
            </div>
            <div class="input-group mb-3">
              <span class="input-group-text">🔒</span>
              <div class="form-floating">
                <input
                  type="password"
                  class="form-control"
                  id="floatingInputGroup1"
                  placeholder="Password"
                  name="pass"
                />
                <label for="floatingInputGroup1">Password</label>
              </div>
            </div>
            <button type="submit" name="login" class="button-55">
              Login
            </button>
          </form>
        </div>
      </div>
    </div>
    <div class="container mb-5 footer">
      <div class="m-2 p-0 row footertext">
        <div class="col-md-4">
          <img
            src="assets/img/gu-logo.png"
            data-large="assets/img/gu-logo.png"
            alt="GU LOGO"
            height="60"
            class="blurry-load"
            role="button"
            onclick="location.href = 'index.php';"
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
    <script src="assets/bootstrap-5.3.0-alpha1-dist/js/bootstrap.min.js"></script>
    <!--Blurry Image JS-->
    <script src="assets/js/blury-load.min.js"></script>
    <!--JQuery JS-->
    <script src="assets/js/jquery-3.6.3.min.js"></script>
    <!--External JS-->
    <script src="assets/js/main.js"></script>

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


//login function handle post request (LOC 21-83)
if(isset($_POST["login"])){
  if(strlen($_POST["pass"]) > 0 && strlen($_POST["id"]) > 0){
    //sql query
    $sql = "SELECT * FROM Profile WHERE id='".$_POST["id"]."'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
      // output data of each row
      while($row = mysqli_fetch_assoc($result)) {
        //password check using hash
        if(password_verify($_POST["pass"],$row["password"])){
          $_SESSION["id"]=$row["id"];
          $_SESSION["role"]=$row["role"];
          //check role
          if($row["role"]=="Faculty"){
            if($row["name"]==""){
              $_SESSION["fprofile"]=0;
              echo"<script>location.href = 'users/faculty/profile.php';</script>";
            }
            else{
              $_SESSION["fprofile"]=1;
              echo"<script>location.href = 'users/faculty/home.php';</script>";
            }
          }

          if($row["role"]=="Hod"){
            if($row["name"]==""){
              $_SESSION["hprofile"]=0;
              echo"<script>location.href = 'users/hod/profile.php';</script>";
            }
            else{
              $_SESSION["hprofile"]=1;
              echo"<script>location.href = 'users/hod/home.php';</script>";
            }
          }

          if($row["role"]=="Director"){
            if($row["name"]==""){
              $_SESSION["dprofile"]=0;
              echo"<script>location.href = 'users/director/profile.php';</script>";
            }
            else{
              $_SESSION["dprofile"]=1;
              echo"<script>location.href = 'users/director/home.php';</script>";
            }
          }

          if($row["role"]=="Super User"){
            echo"<script>location.href = 'users/super user/home.php';</script>";
          }

          if($row["role"]=="Admin Dept"){
            echo"<script>location.href = 'users/admin dept/home.php';</script>";
          }

        }
        else{
          $_SESSION["danger"]='Password Does Not Match';
        echo "<script>location.href = 'index.php';</script>";
        }

      }
    } 
    else {
      $_SESSION["danger"]='Email & Password Does Not Exist';
      echo "<script>location.href = 'index.php';</script>";
    }
  }
  else {
    $_SESSION["danger"]='Fill Up Email & Password Field';
    echo "<script>location.href = 'index.php';</script>";
  }

}



?>
