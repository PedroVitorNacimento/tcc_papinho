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
                <img src="http://localhost/TCC_PAPINHO/assets/imagens/fundo.png" class="rounded-circle me-2" width="40" height="40">

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
            <img src="http://localhost/TCC_PAPINHO/assets/imagens/comer.png" id="comida" class="categoria" onclick="subMenu('submenu-fome')">
            <img src="http://localhost/TCC_PAPINHO/assets/imagens/fome.png" id="familia" class="categoria" onclick="subMenu('submenu-familia')">
            <img src="http://localhost/TCC_PAPINHO/assets/imagens/fundo.png" id="emocao" class="categoria" onclick="subMenu('submenu-emocao')">
            <img src="http://localhost/TCC_PAPINHO/assets/imagens/fundo.png" class="categoria" onclick="tocarSom('dormir')">
            <img src="http://localhost/TCC_PAPINHO/assets/imagens/fundo.png" class="categoria" onclick="tocarSom('triste')">
            <img src="http://localhost/TCC_PAPINHO/assets/imagens/fundo.png" class="categoria" onclick="tocarSom('feliz')">
        </div>
        <!--submenu para fome-->
        <div class="submenu" id="submenu-fome" style="display: none;">
            <img class="submenu-img" src="http://localhost/TCC_PAPINHO/assets/imagens/fome.png" onclick="tocarSom('brincar')">
            <img class="submenu-img" src="http://localhost/TCC_PAPINHO/assets/imagens/fundo.png" onclick="tocarSom('comer')">
            <img class="submenu-img" src="http://localhost/TCC_PAPINHO/assets/imagens/comer.png" onclick="tocarSom('banheiro')">
        </div>
        <!--submenu para familia -->
        <div class="submenu" id="submenu-familia" style="display: none;">
            <img class="submenu-img" src="http://localhost/TCC_PAPINHO/assets/imagens/Mãe.png" onclick="tocarSom('mae')">
            <img class=" submenu-img" src="http://localhost/TCC_PAPINHO/assets/imagens/Pai.png" onclick="tocarSom('pai')">
            <img class="submenu-img" src="http://localhost/TCC_PAPINHO/assets/imagens/Vovó.png" onclick="tocarSom('vó')">
            <img class="submenu-img" src="http://localhost/TCC_PAPINHO/assets/imagens/Vovô.png" onclick="tocarSom('vô')">
        </div>

        <!--submenu para emocao -->
        <div class="submenu" id="submenu-emocao" style="display: none;">
            <img class="submenu-img" src="http://localhost/TCC_PAPINHO/assets/imagens/triste.png" onclick="tocarSom('triste')">
            <img class="submenu-img" src="http://localhost/TCC_PAPINHO/assets/imagens/feliz.png" onclick="tocarSom('feliz')">
            <img class="submenu-img" src="http://localhost/TCC_PAPINHO/assets/imagens/bravo.png" onclick="tocarSom('bravo')">
        </div>

    </div>
    <!-- Áudios que serão tocados ao clicar nas imagens -->
    <div>

        <audio id="som-comer" src="http://localhost/TCC_PAPINHO/assets/sounds/fome.mp3"></audio>
        <audio id="som-brincar" src="http://localhost/TCC_PAPINHO/assets/sounds/teste.mp3"></audio>
        <audio id="som-banheiro" src="http://localhost/TCC_PAPINHO/assets/sounds/louco.mp3"></audio>
        <audio id="som-mae" src="http://localhost/TCC_PAPINHO/assets/sounds/mae.mp3"></audio>
        <audio id="som-vó" src="http://localhost/TCC_PAPINHO/assets/sounds/vó.mp3"></audio>
        <audio id="som-vô" src="http://localhost/TCC_PAPINHO/assets/sounds/vô.mp3"></audio>
        <audio id="som-pai" src="http://localhost/TCC_PAPINHO/assets/sounds/pai.mp3"></audio>
        <audio id="som-triste" src="http://localhost/TCC_PAPINHO/assets/sounds/triste.mp3"></audio>
        <audio id="som-feliz" src="http://localhost/TCC_PAPINHO/assets/sounds/feliz.mp3"></audio>
        <audio id="som-bravo" src="http://localhost/TCC_PAPINHO/assets/sounds/bravo.mp3"></audio>
    </div>
    <!-- Script para tocar o som correspondente -->
    <script>
        function tocarSom(nome) {
            const som = document.getElementById('som-' + nome);
            if (som) {
                som.currentTime = 0; // Reinicia o áudio do começo
                som.play(); // Toca o áudio
            }
        }

        function subMenu(id) {
            const subMenu = document.getElementById(id)
            subMenu.style.display = subMenu.style.display === 'flex' ? 'none' : 'flex';
        }

        function tocarSomEAbrirSubmenu(nomeCategoria, idSubmenu) {
            // Toca o som correspondente à categoria
            const som = document.getElementById('som-' + nomeCategoria); // Ex: 'som-comer'
            if (som) {
                som.currentTime = 0; // Reinicia o áudio do início
                som.play(); // Toca o áudio
            }

            // Fecha todos os submenus abertos
            const todosSubmenus = document.querySelectorAll('.submenu-fome'); // Seleciona todos os submenus pela classe
            todosSubmenus.forEach(function(submenu) {
                submenu.style.display = 'none'; // Esconde cada submenu
            });

            // Exibe o submenu desejado
            const submenuSelecionado = document.getElementById(idSubmenu); // Pega o submenu pelo ID
            if (submenuSelecionado) {
                submenuSelecionado.style.display = 'flex'; // Mostra o submenu escolhido
            }
        }


        let submenuAberto = null;

        function subMenu(id) {
            // Fecha o submenu anterior, se existir e for diferente do atual
            if (submenuAberto && submenuAberto.id !== id) {
                submenuAberto.style.display = 'none';
            }

            const novoSubMenu = document.getElementById(id);
            const visivel = novoSubMenu.style.display === 'flex';

            novoSubMenu.style.display = visivel ? 'none' : 'flex';
            submenuAberto = visivel ? null : novoSubMenu;
        }

        // Fecha o submenu se clicar fora dele
        document.addEventListener('click', function(event) {
            if (submenuAberto && !submenuAberto.contains(event.target) && !event.target.classList.contains('categoria')) {
                submenuAberto.style.display = 'none';
                submenuAberto = null;
            }
        });
    </script>
</body>

</html>