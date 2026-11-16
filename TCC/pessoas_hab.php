<?php

@include "conexao.php";
$busca = "";
if(isset($_GET['busca']))
$busca = $_GET['busca'];
$sql = "SELECT usu.nome, hab.nome habilidade FROM projetotcc.usuario usu 
LEFT JOIN projetotcc.usutime usti ON usti.id_usuario = usu.id_usuario
LEFT JOIN projetotcc.time t ON t.id = usti.id_time 
LEFT JOIN projetotcc.projeto p ON p.id_time = t.id
LEFT JOIN projetotcc.habilidade hab ON hab.id_habilidade = p.id_habil WHERE hab.nome LIKE '%$busca%' ";

$result = $mysqli->query($sql);
$usuhab = [];
while($row = $result->fetch_array(MYSQLI_ASSOC)){
    //insere cada linha no array
    array_push( $usuhab,  $row );
}

//transforma o array servidores em JSON
$json_usuhab =  json_encode( $usuhab );
//retornar o JSON
echo $json_usuhab;