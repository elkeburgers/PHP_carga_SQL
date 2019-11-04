<?php
include_once("config/conexao.php");
$db = conectarBanco();
$query = $db->query('SELECT * from cursos');
$cursos = $query->fetchAll(PDO::FETCH_ASSOC);
// var_dump($cursos);
// teste para saber se esta retornando os dados corretos

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Banner</title>
</head>

<body>

    <main class="col-5 ml-5 pl-5 bg-light mt-3 pb-5">
    <div>
    <br><br>
    <h2>Cadastro de aluno</h2>
    </div>
        <br><br>
        <form action="cadastroAluno.php" method='post' accept-charset="utf-8">
            <h2>Nome do aluno</h2><br>
            <input type="text" name="nomeAluno">
            <br><br>
            <h2>RA do aluno</h2><br>
            <input type="text" name="raAluno">
            <br><br>
            <h2>Cursos disponíveis</h2><br>
            <select name="curso" id="">
                <?php foreach($cursos as $curso): ?>
                <option value="<?= $curso['id']; ?>">
                    <?= $curso['nome']; ?></option>
                <!-- sintaxe reduzida do php para substituir o echo -->
                <?php endforeach; ?>
            </select>
            <button type="submit">Cadastrar</button>
        </form>
        <div class="container d-flex justify-content-start mt-5">
            <a href="alunos.php">Ver alunos cadastrados</a>
        </div>
    </main>
</body>

</html>