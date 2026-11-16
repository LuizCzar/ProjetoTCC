<?php

session_start();

@include "conexao.php";
 
$id_usuario = $_SESSION['id']; // obrigatório

$nome = $_POST['nome'];
$apelido = $_POST['apelido'];
$turno = $_POST['turno'];
$turma = $_POST['turma'];
$bio = $_POST['bio'];
$curso = $_POST['curso'];

$sql = "UPDATE usuario
        SET nome = '$nome', 
            apelido = '$apelido', 
            turno = '$turno', 
            curso = '$curso',
            turma = '$turma', 
            bio = '$bio'
        WHERE id_usuario = '$id_usuario'  
        ";
$array = [];    

if($result = $mysqli->query($sql)){
    header("Location: meu_perfil.html");
}else{
    $array ["estado"] = "erro";
}


