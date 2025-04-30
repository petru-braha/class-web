<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Retrieve email and password from POST data
  $email = isset($_POST['email']) ? $_POST['email'] : '';
  $password = isset($_POST['password']) ? $_POST['password'] : '';

  // Here you would typically validate the email and password against a database.
  // For demonstration purposes, we assume any credentials are valid.

  // Set a cookie named 'user' with the email as its value, lasting 1 hour (3600 seconds)
  setcookie("user", $email, time() + 3600, "/");

  // Inform the user that the login was successful
  echo "Login successful! Cookie has been set for user: " . htmlspecialchars($email);
} else {
  // Redirect back to the login page if the request method is not POST
  header("Location: index.html");
  exit();
}
