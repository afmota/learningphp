<?php
require_once 'login2.php';
$conn = new mysqli($host, $username, $passwd, $dbname);
if ($conn->connect_error) {
    die($conn->connect_error);
}

if (isset($_POST['nome_artista']) &&
    isset($_POST['atividade'])) {
    $nome_artista = filter_input(INPUT_POST, 'nome_artista', FILTER_SANITIZE_STRING);
    $atividade    = filter_input(INPUT_POST, 'atividade', FILTER_SANITIZE_STRING);
    
    $query = "INSERT INTO artistas(nome_artista, atividade) VALUES ('$nome_artista','$atividade')";
    $result = $conn->query($query);
    
    if (!$result) {
        echo "ERRO de inclusão: $query<br>" . $conn->error . "<br><br>";
    }
}

echo <<<_END
        <form method="post" action="artistas.php"><pre>
              ID: <input type="text" name="id_artista" readonly>
            Nome: <input type="text" name="nome_artista" autofocus='autofocus'>
            Em atividade: Sim <input type="radio" name="atividade" value="S" checked="checked">
                              <input type="radio" name="atividade" value="N">
                              <input type="submit" value="ADICIONAR">
        </pre></form>
_END;

$result->close();
$conn->close();
?>
