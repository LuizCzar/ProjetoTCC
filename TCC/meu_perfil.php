<?php

session_start();
require "conexao.php";

// garante que o usuário está logado
if (!isset($_SESSION['id'])) {
    http_response_code(401);
    echo json_encode([]);
    exit;
}

$id_usuario = $_SESSION['id'];

$sql = "SELECT u.nome, c.nome curso, turma, turno, foto, bio, github, gmail, instagram, whatsapp, facebook
        FROM usuario u
        LEFT JOIN curso c ON u.curso = c.id_curso
        WHERE id_usuario = ?";

$stmt = $mysqli->prepare($sql);
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$result = $stmt->get_result();

$dados = [];

if ($row = $result->fetch_assoc()) {
    $dados[] = $row;
}

header('Content-Type: application/json; charset=utf-8');
echo json_encode($dados);
