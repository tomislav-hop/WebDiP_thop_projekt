<?php
include_once 'classes/prijava_odjava.class.php';

$tip_korisnika = $_SESSION['tip'];
?>



<div class="row">
    <nav class="top-bar" data-topbar >
        <ul class="title-area">
            <li class="name">
                <h1><a href="index.php">eEtno</a></h1>
            </li>
            <!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
            <li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
        </ul>

        <section class="top-bar-section">

            <!-- Left Nav Section -->
            <ul class="left">
                <li><a href="popisRegija.php">Popis regija</a></li>
                <li><a href="prijava.php">Prijava</a></li>
                <li><a href="registracija.php">Registracija</a></li>

                <li class="has-dropdown">
                    <a style="
                    <?php
                    if ($tip_korisnika > 0) {
                        echo "display:block;";
                    } else {
                        echo "display:none;";
                    }
                    ?>" href="#">Unosi</a>
                    <ul class="dropdown">
                        <li><a href="noviUnos.php">Novi unos</a></li>
                        <li><a href="regije.php">Pregled po regijama</a></li>
                        <li><a href="mjesta.php">Pregled po mjestima</a></li>                       
                        <li><a style="
                            <?php
                            if ($tip_korisnika > 1) {
                                echo "display:block;";
                            } else {
                                echo "display:none;";
                            }
                            ?>" href="obradaUnosa.php">Obrada unosa</a></li>
                        <li><a style="
                            <?php
                            if ($tip_korisnika > 1) {
                                echo "display:block;";
                            } else {
                                echo "display:none;";
                            }
                            ?>" href="galerija.php">Galerija slika</a></li>
                        <li><a style="
                            <?php
                            if ($tip_korisnika > 2) {
                                echo "display:block;";
                            } else {
                                echo "display:none;";
                            }
                            ?>" href="novaRegija.php">Kreiranje nove regije</a></li>
                        <li><a style="
                            <?php
                            if ($tip_korisnika > 2) {
                                echo "display:block;";
                            } else {
                                echo "display:none;";
                            }
                            ?>" href="noviTipUnosa.php">Kreiranje novog tipa unosa</a></li>
                    </ul>
                </li>

                <li class="has-dropdown">
                    <a style="
                    <?php
                    if ($tip_korisnika > 0) {
                        echo "display:block;";
                    } else {
                        echo "display:none;";
                    }
                    ?>" href="#">Korisničke stranice</a>
                    <ul class="dropdown">
                        <li><a href="uredjivanjeProfila.php">Uređivanje profila</a></li>
                        <li><a href="mojaStatistika.php">Moja statistika</a></li>
                        <li><a href="mojiUnosi.php">Moji unosi</a></li>
                    </ul>
                </li>

                <li class="has-dropdown">
                    <a style="
                    <?php
                    if ($tip_korisnika > 1) {
                        echo "display:block;";
                    } else {
                        echo "display:none;";
                    }
                    ?>" href="#">Statistika</a>
                    <ul class="dropdown">
                        <li><a href="poKoristnicima.php">Po korisnicima</a></li>
                        <li><a href="poTipuArtefakta.php">Po tipu artefakta</a></li>
                        <li><a href="artefaktiPoRegijama.php">Artefakti po regijama</a></li>
                        <li><a style="
                            <?php
                            if ($tip_korisnika > 2) {
                                echo "display:block;";
                            } else {
                                echo "display:none;";
                            }
                            ?>" href="koristenje.php">Korištenje sustava</a></li>
                        <li><a style="
                            <?php
                            if ($tip_korisnika > 2) {
                                echo "display:block;";
                            } else {
                                echo "display:none;";
                            }
                            ?>" href="pogresnePrijave.php">Prijave</a></li>
                    </ul>
                </li>

                <li class="has-dropdown">
                    <a style="
                    <?php
                    if ($tip_korisnika > 1) {
                        echo "display:block;";
                    } else {
                        echo "display:none;";
                    }
                    ?>" href="#">Upravljanje korisnicima</a>
                    <ul class="dropdown">
                        <li><a href="najaktivniji.php">Najaktivniji koristnici</a></li>
                        <li><a href="banKorisnika.php">Ban korisnika</a></li>
                        
                        <li><a style="
                            <?php
                            if ($tip_korisnika > 2) {
                                echo "display:block;";
                            } else {
                                echo "display:none;";
                            }
                            ?>" href="moderatori.php">Dodjeljivanje moderatora</a></li>
                        <li><a style="
                            <?php
                            if ($tip_korisnika > 2) {
                                echo "display:block;";
                            } else {
                                echo "display:none;";
                            }
                            ?>" href="korisnici.php">Aktivacija/Deaktivacija korisnika</a></li>
                    </ul>
                </li>



                <li><a style="
                    <?php
                    if ($tip_korisnika > 0) {
                        echo "display:block;";
                    } else {
                        echo "display:none;";
                    }
                    ?>" href="odjava.php">Odjava</a></li>

            </ul>
        </section>
    </nav>
</div>

<script src="js/vendor/jquery.js"></script>
<script src="js/foundation.min.js"></script>
<script>
    $(document).foundation();
</script>