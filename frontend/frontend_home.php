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
    <link rel="stylesheet" href="http://localhost/TCC_PAPINHO/assets/css/style_home1.css?v=1" />


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

                    Bem-vindo(a): <?php echo $_SESSION['nome_responsavel']; ?>!
                </a>



            </div>

            <!--colocando as crianças do usuario em um tag select para exibir todas as vrianças que aquele usuario cadastrou -->
            <select id="select-crianca" class="form-control w-25">
                <?php foreach ($criancas as $index => $crianca): ?>
                    <option value="<?= $crianca['id_crianca'] ?>" <?= $index === 0 ? 'selected' : '' ?>>
                        <?= $crianca['nome_crianca'] ?>
                    </option>
                <?php endforeach; ?>
            </select>



            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto"> <!-- ms-auto alinha à direita -->
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="frontend_home.php">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-door" viewBox="0 0 16 16">
                                <path d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4.5a.5.5 0 0 0 .5-.5v-4h2v4a.5.5 0 0 0 .5.5H14a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM2.5 14V7.707l5.5-5.5 5.5 5.5V14H10v-4a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v4z" />
                            </svg>
                            Início
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="frontend_relatorio.php">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-bar-graph" viewBox="0 0 16 16">
                                <path d="M10 13.5a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-6a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5zm-2.5.5a.5.5 0 0 1-.5-.5v-4a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-.5.5zm-3 0a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5z" />
                                <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2M9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5z" />
                            </svg>
                            Gerar relatório
                        </a>
                    </li>
                    <li>
                        <a class="nav-link" href="http://localhost/TCC_PAPINHO/frontend/frontend_cadastro_logado.php">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-person-fill-add" viewBox="0 0 16 16" style="margin-right: 5px;">
                                <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0m-2-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                                <path d="M2 13c0 1 1 1 1 1h5.256A4.5 4.5 0 0 1 8 12.5a4.5 4.5 0 0 1 1.544-3.393Q8.844 9.002 8 9c-5 0-6 3-6 4" />
                            </svg>
                            Cadastrar
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://localhost/TCC_PAPINHO/backend/backand_logout.php">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0z" />
                                <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z" />
                            </svg>
                            Sair
                        </a>
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
            <img src="http://localhost/TCC_PAPINHO/assets/imagens/Fome_sedeNovo.png" id="comida" class="categoria" onclick="subMenu('submenu-fome')">
            <img src="http://localhost/TCC_PAPINHO/assets/imagens/FamíliaNovo.png" id="familia" class="categoria" onclick="subMenu('submenu-familia')">
            <img src="http://localhost/TCC_PAPINHO/assets/imagens/Emoções.png" id="emocao" class="categoria" onclick="subMenu('submenu-emocao')">
            <img src="http://localhost/TCC_PAPINHO/assets/imagens/Atividades.png" id="atividades" class="categoria" onclick="subMenu('submenu-atividades')">

        </div>
        <!--submenu para fome-->
        <div class="submenu" id="submenu-fome" style="display: none;">
            <img class="submenu-img" data-som="água" data-id="6" src="http://localhost/TCC_PAPINHO/assets/imagens/Água.png" onclick="tocarSom(this)">
            <img class="submenu-img" data-som="comer" data-id="18" src="http://localhost/TCC_PAPINHO/assets/imagens/Fome.png" onclick="tocarSom(this)">
            <img class="submenu-img" data-som="fruta" data-id="19" src="http://localhost/TCC_PAPINHO/assets/imagens/Frutas.png" onclick="tocarSom(this)">
            <img class="submenu-img" data-som="lanche" data-id="20" src="http://localhost/TCC_PAPINHO/assets/imagens/Lanche.png" onclick="tocarSom(this)">
            <img class="submenu-img" data-som="leite" data-id="21" src="http://localhost/TCC_PAPINHO/assets/imagens/Leite.png" onclick="tocarSom(this)">
        </div>
        <!--submenu para familia -->
        <div class="submenu" id="submenu-familia" style="display: none;">
            <img class="submenu-img" data-som="mae" data-id="12" src="http://localhost/TCC_PAPINHO/assets/imagens/Mãe.png" onclick="tocarSom(this)">
            <img class="submenu-img" data-som="pai" data-id="11" src="http://localhost/TCC_PAPINHO/assets/imagens/Pai.png" onclick="tocarSom(this)">
            <img class="submenu-img" data-som="vó" data-id="14" src="http://localhost/TCC_PAPINHO/assets/imagens/Vovó.png" onclick="tocarSom(this)">
            <img class="submenu-img" data-som="vô" data-id="13" src="http://localhost/TCC_PAPINHO/assets/imagens/Vovô.png" onclick="tocarSom(this)">
        </div>

        <!--submenu para emocao -->
        <div class="submenu" id="submenu-emocao" style="display: none;">
            <img class="submenu-img" data-id="2" data-som="triste" src="http://localhost/TCC_PAPINHO/assets/imagens/triste.png" onclick="tocarSom(this)">
            <img class="submenu-img" data-id="4" data-som="feliz" src="http://localhost/TCC_PAPINHO/assets/imagens/feliz.png" onclick="tocarSom(this)">
            <img class="submenu-img" data-id="3" data-som="bravo" src="http://localhost/TCC_PAPINHO/assets/imagens/bravo.png" onclick="tocarSom(this)">
        </div>

        <!--submenu para atividades -->
        <div class="submenu" id="submenu-atividades" style="display: none;">
            <img class="submenu-img" data-id="15" data-som="desenhar" src="http://localhost/TCC_PAPINHO/assets/imagens/Desenhar.png" onclick="tocarSom(this)">
            <img class="submenu-img" data-id="16" data-som="livro" src="http://localhost/TCC_PAPINHO/assets/imagens/Livro.png" onclick="tocarSom(this)">
            <img class="submenu-img" data-id="17" data-som="parquinho" src="http://localhost/TCC_PAPINHO/assets/imagens/Parquinho.png" onclick="tocarSom(this)">
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