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
        body += '<p class="bg-info text-light text-center p-1 mt-3 mb-3"><a href="/competition/'+odgovori.natjecanje+'/'+odgovori.grupe[j]+'/'+odgovori.ispis+'">Grupa:&nbsp;'+ odgovori.grupe[j] + '</a></p>';
    }
       document.getElementById("lista").innerHTML = ispis + body; 
               
    }
};
    xhttp.open("GET", url, true);
    xhttp.send();  
}