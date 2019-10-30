<?php 

    $nomeAluno = $_POST['nomeAluno'];
        // nomeAluno eh igual ao campo name do formulario do index, criado primeiro
    $raAluno = $_POST['raAluno'];
    $cursoId = $_POST['curso'];

    $host = 'mysql:host=localhost;dbname=escola;port=3306';
    $user = 'root';
    $pass = ''; 
    $db = new PDO($host, $user, $pass);
        // agora funcao para inserir dados no BD pelo PHP. naopode ser uma query por questoes de seguranca, porque poderia aceitar outras coisas além do que foi solicitado para inserir no banco de dados
    
    $query = $db->prepare('INSERT INTO alunos (nome, ra, curso_id) 
    values (:nome,:ra,:curso_id)');
        // prepare para preparar os dados para inserir no BD
        // deve sempre colunas as colunas no PHP, eh o mais recomendavel
        // as tres interrogacoes sao questao de seguranca, fechando a query, para evitar que um hacker consiga inserir uma funcao no lugar do nome, por exemplo. cada valor inserido nas variaveis substitui uma das interrogacoes. Isso garante que so passa valor, se for uma funcao ele nao consegue executar.
        // este tipo de ataque se chama SQL inject
        // foi substituidas pelos nomes dos campos, criando uma array de associacao
    
        // $query->execute([$nomeAluno, $raAluno, $cursoId]);
    // var_dump($query);
    // só aparece a formula do array, abaixo para ver o que deu de resultado

    $resultado = $query->execute(["nome"=>$nomeAluno, "ra"=>$raAluno, "curso_id"=>$cursoId]);
    // obedecendo a associacao que criamos dentro do array no prepare, retorna true ou false, conforme o sucesso do envio para o BD

    var_dump($resultado);

?>

