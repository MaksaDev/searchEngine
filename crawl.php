<?php

include("classes/DomDocumentParser.php");


    function followLinks($url){

        $parser = new DomDocumentParser($url);



    }

$startUrl = "http://www.fon.bg.ac.rs";
followLinks($startUrl);


?>