<?php
include_once 'classes/baza.class.php';
$baza = new Baza();
include_once 'classes/prijava_odjava.class.php';
session_start();

if (!isset($_SESSION["WebDiP"]) || !isset($_SESSION["korisnik"]) || $_SESSION["tip"] < 0) {
    header("Location: error.php?e=2");
    exit();
}

$id_zapis = $_GET['idUnosa'];

if (isset($_POST['slanje'])) {
    
}

$upitZaDetalje = "select * from zapis where id_zapis=" . $id_zapis;


$rezultatUpita = $baza->selectDB($upitZaDetalje);

while ($red = $rezultatUpita->fetch_array()) {
    $ispis = '
            <div class="row">
                <div class="large-2 columns">
                    <label >Naziv</label>
                </div>
                <div class="large-10 columns">
                    <input name="naziv" type="text" value=' . $red['naziv'] .'>
                </div>
            </div>
            <div class="row">
                <div class="large-2 columns">
                    <label> Mjesto</label>
                </div>
                <div class="large-10 columns">
                    <input class="formatiranjeDatalista" list="mjesta" name="mjesta" value=' . $red['mjesto'] .'>
                    <datalist id="mjesta">                      
                    </datalist>
                </div>
            </div>
            <div class="row">
                <div class="large-2 columns">
                    <label> Regija</label>
                </div>
                <div class="large-10 columns">
                    <select name="regija" id="regija">
                        <option selected value="-1">Odaberite regiju</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="large-2 columns">
                    <label> Vrsta zapisa</label>
                </div>
                <div class="large-10 columns">
                    <select name="zapis" id="zapis">
                        <option selected value="-1">Odaberite vrstu zapisa</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="large-2 columns">
                    <label> Tip unosa</label>
                </div>
                <div class="large-10 columns">
                    <select name="tip_unosa" id="tip_unosa">
                        <option selected value="-1">Odaberite tip unosa</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div  class="large-2 columns">
                    <label>Opis unosa</label>
                </div>
                <div  class="large-10 columns">
                    <textarea name="opis" rows="10"></textarea>
                </div>
            </div>
            <div class="row">
                <div class="large-2 columns">
                    <label >Odaberite slike</label>
                </div>
                <div class="large-10 columns">

                    <input type="file" name="slike" multiple>

                </div>
            </div>
            ';
}

$naziv = "Uredi unos";
include '_header.php'
?>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script> 
<script src="http://datatables.net/download/build/nightly/jquery.dataTables.js"></script>
<script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<link href="http://datatables.net/download/build/nightly/jquery.dataTables.css" rel="stylesheet" type="text/css">   
<script src="js/mjesta.js"></script>


<div class="row">
    <div class="large-12 columns">
        <h3>Unesite vaše promjene</h3>

        <form method="post" name="noviUnos" action="<?php echo $_SERVER['PHP_SELF']; ?>">

            <?php echo $ispis ?>

            <input name="slanje" type="submit" value="Završi unos" class="large-4 radius button right">
        </form>
    </div>
</div>


<?php include '_footer.php' ?>
