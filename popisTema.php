<?php
include('classes/konfiguracija.php');
include_once 'classes/baza.class.php';
$baza = new Baza();

session_start();

$id_regija = $_GET['idRegije'];

if (!isset($_GET['p'])) {
    $page = 1;
} else {
    $page = $_GET['p'];
}

$sql = "SELECT * FROM zapis WHERE regija='{$id_regija}' AND stanje_zapisa='1'";

$start = ($page * $limit) - $limit;

$rezultat = $baza->selectDB($sql);
$brojredova = mysqli_num_rows($rezultat);

if ($brojredova > ($page * $limit)) {
    $next = ++$page;
}


$upit = $sql . " LIMIT {$start}, {$limit}";
$ispis = $baza->selectDB($upit);

$naziv = "Popis tema";
include '_header.php'
?>
<div class="row">
    <div class="large-12 columns">
        <div class="panel">
            <h1>Popis zapisa za odabranu regiju</h1>
        </div>
    </div>
</div>

<div class="row">

    <div class="large-12 columns wrap">

        <?php while ($row = mysqli_fetch_array($ispis)): ?>

       <a href="unos.php?idUnosa=<?php echo $row['id_zapis']?>">
            <div class="row item" id="item-<?php echo $row['id_zapis'] ?>">
                
                <hr/>
                <div class="large-10 columns">
                    <p><strong><?php echo $row['naziv'] ?></strong>  <?php echo $row['sadrzaj'] ?></p>

                </div>
                 
            </div>
           </a>
        <?php endwhile ?>
    </div>
    <?php if (isset($next)): ?>
        <div class="nav">
            <a class="button tiny radius round right" href="popisTema.php?idRegije=<?php echo $id_regija ?>&p=<?php echo $next ?>">Sljedeca</a>
        </div>
        
    <?php endif ?>
    <div class="nav" style="
        <?php
        if ($_GET['p'] == 1) {
            echo "display:none;";
        } else {
            echo "display:block;";
        }
        ?>">      
            <a class="button tiny radius round right" href="javascript:history.go(-1)">Prethodna</a>
        </div>
</div>




<?php include_once '_footer.php'; ?>
