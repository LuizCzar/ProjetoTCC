<?php

session_start();
require "conexao.php";

// recebe JSON do fetch
$data = json_decode(file_get_contents("php://input"), true);

// pega o id
$id_usuario = $data['id_usuario'] ?? 0;

// SQL direto (sem prepared)
$sql = "SELECT u.nome, c.nome curso, turma, turno, foto, bio, github, gmail, instagram, whatsapp, facebook
        FROM usuario u
        LEFT JOIN curso c ON u.curso = c.id_curso 
        WHERE id_usuario = $id_usuario";

$result = $mysqli->query($sql);

$dados = [];
if ($row = $result->fetch_assoc()) {
    $dados[] = $row;
}

// retorna JSON
header('Content-Type: application/json; charset=utf-8');
echo json_encode($dados);
exit;
