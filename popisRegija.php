<?php
session_start();

include_once 'kreiranjeXMLa.php';
kreirajRegije();
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$naziv = "Popis regija";
include '_header.php'
?>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script> 
<script src="http://datatables.net/download/build/nightly/jquery.dataTables.js"></script>
<script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<link href="http://datatables.net/download/build/nightly/jquery.dataTables.css" rel="stylesheet" type="text/css">   
<script src="js/ispisRegija.js"></script> 



<div class="row">
    <div class="large-12 columns">
        <section id="generiranje">

        </section>           
    </div>
</div>





<?php include '_footer.php' ?>