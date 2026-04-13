<?php

$host = "localhost";
$user = "root";
$pass = "admin";
$db   = "srgs_db";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}