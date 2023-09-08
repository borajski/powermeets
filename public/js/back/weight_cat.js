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