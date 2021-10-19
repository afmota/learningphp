<?php //formtest.php
if (isset($_POST['name'])) {
    $name = $_POST['name'];
} else {
    $name = "(Não informado)";
}

echo <<<_END
<html>
    <head>
        <title>Formulário Teste</title>
    </head>
    <body>
        Seu nome é: $name<br>
        <form method="post" action="formtest.php">
            Qual o seu nome?
            <input type="text" name="name">
            <input type="submit">
        </form>
    </body>
</html>
_END
?>