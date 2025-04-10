<?php

//verificando 
session_start();

// verificando se tem algum dado na session se não tiver ele manda para a pagina de login
if (empty($_SESSION['id_responsavel'])) {
    header("Location: login.php");
    exit;
}

// se tiver certo ele  exibe o id do usuario 
?>
<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/style.css" />
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet" />

    <title>Papinho-Home</title>
</head>

<body id="home-body">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">

            <a class="navbar-brand" href="#">
                <img src="http://localhost/TCC_PAPINHO/assets/imagens/Papinho_logo.png" class="rounded-circle me-2" width="40" height="40">

                Bem vindo(a): <?php echo $_SESSION['nome_responsavel']; ?>!</a>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto"> <!-- ms-auto alinha à direita -->
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="frontend_home.php">Início</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">Gerar relatorio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://localhost/TCC_PAPINHO/backend/backand_logout.php">Sair</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


</body>

</html>