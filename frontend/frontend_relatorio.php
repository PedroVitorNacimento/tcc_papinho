<?php
session_start();

// Verifica se o usuário está logado
if (empty($_SESSION['id_responsavel'])) {
    header("Location: login.php");
    exit;
}

// Conexão com o banco de dados
require_once "../database/conexao_banco.php";

// Busca as crianças cadastradas pelo responsável logado
$query = "SELECT * FROM crianca WHERE id_responsavel = " . $_SESSION['id_responsavel'];
$criancas = $conexao->query($query)->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Gerar Relatório - Papinho</title>

    <!-- CSS e bibliotecas -->
    <link rel="stylesheet" href="http://localhost/TCC_PAPINHO/assets/css/style_home1.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@5/dark.min.css">

    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
</head>

<body id="home-body">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="http://localhost/TCC_PAPINHO/assets/imagens/fundo.png" class="rounded-circle me-2" width="40" height="40">
                Bem vindo(a): <?php echo $_SESSION['nome_responsavel']; ?>!
            </a>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="frontend_home.php">Início</a></li>
                    <li class="nav-item"><a class="nav-link active" href="frontend_relatorio.php">Gerar relatório</a></li>
                    <li class="nav-item"><a class="nav-link" href="frontend_cadastro_logado.php">Cadastrar</a></li>
                    <li class="nav-item"><a class="nav-link" href="http://localhost/TCC_PAPINHO/backend/backand_logout.php">Sair</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Formulário de relatório -->
    <div class="container mt-4">
        <div class="titulo"> Relatorio de Interações</div>
        <div class="formulario_relatorio">
            <h4 class="mb-4">Gerar Relatório de Interações</h4>

            <!-- Data inicial -->
            <label for="data_inicio">Data inicial:</label>
            <div class="input-group mb-3">
                <input type="date" id="data_inicio" class="form-control" name="data_inicial">
            </div>

            <!-- Data final -->
            <label for="data_fim">Data final:</label>
            <div class="input-group mb-3">
                <input type="date" id="data_fim" class="form-control" name="data_final">
            </div>

            <!-- Seleção da criança -->
            <label for="crianca_id">Selecione a criança:</label>
            <div class="input-group mb-3">
                <select id="crianca_id" name="crianca_id" class="form-control">
                    <?php foreach ($criancas as $crianca): ?>
                        <option value="<?= $crianca['id_crianca'] ?>"><?= $crianca['nome_crianca'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Botão de gerar -->
            <div class="d-flex justify-content-between">
                <button class="btn btn-primary" onclick="gerarRelatorio()">Gerar Relatório</button>
            </div>
        </div>

        <!-- Local onde o relatório será exibido -->
        <div id="resultado-relatorio" class="mt-4"></div>
    </div>

    <script>
        function gerarRelatorio() {
            const dataInicio = $("#data_inicio").val();
            const dataFim = $("#data_fim").val();
            const criancaId = $("#crianca_id").val();

            if (!dataInicio || !dataFim || !criancaId) {
                Swal.fire("Atenção", "Preencha todos os campos", "warning");
                return;
            }

            const body_backend = {
                data_inicio: dataInicio,
                data_final: dataFim,
                crianca_id: criancaId
            };

            // Requisição ao backend via POST
            $.post("http://localhost/TCC_PAPINHO/backend/backend_relatorio.php", body_backend, function(retorno) {
                if (retorno.status === "erro") {
                    Swal.fire("Erro", "Erro ao gerar relatório", "error");
                } else {
                    // Montar HTML com os dados retornados
                    let html = "<div style='text-align:left'><h5>Relatório de Interações</h5><ul class='list-group'>";

                    retorno.dados.forEach(item => {
                        html += `<li class='list-group-item'><strong>Imagem:</strong> ${item.nome_imagem}<br>
                     <strong>Data:</strong> ${item.data_iteracao}<br>
                     <strong>Criança:</strong> ${item.nome_crianca}</li>`;
                    });

                    html += "</ul></div>";

                    Swal.fire({
                        title: "Relatório Gerado",
                        html: html + '<button id="btnImprimir" class="swal2-confirm swal2-styled" style="margin-top: 30px;">Imprimir Relatório</button>',
                        width: 600,
                        showCloseButton: true,
                        confirmButtonText: 'Fechar',
                        customClass: {
                            popup: 'relatorio-popup'
                        }
                    });


                    // Função para imprimir o conteúdo do relatorio
                    document.getElementById('btnImprimir').addEventListener('click', function() {
                        // Criar uma nova janela para impressão
                        const janelaImpressao = window.open('', '', 'height=600,width=800');
                        janelaImpressao.document.write('<html><head><title>Imprimir Relatório</title></head><body>');
                        janelaImpressao.document.write(html); // Adiciona o HTML do relatório na janela
                        janelaImpressao.document.write('</body></html>');
                        janelaImpressao.document.close();
                        janelaImpressao.print();
                    });

                }
            }, "json");
        }
    </script>
</body>

</html>