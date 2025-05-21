<?php
session_start();


// Função para retornar uma resposta JSON para o frontend e encerrar o script
function retorna_para_javascript($dados)
{
    header("content-type: Application/json"); // Define o cabeçalho como JSON
    echo json_encode($dados); // Converte o array associativo em JSON e envia como resposta
    exit; // Encerra o script
}

// Recebe os dados enviados pelo formulário via método POST

$nome_crianca = $_POST['nome_crianca'];
$nascimento = $_POST['nascimento'];
$id_responsavel = $_SESSION['id_responsavel'];

// Valida se os campos obrigatórios estão preenchidos

if (empty($nome_crianca)) {
    retorna_para_javascript([
        'status' => 'erro',
        'mensagem' => "Manda o nome da criança"
    ]);
}
if (empty($nascimento)) {
    retorna_para_javascript([
        'status' => 'erro',
        'mensagem' => "Manda a data de nascimento da criança"
    ]);
}

// Conexão com o banco de dados
require_once "../database/conexao_banco.php";

$query = "SELECT * FROM CRIANCA WHERE id_responsavel = $id_responsavel;";

$retorno_banco = $conexao->query($query);
$array_criancas = $retorno_banco->fetchAll(pdo::FETCH_ASSOC);

foreach ($array_criancas as $crianca) {
    if ($crianca['nome_crianca'] == $nome_crianca) {
        retorna_para_javascript([
            'status' => 'erro1',
            'menssagem' => "ja existe uma criança com esse nome"
        ]);
    }
}




// Insere os dados da criança na tabela 'crianca'
$query = "INSERT INTO crianca (nome_crianca, nascimento, id_responsavel) VALUES ('{$nome_crianca}','{$nascimento}','{$id_responsavel}')";
$conexao->exec($query);

exit;
