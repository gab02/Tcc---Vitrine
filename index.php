<!--VERIFICADA-->
<?php
#Inicia sessão
session_start();

#Verifica se sessão está ativa, caso sim, redireciona pra página de perfil
if (isset($_SESSION['logado'])) {
    header('Location: pages/perfil_artista.php');
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <title>Vitrine</title>
    <!-- LOCAL CSS Files -->
    <link href="pages/assets/css/material-dashboard.css" rel="stylesheet" />
    <link rel="icon" type="image/png" href="pages/assets/img/favicon.png">
    <link rel="apple-touch-icon" sizes="76x76" href="pages/assets/img/apple-icon.png">
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
</head>

<body style="background-image: url(pages/assets/img/cover.jpg); background-repeat: no-repeat; background-size:cover; background-attachment: fixed;">

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
                <a href="pages/login.php"  class="nav-link">
                <i class="fa fa-home"></i> Login</a>
              </li>
            </ul>
        </div>
      </div>
    </nav>

  <!-- Container Principal -->
  <div class="container">
    <div class="row" style="margin-top: 15%;">  
      <div class="col-md-7">
        <h1 class="title" style="color: white; font-family: Montserrat; font-weight: bold; text-transform: uppercase; font-size: 2.5em;">Dando uma olhadinha?</h1>
        <h4 style="color: white; font-family: Roboto;">Aproveite que parou para dar uma olhada na nossa vitrine e também faça parte da comunidade. Aqui você pode expôr a sua arte e conseguir um trabalho com isso. Não é um artista? Tudo bem, acesse e visualize a arte da galera, ou se preferir pode contratar alguém.</h4>
        <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample" style="width: 100%; background: transparent; border: 2px solid white; font-size: 0.9em; font-weight: bold;">Começar</button>
      </div>
      <!-- Collapse de seleção -->
      <div class="col-md-12">
        <div class="collapse" id="collapseExample">
          <div class="card card-body">

            <!-- Pills de seleção -->
            <div class="card card-nav-tabs card-plain">
              <div class="card-header" style="background-color: #ff742d;">
                <div class="nav-tabs-navigation">
                  <div class="nav-tabs-wrapper">
                    <ul class="nav nav-tabs" data-tabs="tabs">
                      <li class="nav-item" style="width: 50%; text-align: center;">
                        <a class="nav-link active" href="#cad_artista" data-toggle="tab">Cadastrar Artista</a>
                      </li>
                      <li class="nav-item" style="width: 50%; text-align: center;">
                        <a class="nav-link" href="#cad_contratante" data-toggle="tab">Cadastrar Contratante</a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            <!-- Páginas das Pills -->
            <div class="card-body">
              <div class="tab-content text-center">
                <div class="tab-pane active" id="cad_artista" style="height: 60px;">
                  <p>Cadastre-se como artista e exponha o seu trabalho na nossa <b>Vitrine</b> para que outros artistas como você possam conferir um pouco do que você faz.
                  <br>A grana está curta? Não tem problema! Expondo o seu trabalho você pode encontrar alguém que queira contratar os seus serviços.</p>

                  <a href="pages/form_artista.php" class="btn-primary btn" style="color: white; width: 100%;">Cadastrar Artista</a>
                </div>
                <div class="tab-pane" id="cad_contratante" style="height: 60px;">
                  <p>Está procurando por alguém que possa fazer uma arte para você? Ou quer contratar um designer para a sua empresa? Seja como for, cadastre-se como contratante e encontre uma <b>Vitrine</b> cheia de trabalhos maravilhosos para conferir e, então, encontrar o que está procurando.</p>

                  <a href="pages/form_contratante.php" class="btn-primary btn" style="color: white; width: 100%;">Cadastrar Contratante</a>
                </div>
              </div>
            </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

<!--JS HELPERS-->
<script src="pages/assets/Helpers/js/estados-cidades.js"></script>

<!--Scripts do material dashboard-->
<!--  LOCAL Core JS Files   -->
<script src="pages/assets/css/js/core/jquery.min.js" type="text/javascript"></script>
<script src="pages/assets/css/js/core/popper.min.js" type="text/javascript"></script>
<script src="pages/assets/css/js/core/bootstrap-material-design.min.js" type="text/javascript"></script>
<script src="pages/assets/css/js/plugins/perfect-scrollbar.jquery.min.js"></script>

<!--  Google Maps Plugin    -->
<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>

<!-- LOCAL Chartist JS -->
<script src="pages/assets/css/js/plugins/chartist.min.js"></script>

<!--  LOCAL Notifications Plugin    -->
<script src="pages/assets/css/js/plugins/bootstrap-notify.js"></script>

<!--LOCAL Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
<script src="pages/assets/css/js/material-dashboard.min.js?v=2.1.0" type="text/javascript"></script>

</body>
</html>
