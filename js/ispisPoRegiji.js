$(document).ready(function() {

    $.get('http://arka.foi.hr/WebDiP/2013_projekti/WebDiP2013_023/data/popis_regija.xml', function(xml) {
        $(xml).find('regija').each(function() {
            $id_zapis = $(this).find('id_regija').text();
            $zapis = $(this).find('naziv').text();
            $red = "<option value=" + $id_zapis + ">" + $zapis + "</option>";
            $("#regija").append($red);
        });
    });

    $("#prikazi").click(function() {
        $regija = $('#regija').val();
        var tablica = $('<table id="tablica">');
        tablica.append('<thead><tr><th>ID</th><th>Naziv</th><th>Sadrzaj</th><th>ID regije</th><th>Opcije</th></tr></thead>');

        $.get('http://arka.foi.hr/WebDiP/2013_projekti/WebDiP2013_023/data/zapisi.xml', function(xml) {
            var tbody = $("<tbody>");
            $(xml).find('zapis').each(function() {

                $zapis = $(this).find('naziv').text();
                $id_zapis = $(this).find('id_zapis').text();
                $sadrzaj = $(this).find('sadrzaj').text();
                $id_regija = $(this).find('regija').text();

                if ($id_regija == $regija) {
                    var red = "<tr>";
                    red += "<td>" + $id_zapis + "</td>";
                    red += "<td>" + $zapis + "</td>";
                    red += "<td>" + $sadrzaj + "</td>";
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