<?php
session_start();
$data = json_decode(file_get_contents("php://input"), true);
$lista = $data['lista'] ?? [];

$nome = $data['nome'] ?? "não informado";

echo $lista;
echo $nome;
