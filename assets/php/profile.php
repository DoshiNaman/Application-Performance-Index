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


if(isset($_POST["submit"])){
    $a=$_SESSION["id"];
    $b=$_POST["title"];
    $fn=$_POST["fname"];
    $mn=$_POST["mname"];
    $ln=$_POST["lname"];
    $name=$b.''.$fn.' '.$mn.' '.$ln;

    $fpdfname=$name."-DP.jpg";
    $attachment=$_FILES['attachment']['name'];
    $attachment_type=$_FILES['attachment']['type'];
    $attachment_size=$_FILES['attachment']['size'];
    $attachment_tem_loc=$_FILES['attachment']['tmp_name'];
    $attachment_store="../../document/".$a."/".$attachment;
    move_uploaded_file($attachment_tem_loc,$attachment_store);
    $newpath="../../document/".$a."/".$fpdfname;
    rename($attachment_store, $newpath);
    $sql = "UPDATE Profile SET `name`='".$name."',`dp`='".$fpdfname."' WHERE `id`='".$a."'";
    if (mysqli_query($conn, $sql)) {
        $_SESSION["fprofile"]=1;
        $_SESSION["success"]='Profile Created Successfully';
        echo "<script>location.href = 'profile.php';</script>";
    } else {
        $_SESSION["fprofile"]=0;
        $_SESSION["danger"]='Profile Not Created';
        echo "<script>location.href = 'profile.php';</script>";
    }

}

if(isset($_POST["update"])){
    $a=$_SESSION["id"];
    $b=$_POST["title"];


    if($_FILES['attachment']['name'] != "") {
        $fpdfname=$b."-DP.jpg";
        $attachment=$_FILES['attachment']['name'];
        $attachment_type=$_FILES['attachment']['type'];
        $attachment_size=$_FILES['attachment']['size'];
        $attachment_tem_loc=$_FILES['attachment']['tmp_name'];
        $attachment_store="../../document/".$a."/".$attachment;
        move_uploaded_file($attachment_tem_loc,$attachment_store);
        $newpath="../../document/".$a."/".$fpdfname;
        rename($attachment_store, $newpath);
        $sql = "UPDATE Profile SET `name`='".$b."',`dp`='".$fpdfname."' WHERE `id`='".$a."'";
        if (mysqli_query($conn, $sql)) {
        $_SESSION["success"]='Profile Updated Successfully';
        echo "<script>window.location.href = window.location.href</script>";
        } else {
        $_SESSION["danger"]='Profile Not Updated';
        echo "<script>location.href = 'profile.php';</script>";
        }
    }
    else{
        $sql = "UPDATE Profile SET `name`='".$b."' WHERE `id`='".$a."'";
        if (mysqli_query($conn, $sql)) {
        $_SESSION["success"]='Profile Updated Successfully';
        echo "<script>window.location.href = window.location.href</script>";
        } else {
        $_SESSION["danger"]='Profile Not Updated';
        echo "<script>location.href = 'profile.php';</script>";
        }
    }
}


if(isset($_POST["savepassword"])){
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
                    $_SESSION["success"]='Password Changed';
                    echo "<script>location.href = 'profile.php';</script>";
                } else {
                    $_SESSION["danger"]='Password Not Chanaged';
                    echo "<script>location.href = 'profile.php';</script>";
                }
                }
                elseif($oldpass==$pass1){
                    $_SESSION["danger"]='Old & New Password Not Match';
                    echo "<script>location.href = 'profile.php';</script>";
                }
                else{
                    $_SESSION["danger"]='New Passwords Does Not Match';
                    echo "<script>location.href = 'profile.php';</script>";
                }
            }
            else{
                $_SESSION["danger"]='Old Passsword Does Not Match';
                echo "<script>location.href = 'profile.php';</script>";
            }
        }
    }
    else{
        $_SESSION["danger"]='Enter Passwords';
        echo "<script>location.href = 'profile.php';</script>";
    }
}

?>