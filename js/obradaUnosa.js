$(document).ready(function() {
    $("#prikaziOcjenjene").click(function() {
        var tablica = $('<table id="tablica">');
        tablica.append('<thead><tr><th>ID</th><th>Naziv</th><th>Sadrzaj</th><th>Stanje zapisa</th><th>Zadnje azuriranje</th><th>Zapis unio</th><th>Mjesto</th><th>Tip unosa</th><th>ID regije</th><th>Pogledaj unos</th></tr></thead>');

        $.get('http://arka.foi.hr/WebDiP/2013_projekti/WebDiP2013_023/data/zapisi.xml', function(xml) {
            var tbody = $("<tbody>");
            $(xml).find('zapis').each(function() {

                $zapis = $(this).find('naziv').text();
                $id_zapis = $(this).find('id_zapis').text();
                $sadrzaj = $(this).find('sadrzaj').text();
                $stanje_zapisa = $(this).find('stanje_zapisa').text();
                $zadnje_azururanje = $(this).find('last_update').text();
                $mjesto = $(this).find('mjesto').text();
                $tip_unosa = $(this).find('tip_unosa').text();
                $zapis_unio = $(this).find('zapis_unio').text();
                $id_regija = $(this).find('regija').text();

                if ($stanje_zapisa == 1) {
                    var red = "<tr>";
                    red += "<td>" + $id_zapis + "</td>";
                    red += "<td>" + $zapis + "</td>";
                    red += "<td>" + $sadrzaj + "</td>";
                    red += "<td>" + $stanje_zapisa + "</td>";
                    red += "<td>" + $zadnje_azururanje + "</td>";
                    red += "<td>" + $zapis_unio + "</td>";
                    red += "<td>" + $mjesto + "</td>";
                    red += "<td>" + $tip_unosa + "</td>";
                    red += "<td>" + $id_regija + "</td>";
                    red += "<td><a href='unos.php?idUnosa=" + $id_zapis + "'> Pogledaj unos</a></td>";
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
    
        $("#prikaziNeocjenjene").click(function() {
        var tablica = $('<table id="tablica">');
        tablica.append('<thead><tr><th>ID</th><th>Naziv</th><th>Sadrzaj</th><th>Stanje zapisa</th><th>Zadnje azuriranje</th><th>Zapis unio</th><th>Mjesto</th><th>Tip unosa</th><th>ID regije</th><th>Opcije</th></tr></thead>');

        $.get('http://arka.foi.hr/WebDiP/2013_projekti/WebDiP2013_023/data/zapisi.xml', function(xml) {
            var tbody = $("<tbody>");
            $(xml).find('zapis').each(function() {

                $zapis = $(this).find('naziv').text();
                $id_zapis = $(this).find('id_zapis').text();
                $sadrzaj = $(this).find('sadrzaj').text();
                $stanje_zapisa = $(this).find('stanje_zapisa').text();
                $zadnje_azururanje = $(this).find('last_update').text();
                $mjesto = $(this).find('mjesto').text();
                $tip_unosa = $(this).find('tip_unosa').text();
                $zapis_unio = $(this).find('zapis_unio').text();
                $id_regija = $(this).find('regija').text();

                if ($stanje_zapisa == 3) {
                    var red = "<tr>";
                    red += "<td>" + $id_zapis + "</td>";
                    red += "<td>" + $zapis + "</td>";
                    red += "<td>" + $sadrzaj + "</td>";
                    red += "<td>" + $stanje_zapisa + "</td>";
                    red += "<td>" + $zadnje_azururanje + "</td>";
                    red += "<td>" + $zapis_unio + "</td>";
                    red += "<td>" + $mjesto + "</td>";
                    red += "<td>" + $tip_unosa + "</td>";
                    red += "<td>" + $id_regija + "</td>";
                    red += "<td><a href='unos.php?idUnosa=" + $id_zapis + "&neocjenjen=1'> Pogledaj unos</a></td>";
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
    
            $("#prikaziOdbacene").click(function() {
        var tablica = $('<table id="tablica">');
        tablica.append('<thead><tr><th>ID</th><th>Naziv</th><th>Sadrzaj</th><th>Stanje zapisa</th><th>Zadnje azuriranje</th><th>Zapis unio</th><th>Mjesto</th><th>Tip unosa</th><th>ID regije</th><th>Opcije</th></tr></thead>');

        $.get('http://arka.foi.hr/WebDiP/2013_projekti/WebDiP2013_023/data/zapisi.xml', function(xml) {
            var tbody = $("<tbody>");
            $(xml).find('zapis').each(function() {

                $zapis = $(this).find('naziv').text();
                $id_zapis = $(this).find('id_zapis').text();
                $sadrzaj = $(this).find('sadrzaj').text();
                $stanje_zapisa = $(this).find('stanje_zapisa').text();
                $zadnje_azururanje = $(this).find('last_update').text();
                $mjesto = $(this).find('mjesto').text();
                $tip_unosa = $(this).find('tip_unosa').text();
                $zapis_unio = $(this).find('zapis_unio').text();
                $id_regija = $(this).find('regija').text();

                if ($stanje_zapisa == 2) {
                    var red = "<tr>";
                    red += "<td>" + $id_zapis + "</td>";
                    red += "<td>" + $zapis + "</td>";
                    red += "<td>" + $sadrzaj + "</td>";
                    red += "<td>" + $stanje_zapisa + "</td>";
                    red += "<td>" + $zadnje_azururanje + "</td>";
                    red += "<td>" + $zapis_unio + "</td>";
                    red += "<td>" + $mjesto + "</td>";
                    red += "<td>" + $tip_unosa + "</td>";
                    red += "<td>" + $id_regija + "</td>";
                    red += "<td><a href='unos.php?idUnosa=" + $id_zapis + "'> Pogledaj unos</a></td>";
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