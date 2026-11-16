<?php
session_start();

@include "conexao.php";

$id_usuario = $_SESSION['id'];

$sql = "SELECT t.id, t.nome, us.foto FROM usutime ut
        JOIN usuario us ON us.id_usuario = ut.id_usuario
        JOIN time t ON t.id = ut.id_time
        WHERE us.id_usuario = '$id_usuario' ";

$result = $mysqli->query($sql);
$time = [];
while($row = $result->fetch_array(MYSQLI_ASSOC)){
    //insere cada linha no array
    array_push( $time,  $row );
}

//transforma o array servidores em JSON
$json_time =  json_encode( $time );
//retornar o JSON
echo $json_time;
?> 