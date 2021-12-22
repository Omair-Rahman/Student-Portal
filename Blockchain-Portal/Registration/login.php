<?php session_start(); ?>

<!DOCTYPE html>
<html>

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Login | Form</title>

    <link rel="stylesheet" href="../static/css/StyleLogin.css">
  </head>

  <body>
    <div class="limiter">
      <div class="container-login100">
        <div class="wrap-login100">
          <div class="login100-pic js-tilt">
            <img src="../static/img/img-01.png" alt="IMG">
          </div>

          <form class="login100-form validate-form" action="../Registration/auth.php" method="post">
            <span class="login100-form-title">
              <h2><b>Member Login</b></h2>
            </span>

            <div class="wrap-input100 validate-input">
              <input class="input100" type="text" name="username" placeholder="Username">
              <span class="focus-input100"></span>
              <span class="symbol-input100">
                <i class="fa fa-user" aria-hidden="true"></i>
              </span>
            </div>

            <div class="wrap-input100 validate-input">
              <input class="input100" type="password" name="password" placeholder="Password">
              <span class="focus-input100"></span>
              <span class="symbol-input100">
                <i class="fa fa-lock" aria-hidden="true"></i>
              </span>
            </div>

            <?php
              if (isset($_SESSION['PassErr']))
              {
                echo '<div class="alert" role="alert">' . $_SESSION['PassErr'] . '</div>';
                unset($_SESSION['PassErr']);
              }
            ?>

            <div class="container-login100-form-btn">
              <button class="login100-form-btn">
                Login
              </button>
            </div>

            <!--<div class="text-center p-t-12">
              <a class="txt2" href="#">
                Create your Account
                <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
              </a>
            </div>-->

            <div class="text-center p-t-136"></div>
          </form>
        </div>
      </div>
    </div>
  </body>

</html>
