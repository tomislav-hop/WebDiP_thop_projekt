$(document).ready(function() {
    $(function() {
        var tablica = $('<table id="tablica">');
        tablica.append('<thead><tr><th>Naziv</th><th>Broj zahtjeva</th></tr></thead>');

        $.get('http://arka.foi.hr/WebDiP/2013_projekti/WebDiP2013_023/data/stat3.xml', function(xml) {
            var tbody = $("<tbody>");
            $(xml).find('tip_unosa').each(function() {

                $zapis = $(this).find('naziv').text();
                $kolicina = $(this).find('kolicina').text();


                var red = "<tr>";
                red += "<td>" + $zapis + "</td>";
                red += "<td>" + $kolicina + "</td>";
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



