<?php
/**
 * Created by PhpStorm.
 * Date: 5/10/19
 * Time: 9:19 PM
 */

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('error_reporting', E_ALL);
error_reporting(E_ALL);

session_start();

$servername = "localhost";
$username = "it";
$password = "it";
$database = "it";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if(isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
        $query = $conn->prepare("select * from user where id = :user_id");
        $query->bindParam(':user_id', $user_id);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        $finded_user = $result[0];
        if(count($result)) {
            $user = $result[0];
        }
    } elseif(isset($page) && $page == 'panel') {
        header('location: ./index.php');
    }
}
catch(PDOException $e)
{
    echo "DB Connection failed: " . $e->getMessage();
}