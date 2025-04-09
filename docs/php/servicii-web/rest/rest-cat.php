<?php
/* Un program PHP ce realizeaza o cerere GET spre serviciul Web REST
   oferind o imagine (reprezentare JPEG) corespunzatoare unui cod de stare HTTP.
   Se recurge la biblioteca LibcURL oferita de mediul PHP.

   De exemplu, pentru <https://http.cat/200> se obtine o imagine corespunzatoare
   codului 200 OK.

   Autor: Sabin-Corneliu Buraga (2020, 2021) -- https://profs.info.uaic.ro/~busaco/

   Ultima actualizare: 20 aprilie 2021
*/

define ('URL', 'https://http.cat/301'); // definim codul de stare HTTP (301) pentru care vom obtine o imagine nostima

$c = curl_init (URL); // initializam libcurl, indicand URL-ul serviciului

// tabloul optiunilor de conectare la serverul Web
$opt = [ CURLOPT_RETURNTRANSFER => true,  // datele vor fi disponibile ca sir de caractere
         CURLOPT_SSL_VERIFYPEER => false, // nu verificam certificatul digital
         CURLOPT_CONNECTTIMEOUT => 10,    // timp de asteptare (in secunde) a stabilirii conexiunii
         CURLOPT_TIMEOUT        => 10,    // timp de asteptare (in secunde) a raspunsului
         CURLOPT_FAILONERROR    => true,  // codurile 4XX vor conduce la eroare
         CURLOPT_FOLLOWLOCATION => false  // nu se accepta redirectionari
       ];

curl_setopt_array ($c, $opt); // stabilim optiunile de realizare a cererii HTTP pe baza tabloului            
$res = curl_exec ($c); // executam cererea via metoda GET (comportament implicit)

$codHTTP = curl_getinfo ($c, CURLINFO_RESPONSE_CODE); // codul de stare HTTP intors de serverul serviciului Web
$tip = curl_getinfo ($c, CURLINFO_CONTENT_TYPE);      // tipul continutului oferit de serviciu

// am primit cu succes o imagine JPEG?
if ($codHTTP == 200 && $tip == 'image/jpeg') {
  header ('Content-Type: ' . $tip); // trimitem tipul MIME corespunzator (adica image/jpeg in acest caz)
  echo $res; // afisam reprezentarea resursei obtinute (aici, imaginea in format JPEG)
} else {
  http_response_code ($codHTTP); // s-a obtinut altceva, trimitem codul de stare intors de serviciu
  header ('Content-Type: text/plain');
  echo 'Status code: ' . $codHTTP;
  
}

curl_close ($c); // inchidem conexiunea cu serverul Web
