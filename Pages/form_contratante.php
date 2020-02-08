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
                ['id_usuario' => 0,
                 'nm_usuario' => $_POST['nome'], 
                 'login_usuario' => $_POST['login'],
                 'senha_usuario' => md5($_POST['senha']),
                 'local_usuario' => "{$_POST['estado']} - {$_POST['cidade']}",
                 'email_usuario' => $_POST['email'], 
                 'telefone_usuario' => $_POST['telefone'],
                 'descricao_usuario' => $_POST['descricao'], 
                 'premium_contratante' => 0, 
                 'ramo_contratante' => $_POST['ramo'], 
                 'razaosocial_contratante' => $_POST['razao_social'], 
                 'site_contratante' => $_POST['site'], 
                 'cnpj_contratante' => $_POST['cnpj'], 
                 'porte_contratante' => $_POST['porte']
                ];
            $usuario->popularUsuario($array_usuario);
            if($usuarioDAO->cadastrar($usuario,'C')):
                echo "<script>alert('Cadastrado!')</script>";
                echo "<script>window.location.href='login.php'</script>";
                #header("Location: index.php");
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
    <!-- CSS Files -->
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <!-- CSS Files -->
    <link href="assets/css/material-dashboard.css" rel="stylesheet" />
</head>
<body>

    <!-- Cabeçalho da Página -->
    <nav class="navbar navbar-transparent navbar-expand-lg">
        <div class="container">
            <div class="navbar-translate" style="font-weight: bolder; text-transform: uppercase; font-family: Montserrat;">
                <a class="navbar-brand" style="color: white; font-size: 25px;">Vitrine</a>
            </div>
        <div class="collapse navbar-collapse" id="navbar">
            <ul class="navbar-nav ml-auto" style="margin-left: -20em;">
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
                Criar Perfil de Contratante
                </div>

                <!-- Corpo do Card -->
                <div class="card-body">
                  <form method="post">
                  <fieldset>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                            <label class="bmd-label-floating" for="campo_email" >E-Mail</label>
                            <input type="email" class="form-control" name="email" id="campo_email" aria-describedby="basic-addon1" required>
                            <span class="bmd-help">Informe o endereço de e-mail da empresa.</span>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                            <label class="bmd-label-floating" for="campo_login">Usuário</label>
                            <input type="text" class="form-control" name="login" id="campo_login"  aria-describedby="basic-addon1" required>
                            <span class="bmd-help">Informe o nome de usuário da empresa (os outros usuários a encontrão no site por meio deste).</span>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                            <label class="bmd-label-floating" for="campo_senha">Senha</label>
                            <input type="password" class="form-control" name="senha" id="campo_senha"  aria-describedby="basic-addon1" required>
                            <span class="bmd-help">Informe a senha de login.</span>
                        </div>
                      </div>
                    </div>
                  </fieldset>

                  <fieldset>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                            <label class="bmd-label-floating" for="campo_nome">Nome Fantasia</label>
                            <input type="text" class="form-control" name="nome" id="campo_nome" aria-describedby="basic-addon1" required>
                            <span class="bmd-help">Informe o nome fantasia da empresa.</span>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                            <label class="bmd-label-floating" for="campo_razao_social">Razão Social</label>
                            <input type="text" class="form-control" name="razao_social" id="campo_razao_social"  aria-describedby="basic-addon1" required>
                            <span class="bmd-help">Informe a razão social da empresa.</span>
                        </div>
                      </div>
                    </div>
                  </fieldset>

                  <fieldset>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="bmd-label-floating" for="campo_telefone">Telefone</label>
                                <input type="text" class="form-control" name="telefone" id="campo_telefone" aria-describedby="basic-addon1" required>
                                <span class="bmd-help">Informe um número de telefone da empresa.</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="bmd-label-floating" for="campo_site">Site da Empresa</label>
                                <input type="text" class="form-control" name="site" id="campo_site" aria-describedby="basic-addon1">
                                <span class="bmd-help">Informe, caso exista, o site da empresa.</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="bmd-label-floating" for="campo_cnpj">CNPJ</label>
                                <input type="text" class="form-control" name="cnpj" id="campo_cnpj" aria-describedby="basic-addon1" required>
                                <span class="bmd-help">Informe o número de CNPJ da empresa.</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="bmd-label-floating" for="campo_ramo">Ramo de atuação</label>
                                <input type="text" class="form-control" name="ramo" id="campo_ramo" aria-describedby="basic-addon1" required>
                                <span class="bmd-help">Informe o ramo em que a empresa atua.</span>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="bmd-label-floating" for="campo_descricao">Descrição</label>
                                <textarea class="form-control" rows='4' name="descricao" id="campo_descricao" aria-describedby="basic-addon1" required></textarea>
                                <span class="bmd-help">Escreva uma breve descrição sobre a empresa.</span>
                            </div>
                        </div>
                    </div>
                    </fieldset>

                    <fieldset>
                    <div class="form-group row" style="margin-left: -17px; width: 103.5%;">
                        <div class="col-md-12">
                                <label class="show" for="campo_funcionarios" style="font-size: 11px;">Porte da Empresa</label>
                                <select class="custom-select bg-light" name="porte" required>
                                    <option value="NULL">Não se aplica</option>
                                    <option value="Pequena">Pequeno porte (20 a 99 empregados)</option>
                                    <option value="Média">Médio porte (100 a 499 empregados)</option>
                                    <option value="Grande">Grande porte (mais de 500 empregados)</option>
                                </select>
                                <span class="bmd-help">Informe o porte da empresa.</span>
                        </div>
                    </div>
                  </fieldset>

                  <fieldset>
                    <div class="form-group row" style="margin-left: -17px; width: 103.5%;">
                      <div class="col-6">
                          <label for="estado" style="font-size: 11px;">Estado</label>
                          <select class="custom-select bg-light" id="estado" onchange="buscaCidades(this.value)" name="estado" required>
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
                          <span class="bmd-help">Informe o estado onde a empresa se localiza.</span>
                    </div>
                      <div class="col-6">
                          <label  for="cidade" style="font-size: 11px;" class="show">Cidade</label>
                          <select class="custom-select bg-light" id="cidade" name="cidade" style="width: 100%;" required>
                          </select>
                          <span class="bmd-help">Informe a cidade onde a empresa se localiza.</span>
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
      <footer class="footer" style="line-height: 10px;">
        <div class="container">
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
          <div class="copyright" id="date" style="color: white; font-size: 12px; margin-top: -1em; margin-left: 0.8em;"> <a class="a" href="#" target="_blank">CODEBOX</a>.</div>
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
  <!--JS HELPERS-->
  <script src="assets/Helpers/js/estados-cidades.js"></script>

  <!--Scripts do material dashboard-->
  <!--   Core JS Files   -->
  <script src="assets/css/js/core/jquery.min.js" type="text/javascript"></script>
  <script src="assets/css/js/core/popper.min.js" type="text/javascript"></script>
  <script src="assets/css/js/core/bootstrap-material-design.min.js" type="text/javascript"></script>
  <script src="assets/css/js/plugins/perfect-scrollbar.jquery.min.js"></script>

  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>

  <!-- Chartist JS -->
  <script src="assets/css/js/plugins/chartist.min.js"></script>

  <!--  Notifications Plugin    -->
  <script src="assets/css/js/plugins/bootstrap-notify.js"></script>

  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="assets/css/js/material-dashboard.min.js?v=2.1.0" type="text/javascript"></script>

</body>
</html>
