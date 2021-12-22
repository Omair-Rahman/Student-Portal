<?php
  session_start();
  if (!isset($_SESSION['username']))
    header('location:../Registration/login.php');
  else
  {
    if ($_SESSION['auth'] == "Student")
      header('location:../dashboard/index.php');
  }
  $conn = mysqli_connect("localhost", "root", "", "student_portal");
  if (!$conn)
    die("Connection failed: " . mysqli_connect_error());
  $sql = mysqli_query($conn, "SELECT * FROM students");
?>

<!doctype html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../static/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../static/css/style.css">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/album-rtl/">
    <link href="../assets/dist/css/bootstrap.rtl.min.css" rel="stylesheet">

    <title>Form | Student Data</title>
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
  </head>
  <body>

    <?php include '../nav.php'; ?>

    <section class="py-5 text-center container">
      <div class="row py-lg-5">
        <div class="col-lg-6 col-md-8 mx-auto">
          <h1 class="fw-light">STUDENT CAREER</h1>
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
        </div>
      </div>
    </section>

    <div class="container marketing">
      <div class="row">
      <?php
        if (mysqli_num_rows($sql) > 0)
        {
          while($row = mysqli_fetch_assoc($sql))
          {
            $sqlImg = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM profile_pic WHERE UserName = '$row[UserName]'"));
      ?>
        <div class="col-lg-4">
          <img class="bd-placeholder-img rounded-circle" src="<?php echo $sqlImg['Image']; ?>" alt="" width="140" height="140">
          <h2><?php echo $row["UserName"]; ?></h2>
          <p><?php echo $row["University"]; ?></p>
          <form class="" action="student-profile-official.php" method="post">
            <input type="hidden" name="stdName" value="<?php echo $row["UserName"]; ?>">
            <p><button class="btn btn-secondary btn-sm">PROFILE</button>
            <?php if ($_SESSION['auth'] == "Teacher") { ?>
              <button class="btn btn-secondary btn-sm" name="update">UPDATE</button></p>
            <?php } ?>
          </form>
        </div>
      <?php } ?>
      </div>
      <?php } else { ?>
        <div class="alert alert-danger" role="alert">NO RESULT FOUND</div>
      <?php
        }
        mysqli_close($conn);
      ?>
    </div>

    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>

  </body>
</html>
