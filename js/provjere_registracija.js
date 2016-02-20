function provjeri_korisnicko_ime()
{
    var vrijednost = document.getElementById("korisnicko_ime").value;
    var porukaGreske = "";
    var greska = false;

    document.getElementById("korisnicko_imeGreska").innerHTML = "";
    document.getElementById('korisnicko_imeGreska').style.display = 'none';

    $.get('http://arka.foi.hr/WebDiP/2013_projekti/WebDiP2013_023/data/korisnicka_imena.xml', function(xml) {
        $(xml).find('korisnik').each(function() {
            $korisnicko_ime = $(this).find('korisnicko_ime').text()
            if ($korisnicko_ime == vrijednost) {
                porukaGreske = "Korisničko ime zauzeto.";
                document.getElementById('korisnicko_imeGreska').style.display = 'block';
                document.getElementById("korisnicko_imeGreska").innerHTML += porukaGreske;

            }
        });
    });
}

function provjeriIme()
{
    var vrijednost = document.getElementById("ime").value;
    prvoSlovo = vrijednost[0];
    var porukaGreske = "";
    var greska = false;

    document.getElementById("imeGreska").innerHTML = "";
    document.getElementById('imeGreska').style.display = 'none';
    if (prvoSlovo !== prvoSlovo.toUpperCase())
    {
        porukaGreske = "Ime mora imati prvo slovo veliko.";
        greska = true;
    }
    var slova = /^[a-zA-Z]+$/;
    if (!vrijednost.match(slova))
    {
        porukaGreske += "  Ime sadrzi brojeve, a smije samo slova.";
        greska = true;

    }
    if (greska)
    {
        document.getElementById('imeGreska').style.display = 'block';
        document.getElementById("imeGreska").innerHTML += porukaGreske;
    }
    else {
        document.getElementById("imeGreska").innerHTML = "";
        document.getElementById('imeGreska').style.display = 'none';
    }
}

function provjeriPrezime()
{
    var vrijednost = document.getElementById("prezime").value;
    prvoSlovo = vrijednost[0];
    var porukaGreske = "";
    var greska = false;

    document.getElementById("prezimeGreska").innerHTML = "";
    document.getElementById('prezimeGreska').style.display = 'none';
    if (prvoSlovo !== prvoSlovo.toUpperCase())
    {
        porukaGreske = "Prezime mora imati prvo slovo veliko.";
        greska = true;
    }
    var slova = /^[a-zA-Z]+$/;
    if (!vrijednost.match(slova))
    {
        porukaGreske += "  Prezime sadrzi brojeve, a smije samo slova.";
        greska = true;
    }
    if (greska)
    {
        document.getElementById('prezimeGreska').style.display = 'block';
        document.getElementById("prezimeGreska").innerHTML += porukaGreske;
    }
    else {
        document.getElementById("prezimeGreska").innerHTML = "";
        document.getElementById('prezimeGreska').style.display = 'none';
    }
}

function potvrdaLozinke() {
    var lozinka = document.getElementById("lozinka1").value;
    var potvrdaLoz = document.getElementById("lozinka2").value;
    var porukaGreske = "";
    document.getElementById("lozinkaGreska2").innerHTML = "";
    document.getElementById("lozinkaGreska2").style.display = 'none';

    var potvrdaLozDuzina = potvrdaLoz.length;
    if (potvrdaLoz !== "") {
        if (potvrdaLozDuzina < 6) {
            porukaGreske = "Lozinka nije dovoljno dugačka treba sadržavati barem 6 znakova";
            document.getElementById('lozinkaGreska2').style.display = 'block';
            document.getElementById("lozinkaGreska2").innerHTML += porukaGreske;
        }
        else {
            document.getElementById("lozinkaGreska2").innerHTML = "";
            document.getElementById('lozinkaGreska2').style.display = 'none';
        }
    }

    if (lozinka !== "" && potvrdaLoz !== "") {
        if (lozinka != potvrdaLoz) {
            porukaGreske += "Lozinke ne odgovaraju! Obrišite unos i pokušajte ponovno.";
            document.getElementById('lozinkaGreska2').style.display = 'block';
            document.getElementById("lozinkaGreska2").innerHTML += porukaGreske;
        }
        else {
            document.getElementById("lozinkaGreska2").innerHTML = "";
            document.getElementById('lozinkaGreska2').style.display = 'none';
        }
    }
}

function duzinaLozinke() {
    document.getElementById("lozinkaGreska1").innerHTML = "";
    document.getElementById('lozinkaGreska1').style.display = 'none';

    var lozinka = document.getElementById("lozinka1").value;
    var lozinkaDuzina = lozinka.length;
    if (lozinka !== "") {
        if (lozinkaDuzina < 6) {
            var porukaGreske = "Lozinka nije dovoljno dugačka treba sadržavati barem 6 znakova";
            document.getElementById('lozinkaGreska1').style.display = 'block';
            document.getElementById("lozinkaGreska1").innerHTML += porukaGreske;
        }
        else {
            document.getElementById("lozinkaGreska1").innerHTML = "";
            document.getElementById('lozinkaGreska1').style.display = 'none';
        }
    }
}


function provjeraMaila() {
    var mail = document.getElementById("email").value;
    var regEx = /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/;
    document.getElementById("emailGreska").style.display = 'none';
    document.getElementById("emailGreska").innerHTML = "";
    if (mail !== "") {
        if (!mail.match(regEx)) {
            var porukaGreske = "Email nema dobar format";
            document.getElementById("emailGreska").style.display = 'block';
            document.getElementById("emailGreska").innerHTML += porukaGreske;
        }
        else {
            document.getElementById("emailGreska").style.display = 'none';
            document.getElementById("emailGreska").innerHTML = "";
        }
    }
}

function odabirSpola()
{
    var spol = document.getElementById("spol").value;
    document.getElementById("spolGreska").innerHTML = "";
    if (spol === "-1") {

        var porukaGreske = "Niste odabrali jednu od ponuđenih opcija!";
        document.getElementById("spolGreska").innerHTML += porukaGreske;
        this.className = "pogreska";
        this.focus();
    }
    else
        document.getElementById("spolGreska").innerHTML = "";
}

window.onload = function() {

    var provjeraKorIme = document.getElementById("korisnicko_ime");
    provjeraKorIme.addEventListener("blur", provjeri_korisnicko_ime);

    var provjeraIme = document.getElementById("ime");
    provjeraIme.addEventListener("blur", provjeriIme);

    var provjeraPrezime = document.getElementById("prezime");
    provjeraPrezime.addEventListener("blur", provjeriPrezime);

    var provjeraMail = document.getElementById("email");
    provjeraMail.addEventListener("blur", provjeraMaila);

    var provjeraLozinke1 = document.getElementById("lozinka1");
    provjeraLozinke1.addEventListener("blur", potvrdaLozinke);

    var duzinaProvjera = document.getElementById("lozinka1");
    duzinaProvjera.addEventListener("blur", duzinaLozinke);

    var provjeraLozinke2 = document.getElementById("lozinka2");
    provjeraLozinke2.addEventListener("blur", potvrdaLozinke);
};