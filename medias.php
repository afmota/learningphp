<?php
require_once 'login2.php';
$conn = new mysqli($host, $username, $passwd, $dbname);
if ($conn->connect_error) {
    die($conn->connect_error);
}

$nome_album = filter_input(INPUT_POST, 'nome_album', FILTER_SANITIZE_STRING);
$nome_artista = filter_input(INPUT_POST, 'nome_artista', FILTER_SANITIZE_STRING);
$data_lancamento = filter_input(INPUT_POST, 'data_lancamento', FILTER_SANITIZE_STRING);
$num_serie = filter_input(INPUT_POST, 'num_serie', FILTER_SANITIZE_STRING);
$observacao = filter_input(INPUT_POST, 'observacao', FILTER_SANITIZE_STRING);

if (
        isset($nome_album)      &&
        isset($nome_artista)    &&
        isset($data_lancamento) &&
        isset($num_serie)
   ) {
    $query = "INSERT INTO albuns (nome_album, nome_artista, data_lancamento, num_serie, observacao) VALUES ('$nome_album', '$nome_artista', '$data_lancamento', '$num_serie', '$observacao')";
    $result = $conn->query($query);

    if (!$result) {
        echo "ERRO DE INCLUSÃO: $quey<br>" . $conn->error . "<br><br>";
    }
}

echo <<<_END
    <head>
        <title>Discoteca - Álbuns</title>
    </head>
    <body>
        <form method="post" action="medias.php"><pre>
                        Código: <input type="text" name="id_media" readonly>
                         Álbum: <input type="text" name="nome_album" autofocus="autofocus">
                       Artista: <input type="text" name="nome_artista">
            Data de lançamento: <input type="date" name="data_lancamento">
               Número de série: <input type="text" name="num_serie">
                          Obs.: <textarea name="observacao" cols="50" rows="5" wrap="soft"></textarea>
                                <input type="submit" value="INCLUIR">
        </pre></form>
    </body>
_END;

$result->close();
$conn->close();
?>
