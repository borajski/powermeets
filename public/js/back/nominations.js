/* skripta za ispis listi nominacija za pojedinu disciplinu - JSON metoda*/
function getNominations(disciplina)
{
    var ispis;
    var spol;
    var tablica_m = "";
    var tablica_z = "";
    var poruka = "'Are you sure you want to Remove?'";
    var url="nomList/" + disciplina;
    const xhttp = new XMLHttpRequest();
  
    xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        var odgovori = JSON.parse(this.responseText);
        var tablica ='<table class="table table-hover bg-light shadow"><thead class="thead"><tr><th>R.br.</th><th>Ime i prezime</th><th>Klub</th><th>Dob</th><th>Država</th><th>Brisanje</th></tr></thead><tbody hx-confirm="Are you sure?" hx-target="closest tr" hx-swap="outerHTML swap:1s">';
      
      ispis = '<h3 class="mt-3 mb-3 text-center"><strong>' + odgovori.ispis.toUpperCase() + '</strong></h3>';
      if ( odgovori.nominacije_m != "")
      {
      var body = "";
        var i = 0;
      for (var j in odgovori.tezinske_m) {
        body += '<tr><td class="text-center text-light bg-dark" colspan="6">Kategorija:&nbsp;'+ odgovori.tezinske_m[j] + 'kg</td></tr>';
        for (var key in odgovori.nominacije_m) {
        if (odgovori.nominacije_m[key].kategorijat == odgovori.tezinske_m[j])
        {
        i++;
        body  += '<tr>' + 
        '<td>' + i + '</td>' +
        '<td>' + odgovori.nominacije_m[key].ime+' '+odgovori.nominacije_m[key].prezime+'</td>'+
        '<td>' + odgovori.nominacije_m[key].klub + '</td>'+
        '<td>' + odgovori.nominacije_m[key].kategorijag + '</td>'+
        '<td>' + odgovori.nominacije_m[key].drzava + '</td>'+
        '<td><a href="delete/'+odgovori.nominacije_m[key].id+'" onclick="return confirm('+poruka+');"><i class="fa-solid fa-trash-can fa-lg"></i></a></td></tr>'; 
        }  
        }  
    }
    spol = '<h4 class="mt-3 mb-3">Men</h4>';
    tablica_m = spol + tablica + body + '</tbody></table>'; 
}    
if ( odgovori.nominacije_f != "")
{  
   var body = "";
    var i = 0;
  for (var j in odgovori.tezinske_f) {
    body += '<tr><td class="text-center text-light bg-dark" colspan="6">Kategorija:&nbsp;'+ odgovori.tezinske_f[j] + 'kg</td></tr>';
    for (var key in odgovori.nominacije_f) {
    if (odgovori.nominacije_f[key].kategorijat == odgovori.tezinske_f[j])
    {
    i++;
    body  += '<tr>' + 
    '<td>' + i + '</td>' +
    '<td>' + odgovori.nominacije_f[key].ime+' '+odgovori.nominacije_f[key].prezime+'</td>'+
    '<td>' + odgovori.nominacije_f[key].klub + '</td>'+
    '<td>' + odgovori.nominacije_f[key].kategorijag + '</td>'+
    '<td>' + odgovori.nominacije_f[key].drzava + '</td>'+
    '<td><a href="delete/'+odgovori.nominacije_f[key].id+'" onclick="return confirm('+poruka+');"><i class="fa-solid fa-trash-can fa-lg"></i></a></td></tr>'; 
      
    }  
    }  
} 
    spol = '<h4 class="mt-3 mb-3">Women</h4>';
    tablica_z = spol + tablica + body + '</tbody></table>';
}   
        document.getElementById("lista").innerHTML = ispis + tablica_m + tablica_z;    
    }
};
    xhttp.open("GET", url, true);
    xhttp.send();  
}
