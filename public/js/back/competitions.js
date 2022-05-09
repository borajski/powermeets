function getGroups(disciplina)
{
    var ispis;
    var body = "";
    var url="groupes/" + disciplina;
    const xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        var odgovori = JSON.parse(this.responseText);
      ispis = '<h4 class="bg-primary text-light text-center p-2 mt-3 mb-3">' + odgovori.ispis + '</h4>';

       for (var j in odgovori.grupe) {
        body += '<p class="bg-info text-light text-center p-1 mt-3 mb-3"><a href="/competition/'+odgovori.natjecanje+','+odgovori.grupe[j]+','+odgovori.ispis+'">Grupa:&nbsp;'+ odgovori.grupe[j] + '</a></p>';
    }
       document.getElementById("lista").innerHTML = ispis + body; 
               
    }
};
    xhttp.open("GET", url, true);
    xhttp.send();  
}
// ispis tekuće serije
function nextSerie()
{
    var ispis;
    var putanja = window.location.pathname.split('/');
    var body = "";
    document.getElementById("ispis").innerHTML = "";
    var url = "nextSerie/"+ putanja[2];
   const xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        var odgovori = JSON.parse(this.responseText);
      ispis = '<h4 class="bg-primary text-light text-center p-2 mt-3 mb-3">' + odgovori.ispis + '</h4>';

 /*    for (var j in odgovori.grupe) {
        body += '<p class="bg-info text-light text-center p-1 mt-3 mb-3"><a href="/competition/'+odgovori.natjecanje+'/'+odgovori.grupe[j]+'/'+odgovori.ispis+'">Grupa:&nbsp;'+ odgovori.grupe[j] + '</a></p>';
    } */
       document.getElementById("ispis").innerHTML = ispis; 
      
       
               
    }
};
    xhttp.open("GET", url, true);
    xhttp.send();  
  
}
//upis nove tezine
function promjena(id,serija) {
  
    nova=id+serija;
    serija = "'"+serija+"'";
    document.getElementById(nova).innerHTML = '<input type="text" size="5" maxlength="5" onchange="weightUpdate('+id+','+serija+',this.value)">';
  }
function weightUpdate(id,serija,tezina)
{
    var id_element = id + serija; 
    var podaci = id + ',' + serija + ',' + tezina; 
    var url = "inputWeight/"+ podaci;
   const xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        var odgovori = JSON.parse(this.responseText);
        document.getElementById(id_element).innerHTML = odgovori.rezultat;       
    }
};
    xhttp.open("GET", url, true);
    xhttp.send(); 
    location.reload(true);
}
//upis lifta
function onStage(natjecatelj,tezina,serija)
{
  var platforma,novalue,goodvalue;
  //serija = "'"+serija+"'";
  platforma = '<h3 class="text-center"><strong>'+natjecatelj.name+' '+natjecatelj.surname+'</strong></h3>';
  platforma = platforma + '<h1 class="text-center"><strong>'+tezina+'kg</strong></h3>';
  goodvalue = "yes-"+natjecatelj.id+"-"+tezina+"-"+serija;
  novalue = "no-"+natjecatelj.id+"-"+tezina+"-"+serija;
  document.getElementById("stage").innerHTML = platforma; 
  document.getElementById("goodLift").value = goodvalue; 
  document.getElementById("noLift").value = novalue; 
}
function liftResult(unos)
{
    //var id_element = id + serija; 
   // var podaci = id + ',' + serija + ',' + tezina; 
 
    var url = "inputLift/"+ unos;
   const xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
       // var odgovori = JSON.parse(this.responseText);
      //  document.getElementById(id_element).innerHTML = odgovori.rezultat;  
      location.reload(true);     
    }
};
    xhttp.open("GET", url, true);
    xhttp.send(); 
    
}