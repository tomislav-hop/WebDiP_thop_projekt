<?php
include_once 'classes/prijava_odjava.class.php';
include_once 'classes/baza.class.php';
$baza=new Baza();

session_start();

if (!isset($_SESSION["WebDiP"]) || !isset($_SESSION["korisnik"])) {
    header("Location: error.php?e=2");
    exit();
}

if (isset($_POST['slanje'])) {
    $prijava_odjava = new prijava_odjava();

    $id_korisnika = $_SESSION['id'];

    $uspjeh = "UPDATE korisnicka_sesija SET logout_time=now() WHERE id_korisnika='$id_korisnika' AND logout_time IS NULL AND prijava_uspjesna=1";
    $baza->updateDB($uspjeh);
    

    //$prijava_odjava->kolacici_brisi();
    $prijava_odjava->sesija_brisi();
}
$naziv="Odjava";
include '_header.php';
?>

<nav class="large-2 row">
    <form class="large-12 columns" method="post" name="prijava" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <fieldset class="pozadina">

            <div class="row">
                <div class="large-12 columns">
                    <input type="submit" value="  Odjavi se  "  class="button radius tiny expand" name="slanje"/>

                </div>
            </div>

        </fieldset>
    </form>
</nav>  


<?php include '_footer.php' ?>