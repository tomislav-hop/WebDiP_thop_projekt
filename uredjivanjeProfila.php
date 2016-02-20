<?php
include_once 'classes/baza.class.php';
include_once 'classes/prijava_odjava.class.php';
$baza = new Baza();
session_start();

if (!isset($_SESSION["WebDiP"]) || !isset($_SESSION["korisnik"])) {
    header("Location: error.php?e=2");
    exit();
}

$id_profila = $_SESSION['id'];
$upit = "SELECT korime, ime, prezime, last_update, email, grad, adresa, slika, zivotopis FROM korisnik WHERE id_korisnik='$id_profila'";

$rezultatUpita = $baza->selectDB($upit);
$podatci = mysqli_fetch_array($rezultatUpita);


$kor_ime = $_POST['ime'];
$kor_prezime = $_POST['prezime'];
$kor_slika = $_POST['slika'];
$kor_adresa = $_POST['adresa'];
$kor_grad = $_POST['grad'];
$kor_email = $_POST['email'];
$korIme = $_POST['korisnicko_ime'];
$kor_zivotopis = $_POST['zivotopis'];


if (isset($_POST['slanje'])) {
    $upit = "UPDATE korisnik "
            . "SET ime='$kor_ime', prezime='$kor_prezime', email='$kor_email', slika='$kor_slika', korime='$korIme', grad='$kor_grad', adresa='$kor_adresa', zivotopis='$kor_zivotopis'"
            . "WHERE id_korisnik='$id_profila'";

    $baza->updateDB($upit);

    $id_korisnika = $_SESSION['id'];
    $uspjeh = "INSERT INTO log_sustava VALUES (default, '$id_korisnika', now(), 'UPDATE', 'Uredjivanje profila')";
    $baza->updateDB($uspjeh);
}



$naziv="Uredi profil";
include '_header.php'
?>

<script src="js/provjere_registracija.js"></script>
<div class="large-4 row">
    <form method="post" name="prijava" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <fieldset class="pozadina">
            <div class="row">
                <div class="large-12 columns">
                    <label>Korisničko ime</label>
                    <input type="text" name="korisnicko_ime" id="korisnicko_ime" required="required" class="error" value="<?php echo $podatci['korime'] ?>">
                    <small id="korimeGreska" class="error" style="display: none;"></small>
                </div>
            </div>            
            <div class="row">
                <div class="large-12 columns">
                    <label>Ime</label>
                    <input class="error" type="text" name="ime" id="ime" required="required" value="<?php echo $podatci['ime'] ?>">
                    <small id="imeGreska" class="error" style="display: none;"></small>
                </div>
            </div>
            <div class="row">
                <div class="large-12 columns">
                    <label>Prezime</label>
                    <input class="error" type="text" name="prezime" id="prezime" required="required" value="<?php echo $podatci['prezime'] ?>">
                    <small id="prezimeGreska" class="error" style="display: none;"></small>
                </div>
            </div>
            <div class="row">
                <div class="large-12 columns">
                    <label>Email</label>
                    <input type="text"  class="error" name="email" id="email" required="required" value="<?php echo $podatci['email'] ?>">
                    <small id="emailGreska" class="error" style="display: none;"></small>
                </div>
            </div>

            <div class="row">
                <div class="large-6 columns">
                    <label>Grad
                        <input type="text"   name="grad" id="grad" required="required" value="<?php echo $podatci['grad'] ?>">     
                    </label>  
                </div>

                <div class="large-6 columns">
                    <label>Adresa</label>
                    <input class="unos" type="text" name="adresa" required="required" value="<?php echo $podatci['adresa'] ?>">
                </div>
            </div>
            <div class="row">
                <div class="large-12 columns">
                    <label>Zadnji put izmjenjen profil</label>
                    <input class="unos" type="text" name="vrijeme" readonly required="required" value="<?php echo $podatci['last_update'] ?>">
                </div>
            </div>
            <div class="row">
                <div class="large-12 columns" required="required">
                    <label>Slika</label>
                    <input type="text" name="slika" placeholder="Link na željenu sliku profila" value="<?php echo $podatci['slika'] ?>">
                </div>
            </div>
            <div class="row">
                <div class="large-12 columns" required="required">
                    <label>Životopis                               
                        <textarea name="zivotopis" rows="5" placeholder="Kratki životopis" ><?php echo $podatci['zivotopis'] ?></textarea>

                    </label>
                </div>
            </div>


            <div class="row">

                <div class="large-12 columns">
                    <input name="slanje" type="submit" value="  Promjeni profil  "  class="button radius tiny expand razmak20p"/>
                </div>
            </div>
        </fieldset>
    </form>
</div>

<?php include '_footer.php'; ?>
