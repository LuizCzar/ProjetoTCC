<?php
session_start();

require_once "conexao.php";

$id_usuario = $_SESSION['id'];

$nome  = $_POST['nome'];
$desc = $_POST['desc'];
$link = $_POST['link'];
$habil = $_POST['habil'];
$time = $_POST['time'];

$mensagem = '';

if(!empty($time)){
  $sql = "INSERT INTO projeto (nome, id_habil, descricao, link, id_time)
        VALUES ('$nome', '$habil', '$desc', '$link', '$time')";
  mysqli_query($mysqli, $sql);
  $mensagem = "Projeto adicionado";
  header("Location: meu_perfil.html");
}else{$mensagem = "Time não informado";}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="Img/logo/019125-removebg-preview.png" type="img/x-icon">
    <link rel="stylesheet" href="login.css">
    <title>LinkIFBA</title>
    <style>
        div{
            justify-self: center;
        }
        .button{
            padding: 10px 20px;
            background: #0d6efd;
            color: #fff;
            border: none;
            border-radius: 6px;
            font-size: 20px;
            cursor: pointer;
            text-decoration: none;
            margin: 20px;
        }

    </style>
</head>
<body>

  <div class="container" id="login">
    <div class="logo">
      <img src="img/logo/logo-comp2.png" alt="logo-comp2">
    </div>
    <br>
    <div>
        <h2><?php echo $mensagem ?></h2>
    </div>
    <br>
    <div>
        <a href="add_projeto.html" class="button">Voltar</a>
        <a href="meu_perfil.html" class="button">Meu Perfil</a>
    </div>


    <footer>© 2024-2026 LinkIFBA</footer>
  </div>

</body>
</html>

