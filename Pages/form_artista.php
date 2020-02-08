<?php
include '../classes/Conexao.php';
include '../classes/Usuario.php';
include '../classes/DAO/UsuarioDAO.php';
if (isset($_POST['cadastrar'])) {

    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $login = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_STRING);

    try {
        $usuario = new Usuario();
        $usuario->setEmail_usuario($email);
        $usuario->setLogin_usuario($login);
        $usuarioDAO = new UsuarioDAO();
        if (!$usuarioDAO->existe($usuario)):
            $array_usuario = 
                [
                'id_usuario' => 0,
                'nm_usuario' => $_POST['nome'], 
                'login_usuario' => $_POST['login'],
                'senha_usuario' => md5($_POST['senha']),
                'local_usuario' => "{$_POST['estado']} - {$_POST['cidade']}",
                'email_usuario' => $_POST['email'], 
                'telefone_usuario' => $_POST['telefone'],
                'descricao_usuario' => NULL, 
                'ativo_usuario' => 1,
                'remoto_artista' => 0,
                'nascimento_artista' => $_POST['nascimento'],
                'premium_contratante' => NULL,
                'ramo_contratante' => NULL,
                'razaosocial_contratante' => NULL,
                'site_contratante' => NULL,
                'cnpj_contratante' => NULL,
                'porte_contratante' => NULL,
                ];
                
            
            $usuario->popularUsuario($array_usuario);

            if($usuarioDAO->cadastrar($usuario,'A')):
                echo "<script>alert('Cadastrado!')</script>";
                echo "<script>window.location.href='login.php'</script>";
                #header("Location: index.php");window.location.href=""
            else:
                echo 'Ouve algum problema no cadastro!';
            endif;
        endif;
        }catch (PDOException $ex){
            echo $ex->getMessage();
    }        
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <title>Vitrine</title>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <!--LOCAL CSS Files -->
    <link href="assets/css/material-dashboard.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- LOCAL JS -->
    <script src="assets/Helpers/js/estados-cidades.js"></script>
    <!--  LOCAL Core JS Files   -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://unpkg.com/popper.js@1.12.6/dist/umd/popper.js"
        integrity="sha384-fA23ZRQ3G/J53mElWqVJEGJzU0sTs+SvzG8fXVWP+kJQ1lwFAOkcUOysnlKJC33U"
        crossorigin="anonymous"></script>
    <script src="https://unpkg.com/bootstrap-material-design@4.1.1/dist/js/bootstrap-material-design.js"
        integrity="sha384-CauSuKpEqAFajSpkdjv3z9t8E7RlpJ1UP0lKM/+NdtSarroVKu069AlsRPKkFBz9"
        crossorigin="anonymous"></script>
    <script src="assets/css/js/plugins/perfect-scrollbar.jquery.min.js"></script>
    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!--LOCAL Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="assets/css/js/material-dashboard.js?v=2.1.0"></script>
</head>
<style>
  a {
    color: white;
  }
  a:hover {
    color: white;
  }
</style>
<body>
  <!-- Cabeçalho da Página -->
  <nav class="navbar navbar-transparent navbar-expand-lg">
    <div class="container">
      <div class="navbar-translate" style="color: white;">
        <a class="navbar-brand" href="#pablo"><img src="assets/img/vitrine_logo.png" style="width:15%; margin-left: -70px;" ></a>
        <button type="button" class="ml-auto navbar-toggler" data-toggle="collapse" data-target="navbar">
      </div>
        <div class="collapse navbar-collapse" id="navbar" style="margin-top: 20px;">
            <ul class="navbar-nav ml-auto">
              <li class="nav-item"  style="color: white;">
                <a href="https://www.facebook.com/vitrine.cdb/" class="nav-link" target="blank">
                <i class="fa fa-facebook-square" ></i> Facebook</a>
              </li>
              <li class="nav-item" style="color: white;">
                <a href="https://www.instagram.com/vitrine.cdb/" target="blank" class="nav-link">
                <i class="fa fa-instagram"></i> Instagram</a>
              </li>
              <li class="nav-item" style="color: white;">
                <a href="../index.php"  class="nav-link">
                <i class="fa fa-home"></i> Voltar</a>
              </li>
            </ul>
        </div>
      </div>
    </nav>

      <!-- Container Principal -->
      <div class="content">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <!-- Cabeçalho do Card -->
                <div class="card-header card-header-blank" style="background-color: #dbdbdb; color: #313131; text-transform: uppercase; font-weight: bolder;">
                Criar Perfil de Artista
                </div>

                <!-- Corpo do Card -->
                <div class="card-body">
                  <form method="post">
                  <fieldset>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating" for="campo_nome">Nome Completo</label>
                          <input type="text" class="form-control" name="nome" id="campo_nome" aria-describedby="basic-addon1">
                          <span class="bmd-help">Informe seu nome completo.</span>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="show" for="campo_nascimento" style="font-size: 11px;">Data de Nascimento</label>
                          <input type="date" class="form-control" name="nascimento" id="campo_nascimento"  aria-describedby="basic-addon1" >
                          <span class="bmd-help">Informe sua data de nascimento.</span>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating" for="campo_login">Nome de Usuário</label>
                          <input type="text" class="form-control" name="login" id="campo_usuario" aria-describedby="basic-addon1" >
                          <span class="bmd-help">Informe seu nome de usuário (os outros usuários lhe encontrão no site por meio deste).</span>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating" for="campo_senha">Senha</label>
                          <input type="password" class="form-control" name="senha" id="campo_senha"  aria-describedby="basic-addon1" >
                          <span class="bmd-help">Informe sua senha de login.</span>
                        </div>
                      </div>
                    </div>
                  </fieldset>

                  <fieldset>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating" for="campo_email" >E-Mail</label>
                          <input type="email" class="form-control" name="email" id="campo_email"  aria-describedby="basic-addon1" >
                          <span class="bmd-help">Informe seu endereço de e-mail.</span>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating" for="campo_telefone">Telefone</label>
                          <input type="text" class="form-control" name="telefone" id="campo_telefone" aria-describedby="basic-addon1" >
                          <span class="bmd-help">Informe um número de telefone (fixo ou celular).</span>
                        </div>
                      </div>
                    </div>
                  </fieldset>

                  <fieldset>
                    <div class="form-group row" style="margin-left: -17px; width: 103.5%;">
                      <div class="col-6">
                          <label for="estado" style="font-size: 11px;">Estado</label>
                          <select class="custom-select bg-light" id="estado" onchange="buscaCidades(this.value)" name="estado" >
                              <option value="">Selecione o Estado</option>
                              <option value="AC">Acre</option>
                              <option value="AL">Alagoas</option>
                              <option value="AP">Amapá</option>
                              <option value="AM">Amazonas</option>
                              <option value="BA">Bahia</option>
                              <option value="CE">Ceará</option>
                              <option value="DF">Distrito Federal</option>
                              <option value="ES">Espírito Santo</option>
                              <option value="GO">Goiás</option>
                              <option value="MA">Maranhão</option>
                              <option value="MT">Mato Grosso</option>
                              <option value="MS">Mato Grosso do Sul</option>
                              <option value="MG">Minas Gerais</option>
                              <option value="PA">Pará</option>
                              <option value="PB">Paraíba</option>
                              <option value="PR">Paraná</option>
                              <option value="PE">Pernambuco</option>
                              <option value="PI">Piauí</option>
                              <option value="RJ">Rio de Janeiro</option>
                              <option value="RN">Rio Grande do Norte</option>
                              <option value="RS">Rio Grande do Sul</option>
                              <option value="RO">Rondônia</option>
                              <option value="RR">Roraima</option>
                              <option value="SC">Santa Catarina</option>
                              <option value="SP">São Paulo</option>
                              <option value="SE">Sergipe</option>
                              <option value="TO">Tocantins</option>
                          </select>
                          <span class="bmd-help">Informe o estado onde reside.</span>
                    </div>
                      <div class="col-6">
                          <label  for="cidade" style="font-size: 11px;" class="show">Cidade</label>
                          <select class="custom-select bg-light" id="cidade" name="cidade" style="width: 100%;">
                          </select>
                          <span class="bmd-help">Informe a cidade onde reside.</span>
                      </div>    
                  </div>
                  </fieldset><br><hr>
                
                  <button name="cadastrar" type="submit" class="btn btn-primary pull-right">Cadastrar Perfil</button>
                  <div class="clearfix"></div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Rodapé da Página -->
      <footer class="footer">
        <div class="container" style="line-height: 10px;">
          <nav>
            <ul style="color: white;">
              <li>
                <a href="#">Codebox</a>
              </li>
              <li>
                <a href="#">Sobre Nós</a>
              </li>
              <li>
                <a href="#">Licenças</a>
              </li>
            </ul>
          </nav>
          <div class="copyright" id="date" style="color: white; font-size: 12px; margin-top: -1em;">, desenvolvido por <a class="a" href="#" target="_blank">CODEBOX</a>.</div>
        </div>
      </footer>
      <!-- Script para pegar o ano do rodapé -->
      <script>
        const x = new Date().getFullYear();
        let date = document.getElementById('date');
        date.innerHTML = '&copy; ' + x + date.innerHTML;
      </script>
    </div>
  </div>

</body>
</html>