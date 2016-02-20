<?php
include_once 'classes/baza.class.php';
$baza = new Baza();
session_start();

if (!isset($_SESSION["WebDiP"]) || !isset($_SESSION["korisnik"]) || $_SESSION["tip"] < 2) {
    header("Location: error.php?e=2");
    exit();
}
include_once 'kreiranjeXMLa.php';
kreirajZapise();
$naziv="Obrada unosa";
include '_header.php'
?>


<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script> 
<script src="http://datatables.net/download/build/nightly/jquery.dataTables.js"></script>
<script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<link href="http://datatables.net/download/build/nightly/jquery.dataTables.css" rel="stylesheet" type="text/css">   
<script src="js/obradaUnosa.js"></script>

<fieldset class="row pozadina">
    <label><h1>Koje unose želite pogledati?</h1>
        <div class="row">        
            <ul class="button-group columns large-12">
                <li class="columns large-4"><input id="prikaziOcjenjene" type="button" class="button expand" value="Odobreni unosi"></li>
                <li class="columns large-4"><input id="prikaziNeocjenjene" type="button" class="button expand" value="Neocjenjeni unosi"></li>
                <li class="columns large-4"><input id="prikaziOdbacene" type="button" class="button expand" value="Odbačeni unosi"></li>
            </ul>
        </div>
    </label>

</fieldset>

<div class="row">
    <div class="large-12 columns">
        <section id="generiranje">

        </section>
    </div>
</div>
<?php include '_footer.php'; ?>
