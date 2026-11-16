<?php

    $host = "localhost";
    $banco = "projetotcc";
    $usuario = "root";
    $senha = "";

    $mysqli = new mysqli($host, $usuario, $senha, $banco);

    $mysqli->set_charset("utf8");
    
    $pdo = new PDO(
        "mysql:host=localhost;dbname=projetotcc;charset=utf8mb4",
        "root",
        "",
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]
    );


    if($mysqli-> connect_errno){
        printf("Connect failed: %s\n", $mysqli->connect_errno);
        exit();
    }
?>


