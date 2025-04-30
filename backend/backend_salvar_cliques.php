

<?php

session_start();


// salvar_clique.php
header('Content-Type: application/json');

if (!isset($_SESSION['id_responsavel'])) {
    echo json_encode(['message' => 'Sessão inválida ou expirada.']);
    exit;
}


// Receber os dados do JSON
$dadosJson = file_get_contents("php://input");

$dados = json_decode($dadosJson, true);
$responsavelid = isset($_SESSION['id_responsavel']) ? intval($_SESSION['id_responsavel']) : null;

// Verificar se os dados foram corretamente decodificados
if (is_null($dados)) {
    echo json_encode(['message' => 'Erro ao decodificar JSON. Dados inválidos.']);
    exit;
}


// Verifique se os dados necessários estão presentes no array
if (empty($dados['imagemId'])) {
    echo json_encode(['message' => 'imagem zazia.']);
    exit;
}
if (empty($dados['criancaId'])) {
    echo json_encode(['message' => 'Sem criança enviada.']);
    exit;
}
if (empty($responsavelid)) {
    echo json_encode(['message' => 'responsavel vazio.']);
    exit;
}


// Conexão
require_once "../database/conexao_banco.php";


$imagemId = intval($dados['imagemId']);
$criancaId = intval($dados['criancaId']);

// Inserção no banco
try {
    $query = "INSERT INTO iteracoes (id_imagem, id_crianca) VALUES ('$imagemId', '$criancaId')";
    $conexao->exec($query);
    echo json_encode(['message' => 'Clique salvo com sucesso']);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['message' => 'Erro ao salvar clique: ' . $e->getMessage()]);
}
exit;
?>