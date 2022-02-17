function editMeet() {
    document.getElementById('postavke').style.display = "none";
    document.getElementById('uredi').style.display = "block";
}
/* skripta za divizije federacije */
function getFed (fed) {   
    document.getElementById("discipline").innerHTML = ""; 
    const xhttp = new XMLHttpRequest();
    var url="fedRules/" + fed;
    xhttp.onload = function() {
    document.getElementById("discipline").innerHTML = this.responseText;
    }  
    xhttp.open("GET", url, true);
    xhttp.send();   
}
/* skripta za ispis listi nominacija za pojedinu disciplinu - JSON metoda*/
function getNominations(disciplina)
{
 
    alert(disciplina);
    document.getElementById("nominacije").innerHTML = ""; 
    const xhttp = new XMLHttpRequest();
    var url="nomList/" + disciplina;
    xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        var odgovori = JSON.parse(this.responseText);
       // myFunction(myArr);
      // odgovori.forEach(ispis); 
      for (var key in odgovori) {

        document.getElementById("nominacije").innerHTML = document.getElementById("nominacije").innerHTML + odgovori[key].ime+' '+odgovori[key].prezime+'<br>';
   
        }
       
    }
};
    xhttp.open("GET", url, true);
    xhttp.send();  
}
