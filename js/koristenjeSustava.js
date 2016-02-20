$(document).ready(function() {
    $(function() {
        var tablica = $('<table id="tablica">');
        tablica.append('<thead><tr><th>ID zapisa</th><th>Korisnicko ime</th><th>Vrijeme</th><th>Tip</th><th>Radnja</th></tr></thead>');

        $.get('http://arka.foi.hr/WebDiP/2013_projekti/WebDiP2013_023/data/dnevnik.xml', function(xml) {
            var tbody = $("<tbody>");
            $(xml).find('zapis').each(function() {

                $id_log_sustava = $(this).find('id_log_sustava').text();
                $id_korisnik = $(this).find('korime').text();
                $vrijeme = $(this).find('vrijeme').text();
                $tip_operacije = $(this).find('tip_operacije').text();
                $radnja = $(this).find('radnja').text();


                var red = "<tr>";
                red += "<td>" + $id_log_sustava + "</td>";
                red += "<td>" + $id_korisnik + "</td>";
                red += "<td>" + $vrijeme + "</td>";
                red += "<td>" + $tip_operacije + "</td>";
                red += "<td>" + $radnja + "</td>";
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
        