<?php //formtest.php
echo <<<_END
<html>
    <head>
        <title>Formulário Teste</title>
    </head>
    <body>
        <form method="post" action="formtest.php">
            Qual o seu nome?
            <input type="text" name="nome">
            <input type="submit">
        </form>
    </body>
</html>
_END
?>