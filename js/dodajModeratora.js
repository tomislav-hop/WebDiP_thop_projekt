$(document).ready(function() {

    $.get('http://arka.foi.hr/WebDiP/2013_projekti/WebDiP2013_023/data/popis_regija.xml', function(xml) {
        $(xml).find('regija').each(function() {
            $id_zapis = $(this).find('id_regija').text();
            $zapis = $(this).find('naziv').text();
            $red = "<option value=" + $id_zapis + ">" + $zapis + "</option>";
            $("#regija").append($red);
        });
    });

    $.get('http://arka.foi.hr/WebDiP/2013_projekti/WebDiP2013_023/data/korisnicka_imena.xml', function(xml) {
        $(xml).find('korisnik').each(function() {
            $status = $(this).find('uloga_id').text();
            if ($status < 3) {
                $id_zapis = $(this).find('id_korisnik').text();
                $korisnicko_ime = $(this).find('korisnicko_ime').text();
                $red = "<option value=" + $id_zapis + ">" + $korisnicko_ime + "</option>";
                $("#korisnik").append($red);
            }
        });
    });
});

