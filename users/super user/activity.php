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
              </ul>
            </div>
          </div>
        </div>
      </nav>

      <div class="row p-2 gap-4">
        <div class="col-lg p-2 mb-1 bg-body rounded border border border-2">
          <div class="form-group">
          <p class="form-control snip1337"> Portfolio  <button class="button-29 float-end" type="button" data-bs-toggle="modal" data-bs-target="#addPortModal"><i class="fa fa-plus" ></i> </button> </p>
          <form method="POST" action="" class="p-2" enctype="multipart/form-data">
            <table class="table table-hover" id="table23">
              <thead>
              <tr>
                  <th scope="col">#</th>
                  <th scope="col">Name</th>
                  <th scope="col">Level</th>
                  <th scope="col">Delete</th>
              </tr>
              </thead>
              <tbody>
                <?php
                $i=1;
                $sql = "SELECT * FROM Activity order by -type";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        if($row["type"]==0){
                            echo ' <tr>
                            <th scope="row">'.$i.'</th>
                            <td>'.$row["name"].'</td>
                            <td>Department</td>
                            <td>
                            <button type="submit" name="del" value="'.$row["name"].'" class="button-30"><i class="fa-solid fa-trash fs-6"></i></button></td>
                            </tr>';
                        }
                        else if($row["type"]==1){
                            echo ' <tr>
                            <th scope="row">'.$i.'</th>
                            <td>'.$row["name"].'</td>
                            <td>Institute</td>
                            <td>
                            <button type="submit" name="del" value="'.$row["name"].'" class="button-30"><i class="fa-solid fa-trash fs-6"></i></button></td>
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


        <div class="col-lg p-2 mb-1 bg-body rounded border border border-2">
          <div class="form-group">
            <p class="form-control snip1337"> Subject  <button class="button-29 float-end" type="button" data-bs-toggle="modal" data-bs-target="#addSubModal"><i class="fa fa-plus" ></i> </button> </p>
            <form method="POST" action="" class="p-2" enctype="multipart/form-data">
              <table class="table table-hover" id="table23">
                <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Name</th>
                  <th scope="col">Code</th>
                  <th scope="col">Sem</th>
                  <th scope="col">Delete</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                  $i=1;
                  $sql = "SELECT * FROM Subject order by sem,code";
                  $result = mysqli_query($conn, $sql);
                  if (mysqli_num_rows($result) > 0) {
                      while($row = mysqli_fetch_assoc($result)) {
                          echo ' <tr>
                              <th scope="row">'.$i.'</th>
                              <td>'.$row["name"].'</td>
                              <td>'.$row["code"].'</td>
                              <td>'.$row["sem"].'</td>
                              <td>
                              <button type="submit" name="dels" value="'.$row["code"].'" class="button-30"><i class="fa-solid fa-trash fs-6"></i></button></td>
                              </tr>';
                          
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

    
    <div class="modal fade" id="addPortModal" tabindex="-1" aria-labelledby="addPortModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        
        <form class="m-3" action="" method="POST">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Add Portfolio</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <div class="mb-3">
                <input type="text" placeholder="name" name="name" class="form-control" id="idType" required>
            </div>
            <div class="">
                <select class="form-select" aria-label="Default select example" name="type">
                    <option value="" selected>Type</option>
                    <option value="1">Institute</option>
                    <option value="0">Department</option>
                </select>
            </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" name="addPort" class="btn btn-primary">Save changes</button>
            </div>
        </div>
        </form>
        </div>
    </div>  
    
    <div class="modal fade" id="addSubModal" tabindex="-1" aria-labelledby="addPortModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        
        <form class="m-3" action="" method="POST">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Add Subject</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <div class="mb-3">
                <input type="text" placeholder="name" name="name" class="form-control" id="idType" required>
            </div>
            <div class="mb-3">
                <input type="number" placeholder="subject code" name="code" class="form-control" id="idTypes" required>
            </div>
            <div class="">
                <select class="form-select" aria-label="Default select example" name="sem">
                    <option value="" selected>Select Sem</option>
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
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" name="addSub" class="btn btn-primary">Save changes</button>
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
  include_once '../../assets/php/superuseractivity.php';

?>