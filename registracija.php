<?php
include_once 'classes/baza.class.php';
session_start();
include_once 'kreiranjeXMLa.php';
kreirajKorisnike();
$baza = new Baza();

if (isset($_POST['slanje'])) {
    $greska = false;

    $kor_ime = $_POST['ime'];
    $kor_prezime = $_POST['prezime'];
    $kor_slika = $_POST['slika'];
    $kor_adresa = $_POST['adresa'];
    $kor_grad = $_POST['grad'];
    $kor_email = $_POST['email'];
    $korIme = $_POST['korisnicko_ime'];
    $kor_lozinka1 = $_POST['lozinka1'];
    $kor_lozinka2 = $_POST['lozinka2'];
    $kor_zivotopis = $_POST['zivotopis'];
    $kor_spol = $_POST['spol'];
    
    function get_random_string($znakovi, $duzina) {
        $random_string = "";
        $broj_znakova = strlen($znakovi);
        for ($i = 0; $i < $duzina; $i++) {
            $random = mt_rand(1, $broj_znakova);
            $random_znak = $znakovi[$random - 1];
            $random_string .= $random_znak;
        }
        return $random_string;
    }

    $znakovi_koji_su_moguci = 'abcd1234';
    $kod = get_random_string($znakovi_koji_su_moguci, 6);

    require_once('recaptcha/recaptchalib.php');
    $privatekey = "6LeLyvQSAAAAAJGXPLG3jr4xZlsw19LEXCCuGmCN";
    $resp = recaptcha_check_answer($privatekey, $_SERVER["REMOTE_ADDR"], $_POST["recaptcha_challenge_field"], $_POST["recaptcha_response_field"]);

    if (!$resp->is_valid) {
        $sve_greske .="Neispravno unesen recaptcha!<br>";
        $greska = true;
    }


    if ($greska == false) {
        $upit = "SELECT * FROM korisnik where korime = '" . $korIme . "'";
        $rezultat = $baza->selectDB($upit);
        if ($rezultat->num_rows != 0) {
            header("Location: error.php?e=8");
        } else {
            $upit = "SELECT * FROM korisnik where email = '" . $kor_email . "'";
            $rezultat = $baza->selectDB($upit);
            if ($rezultat->num_rows != 0) {
                header("Location: error.php?e=7");
            } else {
                $upit = "insert into korisnik VALUES"
                        . "(default,'$kor_ime','$kor_prezime', default, '1', '1', '$kor_email', '$kod',"
                        . "'$kor_lozinka1','0','$kor_slika','$korIme','$kor_grad','$kor_adresa','ne treba',"
                        . "'$kor_zivotopis','$spol','0','0');";

                if ($baza->updateDB($upit)) {
                    $primatelj = $kor_email;
                    $naslov = "Aktivacija korisničkog računa";
                    $poruka = "Poštovani <br><br> molimo vas da kliknete na sljedeći link "
                            . "kako bi aktivirali vaš korisnički račun. "
                            . "<a href='http://arka.foi.hr/WebDiP/2013_projekti/WebDiP2013_023/aktivacija.php?aktivacija=$kod&korIme=$korIme'>"
                            . "Aktivacijski link - Kliknite ovdje</a>"
                            . ""
                            . "Vaš kod je: $kod"
                            . "Korisničko ime: $korIme";
                    mail($primatelj, $naslov, $poruka);
                    header("Location: aktivacija.php");
                } else {
                    header("Location: error.php?e=4");
                }
            }
        }
    }
    else{
        header("Location: error.php?e=10");
    }
}

$naziv = "Registracija";
include '_header.php'
?>

<script src="js/provjere_registracija.js"></script>



<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script> 
<script src="http://datatables.net/download/build/nightly/jquery.dataTables.js"></script>
<script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<link href="http://datatables.net/download/build/nightly/jquery.dataTables.css" rel="stylesheet" type="text/css">   
<script src="js/thop_autocomp.js"></script>

<nav class="large-4 row">

    <script type="text/javascript">
        var RecaptchaOptions = {
            theme: 'clean'
        };
    </script>

    <form method="post" name="prijava" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <fieldset class="pozadina">
            <div class="row">
                <div class="large-12 columns">
                    <label>Korisničko ime</label>
                    <input type="text" name="korisnicko_ime" id="korisnicko_ime" required="required" class="error">
                     <small id="korisnicko_imeGreska" class="error" style="display: none;"></small>
                </div>
            </div>
            <div class="row">
                <div class="large-6 columns">
                    <label>Lozinka</label>
                    <input class="error" type="password" name="lozinka1" id="lozinka1" required="required">
                    <small id="lozinkaGreska1" class="error" style="display: none;"></small>
                </div>

                <div class="large-6 columns">
                    <label>Potvrda lozinke</label>
                    <input class="error" type="password" name="lozinka2" id="lozinka2" required="required">
                    <small id="lozinkaGreska2" class="error" style="display: none;"></small>
                </div>
            </div>
            
            <div class="row">
                <div class="large-12 columns">
                    <label>Ime</label>
                    <input class="error" type="text" name="ime" id="ime" required="required">
                    <small id="imeGreska" class="error" style="display: none;"></small>
                </div>
            </div>
            <div class="row">
                <div class="large-12 columns">
                    <label>Prezime</label>
                    <input class="error" type="text" name="prezime" id="prezime" required="required">
                    <small id="prezimeGreska" class="error" style="display: none;"></small>
                </div>
            </div>
            <div class="row">
                <div class="large-12 columns">
                    <label>Email</label>
                    <input type="text"  class="error" name="email" id="email" required="required">
                    <small id="emailGreska" class="error" style="display: none;"></small>
                </div>
            </div>

            <div class="row">
                <div class="large-6 columns">
                    <label>Grad
                        <select id="gradovi" name="gradovi">
                            <option selected value="-1">Odaberite ili utipkajte grad</option>
                        </select>
                    
                    </label>
                    
                </div>

                <div class="large-6 columns">
                    <label>Adresa</label>
                    <input class="unos" type="text" name="adresa" required="required">
                </div>
            </div>
            <div class="row">
                <div class="large-12 columns">
                    <label>Spol
                        <select>
                            <option selected value="-1">Odaberite spol</option>
                            <option value="1">Musko</option>
                            <option value="2">Zensko</option>
                        </select>
                    </label>
                </div>
            </div>
            <div class="row">
                <div class="large-12 columns" required="required">
                    <label>Slika</label>
                    <input type="text" name="slika" placeholder="Link na željenu sliku profila">
                </div>
            </div>
            <div class="row">
                <div class="large-12 columns" required="required">
                    <label>Životopis                               
                        <textarea name="zivotopis" rows="5" placeholder="Kratki životopis"></textarea>
                        
                    </label>
                </div>
            </div>

            <div class="row">

                <div class="large-9 columns right">
                    <label>Unesite riječi koje vidite
                        <?php
                        require_once('recaptcha/recaptchalib.php');
                        $publickey = "6LeLyvQSAAAAAG0cl8eD0QEk1xW7MVlajEP5mgA2";
                        echo recaptcha_get_html($publickey);
                        ?>
                    </label>
                </div>
            </div>



            <div class="row">

                <div class="large-12 columns">
                    <input name="slanje" type="submit" value="  Registriraj me  "  class="button radius tiny expand razmak20p"/>
                </div>
            </div>
        </fieldset>
    </form>
</nav>




<?php include '_footer.php' ?>