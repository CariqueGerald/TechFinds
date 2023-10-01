<?php

$host = "localhost";
$dbname = "id21339512_techfinds";
$username = "id21339512_admin";
$password = "Busacc#007";

$mysqli = new mysqli(hostname: $host,
                     username: $username,
                     password: $password,
                     database: $dbname);
                     
if ($mysqli->connect_errno) {
    die("Connection error: " . $mysqli->connect_error);
}

return $mysqli;
