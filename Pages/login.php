<!--verificado-->
<?php
/* @Autor: IgorShimun */
#Inicia sessão
session_start();

#Requerimento da classe usuário
require '../classes/Usuario.php';
require '../classes/Conexao.php';
require '../classes/DAO/UsuarioDAO.php';

if(isset($_POST['logar'])):
#Instancia Usuario e UsuarioDAO
$usuario = new Usuario();
$usuarioDAO = new UsuarioDAO();

#Captura as variáveis POST e Insere no Objeto Instanciado
$usuario->setLogin_usuario(filter_input(INPUT_POST, 'input_login'));
$usuario->setSenha_usuario(filter_input(INPUT_POST, 'input_password'));

#Chama logar Usuário passando PDO como parâmetro
if($usuarioDAO->logar($usuario)){
    $logando = 'ON';
    if($usuario->getCnpj_contratante() != NULL){  
        $usuario = serialize($usuario);
        $_SESSION['logado'] = $usuario;
        $_SESSION['tipo'] = 'c'; 
        header('Location: perfil_contratante.php');
    }else{  
        $usuario = serialize($usuario);
        $_SESSION['logado'] = $usuario;
        $_SESSION['tipo'] = 'a'; 
        header('Location: perfil_artista.php');
    }
        
}else{
    header('Location: login.php?erro');
}
endif;
#Verifica se sessão está ativa, caso sim, redireciona pra página de perfil
if (isset($_SESSION['logado']) && isset($_SESSION['tipo']) && !isset($logando)):
    switch ($_SESSION['tipo']){
    case 'a':
        header('Location: perfil_artista.php');
        break;
    case 'c':
        header('Location: perfil_contratante.php');
        break;
    }
endif;

if(isset($_POST['sair'])){
    unset($_SESSION['usuario']);
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="assets/img/favicon.png">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Vitrine</title>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <!-- CSS Files -->
    <link href="assets/css/material-dashboard.css" rel="stylesheet" />
    <link href="assets/css/styleLogin.css" rel="stylesheet" />
    <style>
        a:hover {
            color: #be3663;
        }
    </style>
</head>
<body>
    
                <?php if (isset($_GET['erro'])): ?>
                    <div class="alert alert-danger" style="width: 100%;"><?php echo 'Login/Senha Inválido(s)'; ?></div>
                <?php endif; ?>
                
    <!-- Navbar -->
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

        <div class="container" style="justify-content: center; flex-direction: row;">
            <div class="painel_login">
                <img src="assets/img/vitrine_logo.png" style="width: 250px; justify-content: center; display: flex; margin-left: auto; margin-right: auto;"><br><br>
                <div class="div_login_header">Bem vindo!
                
                </div>

                <!-- Corpo -->
                <form class="form-horizontal" method="post">
                    <div class="container div_login_body"><br>
                        <p style="font-size: 14px; justify-content: center; display: flex; color: #78797b; margin-top: 0.5em;">Insira as informações para fazer o login:</p>

                        <div class="form-group" style="margin-left: 5%; margin-top: 1em; width: 90%; font-family: Roboto;">
                            <label for="campo_usuario" class="bmd-label-floating">Login</label>	
                            <input type="text" class="form-control" name="input_login" id="campo_usuario" aria-describedby="basic-addon1" required>
                            <span class="bmd-help">Insira seu nome de usuário.</span></div>

                        <div class="form-group" style="margin-left: 5%; margin-top: 0.5em; width: 90%; font-family: Roboto;">
                            <label for="campo_senha" class="bmd-label-floating">Senha</label>	
                            <input type="password" class="form-control" name="input_password" id="campo_senha" aria-describedby="basic-addon1" required>
                            <span class="bmd-help">Insira sua senha de acesso.</span></div>

                        <div class="form-group form-check" style="margin-left: 5%; width: 90%; line-height: 15px; margin-top: 1em;">
                            <input type="checkbox" id="check_senha">
                            <label class="form-check-label" for="check_senha" style="margin-left: -1.7em; margin-top: -1em;">Lembrar senha</label> <a style="font-size: 12px;" href="#">(Esqueceu? Clique aqui.)</a></div>

                            <button class="btn btn-primary botao_login" type="submit" name="logar" style="color: white;">Entrar</button><br>

                        <!-- Rodapé Login -->
                        <p align="center" style="font-size: 14px; color: #78797b; margin-top: 7%;">Ainda não tem cadastro?<br>
                            <a href="#">Clique aqui para se cadastrar!</a></p><br>
                            
                    </div>
                </form>
            </div>
        </div>

    <!-- Rodapé da Página -->
    <footer class="footer" style="line-height: 10px;  position: relative; bottom: 0; left: 0; right: 0; margin: auto;">
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

<!--LOCAL JS HELPERS-->
<script src="assets/Helpers/js/estados-cidades.js"></script>

<!--Scripts do material dashboard-->
<!--   LOCAL Core JS Files   -->
<script src="assets/css/js/core/jquery.min.js" type="text/javascript"></script>
<script src="assets/css/js/core/popper.min.js" type="text/javascript"></script>
<script src="assets/css/js/core/bootstrap-material-design.min.js" type="text/javascript"></script>
<script src="assets/css/js/plugins/perfect-scrollbar.jquery.min.js"></script>



<!-- LOCAL Chartist JS -->
<script src="assets/css/js/plugins/chartist.min.js"></script>

<!-- LOCAL Notifications Plugin    -->
<script src="assets/css/js/plugins/bootstrap-notify.js"></script>

<!-- LOCAL Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
<script src="assets/css/js/material-dashboard.min.js?v=2.1.0" type="text/javascript"></script>

    </body>
</html> 