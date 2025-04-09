<?php
if (isset($_POST['Logout'])) {
  setcookie('email', '', time() - 3600);
  header("Location: login.php");
}
