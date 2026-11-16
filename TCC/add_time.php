<?php
session_start();

require_once "conexao.php";

$data = json_decode(file_get_contents("php://input"), true);
$lista = $data['lista'] ?? [];
$id_usuario = $_SESSION['id'];
$nome = $data['nome'] ?? "não informado";

//Cria o time 
$sql = "INSERT INTO time (nome)
        VALUES ('$nome')";
mysqli_query($mysqli, $sql);
$id_time = mysqli_insert_id($mysqli);

//Adiciona os usuarios da tabela no time
$sql = "INSERT INTO usutime(id_usuario, id_time) VALUE('$id_usuario', '$id_time')";
mysqli_query($mysqli, $sql);

for($i = 0; $i < count($lista); $i++){
  $usu = $lista[$i];
  $sql = "INSERT INTO usutime(id_usuario, id_time) VALUE('$usu', '$id_time')";
  mysqli_query($mysqli, $sql);
}


?>

