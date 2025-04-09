<?php
/* Program PHP care invoca serviciul Web de
   prescurtare de URL-uri oferit de https://is.gd/

   Folosim libcurl (cURL) pentru a obtine reprezentarea XML
   a raspunsului oferit de serviciu.
   Documentul XML rezultat va avea forma generala:
   <output><shorturl>URL</shorturl></output>.

   Alte detalii sunt furnizate la https://is.gd/developers.php

   Tema: de tratat posibilele exceptii.

   Autor: Sabin-Corneliu Buraga (2012, 2014, 2016, 2017, 2021) -- https://profs.info.uaic.ro/~busaco/
   Ultima actualizare: 20 aprilie 2021
*/

define ('URL', 'https://is.gd/create.php?format=xml&url=profs.info.uaic.ro/~busaco');

echo '<p>Invoking Web service from <code>' . URL . '</code></p>';

$c = curl_init ();								 // initializam biblioteca
curl_setopt ($c, CURLOPT_URL, URL);              // stabilim URL-ul serviciului
curl_setopt ($c, CURLOPT_RETURNTRANSFER, true);  // rezultatul cererii va fi disponibil ca șir de caractere
curl_setopt ($c, CURLOPT_SSL_VERIFYPEER, false); // nu verificam certificatul digital
$res = curl_exec ($c);                           // executam cererea (se trimite via HTTP o cerere GET) 
curl_close ($c);								 // inchidem conexiunea cu serverul

// afisam raspunsul primit -- aici, un document XML generat de serviciul Web
echo '<p>Server response:</p>';
echo '<code>' . htmlentities ($res) . '</code>';

// procesam rezultatul via DOM
$doc = new DOMDocument ();
$doc->loadXML ($res);

// preluam continutul elementului <shorturl>
$urls = $doc->getElementsByTagName ('shorturl');
foreach ($urls as $url) {
   echo '<p>New short URL is <a href="' .
      $url->nodeValue . '">' . $url->nodeValue . '</a></p>';
}
?>