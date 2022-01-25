<?php

include("classes/DomDocumentParser.php");

$alreadyCrawled = array();
$crawling = array();



    function createLink($src, $url){

            $scheme = parse_url($url)["scheme"];  //  http
            $host = parse_url($url)["host"];  //  www....com


        if(substr($src , 0, 2) == "//"){
            $src = $scheme . ":" . $src;
        }
            else if (substr($src , 0, 1) == "/"){
                $src = $scheme . "://" . $host . $src;

            }
         
        return $src;
    }



    function getDetails($url){

        $parser = new DomDocumentParser($url);

        $titleArray = $parser->getTitleTags();

        if(sizeof($titleArray) == 0 || $titleArray->item(0) == NULL){
            return;
        }


        $title = $titleArray->item(0)->nodeValue;
        $title = str_replace("\n", "",$title);

        if($title == ""){
            return;
        }

        $description = "";
        $keywords = "";

        $metasArray = $parser->getMetaTags();

        foreach($metasArray as $meta){
            if ($meta->getAttribute("name") == "description" ){
                $description = $meta->getAttribute("content");
            }

            if ($meta->getAttribute("name") == "keyword" ){
                $keywords = $meta->getAttribute("content");
            }

        }

        $description = str_replace("\n", "",$description);
        $keywords = str_replace("\n", "",$keywords);

        echo " ..$description <br>----$keywords ";


    }




    function followLinks($url){

        global $alreadyCrawled;
        global $crawling;


        $parser = new DomDocumentParser($url);
        
        $linkList = $parser->getLinks();

        foreach($linkList as $link){
            $href = $link->getAttribute("href");

            if((strpos($href , "#") !== false) || (substr($href , 0, 1) == "?")) {
                continue;
            }
            else if(substr($href , 0, 11) == "javascript:"){
                continue;
            }
            
            $href  = createLink($href , $url );

        

            if( !in_array($href, $alreadyCrawled ) ){
                $alreadyCrawled[] = $href;
                $crawling[] = $href;


                getDetails($href);
            }
            else return;

            
        }


        array_shift($crawling);
        foreach($crawling as $site){
            followLinks($site);
        
        }


    }

$startUrl = "https://www.python.org/";
followLinks($startUrl);


?>