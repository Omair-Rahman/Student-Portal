<?php
  session_start();
  if (!isset($_SESSION['username']))
    header('location:../Registration/login.php');

  if ($_SESSION['auth'] != "Teacher")
    header('location:../dashboard/index.php');

  $conn = mysqli_connect("localhost", "root", "", "student_portal");
  if (!$conn)
    die("Connection failed: " . mysqli_connect_error());

  $fileExt = explode('.', $_FILES['resume']['name']);
  $pdf = strtolower(end($fileExt));
  $file = array('pdf');

  if (in_array($pdf, $file))
  {
    $imgFile = uniqid('', true) . '.' . $pdf;
    $upload_to = 'resume/' . $imgFile;
    move_uploaded_file($_FILES['resume']['tmp_name'], $upload_to);
  }

  $sqlCheck = mysqli_query($conn, "SELECT * FROM unidata WHERE StudentName = '$_POST[NAME]'");

  if (mysqli_num_rows($sqlCheck) > 0)
    $sql = "UPDATE unidata SET studentResume = '$upload_to', cgpa = '$_POST[cgpa]', credit = '$_POST[credits]' WHERE StudentName = '$_POST[NAME]'";
  else
    $sql = "INSERT INTO unidata (StudentName, studentResume, cgpa, credit) VALUES ('$_POST[NAME]', '$upload_to', '$_POST[cgpa]', '$_POST[credits]')";


  if (mysqli_query($conn, $sql))
	{
		$_SESSION['Pass'] = "UPDATED SUCCESSFULLY";
		header('location:student-data.php');
	}
	else
	{
		$_SESSION['PassErr'] = "PROCESS FAILED";
		header('location:student-data.php');
	}
  mysqli_close($conn);
?>
