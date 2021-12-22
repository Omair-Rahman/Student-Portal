<?php
  session_start();
  if (!isset($_SESSION['username']))
    header('location:../Registration/login.php');

  if ($_SESSION['auth'] != "Student")
    header('location:../dashboard/index.php');

  $conn = mysqli_connect("localhost", "root", "", "student_portal");
  if (!$conn)
    die("Connection failed: " . mysqli_connect_error());

  $fileExt = explode('.', $_FILES['image']['name']);
  $image = strtolower(end($fileExt));
  $file = array('jpg', 'jpeg', 'png', 'pdf');

  if (in_array($image, $file))
  {
    $imgFile = uniqid('', true) . '.' . $image;
    $upload_to = 'profile-pic/' . $imgFile;
    move_uploaded_file($_FILES['image']['tmp_name'], $upload_to);
  }

  $pdfFileExt = explode('.', $_FILES['resume']['name']);
  $pdf = strtolower(end($pdfFileExt));
  $pdfFile = array('pdf');

  if (in_array($pdf, $pdfFile))
  {
    $pdfImgFile = uniqid('', true) . '.' . $pdf;
    $upload_to_pdf = 'resume/' . $pdfImgFile;
    move_uploaded_file($_FILES['resume']['tmp_name'], $upload_to_pdf);
  }




  $sqlPdf = "INSERT INTO studentcv (StudentName, StdCV) VALUES ('$_SESSION[username]', '$upload_to_pdf')";
  $sqlImg = "INSERT INTO profile_pic (UserName, image) VALUES ('$_SESSION[username]', '$upload_to')";
  $sql = "UPDATE students SET Address = '$_POST[address]', Phone = '$_POST[phone]',
                              linkedin_profile = '$_POST[linkedin]',github_profile = '$_POST[github]', skils = '$_POST[skill]'
                              WHERE UserName = '$_SESSION[username]'";

  if ((mysqli_query($conn, $sql)) && (mysqli_query($conn, $sqlImg)) && (mysqli_query($conn, $sqlPdf)))
	{
		$_SESSION['Pass'] = "UPDATED SUCCESSFULLY";
		header('location:std_profile.php');
	}
	else
	{
		$_SESSION['PassErr'] = "PROCESS FAILED";
		header('location:std_profile.php');
	}
  mysqli_close($conn);
?>
