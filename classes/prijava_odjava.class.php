<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of prijava_odjava
 *
 * @author Tomislav
 */
include_once 'classes/baza.class.php';

class prijava_odjava {

    function autentikacija($user, $pass) {
        $baza = new Baza();
        $result = -1;

        $upit = "select ban from korisnik where korime='$user'";
        $rezultat = $baza->selectDB($upit);

        $red = $rezultat->fetch_array();
        $vrijeme = $red['ban'];
        $vrijeme_na_bazi = new DateTime($vrijeme);
        $vrijeme_na_bazi2 = $vrijeme_na_bazi->getTimestamp();

        $sad = new DateTime();
        $vrijeme_trenutno = $sad->getTimestamp();

        if ($vrijeme_trenutno > $vrijeme_na_bazi2) {

            $sql = "select prezime, ime, lozinka, neuspjesne_prijave, aktiviran FROM korisnik WHERE korime = '$user'";

            $rezultat = $baza->selectDB($sql);
            $broj = mysqli_num_rows($rezultat);

            if ($broj == 1) {
                list($prezime, $ime, $lozinka, $prijave, $aktiviran) = mysqli_fetch_array($rezultat);

                include('konfiguracija.php');
                if ($aktiviran == 1) {
                    if ($prijave < $broj_neuspjesnih_prijava) {

                        if ($lozinka == $pass) {
                            $result = 1;
                        } else {
                            $result = 0;
                        }
                    } else {
                        $result = -2;
                    }
                } else {
                    $result = -3;
                }
            } else {
                $result = -1;
            }
        }
        else {
            $result = -4;
        }

        return $result;
    }

    function kolacici($korisnik) {
        setcookie("ime_korisnika", $korisnik, time() + 60 * 60 * 24);
    }

    function kolacici_brisi() {
        if (isset($_POST['slanje'])) {
            setcookie("ime_korisnika", $korisnik, time() - 60 * 60 * 24);
            header("Location: prijava.php");
        }
    }

    function sesija($korisnik) {


        $sql = "select id_korisnik, email, ime, prezime, uloga_id FROM korisnik WHERE korime = '$korisnik'";
        $baza = new Baza();
        $rezultat = $baza->selectDB($sql);
        list($id, $mail, $ime, $prezime, $tip) = mysqli_fetch_array($rezultat);

        session_start();
        $_SESSION['WebDiP'] = 'WebDiP';
        $_SESSION['korisnik'] = $korisnik;
        $_SESSION['id'] = $id;
        $_SESSION['mail'] = $mail;
        $_SESSION['ime'] = $ime;
        $_SESSION['prezime'] = $prezime;
        $_SESSION['tip'] = $tip;
    }

    function sesija_brisi() {
        session_start();
        unset($_SESSION["WebDiP"]);
        session_destroy();
        header("Location: prijava.php");
    }

}
