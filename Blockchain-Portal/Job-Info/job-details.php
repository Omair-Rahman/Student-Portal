<?php
  session_start();
  if (!isset($_SESSION['username']))
    header('location:../Registration/login.php');

  $conn = mysqli_connect("localhost", "root", "", "student_portal");
  if (!$conn)
    die("Connection failed: " . mysqli_connect_error());
  $sql = mysqli_query($conn, "SELECT * FROM jobdata");
  $sqlUser = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM auth WHERE UserName = '$_SESSION[username]'"));
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>ALL JOB</title>
    <link rel="stylesheet" href="../static/css/style.css">


    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@400;800;900&display=swap">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
  </head>
  <body>
    <?php include '../nav.php'; ?>

    <section class="py-5 text-center container">
      <div class="row py-lg-5">
        <div class="col-lg-6 col-md-8 mx-auto">
          <h1 class="fw-light">JOB CIRCULAR</h1>
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

    <div class="container">
      <div class="row">
        <div class="col-lg-4 offset-lg-1 order-lg-2">
          <div class="d-flex justify-content-center">
            <div class="py-4">
              <div class="text-center mt-3">
                <h2 class="h1"><?php echo $sqlUser['FullName']; ?></h2>
                <h5>
                  <?php if (($_SESSION['auth'] == "Student") || ($_SESSION['auth'] == "Teacher")) { ?>
                    <p class="small text-muted"><?php echo $sqlUser['University']; ?></p>
                  <?php } else { ?>
                    <p class="small text-muted"><?php echo $sqlUser['Company']; ?></p>
                  <?php } ?>
                </h5>
              </div>
            </div>
          </div>
        </div>

        <div class="col-12 col-lg-7 order-lg-1">
          <div class="py-4">
            <?php if ($_SESSION['auth'] == "Company") { ?>
            <div class="input-group input-group-lg"><span class="input-group-text bg-light border-0" id="search-icon">
                <i data-feather="send"></i></span>
              <a class="profile-edit-btn form-control bg-light border-0" href="../Job-Info/job-form.php">Create Post</a>
            </div>
          <?php } ?>
          </div>
          <section class="py-4">
            <div class="mb-4 py-4">
              <?php
                if (mysqli_num_rows($sql) > 0)
                {
                  while($row = mysqli_fetch_assoc($sql))
                  {
                    $sqlPost = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM auth WHERE UserName = '$row[CompanyName]'"));
              ?>
              <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex flex-row align-items-center">
                  <div>
                    <h2 class="h3 mb-0"><b><?php echo $sqlPost['Company']; ?></b></h2>
                  </div>
                </div>
              </div>
              <div class="mt-3">
                <h4>Job Type:</h4>
                <h4 class="h4 ml-5"><b><i><?php echo $row['jobTitle']; ?></i></b></h4>
                <h4>Job Description:</h4>
                <p class="h5 mv text-muted mb-5 ml-5"><?php echo $row['jobDetail']; ?></p>
              </div>
              <?php } } else { ?>
                <div class="alert alert-danger" role="alert">NO RESULT FOUND</div>
              <?php } mysqli_close($conn); ?>
            </div>
          </section>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
  </body>
</html>
