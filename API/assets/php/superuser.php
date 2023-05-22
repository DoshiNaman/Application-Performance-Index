<?php 
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
        $_SESSION["success"]=$str.' Password Reset Successfully <br/>( New Password : 123456 )';
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