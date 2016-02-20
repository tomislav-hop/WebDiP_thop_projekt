<?php
session_start();
$naziv="Početna";
include '_header.php'

?>
<div class="row">
    <div class="large-12 columns" role="content">
        <article>
            <h3><a href="prijava.php">Dobro došli na eEtno !!!</a></h3>           

            <div class="row">
                <div class="large-6 columns">
                    <p>Ovaj sustav služi za katalogizaciju i kreiranje repozitorija materijala o dijalektu/ima, arhaičnim riječima i tradicionalnim običajima nekog kraja. </p>
                    <p>Ako se odlučite registrirati dobivate mogućnosti dodavanje novih zapisa na našu stranicu te time doprinjeti opširnosti i koristnosti naše stranice. Također registriranjem možete pratiti svoju statistiku.</p>
                </div>
                <div class="large-6 columns">
                    <img src="http://placehold.it/450x200&text=[img]"/>
                </div>
            </div>

            <p>Ako se pokažete kao vrijedan član naše zajednice možete postati moderator. Moderatori odobravaju i provjeravaju nove zapise koji su dodani te samim time određuju koliko je kvalitetna naša stranica. Naravno kao moderatori također imate posebne opcije kao statistika za sve korisnike i ban korisnika itd... </p>

            <p>Radujemo se svakom novom registriranom korisniku (Eetnografu) te želimo da naša stranica postane najtočniji izvor o našoj prošlosti i sadašnosti za sve generacije. Hvala i dobro došli!!!.</p>
        </article>     
    </div>
    <a class="button expand" href="dokumentacija.php">Dokumentacija</a>
</div>


<?php include '_footer.php' ?>