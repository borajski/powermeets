function weightCat(spol, fed) {
    var wcat = spol + ',' + fed;
    document.getElementById("kategorija").innerHTML = "";
    document.getElementById("unos_kategorije").style.display = "block";
    const xhttp = new XMLHttpRequest();
    var url = "weightCat/" + wcat;
    xhttp.onload = function() {
        document.getElementById("kategorija").innerHTML = this.responseText;
    }
    xhttp.open("GET", url, true);
    xhttp.send();
}
//Groups printing
function getGroups(disciplina)
{
    var ispis;
    var im = 0;
    var url="groupesList/" + disciplina;
    const xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        var odgovori = JSON.parse(this.responseText);
      ispis = '<h4 class="mb-3"><strong>Flight groups: ' + odgovori.ispis + '</strong></h4>';
     
      if ( odgovori.grupe != "Athletes are not groupped!")
      {
        var tablica ='<table class="table table-hover bg-light shadow"><thead class="thead"><tr><th>R.br.</th><th>Ime i prezime</th><th>Dob</th><th>Kategorija</th><th>Spol</th></tr></thead><tbody>';
        var body = "";
       for (var j in odgovori.grupe) {
        body += '<tr><td class="text-center text-light bg-dark" colspan="5">Grupa:&nbsp;'+ odgovori.grupe[j] + '</td></tr>';
        im = 0; 
        for (var key in odgovori.natjecatelji) {
            if (odgovori.natjecatelji[key].flight == odgovori.grupe[j])
            {
            im++;
            body  += '<tr>' + 
            '<td>' + im + '</td>' +
            '<td>' + odgovori.natjecatelji[key].name+' '+odgovori.natjecatelji[key].surname+'</td>'+
            '<td>' + odgovori.natjecatelji[key].kategorijag + '</td>'+
            '<td>' + odgovori.natjecatelji[key].kategorijat + '</td>'+
            '<td>' + odgovori.natjecatelji[key].spol + '</td></tr>'; 
            }  
            }  
    }

    tablica = tablica + body + '</tbody></table>'; 
} 
else
{
    tablica = '<h4 class="mb-3"><strong>' + odgovori.grupe + '</strong></h4>';
}   

     document.getElementById("grupe").innerHTML = ispis + tablica; 
               
    }
};
    xhttp.open("GET", url, true);
    xhttp.send();  
}