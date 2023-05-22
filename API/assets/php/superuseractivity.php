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

if(isset($_POST["del"])){
    $str=$_POST["del"];
    $sql = "DELETE FROM Activity WHERE name='$str'" ;
    if ($conn->query($sql) === TRUE) {
        $_SESSION["success"]='Portfolio Deleted Successfully';
        echo "<script>location.href = 'activity.php'; </script>";
    } else {
        $_SESSION["danger"]='Portfolio Not Deleted Successfully';
        echo "<script>location.href = 'activity.php';</script>";
        //echo "Error updating record: " . $conn->error;
    }
}

if(isset($_POST["dels"])){
    $str=$_POST["dels"];
    $sql = "DELETE FROM Subject WHERE code='$str'" ;
    if ($conn->query($sql) === TRUE) {
        $_SESSION["success"]='Subject Deleted Successfully';
        echo "<script>location.href = 'activity.php'; </script>";
    } else {
        $_SESSION["danger"]='Subject Not Deleted Successfully';
        echo "<script>location.href = 'activity.php';</script>";
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

if(isset($_POST["addPort"])){
    $name = $_POST['name'];
    $type = $_POST['type'];
    if($type == ''){
        $_SESSION["danger"]='Select Type';
        echo "<script>location.href = 'activity.php';</script>";
    }
    else{
        $sql = "SELECT * FROM Activity WHERE name='".$name."' and type='".$type."'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $_SESSION["danger"]='Entry Already Exist !';
            echo "<script>location.href = 'activity.php';</script>";
        }

        else{
            $sql = "INSERT INTO Activity VALUES ('$name','$type')";
            if (mysqli_query($conn, $sql)) {
                $_SESSION["success"]='Portfolio Entry Successfully';
                echo "<script>location.href = 'activity.php';</script>";
            } else {
                $_SESSION["danger"]='Portfolio Denied Successfully';
                echo "<script>location.href = 'activity.php';</script>";
            }
        }

    }
}

if(isset($_POST["addSub"])){
    $name = $_POST['name'];
    $code = $_POST['code'];
    $sem = $_POST['sem'];
    if($sem == ''){
        $_SESSION["danger"]='Select Semester';
        echo "<script>location.href = 'activity.php';</script>";
    }
    else{
        $sql = "SELECT * FROM Subject WHERE name='".$name."' and code='".$code."' and sem='".$sem."'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $_SESSION["danger"]='Entry Already Exist !';
            echo "<script>location.href = 'activity.php';</script>";
        }

        else{
            $sql = "INSERT INTO Subject VALUES ('$code','$sem','$name')";
            if (mysqli_query($conn, $sql)) {
                $_SESSION["success"]='Subject Entry Successfully';
                echo "<script>location.href = 'activity.php';</script>";
            } else {
                $_SESSION["danger"]='Subject Denied Successfully';
                echo "<script>location.href = 'activity.php';</script>";
            }
        }

    }
}
?>