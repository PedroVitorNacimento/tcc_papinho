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
    <link rel="stylesheet" href="http://localhost/TCC_PAPINHO/assets/css/style_home.css" />


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
    <div class="main-content">
        <!-- titulo da tela -->
        <div class="titulo">Escolha uma categoria</div>

        <!--grid com imagens representando categorias-->
        <div class="grid-categorias">
            <img src="http://localhost/TCC_PAPINHO/assets/imagens/comer.png" class="categoria" onclick="tocarSom('comer')">
            <img src="http://localhost/TCC_PAPINHO/assets/imagens/fome.png" class="categoria" onclick="tocarSom('brincar')">
            <img src="/assets/imagens/banheiro.png" class="categoria" onclick="tocarSom('banheiro')">
            <img src="/assets/imagens/dormir.png" class="categoria" onclick="tocarSom('dormir')">
            <img src="/assets/imagens/triste.png" class="categoria" onclick="tocarSom('triste')">
            <img src="/assets/imagens/feliz.png" class="categoria" onclick="tocarSom('feliz')">
        </div>

    </div>
    <!-- Áudios que serão tocados ao clicar nas imagens -->
    <audio id="som-comer" src="http://localhost/TCC_PAPINHO/assets/sounds/fome.mp3"></audio>
    <audio id="som-brincar" src="http://localhost/TCC_PAPINHO/assets/sounds/teste.mp3"></audio>
    <audio id="som-banheiro" src="/assets/sounds/banheiro.mp3"></audio>
    <audio id="som-dormir" src="/assets/sounds/dormir.mp3"></audio>
    <audio id="som-triste" src="/assets/sounds/triste.mp3"></audio>
    <audio id="som-feliz" src="/assets/sounds/feliz.mp3"></audio>

    <!-- Script para tocar o som correspondente -->
    <script>
        function tocarSom(nome) {
            const som = document.getElementById('som-' + nome);
            if (som) {
                som.currentTime = 0; // Reinicia o áudio do começo
                som.play(); // Toca o áudio
            }
        }
    </script>
</body>

</html>