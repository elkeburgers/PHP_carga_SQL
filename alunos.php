<?php

include_once("config/conexao.php");
$db=conectarBanco();
$query = $db->query('SELECT * FROM alunos');
$alunos = $query->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Alunos</title>
</head>
<body>
    
    <h1>Lista de alunos</h1>
    <ul>
        <?php foreach($alunos as $aluno): ?>
        <li><?=$aluno['nome'] ?></li>
<?php endforeach; ?>
    </ul>
    <div class="container d-flex justify-content-start mt-5">
            <a href="index.php">Voltar</a>
        </div>

</body>
</html>
