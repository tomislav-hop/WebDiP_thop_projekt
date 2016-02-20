<?php
include_once 'classes/baza.class.php';
$baza = new Baza();
$aktivirano = 0;




if (isset($_POST['slanje'])) {

    $korisnicko_ime = $_POST['korisnicko_ime'];
    $aktivacija = $_POST['aktivacija'];

    $upit = "select last_update from korisnik where korime='$korisnicko_ime' and aktivacijski_kod='$aktivacija'";
    $rezultat = $baza->selectDB($upit);

    $red = $rezultat->fetch_array();
    $vrijeme = $red['last_update'];
    $vrijeme_na_bazi = new DateTime($vrijeme);
    $vrijeme_na_bazi2 = $vrijeme_na_bazi->getTimestamp();

    $sad = new DateTime();
    $vrijeme_trenutno = $sad->getTimestamp();


    //86400 = 24*60*60
    if (($vrijeme_trenutno - $vrijeme_na_bazi2) < 86400) {

        $upit = "UPDATE korisnik SET aktiviran='1' WHERE korime='$korisnicko_ime' and aktivacijski_kod='$aktivacija'";
        $baza->updateDB($upit);

        $upit = "SELECT id_korisnik FROM korisnik where korime = '" . $korisnicko_ime . "' and aktivacijski_kod = '" . $aktivacija . "'";
        $rezultat = $baza->selectDB($upit);
        list($id_korisnika) = mysqli_fetch_array($rezultat);
        if ($rezultat->num_rows != 0) {
            $aktivirano = 1;
            $uspjeh = "INSERT INTO log_sustava VALUES (default, '$id_korisnika', now(), 'Aktivacija racuna', 'Novi unos')";
            $baza->updateDB($uspjeh);
        } else {
            $aktivirano = 2;
        }
    } else {
        header("Location: error.php?e=9");
    }
}
?>


<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Aktivacija</title>
        <link rel="stylesheet" href="css/foundation.css" />
        <link rel="stylesheet" href="css/thop.css" />
        <script src="js/vendor/modernizr.js"></script>
    </head>
    <body>

        <header>
            <div class="large-3 row">
                <h1>Autentifikacija računa</h1>
                <hr/>
            </div>
        </header>

        <div class="large-2 row">
            <form class="large-12 columns" method="post" name="aktivacija" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <fieldset class="pozadina">
                    <div class="row">
                        <div class="large-12 columns">
                            <label>Korisnicko ime</label>
                            <input type="text" name="korisnicko_ime" value='<?php echo $_GET["korIme"]; ?>'/>           
                        </div>
                    </div>
                    <div class="row">
                        <div class="large-12 columns">
                            <label>Unesite kod koji ste dobili na e-mail</label>
                            <input type="text" name="aktivacija" />           

                        </div>
                    </div>                
                    <div class="row">
                        <div class="large-12 columns">
                            <div class="large-6 columns">
                                <input type="submit" value="  Aktiviraj  "  class="button radius tiny expand" name="slanje"/>
                            </div>
                            <div class="large-6 columns">
                                <input type="reset"  value="  Očisti  " class="button radius tiny expand">
                            </div>
                        </div>
                    </div>


                </fieldset>
            </form>
            <div class="large-12 columns" style='display: 
            <?php
            if ($aktivirano == 0) {
                echo "none;";
            } else {
                echo "inline;";
            }
            ?>'>
                <div data-alert class="alert-box info">
                    <?php
                    if ($aktivirano == 1) {
                        echo "Račun uspješno aktiviran.";
                    } else {
                        echo "Račun nije aktiviran. Pokušate ponovno.";
                    }
                    ?>
                    <a href="prijava.php" class="close">&times;</a>
                </div>
            </div>
        </div>  

        <footer class="row">
            <div class="large-12 columns">
                <hr/>
                <div class="row">
                    <div class="large-6 columns">
                        <p>© Tomislav Hop</p>
                    </div>
                    <div class="large-6 columns">
                        <ul class="inline-list right">
                            <li><a href="#">Gmail</a></li>
                            <li><a href="#">FOIWebmail</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>

        <script src="js/vendor/jquery.js"></script>
        <script src="js/foundation.min.js"></script>
        <script>
            $(document).foundation();
        </script>
    </body>
</html>
