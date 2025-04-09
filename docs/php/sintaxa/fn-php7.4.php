<?php
/* Program PHP 7.4 ce ilustreaza folosirea functiilor anonime 
   specificate prescurtat via constructia fn. 

   Se recurge la functiile predefinite time() si date(), 
   pentru a obtine timpul curent si a-l formata conform dorintelor.
*/
// verificare stricta a tipurilor de date
declare(strict_types=1);
// trimitem clientului text neformatat
header('Content-type: text/plain'); 

// declararea prescurtata a unei functii anonime
// care are un argument de tip string la intrare si intoarce int
// (pentru corp, se permite o singura expresie; 'return' nu e permis)
$salută = fn(string $nume): int => printf("Salut %s! [la %s].\n", 
	$nume, date("j-m-Y H:i:s T", time()));

$salută('lume');
sleep(2); // asteptam 2 secunde...
$salută('Tuxy');

/* Un posibil rezultat:
Salut lume! [la 22-02-2021 01:37:59 PST].
Salut Tuxy! [la 22-02-2021 01:38:01 PST].
*/