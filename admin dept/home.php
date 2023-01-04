<?php

include '../db.php';
if(!isset($_SESSION["id"])){
    echo"
    <script>
        location.href = '../index.php';
    </script>
    ";
}
$dept="";
$totalF=array();
$a=$_SESSION["id"];
// $sql = "SELECT * FROM Profile WHERE id='".$a."'";
// $result = mysqli_query($conn, $sql);
// if (mysqli_num_rows($result) > 0) {
//     while($row = mysqli_fetch_assoc($result)) {
//         $dept=$row["dept"];
//     }
    
// } else {
//     //tlp no entry.
// }

$sql = "SELECT * FROM Profile WHERE role='Faculty'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        // array_push($totalF,$row["name"]=>$row["id"]);
        $currentF=array($row["name"]=>$row["id"]);
        $totalF=array_merge($totalF, $currentF);
    }
    
} else {
    //tlp no entry.
}

// echo var_dump($totalF);

echo '

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Admin Dept</title>
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
    <div class="d-flex justify-content-center"> <img src="../assets/img/GU-Logo-Report.png" height="70" /> </div>
    <h6 class="d-flex justify-content-center">Gandhinagar Institute Of Technology</h6>
    <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#exampleModal">Change Password</a><a class="ms-3 float-end" href="../logout.php">Logout</a><hr>
        <div id="alertinner">
        
        </div>
        <div class="row p-2">
            <div class="col-lg m-2 p-2 shadow p-3 mb-1 bg-body rounded border border border-light">
                <div class="mb-3">
                    <input type="text" id="search" class="form-control" placeholder="Search BY Name OF Faculty...">
                </div>
                <form method="POST" action="" class="p-2" enctype="multipart/form-data">
                <table class="table table-hover" id="table22">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Element</th>
                    <th scope="col">Uniue</th>
                    <th scope="col">Point</th>
                    <th scope="col">Comment</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                ';
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
                                    <button type="submit" name="comment" id="commentBtn" value="DISC_'.$row["id"].'" class="btn btn-outline-dark btn-sm">POST</button>
                                    </div>
                                    </div>
                                    </td>
                                    <td>
                                    <div class="row">
                                    <div class="col-auto"><button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#DISC'.$row["id"].'">VIEW</button></div>
                                    ';
                                    if($row["verify"]==1){
                                        echo'<div class="col-auto"><button type="submit" name="v1" value="'.$row["id"].'_DISC" class="btn btn-success btn-sm" disabled>VERIFIED</button></div>';
                                    }
                                    else{
                                        echo'<div class="col-auto"><button type="submit" name="verify" value="DISC_'.$row["id"].'" class="btn btn-success btn-sm">VERIFY</button></div>';
                                    }
                                    if($row["comment"]){
                                    
                                        echo'<div class="col-auto"><button type="submit" name="reject" value="DISC_'.$row["id"].'" class="btn btn-danger btn-sm">REJECT</button></div>                              ';
                                    }
                                    else{
                                        echo'<div class="col-auto"><button type="submit" name="reject" class="btn btn-danger btn-sm" disabled>REJECT</button></div>';
                                    }
                                    echo'                            
                                    </div>
                                    </td>
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

                echo'
                
                </tbody>
                </table>
                </form>
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
    $("#table22").find("tr").find("#commentdata").each(function(){
        $(this).attr("name",$(this).attr("name").replace(/\@/g,\'-\'));
        $(this).attr("name",$(this).attr("name").replace(/\./g,\'-\'));
    })
    
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
    if(count($arr)==4){
        $element=$arr[0];
        $elementField=$arr[1];
        $tt=$arr[2];
        $cid=$arr[3];
        $abc="commentdata$element$cid$tt";
        $abc= str_replace('@','-',$abc);
        $abc= str_replace('.','-',$abc);
        $abc= str_replace('$','-',$abc);
        $abc= str_replace('%','-',$abc);
        $abc= str_replace('&','-',$abc);
        $abc= str_replace('^','-',$abc);
        $abc= str_replace(' ','-',$abc);
        $cdata=$_POST[$abc];
        $sql = "UPDATE $tt SET comment='$cdata'  WHERE id='$cid' AND $elementField='$element'" ;
        echo $sql;
        if ($conn->query($sql) === TRUE) {
            $_SESSION["success"]=$cid.' Entry Updated Successfully';
            echo "<script>location.href = 'home.php';</script>";
        } else {
            $_SESSION["danger"]=$cid.'Entry Not Updated Successfully';
            echo "<script>location.href = 'home.php';</script>";
            //echo "Error updating record: " . $conn->error;
        }
    }
    elseif(count($arr)==2){
        $tt=$arr[0];
        $cid=$arr[1];
        $id= str_replace('@','-',$cid);
        $id= str_replace('.','-',$id);
        $abc="commentdata$id$tt";
        $cdata=$_POST[$abc];
        $sql = "UPDATE $tt SET comment='$cdata'  WHERE id='$cid'";
    
        if ($conn->query($sql) === TRUE) {
            $_SESSION["success"]=$cid.' Entry Updated Successfully';
            echo "<script>location.href = 'home.php';</script>";
        } else {
            $_SESSION["danger"]=$cid.'Entry Not Updated Successfully';
            echo "<script>location.href = 'home.php';</script>";
            //echo "Error updating record: " . $conn->error;
        }
    }
}

if(isset($_POST["verify"])){
    $str=$_POST["verify"];
    $arr = preg_split("/[_]+/", $str);
    if(count($arr)==4){
        $element=$arr[0];
        $elementField=$arr[1];
        $tt=$arr[2];
        $cid=$arr[3];
        $sql = "UPDATE $tt SET verify=1,vid='$a' WHERE id='$cid' AND $elementField='$element'" ;
        if ($conn->query($sql) === TRUE) {
            $_SESSION["success"]=$cid.' Verified Successfully';
            echo "<script>location.href = 'home.php'; </script>";
        } else {
            $_SESSION["danger"]=$cid.' Not Verified Successfully';
            echo "<script>location.href = 'home.php';</script>";
            //echo "Error updating record: " . $conn->error;
        }
    }
    elseif(count($arr)==2){
        $tt=$arr[0];
        $cid=$arr[1];
        $sql = "UPDATE $tt SET verify=1,vid='$a' WHERE id='$cid'" ;
        if ($conn->query($sql) === TRUE) {
            $_SESSION["success"]=$cid.' Verified Successfully';
            echo "<script>location.href = 'home.php'; </script>";
        } else {
            $_SESSION["danger"]=$cid.' Not Verified Successfully';
            echo "<script>location.href = 'home.php';</script>";
            //echo "Error updating record: " . $conn->error;
        }
    }
}

if(isset($_POST["reject"])){
    $str=$_POST["reject"];
    $arr = preg_split("/[_]+/", $str);
    if(count($arr)==4){
        $element=$arr[0];
        $elementField=$arr[1];
        $tt=$arr[2];
        $cid=$arr[3];
        $sql = "UPDATE $tt SET verify=0,vid='',locked=0 WHERE id='$cid' AND $elementField='$element'" ;
        if ($conn->query($sql) === TRUE) {
            $_SESSION["success"]=$cid.' Rejected Successfully';
            echo "<script>location.href = 'home.php'; </script>";
        } else {
            $_SESSION["danger"]=$cid.' Not Rejected Successfully';
            echo "<script>location.href = 'home.php';</script>";
            //echo "Error updating record: " . $conn->error;
        }
    }
    elseif(count($arr)==2){
        $tt=$arr[0];
        $cid=$arr[1];
        $sql = "UPDATE $tt SET verify=0,vid='',locked=0 WHERE id='$cid'" ;
        if ($conn->query($sql) === TRUE) {
            $_SESSION["success"]=$cid.' Rejected Successfully';
            echo "<script>location.href = 'home.php'; </script>";
        } else {
            $_SESSION["danger"]=$cid.' Not Rejected Successfully';
            echo "<script>location.href = 'home.php';</script>";
            //echo "Error updating record: " . $conn->error;
        }
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

