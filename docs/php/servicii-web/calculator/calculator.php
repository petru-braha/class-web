<?php
/* Un client SOAP scris in PHP invocand operatii (metode) 
   expuse de un serviciu Web extern -- aici, un calculator minimal
   <http://www.dneonline.com/calculator.asmx> (implementat in .NET)

   Autor: Sabin-Corneliu Buraga - https://profs.info.uaic.ro/~busaco/
   Ultima actualizare: 06 aprilie 2020
*/
// adresa Web a serviciului   
define('WS_URL', 'http://www.dneonline.com/calculator.asmx');
// adresa Web a documentului WSDL descriind serviciul
define('WS_WSDL', 'http://www.dneonline.com/calculator.asmx?WSDL');
// spatiul de nume al serviciului Web apelat
define('WS_NS', 'http://tempuri.org/');

$numere = [ 33, 74 ]; // argumentele de intrare

try {
  $client = new SoapClient(WS_WSDL,     // folosim descrierea serviciului (WSDL) 
                [ 'location' => WS_URL, // adresa serviciului Web
                  'uri' => WS_NS        // spatiul de nume corespunzator serviciului Web apelat
		]
  );
  // invocăm metodele Add(), Multiply(), Divide() create "din zbor" 
  // pe baza specificatiei WSDL a serviciului SOAP;
  // furnizam 2 parametri incapsulati intr-un tablou asociativ
  // pentru a obține rezultatul operatiilor cu cele 2 numere intregi
  $opSuma = $client->Add( [ "intA" => $numere[0], "intB" => $numere[1] ]);
  $suma = $opSuma->AddResult; // preluăm rezultatul oferit de serviciu

  $opProdus = $client->Multiply( [ "intA" => $numere[0], "intB" => $numere[1] ]);
  $produs = $opProdus->MultiplyResult; // preluăm rezultatul oferit de serviciu

  $opDiv = $client->Divide( [ "intA" => $produs, "intB" => $suma ]);
  $div = $opDiv->DivideResult; // preluăm rezultatul oferit de serviciu

  // afisam rezultatul operatiilor aritmetice efectuate la distanta
  echo "<pre>$numere[0] &times; $numere[1] &divide; ( $numere[0] &plus; $numere[1] ) = $produs &divide; $suma = $div</pre>";

} catch (SOAPFault $e) { // eroare :(
  echo 'An exception occurred: ' . $e->faultstring;
}
