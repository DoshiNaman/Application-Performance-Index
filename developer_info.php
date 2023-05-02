<?php

  //database connection
  include 'db.php';

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
      href="assets/bootstrap-5.3.0-alpha1-dist/css/bootstrap.min.css"
    />
    <!--Blury Image CSS-->
    <link rel="stylesheet" href="assets/css/blurry-load.min.css" />
    <!--External CSS-->
    <link rel="stylesheet" href="assets/css/base.css" />
    <link rel="apple-touch-icon" sizes="180x180" href="assets/icons/favicon_io/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/icons/favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/icons/favicon_io/favicon-16x16.png">
    <link rel="manifest" href="assets/icons/favicon_io/site.webmanifest">
  </head>
  <body>
    <div class="container mt-5 mb-5 rounded shadow-lg base">
      <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
          <img
            src="assets/img/gu-logo.png"
            data-large="assets/img/gu-logo.png"
            alt="GU LOGO"
            class="navbar-brand blurry-load"
            height="70"
            role="button"
            onclick="location.href = 'index.php';"
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
                  <a class="nav-link linkclass" href="index.php">
                    <img
                      alt=""
                      src="assets/icons/home.png"
                      data-large="assets/icons/home.png"
                      class="goldicon goldicon1 blurry-load"
                    />
                    Home</a
                  >
                </li>
                <li class="nav-item">
                  <a class="nav-link linkclass" href="feedback.php">
                    <img
                      alt=""
                      src="assets/icons/feedback.png"
                      data-large="assets/icons/feedback.png"
                      class="goldicon blurry-load"
                    />
                    Give Feedback</a
                  >
                </li>
                <?php 
                if(isset($_SESSION["id"]) && isset($_SESSION["role"])){
                  echo '<li class="nav-item">
                    <a class="nav-link linkclass" href="users/'.strtolower($_SESSION["role"]).'/home.php">
                      <img
                        alt=""
                        src="assets/icons/dashboard.png"
                        data-large="assets/icons/dashboard.png"
                        class="goldicon blurry-load"
                      />
                      Dashboard</a
                    >
                  </li>
                  <li class="nav-item">
                    <a class="nav-link linkclass" href="logout.php">
                      <img
                        alt=""
                        src="assets/icons/allout.png"
                        data-large="assets/icons/allout.png"
                        class="goldicon blurry-load"
                      />
                      LogOut</a
                    >
                  </li>';
                }
                ?>
              </ul>
            </div>
          </div>
        </div>
      </nav>
      <div class="row pb-5">
        <div class="col d-flex justify-content-center text-align-items">
          <figure class="snip1336">
            <img
              src="assets/img/wallpaper3.jpg"
              data-large="assets/img/wallpaper3.jpg"
              alt="sample87"
              class="blurry-load"
            />
            <figcaption>
              <img
                src="assets/img/mentor1.jpeg"
                data-large="assets/img/mentor1.jpeg"
                alt="profile-sample4"
                class="profile blurry-load"
              />
              <h2>
                Hetal Shah<span
                  >I/C Director, Institution's Innovation Council</span
                >
              </h2>
              <p>
                Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                Laudantium, minus ullam hic mollitia temporibus eligendi?
              </p>
              <a
                href="https://www.linkedin.com/in/hetal-shah-5953181b/"
                class="follow"
                >Follow</a
              >
            </figcaption>
          </figure>
        </div>
        <div class="col d-flex justify-content-center text-align-items">
          <figure class="snip1336 hover">
            <img
              src="assets/img/wallpaper1.jpg"
              data-large="assets/img/wallpaper1.jpg"
              alt="sample74"
              class="blurry-load"
            />
            <figcaption>
              <img
                src="assets/img/developer3.jpg"
                data-large="assets/img/developer3.jpg"
                alt="profile-sample2"
                class="profile blurry-load"
              />
              <h2>Naman Doshi<span>Full Stack Developer</span></h2>
              <p>
                Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                Laudantium, minus ullam hic mollitia temporibus eligendi?
              </p>
              <a
                href="https://www.linkedin.com/in/naman-doshi-007/"
                class="follow"
                >Follow</a
              >
            </figcaption>
          </figure>
        </div>
        <!-- <div class="col d-flex justify-content-center text-align-items">
          <figure class="snip1336">
            <img
              src="assets/img/wallpaper2.jpg"
              data-large="assets/img/wallpaper2.jpg"
              alt="sample69"
              class="blurry-load"
            />
            <figcaption>
              <img
                src="assets/img/mentor2.jpeg"
                data-large="assets/img/mentor2.jpeg"
                alt="profile-sample5"
                class="profile blurry-load"
              />
              <h2>Shital Patel<span>Assistant Professor</span></h2>
              <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit.
                Possimus reprehenderit ipsa dicta dolore nulla illum?
              </p>
              <a
                href="https://gandhinagaruni.ac.in/team-member/prof-shital-patel/"
                class="follow"
                >Follow</a
              >
            </figcaption>
          </figure>
        </div> -->
      </div>
    </div>
    <div class="container mb-5 footer">
      <div class="m-2 p-0 row footertext">
        <div class="col-md-4">
          <img
            src="assets/img/gu-logo.png"
            data-large="assets/img/gu-logo.png"
            alt="GU LOGO"
            height="60"
            class="blurry-load"
            role="button"
            onclick="location.href = 'index.php';"
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
    <script src="assets/bootstrap-5.3.0-alpha1-dist/js/bootstrap.min.js"></script>
    <!--Blurry Image JS-->
    <script src="assets/js/blury-load.min.js"></script>
    <!--JQuery JS-->
    <script
      src="https://code.jquery.com/jquery-3.6.3.min.js"
      integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU="
      crossorigin="anonymous"
    ></script>
    <!--External JS-->
    <script src="assets/js/main.js"></script>
  </body>
</html>

<!-- lass="col-md-auto"> 
          Guidance By
          <a href="index.html" class="linkclass">Prof. Hetal Shah</a> &
          <a href="index.html" class="linkclass">Prof. Shital Patel</a> -->
