$(document).ready(function() {
    $(function() {
        var tablica = $('<table id="tablica">');
        tablica.append('<thead><tr><th>Ime</th><th>Prezime</th><th>E-mail</th><th>Aktivacija/Deaktivacija</th><th>Promjena</th></thead>');

        $.get('http://arka.foi.hr/WebDiP/2013_projekti/WebDiP2013_023/data/korisnicka_imena.xml', function(xml) {
            var tbody = $("<tbody>");
            $(xml).find('korisnik').each(function() {

                $id_korisnik = $(this).find('id_korisnik').text();
                $ime = $(this).find('ime').text();
                $prezime = $(this).find('prezime').text();
                $email = $(this).find('email').text();
                $aktivirano = $(this).find('aktiviran').text();

                if ($aktivirano == 0) {
                    var red = "<tr>";
                    red += "<td>" + $ime + "</td>";
                    red += "<td>" + $prezime + "</td>";
                    red += "<td>" + $email + "</td>";
                    red += "<td><a href=\"aktiviraj_obrisi.php?idKorisnika=" + $id_korisnik + "\">Aktiviraj/Deaktiviraj</a></td>"
                    red += "<td><a href=\"promijeni.php?idKorisnika=" + $id_korisnik + "\">Promijeni</a></td>";
                    red += "</tr>";
                    tbody.append(red);
                }

            });
            tbody.append("</tbody>");
            tablica.append(tbody);
            tablica.append("</table>");

            $("#generiranje").html(tablica);
            $("#tablica").dataTable({
                "bSort": true,
                "bPaginate": true,
                "bFilter": true
            });
        });





    });
        $(function() {
        var tablica = $('<table id="tablica2">');
        tablica.append('<thead><tr><th>Ime</th><th>Prezime</th><th>E-mail</th><th>Aktivacija/Deaktivacija</th><th>Promjena</th></thead>');

        $.get('http://arka.foi.hr/WebDiP/2013_projekti/WebDiP2013_023/data/korisnicka_imena.xml', function(xml) {
            var tbody = $("<tbody>");
            $(xml).find('korisnik').each(function() {

                $id_korisnik = $(this).find('id_korisnik').text();
                $ime = $(this).find('ime').text();
                $prezime = $(this).find('prezime').text();
                $email = $(this).find('email').text();
                $aktivirano = $(this).find('aktiviran').text();

                if ($aktivirano == 1) {
                    var red = "<tr>";
                    red += "<td>" + $ime + "</td>";
                    red += "<td>" + $prezime + "</td>";
                    red += "<td>" + $email + "</td>";
                    red += "<td><a href=\"aktiviraj_obrisi.php?idKorisnika=" + $id_korisnik + "\">Aktiviraj/Deaktiviraj</a></td>"
                    red += "<td><a href=\"promijeni.php?idKorisnika=" + $id_korisnik + "\">Promijeni</a></td>";
                    red += "</tr>";
                    tbody.append(red);
                }

            });
            tbody.append("</tbody>");
            tablica.append(tbody);
            tablica.append("</table>");

            $("#generiranje2").html(tablica);
            $("#tablica2").dataTable({
                "bSort": true,
                "bPaginate": true,
                "bFilter": true
            });
        });





    });
});



