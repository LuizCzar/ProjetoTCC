<?php
session_start();

require_once "conexao.php";

$nome  = $_POST['nome'];
$email = $_POST['email'];
$senha = $_POST['senha'];
$curso = $_POST['curso'];
$turma = $_POST['turma'];
$turno = $_POST['turno'];
$mensagem = '';

// verifica se email existe
$sql = "SELECT email FROM usuario WHERE email = '$email'";
$resultado = mysqli_query($mysqli, $sql);

if (mysqli_num_rows($resultado) == 0) {

    $sql = "INSERT INTO usuario (nome, email, senha, curso, turma, turno, apelido)
            VALUES ('$nome', '$email', '$senha', '$curso', '$turma', '$turno', '$nome')";

    if (mysqli_query($mysqli, $sql)) {
        $mensagem = "Cadastro finalizado";
    } else {
        $mensagem = "Erro ao cadastrar";
    }

} else {
    $mensagem = "Email já cadastrado";
}

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
        <a href="login.html" class="button">Voltar</a>
        <a href="index.html" class="button">Menu</a>
    </div>


    <footer>© 2024-2026 LinkIFBA</footer>
  </div>

</body>
</html>

