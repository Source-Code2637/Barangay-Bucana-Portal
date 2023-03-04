window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    document.getElementById("navBox").style.top = "0px";
    document.getElementById("navBox").style.height = "80px";
	document.getElementById("navBox").style.boxShadow = "0px 3px 5px 0px rgba(0,0,0,0.4)";
	document.getElementById("navBox").style.backgroundColor = "#36A361";
	document.getElementById("menu").style.display = "none";
	document.getElementById("menu").style.top = "200px";
	document.getElementById("menuWhite").style.display = "flex";
	document.getElementById("Lblack").style.display = "none";
	document.getElementById("Lwhite").style.display = "flex";
	document.getElementById("menu-button-white").style.marginTop = "35px";
	document.getElementById("menu-button-white").style.display = "flex";
	document.getElementById("menu-button-black").style.display = "none";
  } else {
    document.getElementById("navBox").style.top = "50px";
	document.getElementById("navBox").style.boxShadow = "3px 3px 9px 0px rgba(0,0,0,0.4)";
	document.getElementById("navBox").style.height = "100px";
	document.getElementById("navBox").style.backgroundColor = "whitesmoke";
	document.getElementById("menu").style.display = "flex";
	document.getElementById("menu").style.top = "200px";
	document.getElementById("menuWhite").style.display = "none";
	document.getElementById("Lblack").style.display = "flex";
	document.getElementById("Lwhite").style.display = "none";
	document.getElementById("menu-button-white").style.display = "none";
	document.getElementById("menu-button-black").style.display = "flex";
  }
}
