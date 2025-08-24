<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "scoreboard_system";  // nama DB awak

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
