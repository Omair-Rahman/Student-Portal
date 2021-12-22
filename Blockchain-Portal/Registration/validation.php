<?php
	session_start();
	if (!isset($_SESSION['username']))
    header('location:../Registration/login.php');

	$conn = mysqli_connect("localhost", "root", "", "student_portal");
	if (!$conn)
		die("Connection failed: " . mysqli_connect_error());

	if ($_POST['username']=="")
		header('location:registration.php');
	else
	{
		$sql = "INSERT INTO users (UserName, Password, Email, Phone, Address, DOB, Gender)
			   VALUES ('$_POST[username]', '$_POST[password]', '$_POST[email]',
						'$_POST[phone]', '$_POST[address]', '$_POST[dob]',
						'$_POST[gender]')";
		$sql1 = "INSERT INTO auth (UserName, FullName, University, Company, active)
			   		VALUES ('$_POST[username]', '$_POST[fname]', '$_POST[university]', '$_POST[company]', '$_POST[auth]')";

		if ($_POST['auth']=="Student")
			$sql2 = "INSERT INTO students (UserName, University)
			   		VALUES ('$_POST[username]', '$_POST[university]')";
		else
			$sql2 = "SELECT * FROM students";

		$result = mysqli_query($conn,
												"SELECT * FROM users WHERE UserName = '$_POST[username]' OR Email = '$_POST[email]'"
													);

		if (mysqli_num_rows($result)==0)
		{
			if (mysqli_query($conn, $sql) && mysqli_query($conn, $sql1) && mysqli_query($conn, $sql2))
			{
				$_SESSION['Pass'] = "REGISTRATION SUCCESSFUL";
				header('location:registration.php');
			}
			else
			{
				$_SESSION['PassErr'] = "REGISTRATION FAILED";
				header('location:registration.php');
			}
		}
		else
		{
			$_SESSION['PassErr'] = "USER ALREADY EXIST";
			header('location:registration.php');
		}
	}
  mysqli_close($conn);
?>
