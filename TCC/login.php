<?php
session_set_cookie_params([
    "path" => "/"
]);

session_start();

@include "conexao.php";

$email = $_POST['email'];
$senha = $_POST['senha'];

$sql = "SELECT id_usuario, email, id_usuario FROM usuario 
        WHERE email = '$email' AND senha = '$senha'";

$resultado = mysqli_query($mysqli, $sql);

if (mysqli_num_rows($resultado) > 0) {

    $usuario = mysqli_fetch_assoc($resultado);

    $_SESSION['id'] = $usuario['id_usuario'];
    $_SESSION['email'] = $usuario['email'];
    header("Location: index.html");
    exit;

} else {
    $mensagem = "Email ou senha inválidos";
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

 