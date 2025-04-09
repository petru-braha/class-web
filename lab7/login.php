<?php


$email = $_GET['email'] ?? $_POST['email'] ?? 'no email found';
$password = $_GET['password'] ?? $_POST['password'] ?? 'no password found';


if ($email != 'petrubraha@yahoo.com') {
  echo "invalid email";
  echo '<h3>cookie data: </h3>';
  echo '<p>email: ' . $_COOKIE['email'] . '</p>';
  echo "<p> password: is known" . "</p>";
} else {// petrubraha@yahoo.com
  if ($password == "dada") {
    echo "welcome";
    setcookie('email', $email, time() + (5 * 60));
  } else {
    echo "wrong password";
  }
}
