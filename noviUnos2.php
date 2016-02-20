<?php
include_once 'kreiranjeXMLa.php';
kreirajMjesta();
kreirajVrsteZapisa();
kreirajTipoveUnosa();
include_once 'classes/baza.class.php';
$baza = new Baza();
include_once 'classes/prijava_odjava.class.php';
session_start();

if (!isset($_SESSION["WebDiP"]) || !isset($_SESSION["korisnik"]) || $_SESSION["tip"] < 0) {
    header("Location: error.php?e=2");
    exit();
}

if (isset($_POST['slanje'])) {

    $naziv_unosa = $_POST['naziv'];

    $mjesto = $_POST['mjesta'];
    $regija = $_POST['regija'];
    $pomocniUpit = "SELECT id_mjesto FROM mjesto WHERE naziv='$mjesto'";

    $rezultat = $baza->selectDB($pomocniUpit);
    if ($rezultat->num_rows != 0) {
        list($id_mjesta) = mysqli_fetch_array($rezultat);
    } else {

        $pomocniUpit = "INSERT INTO mjesto VALUES (default, '$mjesto', '$regija','0')";
        $baza->updateDB($pomocniUpit);

        $pomocniUpit = "SELECT id_mjesto FROM mjesto WHERE naziv='$mjesto'";
        $rezultat = $baza->selectDB($pomocniUpit);
        list($id_mjesta) = mysqli_fetch_array($rezultat);
    }

    $zapis = $_POST['zapis'];
    $opis = $_POST['opis'];
    $unosi = $_SESSION['id'];
    $tip = $_POST['tip_unosa'];
    $vanjski = $_POST['vanjski_resurs'];
    $slike = "";


    $upit = "INSERT INTO zapis VALUES (default, '$naziv_unosa', '$opis', '3', now(), '$vanjski', '$unosi', '$id_mjesta', '$zapis', '$tip', '$regija', '$slike');";
    $baza->updateDB($upit);
    
    $id_korisnika = $_SESSION['id'];
    $uspjeh = "INSERT INTO log_sustava VALUES (default, '$id_korisnika', now(), 'INSERT', 'Novi unos')";
    $baza->updateDB($uspjeh);
}

$valid_formats = array("jpg", "png", "gif", "bmp");
$max_file_size = 1024*100; //100 kb
$path = "img/"; // gdje spremam
$count = 0;

$putanje_za_bazu="";

if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST"){
	// prolaz kroz sve fajlove
	foreach ($_FILES['files']['name'] as $f => $name) {     
	    if ($_FILES['files']['error'][$f] == 4) {
	        continue; //preskoci ako dojde do greske
	    }	       
	    if ($_FILES['files']['error'][$f] == 0) {	           
	        if ($_FILES['files']['size'][$f] > $max_file_size) {
	            $message[] = "$name is too large!.";
	            continue; //preskoci velike
	        }
			elseif( ! in_array(pathinfo($name, PATHINFO_EXTENSION), $valid_formats) ){
				$message[] = "$name is not a valid format";
				continue; // nije dobar format
			}
	        else{ // nema gresske pa si spremi 
	            if(move_uploaded_file($_FILES["files"]["tmp_name"][$f], $path.$name))
                            $putanje_za_bazu.="&".$path.$name;
	            $count++; //broj aplovdanih
	        }
	    }
	}
        $query = "UPDATE zapis SET slike='" . $putanje_za_bazu ."' WHERE naziv='$naziv_unosa'";
        $baza->updateDB($query);
        header("Location: regije.php");
}



$naziv = "Novi unos";
include '_header.php'
?>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script> 
<script src="http://datatables.net/download/build/nightly/jquery.dataTables.js"></script>
<script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<link href="http://datatables.net/download/build/nightly/jquery.dataTables.css" rel="stylesheet" type="text/css">   
<script src="js/mjesta.js"></script>


<div class="row">
    <div class="large-12 columns">
        <h3>Novi unos</h3>
        <p>Ovdje unesite sve detalje</p>

        <form method="post" name="noviUnos" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
            <input id="regija" name="regija" type="text" style="display: none" value="<?php echo $_GET['idRegije']; ?>">
            <div class="row">
                <div class="large-2 columns">
                    <label >Naziv</label>
                </div>
                <div class="large-10 columns">
                    <input name="naziv" type="text">
                </div>
            </div>
            <div class="row">
                <div class="large-2 columns">
                    <label> Mjesto</label>
                </div>
                <div class="large-10 columns">
                    <input class="formatiranjeDatalista" list="mjesta" name="mjesta">
                    <datalist id="mjesta">                      
                    </datalist>
                </div>
            </div>          
            <div class="row">
                <div class="large-2 columns">
                    <label> Vrsta zapisa</label>
                </div>
                <div class="large-10 columns">
                    <select name="zapis" id="zapis">
                        <option selected value="-1">Odaberite vrstu zapisa</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="large-2 columns">
                    <label> Tip unosa</label>
                </div>
                <div class="large-10 columns">
                    <select name="tip_unosa" id="tip_unosa">
                        <option selected value="-1">Odaberite tip unosa</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div  class="large-2 columns">
                    <label>Opis unosa</label>
                </div>
                <div  class="large-10 columns">
                    <textarea name="opis" rows="10"></textarea>
                </div>
            </div>
            <div class="row">
                <div class="large-2 columns">
                    <label >Odaberite slike</label>
                </div>
                <div class="large-10 columns">
                    <input type="file" id="file" name="files[]" multiple="multiple"/>

                </div>
            </div>
             <div class="row">
                <div class="large-2 columns">
                    <label >Vanjski resurs</label>
                </div>
                <div class="large-10 columns">
                    <input name="vanjski_resurs" type="text" placeholder="Wiki  unos,  slika ili audio  zapis">
                </div>
            </div>
            <input name="slanje" type="submit" value="Završi unos" class="large-4 radius button right">
        </form>
    </div>
</div>


<?php include '_footer.php' ?>
