<?php

//verificando 
session_start();

// verificando se tem algum dado na session se não tiver ele manda para a pagina de login
if (empty($_SESSION['id_responsavel'])) {
    header("Location: login.php");
    exit;
}

// Conexão
require_once "../database/conexao_banco.php";
$query = "SELECT * FROM crianca WHERE id_responsavel = " . $_SESSION['id_responsavel'];
$criancas = $conexao->query($query);
$criancas = $criancas->fetchAll(PDO::FETCH_ASSOC);

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

    <script
        src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>

    <title>Papinho-Home</title>
</head>

<body id="home-body">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <div>
                <a class="navbar-brand" href="#">
                    <img src="http://localhost/TCC_PAPINHO/assets/imagens/fundo.png" class="rounded-circle me-2" width="40" height="40">

                    Bem vindo(a): <?php echo $_SESSION['nome_responsavel']; ?>!
                </a>



            </div>
            <div class="navbar-brand">Selecione uma das crianças cadastradas</div>
            <!--colocando as crianças do usuario em um tag select para exibir todas as vrianças que aquele usuario cadastrou -->
            <select id="select-crianca" class="form-control w-auto">
                <?php foreach ($criancas as $crianca): ?>
                    <option value="<?= $crianca['id_crianca'] ?>"><?= $crianca['nome_crianca'] ?></option>
                <?php endforeach; ?>
            </select>


            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto"> <!-- ms-auto alinha à direita -->
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="frontend_home.php">Início</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">Gerar relatorio</a>
                    </li>
                    <li>
                        <a class="nav-link" href="http://localhost/TCC_PAPINHO/frontend/frontend_cadastro_logado.php">Cadastrar</a>
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
            <img src="http://localhost/TCC_PAPINHO/assets/imagens/Fome_sede.png" id="comida" class="categoria" onclick="subMenu('submenu-fome')">
            <img src="http://localhost/TCC_PAPINHO/assets/imagens/Família.png" id="familia" class="categoria" onclick="subMenu('submenu-familia')">
            <img src="http://localhost/TCC_PAPINHO/assets/imagens/Emoções.png" id="emocao" class="categoria" onclick="subMenu('submenu-emocao')">
            <img src="http://localhost/TCC_PAPINHO/assets/imagens/Atividades.png" id="atividades" class="categoria" onclick="subMenu('submenu-atividades')">
            <img src="http://localhost/TCC_PAPINHO/assets/imagens/fundo.png" class="categoria" onclick="tocarSom('triste')">
            <img src="http://localhost/TCC_PAPINHO/assets/imagens/fundo.png" class="categoria" onclick="tocarSom('feliz')">
        </div>
        <!--submenu para fome-->
        <div class="submenu" id="submenu-fome" style="display: none;">
            <img class="submenu-img" data-som="água" src="http://localhost/TCC_PAPINHO/assets/imagens/Água.png" onclick="tocarSom(this)">
            <img class="submenu-img" data-som="comer" src="http://localhost/TCC_PAPINHO/assets/imagens/Fome.png" onclick="tocarSom(this)">
            <img class="submenu-img" data-som="fruta" src="http://localhost/TCC_PAPINHO/assets/imagens/Frutas.png" onclick="tocarSom(this)">
            <img class="submenu-img" data-som="lanche" src="http://localhost/TCC_PAPINHO/assets/imagens/Lanche.png" onclick="tocarSom(this)">
            <img class="submenu-img" data-som="leite" src="http://localhost/TCC_PAPINHO/assets/imagens/Leite.png" onclick="tocarSom(this)">
        </div>
        <!--submenu para familia -->
        <div class="submenu" id="submenu-familia" style="display: none;">
            <img class="submenu-img" data-som="mae" src="http://localhost/TCC_PAPINHO/assets/imagens/Mãe.png" onclick="tocarSom(this)">
            <img class=" submenu-img" data-som="pai" src="http://localhost/TCC_PAPINHO/assets/imagens/Pai.png" onclick="tocarSom(this)">
            <img class="submenu-img" data-som="vó" src="http://localhost/TCC_PAPINHO/assets/imagens/Vovó.png" onclick="tocarSom(this)">
            <img class="submenu-img" data-som="vô" src="http://localhost/TCC_PAPINHO/assets/imagens/Vovô.png" onclick="tocarSom(this)">
        </div>

        <!--submenu para emocao -->
        <div class="submenu" id="submenu-emocao" style="display: none;">
            <img class="submenu-img" data-id="2" data-som="triste" src="http://localhost/TCC_PAPINHO/assets/imagens/triste.png" onclick="tocarSom(this)">
            <img class="submenu-img" data-id="4" data-som="feliz" src="http://localhost/TCC_PAPINHO/assets/imagens/feliz.png" onclick="tocarSom(this)">
            <img class="submenu-img" data-id="3" data-som="bravo" src="http://localhost/TCC_PAPINHO/assets/imagens/bravo.png" onclick="tocarSom(this)">
        </div>

        <!--submenu para atividades -->
        <div class="submenu" id="submenu-atividades" style="display: none;">
            <img class="submenu-img" data-id="" data-som="desenhar" src="http://localhost/TCC_PAPINHO/assets/imagens/Desenhar.png" onclick="tocarSom(this)">
            <img class="submenu-img" data-id="" data-som="livro" src="http://localhost/TCC_PAPINHO/assets/imagens/Livro.png" onclick="tocarSom(this)">
            <img class="submenu-img" data-id="" data-som="parquinho" src="http://localhost/TCC_PAPINHO/assets/imagens/Parquinho.png" onclick="tocarSom(this)">
        </div>

    </div>
    <!-- Áudios que serão tocados ao clicar nas imagens -->
    <div>
        <audio id="som-água" src="http://localhost/TCC_PAPINHO/assets/sounds/água.mp3"></audio>
        <audio id="som-fruta" src="http://localhost/TCC_PAPINHO/assets/sounds/fruta.mp3"></audio>
        <audio id="som-lanche" src="http://localhost/TCC_PAPINHO/assets/sounds/lanche.mp3"></audio>
        <audio id="som-leite" src="http://localhost/TCC_PAPINHO/assets/sounds/leite.mp3"></audio>    
        <audio id="som-comer" src="http://localhost/TCC_PAPINHO/assets/sounds/fome.mp3"></audio>
        <audio id="som-desenhar" src="http://localhost/TCC_PAPINHO/assets/sounds/desenhar.mp3"></audio>
        <audio id="som-livro" src="http://localhost/TCC_PAPINHO/assets/sounds/livro.mp3"></audio>
        <audio id="som-parquinho" src="http://localhost/TCC_PAPINHO/assets/sounds/parquinho.mp3"></audio>
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
        function tocarSom(elemento) {
            const somNome = elemento.getAttribute('data-som');
            const imagemId = parseInt(elemento.getAttribute('data-id')); // ID da imagem como número

            if (somNome) {
                const som = document.getElementById('som-' + somNome);
                if (som) {
                    som.currentTime = 0;
                    som.play();
                }
            }



            // Envia os dados do clique para o backand
            fetch('http://localhost/TCC_PAPINHO/backend/backend_salvar_cliques.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        imagemId: imagemId, // Agora é inteiro
                        criancaId: $("#select-crianca").val()
                        // Substituir por ID da criança real, se possível
                    })
                })
                .then(res => res.json())
                .then(res => {
                    console.log(res);
                })
                .catch(err => {
                    console.error('Erro ao salvar clique:', err);
                });
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