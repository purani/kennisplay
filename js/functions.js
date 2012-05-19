function over(x,z)
{
 y=document.getElementById(x).style;
 y.width="96%";
 y.height="96%";
 y.margin="2%";
 y=document.getElementById(z);
 y.innerHTML="<marquee>"+z+"</marquee>";
}
function out(x,z)
{
 y=document.getElementById(x).style;
 y.width="90%";
 y.height="90%";
 y.margin="5%";
 y=document.getElementById(z);
 y.innerHTML=z;
}