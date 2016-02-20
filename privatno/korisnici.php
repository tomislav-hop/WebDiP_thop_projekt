<?php
include_once '../classes/baza.class.php';
$baza = new Baza();

$tablica = korisnik;

$upitAktivni = "select * from $tablica";

$podaci = $baza->selectDB($upitAktivni);

$ispis = "<table><thead><tr><th>Ime</th><th>Prezime</th><th>Korisničko ime</th><th>Lozinka</th><th>Vrsta</th><th>E-mail</th></thead>";
$ispis = $ispis . "<tbody>";

while ($red = $podaci->fetch_array()) {
    $ispis.="<tr>";
    $ispis.="<td>" . $red['ime'] . "</td>";
    $ispis.="<td>" . $red['prezime'] . "</td>";
    $ispis.="<td>" . $red['korime'] . "</td>";
    $ispis.="<td>" . $red['lozinka'] . "</td>";
    $ispis.="<td>" . $red['uloga_id'] . "</td>";
    $ispis.="<td>" . $red['email'] . "</td>";


    $ispis.="</tr>";
}

$ispis.="</tbody></table>";
include_once '../_headerHT.php';
?>

<div class="row">



    <?php echo $ispis; ?>




</div>

<script src="js/vendor/jquery.js"></script>
<script src="js/foundation.min.js"></script>
<script>
    $(document).foundation();
</script>

<?php include_once '../_footer.php'; ?>
