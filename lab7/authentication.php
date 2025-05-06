<?php

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
  die('error: only the POST method is allowed');
}

// warning: signup with null username is interpreted as login
$username = $_POST["username"] ?? '';
$email = $_POST["email"] ?? '';
$password = $_POST["password"] ?? '';
$hash = password_hash($password, PASSWORD_DEFAULT);

if ('' === $email || '' === $password) {
  die('error: invalid input');
}

// database query
$db = new mysqli(
  'localhost',
  'root',
  $_ENV['DB_PASSWORD'] ?? '',
  'test'
);

if ($db->connect_error) {
  die('error: ' . $db->connect_error);
}

$result = $db->query(
  'SELECT email, hashed_password FROM user'
);

if (!$result) {
  die('error: query failed');
}

// login
if ('' === $username) {

  $isPresent = false;
  while ($row = $result->fetch_assoc()) {
    if ($email === $row['email']) {
      $temp = password_verify(
        $password,
        $row['hashed_password']
      );
      if (false === $temp) {
        die('error: invalid password');
      } else {
        $isPresent = true;
        break;
      }
    }
  }

  if (!$isPresent) {
    die('error: invalid email');
  }

  $token = json_encode(
    ['email' => $email, 'username' => $username]
  );

  setcookie(
    'userSession',
    $token,
    [
      'expires' => time() + 10,
      'path' => '/',
      'secure' => isset($_SERVER['HTTPS']),
      'httponly' => true
    ]
  );

  header('Location: dashboard.php');
  $db->close();
  exit;
}

// signup
while ($row = $result->fetch_assoc()) {
  if ($email === $row['email']) {
    die('error: email already in use');
  }
}

$stmt = $db->prepare("INSERT INTO user (username, email, hashed_password) VALUES (?, ?, ?)");
$stmt->bind_param('sss', $username, $email, $hash);
$result = $stmt->execute();

if (!$result) {
  die("error: data insertion failed");
}

$db->close();
header('Location: index.php');
