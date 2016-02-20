<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Prijava</title>
        <link rel="stylesheet" href="css/foundation.css" />
        <link rel="stylesheet" href="css/thop.css" />
        <script src="js/vendor/modernizr.js"></script>
    </head>
    <body>


        <header>
            <div class="large-4 row">
                <div class="large-12 columns">
                    <h1>
                        <?php
                        $e = $_GET["e"];
                        $message = "";
                        switch ($e) {
                            case -4: $message = "Račun bannan.";
                                break;
                            case -3: $message = "Račun nije aktiviran.";
                                break;
                            case -2: $message = "Račun deaktiviran zbog previše neuspjelih prijava.";
                                break;
                            case -1: $message = "Korisnik ne postoji.";
                                break;
                            case 0: $message = "Neispravno korisničko ime/lozinka.";
                                break;
                            case 2: $message = "Neautorizirani pristup.";
                                break;
                            case 3: $message = "Nemate dopustenje za aktivaciju korisnika.";
                                break;
                            case 4: $message = "Operacija nad bazom nije uspjela.";
                                break;
                            case 5: $message = "Nemate dopustenje za promjenu tih podataka.";
                                break;
                            case 6: $message = "Nisu uneseni svi podatci.";
                                break;
                            case 7: $message = "Zauzeta e-mail adresa.";
                                break;
                            case 8: $message = "Zauzeto korisničko ime.";
                                break;
                            case 9: $message = "Istekao aktivacijski link.";
                                break;
                            case 10: $message = "Neispravno unesen captcha.";
                                break;
                            case 11: $message = "Korisničko ime ne postoji.";
                                break;
                            default: $message = "Nepoznata pogreska.";
                                break;
                        }
                        print $message;
                        ?>    
                    </h1>

                </div>
            </div>
            <div class="large-4 row">
                <a class="button tiny radius round expand" href='prijava.php'>Povratak na prijavu</a>
                <a class="button tiny radius round expand" href='registracija.php'>Povratak na registraciju</a>
            </div>
        </header>



        <?php include_once '_footer.php'; ?>

    </body>
</html>
