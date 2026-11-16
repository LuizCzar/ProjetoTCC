    <?php
    session_start();

    @include "conexao.php";

    $id_usuario = $_SESSION['id'];

    $sql = "SELECT h.nome, COUNT(p.id_habil) quantidade  FROM projeto p  
            LEFT JOIN time t ON t.id = p.id_time
            LEFT JOIN usutime ut ON ut.id_time = t.id 
            LEFT JOIN usuario us ON ut.id_usuario = us.id_usuario 
            LEFT JOIN habilidade h ON h.id_habilidade = p.id_habil
            WHERE us.id_usuario = '$id_usuario'
            GROUP BY h.nome";

    $result = $mysqli->query($sql);
    $habil = [];
    while($row = $result->fetch_array(MYSQLI_ASSOC)){
        //insere cada linha no array
        array_push( $habil,  $row );
    }

    //transforma o array servidores em JSON
    $json_habil =  json_encode( $habil );
    //retornar o JSON
    echo $json_habil;
    ?> 