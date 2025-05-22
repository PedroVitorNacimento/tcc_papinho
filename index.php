<!DOCTYPE html>
<html lang="pt">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!-- Bootstrap para estilização -->
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
    crossorigin="anonymous" />

  <!-- jQuery para AJAX -->
  <script
    src="https://code.jquery.com/jquery-3.7.1.js"
    integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>

  <!-- SweetAlert2 para alertas bonitos -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- Estilos personalizados -->
  <link rel="stylesheet" href="http://localhost/TCC_PAPINHO/assets/css/style1.css?v=1" />
  <title>Login Papinho</title>
</head>

<body>
  <div class="form-container">
    <!-- Formulário de login -->
    <div class="mb-3">
      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-door-open" viewBox="0 0 16 16">
        <path d="M8.5 10c-.276 0-.5-.448-.5-1s.224-1 .5-1 .5.448.5 1-.224 1-.5 1" />
        <path d="M10.828.122A.5.5 0 0 1 11 .5V1h.5A1.5 1.5 0 0 1 13 2.5V15h1.5a.5.5 0 0 1 0 1h-13a.5.5 0 0 1 0-1H3V1.5a.5.5 0 0 1 .43-.495l7-1a.5.5 0 0 1 .398.117M11.5 2H11v13h1V2.5a.5.5 0 0 0-.5-.5M4 1.934V15h6V1.077z" />
      </svg>
      <label class="form-label" for="login">Login</label>

      <input type="email" class="form-control" placeholder="Digite seu e-mail" id="login" name="login" aria-describedby="emailHelp" />
    </div>
    <div class="mb-3">
      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-key" viewBox="0 0 16 16">
        <path d="M0 8a4 4 0 0 1 7.465-2H14a.5.5 0 0 1 .354.146l1.5 1.5a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0L13 9.207l-.646.647a.5.5 0 0 1-.708 0L11 9.207l-.646.647a.5.5 0 0 1-.708 0L9 9.207l-.646.647A.5.5 0 0 1 8 10h-.535A4 4 0 0 1 0 8m4-3a3 3 0 1 0 2.712 4.285A.5.5 0 0 1 7.163 9h.63l.853-.854a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.793-.793-1-1h-6.63a.5.5 0 0 1-.451-.285A3 3 0 0 0 4 5" />
        <path d="M4 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0" />
      </svg>
      <label class="form-label" for="senha">Senha</label>

      <input type="password" class="form-control" placeholder="Digite sua senha" id="senha" name="senha" />
    </div>

    <!-- Botões -->
    <button class="btn btn-primary" onclick="salvaDados()"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-door-open" viewBox="0 0 16 16">
        <path d="M8.5 10c-.276 0-.5-.448-.5-1s.224-1 .5-1 .5.448.5 1-.224 1-.5 1" />
        <path d="M10.828.122A.5.5 0 0 1 11 .5V1h.5A1.5 1.5 0 0 1 13 2.5V15h1.5a.5.5 0 0 1 0 1h-13a.5.5 0 0 1 0-1H3V1.5a.5.5 0 0 1 .43-.495l7-1a.5.5 0 0 1 .398.117M11.5 2H11v13h1V2.5a.5.5 0 0 0-.5-.5M4 1.934V15h6V1.077z" />
      </svg>

      Acessar
    </button>
    <a href="http://localhost/TCC_PAPINHO/frontend/frontend_cadastro.php" class="btn btn-primary">
      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
        class="bi bi-person-fill-add" viewBox="0 0 16 16" style="margin-right: 5px;">
        <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0m-2-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
        <path d="M2 13c0 1 1 1 1 1h5.256A4.5 4.5 0 0 1 8 12.5a4.5 4.5 0 0 1 1.544-3.393Q8.844 9.002 8 9c-5 0-6 3-6 4" />
      </svg>
      Cadastrar</a>
  </div>

  <script>
    // Função para validar e enviar os dados do formulário
    $("#senha").on("keyup", function(e) {
      if (e.keyCode == 13) {
        salvaDados();
      }
    })

    function salvaDados() {
      let email_form = document.getElementById("login").value;
      let senha_form = document.getElementById("senha").value;

      // Validação com SweetAlert2
      if (email_form == "") {
        Swal.fire({
          icon: 'warning',
          title: 'Campo vazio',
          text: 'Por favor, insira um e-mail.',
        });
        return;
      }

      if (senha_form == "") {
        Swal.fire({
          icon: 'warning',
          title: 'Campo vazio',
          text: 'Por favor, insira a senha.',
        });
        return;
      }

      let valida_login = {
        login: email_form,
        senha: senha_form,
      };

      // Requisição AJAX para login
      $.post("http://localhost/TCC_PAPINHO/backend/backend_login.php", valida_login)
        .then((variavel_com_retorno_da_api) => {
          console.log(variavel_com_retorno_da_api);

          if (variavel_com_retorno_da_api.status == "erro") {
            // Alerta de erro com SweetAlert2
            Swal.fire({
              icon: 'error',
              title: 'Usuário não encontrado',
              text: 'Verifique se o e-mail está correto.',
            });
          } else if (variavel_com_retorno_da_api.status == "erro_senha") {
            // Alerta de senha incorreta
            Swal.fire({
              icon: 'error',
              title: 'Senha incorreta',
              text: 'Por favor, tente novamente.',
            });
          } else {
            // Sucesso: redireciona com um alerta de boas-vindas
            Swal.fire({
              icon: 'success',
              title: 'Login realizado!',
              text: 'Bem-vindo(a) de volta!',
              timer: 1500,
              showConfirmButton: false
            }).then(() => {
              window.location.href = "http://localhost/TCC_PAPINHO/frontend/frontend_home.php";
            });
          }
        })
        .catch(() => {
          // Erro de conexão com servidor
          Swal.fire({
            icon: 'error',
            title: 'Erro de conexão',
            text: 'Não foi possível se conectar ao servidor. Tente mais tarde.',
          });
        });
    }
  </script>
</body>

</html>