<?php
  $host = 'localhost'; // or your database host
  $user = 'root'; // your MySQL username
  $passwdddd = ''; // your MySQL password
  $db = 'voting_system'; // your database name

  // Create connection
  $conn = new mysqli($host, $user, $passwdddd, $db);

  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }
  //echo "Connected successfully";
?>