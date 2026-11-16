<?php

@include "conexao.php";
$busca = "";
if(isset($_GET['busca']))
$busca = $_GET['busca'];
$sql = "SELECT * FROM projeto  WHERE nome LIKE '$busca%' ";

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