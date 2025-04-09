<!DOCTYPE html>
<html>
<head>
<title>PHP7 :: Constante 'magice'</title>
<link rel="stylesheet" href="https://profs.info.uaic.ro/~busaco/teach/courses/web/web.css" />
</head>
<body>
<div class="info">
<?php
infomagic(); // funcțiile sunt vizibile oriunde în program 

function infomagic () {
  // redă valori ale unor constante 'magice' globale oferite la execuție de PHP
  printf("<p>Sunt <code>%s()</code> și execut linia %d din <code>%s</code>.</p>", 
  	__FUNCTION__, __LINE__, __FILE__);
  printf("<p>Folosesc PHP <code>%s</code> de pe <code>%s</code> 
  	cu serverul Web <code>%s</code>.</p>", 
  	PHP_VERSION, php_uname(), $_SERVER['SERVER_SOFTWARE']);
};
?>
</div>
</body>
</html>