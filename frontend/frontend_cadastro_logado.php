<?php
//verificando 
session_start();

// verificando se tem algum dado na session se não tiver ele manda para a pagina de login
if (empty($_SESSION['id_responsavel'])) {
    header("Location: login.php");
    exit;
}
?>


<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Importação do jQuery para facilitar manipulação do DOM e requisições AJAX -->
    <script src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

    <!-- Importação do Bootstrap para estilização -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
        crossorigin="anonymous" />

    <!-- Estilo personalizado -->
    <link rel="stylesheet" href="http://localhost/TCC_PAPINHO/assets/css/style1.css?v=1" />

    <!-- Tema do SweetAlert2 para os alertas -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@5/dark.min.css">

    <!-- Script da biblioteca SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <title>Nova Criança</title>


</head>

<body class="cadastro_body">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <div>
                <a class="navbar-brand" href="#">
                    <img src="http://localhost/TCC_PAPINHO/assets/imagens/fundo.png" class="rounded-circle me-2" width="40" height="40">

                    Bem vindo(a): <?php echo $_SESSION['nome_responsavel']; ?>!
                </a>



            </div>


            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto"> <!-- ms-auto alinha à direita -->
                    <li class="nav-item">
                        <a class="nav-link " aria-current="page" href="frontend_home.php">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-door" viewBox="0 0 16 16">
                                <path d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4.5a.5.5 0 0 0 .5-.5v-4h2v4a.5.5 0 0 0 .5.5H14a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM2.5 14V7.707l5.5-5.5 5.5 5.5V14H10v-4a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v4z" />
                            </svg>
                            Início</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="frontend_relatorio.php">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-bar-graph" viewBox="0 0 16 16">
                                <path d="M10 13.5a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-6a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5zm-2.5.5a.5.5 0 0 1-.5-.5v-4a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-.5.5zm-3 0a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5z" />
                                <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2M9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5z" />
                            </svg>
                            Gerar relatorio</a>
                    </li>
                    <li>
                        <a class="nav-link active" href="http://localhost/TCC_PAPINHO/frontend/frontend_cadastro_logado.php">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-person-fill-add" viewBox="0 0 16 16" style="margin-right: 5px;">
                                <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0m-2-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                                <path d="M2 13c0 1 1 1 1 1h5.256A4.5 4.5 0 0 1 8 12.5a4.5 4.5 0 0 1 1.544-3.393Q8.844 9.002 8 9c-5 0-6 3-6 4" />
                            </svg>
                            Cadastrar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://localhost/TCC_PAPINHO/backend/backand_logout.php">
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

    <div class="container mt-4">


        <div class="titulo"> Cadastre uma criança nova</div>
        <div class="form-container2">
            <h4 class="mb-4 text-center">Cadastrar Criança</h4>
            <!-- Formulário de cadastro -->

            <!-- Campos do formulário -->

            <label>Nome criança:</label>
            <div class="input-group mb-3">
                <input type="text" id="nome_crianca" name="nome_crianca" class="form-control" placeholder="Nome criança" />
            </div>

            <label>Data de nascimento</label>
            <div class="input-group mb-3">
                <input type="date" class="form-control" id="nascimento" name="nascimento" />
            </div>



            <!-- Botões -->
            <div class="d-flex justify-content-between">
                <button class="btn btn-primary" onclick="history.back()">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0z" />
                        <path fill-rule="evenodd" d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708z" />
                    </svg>
                    Voltar</button>
                <button class="btn btn-primary" onclick="salvaFormulario()">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-save2" viewBox="0 0 16 16">
                        <path d="M2 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H9.5a1 1 0 0 0-1 1v4.5h2a.5.5 0 0 1 .354.854l-2.5 2.5a.5.5 0 0 1-.708 0l-2.5-2.5A.5.5 0 0 1 5.5 6.5h2V2a2 2 0 0 1 2-2H14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h2.5a.5.5 0 0 1 0 1z" />
                    </svg>
                    Salvar</button>
            </div>
        </div>
    </div>
    <script>
        function salvaFormulario() {

            let nome_crianca_form = document.getElementById("nome_crianca").value;
            let nascimento_form = document.getElementById("nascimento").value;

            // Validações com SweetAlert
            if (nome_crianca_form == "") {
                Swal.fire("Atenção", "Preencha o campo Nome", "warning");
                return;
            }
            if (nascimento_form == "") {
                Swal.fire("Atenção", "Preencha o campo Data de nascimento", "warning");
                return;
            }

            // Dados para enviar
            let body_backend = {

                nome_crianca: nome_crianca_form,
                nascimento: nascimento_form,
            };

            // Envia via POST
            $.post("http://localhost/TCC_PAPINHO/backend/backend_cadastro_logado.php", body_backend)
                .then((retorno) => {
                    console.log(retorno);

                    if (retorno.status == "erro1") {
                        Swal.fire("Erro", " Criança já Cadastrada !", "error");
                    } else {
                        Swal.fire({
                            title: "Cadastro realizado!",
                            text: "Nova criança cadastrada selecione a criança e continue se divertindo",
                            icon: "success",
                            timer: 4000,
                            showConfirmButton: false
                        }).then(() => {
                            window.location.href = "http://localhost/TCC_PAPINHO/frontend/frontend_home.php";
                        });
                    }
                })
                .catch(() => {
                    Swal.fire("Erro", "Erro ao conectar ao servidor", "error");
                });
        }
    </script>
</body>

</html>