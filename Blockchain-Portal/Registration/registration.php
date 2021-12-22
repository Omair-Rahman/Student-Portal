<?php
  session_start();
  if (!isset($_SESSION['username']))
    header('location:../Registration/login.php');
  else
  {
    if ($_SESSION['auth'] != "Admin")
      header('location:../dashboard/index.php');
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../static/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../static/css/style.css">

    <title>Form | Registration</title>
  </head>
  <body>
    <?php include '../nav.php'; ?>

    <div class="container">
      <h1 class="mb-4">Registration Form</h1>
      <?php
        if (isset($_SESSION['PassErr']))
        {
          echo '<div class="alert alert-danger" role="alert">' . $_SESSION['PassErr'] . '</div>';
          unset($_SESSION['PassErr']);
        }
        if (isset($_SESSION['Pass']))
        {
          echo '<div class="alert alert-success" role="alert">' . $_SESSION['Pass'] . '</div>';
          unset($_SESSION['Pass']);
        }
      ?>
      <form name="Form" action="validation.php" onsubmit="return validateForm()" method="post">
        <div class="row input-group mb-3">
          <label for="inputUsername3" class="col-sm-2 col-form-label"><b>Username</b></label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="username" value="" placeholder="Username" required>
            <small><span class="is-invalid error" id="userErr"></span></small><br>
          </div>
        </div>

        <div class="row input-group mb-3">
          <label for="inputfullname" class="col-sm-2 col-form-label"><b>Full Name</b></label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="fname" value="" placeholder="Your name!!!" required>
          </div>
        </div>

        <div class="row input-group mb-3">
          <label for="inputEmail3" class="col-sm-2 col-form-label"><b>Email</b></label>
          <div class="col-sm-10">
            <input type="email" class="form-control" name="email" value="" placeholder="abc@xyz.com" required>
          </div>
        </div>

        <div class="row input-group mb-3">
          <label for="inputPhone3" class="col-sm-2 col-form-label"><b>Phone</b></label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="phone" value="" placeholder="01XXXXXXXXX" required>
          </div>
        </div>

        <div class="row input-group mb-3">
          <label for="inputAddress3" class="col-sm-2 col-form-label"><b>Address</b></label>
          <div class="col-sm-10">
            <textarea class="form-control" name="address" rows="5" cols="40" required></textarea>
          </div>
        </div>

        <div class="row input-group mb-3">
          <label for="inputAddress3" class="col-sm-2 col-form-label"><b>Date of Birth</b></label>
          <div class="col-sm-10">
            <input type="date" class="form-control" name="dob" value="" required>
          </div>
        </div>

        <div class="row mb-3">
          <label for="inputAddress3" class="col-sm-2 col-form-label"><b>Gender</b></label>
          <div class="col-sm-10">
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="gender" id="inlineRadio1" value="Male" required>
              <label class="form-check-label" for="inlineRadio1">Male</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="gender" id="inlineRadio2" value="Female" required>
              <label class="form-check-label" for="inlineRadio2">Female</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="gender" id="inlineRadio3" value="Other" required>
              <label class="form-check-label" for="inlineRadio3">Custom</label>
            </div>
          </div>
        </div>

        <div class="row mb-3">
          <label for="inputAddress3" class="col-sm-2 col-form-label"><b>Password</b></label>
          <div class="row g-3 col-sm-10">
            <div class="col">
              <input type="password" class="form-control" name="password" value="" placeholder="Password" required><br>
              <small><span class="error" id="passErr"></span></small>
            </div>
            <div class="col">
              <input type="password" class="form-control" name="re-password" value="" placeholder="Confirm" required>
              <small><span class="error" id="rePassErr"></span></small>
            </div>
          </div>
        </div>

        <div class="row mb-3">
          <label for="inputAddress3" class="col-sm-2 col-form-label"><b>User Authentication</b></label>
          <div class="col-sm-10">
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="auth" id="inlineRadio1" value="Admin" onclick="txtfield(0)" required>
              <label class="form-check-label" for="inlineRadio1">Admin</label>
            </div>

            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="auth" id="inlineRadio2" value="Student" onclick="txtfield(1)" required>
              <label class="form-check-label" for="inlineRadio2">Student</label>
            </div>

            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="auth" id="inlineRadio3" value="Company" onclick="txtfield(2)" required>
              <label class="form-check-label" for="inlineRadio3">Company</label>
            </div>

            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="auth" id="inlineRadio4" value="Teacher" onclick="txtfield(1)" required>
              <label class="form-check-label" for="inlineRadio4">Teacher</label>
            </div>
          </div>
        </div>

        <div class="row input-group mb-3" id="uni-field">
          <label for="inputEmail3" class="col-sm-2 col-form-label"><b>University</b></label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="university" value="" placeholder="University">
          </div>
        </div>
        <div class="row input-group mb-3" id="com-field">
          <label for="inputEmail3" class="col-sm-2 col-form-label"><b>Company</b></label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="company" value="" placeholder="Company">
          </div>
        </div>

        <div class="row mb-3">
          <label for="inputAddress3" class="col-sm-2 col-form-label"></label>
          <div class="col-sm-10">
            <div class="form-check">
              <input type="checkbox" class="form-check-input" id="checkbox" value="" required>
              <label class="form-check-label"><b>I Accept the Terms & Conditions</b></label>
            </div>
          </div>
        </div>

        <div class="d-md-flex justify-content-md-end mb-3">
          <input type="submit" class="btn btn-outline-dark btn-lg" name="signup" value="Submit">
        </div>
      </form>
    </div>

    <script src="../static/js/formValidation.js"></script>
    <script src="../static/js/auth-popup.js"></script>
    <script src="../static/bootstrap/jquery-3.5.1.slim.min.js"></script>
    <script src="../static/bootstrap/popper.min.js"></script>
    <script src="../static/bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
