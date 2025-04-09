<?php 
/* Program PHP 5+ care exemplifica folosirea cookie-urilor pentru a retine 
   culoarea de fundal preferata de un utilizator

   Ultima actualizare: 02 martie 2020
*/
define ('CULOARE_IMPLICITA', 'black');
   
// verificam daca exista culoarea preluata de la client
$culoare = isset($_POST['culoare']) ? $_POST['culoare'] : CULOARE_IMPLICITA;

// stabilim ca acest cookie sa expire peste 10 zile
if (!setcookie('culoare_fundal', $culoare, time() + 60 * 60 * 24 * 10)) {
	echo 'Cookie-ul n-a putut fi creat.';
}   
?>
<!DOCTYPE html>
<html>
	<head>
		 <title>Culori preferate</title>
		 <style>
		 body {
		 	font-family: sans-serif;
		 	color: white;
		 	background: <?php echo $_COOKIE['culoare_fundal']; ?>; 
		 }
		 </style>
	</head>
	<body>
		<p>Alegeti culoarea de fundal preferata ce va aparea la vizita viitoare:</p>
	    <!-- date transmise prin metoda POST -->
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
		   <select name="culoare">
		  	<?php
		  	   // generam lista de culori
		  	   foreach ( [ 'gray', 'purple', 'darkred', 'pink', 'navy' ] as $cul) {
		  	   	  echo '<option value="' . $cul . '">' . $cul . '</option>';
		  	   }
		  	?>
		   </select>
		   <input type="submit" value="Alege culoarea" />
		</form>
	</body>
</html>
