<?php
session_start();

if (!isset($_SESSION["WebDiP"]) || !isset($_SESSION["korisnik"]) || $_SESSION["tip"] < 2) {
    header("Location: error.php?e=2");
    exit();
}

$dir = "img/";
$ispis = "";
$formati = array("jpg", "png", "gif", "bmp");

if (is_dir($dir)) {
    if ($dh = opendir($dir)) {
        while (($file = readdir($dh)) !== false) {
            $regex = '/'.implode('|', $formati).'/';
            if (preg_match($regex, $file)) {
                $putanja = $dir . $file;
                $ispis .= "<li><a href='" . $putanja . "'><img width='100px' height='100px' src='" . $putanja . "'></a></li>";
            }
        }
        closedir($dh);
    }
}

$naziv="Galerija";
include '_header.php';
?>



<body>
    <div class="row">
        <h3>Galerija slika</h3>
        <hr>
        <ul class="clearing-thumbs" data-clearing>
            <?php echo $ispis; ?>
        </ul>


    </div>
    <script src="js/vendor/jquery.js"></script>
    <script src="js/foundation/foundation.js"></script>
    <script src="js/foundation/foundation.clearing.js"></script>
    <!-- Other JS plugins can be included here -->

    <script>
        $(document).foundation();
    </script>




</body>


<?php include '_footer.php'; ?>
