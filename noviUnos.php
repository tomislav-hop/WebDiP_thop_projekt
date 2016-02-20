<?php
session_start();

include_once 'kreiranjeXMLa.php';
kreirajRegije();

if (!isset($_SESSION["WebDiP"]) || !isset($_SESSION["korisnik"]) || $_SESSION["tip"] < 0) {
    header("Location: error.php?e=2");
    exit();
}

$naziv = "Novi unos";
include '_header.php'
?>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script> 
<script src="http://datatables.net/download/build/nightly/jquery.dataTables.js"></script>
<script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<link href="http://datatables.net/download/build/nightly/jquery.dataTables.css" rel="stylesheet" type="text/css">   
<script src="js/ispisRegijaUnos.js"></script> 



<div class="row">
    <h3>Odaberite regiju kojoj dodajete unos</h3>
    <div class="large-12 columns">
        <section id="generiranje">

        </section>           
    </div>
</div>





<?php include '_footer.php' ?>