<?php
// program PHP ce convertește în JSON diverse date preluate dintr-un flux de știri RSS
// autor: Sabin-Corneliu Buraga
// ultima actualizare: 05 aprilie 2021
// tema: tratarea excepțiilor & erorilor de procesare
define('FEED', 'programmable-web-feed.rss'); // poate fi folosit orice URI real 

$json = ''; // date JSON generate prin program
// procesăm simplicat datele XML (aici, cele dintr-un document RSS)
$xml = @simplexml_load_file(FEED);

// folosim o expresie XPath pentru a prelua prima știre din fluxul RSS
$news = $xml->xpath("//item")[0];

// obiectul JSON va include proprietățile 'title' (titlul știrii), 'link' (adresa Web) 
// și 'pubDate' (data publicării) preluate din documentul RSS
$json .= "{ \"title\" : \"" . $news->title . "\",";
$json .= " \"link\" : \"" . $news->link . "\",";
$json .= " \"date\" : \"" . $news->pubDate . "\" }"; 

// trimitem datele spre client folosind câmpul MIME (Media Type) adecvat
header("Content-type: application/json; charset=utf-8");
echo $json;
