<?php

  //database connection
  include '../../db.php';

  //check user & their profile exist
  if(!isset($_SESSION["id"]) OR !isset($_SESSION["hprofile"])){
    echo"
    <script>
        location.href = '../../index.php';
    </script>
    ";
  }

  if($_SESSION["hprofile"] != 1){
    echo"
    <script>
        location.href = 'profile.php';
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
  }

  $sql = "SELECT * FROM Profile WHERE dept='".$dept."' AND role='Faculty'";
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
                      placeholder="Email"
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
              <th scope="col">Email</th>
              <th scope="col">HoD Comment</th>
              <th scope="col">Report</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $i=1;
                foreach($totalF as $name => $id) {
                   echo' <tr>
                        <td>'.$i.'</td>
                        <td class="name">'.$name.'</td> 
                        <td>'.$id.'</td> 
                        ';


                        $sql = "SELECT * FROM comment WHERE id='".$id."'";
                        $result = mysqli_query($conn, $sql);
                        
                        if (mysqli_num_rows($result) <= 0) {
                          $sql = "INSERT INTO comment 
                          VALUES ('".$id."', '', '')";

                          if (mysqli_query($conn, $sql)) {
                           
                          } 
                        }

                        if (mysqli_num_rows($result) > 0) {
                          while($row = mysqli_fetch_assoc($result)) {
                            echo'
                            <td>
                                <div class="row">
                                    <div class="col-auto">
                                    <input type="text" class="form-control col-4" id="commentdata" name="commentdata'.$row["id"].'comment"  placeholder="Type comment.." value="'.$row["hcomment"].'" style="padding-y: 0.25rem;padding-x: 0.5rem;font-size: 0.875rem;border-radius: 0.25rem;">
                                    </div>
                                    <div class="col-auto">
                                    <button type="submit" name="comment" id="commentBtn" value="comment_'.$row["id"].'" class="button-31"><i class="fa-solid fa-square-plus fs-6"></i></button>
                                    </div>
                                </div>
                            </td>';
                            if($row["hcomment"]){
                              echo'<td><button type="button" onclick="download(\''.$id.'\')" class="button-29 fs-6"><i class="fa-solid fa-download"></i></button></td>  ';
                            }
                            else{
                              echo'<td><button type="button" class="button-29 fs-6" disabled><i class="fa-solid fa-download"></i></button></td>  ';
                            }
                          }
                        }

                        echo'
                                          
                    </tr>';
                    $i=$i+1;
                }
              ?>
            </tbody>
          </table>
        </form>
      </div>
      </div>
      </div>

      <?php

        //HOD Operations
        include_once '../../assets/php/report.php';

      ?>
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

      
      function download(id) {
          var sTable = document.getElementById(`pdf${id}`).innerHTML;
      
          var style = "<style>";
          style = style + "table {width: 100%;font: 17px Calibri;}";
          style = style + ".h1, .h2, .h3, .h4, .h5, .h6, h1, h2, h3, h4, h5, h6 {margin-top: 0;margin-bottom: 0;font-weight: 500;line-height: 1.2;color: var(--bs-heading-color);}";
          style = style + ".h5, h5 {font-size: 1.25rem;font-weight: 700;}.h6, h6 {font-size: 1rem;font-weight: 500;}";
          style = style + ".mt-5 {margin-top: 3rem!important;}";
          // style = style + "table, th, td {border: solid 1px #DDD; border-collapse: collapse;";
          // style = style + "padding: 2px 3px;text-align: center;}";
          style = style + ".imgcl {display: flex;justify-content: center;}.cards-list {z-index: 0;width: 100%;display: flex;justify-content: space-around;flex-wrap: wrap;}.card {margin: 30px auto;width: 150px;height: 150px;border-radius: 40px;cursor: pointer;transition: 0.4s;}.card .card_image {width: inherit;height: inherit;border-radius: 40px;}.card .card_image img {width: inherit;height: inherit;border-radius: 40px;object-fit: cover;}.card .card_title {text-align: center;border-radius: 0px 0px 40px 40px;font-family: sans-serif;font-weight: bold;font-size: 20px;margin-top: -50px;height: 40px;}.title-white {color: white;}@media all and (max-width: 500px) {.card-list {flex-direction: column;}}.highlight-yellow {border-radius: 1em 0 1em 0;background-image: linear-gradient(-100deg,rgba(255, 224, 0, 0.2),rgba(255, 224, 0, 0.7) 95%,rgba(255, 224, 0, 0.1));}";
          style = style + "</style>";
      
          // CREATE A WINDOW OBJECT.
          var win = window.open("", "", "height=1000,width=1000");
      
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


      $("#table23").find("tr").find("#commentdata").each(function(){
          if($(this).attr("name")){
          $(this).attr("name",$(this).attr("name").replace(/[@.$%&^]/g,'-').replace(/\s+/g,'-'));
          }
      })

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

if(isset($_POST["comment"])){
  // $cid=$_POST["c_id"];
  // echo $cid;
  // echo "<hr>";
  // echo $cdata;
  $str=$_POST["comment"];
  $arr = preg_split("/[_]+/", $str);
  
  $tt=$arr[0];
  $cid=$arr[1];

  $abc="commentdata$cid$tt";
  $abc= str_replace('@','-',$abc);
  $abc= str_replace('.','-',$abc);
  $abc= str_replace('$','-',$abc);
  $abc= str_replace('%','-',$abc);
  $abc= str_replace('&','-',$abc);
  $abc= str_replace('^','-',$abc);
  $abc= str_replace(' ','-',$abc);
  $cdata=$_POST[$abc];
  $sql = "UPDATE $tt SET hcomment='$cdata'  WHERE id='$cid'";
  // echo $sql;

  if ($conn->query($sql) === TRUE) {
      $_SESSION["success"]=$tt.' Entry Updated Successfully';
      echo "<script>location.href = 'report.php';</script>";
  } else {
      $_SESSION["danger"]=$tt.' Entry Not Updated Successfully';
      echo "<script>location.href = 'report.php';</script>";
      //echo "Error updating record: " . $conn->error;
  }
}

?>