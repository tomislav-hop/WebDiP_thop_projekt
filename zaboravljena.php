<?php
include_once 'classes/baza.class.php';
$baza = new Baza();

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
$lozinka= get_random_string($znakovi_koji_su_moguci, 6);

if (isset($_POST['slanje'])) {
    $korisnik = $_POST['korime'];

    $upit = "SELECT * FROM korisnik where korime = '" . $korisnik . "'";
    $rezultat = $baza->selectDB($upit);
    $red = mysqli_fetch_array($rezultat);
    $kor_email = $red['email'];
    $id_korisnik = $red['id_korisnik'];
    if ($rezultat->num_rows == 0) {
        header("Location: error.php?e=11");
    } else {
        $azururanje = "UPDATE korisnik SET lozinka='" . $lozinka . "' where korime = '" . $korisnik . "'";
        $baza->updateDB($azururanje);
        
        $uspjeh = "INSERT INTO log_sustava VALUES (default, '$id_korisnik', now(), 'Zahtjev za novu lozinku', NULL)";
        $baza->updateDB($uspjeh);
        
        $primatelj = $kor_email;
        $naslov = "Nova lozinka za vaš korisnički račun";
        $poruka = "Poštovani vaša nova lozinka je: $lozinka";             
        mail($primatelj, $naslov, $poruka);
        header("Location: prijava.php");
    }
}

include '_header.php'
?>




<nav class="large-2 row">
    <form class="large-12 columns" method="post" name="prijava" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <fieldset class="pozadina">
            <div class="row">
                <div class="large-12 columns">
                    <label>Korisničko ime</label>
                    <input type="text" name="korime" placeholder="Vaše korisničko ime"/>           
                </div>
            </div>

            <div class="row">
                <div class="large-12 columns">
                    <input type="submit" value="  Pošaljite mi email sa novom lozinkom  "  class="button radius tiny expand" name="slanje"/>
                </div>
            </div>

        </fieldset>
    </form>
</nav>  



<?php include '_footer.php'; ?>
