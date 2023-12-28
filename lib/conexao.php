<?php 
$host = "localhost";
$db = "oots";
$user = "root";
$password = "";

$mysqli = new mysqli($host, $user, $password, $db);
if($mysqli->connect_errno){
    die("Falha na conexão com o banco de dados.");
}
?>