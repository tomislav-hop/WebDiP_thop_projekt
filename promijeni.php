<?php
include_once 'classes/baza.class.php';
session_start();
if (!isset($_SESSION["WebDiP"]) || !isset($_SESSION["korisnik"]) || $_SESSION["tip"] < 3) {
    header("Location: error.php?e=2");
    exit();
}

$id_korisnik = $_GET['idKorisnika'];
$baza = new baza();
if (isset($_POST['slanje'])) {


    $upit = "UPDATE korisnik SET ime='{$_POST['NOVOime']}',"
            . "prezime = '{$_POST['prezime']}',"
            . "korime = '{$_POST['korIme']}',"
            . "lozinka = '{$_POST['lozinka']}',"
            . "grad = '{$_POST['grad']}' ,"
            . "adresa = '{$_POST['adresa']}' ,"
            . "telefon = '{$_POST['telefon']}',"
            . "zivotopis = '{$_POST['zivotopis']}' ,"
            . "spol = '{$_POST['spol']}' ,"
            . "slika = '{$_POST['slika']}'"
            . "WHERE id_korisnik='{$_POST['id_kor']}'";
            
    $id_korisnika = $_SESSION['id'];
    $uspjeh = "INSERT INTO log_sustava VALUES (default, '$id_korisnika', now(), 'Admin uredjivanje profila', NULL)";
    $baza->updateDB($uspjeh);

    if ($baza->updateDB($upit)) {
        header("Location: korisnici.php");
    } else {
        header("Location: error.php?e=4");
    }
}


//ISPIS POSTOJEĆIH PODATAKA

$upitZaDetalje = "select * from korisnik where id_korisnik=" . $id_korisnik;


$rezultatUpita = $baza->selectDB($upitZaDetalje);




while ($red = $rezultatUpita->fetch_array()) {

    $ispis.="<label class='labela' for='id_kor'>ID korisnika </label><input class='unos' name='id_kor' type='text' readonly value=" . $red['id_korisnik'] . ">"
            . "<label  for='ime'>Ime </label><input class='unos' name='NOVOime' type='text' value=" . $red['ime'] . ">"
            . "<label  for='prezime'>Prezime </label><input class='unos' name='prezime' type='text' value=" . $red['prezime'] . ">"
            . "<label  for='korIme'>Korisničko ime </label><input class='unos' name='korIme' type='text' value=" . $red['korime'] . ">"
            . "<label  for='lozinka'>Lozinka </label><input class='unos' name='lozinka' type='text' value=" . $red['lozinka'] . ">"
            . "<label  for='email'>Email </label><input class='unos' name='email' type='text' value=" . $red['email'] . ">"
            . "<label  for='grad'>Grad </label><input class='unos' name='grad' type='text' value=" . $red['grad'] . ">"
            . "<label  for='adresa'>Adresa </label><input class='unos' name='adresa' type='text' value=" . $red['adresa'] . ">"
            . "<label  for='zivotopis'>Životopis </label><input class='unos' name='zivotopis' type='text' value=" . $red['zivotopis'] . ">"
            . "<label  for='spol'>Spol </label><input class='unos' name='spol' type='text' value=" . $red['spol'] . ">"
            . "<label  for='slika'>Slika </label><input class='unos' name='slika' type='text' value=" . $red['slika'] . ">";

    $korisnicko_ime = $red['korime'];
}

include_once '_header.php';
?>



<div class="large-3 row panel">
<h3> Detalji o korisniku <?php echo $korisnicko_ime ?> <h3>

<form  id="promjena"  method="POST" name="promjena" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
    <?php echo $ispis; ?>

    <input class="button radius expand right" id='slanje' name='slanje' type='submit' value=' Spremi promjene '>
</form>
    </div>

<?php include_once '_footer.php'; ?>

