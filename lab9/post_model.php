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

if (!($statement = $mysql->query('SELECT username, description, image FROM post'))) {
  die('error: query');
}

$mysql->close();

while ($row = $statement->fetch_assoc()) {
  echo '<li>' . $row['username'] . ': ' . $row['description'];
  echo '<img src="' . $row['image'] . '" style="height: 300px;">';
  echo '</li>';
}
