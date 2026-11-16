<?php
session_start();
@include "conexao.php";

$id_usuario = $_SESSION['id'];

if (!empty($_POST['git'])) {
    $git = $_POST['git'];
    $mysqli->query("UPDATE usuario SET github = '$git' WHERE id_usuario = '$id_usuario'");
}

if (!empty($_POST['email'])) {
    $email = $_POST['email'];
    $mysqli->query("UPDATE usuario SET gmail = '$email' WHERE id_usuario = '$id_usuario'");
}

if (!empty($_POST['insta'])) {
    $insta = $_POST['insta'];
    $mysqli->query("UPDATE usuario SET instagram = '$insta' WHERE id_usuario = '$id_usuario'");
}

if (!empty($_POST['whats'])) {
    $whats = $_POST['whats'];
    $mysqli->query("UPDATE usuario SET whatsapp = '$whats' WHERE id_usuario = '$id_usuario'");
}

if (!empty($_POST['face'])) {
    $face = $_POST['face'];
    $mysqli->query("UPDATE usuario SET facebook = '$face' WHERE id_usuario = '$id_usuario'");
}

header("Location: meu_perfil.html");
exit;
?>
