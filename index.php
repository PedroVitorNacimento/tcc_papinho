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
  <link rel="stylesheet" href="http://localhost/TCC_PAPINHO/assets/css/style1.css" />
  <title>Login Papinho</title>
</head>

<body>
  <div class="form-container">
    <!-- Formulário de login -->
    <div class="mb-3">
      <label class="form-label" for="login">Login</label>
      <input type="email" class="form-control" id="login" name="login" aria-describedby="emailHelp" />
    </div>
    <div class="mb-3">
      <label class="form-label" for="senha">Senha</label>
      <input type="password" class="form-control" id="senha" name="senha" />
    </div>

    <!-- Botões -->
    <button class="btn btn-primary" onclick="salvaDados()">Acessar</button>
    <a href="http://localhost/TCC_PAPINHO/frontend/frontend_cadastro.php" class="btn btn-primary">Cadastrar</a>
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