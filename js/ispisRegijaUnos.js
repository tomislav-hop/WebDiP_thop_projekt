$(document).ready(function() {
    $(function() {
        var tablica = $('<table id="tablica">');
        tablica.append('<thead><tr><th>Naziv</th><th>Opcije</th></tr></thead>');

        $.get('http://arka.foi.hr/WebDiP/2013_projekti/WebDiP2013_023/data/popis_regija.xml', function(xml) {
            var tbody = $("<tbody>");
            $(xml).find('regija').each(function() {

                $zapis = $(this).find('naziv').text();
                $id_zapis = $(this).find('id_regija').text();


                var red = "<tr>";
                red += "<td>" + $zapis + "</td>";
                red += "<td><a href='noviUnos2.php?idRegije=" + $id_zapis + "'> Dodaj zapis</a></td>";
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
});



