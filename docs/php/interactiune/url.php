<?php
define('URL', 'http://undeva.info:8080/oferta/jucarii/produs/?nume=Tux&marime=17#oferta');

// continutul trimis clientului va fi text obisnuit
header('Content-type: text/plain'); 

// divizarea unui URL pe componente ale unui tablou asociativ
$adresaWeb = parse_url(URL);

foreach(array_keys($adresaWeb) as $componenta) {
	printf("%s=%s\n", $componenta, $adresaWeb[$componenta]);
}

// procesam sirul de interogare (query_string al URL-ului)
// fiecare parametru va fi stocat in tabloul $parametri
parse_str($adresaWeb['query'], $parametri);

// marimea e corespunzatoare?
if ($parametri['marime'] < 13) {
	echo "Jucaria nu e in regula...\n";
} else {
	echo "Jucarie e in regula (" . $parametri['marime'] . ") si are numele " . $parametri['nume'] . ".\n";
}