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

    $tipUnosa = $_POST['tipUnosa'];

    $upit = "SELECT * FROM tip_unosa WHERE naziv = '$tipUnosa'";
    $rezultat = $baza->selectDB($upit);
    if ($rezultat->num_rows == 0) {
        $upit = "INSERT INTO tip_unosa VALUES (default, '$tipUnosa', NULL)";
        $baza->updateDB($upit);

        $upit = "SELECT * FROM tip_unosa WHERE naziv = '$tipUnosa'";
        $rezultat = $baza->selectDB($upit);
        if ($rezultat->num_rows != 0) {
            $aktivirano = 1;
            $id_korisnika = $_SESSION['id'];
            $uspjeh = "INSERT INTO log_sustava VALUES (default, '$id_korisnika', now(), 'INSERT', 'Unos novog tipa unosa')";
            $baza->updateDB($uspjeh);
        } else {
            $aktivirano = 2;
        }
    } else {
        $aktivirano = 3;
    }
}

$naziv="Dodavanje novog tipa unosa";
include '_header.php'
?>

<div class="large-2 row">
    <form class="large-12 columns" method="post" name="aktivacija" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <fieldset class="pozadina">
            <div class="row">
                <div class="large-12 columns">
                    <label>Unesite novi tip unosa</label>
                    <input type="text" name="tipUnosa" id="tipUnosa"/>           
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
                echo "Tip unosa uspješno dodan.";
            } elseif ($aktivirano == 2) {
                echo "Tip unosa nije dodan.";
            } elseif ($aktivirano == 3) {
                echo "Tip unosa već postoji.";
            }
            ?>
            <a href="popisRegija.php" class="close">&times;</a>
        </div>
    </div>
</div> 


<?php include '_footer.php'; ?>
