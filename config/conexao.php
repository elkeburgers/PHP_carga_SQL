<?php

// jeito simpeles de criar a conexao do PHP com o BD SQL, que ocupa espaço na memoria mesmo que nao precise usar a conexao:
// $host = 'mysql:host=localhost;dbname=escola;port=3306';
// $user = 'root';
// $pass = ''; 
// $db = new PDO($host, $user, $pass);
        

// Funcao para que a conexao so seja executada quando for necessario, e gera tambem segurança para nao ficar com a conexao aberta todo o tempo. Hoje nao faz muita diferenca a questao da carga na memoria, seria mais a questao de segurança.

function conectarBanco(){
$host = 'mysql:host=localhost;dbname=escola;port=3306';
$user = 'root';
$pass = ''; 
return $db = new PDO($host, $user, $pass);
}

?>