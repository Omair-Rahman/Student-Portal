<?php
	session_start();
	if (!isset($_SESSION['username']))
    header('location:../Registration/login.php');

	$conn = mysqli_connect("localhost", "root", "", "student_portal");
	if (!$conn)
		die("Connection failed: " . mysqli_connect_error());

  $sql = "INSERT INTO jobdata (CompanyName , jobTitle, jobDetail)
		    VALUES ('$_SESSION[username]', '$_POST[title]', '$_POST[details]')";
	if (mysqli_query($conn, $sql))
	{
		$_SESSION['Pass'] = "REGISTRATION SUCCESSFUL";
		header('location:job-form.php');
	}
	else
	{
		$_SESSION['PassErr'] = "REGISTRATION FAILED";
		header('location:job-form.php');
	}
  mysqli_close($conn);
?>
