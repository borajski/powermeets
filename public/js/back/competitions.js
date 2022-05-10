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
    tezina = tezina.replace(",",".");
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
  var platforma,novalue,goodvalue,rack;
  if (serija.includes("bench"))
    rack = natjecatelj.bp_rack;
  if (serija.includes("squat"))
    rack = natjecatelj.sq_rack;
  if (serija.includes("deadlift"))
    rack = "N/A";
  
  
  //serija = "'"+serija+"'";
  platforma = '<h3 class="text-center"><strong>'+natjecatelj.name+' '+natjecatelj.surname+'</strong></h3>';
  platforma = platforma + '<h1 class="text-center"><strong>'+tezina+'kg</strong></h3>';
  goodvalue = "yes-"+natjecatelj.id+"-"+tezina+"-"+serija;
  novalue = "no-"+natjecatelj.id+"-"+tezina+"-"+serija;
  document.getElementById("stage").innerHTML = platforma; 
  document.getElementById("goodLift").value = goodvalue; 
  document.getElementById("noLift").value = novalue; 
  document.getElementById("rack").innerHTML = "<h2 class='text-center'><strong>"+rack+"</strong></h2>";
  ploce(tezina,20,1);
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
// prikaz utega
function ploce (tezina,sipka,osiguraci)
{

   var textc = "";
   var textp = "";
    var textzu = "";
   var textze = "";
    var textcr = "";
   var textb = "";
    var textm1 = "";
   var textm2 = "";
   var textm3 = "";
    var textm4 = "";
    var i;
    
if (osiguraci == 1)
{sipka=sipka+5;
 tezina=(tezina-sipka)/2;}
if (osiguraci == 0) {tezina=(tezina-sipka)/2;}
while (tezina > 0) {
    crvene = ~~(tezina/25);
    tezina = tezina % 25;

    plave =  ~~(tezina/20);
    tezina = tezina % 20;

    zute =  ~~(tezina/15);
    tezina = tezina % 15;

     zelene =  ~~(tezina/10);
    tezina = tezina % 10;

    bijele =  ~~(tezina/5);
    tezina = tezina % 5;

    crne =  ~~(tezina/2.5);
    tezina = tezina % 2.5;

    male1 =  ~~(tezina/1.25);
    tezina = tezina % 1.25;

    male2 =  ~~(tezina/1);
    tezina = tezina % 1;

    male3 =  ~~(tezina/0.5);
    tezina = tezina % 0.5;

    male4 =  ~~(tezina/0.25);
    tezina = tezina % 0.25;

}



for (i = 0; i < crvene; i++) {
        textc += '<img src="/images/plates/crvena.jpg"  height="150" width="25" align="middle">';
}
text=textc;
if (crvene > 0) {
document.getElementById("crvene").innerHTML = "25kg - "+crvene+"x"; }
else {document.getElementById("crvene").innerHTML ="";}


for (i = 0; i < plave; i++) {
        textp += '<img src="/images/plates/plava.jpg"  height="150" width="25" align="middle">';
  }
text=text+textp;
 if (plave > 0) {document.getElementById("plave").innerHTML = "20kg - "+plave+"x";}
 else {document.getElementById("plave").innerHTML ="";}


for (i = 0; i < zute; i++) {
        textzu += '<img src="/images/plates/zuta.jpg"  height="125" width="20" align="middle">';
}
 text=text+textzu;
 if (zute > 0) { document.getElementById("zute").innerHTML = "15kg - "+zute+"x"; }
   else {document.getElementById("zute").innerHTML ="";}

 for (i = 0; i < zelene; i++) {
        textze += '<img src="/images/plates/zelena.jpg"  height="100" width="15" align="middle">';
}
text=text+textze;
if (zelene > 0) {document.getElementById("zelene").innerHTML = "10kg - "+zelene+"x";}
   else {document.getElementById("zelene").innerHTML ="";}

for (i = 0; i < bijele; i++) {
        textb += '<img src="/images/plates/bijela.jpg"  height="80" width="12" align="middle">';
}
 text=text+textb;
 if (bijele > 0) {document.getElementById("bijele").innerHTML = "5kg - "+bijele+"x";}
       else {document.getElementById("bijele").innerHTML ="";}

 for (i = 0; i < crne; i++) {
        textcr += '<img src="/images/plates/crna.jpg"  height="70" width="10" align="middle">';
}
  if (crne > 0) { document.getElementById("crne").innerHTML = "2.5kg - "+crne+"x";}
   else {document.getElementById("crne").innerHTML ="";}
  text=text+textcr;

  for (i = 0; i < male1; i++) {
        textm1 += '<img src="/images/plates/mala1.jpg"  height="60" width="8" align="middle">';
}
       if (male1 > 0) {  document.getElementById("male1").innerHTML = "1.25kg - "+male1+"x";}
         else {document.getElementById("male1").innerHTML ="";}
   text=text+textm1;

  for (i = 0; i < male2; i++) {
        textm2 += '<img src="/images/plates/mala2.jpg"  height="50" width="7" align="middle">';
}
   text=text+textm2;
     if (male2 > 0) {  document.getElementById("male2").innerHTML = "1kg - "+male2+"x";}
         else {document.getElementById("male2").innerHTML ="";}

  for (i = 0; i < male3; i++) {
        textm3 += '<img src="/images/plates/mala3.jpg"  height="45" width="6" align="middle">';
}
   text=text+textm3;
   if (male3 > 0) {  document.getElementById("male3").innerHTML = "0.5kg - "+male3+"x";}
         else {document.getElementById("male3").innerHTML ="";}
     for (i = 0; i < male4; i++) {
        textm4 += '<img src="/images/plates/mala4.jpg"  height="45" width="6" align="middle">';
}
   text=text+textm4;
     if (male4 > 0) {  document.getElementById("male4").innerHTML = "0.25kg - "+male4+"x";}
         else {document.getElementById("male4").innerHTML ="";}
 document.getElementById("boje").innerHTML = text;
 return;
   }