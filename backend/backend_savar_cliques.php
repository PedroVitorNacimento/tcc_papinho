

<?php
// salvar_clique.php
header('Content-Type: application/json');

$host = 'localhost';
$user = 'seu_usuario';
$pass = 'sua_senha';
$db = 'seu_banco';

// Receber os dados do JSON
$dadosJson = file_get_contents("php://input");
$dados = json_decode($dadosJson, true);

// Conexão
require_once "../database/conexao_banco.php";


$imagemId = intval($dados['imagemId']); // 
$criancaId = intval($dados['criancaId']); // Também é inteiro
$timestamp = $dados['timestamp']; // É string (formato ISO)

// Inserção no banco
$query = "INSERT INTO iteracoes (imagem_id, timestamp, crianca_id) VALUES ('$imagemId', '$timestamp', $criancaId)";
if ($conexao->query($query) === TRUE) {
    echo json_encode(['message' => 'Clique salvo com sucesso']);
} else {
    http_response_code(500);
    echo json_encode(['message' => 'Erro ao salvar clique: ']);
}

?>