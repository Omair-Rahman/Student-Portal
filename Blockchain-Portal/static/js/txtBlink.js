var blink = document.getElementById('name');
blink.style.opacity = 0;
setInterval(setBlink, 1000);
function setBlink()
{
  if (blink.style.opacity == 0)
    blink.style.opacity = 1;
  else
    blink.style.opacity = 0;
}
