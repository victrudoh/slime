<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'edikan');
define('DB_PASS', 'password');
define('DB_NAME', 'blog');
define('DB_PORT', 3333);

// Create connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);

// Check connection
if ($conn->connect_error) {
  die('Connection failed: ' . $conn->connect_error);
}
