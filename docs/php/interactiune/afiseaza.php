<!DOCTYPE html>
<html>
<head>
<title>Preluare identitate + varsta pe baza datelor din formular</title>
<style>
body {
  width: 20em;
  font-family: sans-serif;
}
.mesaj {
  color: red;
  font-weight: bold;
}
</style>
</head>
<body>
<?php 
/* Program PHP scufundat intr-un document HTML, 
   folosit la exemplificarea preluarii datelor receptionate 
   via un formular Web -- exemplu de cod de tip spaghetti (nerecomandat!)
   
   Autor: Sabin-Corneliu Buraga - https://profs.info.uaic.ro/~busaco/
   2014, 2015, 2017, 2019, 2020

   Ultima actualizare: 25 februarie 2020 
*/
   
   if (!$_REQUEST["nume"]) { // verificam daca s-a preluat numele
?> 
   <p class="mesaj">Nu ati specificat identitatea!</p> 
<?php 
   } 
   else { 
     echo ("<p>Identitatea d-voastra este <em>" . $_REQUEST["nume"] . "</em>.</p>"); 
   }
   // verificam daca s-a furnizat varsta
   $varsta = $_REQUEST["varsta"];
   if (!$varsta || $varsta < 0 || $varsta > 130) {
?> 
   <p class="mesaj">Varsta d-voastra pare stranie!</p> 
<?php 
   } 
   else { 
     echo ("<p>Pretindeti ca aveti " . $varsta . " de ani...</p>"); 
   }
?>
<hr />
</body>
</html>