<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
			<a class="navbar-brand" href="../dashboard/index.php"><strong id="name">Welcome</strong></a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
      </button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item active">
						<a class="nav-link mr-lft-rt-20" href="../dashboard/index.php">HOME</a>
					</li>
          <?php if ($_SESSION['auth'] == "Student") { ?>
            <li class="nav-item">
              <a class="nav-link" href="../Student-Info/std_profile.php">VIEW PROFILE</a>
           </li>
           <li class="nav-item">
             <a class="nav-link" href="../Job-Info/job-details.php">JOBS</a>
          </li>
        <?php } if ($_SESSION['auth'] != "Student") { ?>
           <li class="nav-item dropdown">
             <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
              data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                ADMINISTRATOR
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="../Student-Info/student-data.php">ALL STUDENT</a>
              <a class="dropdown-item" href="../Job-Info/job-details.php">JOB CIRCULAR</a>
            </div>
          </li>
        <?php } ?>
					<!--<li class="nav-item">
						<a class="nav-link" href="#">Administrator</a>
					</li>-->
				</ul>
				<?php
					if ($_SESSION['auth'] == "Admin")
						echo '
						<a class="btn btn-outline-success my-2 my-sm-0 mr-sm-2" href="../Registration/registration.php">Register</a>
						';
					/*$index = 0;
          if (isset($_SESSION['cart']))
            $index = count($_SESSION['cart']);*/
				?>
				<!--<a class="btn btn-outline-success my-2 my-sm-0 mr-sm-2" href="#">
          Cart
          <span class="badge bg-light txt-b"><?php /*echo $index;*/ ?></span>
        </a>-->
				<a class="btn btn-outline-success my-2 my-sm-0" href="../Registration/logout.php">LOGOUT</a>
			</div>
		</nav>

    <script src="../static/js/txtBlink.js"></script>
  </body>
</html>
