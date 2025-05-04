<?php

$mysql = new mysqli(
  'localhost',
  'root',
  '',
  'facebook'
);

if (mysqli_connect_errno()) {
  die('error: database connection failed.');
}

if (!($statement = $mysql->query(
  'SELECT username, description, imageUrl FROM post'))) {
  die('error: query');
}

$mysql->close();

// return to the controller: while ($row = $statement->fetch_assoc())
