<?php
include_once 'kreiranjeXMLa.php';
kreirajKorisnike();
session_start();
include_once 'classes/baza.class.php';
$baza = new Baza();

if (!isset($_SESSION["WebDiP"]) || !isset($_SESSION["korisnik"]) || $_SESSION["tip"] < 2) {
    header("Location: error.php?e=2");
    exit();
}

if (isset($_POST['slanje'])) {
    $id_korisnik = $_POST['korisnik'];

    $upit = "SELECT COUNT(*) as brojPrijava FROM log_sustava WHERE id_korisnik='$id_korisnik' AND tip_operacije='Prijava'";
    $rezultat = $baza->selectDB($upit);
    $brojPrijava = mysqli_fetch_array($rezultat);

    $upit = "SELECT COUNT(*) as brojPrijavaNE FROM korisnicka_sesija WHERE id_korisnika='$id_korisnik' AND prijava_uspjesna='0'";
    $rezultat = $baza->selectDB($upit);
    $brojOdjava = mysqli_fetch_array($rezultat);

    $upit = "SELECT COUNT(*) as brojOdobri FROM log_sustava WHERE id_korisnik='$id_korisnik' AND tip_operacije='UPDATE' AND radnja='Odobravanje unosa'";
    $rezultat = $baza->selectDB($upit);
    $brojUPDATE1 = mysqli_fetch_array($rezultat);

    $upit = "SELECT COUNT(*) as brojOdbaci FROM log_sustava WHERE id_korisnik='$id_korisnik' AND tip_operacije='UPDATE' AND radnja='Odbacivanje unosa'";
    $rezultat = $baza->selectDB($upit);
    $brojUPDATE2 = mysqli_fetch_array($rezultat);

    $upit = "SELECT COUNT(*) as brojInsert FROM log_sustava WHERE id_korisnik='$id_korisnik' AND tip_operacije='INSERT'";
    $rezultat = $baza->selectDB($upit);
    $brojINSERT = mysqli_fetch_array($rezultat);

    $upit = "SELECT COUNT(*) as brojUnos FROM log_sustava WHERE id_korisnik='$id_korisnik' AND tip_operacije='INSERT' AND radnja='Novi unos'";
    $rezultat = $baza->selectDB($upit);
    $brojINSERT1 = mysqli_fetch_array($rezultat);

    $upit = "SELECT COUNT(*) as brojRegija FROM log_sustava WHERE id_korisnik='$id_korisnik' AND tip_operacije='INSERT' AND radnja='Unos nove regije'";
    $rezultat = $baza->selectDB($upit);
    $brojINSERT2 = mysqli_fetch_array($rezultat);

    $upit = "SELECT COUNT(*) as brojTip FROM log_sustava WHERE id_korisnik='$id_korisnik' AND tip_operacije='INSERT' AND radnja='Unos novog tipa unosa'";
    $rezultat = $baza->selectDB($upit);
    $brojINSERT3 = mysqli_fetch_array($rezultat);

    $upit = "SELECT COUNT(*) as brojOdobrenih FROM zapis WHERE zapis_unio='$id_korisnik' AND stanje_zapisa='1'";
    $rezultat = $baza->selectDB($upit);
    $brojGRAF = mysqli_fetch_array($rezultat);

    $upit = "SELECT COUNT(*) as brojNeocjenjenih FROM zapis WHERE zapis_unio='$id_korisnik' AND stanje_zapisa='3'";
    $rezultat = $baza->selectDB($upit);
    $brojGRAF1 = mysqli_fetch_array($rezultat);

    $upit = "SELECT COUNT(*) as brojOdbacenih FROM zapis WHERE zapis_unio='$id_korisnik' AND stanje_zapisa='2'";
    $rezultat = $baza->selectDB($upit);
    $brojGRAF2 = mysqli_fetch_array($rezultat);
}

$naziv="Statistika po korisnicima";
include '_header.php'
?>

<script src="js/statistikaPoKorisnicima.js"></script>

<div class="large-3 row">
    <form class="large-12 columns" method="post" name="aktivacija" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <fieldset class="pozadina">
            <div class="row">
                <div class="large-12 columns">
                    <label>Odaberite korisnika</label>
                    <select name="korisnik" id="korisnik">
                        <option selected value="-1">Odaberite čiju statistiku želite vidjeti</option>
                    </select>         
                </div>
            </div>
            <div class="row">
                <div class="large-12 columns">
                    <input type="submit" value="  Pokaži  "  class="button radius tiny expand" name="slanje"/>
                </div>      
            </div>
        </fieldset>
    </form>
</div>

<script src='js/Chart.min.js'></script>

<div class="row" style="display: 
<?php
if (isset($_POST['slanje'])) {
    echo 'box';
}
else{
    echo 'none';
}
?>">
    <h3>Korisnikove statistike</h3>
    <div class="large-12 columns">
        <div class="row">
            <div class="large-6 columns">
                <div class="panel">
                    <h4>Prijave</h4>
                    <h5>Broj svih prijava</h5>
                    <h6><?php echo $brojPrijava['brojPrijava'] + $brojOdjava['brojPrijavaNE'] ?></h6>
                    <h5>Broj uspješnih prijava</h5>
                    <h6><?php echo $brojPrijava['brojPrijava'] ?></h6>
                    <h5>Broj neuspješnih prijava</h5>
                    <h6><?php echo $brojOdjava['brojPrijavaNE'] ?></h6>
                    <hr>
                    <h4>Omjer</h4>
                    <canvas id="pita4" width="400" height="400"></canvas>
                    <h3><span id="prvaboja">Uspjesne </span><span id="drugaboja">Neuspjesne </span></h3>                   
                    <script>
                        var data = [
                            {
                                value: <?php echo $brojPrijava['brojPrijava'] ?>,
                                color: "#F38630"
                            },
                            {
                                value: <?php echo $brojOdjava['brojPrijavaNE'] ?>,
                                color: "#E0E4CC"
                            },
                        ]
                        var pieOptions = {
                            segmentShowStroke: false,
                            animateScale: true
                        }

                        var pita4 = document.getElementById("pita4").getContext("2d");
                        new Chart(pita4).Pie(data, pieOptions);
                    </script>
                </div>

                <div class="panel">                   
                    <h4>Broj novih unosa</h4>
                    <h5>Koliko je puta unosio u bazu</h5>
                    <h6><?php echo $brojINSERT['brojInsert'] ?></h6>
                    <h5>Broj novih unosa</h5>
                    <h6><?php echo $brojINSERT1['brojUnos'] ?></h6>
                    <h5>Broj unosa novih regija</h5>
                    <h6><?php echo $brojINSERT2['brojRegija'] ?></h6>
                    <h5>Broj unosa novih tipova</h5>
                    <h6><?php echo $brojINSERT3['brojTip'] ?></h6>
                    <hr>
                    <h4>Omjer</h4>
                    <canvas id="pita2" width="400" height="400"></canvas>
                    <h3><span id="prvaboja">Unosi </span><span id="drugaboja">Regije </span><span id="trecaboja">Tipovi unosa</span></h3>                   
                    <script>
                        var data = [
                            {
                                value: <?php echo $brojINSERT1['brojUnos'] ?>,
                                color: "#F38630"
                            },
                            {
                                value: <?php echo $brojINSERT2['brojRegija'] ?>,
                                color: "#E0E4CC"
                            },
                            {
                                value: <?php echo $brojINSERT3['brojTip'] ?>,
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
            </div>
            <div class="large-6 columns">
                <div class="panel">
                    <h4>Korisnikovi unosi</h4>
                    <h5>Broj odobrenih unosa</h5>
                    <h6><?php echo $brojGRAF['brojOdobrenih'] ?></h6> 
                    <h5>Broj neocjenjenih unosa</h5>
                    <h6><?php echo $brojGRAF1['brojNeocjenjenih'] ?></h6> 
                    <h5>Broj neocjenjenih unosa</h5>
                    <h6><?php echo $brojGRAF2['brojOdbacenih'] ?></h6> 
                    <hr>
                    <h4>Omjer</h4>
                    <canvas id="pita" width="400" height="400"></canvas>
                    <h3><span id="prvaboja">Odobreni </span><span id="drugaboja">Neocjenjeni </span><span id="trecaboja">Odbačeni </span></h3>                   
                    <script>
                        var data = [
                            {
                                value: <?php echo $brojGRAF['brojOdobrenih'] ?>,
                                color: "#F38630"
                            },
                            {
                                value: <?php echo $brojGRAF1['brojNeocjenjenih'] ?>,
                                color: "#E0E4CC"
                            },
                            {
                                value: <?php echo $brojGRAF2['brojOdbacenih'] ?>,
                                color: "#69D2E7"
                            },
                        ]
                        var pieOptions = {
                            segmentShowStroke: false,
                            animateScale: true
                        }

                        var pita = document.getElementById("pita").getContext("2d");
                        new Chart(pita).Pie(data, pieOptions);
                    </script>
                </div>
                <div class="panel">
                    <h4>Broj ažuriranja</h4>
                    <h5>Koliko je puta ažurirao bazu</h5>
                    <h6><?php echo $brojUPDATE1['brojOdobri'] + $brojUPDATE2['brojOdbaci'] ?></h6>
                    <h5>Broj odobrenih zapisa</h5>
                    <h6><?php echo $brojUPDATE1['brojOdobri'] ?></h6>
                    <h5>Broj odbačenih zapisa</h5>
                    <h6><?php echo $brojUPDATE2['brojOdbaci'] ?></h6>                   
                    <hr>
                    <h4>Omjer</h4>
                    <canvas id="pita3" width="400" height="400"></canvas>
                    <h3><span id="prvaboja">Odobrenih </span><span id="drugaboja">Odbaceni </span></h3>                   
                    <script>
                        var data = [
                            {
                                value: <?php echo $brojUPDATE1['brojOdobri'] ?>,
                                color: "#F38630"
                            },
                            {
                                value: <?php echo $brojUPDATE2['brojOdbaci'] ?>,
                                color: "#E0E4CC"
                            },
                        ]
                        var pieOptions = {
                            segmentShowStroke: false,
                            animateScale: true
                        }

                        var pita3 = document.getElementById("pita3").getContext("2d");
                        new Chart(pita3).Pie(data, pieOptions);
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>



<?php include '_footer.php'; ?>
