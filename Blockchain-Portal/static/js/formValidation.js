function validateForm()
{
  var pass = document.forms["Form"]["password"].value;
  var passConfirm = document.forms["Form"]["re-password"].value;
  var upper = lower = special = number = 0;
  var passMessage = "";

  if (pass != passConfirm)
  {
    document.getElementById("rePassErr").innerHTML = ("Password not matched");
    return false;
  }
  else
  {
    for (var i=0; i<pass.length; i++)
    {
      if (pass[i] >= 'A' && pass[i] <= 'Z')
        upper++;
      else if (pass[i] >= 'a' && pass[i] <= 'z')
          lower++;
      else if (pass[i] >= '0' && pass[i] <= '9')
          number++;
      else
          special++;
    }
    if (upper == 0 || lower == 0 || number == 0 || special == 0)
    {
      passMessage = "Password Must Contain An Uppercase, A Lowercase, A Number, A Special Character";
      document.getElementById("rePassErr").innerHTML = passMessage;
      return false;
    }
  }
}
