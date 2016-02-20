<?php
include_once 'classes/prijava_odjava.class.php';
session_start();
include_once 'kreiranjeXMLa.php';
kreirajKorisnike();

if (!isset($_SESSION["WebDiP"]) || !isset($_SESSION["korisnik"]) || $_SESSION["tip"] < 2) {
    header("Location: error.php?e=2");
    exit();
}

include_once 'classes/baza.class.php';
$baza = new Baza();
$aktivirano = 0;


if (isset($_POST['slanje'])) {

    $korisnik = $_POST['korisnik'];
    $ban = $_POST['ban'];


        $upit="UPDATE korisnik SET ban = DATE_ADD(NOW(), INTERVAL $ban HOUR) WHERE id_korisnik='$korisnik'";
        $baza->updateDB($upit);
        
        
            $aktivirano = 1;
            $id_korisnika = $_SESSION['id'];
            $uspjeh = "INSERT INTO log_sustava VALUES (default, '$id_korisnika', now(), 'BAN', 'Bannan korisnik')";
            $baza->updateDB($uspjeh);
        
    } 

$naziv="Ban korisnika";
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
                        <option selected value="-1">Odaberite koga zelite bannati</option>
                    </select>         
                </div>
            </div>

            <div class="row">
                <div class="large-12 columns">
                    <label>Na koliko ga sati želite bannati
                        <input type="text"  name="ban" id="ban" required="required">
                    </label>
                </div>
            </div>
            <div class="row">

                <div class="large-12 columns">
                    <input type="submit" value="  Ban  "  class="button radius tiny expand" name="slanje"/>
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
                echo "Korisnik bannan.";
            } elseif ($aktivirano == 2) {
                echo "Korisnik nije bannan.";
            }
            ?>
            <a href="popisRegija.php" class="close">&times;</a>
        </div>
    </div>
</div> 


<?php include '_footer.php'; ?>
