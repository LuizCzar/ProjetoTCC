<?php

@include "conexao.php";

$data = json_decode(file_get_contents("php://input"), true);

$sql = "SELECT id_habilidade, nome FROM habilidade";
$result = $mysqli->query($sql);
$habilidade = [];

while($row = $result->fetch_array(MYSQLI_ASSOC)){
    //insere cada linha no array
    array_push( $habilidade,  $row );
}

//transforma o array servidores em JSON
$json_habilidade =  json_encode( $habilidade );
//retornar o JSON
echo $json_habilidade;
