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
  <link rel="stylesheet" href="http://localhost/TCC_PAPINHO/assets/css/style1.css" />

  <!-- Tema do SweetAlert2 para os alertas -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@5/dark.min.css">

  <!-- Script da biblioteca SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <title>Cadastro Responsável</title>
</head>

<body>
  <div class="container mt-4">
    <div class="form-container1">
      <!-- Formulário de cadastro -->

      <!-- Campos do formulário -->
      <label>Nome:</label>
      <div class="input-group mb-3">
        <input type="text" id="nome" name="nome" class="form-control" placeholder="Nome completo" />
      </div>

      <label>Email:</label>
      <div class="mb-3">
        <div class="input-group">
          <input type="email" name="email" id="email" class="form-control" placeholder="Insira seu email" />
        </div>
      </div>

      <label>Senha:</label>
      <div class="input-group mb-3">
        <input type="password" name="senha" id="senha" class="form-control" placeholder="Senha..." />
      </div>

      <label>Confirmação de senha:</label>
      <div class="input-group mb-3">
        <input type="password" name="confirma_senha" id="confirma_senha" class="form-control" placeholder="Confirme a senha..." />
      </div>

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
      let nome_form = document.getElementById("nome").value;
      let email_form = document.getElementById("email").value;
      let senha_form = document.getElementById("senha").value;
      let confirma_senha = document.getElementById("confirma_senha").value;
      let nome_crianca_form = document.getElementById("nome_crianca").value;
      let nascimento_form = document.getElementById("nascimento").value;


      // Validações com SweetAlert
      if (nome_form == "") {
        Swal.fire("Atenção", "Preencha o campo Nome", "warning");
        return;
      }
      if (email_form == "") {
        Swal.fire("Atenção", "Preencha o campo Email", "warning");
        return;
      }
      if (senha_form == "") {
        Swal.fire("Atenção", "Preencha o campo Senha", "warning");
        return;
      }
      if (senha_form != confirma_senha) {
        Swal.fire("Erro", "As senhas não coincidem", "error");
        return;
      }

      // Dados para enviar
      let body_backend = {
        nome: nome_form,
        email: email_form,
        senha: senha_form,
        nome_crianca: nome_crianca_form,
        nascimento: nascimento_form,
      };

      // Envia via POST
      $.post("http://localhost/TCC_PAPINHO/backend/backend_cadastro.php", body_backend)
        .then((retorno) => {
          console.log(retorno);

          if (retorno.status == "erro") {
            Swal.fire("Erro", "Erro ao cadastrar usuário", "error");
          } else {
            Swal.fire({
              title: "Cadastro realizado!",
              text: "Redirecionando para a página inicial...",
              icon: "success",
              timer: 2000,
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