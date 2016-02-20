<?php
session_start();


$naziv="Dokumentacija";
include '_header.php'
?>




<div class="row">
    <h2>Opis projektnog zadatka</h2>
    <section>
        <h4>Kratak opis projekta:</h4>
        Sustav služi za katalogizaciju i kreiranje repozitorija materijala o dijalektu/ima, arhaičnim riječima i 
        tradicionalnim običajima nekog kraja. Svaki od unosa može biti dodatno opisan sa vanjskim resursima 
        poput  wiki  unosa,  slike  ili  galerije  slike  te  audio  zapisa  (koji  se  mogu  naknadno  pregledavati  i 
        pretraživati). 
        <hr>
        <h3>Uloge:</h3>
        <ul>
            <li>Neregistrirani korisnik</li>
            <li>Etnograf (Registrirani korisnik)</li>
            <li>Moderator regije</li>
            <li>Administrator</li>
        </ul>
        <hr>
        <h3>Detaljne upute:</h3>
        <hr>
        <h4>Administrator</h4> 
        <ul>
            <li>Kreira regije čiji artefakti se skupljaju te svakoj regiji dodaje moderatore. </li>
            <li>Administrator vidi statistiku korištenja sustava, pogrešnih/ispravnih prijava, po korisnicima i 
                vremenskom periodu (od - do).</li>
            <li>Definira tipove unosa koji su mogući (riječ i njeno značenje, slika predmeta, audio zapis, …). </li>
            <li>Vidi popis svih odobrenih zapisa i šalje mail svim korisnicima  čiji unosi su odobreni od strane 
                moderatora.</li>
        </ul>


        <h4>Moderator</h4> 
        <ul>
            <li>Svaki moderator regije može odobriti ili  odbaciti  zapis podataka o artefaktu  u toj regiji.  Tek 
                nakon odobrenja od strane moderatora unos postaje vidljiv ostalim korisnicima. </li>
            <li>Prilikom  odobravanja  ukoliko  se  radi  o  unosu  multimedijalnog  podatka  (ton,  galerije  slika
                (min 3)), obavezno je dodavanje samog multimedijalnog resursa. </li>
            <li>Moderator može vidjeti popis najaktivnijih korisnika, zadnjih N  zahtjeva.  Korisnike koji unose 
                netočne podatke  u njemu dodijeljenoj regiji može blokirati unos. </li>
            <li>Moderator  vidi  statistiku  unosa  po  korisnicima  i  tipu  artefakta,  artefakti  po  regijama.  I  svi 
                pregledi se baziraju na vremenskom periodu (od - do).</li>
        </ul>


        <h4>Registrirani korisnik</h4>
        <ul>
            <li>Može dodavati zapise u svaku regiju. Svaki zapis je opisan nazivom, sadržajem. </li>
            <li>Svaki od unosa je dodijeljen  mjestu unutar regije. Mjesta se odabiru sa popisa svih dostupnih 
                iz  baze.  Ukoliko  navedeno  mjesto  ne  postoji  u  bazi,  ono  se  automatski  dodaje  prilikom 
                odobravanja unosa od strane moderatora. </li>
            <li>Vidi statistiku svojih unosa zapisa po regiji.</li>
        </ul>

        <h4>Neregistrirani korisnik</h4>
        <ul>
            <li>može vidjeti popis regija i nazive unosa u svaku od regija.  </li>
        </ul>
    </section>
    <br>
    <section>
        <h2>ERA model</h2>
        <img src="img/era.png">
    </section>
    <section>
        <h2>Navigacijski dijagram</h2>
        <img src="img/WebDIPv2.png">
    </section>
    <section>
        <h2>Popis korištenih tehnologija i alata</h2>
        <ul>
            <li>PHP</li>
            <li>jQuery</li>
            <li>Foundation</li>
            <li>Netbeans</li>
            <li>Notepad++</li>
        </ul>
    </section>
    
</div>




<?php include '_footer.php'; ?>
