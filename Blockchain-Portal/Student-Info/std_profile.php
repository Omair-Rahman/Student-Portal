<?php
  session_start();
  if (!isset($_SESSION['username']))
    header('location:../Registration/login.php');

    if ($_SESSION['auth'] != "Student")
      header('location:../dashboard/index.php');

    $conn = mysqli_connect("localhost", "root", "", "student_portal");
  	if (!$conn)
  		die("Connection failed: " . mysqli_connect_error());
    $sql = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM students WHERE UserName = '$_SESSION[username]'"));
    $sqlAuth = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM auth WHERE UserName = '$_SESSION[username]'"));
    $sqlInfo = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM users WHERE UserName = '$_SESSION[username]'"));
    $sqlImg = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM profile_pic WHERE UserName = '$_SESSION[username]'"));
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Profile | Student</title>

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
      <form method="post" action="resume.php" enctype="multipart/form-data">
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
                  <a class="nav-link active" id="home-tab" data-toggle="tab" role="tab" aria-controls="home" aria-selected="true"><b>PERSONAL INFORMATION</b></a>
                </li>
              </ul>
            </div>
          </div>
          <div class="col-md-2">
            <a class="profile-edit-btn" href="student-form-personal.php" name="btnAddMore">Edit Profile</a>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">
            <div class="profile-work">
              <p><b>WORK PROFILE LINK</b></p>
              <i></i>
              <a href="<?php echo $sql['linkedin_profile']; ?>">Linkedin Profile</a><br/>
              <a href="<?php echo $sql['github_profile']; ?>">GitHub Profile</a><br/>
              <p><b>SKILLS</b></p>
              <?php echo $sql['skils']; ?>
            </div>
            <div class="profile-work">
              <label><i><b>Career Profile</b></i></label><br>
              <button type="submit" class="btn btn-secondary btn-sm" name="StdCV">Resume</button>
            </div>
          </div>

          <div class="col-md-8">
            <div class="tab-content profile-tab" id="myTabContent">
              <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <div class="row">
                  <div class="col-md-6">
                    <label>Username</label>
                  </div>
                  <div class="col-md-6">
                    <p><?php echo $sql['UserName']; ?></p>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <label>Full Name</label>
                  </div>
                  <div class="col-md-6">
                    <p><?php echo $sqlAuth['FullName']; ?></p>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <label>Address</label>
                  </div>
                  <div class="col-md-6">
                    <p><?php echo $sql['Address']; ?></p>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <label>Email</label>
                  </div>
                  <div class="col-md-6">
                    <p><?php echo $sqlInfo['Email']; ?></p>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <label>Phone</label>
                  </div>
                  <div class="col-md-6">
                    <p><?php echo $sql['Phone']; ?></p>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <label>Profession</label>
                  </div>
                  <div class="col-md-6">
                    <p><?php echo $sqlAuth['active']; ?></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>

    <?php mysqli_close($conn); ?>

    <script src="../static/bootstrap/jquery-3.5.1.slim.min.js"></script>
    <script src="../static/bootstrap/popper.min.js"></script>
    <script src="../static/bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
