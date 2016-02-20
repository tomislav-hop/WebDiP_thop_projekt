<?php
include_once 'kreiranjeXMLa.php';
kreirajKorisnike();
session_start();

if (!isset($_SESSION["WebDiP"]) || !isset($_SESSION["korisnik"]) || $_SESSION["tip"] < 2) {
    header("Location: error.php?e=2");
    exit();
}
$naziv="Korisnici";
include_once '_header.php';
?>

<!DOCTYPE html>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script> 
<script src="http://datatables.net/download/build/nightly/jquery.dataTables.js"></script>
<script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<link href="http://datatables.net/download/build/nightly/jquery.dataTables.css" rel="stylesheet" type="text/css">   
<script src="js/aktivacija.js"></script> 

<div class="row">
    <h3> Popis aktiviranih korisnika </h3>
    <div class="large-12 columns">
        <section id="generiranje2">

        </section>           
    </div>
</div>

<div class="row">
    <h3> Popis neaktiviranih korisnika </h3>
    <div class="large-12 columns">
        <section id="generiranje">

        </section>           
    </div>
</div>



<?php include_once '_footer.php'; ?>