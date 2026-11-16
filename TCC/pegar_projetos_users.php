<?php
session_start();
require "conexao.php";

// recebe JSON do fetch
$data = json_decode(file_get_contents("php://input"), true);
 
// pega o id
$id_usuario = $data['id_usuario'] ?? 0;


$sql = "SELECT us.id_usuario, p.id_projeto idProjeto, p.nome, p.link, p.descricao, h.nome habil FROM projeto p  
        LEFT JOIN time t ON t.id = p.id_time
        LEFT JOIN usutime ut ON ut.id_time = t.id 
        LEFT JOIN usuario us ON ut.id_usuario = us.id_usuario 
        LEFT JOIN habilidade h ON h.id_habilidade = p.id_habil
        WHERE us.id_usuario = '$id_usuario'
        GROUP BY p.id_projeto";
$result = $mysqli->query($sql);

$projetos = [];
while ($row = $result->fetch_assoc()) {
    $projetos[] = $row;
}

// retorna JSON
header('Content-Type: application/json; charset=utf-8');
echo json_encode($projetos);
exit;
