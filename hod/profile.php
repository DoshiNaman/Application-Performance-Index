<?php

    include '../db.php';
    

#session_start();
if(isset($_SESSION["id"]) AND isset($_SESSION["hprofile"])){
    if($_SESSION["hprofile"] == 0){
        #new user
        echo '
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Profile</title>
            <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
      <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>-->
        </head>
        <body>
        <div class="container">
            <form class="mt-5" action="" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="nameType" class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" id="nameType" required>
                </div>
                <div class="mb-3">
                    <label for="imgType" class="form-label">Select Avtar</label>
                    <input type="file" name="image" accept="image/png, image/jpg, image/jpeg" class="form-control" id="image" required>
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        </body>
        </html>';
    }

    if($_SESSION["hprofile"] == 1){
        $a=$_SESSION["id"];
        $sql = "SELECT * FROM Profile WHERE id='".$a."'";
        $result = mysqli_query($conn, $sql);
        $imgName = "";
        $deptName = "";
        $name = "";
        $role="";
        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
                #echo "id: " . $row["id"]. " - pass: " . $row["password"]. " " . $row["name"]. "1<br>";
                $name = $row["name"];
                $deptName = $row["dept"];
                $imgName = $row["dp"];
                $role = $row["role"];
            }
        } else {
            echo"
            <script>
                alert('Profile DON\'T Exist');
            </script>
            ";
        }
        
        $newpath="../document/".$a."/".$imgName;
    
        
        #exist user
        echo '
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Profile</title>
            <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
            <!-- Bootstrap CSS -->
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
            <style>
               body {
                  margin: 0 auto;
                  padding: 0;
                  background: #222;
                }
                
                .left {
                  left: 25px;
                }
                
                .right {
                  right: 25px;
                }
                
                .center {
                  text-align: center;
                }
                
                .bottom {
                  position: absolute;
                  bottom: 25px;
                }
                
                #gradient {
                  background: #999955;
                  background-image: linear-gradient(#DAB046 20%, #D73B25 20%, #D73B25 40%, #C71B25 40%, #C71B25 60%, #961A39 60%, #961A39 80%, #601035 80%);
                  margin: 0 auto;
                  margin-top: 100px;
                  width: 100%;
                  height: 150px;
                }
                
                #gradient:after {
                  content: "";
                  position: absolute;
                  background: #E9E2D0;
                  left: 50%;
                  margin-top: -67.5px;
                  margin-left: -270px;
                  padding-left: 20px;
                  border-radius: 5px;
                  width: 520px;
                  height: 275px;
                  z-index: -1;
                }
                
                #card {
                  position: absolute;
                  width: 450px;
                  height: 175px;
                  padding: 25px;
                  padding-top: 0;
                  padding-bottom: 0;
                  left: 50%;
                  top: 90px;
                  margin-left: -250px;
                  background: #E9E2D0;
                  box-shadow: -20px 0 35px -25px black, 20px 0 35px -25px black;
                  z-index: 5;
                }
                
                #card img {
                  padding-top: 10px;
                  width: 150px;
                  float: left;
                  border-radius: 5px;
                  margin-right: 20px;
                }
                
                #card h2 {
                  font-family: courier;
                  color: #333;
                  margin: 0 auto;
                  padding: 10px;
                  font-size: 15pt;
                }
                
                #card p {
                  font-family: courier;
                  color: #555;
                  font-size: 13px;
                }
                
                #card span {
                  font-family: courier;
                }
                
                .wrapper a {
                  padding: 5px 15px 10px 15px;
                  height: 30px;
                  width: 150px;
                  cursor: pointer;
                  border: none;
                  border-radius: 5px;
                  background-image: linear-gradient(to right top, #FB0712, #124FEB);
                  font-size: 13px;
                  text-transform: uppercase;
                  color: #fff;
                  transition: all 0.2s
                }
                
                .wrapper a:hover {
                    background-image: linear-gradient(to right top, #0717FB, #F90A2F)
                }
            </style>
        </head>
        <body>
        <div id="gradient"></div>
        <div id="card">
          <img src="'.$newpath.'" />
          <h2>'.$name.'</h2>
          <p>Role : '.$role.'</p>
          <p>Department : '.$deptName.'</p>
          <div class="wrapper"><a href="home.php" name="home">Home</a>&nbsp;<a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#exampleModal">Change Password</a></div>
        </div>
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
                <button type="submit" name="update" class="btn btn-primary">Save changes</button>
              </div>
            </div>
            </form>
          </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        </body>
        </html>';
    }

}
else{
    echo"
    <script>
        location.href = 'login.php';
    </script>
    ";
}

if(isset($_POST["update"])){
  $a=$_SESSION["id"];
  $oldpass = $_POST['pass'];
  $pass1 = $_POST['pass1'];
  $pass2 = $_POST['pass2'];
  $sql = "SELECT * FROM Profile WHERE id='".$a."'";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {
      // output data of each row
      while($row = mysqli_fetch_assoc($result)) {
          if(password_verify($oldpass,$row["password"])){
            if($pass1 == $pass2){
              $pass1 = password_hash((string)$pass1,PASSWORD_DEFAULT);
              $sql = "UPDATE Profile SET password='$pass1' WHERE id='$a'" ;
              if ($conn->query($sql) === TRUE) {
                  echo "<script>alert('password updated')</script>";
              } else {
                  echo "<script>alert('password not updated')</script>";
              }
            }
            elseif($oldpass==$pass1){echo "<script>alert('old and new password cant be same')</script>";}
            else{echo "<script>alert('new password cant match')</script>";}
          }
          else{
            echo "<script>alert('old password does not match !')</script>";
          }
      }
  }
  else{echo "<script>alert('no data')</script>";}
}

if(isset($_POST["submit"])){
    $a=$_SESSION["id"];
    $b=$_POST["name"];
    
    $fdpname=$b."-dp.jpg";
    $dp=$_FILES['image']['name'];
    $dp_type=$_FILES['image']['type'];
    $dp_size=$_FILES['image']['size'];
    $dp_tem_loc=$_FILES['image']['tmp_name'];
    $dp_store="../document/".$a."/".$dp;
    move_uploaded_file($dp_tem_loc,$dp_store);
    $newpath="../document/".$a."/".$fdpname;
    rename($dp_store, $newpath);
    #echo $a.$b.$c;
    $sql = "UPDATE Profile SET `name`='".$b."',`dp`='".$fdpname."' WHERE `id`='".$a."'";
    #echo $sql;
    if(mysqli_query($conn, $sql)){
        $_SESSION["hprofile"]=1;
        echo"
        <script>
            alert('Profile Updated :)');
            location.href = 'home.php';
        </script>
        ";
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
    
}

mysqli_close($conn);

?>