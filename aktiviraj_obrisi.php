<?php

include_once 'classes/baza.class.php';
session_start();

if ($_SESSION["tip"] == 3) {
    $id_korisnik = $_GET['idKorisnika'];
    $baza = new baza();
    $tip_promjene = "SELECT aktiviran FROM korisnik WHERE id_korisnik=" . $id_korisnik;
    $rezultat = $baza->selectDB($tip_promjene);
    list($tip_promjene) = mysqli_fetch_array($rezultat);

    if ($tip_promjene == 0) {
        $upit = "UPDATE korisnik SET aktiviran=1 WHERE id_korisnik=" . $id_korisnik;

        if ($baza->updateDB($upit)) {
            header("Location: korisnici.php");
        } else {
            header("Location: error.php?e=4");
        }
    }
    else{
         $upit = "UPDATE korisnik SET aktiviran=0 WHERE id_korisnik=" . $id_korisnik;

        if ($baza->updateDB($upit)) {
            header("Location: korisnici.php");
        } else {
            header("Location: error.php?e=4");
        }
    }
}
else
{
    header("Location: error.php?e=3");
}
?>
