function txtfield(x)
{
  if (x==1)
  {
    document.getElementById('uni-field').style.visibility = "visible";
    document.getElementById('com-field').style.visibility = "hidden";
  }
  else if (x==2)
  {
    document.getElementById('com-field').style.visibility = "visible";
    document.getElementById('uni-field').style.visibility = "hidden";
  }
  else
  {
    document.getElementById('com-field').style.visibility = "hidden";
    document.getElementById('uni-field').style.visibility = "hidden";
  }
  return;
}
