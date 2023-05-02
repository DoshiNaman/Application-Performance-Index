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
        if ($conn->query($sql) === TRUE) {
            $_SESSION["success"]=$tt.' Entry Updated Successfully';
            echo "<script>location.href = 'home.php';</script>";
        } else {
            $_SESSION["danger"]=$tt.' Entry Not Updated Successfully';
            echo "<script>location.href = 'home.php';</script>";
        }
    }
    elseif(count($arr)==2){
        $tt=$arr[0];
        $cid=$arr[1];
        $abc="commentdata$cid$tt";
        $abc="commentdata$element$cid$tt";
        $abc= str_replace('@','-',$abc);
        $abc= str_replace('.','-',$abc);
        $abc= str_replace('$','-',$abc);
        $abc= str_replace('%','-',$abc);
        $abc= str_replace('&','-',$abc);
        $abc= str_replace('^','-',$abc);
        $abc= str_replace(' ','-',$abc);
        $cdata=$_POST[$abc];
        $sql = "UPDATE $tt SET comment='$cdata'  WHERE id='$cid'";
    
        if ($conn->query($sql) === TRUE) {
            $_SESSION["success"]=$tt.' Entry Updated Successfully';
            echo "<script>location.href = 'home.php';</script>";
        } else {
            $_SESSION["danger"]=$tt.' Entry Not Updated Successfully';
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
            $_SESSION["success"]=$tt.' Verified Successfully';
            echo "<script>location.href = 'home.php'; </script>";
        } else {
            $_SESSION["danger"]=$tt.' Not Verified Successfully';
            echo "<script>location.href = 'home.php';</script>";
            //echo "Error updating record: " . $conn->error;
        }
    }
    elseif(count($arr)==2){
        $tt=$arr[0];
        $cid=$arr[1];
        $sql = "UPDATE $tt SET verify=1,vid='$a' WHERE id='$cid'" ;
        if ($conn->query($sql) === TRUE) {
            $_SESSION["success"]=$tt.' Verified Successfully';
            echo "<script>location.href = 'home.php'; </script>";
        } else {
            $_SESSION["danger"]=$tt.' Not Verified Successfully';
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
            $_SESSION["success"]=$tt.' Rejected Successfully';
            echo "<script>location.href = 'home.php'; </script>";
        } else {
            $_SESSION["danger"]=$tt.' Not Rejected Successfully';
            echo "<script>location.href = 'home.php';</script>";
            //echo "Error updating record: " . $conn->error;
        }
    }
    elseif(count($arr)==2){
        $tt=$arr[0];
        $cid=$arr[1];
        $sql = "UPDATE $tt SET verify=0,vid='',locked=0 WHERE id='$cid'" ;
        if ($conn->query($sql) === TRUE) {
            $_SESSION["success"]=$tt.' Rejected Successfully';
            echo "<script>location.href = 'home.php'; </script>";
        } else {
            $_SESSION["danger"]=$tt.' Not Rejected Successfully';
            echo "<script>location.href = 'home.php';</script>";
            //echo "Error updating record: " . $conn->error;
        }
    }
  }

?>