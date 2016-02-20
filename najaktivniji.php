<?php
include_once 'kreiranjeXMLa.php';
kreirajStatistike3();
session_start();

if (!isset($_SESSION["WebDiP"]) || !isset($_SESSION["korisnik"]) || $_SESSION["tip"] < 2) {
    header("Location: error.php?e=2");
    exit();
}
$naziv="Najaktivniji korisnici";
include '_header.php'
?>
<script src="http://datatables.net/download/build/nightly/jquery.dataTables.js"></script>
<script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<link href="http://datatables.net/download/build/nightly/jquery.dataTables.css" rel="stylesheet" type="text/css">
<script src="js/najaktivniji.js"></script>


<div class="row panel">
    <h3>Broj zapisa po korisniku</h3>
    <div class="large-12 columns">
        <section id="generiranje">

        </section>           
    </div>
</div>

<?php include '_footer.php'; ?>
