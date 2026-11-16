<?php

session_start();

@include "conexao.php";
require "conexao.php";


// recebe o JSON do fetch
$data = json_decode(file_get_contents("php://input"), true);

// pega o nome digitado
$busca = $data['nome'] ?? '';

if(!empty($_SESSION['id'])){
    $sql = "SELECT u.id_usuario, u.nome, c.nome curso, u.turma, u.foto, u.apelido 
        FROM usuario u
        LEFT JOIN curso c ON u.curso = c.id_curso 
        WHERE u.nome LIKE '%$busca%' AND id_usuario <> ". $_SESSION['id'];
}else{
    $sql = "SELECT u.id_usuario, u.nome, c.nome curso, u.turma, u.foto, u.apelido
        FROM usuario u
        LEFT JOIN curso c ON u.curso = c.id_curso
        WHERE u.nome LIKE '%$busca%'";
}


$result = $mysqli->query($sql);

$usuarios = [];
while ($row = $result->fetch_assoc()) {
    $usuarios[] = $row;
}

// retorna JSON
header('Content-Type: application/json; charset=utf-8');
echo json_encode($usuarios);
exit;
