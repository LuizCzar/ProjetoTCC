<?php
session_start();
require "conexao.php";

// recebe JSON do fetch
$data = json_decode(file_get_contents("php://input"), true);

// pega o id
$id_usuario = $_SESSION['id'];

// SQL direto (sem prepared)
$sql = "SELECT DISTINCT usu.apelido, hab.nome habilidade FROM projetotcc.usuario usu 
LEFT JOIN projetotcc.usutime usti ON usti.id_usuario = usu.id_usuario
LEFT JOIN projetotcc.time t ON t.id = usti.id_time 
LEFT JOIN projetotcc.projeto p ON p.id_time = t.id
LEFT JOIN projetotcc.habilidade hab ON hab.id_habilidade = p.id_habil WHERE usu.id_usuario = '$id_usuario'";
$result = $mysqli->query($sql);

$projetos = [];
while ($row = $result->fetch_assoc()) {
    $projetos[] = $row;
}

// retorna JSON
header('Content-Type: application/json; charset=utf-8');
echo json_encode($projetos);
exit;
