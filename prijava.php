<?php
include_once 'classes/baza.class.php';
include_once 'classes/prijava_odjava.class.php';
session_start();
$prijava_odjava = new prijava_odjava();

if (isset($_POST['slanje'])) {
    $korisnik = $_POST['korime'];
    $lozinka = $_POST['lozinka'];
    $baza = new Baza();
    $upit="SELECT id_korisnik FROM korisnik WHERE korime='$korisnik'";
    
    $rezultatUpita = $baza->selectDB($upit);
    $podatci = mysqli_fetch_array($rezultatUpita);
    
    $id_korisnik = $podatci['id_korisnik'];

    $status = $prijava_odjava->autentikacija($korisnik, $lozinka);
    
    if ($status == 1) {
        $uspjeh = "INSERT INTO korisnicka_sesija VALUES (default, '$id_korisnik', now(), NULL, '1')";
        $baza->updateDB($uspjeh);
        
        $uspjeh = "INSERT INTO log_sustava VALUES (default, '$id_korisnik', now(), 'Prijava', NULL)";
        $baza->updateDB($uspjeh);
        
        $uspjeh = "UPDATE korisnik SET neuspjesne_prijave = '0' WHERE korime='{$korisnik}'";
        $baza->updateDB($uspjeh);
        
        $prijava_odjava->sesija($korisnik);
        $prijava_odjava->kolacici($korisnik);
        header("Location: popisRegija.php");
    } else { 
        $neuspjeh = "UPDATE korisnik SET neuspjesne_prijave = (neuspjesne_prijave + 1) WHERE korime='{$korisnik}'";
        $baza->updateDB($neuspjeh);
        
        $neuspjeh = "INSERT INTO korisnicka_sesija VALUES (default, '$id_korisnik', now(), NULL, '0')";
        $baza->updateDB($neuspjeh);
        
        header("Location: error.php?e=$status");
        exit();
    }
}
$naziv="Prijava";
include '_header.php'
?>




<nav class="large-2 row">
    <form class="large-12 columns" method="post" name="prijava" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <fieldset class="pozadina">
            <div class="row">
                <div class="large-12 columns">
                    <label>Korisničko ime</label>
                    <input type="text" name="korime" value="<?php echo $_COOKIE['ime_korisnika']; ?>"/>           
                </div>
            </div>
            <div class="row">
                <div class="large-12 columns">
                    <label>Lozinka</label>
                    <input type="password"  name="lozinka"/>
                </div>
            </div>
            <div class="row">
                <div class="large-12 columns">
                    <input type="submit" value="  Prijavi se  "  class="button radius tiny expand" name="slanje"/>
                </div>
            </div>
            <div class="row">
                <div class="large-12 columns">
                    <a href="registracija.php"><small>Nemate račun? Registrirajte se ovdje</small></a><br>
                    <a href="zaboravljena.php"><small>Zaboravili ste lozinku? Kliknite ovdje</small></a>
                </div>
            </div>
        </fieldset>
    </form>
</nav>  




<?php include '_footer.php'; ?>
