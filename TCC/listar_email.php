<?php

session_start();
@include "conexao.php";

$id_usuario = $_SESSION['id'];

$sql = "SELECT email, id_usuario FROM usuario WHERE id_usuario <> '$id_usuario'";
$result = $mysqli->query($sql);
$email = [];

while($row = $result->fetch_array(MYSQLI_ASSOC)){
    //insere cada linha no array
    array_push( $email,  $row );
}

//transforma o array servidores em JSON
$json_email =  json_encode( $email );
//retornar o JSON
echo $json_email;
?>