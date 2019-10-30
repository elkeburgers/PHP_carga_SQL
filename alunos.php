<?php

$host = 'mysql:host=localhost;dbname=escola;port=3306';
$user = 'root';
$pass = "";
$db = new PDO($host, $user, $pass);
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

</body>
</html>
