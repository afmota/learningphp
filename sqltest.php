<?php //sqltest.php
require_once 'login.php';
$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die($conn->connect_error);
}

// verifica se uma solitação para deletar um registro foi enviada
if (isset($_POST['delete']) && isset($_POST['isbn'])) {
    $isbn = get_post($conn, 'isbn');
    $query = "DELETE FROM classics WHERE isbn='$isbn'";
    $result = $conn->query($query);
    if (!$result) {
        echo "DELETE failed: $query <br>" . $conn->error. "<br><br>";
    }
}

// verifica se os valores de todos os campos foram postados nas variáveis
if (isset($_POST['author'])   &&
    isset($_POST['title'])    &&
    isset($_POST['category']) &&
    isset($_POST['year'])     &&
    isset($_POST['isbn'])) {
    // busca as entradas no navegador para salvar no banco
    $author   = get_post($conn, 'author');
    $title    = get_post($conn, 'title');
    $category = get_post($conn, 'category');
    $year     = get_post($conn, 'year');
    $isbn     = get_post($conn, 'isbn');
    
    // cria o insert com as variáveis buscadas no navegador
    $query = "INSERT INTO classics VALUES ('$author', '$title', '$category', '$year', '$isbn')";
    $result = $conn->query($query);
    
    if (!$result) {
        echo "INSERT failed: $query<br>" . $conn->error . "<br><br>";
    }
}

echo <<<_END
<form action="sqltest.php" method="post"><pre>
      Author <input type="text" name="author">
       Title <input type="text" name="title">
    Category <input type="text" name="category">
        Year <input type="text" name="year">
        ISBN <input type="text" name="isbn">
             <input type="submit" value="ADD RECORD">
</pre></form>
_END;

$query = "SELECT * FROM classics";
$result = $conn->query($query);
if (!$result) {
    die("Database access failed: " . $conn->error);
}

$rows = $result->num_rows;

for ($j = 0; $j < $rows; ++$j) {
    $result->data_seek($j);
    $row = $result->fetch_array(MYSQLI_NUM);
    
    echo <<<_END
    <pre>
          Author $row[0]
           Title $row[1]
        Category $row[2]
            Year $row[3]
            ISBN $row[4]
    </pre>
    <form action="sqltest.php" method="post">
    <input type="hidden" name="delete" value="yes">
    <input type="hidden" name="isbn" value="$row[4]">
    <input type="submit" value="DELETE RECORD"></form>
    _END;
}

$result->close();
$conn->close();

function get_post($conn, $var) {
    return $conn->real_escape_string($_POST[$var]);
}