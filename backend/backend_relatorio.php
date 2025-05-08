<?php
session_start();
require_once "../database/conexao_banco.php";

// Verifica se o usuário está logado
if (empty($_SESSION['id_responsavel'])) {
    echo json_encode(["status" => "erro", "mensagem" => "data inicio vazio."]);
    exit;
}

// Dados recebidos via POST
$data_inicio = $_POST['data_inicio'] ?? null;
$data_final = $_POST['data_final'] ?? null;
$crianca_id = $_POST['crianca_id'] ?? null;


if (empty($data_inicio)) {
    echo json_encode(["status" => "erro", "mensagem" => "data inicio vazio."]);
    exit;
}

if (empty($data_final)) {
    echo json_encode(["status" => "erro", "mensagem" => "id da criança vazio."]);
    exit;
}

if (empty($crianca_id)) {
    echo json_encode(['message' => 'id da criança vazio.']);
    exit;
}
// Verifica se a criança realmente pertence ao responsável logado
// Verifica se a criança pertence ao responsável
$queryVerifica = "SELECT 1 FROM crianca WHERE id_crianca = :id_crianca AND id_responsavel = :id_responsavel";
$stmtVerifica = $conexao->prepare($queryVerifica);
$stmtVerifica->execute([
    ':id_crianca' => $crianca_id,
    ':id_responsavel' => $_SESSION['id_responsavel']
]);

if ($stmtVerifica->rowCount() === 0) {
    echo json_encode(["status" => "erro", "mensagem" => "Criança não pertence ao responsável"]);
    exit;
}

// Consulta interações da criança no intervalo de datas trazendo o nome da imagem 
$query = "SELECT 
    iteracoes.data_iteracao,
    imagem.nome_imagem,
    crianca.nome_crianca
FROM 
    iteracoes
JOIN 
    imagem ON iteracoes.id_imagem = imagem.id_imagem
JOIN 
    crianca ON iteracoes.id_crianca = crianca.id_crianca
WHERE 
    iteracoes.id_crianca = $crianca_id
    AND DATE(iteracoes.data_iteracao) BETWEEN '$data_inicio' AND '$data_final';
";
$retorno = $conexao->query($query);
$resultado = $retorno->fetchAll(PDO::FETCH_ASSOC);

if ($resultado) {
    echo json_encode(["status" => "sucesso", "dados" => $resultado]);
} else {
    echo json_encode(["status" => "erro", "mensagem" => "Nenhum dado encontrado"]);
}
