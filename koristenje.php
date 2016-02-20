<?php
include_once 'kreiranjeXMLa.php';
kreirajDnevnik();
include_once 'classes/baza.class.php';
$baza = new Baza();
session_start();

if (!isset($_SESSION["WebDiP"]) || !isset($_SESSION["korisnik"]) || $_SESSION["tip"] < 2) {
    header("Location: error.php?e=2");
    exit();
}

$upit = "SELECT COUNT(*) as brojPrijava FROM log_sustava WHERE tip_operacije='Prijava'";
$rezultat = $baza->selectDB($upit);
$brojPrijava = mysqli_fetch_array($rezultat);

$upit = "SELECT COUNT(*) as brojUpdate FROM log_sustava WHERE tip_operacije='UPDATE'";
$rezultat = $baza->selectDB($upit);
$brojUpdate = mysqli_fetch_array($rezultat);

$upit = "SELECT COUNT(*) as brojInsert FROM log_sustava WHERE tip_operacije='INSERT'";
$rezultat = $baza->selectDB($upit);
$brojInsert = mysqli_fetch_array($rezultat);

$upit = "SELECT COUNT(*) as brojBan FROM log_sustava WHERE tip_operacije='BAN'";
$rezultat = $baza->selectDB($upit);
$brojBan = mysqli_fetch_array($rezultat);

$upit = "SELECT COUNT(*) as brojOdjava FROM log_sustava WHERE tip_operacije='Odjava'";
$rezultat = $baza->selectDB($upit);
$brojOdjava = mysqli_fetch_array($rezultat);

$naziv="Korištenje sustava";
include '_header.php'
?>

<script src="http://datatables.net/download/build/nightly/jquery.dataTables.js"></script>
<script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<link href="http://datatables.net/download/build/nightly/jquery.dataTables.css" rel="stylesheet" type="text/css">   
<script src="js/koristenjeSustava.js"></script>
<script src='js/Chart.min.js'></script>

<div class="row">
    <div class="large-12 columns">
        <section id="generiranje">

        </section>
        <hr>
        <div class="panel">            
            <canvas id="pita4" width="900" height="300"></canvas>
        </div>
        <script>


            var barChartData = {
                labels: ["Prijave", "Ažuriranja", "Unosi", "Banovi", "Odjave"],
                datasets: [
                    {
                        fillColor: "#F38630",
                        strokeColor: "#E0E4CC",
                        data: [<?php echo $brojPrijava['brojPrijava'] ?>, <?php echo $brojUpdate['brojUpdate'] ?>, <?php echo $brojInsert['brojInsert'] ?>, <?php echo $brojBan['brojBan'] ?>, <?php echo $brojOdjava['brojOdjava'] ?>]
                    }
                ]
            }

            new Chart(document.getElementById("pita4").getContext("2d")).Bar(barChartData);
        </script>
    </div>
</div>


<?php include '_footer.php'; ?>
