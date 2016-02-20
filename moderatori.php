<?php
include_once 'classes/prijava_odjava.class.php';
session_start();
include_once 'kreiranjeXMLa.php';
kreirajKorisnike();
kreirajRegije();

if (!isset($_SESSION["WebDiP"]) || !isset($_SESSION["korisnik"]) || $_SESSION["tip"] < 2) {
    header("Location: error.php?e=2");
    exit();
}

include_once 'classes/baza.class.php';
$baza = new Baza();
$aktivirano = 0;


if (isset($_POST['slanje'])) {

    $korisnik = $_POST['korisnik'];
    $regija = $_POST['regija'];

    $upit = "SELECT * FROM regija_moderator WHERE id_regija = '$regija' AND id_korisnik='$korisnik'";
    $rezultat = $baza->selectDB($upit);
    if ($rezultat->num_rows == 0) {
        $upit = "INSERT INTO regija_moderator VALUES ('$regija', '$korisnik')";
        $baza->updateDB($upit);
        
        $upit = "UPDATE korisnik SET uloga_id=2 WHERE id_korisnik='$korisnik'";
        $baza->updateDB($upit);
        
        $upit = "SELECT * FROM regija_moderator WHERE id_regija = '$regija' AND id_korisnik='$korisnik'";
        $rezultat = $baza->selectDB($upit);
        if ($rezultat->num_rows != 0) {
            $aktivirano = 1;
            $id_korisnika = $_SESSION['id'];
            $uspjeh = "INSERT INTO log_sustava VALUES (default, '$id_korisnika', now(), 'INSERT', 'Dodan novi moderator')";
            $baza->updateDB($uspjeh);
        } else {
            $aktivirano = 2;
        }
    } else {
        $aktivirano = 3;
    }
}

$naziv="Dodaj moderatora";
include '_header.php'
?>

<script src="js/dodajModeratora.js"></script>

<div class="large-2 row">
    <form class="large-12 columns" method="post" name="aktivacija" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <fieldset class="pozadina">
            <div class="row">
                <div class="large-12 columns">
                    <label>Odaberite korisnika</label>
                    <select name="korisnik" id="korisnik">
                        <option selected value="-1">Odaberite koga zelite unaprijediti</option>
                    </select>         
                </div>
            </div>

            <div class="row">
                <div class="large-12 columns">
                    <label>Odaberite regiju
                        <select id="regija" name="regija">
                            <option selected value="-1">Odaberite Regiju</option>
                        </select>
                    </label>
                </div>
            </div>
            <div class="row">

                <div class="large-12 columns">
                    <input type="submit" value="  Postavi kao moderatora  "  class="button radius tiny expand" name="slanje"/>
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
                echo "Moderator uspješno dodan.";
            } elseif ($aktivirano == 2) {
                echo "Moderator nije dodan.";
            } elseif ($aktivirano == 3) {
                echo "Taj korisnik već je moderator toj regiji.";
            }
            ?>
            <a href="popisRegija.php" class="close">&times;</a>
        </div>
    </div>
</div> 


<?php include '_footer.php'; ?>
