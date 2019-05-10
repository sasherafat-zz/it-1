<?php
/**
 * Created by PhpStorm.
 * Date: 5/10/19
 * Time: 9:19 PM
 */

session_start();

$servername = "localhost";
$username = "it";
$password = "it";
$database = "it";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
    echo "DB Connection failed: " . $e->getMessage();
}