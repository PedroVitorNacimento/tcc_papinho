<?php


// Função para retornar a resposta como JSON e encerrar o script
function retorna_para_login($dados)
{
    header("content-type: Application/json"); // Define o cabeçalho como JSON
    echo json_encode($dados); // Converte o array associativo em JSON e envia como resposta
    exit; // Encerra o script
}

// Captura os dados enviados pelo formulário
$email = $_POST["login"];
$senha = $_POST["senha"];

// Verifica se o email foi recebido
if (empty($email)) {
    retorna_para_login([
        'status' => 'erro',
        'mensagem' => 'não recebido email'
    ]);
}

// Verifica se a senha foi recebida
if (empty($senha)) {
    retorna_para_login([
        'status' => 'erro',
        'mensagem' => 'não recebido senha'
    ]);
}


// Inclui a conexão com o banco de dados
require_once "../database/conexao_banco.php";

// Prepara e executa a consulta SQL para buscar o usuário pelo email
$query = "SELECT * FROM responsavel WHERE email = '{$email}';";
$retorna_banco = $conexao->query($query);
$usuario = $retorna_banco->fetch(pdo::FETCH_ASSOC);

// Verifica se o usuário foi encontrado
if (!$usuario) {
    retorna_para_login([
        'status' => 'erro',
        'mensagem' => 'Usuário não encontrado'
    ]);
}

// Verifica se a senha confere
if ($usuario['senha'] !== $senha) {
    retorna_para_login([
        'status' => 'erro_senha',
        'mensagem' => 'Senha incorreta'
    ]);
}


// Inicia a sessão e armazena os dados do usuário logado
session_start();
$_SESSION['id_responsavel'] = $usuario['id_responsavel'];
$_SESSION['nome_responsavel'] = $usuario['nome_responsavel'];

// Retorna sucesso e informa a página para redirecionamento
retorna_para_login([
    'status' => 'sucesso',
    'mensagem' => 'Login bem-sucedido, redirecionando...',
    'redirect' => '../frontend/frontend_home.php'
]);
