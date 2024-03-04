<?php 

$host = '127.0.0.1';
$user = "root";
$password = "";
$database = "businessv";

$connessione = new mysqli($host, $user, $password, $database);
if($connessione === false){
    die("un va". $connessione->connect_error);
}


?>

