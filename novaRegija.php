<?php
include_once 'classes/prijava_odjava.class.php';
session_start();

if (!isset($_SESSION["WebDiP"]) || !isset($_SESSION["korisnik"]) || $_SESSION["tip"] < 2) {
    header("Location: error.php?e=2");
    exit();
}

include_once 'classes/baza.class.php';
$baza = new Baza();
$aktivirano = 0;


if (isset($_POST['slanje'])) {

    $regija = $_POST['regija'];

    $upit = "SELECT * FROM regija WHERE naziv = '$regija'";
    $rezultat = $baza->selectDB($upit);
    if ($rezultat->num_rows == 0) {
        $upit = "INSERT INTO regija VALUES (default, '$regija')";
        $baza->updateDB($upit);

        $upit = "SELECT * FROM regija WHERE naziv = '$regija'";
        $rezultat = $baza->selectDB($upit);
        if ($rezultat->num_rows != 0) {
            $aktivirano = 1;

            $id_korisnika = $_SESSION['id'];
            $uspjeh = "INSERT INTO log_sustava VALUES (default, '$id_korisnika', now(), 'INSERT', 'Unos nove regije')";
            $baza->updateDB($uspjeh);
        } else {
            $aktivirano = 2;
        }
    } else {
        $aktivirano = 3;
    }
}

$naziv="Dodavanje regije";
include '_header.php'
?>

<div class="large-2 row">
    <form class="large-12 columns" method="post" name="aktivacija" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <fieldset class="pozadina">
            <div class="row">
                <div class="large-12 columns">
                    <label>Unesite novu regiju</label>
                    <input type="text" name="regija" id="regija"/>           
                </div>
            </div>

            <div class="row">

                <div class="large-12 columns">
                    <input type="submit" value="  Aktiviraj  "  class="button radius tiny expand" name="slanje"/>
                </div>      
            </div>


        </fieldset>
    </form>
    <div class="large-12 columns" style='display: 
    <?php
    if ($aktivirano == 0) {
        echo "none;";
    } else {
        echo "inline;";
    }
    ?>'>
        <div data-alert class="alert-box info">
            <?php
            if ($aktivirano == 1) {
                echo "Regija uspješno dodana.";
            } elseif ($aktivirano == 2) {
                echo "Regija nije dodana.";
            } elseif ($aktivirano == 3) {
                echo "Regija vec postoji.";
            }
            ?>
            <a href="popisRegija.php" class="close">&times;</a>
        </div>
    </div>
</div> 


<?php include '_footer.php'; ?>
