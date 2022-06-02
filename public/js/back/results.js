// rezultati po pojedinačnim kategorijama
function getResults(disciplina)
{
    var ispis,disciplina,prefix,spol;
    var tablica_m = "";
    var tablica_z = "";
    var kategorija_ispis = false;
    var url="resList/" + disciplina;
    const xhttp = new XMLHttpRequest();
  
    xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        var odgovori = JSON.parse(this.responseText);
        disciplina  = odgovori.ispis;     
        if (disciplina.includes("bench"))         
              prefix = "BP";
       
          if (disciplina.includes("deadlift"))
                 prefix = "DL";
       
      ispis = '<h3 class="mb-3"><strong>Results: ' + odgovori.ispis + '</strong></h3>';
      if ( odgovori.rezultati_m != "")
      {
        var tablica ='<table class="table table-hover bg-light shadow"><thead class="thead"><tr><th>#</th><th>Name and surname</th><th>BW</th><th>Age</th><th>'+prefix+'1</th><th>'+prefix+'2</th><th>'+prefix+'3</th><th>Total</th><th>Points</th></tr></thead><tbody>';
        var body = "";
        var i = 0;
        for (var k in odgovori.dobne_m) {
            body += '<tr><td class="text-center text-light bg-primary" colspan="9">'+ odgovori.dobne_m[k] + '</td></tr>';
      for (var j in odgovori.tezinske_m) {
         for (var key in odgovori.rezultati_m) {
        if ((odgovori.rezultati_m[key].kategorijat == odgovori.tezinske_m[j]) && (odgovori.rezultati_m[key].kategorijag == odgovori.dobne_m[k]))
        {
        i++;
        if (!kategorija_ispis)
         {
             body += '<tr><td class="text-center text-light bg-dark" colspan="9">Kategorija:&nbsp;'+ odgovori.tezinske_m[j] + 'kg</td></tr>';
             kategorija_ispis = true;
            }
        body  += '<tr>' + 
        '<td>' + i + '</td>' +
        '<td>' + odgovori.rezultati_m[key].name+' '+odgovori.rezultati_m[key].surname+'</td>'+
        '<td>' + odgovori.rezultati_m[key].weight + '</td>'+     
        '<td>' + odgovori.rezultati_m[key].age + '</td>';
        if (prefix == "BP")
        {      
        body += '<td class="'+lift(odgovori.rezultati_m[key].bench1)+'">' + round(odgovori.rezultati_m[key].bench1,1) + '</td>'+
        '<td class="'+lift(odgovori.rezultati_m[key].bench2)+'">' + round(odgovori.rezultati_m[key].bench2,1) + '</td>'+
        '<td class="'+lift(odgovori.rezultati_m[key].bench3)+'">' + round(odgovori.rezultati_m[key].bench3,1) + '</td>';
         }
         if (prefix == "DL")
         {      
         body +='<td class="'+lift(odgovori.rezultati_m[key].deadlift1)+'">' + round(odgovori.rezultati_m[key].deadlift1,1) + '</td>'+
         '<td class="'+lift(odgovori.rezultati_m[key].deadlift2)+'">' + round(odgovori.rezultati_m[key].deadlift2,1) + '</td>'+
         '<td class="'+lift(odgovori.rezultati_m[key].deadlift3)+'">' + round(odgovori.rezultati_m[key].deadlift3,1) + '</td>';
          }
  
          body +='<td>' + odgovori.rezultati_m[key].total + '</td>' + 
                   '<td>' + odgovori.rezultati_m[key].points + '</td></tr>'; 
        }  
        } 
        kategorija_ispis = false; 
    }
}

    spol = '<h4 class="mb-3">Men</h4>';
    tablica_m = spol + tablica + body + '</tbody></table>'; 
}    
if ( odgovori.rezultati_f != "")
{  
    var tablica ='<table class="table table-hover bg-light shadow"><thead class="thead"><tr><th>#</th><th>Name and surname</th><th>BW</th><th>Age</th><th>'+prefix+'1</th><th>'+prefix+'2</th><th>'+prefix+'3</th><th>Total</th><th>Points</th></tr></thead><tbody>';
    var body = "";
    var i = 0;
    for (var k in odgovori.dobne_f) {
        body += '<tr><td class="text-center text-light bg-primary" colspan="9">'+ odgovori.dobne_f[k] + '</td></tr>';
  for (var j in odgovori.tezinske_f) {
     for (var key in odgovori.rezultati_f) {
    if ((odgovori.rezultati_f[key].kategorijat == odgovori.tezinske_f[j]) && (odgovori.rezultati_f[key].kategorijag == odgovori.dobne_f[k]))
    {
    i++;
    if (!kategorija_ispis)
     {
         body += '<tr><td class="text-center text-light bg-dark" colspan="9">Kategorija:&nbsp;'+ odgovori.tezinske_f[j] + 'kg</td></tr>';
         kategorija_ispis = true;
        }
    body  += '<tr>' + 
    '<td>' + i + '</td>' +
    '<td>' + odgovori.rezultati_f[key].name+' '+odgovori.rezultati_f[key].surname+'</td>'+
    '<td>' + odgovori.rezultati_f[key].weight + '</td>'+
    '<td>' + odgovori.rezultati_f[key].age + '</td>';
    if (prefix == "BP")
    {      
    body += '<td class="'+lift(odgovori.rezultati_f[key].bench1)+'">' + round(odgovori.rezultati_f[key].bench1,1) + '</td>'+
    '<td class="'+lift(odgovori.rezultati_f[key].bench2)+'">' + round(odgovori.rezultati_f[key].bench2,1) + '</td>'+
    '<td class="'+lift(odgovori.rezultati_f[key].bench3)+'">' + round(odgovori.rezultati_f[key].bench3,1) + '</td>';
     }
     if (prefix == "DL")
     {      
     body +='<td class="'+lift(odgovori.rezultati_f[key].deadlift1)+'">' + round(odgovori.rezultati_f[key].deadlift1,1) + '</td>'+
     '<td class="'+lift(odgovori.rezultati_f[key].deadlift2)+'">' + round(odgovori.rezultati_f[key].deadlift2,1) + '</td>'+
     '<td class="'+lift(odgovori.rezultati_f[key].deadlift3)+'">' + round(odgovori.rezultati_f[key].deadlift3,1) + '</td>';
      }
      body +='<td>' + odgovori.rezultati_f[key].total + '</td>' + 
      '<td>' + odgovori.rezultati_f[key].points + '</td></tr>'; 
    }  
    } 
    kategorija_ispis = false; 
}
}
    spol = '<h4 class="mb-3">Women</h4>';
    tablica_z = spol + tablica + body + '</tbody></table>';
}   
        document.getElementById("lista").innerHTML = ispis + tablica_m + tablica_z;    
    }
};
    xhttp.open("GET", url, true);
    xhttp.send();  
}
//rezultati po relativnim kategorijama
function getRelResults(meet)
{
    var upit;
    var ispis,prefix;
    var spol       = document.getElementById("gender").value;
    var kategorija = document.getElementById("category").value;
    var disciplina = document.getElementById("disciplina").value;
    upit = meet + "," + disciplina + "," + kategorija + "," + spol;
    var url="relResList/" + upit;
    const xhttp = new XMLHttpRequest();
  
    xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        var odgovori = JSON.parse(this.responseText);
          
        if (disciplina.includes("bench"))         
              prefix = "BP";
       
          if (disciplina.includes("deadlift"))
                 prefix = "DL";
       
      ispis = '<h3 class="mb-3"><strong>Results by relative category: ' + disciplina + '-' + kategorija + '</strong></h3>';
      if ( odgovori.rezultati != "")
      {
        var tablica ='<table class="table table-hover bg-light shadow"><thead class="thead"><tr><th>#</th><th>Name and surname</th><th>BW</th><th>Age</th><th>'+prefix+'1</th><th>'+prefix+'2</th><th>'+prefix+'3</th><th>Total</th><th>Points</th><th>Age points</th></tr></thead><tbody>';
        var body = "";
        var i = 0;
        for (var key in odgovori.rezultati) {       
        i++;    
        body  += '<tr>' + 
        '<td>' + i + '</td>' +
        '<td>' + odgovori.rezultati[key].name+' '+odgovori.rezultati[key].surname+'</td>'+
        '<td>' + odgovori.rezultati[key].weight + '</td>'+     
        '<td>' + odgovori.rezultati[key].age + '</td>';
        if (prefix == "BP")
        {      
        body += '<td class="'+lift(odgovori.rezultati[key].bench1)+'">' + round(odgovori.rezultati[key].bench1,1) + '</td>'+
        '<td class="'+lift(odgovori.rezultati[key].bench2)+'">' + round(odgovori.rezultati[key].bench2,1) + '</td>'+
        '<td class="'+lift(odgovori.rezultati[key].bench3)+'">' + round(odgovori.rezultati[key].bench3,1) + '</td>';
         }
         if (prefix == "DL")
         {      
         body +='<td class="'+lift(odgovori.rezultati[key].deadlift1)+'">' + round(odgovori.rezultati[key].deadlift1,1) + '</td>'+
         '<td class="'+lift(odgovori.rezultati[key].deadlift2)+'">' + round(odgovori.rezultati[key].deadlift2,1) + '</td>'+
         '<td class="'+lift(odgovori.rezultati[key].deadlift3)+'">' + round(odgovori.rezultati[key].deadlift3,1) + '</td>';
          }
  
          body +='<td>' + odgovori.rezultati[key].total + '</td>' + 
                   '<td>' + odgovori.rezultati[key].points + '</td>' +
                   '<td>' + odgovori.rezultati[key].age_points + '</td></tr>'; 
         
        }      

    tablica = tablica + body + '</tbody></table>'; 
}    
else
{
    var tablica ='<table class="table table-hover bg-light shadow"><thead class="thead"><tr><th>#</th><th>Name and surname</th><th>BW</th><th>Age</th><th>'+prefix+'1</th><th>'+prefix+'2</th><th>'+prefix+'3</th><th>Total</th><th>Points</th><th>Age points</th></tr></thead><tbody></tbody></table>';
   
}
   
        document.getElementById("lista2").innerHTML = ispis + tablica;    
    }
};
    xhttp.open("GET", url, true);
    xhttp.send();  
}
function round(value, precision) {
    var multiplier = Math.pow(10, precision || 0);    
    multiplier =  Math.round(value * multiplier) / multiplier;
    multiplier = Math.abs(multiplier);
    return multiplier;
}
function lift (broj)
{
var decnumber;
if (Number.isInteger(broj)) 
    decnumber = 0;  
else
  decnumber = broj.toString().split('.')[1].length;

if (broj < 0)
 klasa = 'redcell';
 else
 {
 if (decnumber === 3) 
klasa =  'greencell';
   else
  klasa =  "" ; 
 }
 return klasa;
} 

