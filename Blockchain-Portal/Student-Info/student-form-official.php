<?php
  session_start();
  if (!isset($_SESSION['username']))
    header('location:../Registration/login.php');
  else
  {
    /*if ($_SESSION['auth'] != "Student")
      header('location:../dashboard/index.php');*/

    $conn = mysqli_connect("localhost", "root", "", "student_portal");
    if (!$conn)
      die("Connection failed: " . mysqli_connect_error());
    $sql = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM students WHERE UserName = '$_SESSION[studentName]'"));
    $sqlUni = mysqli_query($conn, "SELECT * FROM unidata WHERE StudentName = '$_SESSION[studentName]'");
    $sqlImg = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM profile_pic WHERE UserName = '$_SESSION[studentName]'"));
    $sqlTeacherInfo = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM auth WHERE UserName = '$_SESSION[username]'"));

    unset($_SESSION['studentName']);
    if ($sqlTeacherInfo['University'] != $sql['University'])
    {
      $_SESSION['PassErr'] = "YOU CAN ONLY AUTHORIZE TO ACCESS YOUR STUDENTS";
      header('location:../Student-Info/student-data.php');
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Form | Student</title>

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  	<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
  	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../static/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../static/css/style.css">

    <link rel="stylesheet" href="../static/css/StyleProfile.css">
  </head>
  <body>
    <?php include '../nav.php'; ?>

      <div class="container emp-profile">
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
        <form class="" action="uni-valid-student.php" method="post" enctype="multipart/form-data">
          <div class="row">
            <div class="col-md-4">
              <div class="profile-img">
                <img src="<?php echo $sqlImg['Image']; ?>">
              </div>
            </div>
            <div class="col-md-6">
              <div class="profile-head">
                <h5><b><?php echo $sql['UserName']; ?></b></h5>
                <h6><b><?php echo $sql['University']; ?></b></h6>
                <p class="proile-rating"></p>
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" role="tab"
                              aria-controls="home" aria-selected="true"><b>PERSONAL INFORMATION</b></a>
                  </li>
                </ul>
              </div>
            </div>
          </div>

          <?php
            if (mysqli_num_rows($sqlUni) != 0)
              $false = true;
            else
              $false = false;
          ?>

          <div class="row">
            <div class="col-md-4">
              <div class="profile-work">

                <p><b>CGPA</b></p>
                <input type="text" class="form-control input-group mb-3" name="cgpa" value=
                  "<?php
                    if ($false == true)
                    {
                      $sqlUni = mysqli_fetch_assoc($sqlUni);
                      echo $sqlUni['cgpa'];
                    }
                    else
                      echo "NONE";
                  ?>" required>

                <p><b>CREDITS EARNED</b></p>
                <input type="text" class="form-control input-group mb-3" name="credits" value=
                  "<?php
                    if ($false == true)
                      echo $sqlUni['credit'];
                    else
                      echo "NONE";
                  ?>" required>
              </div>
            </div>

            <div class="col-md-8">
              <div class="tab-content profile-tab" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                  <div class="row input-group mb-3">
                    <div class="col-md-6">
                      <label>Student Name</label>
                    </div>
                    <div class="col-md-6">
                      <input type="hidden" name="NAME" value="<?php echo $sql['UserName']; ?>">
                      <?php echo $sql['UserName']; ?>
                    </div>
                  </div>
                  <div class="row input-group mb-3">
                    <div class="col-md-6">
                      <label>Resume</label>
                    </div>
                    <div class="col-md-6">
                      <input type="file" name="resume" class="form-control" value=
                        "<?php
                          if ($false == true)
                            echo $sqlUni['studentResume'];
                        ?>" required>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <input class="btn btn-outline-info btn-lg" type="submit" name="upload" value="Update">
          </div>
        </form>
      </div>

      <?php mysqli_close($conn); ?>

      <script src="../static/bootstrap/jquery-3.5.1.slim.min.js"></script>
      <script src="../static/bootstrap/popper.min.js"></script>
      <script src="../static/bootstrap/js/bootstrap.min.js"></script>
    </body>
  </html>
