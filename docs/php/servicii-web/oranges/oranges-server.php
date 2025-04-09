<?php
/* Un server SOAP scris in PHP5 oferind metode de manipulare a sortimentelor de portocale

   Autor: Sabin-Corneliu Buraga - https://profs.info.uaic.ro/~busaco/
   Ultima actualizare: 06 aprilie 2020
*/

try {  
  // nu oferim nicio descriere WSDL, stabilim URI-ul serviciului (i.e. spatiul de nume)
  $server = new SoapServer(null, [ 'uri' => 'http://web.info/porto']);
  // adaugam metodele implementate
  $server->addFunction('getQuantity');
  // asteptam cereri SOAP
  $server->handle();
  } catch (SOAPFault $exception) {
  echo 'An exception occurred: ' . $exception;
}

// functie care furnizeaza cantitatea dintr-un sortiment de portocale
// (rezultatul intors va fi eterogen)
// folosirea valorii 'pink' nu este permisa
function getQuantity ($product) {
  global $server;
	// uzual, vom efectua o interogare SQL, o procesare de date (CSV, JSON, XML,...),
  // o invocare a altui serviciu Web etc.
	switch ($product) {
	 	 case 'gray': return 33;
	 	 case 'blue': return 74;
     // valoarea 'pink' e interzisa: se trimite clientului un mesaj SOAP fault
     case 'pink': $server->fault ('Invalid type', 'An orange cannot be pink!');
	 	 default    : return 'n/a';
	}
}
?>