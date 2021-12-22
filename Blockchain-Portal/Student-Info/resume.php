<?php
  session_start();
  if (!isset($_SESSION['username']))
    header('location:../Registration/login.php');

  //if ($_SESSION['auth'] == "Student")
    //header('location:../dashboard/index.php');

  $conn = mysqli_connect("localhost", "root", "", "student_portal");
  if (!$conn)
    die("Connection failed: " . mysqli_connect_error());
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="height=device-height, initial-scale=1">
    <title>
      <?php
        if ((isset($_POST['UniCV'])) || ((isset($_POST['StdCV'])) && ($_SESSION['auth'] != "Student")))
          echo $_POST['NAME'];
        else
          echo ($_SESSION['username']);
      ?> | RESUME
    </title>
  </head>
  <body>
    <?php
      if (isset($_POST['UniCV']))
      {
        $sql = mysqli_query($conn, "SELECT * FROM unidata WHERE StudentName = '$_POST[NAME]'");
        if (mysqli_num_rows($sql) != 0)
          $false = true;
        else
          $false = false;

        if ($false == true)
        {
          $sql = mysqli_fetch_assoc($sql);
    ?>
          <embed type="application/pdf" src="<?php echo $sql['studentResume'] ; ?>" width="100%" height="650">
    <?php
        }
      }
      elseif (isset($_POST['StdCV']))
      {
        if ($_SESSION['auth'] != "Student")
          $sql = mysqli_query($conn, "SELECT * FROM studentcv WHERE StudentName = '$_POST[NAME]'");
        else
          $sql = mysqli_query($conn, "SELECT * FROM studentcv WHERE StudentName = '$_SESSION[username]'");

        if (mysqli_num_rows($sql) != 0)
          $false = true;
        else
          $false = false;

        if ($false == true)
        {
          $sql = mysqli_fetch_assoc($sql);
    ?>
          <embed type="application/pdf" src="<?php echo $sql['StdCV'] ; ?>" width="100%" height="650">
    <?php
        }
      }
      else
        header('location:../Student-Info/student-profile-official.php');

      mysqli_close($conn);
    ?>
  </body>
</html>
