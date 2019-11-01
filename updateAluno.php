<?php

    include_once('config/conexao.php');
    $db = conectarBanco();
    $query = $db->query('SELECT * FROM cursos');
    $cursos = $query->fetchAll(PDO::FETCH_ASSOC);
    
     // recuperando o id do aluno na url
    // $id = $_GET['id'];

    // funcao para garantir que a pagina vai receber a informacao para fazer a consulta, informar qual o erro  caso não passe na validacao, e parar a execucao do codigo aso nao valide, para nao aparecer erro para o usuario.
    // lembrando, if(isset) pergunta se aquele parametro jah existe. Usando o OU (||) para garantir que vai receber a informacao de qualquer forma de envio, seja get ou post.
    if(isset($_GET['id']) || isset($_POST['id'])){
        $id = $_GET['id'];
    }else if(isset($_POST['id'])){
        $id = $_POST['id'];
    }else{
        echo "Você deve informar um ID.";
        exit;
    }

    $query =  $db->prepare('SELECT * FROM alunos WHERE id=?');
    //como eh soh uma informacao podemos colocar apenas a interrogacao no lugar de :id, que é um array associativo, mais complexo para processar.
    $query->execute([$id]);
    // se tivesse colocado :id no select, teria que colocar um array associativo nesta linha, não um array de posicao como estah agora.
    $aluno = $query->fetch(PDO::FETCH_ASSOC);
    // var_dump($aluno); - teste se retorna as informações corretas

    // perguntando se o POST, ou seja, os dados enviados do formulario apos apertar button editar, esta diferente de vazio. Se estiver, quer dizer que ha alteracoes para cadastrar no BD
    if($_POST !=[]){
        $nomeAluno = $_POST['nomeAluno'];
        $raAluno = $_POST['ra'];
        $cursoId = $_POST['curso'];
        // se eu usar a forma do input, tem que incluir esta linha de variavel abaixo
        $id = $_POST['id'];

        //agora que tem os dados novos, fazer o update:
        // update, tabela a atualizar, (set) mais os campos a serem atualizados, e a condicao (where) de o id ser o mesmo selecionado antes: 
        $query = $db->prepare('UPDATE alunos set nome=:nome, ra=:ra, curso_id=:curso_id WHERE id=:id');
        // agora executar a carga destes dados no BD
        $query->execute([
            'id'=>$id, 
            'curso_id'=>$cursoId,
            'ra'=>$raAluno,
            'nome'=>$nomeAluno
        ]);
    }




?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Editar</title>
</head>

<body>
    <main class="col-5 ml-5 pl-5 bg-light mt-3 pb-5">
        <br><br>
        <!-- preciso incluir o id no action para ele manter essa informacao quando atualiza a pagina (forma 1) menos comum de usar -->
        <!-- <form action="updateAluno.php?<?php  ?>"  method='post'> -->
        <form action="updateAluno.php" method='post'>
            <!-- preciso incluir o id no action para ele manter essa informacao quando atualiza a pagina (forma 2), como se fosse mais um campo do formulario, so que desabilitada para edicao (readonly) e escondida do usuario (hidden) -->
            <input type="text" name="id" readonly hidden value="<?php echo $id; ?>"/>

            <h2>Nome do aluno</h2><br>
            <!-- para retornar o nome correspondente ao id e ser editavel: -->
            <input type="text" name="nomeAluno" value='<?php echo $aluno['nome'];?>'>
            <br><br>

            <h2>RA do aluno</h2><br>
            <!-- para retornar o nome correspondente ao id e ser apenas visivel: disabled - fica cinza, readonly - fica normal, mas tambem nao editavel -->
            <input type="text" name="raAluno" value='<?php echo $aluno['ra'];?>' readonly>
            <br><br>

            <h2>Cursos disponíveis</h2><br>
            <select name="curso">
                <?php foreach($cursos as $curso): ?>
                <!-- colocar selected antes do value retorna a selecao que o aluno tem cadastrado no BD, mas precisa da validacao do if, senao o selected vai trazer apenas a ultima opcao das options cadastradas no form. -->
                <!-- se o id do curso for igual ao do bd, imprimir.  sem elseporque ele so vai entrar nesse if se for igual o id_curso -->
                <?php  if($curso['id'] == $aluno['curso_id']): ?>
                <option selected value="<?= $curso['id']; ?>">
                    <?= $curso['nome']; ?>
                </option>
                <?php else: ?>
                <option value="<?= $curso['id']; ?>">
                    <?= $curso['nome']; ?>
                </option>
                <?php endif; ?>
                <?php endforeach; ?>
            </select><br><br>

            <button type="submit">Editar</button>
            <button type="">Cancelar</button>
            
        </form>
    </main>
</body>

</html>