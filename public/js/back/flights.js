//Flight order management
function getFlights(disciplina)
{
    var ispis;
    var spol;
    var grupa;
    var tablica_m = "";
    var tablica_z = "";
    var kraj_forme = "";
    var iz = 0;
    var im = 0;
    var url="athletesList/" + disciplina;
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
    
     for (var br=0; br<odgovori.nominacije_m.length; ++br) {
        if (odgovori.nominacije_m[br]["kategorijat"] == odgovori.tezinske_m[j])
        {
        im++;
        if (odgovori.nominacije_m[br]["grupa"] == null)
        {
            grupa  = 'placeholder= "Unesi naziv grupe"';            
        }
        else
        {
            grupa = 'value = "' + odgovori.nominacije_m[br]["grupa"] + '"';
        }
        body  += '<tr>' + 
        '<td>' + im + '</td>' +
        '<td>' + odgovori.nominacije_m[br]["ime"]+' '+odgovori.nominacije_m[br]["prezime"]+'</td>'+
        '<td>' + odgovori.nominacije_m[br]["kategorijag"] + '</td>'+
        '<td><input type="text" class="form-control" name="grupa[]"' + grupa + 'required><input type="hidden" name="idbroj[]" value="' + odgovori.nominacije_m[br]["id"] + '"></td></tr>'; 
        }  
        } }
    spol = '<h3 class="mb-3">Muškarci</h3>';
    tablica_m = spol + tablica + body + '</tbody></table>'; 
}    
if ( odgovori.nominacije_f != "")
{  
   var tablica ='<table class="table table-hover bg-light shadow"><thead class="thead"><tr><th>R.br.</th><th>Ime i prezime</th><th>Dob</th><th>Grupa</th></tr></thead><tbody>';
    var body = "";    
  for (var j in odgovori.tezinske_f) {
    body += '<tr><td class="text-center text-light bg-dark" colspan="5">Kategorija:&nbsp;'+ odgovori.tezinske_f[j] + 'kg</td></tr>';
    for (var br=0; br<odgovori.nominacije_f.length; ++br) {
        if (odgovori.nominacije_f[br]["kategorijat"] == odgovori.tezinske_f[j])
        {
        iz++;
        if (odgovori.nominacije_f[br]["grupa"] == null)
        {
            grupa  = 'placeholder= "Unesi naziv grupe"';            
        }
        else
        {
            grupa = 'value = "' + odgovori.nominacije_f[br]["grupa"] + '"';
        }
        body  += '<tr>' + 
        '<td>' + iz + '</td>' +
        '<td>' + odgovori.nominacije_f[br]["ime"]+' '+odgovori.nominacije_f[br]["prezime"]+'</td>'+
        '<td>' + odgovori.nominacije_f[br]["kategorijag"] + '</td>'+
        '<td><input type="text" class="form-control" name="grupa[]" ' + grupa + '"required><input type="hidden" name="idbroj[]" value="' + odgovori.nominacije_m[br]["id"] + '"></td></tr>'; 
        }  
        }  
} 
    spol = '<h3 class="mb-3">Žene</h3>';
    tablica_z = spol + tablica + body + '</tbody></table>';
    
}   
        zbroj = im + iz;
        kraj_forme = '<input type="hidden" name="athletes_number" value="' + zbroj +'"><div class="mt-4 text-end"><button type="submit" class="btn btn-primary">Create</button></div>';
        document.getElementById("lista").innerHTML = ispis + tablica_m + tablica_z + kraj_forme; 
               
    }
};
    xhttp.open("GET", url, true);
    xhttp.send();  
}
