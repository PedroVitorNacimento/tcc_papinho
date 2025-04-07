<!DOCTYPE html>
<html lang="pt">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!-- Importação do Bootstrap para estilização -->
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
    crossorigin="anonymous" />

  <!-- Importação do jQuery para manipulação de eventos e requisições AJAX -->
  <script
    src="https://code.jquery.com/jquery-3.7.1.js"
    integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>

  <!-- Link para arquivo de estilos personalizados -->
  <link rel="stylesheet" href="http://localhost/TCC_PAPINHO/assets/css/style.css" />
  <title>Login Papinho</title>
</head>

<body>
  <div class="form-container">
    <!-- Formulário de login -->

    <div class="mb-3">
      <!-- Associando o <label> com o <input> pelo atributo 'for' -->
      <label class="form-label" for="login">Login</label>
      <input
        type="email"
        class="form-control"
        id="login"
        name="login"
        aria-describedby="emailHelp" />
    </div>
    <div class="mb-3">
      <!-- Associando o <label> com o <input> pelo atributo 'for' -->
      <label class="form-label" for="senha">Senha</label>
      <input type="password" class="form-control" id="senha" name="senha" />
    </div>

    <!-- Botão de login -->
    <button class="btn btn-primary" onclick="salvaDados()">Acessar</button>

    <!-- Botão de cadastro (ainda sem funcionalidade associada) -->
    <a href="http://localhost/TCC_PAPINHO/frontend/frontend_cadastro.php" class="btn btn-primary">Cadastrar</a>
  </div>

  <script>
    // Inicializa o jQuery quando o documento estiver pronto
    $(document).ready(function() {});

    // Função para validar e enviar os dados do formulário via AJAX
    function salvaDados() {
      let email_form = document.getElementById("login").value;
      let senha_form = document.getElementById("senha").value;
      // Validação dos campos
      if (email_form == "") {
        alert("Insira um email");
        return;
      }

      if (senha_form == "") {
        alert("Insira a senha");
        return;
      }

      // Criação do objeto com os dados do formulário
      let valida_login = {
        login: email_form,
        senha: senha_form,
      };

      // Envio dos dados via AJAX para o backend
      $.post("http://localhost/TCC_PAPINHO/backend/backend_login.php", valida_login)
        .then((variavel_com_retorno_da_api) => {
          console.log(variavel_com_retorno_da_api);

          // Verifica se houve erro no retorno da API
          if (variavel_com_retorno_da_api.status == "erro") {
            alert("Erro ao logar... usuario não encontrado");
          } else if (variavel_com_retorno_da_api.status == "erro_senha") {
            alert("Senha incorreta.");
          } else {
            // se bater os dados inseridos no login com o do banco ele redireciona para a pagina principal
            window.location.href = "http://localhost/TCC_PAPINHO/frontend/frontend_home.php";
          }
        })
        .catch(() => {
          alert("Erro ao conectar ao servidor");
        });
    }
  </script>
</body>

</html>