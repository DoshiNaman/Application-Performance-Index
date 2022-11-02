<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
      <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>-->
</head>
<body>
<?php
include 'db.php';
error_reporting(E_ERROR | E_PARSE);

if(isset($_POST['reg'])){
    $sql = "SELECT * FROM Profile WHERE id='".$_POST["id"]."'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
                echo"
            <script>
                alert('Id Exist');
            </script>
            ";
        }
    } else {
        $pass = $_POST["pass"];
        $pass = password_hash((string)$pass,PASSWORD_DEFAULT);
        $sql = "INSERT INTO `Profile`(`id`, `password`, `dept`, `role`) VALUES ('".$_POST['id']."','".$pass."','".$_POST['dept']."','".$_POST['role']."')";
        if (mysqli_query($conn, $sql)) {
            echo"
            <script>
                alert('Suucessfully');
                location.href = 'index.php';
            </script>
            ";
        } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
}

$user = $_POST['user'];
$pass = $_POST['pass'];

if($user == "admin"
&& $pass == "admin")
{
    echo'
    <div class="container">
        <form class="mt-5" action="" method="POST">
        <h3>Welcome Admin</h3>
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
    ';
}
else
{
    echo'
            <div class="container">
                <form class="mt-5" action="" method="POST">
                <h3>Admin</h3>
                    <div class="mb-3">
                        <label for="idType" class="form-label">User</label>
                        <input type="text" name="user" class="form-control" id="idType" required>
                    </div>
                    <div class="mb-3">
                        <label for="passType" class="form-label">Pass</label>
                        <input type="password" name="pass" class="form-control" id="passType" required>
                    </div>
                    <button type="submit" name="login" class="btn btn-primary">Login</button>
                </form>
            </div>
    ';
}
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>