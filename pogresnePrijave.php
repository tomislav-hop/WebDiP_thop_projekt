<?php
include_once 'kreiranjeXMLa.php';
kreirajPrijave();
include_once 'classes/baza.class.php';
$baza = new Baza();
session_start();

if (!isset($_SESSION["WebDiP"]) || !isset($_SESSION["korisnik"]) || $_SESSION["tip"] < 2) {
    header("Location: error.php?e=2");
    exit();
}

$upit="SELECT COUNT(*) as brojPrijava FROM korisnicka_sesija WHERE prijava_uspjesna='1'";
$rezultat = $baza->selectDB($upit);
$brojPrijava = mysqli_fetch_array($rezultat);

$upit="SELECT COUNT(*) as brojNePrijava FROM korisnicka_sesija WHERE prijava_uspjesna='0'";
$rezultat = $baza->selectDB($upit);
$brojNePrijava = mysqli_fetch_array($rezultat);

$naziv="Statistika za prijave";
include '_header.php'
?>
<script src='js/Chart.min.js'></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script> 
<script src="http://datatables.net/download/build/nightly/jquery.dataTables.js"></script>
<script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<link href="http://datatables.net/download/build/nightly/jquery.dataTables.css" rel="stylesheet" type="text/css">   
<script src="js/popisPrijava.js"></script> 
<fieldset class="row pozadina">
    <div class="row">
        <ul class="button-group columns large-12">
            <li class="columns large-4"><input id="prikaziuspjeh" type="button" class="button  tiny expand" value="Prikazi samo uspješne"></li>
            <li class="columns large-4"><input id="prikazineuspjeh" type="button" class="button  tiny expand" value="Prikaži samo neuspješne"></li>
        </ul>
    </div>


</fieldset>
<div class="row">
    <div class="large-12 columns">
        <section id="generiranje">

        </section>  
        <hr>
    </div>
</div>


<div class='row'>
    <h4>Omjer prijava</h4>
    <canvas id="pita2" width="400" height="400"></canvas>
    <h3><span id="prvaboja">Uspješne prijave</span><span id="trecaboja">Neuspješne prijave</span></h3>                   
    <script>
        var data = [
            {
                value: <?php echo $brojPrijava['brojPrijava'] ?>,
                color: "#F38630"
            },
            {
                value: <?php echo $brojNePrijava['brojNePrijava'] ?>,
                color: "#69D2E7"
            },
        ]
        var pieOptions = {
            segmentShowStroke: false,
            animateScale: true
        }

        var pita = document.getElementById("pita2").getContext("2d");
        new Chart(pita).Pie(data, pieOptions);
    </script>
</div>


<?php include '_footer.php'; ?>






