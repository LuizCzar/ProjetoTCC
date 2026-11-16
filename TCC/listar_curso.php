<?php
session_start();

@include "conexao.php";

$sql = "SELECT id_curso, nome FROM curso";

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