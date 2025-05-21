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

    <title>Cadastro Responsável</title>


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
                        <a class="nav-link " aria-current="page" href="frontend_home.php">Início</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="frontend_relatorio.php">Gerar relatorio</a>
                    </li>
                    <li>
                        <a class="nav-link active" href="http://localhost/TCC_PAPINHO/frontend/frontend_cadastro_logado.php">Cadastrar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://localhost/TCC_PAPINHO/backend/backand_logout.php">Sair</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">


        <div class="titulo"> Cadastre uma criança nova</div>
        <div class="form-container2">
            <h4 class="mb-4">Cadastrar Criança</h4>
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
                <button class="btn btn-secondary" onclick="history.back()">Voltar</button>
                <button class="btn btn-primary" onclick="salvaFormulario()">Salvar</button>
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