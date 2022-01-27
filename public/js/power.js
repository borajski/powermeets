function openNav() {
    document.getElementById("mySidebar").style.width = "250px";
    document.getElementById("main").style.marginLeft = "250px";
  }
  
  function closeNav() {
    document.getElementById("mySidebar").style.width = "0";
    document.getElementById("main").style.marginLeft= "0";
  }
  function expandNav() {
    var element1 = document.getElementById("main");
    var element2 = document.getElementById("mySidebar");
    var otvori = document.getElementById("expandOn");
    var zatvori = document.getElementById("expandOff");
  if (otvori.style.display === "none") {
    otvori.style.display = "block";
    zatvori.style.display = "none";
  } else {
    otvori.style.display = "none";
    zatvori.style.display = "block";
  }
    element1.classList.toggle("expand1");
    element2.classList.toggle("expand2");
  }