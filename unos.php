<?php
include_once 'classes/baza.class.php';
$baza = new Baza();
include_once 'classes/prijava_odjava.class.php';
session_start();
include_once 'kreiranjeXMLa.php';
kreirajZapise();

if (!isset($_SESSION["WebDiP"]) || !isset($_SESSION["korisnik"]) || $_SESSION["tip"] < 0) {
    header("Location: error.php?e=2");
    exit();
}


if (isset($_POST['slanje'])) {
    $id_post = $_POST['id_post'];
    $prihvati = "UPDATE zapis SET stanje_zapisa=1 WHERE id_zapis='{$id_post}'";
    $baza->updateDB($prihvati);

    $id_mjesto = $_POST['id_mjesto'];
    $prihvati = "UPDATE mjesto SET ok='1' WHERE id_mjesto='{$id_mjesto}'";
    $baza->updateDB($prihvati);

    $id_korisnika = $_SESSION['id'];
    $uspjeh = "INSERT INTO log_sustava VALUES (default, '$id_korisnika', now(), 'UPDATE', 'Odobravanje unosa')";
    $baza->updateDB($uspjeh);

    header("Location: http://arka.foi.hr/WebDiP/2013_projekti/WebDiP2013_023/obradaUnosa.php");
};


if (isset($_POST['odbaci'])) {
    $id_post = $_POST['id_post'];
    $prihvati = "UPDATE zapis SET stanje_zapisa=2 WHERE id_zapis='{$id_post}'";
    $baza->updateDB($prihvati);

    $id_korisnika = $_SESSION['id'];
    $uspjeh = "INSERT INTO log_sustava VALUES (default, '$id_korisnika', now(), 'UPDATE', 'Odbacivanje unosa')";
    $baza->updateDB($uspjeh);

    header("Location: http://arka.foi.hr/WebDiP/2013_projekti/WebDiP2013_023/obradaUnosa.php");
};


$id_zapis = $_GET['idUnosa'];

$upit = "SELECT zapis.naziv as nazivZapisa, mjesto.naziv as mjestoZapisa, regija.naziv as regijaZapisa, vanjski_resurs, slike,vrsta_zapisa.naziv as vrstaZapisa, tip_unosa.naziv as tipZapisa, zapis.sadrzaj as sadrzajZapisa 
FROM zapis, mjesto, regija, vrsta_zapisa, tip_unosa
WHERE zapis.id_zapis='$id_zapis' AND zapis.mjesto=mjesto.id_mjesto AND zapis.regija=regija.id_regija AND  zapis.vrsta_zapisa=id_vrsta_zapisa AND zapis.tip_unosa=id_tip_unosa";


$rezultatUpita = $baza->selectDB($upit);


while ($red = mysqli_fetch_array($rezultatUpita)) {
    $ispis = "
        
            <div class='row'>
                <div class='large-2 columns'>
                    <label ><strong>Naziv:</strong></label>
                </div>
                <div class='large-10 columns'>
                    " . $red['nazivZapisa'] . "
                </div>
            </div>
            <hr>
            <div class='row'>
                <div class='large-2 columns'>
                    <label ><strong>Mjesto:</strong></label>
                </div>
                <div class='large-10 columns'>
                    " . $red['mjestoZapisa'] . "
                </div>
            </div>
            <hr>
            <div class='row'>
                <div class='large-2 columns'>
                    <label ><strong>Regija:</strong></label>
                </div>
                <div class='large-10 columns'>
                    " . $red['regijaZapisa'] . "
                </div>
            </div><hr>
            <div class='row'>
                <div class='large-2 columns'>
                    <label ><strong>Vrsta zapisa:</strong></label>
                </div>
                <div class='large-10 columns'>
                    " . $red['vrstaZapisa'] . "
                </div>
            </div><hr>
            <div class='row'>
                <div class='large-2 columns'>
                    <label ><strong>Tip zapisa:</strong></label>
                </div>
                <div class='large-10 columns'>
                    " . $red['tipZapisa'] . "
                </div>
            </div><hr>
            <div class='row'>
                <div class='large-2 columns'>
                    <label ><strong>Sadržaj zapisa:</strong></label>
                </div>
                <div class='large-10 columns'>
                    " . $red['sadrzajZapisa'] . "
                </div>
            </div>
            <hr>
            <div class='row'>
                <div class='large-2 columns'>
                    <label ><strong>Vanjski resurs:</strong></label>
                </div>
                <div class='large-10 columns'>
                    <a href='" . $red['vanjski_resurs'] . "' target='_blank'>Klik za odlazak na resurs ako postoji</a>
                </div>
            </div>
            <hr>
            
            ";
}




$naziv = "Prikaz unosa";
include '_header.php'
?>




<div class="row">
    <div class="large-12 columns">
        <h3>Prikaz unosa</h3>
        <?php echo $ispis ?>
    </div>
    <form class="large-12 columns" method="post" name="prijava" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <input type="text" style="display:none" name="id_post" value='<?php echo $id_zapis ?>'/> 
        <input type='text' style='display:none' name='id_mjesto' value='<?php
        $upit = "SELECT mjesto FROM zapis WHERE id_zapis='$id_zapis'";
        $rezultatUpita = $baza->selectDB($upit);
        $red = mysqli_fetch_array($rezultatUpita);
        echo $red['mjesto'];
        ?>'/> 
        <input type="submit" style="display:
        <?php
        $id_korisnika = $_SESSION['id'];
        $upit = "SELECT regija FROM zapis WHERE id_zapis='$id_zapis'";
        $rezultatUpita = $baza->selectDB($upit);
        $red = mysqli_fetch_array($rezultatUpita);
        $id_regija=$red['regija'];
        $upit = "SELECT * FROM regija_moderator WHERE id_regija='$id_regija' AND id_korisnik='$id_korisnika'";
        $rezultat = $baza->selectDB($upit);
        $broj = mysqli_num_rows($rezultat);
        if ($broj == 1 || $_SESSION['tip']==3) {
            if (isset($_GET['neocjenjen'])) {
                echo 'box;';
            } else {
                echo 'none;';
            }
        } else {
            echo 'none;';
        }
        ?>" 
               value="  Odobri "  class="button radius expand right" id="slanje" name="slanje"/>
        <input type="submit" style="display:
       <?php
        $id_korisnika = $_SESSION['id'];
        $upit = "SELECT regija FROM zapis WHERE id_zapis='$id_zapis'";
        $rezultatUpita = $baza->selectDB($upit);
        $red = mysqli_fetch_array($rezultatUpita);
        $id_regija=$red['regija'];
        $upit = "SELECT * FROM regija_moderator WHERE id_regija='$id_regija' AND id_korisnik='$id_korisnika'";
        $rezultat = $baza->selectDB($upit);
        $broj = mysqli_num_rows($rezultat);
        if ($broj == 1 || $_SESSION['tip']==3) {
            if (isset($_GET['neocjenjen'])) {
                echo 'box;';
            } else {
                echo 'none;';
            }
        } else {
            echo 'none;';
        }
        ?>" 
               value="  Odbaci "  class="button radius expand right" id="odbaci" name="odbaci"/>
        <a class="button radius expand right" href="javascript:history.go(-1)">Povratak</a>
    </form>


</div>
<?php include '_footer.php' ?>



