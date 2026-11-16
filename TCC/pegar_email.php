<?php
session_start();

@include "conexao.php";

$data = json_decode(file_get_contents("php://input"), true);

$email = $data['email'] ?? '';

$sql = "SELECT email, id_usuario, apelido, nome FROM usuario WHERE email = '$email' ";

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