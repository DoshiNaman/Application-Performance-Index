<?php
    include 'db.php';
    $sql = "SELECT id FROM Profile";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $a = 'document/'.$row["id"];
            if(!file_exists($a)){
                mkdir($a, 0777, true);
            }
        }
    }

    if(isset($_POST["login"])){
        $sql = "SELECT * FROM Profile WHERE id='".$_POST["id"]."'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
                if(password_verify($_POST["pass"],$row["password"])){
                    if($row["role"]=="Faculty"){
                        if($row["name"]==""){
                            $_SESSION["fprofile"]=0;
                            $_SESSION["id"]=$row["id"];
                            echo"
                            <script>
                                location.href = 'faculty/profile.php';
                            </script>
                            ";
                        }
                        else{
                            $_SESSION["fprofile"]=1;
                            $_SESSION["id"]=$row["id"];
                            echo"
                            <script>
                                location.href = 'faculty/home.php';
                            </script>
                            ";
                        }
                    }

                    if($row["role"]=="Hod"){
                        if($row["name"]==""){
                            $_SESSION["hprofile"]=0;
                            $_SESSION["id"]=$row["id"];
                            echo"
                            <script>
                                location.href = 'hod/profile.php';
                            </script>
                            ";
                        }
                        else{
                            $_SESSION["hprofile"]=1;
                            $_SESSION["id"]=$row["id"];
                            echo"
                            <script>
                                location.href = 'hod/home.php';
                            </script>
                            ";
                        }
                    }
                    
                    if($row["role"]=="Director"){
                            // $_SESSION["hprofile"]=1;
                            $_SESSION["id"]=$row["id"];
                            echo"
                            <script>
                                location.href = 'director/home.php';
                            </script>
                            ";
                    }
                    
                    if($row["role"]=="Admin"){
                            // $_SESSION["hprofile"]=1;
                            $_SESSION["id"]=$row["id"];
                            echo"
                            <script>
                                location.href = 'super user/home.php';
                            </script>
                            ";
                    }
                    
                    if($row["role"]=="Admin Dept"){
                            // $_SESSION["hprofile"]=1;
                            $_SESSION["id"]=$row["id"];
                            echo"
                            <script>
                                location.href = 'admin dept/home.php';
                            </script>
                            ";
                    }
                    
                }
                else{
                    echo"
                    <script>
                        alert('Password DON\'T Match');
                    </script>
                    ";
                }
                #echo "id: " . $row["id"]. " - pass: " . $row["password"]. " " . $row["name"]. "1<br>";
                
            }
        } else {
            echo"
            <script>
                alert('Username & Password DON\'T Exist');
            </script>
            ";
        }

    }
    
    mysqli_close($conn);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <style>
        /* Header */
        .large-header {
        position: relative;
        width: 100%;
        background: #333;
        overflow: hidden;
        background-size: cover;
        background-position: center center;
        z-index: 1;
        }
        #large-header {
        background-image: url("./assets/img/bg.jpg");
        }
        .container {
            position: absolute;
            margin: 0;
            padding: 10px;
            color: #f9f1e9;
            text-align: center;
            top: 50%;
            left: 50%;
            -webkit-transform: translate3d(-50%, -50%, 0);
            transform: translate3d(-50%, -50%, 0);
            min-width: 30%;
            max-width: 30%;
            /* border-radius: 10%;
            border: 1px solid white; */
            background: rgba( 0, 0, 0, 0.3 );
            box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37 );
            backdrop-filter: blur( 2px );
            -webkit-backdrop-filter: blur( 2px );
            border-radius: 10px;
            border: 1px solid rgba( 255, 255, 255, 0.18 );
        }
    @media (max-width:801px)  { 
        .container{
            min-width: 50%;
            max-width: 50%;
        }
    }
    </style>
</head>
<body>
    <div id="large-header" class="large-header">
        <canvas id="demo-canvas"></canvas>
        <div class="container">
        <form class="m-3" action="" method="POST">
            
    <img src="assets/img/GU-Logo-Report.png" height="70" /> 
    <h6>Gandhinagar Institute Of Technology</h6>
            <h1>API</h1>
            <div class="mb-3">
                <!-- <label for="idType" class="form-label">Unique Id</label> -->
                <input type="text" placeholder='Unique ID' name="id" class="form-control bg-transparent text-white" id="idType" required>
            </div>
            <div class="mb-3">
                <!-- <label for="passType" class="form-label">Password</label> -->
                <input type="password" placeholder='Password' name="pass" class="form-control bg-transparent text-white" id="passType" required>
            </div>
            <button type="submit" name="login" class="btn btn-primary bg-transparent">Login</button>
        </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.3/gsap.min.js"></script>
    <script id="rendered-js">
        (function () {

            var width,height,largeHeader,canvas,ctx,points,target,animateHeader = true;

            // Main
            initHeader();
            initAnimation();
            addListeners();

            function initHeader() {
            width = window.innerWidth;
            height = window.innerHeight;
            target = { x: width / 2, y: height / 2 };

            largeHeader = document.getElementById('large-header');
            largeHeader.style.height = height + 'px';

            canvas = document.getElementById('demo-canvas');
            canvas.width = width;
            canvas.height = height;
            ctx = canvas.getContext('2d');

            // create points
            points = [];
            for (var x = 0; x < width; x = x + width / 20) {
                for (var y = 0; y < height; y = y + height / 20) {
                var px = x + Math.random() * width / 20;
                var py = y + Math.random() * height / 20;
                var p = { x: px, originX: px, y: py, originY: py };
                points.push(p);
                }
            }

            // for each point find the 5 closest points
            for (var i = 0; i < points.length; i++) {
                var closest = [];
                var p1 = points[i];
                for (var j = 0; j < points.length; j++) {
                var p2 = points[j];
                if (!(p1 == p2)) {
                    var placed = false;
                    for (var k = 0; k < 5; k++) {
                    if (!placed) {
                        if (closest[k] == undefined) {
                        closest[k] = p2;
                        placed = true;
                        }
                    }
                    }

                    for (var k = 0; k < 5; k++) {
                    if (!placed) {
                        if (getDistance(p1, p2) < getDistance(p1, closest[k])) {
                        closest[k] = p2;
                        placed = true;
                        }
                    }
                    }
                }
                }
                p1.closest = closest;
            }

            // assign a circle to each point
            for (var i in points) {
                var c = new Circle(points[i], 2 + Math.random() * 2, 'rgba(255,255,255,0.3)');
                points[i].circle = c;
            }
            }

            // Event handling
            function addListeners() {
            if (!('ontouchstart' in window)) {
                window.addEventListener('mousemove', mouseMove);
            }
            window.addEventListener('scroll', scrollCheck);
            window.addEventListener('resize', resize);
            }

            function mouseMove(e) {
            var posx = posy = 0;
            if (e.pageX || e.pageY) {
                posx = e.pageX;
                posy = e.pageY;
            } else
            if (e.clientX || e.clientY) {
                posx = e.clientX + document.body.scrollLeft + document.documentElement.scrollLeft;
                posy = e.clientY + document.body.scrollTop + document.documentElement.scrollTop;
            }
            target.x = posx;
            target.y = posy;
            }

            function scrollCheck() {
            if (document.body.scrollTop > height) animateHeader = false;else
            animateHeader = true;
            }

            function resize() {
            width = window.innerWidth;
            height = window.innerHeight;
            largeHeader.style.height = height + 'px';
            canvas.width = width;
            canvas.height = height;
            }

            // animation
            function initAnimation() {
            animate();
            for (var i in points) {
                shiftPoint(points[i]);
            }
            }

            function animate() {
            if (animateHeader) {
                ctx.clearRect(0, 0, width, height);
                for (var i in points) {
                // detect points in range
                if (Math.abs(getDistance(target, points[i])) < 4000) {
                    points[i].active = 0.3;
                    points[i].circle.active = 0.6;
                } else if (Math.abs(getDistance(target, points[i])) < 20000) {
                    points[i].active = 0.1;
                    points[i].circle.active = 0.3;
                } else if (Math.abs(getDistance(target, points[i])) < 40000) {
                    points[i].active = 0.02;
                    points[i].circle.active = 0.1;
                } else {
                    points[i].active = 0;
                    points[i].circle.active = 0;
                }

                drawLines(points[i]);
                points[i].circle.draw();
                }
            }
            requestAnimationFrame(animate);
            }

            function shiftPoint(p) {
            TweenLite.to(p, 1 + 1 * Math.random(), { x: p.originX - 50 + Math.random() * 100,
                y: p.originY - 50 + Math.random() * 100, ease: Circ.easeInOut,
                onComplete: function () {
                shiftPoint(p);
                } });
            }

            // Canvas manipulation
            function drawLines(p) {
            if (!p.active) return;
            for (var i in p.closest) {
                ctx.beginPath();
                ctx.moveTo(p.x, p.y);
                ctx.lineTo(p.closest[i].x, p.closest[i].y);
                ctx.strokeStyle = 'rgba(156,217,249,' + p.active + ')';
                ctx.stroke();
            }
            }

            function Circle(pos, rad, color) {
            var _this = this;

            // constructor
            (function () {
                _this.pos = pos || null;
                _this.radius = rad || null;
                _this.color = color || null;
            })();

            this.draw = function () {
                if (!_this.active) return;
                ctx.beginPath();
                ctx.arc(_this.pos.x, _this.pos.y, _this.radius, 0, 2 * Math.PI, false);
                ctx.fillStyle = 'rgba(156,217,249,' + _this.active + ')';
                ctx.fill();
            };
            }

            // Util
            function getDistance(p1, p2) {
            return Math.pow(p1.x - p2.x, 2) + Math.pow(p1.y - p2.y, 2);
            }

            })();
    </script>
</body>
</html>




<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container">
        <form class="mt-5" action="" method="POST">
            <div class="mb-3">
                <label for="idType" class="form-label">Unique Id</label>
                <input type="text" name="id" class="form-control" id="idType" required>
            </div>
            <div class="mb-3">
                <label for="passType" class="form-label">Password</label>
                <input type="password" name="pass" class="form-control" id="passType" required>
            </div>
            <button type="submit" name="login" class="btn btn-primary">Login</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html> -->