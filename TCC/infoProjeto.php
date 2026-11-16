<?php
session_start();

@include "conexao.php";

$data = json_decode(file_get_contents("php://input"), true);

$id_pjt = $data['id'];
$id_usuario = $_SESSION['id'];

$sql = "SELECT p.nome, p.link, p.id_habil habil, p.id_time, p.descricao, 
    p.id_projeto idPjt, usu.id_usuario FROM projeto p 
    LEFT JOIN usutime usu ON usu.id_time = p.id_time
    WHERE usu.id_usuario = '$id_usuario' AND p.id_projeto = '$id_pjt'";
$result = $mysqli->query($sql);
$projeto = [];

while($row = $result->fetch_array(MYSQLI_ASSOC)){
    //insere cada linha no array
    array_push( $projeto,  $row );
}

//transforma o array servidores em JSON
$json_projeto =  json_encode( $projeto );
//retornar o JSON
echo $json_projeto;
?>