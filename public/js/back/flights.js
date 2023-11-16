//Flight order management
function getFlights(disciplina) {
    var ispis;
    var spol;
    var grupa;
    var tablica_m = "";
    var tablica_z = "";
    var kraj_forme = "";
    var iz = 0;
    var im = 0;
    var url = "athletesList/" + disciplina;
    document.getElementById("flights").style.display = "hide";
    document.getElementById("racks").style.display = "hide";
    document.getElementById("weighing").style.display = "hide";
    const xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var odgovori = JSON.parse(this.responseText);
            ispis =
                '<h2 class="mb-3">Lista prijavljenih za: ' +
                odgovori.ispis +
                "</h2>";
            disciplina = odgovori.ispis;
            if (odgovori.natjecatelji_m != "") {
                var tablica =
                    '<table class="table table-hover bg-light shadow"><thead class="thead"><tr><th>R.br.</th><th>Ime i prezime</th><th>Dob</th><th>Grupa</th></tr></thead><tbody>';
                var body = "";
                for (var j in odgovori.tezinske_m) {
                    body +=
                        '<tr><td class="text-center text-light bg-dark" colspan="5">Kategorija:&nbsp;' +
                        odgovori.tezinske_m[j] +
                        "kg</td></tr>";
                    for (var key in odgovori.natjecatelji_m) {
                        if (
                            odgovori.natjecatelji_m[key].kategorijat ==
                            odgovori.tezinske_m[j]
                        ) {
                            im++;
                            if (odgovori.natjecatelji_m[key].flight == null) {
                                grupa = 'placeholder= "Unesi naziv grupe"';
                            } else {
                                grupa =
                                    'value = "' +
                                    odgovori.natjecatelji_m[key].flight +
                                    '"';
                            }
                            body +=
                                "<tr>" +
                                "<td>" +
                                im +
                                "</td>" +
                                "<td>" +
                                odgovori.natjecatelji_m[key].name +
                                " " +
                                odgovori.natjecatelji_m[key].surname +
                                "</td>" +
                                "<td>" +
                                odgovori.natjecatelji_m[key].kategorijag +
                                "</td>" +
                                "<td>" +
                                odgovori.natjecatelji_m[key].kategorijat +
                                "</td>" +
                                '<td><input type="text" class="form-control" name="grupa[]"' +
                                grupa +
                                'required><input type="hidden" name="idbroj[]" value="' +
                                odgovori.natjecatelji_m[key].id +
                                '"></td></tr>';
                        }
                    }
                }
                spol = '<h3 class="mb-3">Muškarci</h3>';
                tablica_m = spol + tablica + body + "</tbody></table>";
            }
            if (odgovori.natjecatelji_f != "") {
                var tablica =
                    '<table class="table table-hover bg-light shadow"><thead class="thead"><tr><th>R.br.</th><th>Ime i prezime</th><th>Dob</th><th>Grupa</th></tr></thead><tbody>';
                var body = "";
                for (var j in odgovori.tezinske_f) {
                    body +=
                        '<tr><td class="text-center text-light bg-dark" colspan="5">Kategorija:&nbsp;' +
                        odgovori.tezinske_f[j] +
                        "kg</td></tr>";
                    for (var key in odgovori.natjecatelji_f) {
                        if (
                            odgovori.natjecatelji_f[key].kategorijat ==
                            odgovori.tezinske_f[j]
                        ) {
                            iz++;
                            if (odgovori.natjecatelji_f[key].flight == null) {
                                grupa = 'placeholder= "Unesi naziv grupe"';
                            } else {
                                grupa =
                                    'value = "' +
                                    odgovori.natjecatelji_f[key].flight +
                                    '"';
                            }
                            body +=
                                "<tr>" +
                                "<td>" +
                                iz +
                                "</td>" +
                                "<td>" +
                                odgovori.natjecatelji_f[key].name +
                                " " +
                                odgovori.natjecatelji_f[key].surname +
                                "</td>" +
                                "<td>" +
                                odgovori.natjecatelji_f[key].kategorijag +
                                "</td>" +
                                "<td>" +
                                odgovori.natjecatelji_f[key].kategorijat +
                                "</td>" +
                                '<td><input type="text" class="form-control" name="grupa[]"' +
                                grupa +
                                'required><input type="hidden" name="idbroj[]" value="' +
                                odgovori.natjecatelji_f[key].id +
                                '"></td></tr>';
                        }
                    }
                }
                spol = '<h3 class="mb-3">Žene</h3>';
                tablica_z = spol + tablica + body + "</tbody></table>";
            }
            zbroj = im + iz;
            kraj_forme =
                '<input type="hidden" name="athletes_number" value="' +
                zbroj +
                '"><div class="mt-4 text-end"><button type="submit" class="btn btn-primary">Group</button></div>';
            document.getElementById("lista").innerHTML =
                ispis + tablica_m + tablica_z + kraj_forme;
        }
    };
    xhttp.open("GET", url, true);
    xhttp.send();
}
//Groups printing
function getGroups(disciplina) {
    var ispis;
    var im = 0;
    var liste;
    var url = "groupesList/" + disciplina;
    const xhttp = new XMLHttpRequest();
    document.getElementById("lista").innerHTML = "";
    document.getElementById("lista3").innerHTML = "";
    document.getElementById("lista4").innerHTML = "";
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var odgovori = JSON.parse(this.responseText);
            ispis =
                '<h3 class="mb-3">Ispis grupa za: ' + odgovori.ispis + "</h3>";

            if (odgovori.grupe != "Athletes are not groupped!") {
                var tablica =
                    '<table class="table table-hover bg-light shadow"><thead class="thead"><tr><th>R.br.</th><th>Ime i prezime</th><th>Dob</th><th>Kategorija</th><th>Spol</th></tr></thead><tbody>';
                var body = "";
                for (var j in odgovori.grupe) {
                    body +=
                        '<tr><td class="text-center text-light bg-dark" colspan="5">Grupa:&nbsp;' +
                        odgovori.grupe[j] +
                        "</td></tr>";
                    im = 0;
                    for (var key in odgovori.natjecatelji) {
                        if (
                            odgovori.natjecatelji[key].flight ==
                            odgovori.grupe[j]
                        ) {
                            im++;
                            body +=
                                "<tr>" +
                                "<td>" +
                                im +
                                "</td>" +
                                "<td>" +
                                odgovori.natjecatelji[key].name +
                                " " +
                                odgovori.natjecatelji[key].surname +
                                "</td>" +
                                "<td>" +
                                odgovori.natjecatelji[key].kategorijag +
                                "</td>" +
                                "<td>" +
                                odgovori.natjecatelji[key].kategorijat +
                                "</td>" +
                                "<td>" +
                                odgovori.natjecatelji[key].spol +
                                "</td></tr>";
                        }
                    }
                }

                tablica = tablica + body + "</tbody></table>";
            } else {
                tablica =
                    '<h4 class="mb-3"><strong>' +
                    odgovori.grupe +
                    "</strong></h4>";
            }

            liste =
                '<a href="/weighing_lists/' +
                disciplina +
                '" class="btn btn-primary gumb m-1 gumb float-end" role="button">Print weighing lists</a>';
            document.getElementById("lista2").innerHTML =
                ispis + tablica + liste;
        }
    };
    xhttp.open("GET", url, true);
    xhttp.send();
}
//Rack heights
function rackHeights(disciplina) {
    var ispis;
    var rack, rack1, rack2;
    var upit;
    var kraj_forme = "";
    var im = 0;
    var url = "rackHeights/" + disciplina;
    document.getElementById("lista2").innerHTML = "";
    document.getElementById("lista").innerHTML = "";
    document.getElementById("lista4").innerHTML = "";
    const xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var odgovori = JSON.parse(this.responseText);
            ispis =
                '<h2 class="mb-3">Rack heights: ' + odgovori.ispis + "</h2>";
            disciplina = odgovori.ispis;
            upit = disciplina.split(" ");
            if (odgovori.natjecatelji != "") {
                var tablica;
                var body = "";
                for (var key in odgovori.natjecatelji) {
                    if (odgovori.natjecatelji[key].weight != null)
                    {
                    if (upit[1] == "bench" || upit[1] == "push&pull") {
                        tablica =
                            '<table class="table table-hover bg-light shadow"><thead class="thead  text-light bg-dark"><tr><th>R.br.</th><th>Ime i prezime</th><th class="text-center">Bench rack height</th></tr></thead><tbody>';

                        if (odgovori.natjecatelji[key].bp_rack == null)
                            rack =
                                '<td class="text-center"><input type="text" class="form-control w-50 text-center" name="rackbp[]"><input type="hidden" name="idbroj[]" value="' +
                                odgovori.natjecatelji[key].id +
                                '"></td>';
                        else
                            rack =
                                '<td class="text-center"><b id="nova-' +
                                im +
                                '" ondblclick="promjena(this.id,' +
                                im +
                                ')">' +
                                odgovori.natjecatelji[key].bp_rack +
                                '</b><input type="hidden" id="nova-visina' +
                                im +
                                '" class="form-control w-50" name="rackbp[]" value="' +
                                odgovori.natjecatelji[key].bp_rack +
                                '"><input type="hidden" name="idbroj[]" value="' +
                                odgovori.natjecatelji[key].id +
                                '"></td>';
                    } else {
                        tablica =
                            '<table class="table table-hover bg-light shadow"><thead class="thead  text-light bg-dark"><tr><th>R.br.</th><th>Ime i prezime</th><th class="text-center">Squat rack height</th><th class="text-center">Bench rack height</th></tr></thead><tbody>';
                        if (odgovori.natjecatelji[key].sq_rack == null)
                            rack1 =
                                '<td class="text-center"><input type="text" class="form-control w-50 text-center" name="racksq[]"><input type="hidden" name="idbroj[]" value="' +
                                odgovori.natjecatelji[key].id +
                                '"></td>';
                        else
                            rack1 =
                                '<td class="text-center"><b id="nova-' +
                                im +
                                '" ondblclick="promjena(this.id,' +
                                im +
                                ')">' +
                                odgovori.natjecatelji[key].sq_rack +
                                '</b><input type="hidden" id="nova-visina' +
                                im +
                                '" class="form-control w-50" name="racksq[]" value="' +
                                odgovori.natjecatelji[key].sq_rack +
                                '"><input type="hidden" name="idbroj[]" value="' +
                                odgovori.natjecatelji[key].id +
                                '"></td>';

                        if (odgovori.natjecatelji[key].bp_rack == null)
                            rack2 =
                                '<td class="text-center"><input type="text" class="form-control w-50 text-center" name="rackbp[]"><input type="hidden" name="idbroj[]" value="' +
                                odgovori.natjecatelji[key].id +
                                '"></td>';
                        else
                            rack2 =
                                '<td class="text-center"><b id="nova2-' +
                                im +
                                '" ondblclick="promjena(this.id,' +
                                im +
                                ')">' +
                                odgovori.natjecatelji[key].bp_rack +
                                '</b><input type="hidden" id="nova2-visina' +
                                im +
                                '" class="form-control w-50" name="rackbp[]" value="' +
                                odgovori.natjecatelji[key].bp_rack +
                                '"><input type="hidden" name="idbroj[]" value="' +
                                odgovori.natjecatelji[key].id +
                                '"></td>';

                        rack = rack1 + rack2;
                    }
                    im++;
                    body +=
                        "<tr>" +
                        "<td>" +
                        im +
                        "</td>" +
                        "<td>" +
                        odgovori.natjecatelji[key].name +
                        " " +
                        odgovori.natjecatelji[key].surname +
                        "</td>" +
                        rack +
                        "</tr>";
                }
                }

                tablica = tablica + body + "</tbody></table>";
            }

            kraj_forme =
                '<input type="hidden" name="athletes_number" value="' +
                im +
                '"><input type="hidden" name="disciplina" value="' +
                disciplina +
                '"><div class="mt-4 text-end"><button type="submit" class="btn btn-primary">Set height</button></div>';
            document.getElementById("lista3").innerHTML =
                ispis + tablica + kraj_forme;
        }
    };
    xhttp.open("GET", url, true);
    xhttp.send();
}
//promjena vrijednosti na doubleclick
function promjena(adresa, id) {
    var prefix = adresa.split("-");
    var nova = prefix[0] + "-" + id;
    var visina = prefix[0] + "-visina" + id;
    document.getElementById(nova).innerHTML = "";
    document.getElementById(visina).type = "text";
}
//Weighing
function weighing(disciplina) {
    var ispis;
    var upit;
    var im = 0;
    var url = "weighing/" + disciplina;
    document.getElementById("lista2").innerHTML = "";
    document.getElementById("lista3").innerHTML = "";
    document.getElementById("lista").innerHTML = "";
    const xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var odgovori = JSON.parse(this.responseText);
            ispis = '<h2 class="mb-3">Vaganje: ' + odgovori.ispis + "</h2>";
            disciplina = odgovori.ispis;
            upit = disciplina.split(" ");
            if (odgovori.natjecatelji != "") {
                var tablica =
                    '<table class="table table-hover bg-light shadow"><thead class="thead  text-light bg-dark"><tr><th>R.br.</th><th>Ime i prezime</th></tr></thead><tbody>';
                var body = "";
                for (var key in odgovori.natjecatelji) {
                    im++;
                    if (odgovori.natjecatelji[key].weight != null) {
                        body +=
                            "<tr>" +
                            "<td>" +
                            im +
                            "</td>" +
                            "<td>" +
                            odgovori.natjecatelji[key].name +
                            " " +
                            odgovori.natjecatelji[key].surname +
                            "</td></tr>";
                    } else {
                        body +=
                            "<tr>" +
                            "<td>" +
                            im +
                            "</td>" +
                            '<td><a href="/athlete/' +
                            odgovori.natjecatelji[key].id +
                            '">' +
                            odgovori.natjecatelji[key].name +
                            " " +
                            odgovori.natjecatelji[key].surname +
                            "</a></td></tr>";
                    }
                }

                tablica = tablica + body + "</tbody></table>";
            }

            //kraj_forme = '<input type="hidden" name="athletes_number" value="' + im +'"><input type="hidden" name="disciplina" value="' + disciplina + '"><div class="mt-4 text-end"><button type="submit" class="btn btn-primary">Group</button></div>';
            document.getElementById("lista4").innerHTML = ispis + tablica;
        }
    };
    xhttp.open("GET", url, true);
    xhttp.send();
}
