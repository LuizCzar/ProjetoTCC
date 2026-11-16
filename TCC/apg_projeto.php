<?php
session_start();

require_once "conexao.php";

$data = json_decode(file_get_contents("php://input"), true);
$id_pjt = $data['id'];

$sql = "DELETE 
        FROM projeto
        WHERE id_projeto = '$id_pjt'";
mysqli_query($mysqli, $sql);