<?php

session_start();

require "conexao.php";

$mensagem = "";
$id_usuario = $_SESSION['id']; // obrigatório

$diretorio = "uploads/perfis/";

if (!is_dir($diretorio)) {
    mkdir($diretorio, 0777, true);
}

if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {

    $arquivo = $_FILES['foto'];

    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime = finfo_file($finfo, $arquivo['tmp_name']);

    $tiposPermitidos = ['image/jpeg', 'image/png', 'image/webp'];

    if (!in_array($mime, $tiposPermitidos)) {
        $mensagem = "Formato de imagem não permitido";
    }
    elseif ($arquivo['size'] > 5 * 1024 * 1024) {
        $mensagem = "Imagem muito grande (máx 5MB)";
    }
    else {

        $extensao = pathinfo($arquivo['name'], PATHINFO_EXTENSION);
        $nomeUnico = uniqid("perfil_") . "." . $extensao;
        $caminhoFinal = $diretorio . $nomeUnico;

        if (move_uploaded_file($arquivo['tmp_name'], $caminhoFinal)) {

            $sql = "UPDATE usuario SET foto = :foto WHERE id_usuario = :id_usuario";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':foto' => $caminhoFinal,
                ':id_usuario' => $id_usuario
            ]);

            $mensagem = "Imagem salva com sucesso!";
        } else {
            $mensagem = "Erro ao salvar a imagem";
        }
    }

} else {
    $mensagem = "Nenhuma imagem enviada";
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
        <a href="editar_perfil.html" class="button">Voltar</a>
        <a href="meu_perfil.html" class="button">Meu Perfil</a>
    </div>


    <footer>© 2024-2026 LinkIFBA</footer>
  </div>

</body>
</html>
