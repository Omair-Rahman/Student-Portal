<?php
  session_start();
  if (!isset($_SESSION['username']))
    header('location:../Registration/login.php');

	$conn = mysqli_connect("localhost", "root", "", "student_portal");
	if (!$conn)
		die("Connection failed: " . mysqli_connect_error());

  if ($_POST['username']=="")
		header('location:login.php');
	else
	{
    $sql = "select UserName, Password from users where UserName = '$_POST[username]' and Password = '$_POST[password]'";
    $result = mysqli_query($conn, $sql);

  	if (mysqli_num_rows($result)==1)
    {
      $sqlAuth = mysqli_query($conn,"select active from auth where UserName = '$_POST[username]'");
      $row = mysqli_fetch_assoc($sqlAuth);

      $_SESSION['username'] = $_POST['username'];
      $_SESSION['auth'] = $row["active"];
      header('location:../dashboard/index.php');
    }
  	else
    {
      $_SESSION['PassErr'] = "<b>USERNAME</b> OR <b>PASSWORD</b> WRONG";
      header('location:login.php');
    }
  }
  mysqli_close($conn);
 ?>
