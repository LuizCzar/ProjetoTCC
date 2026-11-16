<?php
session_start();

require_once "conexao.php";

$data = json_decode(file_get_contents("php://input"), true);
$id_time = $data['id_time'] ?? "";

if(!empty($id_time)){
    $sql = "DELETE 
        FROM projeto 
        WHERE id_time = '$id_time'";
    mysqli_query($mysqli, $sql);

    $sql = "DELETE 
        FROM usutime 
        WHERE id_time = '$id_time'";
    mysqli_query($mysqli, $sql);

    $sql = "DELETE 
        FROM time 
        WHERE id = '$id_time'";
    mysqli_query($mysqli, $sql);

}

?>

