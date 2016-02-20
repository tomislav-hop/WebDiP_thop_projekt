<?php

include_once 'classes/baza.class.php';

function kreirajMjesta() {
    $baza = new Baza();
    $upit = "SELECT * FROM mjesto WHERE ok='1'";
    $rezultat = $baza->selectDB($upit);
    $xml = new SimpleXMLElement('<mjesta/>');

    while ($row = mysqli_fetch_assoc($rezultat)) {
        $mydata = $xml->addChild('mjesto');
        $mydata->addChild('id_mjesta', "{$row['id_mjesto']}");
        $mydata->addChild('naziv', "{$row['naziv']}");
        $mydata->addChild('id_regija', "{$row['id_regija']}");
    }

    $fp = fopen("data/mjesta.xml", "wb");
    fwrite($fp, $xml->asXML());
    fclose($fp);
}

function kreirajVrsteZapisa() {
    $baza = new Baza();
    $upit = "SELECT id_vrsta_zapisa, naziv FROM vrsta_zapisa";
    $rezultat = $baza->selectDB($upit);
    $xml = new SimpleXMLElement('<vrsta_zapisa/>');

    while ($row = mysqli_fetch_assoc($rezultat)) {
        $mydata = $xml->addChild('zapis');
        $mydata->addChild('id_zapisa', "{$row['id_vrsta_zapisa']}");
        $mydata->addChild('naziv', "{$row['naziv']}");
    }

    $fp = fopen("data/vrsta_zapisa.xml", "wb");
    fwrite($fp, $xml->asXML());
    fclose($fp);
}

function kreirajRegije() {
    $baza = new Baza();
    $upit = "SELECT id_regija, naziv FROM regija";
    $rezultat = $baza->selectDB($upit);
    $xml = new SimpleXMLElement('<regije/>');

    while ($row = mysqli_fetch_assoc($rezultat)) {
        $mydata = $xml->addChild('regija');
        $mydata->addChild('id_regija', "{$row['id_regija']}");
        $mydata->addChild('naziv', "{$row['naziv']}");
    }

    $fp = fopen("data/popis_regija.xml", "wb");
    fwrite($fp, $xml->asXML());
    fclose($fp);
}

function kreirajTipoveUnosa() {
    $baza = new Baza();
    $upit = "SELECT id_tip_unosa, naziv FROM tip_unosa";
    $rezultat = $baza->selectDB($upit);
    $xml = new SimpleXMLElement('<tipovi/>');

    while ($row = mysqli_fetch_assoc($rezultat)) {
        $mydata = $xml->addChild('tip');
        $mydata->addChild('id_tipa', "{$row['id_tip_unosa']}");
        $mydata->addChild('naziv', "{$row['naziv']}");
    }

    $fp = fopen("data/tipovi_unosa.xml", "wb");
    fwrite($fp, $xml->asXML());
    fclose($fp);
}

function kreirajKorisnike() {
    $baza = new Baza();
    $upit = "SELECT * FROM korisnik";
    $rezultat = $baza->selectDB($upit);
    $xml = new SimpleXMLElement('<korisnici/>');

    while ($row = mysqli_fetch_assoc($rezultat)) {
        $mydata = $xml->addChild('korisnik');
        $mydata->addChild('id_korisnik', "{$row['id_korisnik']}");
        $mydata->addChild('ime', "{$row['ime']}");
        $mydata->addChild('prezime', "{$row['prezime']}");
        $mydata->addChild('last_update', "{$row['last_update']}");
        $mydata->addChild('status', "{$row['status']}");
        $mydata->addChild('uloga_id', "{$row['uloga_id']}");
        $mydata->addChild('email', "{$row['email']}");
        $mydata->addChild('lozinka', "{$row['lozinka']}");
        $mydata->addChild('ban', "{$row['ban']}");
        $mydata->addChild('slika', "{$row['slika']}");
        $mydata->addChild('korisnicko_ime', "{$row['korime']}");
        $mydata->addChild('grad', "{$row['grad']}");
        $mydata->addChild('adresa', "{$row['adresa']}");
        $mydata->addChild('zivotopis', "{$row['zivotopis']}");
        $mydata->addChild('spol', "{$row['spol']}");
        $mydata->addChild('aktiviran', "{$row['aktiviran']}");
        $mydata->addChild('neuspjesne_prijave', "{$row['neuspjesne_prijave']}");
    }

    $fp = fopen("data/korisnicka_imena.xml", "wb");
    fwrite($fp, $xml->asXML());
    fclose($fp);
}

function kreirajZapise() {
    $baza = new Baza();
    $upit = "SELECT * FROM zapis";
    $rezultat = $baza->selectDB($upit);
    $xml = new SimpleXMLElement('<zapisi/>');

    while ($row = mysqli_fetch_assoc($rezultat)) {
        $mydata = $xml->addChild('zapis');
        $mydata->addChild('id_zapis', "{$row['id_zapis']}");
        $mydata->addChild('naziv', "{$row['naziv']}");
        $mydata->addChild('sadrzaj', "{$row['sadrzaj']}");
        $mydata->addChild('stanje_zapisa', "{$row['stanje_zapisa']}");
        $mydata->addChild('last_update', "{$row['last_update']}");
        $mydata->addChild('zapis_unio', "{$row['zapis_unio']}");
        $mydata->addChild('mjesto', "{$row['mjesto']}");
        $mydata->addChild('vrsta_zapisa', "{$row['vrsta_zapisa']}");
        $mydata->addChild('tip_unosa', "{$row['tip_unosa']}");
        $mydata->addChild('regija', "{$row['regija']}");
    }

    $fp = fopen("data/zapisi.xml", "wb");
    fwrite($fp, $xml->asXML());
    fclose($fp);
}

function kreirajDnevnik() {
    $baza = new Baza();
    $upit = "SELECT korisnik.korime, log_sustava.id_korisnik, id_log_sustava,vrijeme, tip_operacije, radnja  FROM log_sustava, korisnik WHERE korisnik.id_korisnik=log_sustava.id_korisnik";
    $rezultat = $baza->selectDB($upit);
    $xml = new SimpleXMLElement('<dnevnik/>');

    while ($row = mysqli_fetch_assoc($rezultat)) {
        $mydata = $xml->addChild('zapis');
        $mydata->addChild('id_log_sustava', "{$row['id_log_sustava']}");
        $mydata->addChild('id_korisnik', "{$row['id_korisnik']}");
        $mydata->addChild('korime', "{$row['korime']}");
        $mydata->addChild('vrijeme', "{$row['vrijeme']}");
        $mydata->addChild('tip_operacije', "{$row['tip_operacije']}");
        $mydata->addChild('radnja', "{$row['radnja']}");
    }

    $fp = fopen("data/dnevnik.xml", "wb");
    fwrite($fp, $xml->asXML());
    fclose($fp);
}

function kreirajPrijave() {
    $baza = new Baza();
    $upit = "SELECT korisnik.korime, korisnicka_sesija.login_time, korisnicka_sesija.prijava_uspjesna FROM korisnik, korisnicka_sesija WHERE korisnik.id_korisnik = korisnicka_sesija.id_korisnika";
    $rezultat = $baza->selectDB($upit);
    $xml = new SimpleXMLElement('<sesija/>');

    while ($row = mysqli_fetch_assoc($rezultat)) {
        $mydata = $xml->addChild('prijava');
        $mydata->addChild('korisnicko_ime', "{$row['korime']}");
        $mydata->addChild('vrijeme', "{$row['login_time']}");
        $mydata->addChild('prijava_uspjesna', "{$row['prijava_uspjesna']}");
    }

    $fp = fopen("data/prijave.xml", "wb");
    fwrite($fp, $xml->asXML());
    fclose($fp);
}

function kreirajStatistike() {
    $baza = new Baza();
    $upit = "SELECT tip_unosa.naziv, COUNT(*) AS count FROM zapis,tip_unosa WHERE id_tip_unosa = tip_unosa GROUP BY tip_unosa";
    $rezultat = $baza->selectDB($upit);
    $xml = new SimpleXMLElement('<statistika/>');

    while ($row = mysqli_fetch_assoc($rezultat)) {
        $mydata = $xml->addChild('tip_unosa');
        $mydata->addChild('naziv', "{$row['naziv']}");
        $mydata->addChild('kolicina', "{$row['count']}");
    }

    $fp = fopen("data/stat.xml", "wb");
    fwrite($fp, $xml->asXML());
    fclose($fp);
}

function kreirajStatistike2() {
    $baza = new Baza();
    $upit = "SELECT regija.naziv, COUNT(*) AS count FROM zapis,regija WHERE id_regija = regija GROUP BY regija.naziv";
    $rezultat = $baza->selectDB($upit);
    $xml = new SimpleXMLElement('<statistika/>');

    while ($row = mysqli_fetch_assoc($rezultat)) {
        $mydata = $xml->addChild('tip_unosa');
        $mydata->addChild('naziv', "{$row['naziv']}");
        $mydata->addChild('kolicina', "{$row['count']}");
    }

    $fp = fopen("data/stat2.xml", "wb");
    fwrite($fp, $xml->asXML());
    fclose($fp);
}

function kreirajStatistike3() {
    $baza = new Baza();
    $upit = "SELECT korisnik.korime, COUNT(*) AS count FROM log_sustava,korisnik WHERE korisnik.id_korisnik=log_sustava.id_korisnik GROUP BY korisnik.korime";
    $rezultat = $baza->selectDB($upit);
    $xml = new SimpleXMLElement('<statistika/>');

    while ($row = mysqli_fetch_assoc($rezultat)) {
        $mydata = $xml->addChild('tip_unosa');
        $mydata->addChild('naziv', "{$row['korime']}");
        $mydata->addChild('kolicina', "{$row['count']}");
    }

    $fp = fopen("data/stat3.xml", "wb");
    fwrite($fp, $xml->asXML());
    fclose($fp);
}

?>