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
    ispis = disciplina.split(",").pop();
    const xhttp = new XMLHttpRequest();
    var url="nomList/" + disciplina;
    xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        var odgovori = JSON.parse(this.responseText);
       var tablica ='<table class="table table-hover bg-light shadow"><thead class="thead"><tr><th>R.br.</th><th>Ime i prezime</th><th>Klub</th><th>Dob</th><th>Država</th></tr></thead><tbody>';
      var body = "";
      var i = 0;
      for (var j in odgovori.tezinske) {
        body += '<tr><td class="text-center text-light bg-dark" colspan="5">Kategorija:&nbsp;'+ odgovori.tezinske[j] + 'kg</td></tr>';
        for (var key in odgovori.nominacije) {
        if (odgovori.nominacije[key].kategorijat == odgovori.tezinske[j])
        {
        i++;
        body  += '<tr>' + 
        '<td>' + i + '</td>' +
        '<td>' + odgovori.nominacije[key].ime+' '+odgovori.nominacije[key].prezime+'</td>'+
        '<td>' + odgovori.nominacije[key].klub + '</td>'+
        '<td>' + odgovori.nominacije[key].kategorijag + '</td>'+
        '<td>' + odgovori.nominacije[key].drzava + '</td></tr>'; 
        }  
        }  
    }
        document.getElementById("lista").innerHTML = 'Lista prijavljenih za:'+ispis + tablica + body + '</tbody></table>';    
    }
};
    xhttp.open("GET", url, true);
    xhttp.send();  
}
