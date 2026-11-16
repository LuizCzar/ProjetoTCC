 <?php
session_start();

require_once "conexao.php";

$id_pjt = $_POST['id_pjt'];
$nome = $_POST['nome'];
$link = $_POST['link'];
$desc = $_POST['desc'];
$habil = $_POST['habil'] ?? "Não informada";
$time = $_POST['time'];

$sql = "UPDATE projeto
        SET nome = '$nome', 
            link = '$link', 
            id_habil = '$habil', 
            descricao = '$desc',
            id_time = '$time'
        WHERE id_projeto = '$id_pjt'   
        ";
mysqli_query($mysqli, $sql);

header("Location: meu_perfil.html");
exit;
?>
