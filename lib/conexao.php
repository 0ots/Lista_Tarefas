<?php 
$host = "localhost";
$db = "crud_clientes";
$user = "root";
$password = "";

$mysqli = new mysqli($host, $user, $password, $db);
if($mysqli->connect_errno){
    die("Falha na conexão com o banco de dados.");
}
?>