<?php
include_once 'kreiranjeXMLa.php';
kreirajStatistike();
session_start();
include_once 'classes/baza.class.php';
$baza = new Baza();

if (!isset($_SESSION["WebDiP"]) || !isset($_SESSION["korisnik"]) || $_SESSION["tip"] < 2) {
    header("Location: error.php?e=2");
    exit();
}

$upit = "SELECT COUNT(*) as brojArhaizama FROM zapis WHERE vrsta_zapisa='2' AND stanje_zapisa='1'";
$rezultat = $baza->selectDB($upit);
$brojArhaizama = mysqli_fetch_array($rezultat);

$upit = "SELECT COUNT(*) as brojDijalekt FROM zapis WHERE vrsta_zapisa='1' AND stanje_zapisa='1'";
$rezultat = $baza->selectDB($upit);
$brojDijalekt = mysqli_fetch_array($rezultat);

$upit = "SELECT COUNT(*) as brojObicaj FROM zapis WHERE vrsta_zapisa='3' AND stanje_zapisa='1'";
$rezultat = $baza->selectDB($upit);
$brojObicaj = mysqli_fetch_array($rezultat);

$naziv="Statistika po tipu artefakta";
include '_header.php'
?>

<script src="http://datatables.net/download/build/nightly/jquery.dataTables.js"></script>
<script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<link href="http://datatables.net/download/build/nightly/jquery.dataTables.css" rel="stylesheet" type="text/css">
<script src="js/statistikaPoTipu.js"></script>
<script src='js/Chart.min.js'></script>

<div class="row panel">
    <h3>Broj zapisa po vrsti</h3>
    Broj unosa o dijalektima: <strong><?php echo $brojDijalekt['brojDijalekt'] ?></strong><br>
    Broj unosa o arhaičnim riječima: <strong><?php echo $brojArhaizama['brojArhaizama'] ?></strong><br>
    Broj unosa o običajima: <strong><?php echo $brojObicaj['brojObicaj'] ?></strong><br>
    <hr>
    <canvas id="pita4" width="900" height="300"></canvas>
</div>
<script>


    var barChartData = {
        labels: ["Dijalekt", "Arhaične riječi", "Običaji"],
        datasets: [
            {
                fillColor: "#F38630",
                strokeColor: "#E0E4CC",
                data: [<?php echo $brojDijalekt['brojDijalekt'] ?>, <?php echo $brojArhaizama['brojArhaizama'] ?>, <?php echo $brojObicaj['brojObicaj'] ?>]
            }
        ]
    }

    new Chart(document.getElementById("pita4").getContext("2d")).Bar(barChartData);
</script>


<div class="row panel">
    <h3>Broj zapisa po tipu</h3>
    <div class="large-12 columns">
        <section id="generiranje">

        </section>           
    </div>
</div>


<?php include '_footer.php'; ?>
