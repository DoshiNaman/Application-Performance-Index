<?php

include '../db.php';

if(!isset($_SESSION["id"])){
    echo"
    <script>
        location.href = '../index.php';
    </script>
    ";
}


echo '

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>SUPER USER</title>
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
        <br/><a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#exampleModal">Change Password</a>&nbsp;<a href="activity.php">Portfolio/Subject</a><a class="ms-3 float-end" href="../logout.php">Logout</a><hr>
        <div id="alertinner">
        
        </div>
        <div class="row p-2">
            <div class="col-lg m-2 p-2 shadow p-3 mb-1 bg-body rounded border border border-light">
            <p class="form-control"> Add New User </p>
            <form action="" class="p-2" method="POST">
                <div class="mb-3">
                        <label for="idType" class="form-label">Id</label>
                        <input type="text" name="id" class="form-control" id="idType" required>
                    </div>
                    <div class="mb-3">
                        <label for="passType" class="form-label">Pass</label>
                        <input type="password" name="pass" class="form-control" id="passType" required>
                    </div>
                    <div class="mb-3">
                    <label for="deptType" class="form-label">Select Department</label>
                    <select class="form-select" id="deptType" name="dept" aria-label="Default select example">
                        <option value="CE">Computer</option>
                        <option value="IT">Information Tech</option>
                        <option value="EC">Electronics & Communication</option>
                    </select>
                    </div>
                    <div class="mb-3">
                    <label for="deptType" class="form-label">Select Role</label>
                    <select class="form-select" id="roleType" name="role" aria-label="Default select example">
                        <option value="Faculty">Faculty</option>
                        <option value="Hod">Hod</option>
                    </select>
                    </div>
                    
                    <button type="submit" name="reg" class="btn btn-primary">Add</button>
                </form>
            </div>
            <div class="col-lg m-2 p-2 shadow p-3 mb-1 bg-body rounded border border border-light">
            <div class="form-group">
                <p class="form-control"> Active Users </p>
                    <form method="POST" action="" class="p-2" enctype="multipart/form-data">
                    <table class="table table-hover" id="table22">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Id</th>
                      <th scope="col">Role</th>
                      <th scope="col">Handle</th>
                    </tr>
                  </thead>
                   <tbody>
                   ';
                   $i=1;
                   $sql = "SELECT * FROM Profile ORDER BY role";
                   $result = mysqli_query($conn, $sql);
                   if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        if($row['role'] == 'Faculty' or $row['role'] == 'Hod'){
                            echo '<tr>
                            <td>'.$i.'</td>
                            <td>'.$row['id'].'</td>
                            <td>'.$row['role'].'</td>
                            <td><button type="submit" name="delete" value="'.$row["id"].'" class="btn btn-sm btn-danger">Delete</button> <button type="submit" name="reset" value="'.$row["id"].'" class="btn btn-sm btn-primary">Reset</button></td>
                            </tr>';
                        }
                        else{
                            echo '<tr>
                            <td>'.$i.'</td>
                            <td>'.$row['id'].'</td>
                            <td>'.$row['role'].'</td>
                            <td><button type="submit" name="delete" class="btn btn-sm btn-danger" disabled>Delete</button> <button type="submit" name="reset" class="btn btn-sm btn-primary" disabled>Reset</button></td>
                            </tr>';
                        }
                        $i=$i+1;
                    }
                   }
                        
                   echo '
                   </tbody>
                </table>
                </form>
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
    </script>   
    
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

if(isset($_POST['reg'])){
    $sql = "SELECT * FROM Profile WHERE id='".$_POST["id"]."'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
                echo"
            <script>
            handleAlerts('danger', 'Id Already Exist');
            setTimeout(function(){
                $('#alertCLose').trigger('click');
            }, 5000);
            </script>
            ";
        }
    } else {
        $pass = $_POST["pass"];
        $pass = password_hash((string)$pass,PASSWORD_DEFAULT);
        $sql = "INSERT INTO `Profile`(`id`, `password`, `dept`, `role`) VALUES ('".$_POST['id']."','".$pass."','".$_POST['dept']."','".$_POST['role']."')";
        if (mysqli_query($conn, $sql)) {
            $_SESSION["success"]='New User Added Successfully';
            echo "<script>location.href = 'home.php'; </script>";
        } else {
            $_SESSION["danger"]=' New User Not Added Successfully';
            echo "<script>location.href = 'home.php';</script>";
        }
    }
}


if(isset($_POST["delete"])){
    $str=$_POST["delete"];
    $sql = "DELETE FROM profile WHERE id='$str'" ;
    
    if ($conn->query($sql) === TRUE) {
        $_SESSION["success"]=$str.' Deleted Successfully';
        echo "<script>location.href = 'home.php'; </script>";
    } else {
        $_SESSION["danger"]=$str.' Not Deleted Successfully';
        echo "<script>location.href = 'home.php';</script>";
        //echo "Error updating record: " . $conn->error;
    }
}

if(isset($_POST["reset"])){
    $str=$_POST["reset"];
    $pass = password_hash((string)'123456',PASSWORD_DEFAULT);
    $sql = "UPDATE Profile SET password='$pass' WHERE id='$str'" ;
    
    if ($conn->query($sql) === TRUE) {
        $_SESSION["success"]=$str.' Password Reset Successfully';
        echo "<script>location.href = 'home.php'; </script>";
    } else {
        $_SESSION["danger"]=$str.' Password Not Deleted Successfully';
        echo "<script>location.href = 'home.php';</script>";
        //echo "Error updating record: " . $conn->error;
    }
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

?>

