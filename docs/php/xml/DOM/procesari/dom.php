<?php
/* Un program PHP care proceseaza un document XML folosind modelul DOM
   (functioneaza pentru PHP 5+)
   
   Autor: Sabin-Corneliu Buraga (2004, 2007, 2011, 2020)
   Ultima actualizare: 24 martie 2020
*/     
// directorul unde e stocat documentul XML de prelucrat
define ('PATH', ''); 

// variabila globala indicand daca a fost modificat arborele DOM
$modified = 0;

try {
  // instantiem un obiect reprezentand arborele DOM
  $dom = new DomDocument;

  // incarcam documentul XML
  $dom->load (PATH . "projects.xml");

  // afisam informatii privitoare la proiecte
  $projs = $dom->getElementsByTagName("project");
  // procesam fiecare <project> in parte
  foreach ($projs as $proj) {
    // preluam nodurile <title>	si-l alegem pe primul
    $titles = $proj->getElementsByTagName("title");
    echo "<p>Proiect: <em>" . $titles[0]->nodeValue . "</em>";
    // verificam care e clasa proiectului
    if ($proj->hasAttribute("class")) {
      echo " de clasa " . $proj->getAttribute("class") . "</p>";
    }	
    else {
      echo " de clasa necunoscuta</p>";
      // nu exista atributul "class", il cream
      // implicit, proiectul e de clasa D :)
      $attr = $proj->setAttribute("class", "D");
      // marcam arborele DOM ca fiind modificat
      $modified = 1;
    }	
  }

  // daca DOM-ul a fost modificat, ii afisam reprezentarea text
  if ($modified) {
    $xmldoc = $dom->saveXML();
    echo "<pre>" . htmlentities($xmldoc) . "</pre>";  	
  }
} 
catch (Exception $e) {
	die ("A survenit o exceptie...");
}
?>