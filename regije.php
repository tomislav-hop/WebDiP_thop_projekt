<?php
include_once 'classes/prijava_odjava.class.php';
session_start();

if (!isset($_SESSION["WebDiP"]) || !isset($_SESSION["korisnik"]) || $_SESSION["tip"]<0) {
    header("Location: error.php?e=2");
    exit();
}
include_once 'kreiranjeXMLa.php';
kreirajRegije();
kreirajZapise();

$naziv="Regije";
include '_header.php'
?>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script> 
<script src="http://datatables.net/download/build/nightly/jquery.dataTables.js"></script>
<script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<link href="http://datatables.net/download/build/nightly/jquery.dataTables.css" rel="stylesheet" type="text/css">   
<script src="js/ispisPoRegiji.js"></script>

<fieldset class="row pozadina">
    <label>Odaberite regiju za koju hoćete pogledati zapise
        <select id="regija" name="regija">
            <option selected value="-1">Odaberite Regiju</option>
        </select>
    </label>
    <div class="row">
        <div class="large-12 columns">
            <input type="button" id="prikazi" class="button radius tiny expand" value="Prikaži zapise za regiju">

        </div>
    </div>
</fieldset>

<div class="row">
    <div class="large-12 columns">
        <section id="generiranje">

        </section>
    </div>
</div>
<?php include '_footer.php'; ?>
