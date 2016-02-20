$(document).ready(function() {
    
    $.get('http://arka.foi.hr/WebDiP/2013_projekti/WebDiP2013_023/data/mjesta.xml', function(xml) {
        $(xml).find('mjesto').each(function() {
            $id_regija = $(this).find('id_regija').text();
            if ($id_regija == $('#regija').val()) {
                $mjesto = $(this).find('naziv').text();
                $('<option value=' + $mjesto + '></option>').appendTo('#mjesta')
            }
        });
    });


    $.get('http://arka.foi.hr/WebDiP/2013_projekti/WebDiP2013_023/data/vrsta_zapisa.xml', function(xml) {
        $(xml).find('zapis').each(function() {
            $zapis = $(this).find('naziv').text();
            $id_zapis = $(this).find('id_zapisa').text();
            $red = "<option value=" + $id_zapis + ">" + $zapis + "</option>";
            $("#zapis").append($red);
        });
    });

    $.get('http://arka.foi.hr/WebDiP/2013_projekti/WebDiP2013_023/data/tipovi_unosa.xml', function(xml) {
        $(xml).find('tip').each(function() {
            $zapis = $(this).find('naziv').text();
            $id_zapis = $(this).find('id_tipa').text();
            $red = "<option value=" + $id_zapis + ">" + $zapis + "</option>";
            $("#tip_unosa").append($red);
        });
    });
});
