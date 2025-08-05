<?php
$servername = "localhost:3306";
$username = "root";
$password = "";
$dbname = "Mustle_Hustle";

// Create connection
$mysqli = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
