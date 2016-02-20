$(document).ready(function() {
    $(function() {
        var tablica = $('<table id="tablica">');
        tablica.append('<thead><tr><th>Korisnicko ime</th><th>Vrijeme prijave</th><th>Prijava uspješna</th</tr></thead>');

        $.get('http://arka.foi.hr/WebDiP/2013_projekti/WebDiP2013_023/data/prijave.xml', function(xml) {
            var tbody = $("<tbody>");
            $(xml).find('prijava').each(function() {

                $korisnicko_ime = $(this).find('korisnicko_ime').text();
                $vrijeme = $(this).find('vrijeme').text();
                $prijava_uspjesna = $(this).find('prijava_uspjesna').text();


                var red = "<tr>";
                red += "<td>" + $korisnicko_ime + "</td>";
                red += "<td>" + $vrijeme + "</td>";

                if ($prijava_uspjesna == 1) {
                    $prijava_uspjesna = "Uspješna"
                }
                else {
                    $prijava_uspjesna = "Neuspješna"
                }
                red += "<td>" + $prijava_uspjesna + "</td>";
                red += "</tr>";
                tbody.append(red);

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

    $("#prikaziuspjeh").click(function() {
        var tablica = $('<table id="tablica">');
        tablica.append('<thead><tr><th>Korisnicko ime</th><th>Vrijeme prijave</th><th>Prijava uspješna</th</tr></thead>');

        $.get('http://arka.foi.hr/WebDiP/2013_projekti/WebDiP2013_023/data/prijave.xml', function(xml) {
            var tbody = $("<tbody>");
            $(xml).find('prijava').each(function() {

                $korisnicko_ime = $(this).find('korisnicko_ime').text();
                $vrijeme = $(this).find('vrijeme').text();
                $prijava_uspjesna = $(this).find('prijava_uspjesna').text();

                if ($prijava_uspjesna == 1) {
                    var red = "<tr>";
                    red += "<td>" + $korisnicko_ime + "</td>";
                    red += "<td>" + $vrijeme + "</td>";

                    if ($prijava_uspjesna == 1) {
                        $prijava_uspjesna = "Uspješna"
                    }
                    else {
                        $prijava_uspjesna = "Neuspješna"
                    }
                    red += "<td>" + $prijava_uspjesna + "</td>";
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
    
    $("#prikazineuspjeh").click(function() {
        var tablica = $('<table id="tablica">');
        tablica.append('<thead><tr><th>Korisnicko ime</th><th>Vrijeme prijave</th><th>Prijava uspješna</th</tr></thead>');

        $.get('http://arka.foi.hr/WebDiP/2013_projekti/WebDiP2013_023/data/prijave.xml', function(xml) {
            var tbody = $("<tbody>");
            $(xml).find('prijava').each(function() {

                $korisnicko_ime = $(this).find('korisnicko_ime').text();
                $vrijeme = $(this).find('vrijeme').text();
                $prijava_uspjesna = $(this).find('prijava_uspjesna').text();

                if ($prijava_uspjesna == 0) {
                    var red = "<tr>";
                    red += "<td>" + $korisnicko_ime + "</td>";
                    red += "<td>" + $vrijeme + "</td>";

                    if ($prijava_uspjesna == 1) {
                        $prijava_uspjesna = "Uspješna"
                    }
                    else {
                        $prijava_uspjesna = "Neuspješna"
                    }
                    red += "<td>" + $prijava_uspjesna + "</td>";
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
    
});



