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
    <link rel="stylesheet" href="http://localhost/TCC_PAPINHO/assets/css/style_home1.css?v=2" />
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
                    <li class="nav-item">
                        <a class="nav-link" href="frontend_home.php">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-door" viewBox="0 0 16 16">
                                <path d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4.5a.5.5 0 0 0 .5-.5v-4h2v4a.5.5 0 0 0 .5.5H14a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM2.5 14V7.707l5.5-5.5 5.5 5.5V14H10v-4a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v4z" />
                            </svg>
                            Início</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="frontend_relatorio.php">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-bar-graph" viewBox="0 0 16 16">
                                <path d="M10 13.5a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-6a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5zm-2.5.5a.5.5 0 0 1-.5-.5v-4a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-.5.5zm-3 0a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5z" />
                                <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2M9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5z" />
                            </svg>
                            Gerar relatório</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="frontend_cadastro_logado.php">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-person-fill-add" viewBox="0 0 16 16" style="margin-right: 5px;">
                                <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0m-2-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                                <path d="M2 13c0 1 1 1 1 1h5.256A4.5 4.5 0 0 1 8 12.5a4.5 4.5 0 0 1 1.544-3.393Q8.844 9.002 8 9c-5 0-6 3-6 4" />
                            </svg>
                            Cadastrar</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="http://localhost/TCC_PAPINHO/backend/backand_logout.php">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0z" />
                                <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z" />
                            </svg>
                            Sair</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Formulário de relatório -->
    <div class="container mt-4">
        <div class="titulo"> Relatorio de Interações</div>
        <div class="formulario_relatorio">
            <h4 class="mb-4 text-center">Gerar Relatório de Interações</h4>

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
                <button class="btn btn-primary" onclick="gerarRelatorio()">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-bar-graph" viewBox="0 0 16 16">
                        <path d="M10 13.5a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-6a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5zm-2.5.5a.5.5 0 0 1-.5-.5v-4a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-.5.5zm-3 0a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5z" />
                        <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2M9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5z" />
                    </svg>
                    Gerar Relatório</button>
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
                    Swal.fire("Erro", "Não há registo na data selecionada !!", "error");
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