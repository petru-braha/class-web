<?php
   // Program PHP5 care proceseaza un document XML prin intermediul
   // interfetei simplificate SimpleXML
   // Autor: Sabin-Corneliu Buraga (2006, 2010, 2017)
   
   // incarcam documentul XML (tema: tratarea erorilor/exceptiilor)
   $xml = @simplexml_load_file("./projects.xml"); // ar putea fi folosit un URL real
   
   echo "<div style='color: green;'>";
   // afisam descrierile proiectelor de clasa A
   foreach ($xml->project as $proiecte) {
   	 if ($proiecte['class'] == 'A')
   	   echo '<p>' . $proiecte->desc . '</p>';
   }	
   echo "</div>";
   // similar, dar utilizand o expresie XPath
   foreach ($xml->xpath("//project[@class='A']") as $proiecte) {
   	 echo '<p>' . $proiecte->desc . '</p>';
   }
?>
