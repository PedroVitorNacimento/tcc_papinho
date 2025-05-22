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
      <h4 class="mb-4 text-center">Cadastro de Usuario</h4>
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