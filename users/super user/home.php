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
              </ul>
            </div>
          </div>
        </div>
      </nav>

      <div class="row p-2 gap-4">
        <div class="col-lg p-2 mb-1 bg-body rounded border border border-2">
          <div class="form-group">
          <p class="form-control snip1337"> New User Journey </p>
            <form action="" class="p-2" method="POST">
              <hr>
              <div class="input-group mb-3">
                <span class="input-group-text">📧</span>
                <div class="form-floating">
                  <input type="text" class="form-control" id="idType" name="id" placeholder="subject name" required>
                  <label for="sub">ID / Email</label>
                </div>
              </div>
              <div class="input-group mb-3">
                <span class="input-group-text">🔒</span>
                <div class="form-floating">
                  <input type="text" class="form-control" id="passType" name="pass" placeholder="subject name" value="123456" required readonly>
                  <label for="sub">Password</label>
                </div>
              </div>
              <div class="input-group mb-3">
                <span class="input-group-text">🏫</span>
                <div class="form-floating">
                  <select class="form-control" name="dept" id="deptType">
                    <option value="CE">Computer</option>
                    <option value="IT">Information Tech</option>
                    <option value="EC">Electronics & Communication</option>
                  </select>
                  <label for="sem">Department</label>
                </div>
              </div>
              <div class="input-group mb-3">
                <span class="input-group-text">👨‍🏫</span>
                <div class="form-floating">
                  <select class="form-control" name="role" id="roleType">
                    <option value="Faculty">Faculty</option>
                    <option value="Hod">Hod</option>
                  </select>
                  <label for="sem">Role</label>
                </div>
              </div>

              <button type="submit" name="reg" class="button-55">Add</button>


                  
                  
              </form>


          </div>
        </div>


        <div class="col-lg p-2 mb-1 bg-body rounded border border border-2">
          <div class="form-group">
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
                  <label for="floatingInputGroup1">Search By ID / Email</label>
                </div>
            </div>
            <form method="POST" action="" class="p-2" enctype="multipart/form-data">
            <table class="table table-hover table-center text-center" id="table22">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Id</th>
                  <th scope="col">Role</th>
                  <th scope="col">Delete User</th>
                  <th scope="col">Reset Password</th>
                </tr>
              </thead>
              <tbody>
                <?php
                 $i=1;
                 $sql = "SELECT * FROM Profile ORDER BY role";
                 $result = mysqli_query($conn, $sql);
                 if (mysqli_num_rows($result) > 0) {
                  while($row = mysqli_fetch_assoc($result)) {
                      if($row['role'] == 'Faculty' or $row['role'] == 'Hod'){
                          echo '<tr>
                          <td>'.$i.'</td>
                          <td class="name">'.$row['id'].'</td>
                          <td>'.$row['role'].'</td>
                          <td><button type="submit" name="delete" value="'.$row["id"].'" class="button-30"><i class="fa-solid fa-trash fs-6"></i></button> </td>
                          <td><button type="submit" name="reset" value="'.$row["id"].'" class="button-29"><i class="fa-solid fa-pen fs-6"></i></button></td>
                          </tr>';
                      }
                      else{
                          echo '<tr>
                          <td>'.$i.'</td>
                          <td class="name">'.$row['id'].'</td>
                          <td>'.$row['role'].'</td>
                          <td><button type="submit" name="delete" class="button-30" disabled><i class="fa-solid fa-trash fs-6"></i></button> </td>
                          <td><button type="submit" name="reset" class="button-29" disabled><i class="fa-solid fa-pen fs-6"></i></button></td>
                          </tr>';
                      }
                      $i=$i+1;
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

      $("#search").on("input",function(e){
        if($(this).val().length > 0){
            let val = $(this).val()
            $("#table22 > tbody").children("tr").hide();
            $(".name").each(function(){
                var result = ($(this).text()).toLowerCase().indexOf(val.toLowerCase())>=0;
                if(result){
                    $(this).parent().show();
                }
            })
        }
        else{
            $("#table22 > tbody").children("tr").show();
        }
        
    });

    </script>
  </body>
</html>

<?php

  //Faculty Operations
  include_once '../../assets/php/superuser.php';

?>