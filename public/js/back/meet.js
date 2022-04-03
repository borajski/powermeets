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
    var ispis;
    var spol;
    var tablica_m = "";
    var tablica_z = "";
    var url="nomList/" + disciplina;
    const xhttp = new XMLHttpRequest();
  
    xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        var odgovori = JSON.parse(this.responseText);
      ispis = '<h2 class="mb-3">Lista prijavljenih za: ' + odgovori.ispis + '</h2>';
      if ( odgovori.nominacije_m != "")
      {
        var tablica ='<table class="table table-hover bg-light shadow"><thead class="thead"><tr><th>R.br.</th><th>Ime i prezime</th><th>Klub</th><th>Dob</th><th>Država</th></tr></thead><tbody>';
        var body = "";
        var i = 0;
      for (var j in odgovori.tezinske_m) {
        body += '<tr><td class="text-center text-light bg-dark" colspan="5">Kategorija:&nbsp;'+ odgovori.tezinske_m[j] + 'kg</td></tr>';
        for (var key in odgovori.nominacije_m) {
        if (odgovori.nominacije_m[key].kategorijat == odgovori.tezinske_m[j])
        {
        i++;
        body  += '<tr>' + 
        '<td>' + i + '</td>' +
        '<td>' + odgovori.nominacije_m[key].ime+' '+odgovori.nominacije_m[key].prezime+'</td>'+
        '<td>' + odgovori.nominacije_m[key].klub + '</td>'+
        '<td>' + odgovori.nominacije_m[key].kategorijag + '</td>'+
        '<td>' + odgovori.nominacije_m[key].drzava + '</td></tr>'; 
        }  
        }  
    }
    spol = '<h3 class="mb-3">Muškarci</h3>';
    tablica_m = spol + tablica + body + '</tbody></table>'; 
}    
if ( odgovori.nominacije_f != "")
{  
   var tablica ='<table class="table table-hover bg-light shadow"><thead class="thead"><tr><th>R.br.</th><th>Ime i prezime</th><th>Klub</th><th>Dob</th><th>Država</th></tr></thead><tbody>';
    var body = "";
    var i = 0;
  for (var j in odgovori.tezinske_f) {
    body += '<tr><td class="text-center text-light bg-dark" colspan="5">Kategorija:&nbsp;'+ odgovori.tezinske_f[j] + 'kg</td></tr>';
    for (var key in odgovori.nominacije_f) {
    if (odgovori.nominacije_f[key].kategorijat == odgovori.tezinske_f[j])
    {
    i++;
    body  += '<tr>' + 
    '<td>' + i + '</td>' +
    '<td>' + odgovori.nominacije_f[key].ime+' '+odgovori.nominacije_f[key].prezime+'</td>'+
    '<td>' + odgovori.nominacije_f[key].klub + '</td>'+
    '<td>' + odgovori.nominacije_f[key].kategorijag + '</td>'+
    '<td>' + odgovori.nominacije_f[key].drzava + '</td></tr>'; 
    }  
    }  
} 
    spol = '<h3 class="mb-3">Žene</h3>';
    tablica_z = spol + tablica + body + '</tbody></table>';
}   
        document.getElementById("lista").innerHTML = ispis + tablica_m + tablica_z;    
    }
};
    xhttp.open("GET", url, true);
    xhttp.send();  
}
//Flight order management
function getFlights(disciplina)
{
    var ispis;
    var spol;
    var tablica_m = "";
    var tablica_z = "";
    var kraj_forme = "";
    var iz = 0;
    var im = 0;
    var url="nomList/" + disciplina;
    const xhttp = new XMLHttpRequest();
  
    xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        var odgovori = JSON.parse(this.responseText);
      ispis = '<h2 class="mb-3">Lista prijavljenih za: ' + odgovori.ispis + '</h2>';
      disciplina = odgovori.ispis;
      if ( odgovori.nominacije_m != "")
      {
        var tablica ='<table class="table table-hover bg-light shadow"><thead class="thead"><tr><th>R.br.</th><th>Ime i prezime</th><th>Dob</th><th>Grupa</th></tr></thead><tbody>';
        var body = "";
     for (var j in odgovori.tezinske_m) {
        body += '<tr><td class="text-center text-light bg-dark" colspan="5">Kategorija:&nbsp;'+ odgovori.tezinske_m[j] + 'kg</td></tr>';
        for (var key in odgovori.nominacije_m) {
        if (odgovori.nominacije_m[key].kategorijat == odgovori.tezinske_m[j])
        {
        im++;
        body  += '<tr>' + 
        '<td>' + im + '</td>' +
        '<td>' + odgovori.nominacije_m[key].ime+' '+odgovori.nominacije_m[key].prezime+'</td>'+
        '<td>' + odgovori.nominacije_m[key].kategorijag + '</td>'+
        '<td><input type="text" class="form-control" name="grupa[]" placeholder="Unesi naziv grupe" required><input type="hidden" name="idbroj[]" value="' + odgovori.nominacije_m[key].id + '"></td></tr>'; 
        }  
        }  
    }
    spol = '<h3 class="mb-3">Muškarci</h3>';
    tablica_m = spol + tablica + body + '</tbody></table>'; 
}    
if ( odgovori.nominacije_f != "")
{  
   var tablica ='<table class="table table-hover bg-light shadow"><thead class="thead"><tr><th>R.br.</th><th>Ime i prezime</th><th>Dob</th><th>Grupa</th></tr></thead><tbody>';
    var body = "";    
  for (var j in odgovori.tezinske_f) {
    body += '<tr><td class="text-center text-light bg-dark" colspan="5">Kategorija:&nbsp;'+ odgovori.tezinske_f[j] + 'kg</td></tr>';
    for (var key in odgovori.nominacije_f) {
    if (odgovori.nominacije_f[key].kategorijat == odgovori.tezinske_f[j])
    {
    iz++;
    body  += '<tr>' + 
    '<td>' + iz + '</td>' +
    '<td>' + odgovori.nominacije_f[key].ime+' '+odgovori.nominacije_f[key].prezime+'</td>'+
    '<td>' + odgovori.nominacije_f[key].kategorijag + '</td>'+
    '<td><input type="text" class="form-control" name="grupa[]" placeholder="Unesi naziv grupe" required><input type="hidden" name="idbroj[]" value="' + odgovori.nominacije_f[key].id + '"></td></tr>'; 
    }  
    }  
} 
    spol = '<h3 class="mb-3">Žene</h3>';
    tablica_z = spol + tablica + body + '</tbody></table>';
    
}   
        zbroj = im + iz;
        kraj_forme = '<input type="hidden" name="athletes_number" value="' + zbroj +'"><input type="hidden" name="disciplina" value="' + disciplina + '"> <div class="mt-4 text-end"><button type="submit" class="btn btn-primary">Create</button></div>';
        document.getElementById("lista").innerHTML = ispis + tablica_m + tablica_z + kraj_forme; 
               
    }
};
    xhttp.open("GET", url, true);
    xhttp.send();  
}
