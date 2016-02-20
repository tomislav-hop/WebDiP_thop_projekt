$(document).ready(function() { 
    $.get('http://arka.foi.hr/WebDiP/2013_projekti/WebDiP2013_023/data/mjesta.xml', function(xml) {
        $(xml).find('mjesto').each(function() {
            $mjesto = $(this).find('naziv').text();
            $id_mjesto = $(this).find('id_mjesta').text();
            $red = "<option value=" + $id_mjesto + ">" + $mjesto + "</option>";
            $("#mjesto").append($red);
        });
    });

    $("#prikazi").click(function() {
        $mjesto = $('#mjesto').val();
        var tablica = $('<table id="tablica">');
        tablica.append('<thead><tr><th>ID</th><th>Naziv</th><th>Sadrzaj</th><th>ID regije</th><th>Opcije</th></tr></thead>');

        $.get('http://arka.foi.hr/WebDiP/2013_projekti/WebDiP2013_023/data/zapisi.xml', function(xml) {
            var tbody = $("<tbody>");
            $(xml).find('zapis').each(function() {

                $zapis = $(this).find('naziv').text();
                $id_zapis = $(this).find('id_zapis').text();
                $sadrzaj = $(this).find('sadrzaj').text();
                $id_mjesto = $(this).find('mjesto').text();

                if ($id_mjesto == $mjesto) {
                    var red = "<tr>";
                    red += "<td>" + $id_zapis + "</td>";
                    red += "<td>" + $zapis + "</td>";
                    red += "<td>" + $sadrzaj + "</td>";
                    red += "<td>" + $id_mjesto + "</td>";
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