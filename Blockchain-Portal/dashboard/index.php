<?php
  session_start();
  if (!isset($_SESSION['username']))
    header('location:../Registration/login.php');
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="../static/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="../static/css/style.css">

		<title>Student Portal</title>
	</head>
	<body>
		<?php include '../nav.php'; ?>

		<div class="container ">
				<div class="welcome mrb-5">
          <marquee width="90%" direction="left" height="70px"><h1 class="mt-3 mb-2">Welcome to Blockchain System</h1></marquee>
				</div>

				<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
					<div class="carousel-inner">
						<div class="carousel-item active">
							<img src="../Media/img2.jpg" class="d-block w-100" alt="..." style="height: 400px;">
						</div>
						<div class="carousel-item">
							<img src="../Media/img1.jpg" class="d-block w-100" alt="..." style="height: 400px;">
						</div>
						<div class="carousel-item">
							<img src="../Media/img0.jpg" class="d-block w-100" alt="..." style="height: 400px;">
						</div>
					</div>
					<a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
						<span class="carousel-control-prev-icon" aria-hidden="true"></span>
						<span class="sr-only">Previous</span>
					</a>
					<a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
						<span class="carousel-control-next-icon" aria-hidden="true"></span>
						<span class="sr-only">Next</span>
					</a>
				</div>

				<h2 class="welcome mrt-5 mb-4">Hi <?php echo $_SESSION['auth'] . ', <strong>' . $_SESSION['username'] . '</strong>' ?>!!!</h2>
			</div>

		<script src="../static/bootstrap/jquery-3.5.1.slim.min.js"></script>
    <script src="../static/bootstrap/popper.min.js"></script>
    <script src="../static/bootstrap/js/bootstrap.min.js"></script>
	</body>
</html>
