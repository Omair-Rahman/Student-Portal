<?php
  session_start();
  if (!isset($_SESSION['username']))
    header('location:../Registration/login.php');
  else
  {
    if ($_SESSION['auth'] != "Company")
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

    <title>Form | Job</title>
  </head>
  <body>
    <?php include '../nav.php'; ?>

    <div class="container">
      <h1 class="mb-4">Job Circular</h1>
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
      <form name="Form" action="job-validation.php" method="post">
        <div class="row input-group mb-3">
          <label for="inputtitle" class="col-sm-2 col-form-label"><b>Job Title</b></label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="title" value="" placeholder="Job Title..." required>
          </div>
        </div>

        <div class="row input-group mb-3">
          <label for="inputDescription" class="col-sm-2 col-form-label"><b>Job Description</b></label>
          <div class="col-sm-10">
            <textarea class="form-control" name="details" rows="10" cols="100" required></textarea>
          </div>
        </div>
        <div class="d-grid gap-2">
          <input type="submit" class="btn btn-sm btn-outline-dark" name="signup" value="POST">
        </div>
      </form>
    </div>

    <script src="../static/bootstrap/jquery-3.5.1.slim.min.js"></script>
    <script src="../static/bootstrap/popper.min.js"></script>
    <script src="../static/bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
