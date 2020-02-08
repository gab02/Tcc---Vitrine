<?php
session_start();

#Chama Classe Usuario para que o objeto passado por sessão sejá integro
include '../classes/Usuario.php';
include '../classes/DAO/UsuarioDAO.php';
include '../classes/Experiencia.php';
include '../classes/DAO/ExperienciaDAO.php';

#SE sessão de usuário ativa, unserializa SENÃO Redireciona pra Index
if (isset($_SESSION['logado'])) {
    $logado = $_SESSION['logado'];
    $usuario = unserialize($logado);
    $uDAO = new UsuarioDAO();
    $uDAO->buscar_foto($usuario);
} else {
    header('Location: ../index.php');
}

#SE apertar botão deslogar SAI
if (isset($_GET['deslogar'])) {
    unset($_SESSION['logado']);
    header('Location: ../index.php');
}

if (isset($_GET['action']) and $_GET['action'] == "edit_ft"):
    if (isset($_POST['fotoperfil'])):
        if (isset($_FILES['capa'])) :
            $nomedoarquivo = md5($_FILES['capa']['name'] . time() . rand(0, 99)) . '.jpg';

            move_uploaded_file($_FILES['capa']['tmp_name'], '../img/foto_perfil/' . $nomedoarquivo);

            $uDAO = new UsuarioDAO();

            $caminho = '../img/foto_perfil/' . $nomedoarquivo;
            $uDAO->inserir_perfil($usuario, $caminho);
            
            header('Location: perfil_artista.php');
        endif;
    else:
        echo 'moio';
    endif;
endif;
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="assets/img/favicon.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Vitrine</title>
    <!-- MATERIAL DASHBOARD CSS -->
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"
        integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <!-- CSS Files -->
    <link href="assets/css/material-dashboard.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />

    <style>
        p {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-height: 200px;
        }

        .titulo-vaga {
            color: #fe803f;
        }
    </style>

</head>

<body>
    <!-- Sidebar -->
    <div class="sidenav" id="sidebarId"
        style="box-shadow: 0px 0px 10px 0px #2e2e2e; font-size: 15px; font-weight: bolder;">
        <img src="assets/img/vitrine_logo_c.png" style="width: 150px; margin-top: -3em; margin-left: 1.5em;">
        <hr>

        <!-- if artista -->
        <nav class="nav flex-column">
            <a class="nav-link a2" href="portfolio.php"><i class="fas fa-palette"></i> Portfólio</a>
            <a class="nav-link a2" href="dashboard.php"><i class="fas fa-th-large"></i> Dashboard</a>
            <!--<a class="nav-link a2" href="#"><i class="far fa-star"></i> Destaques</a>
            <a class="nav-link a2" href="#"><i class="far fa-thumbs-up"></i> Recomendados</a>-->
            <a class="nav-link a2" href="search-vagas.php"><i class="fas fa-search-dollar"></i> Vagas</a>
            <!--<a class="nav-link a2" href="#"><i class="far fa-envelope"></i> Mensagens</a>-->
            <a class="nav-link a2" href="#"><i class="far fa-id-card"></i> Contato</a>
        </nav>        <!--fim if artista-->
        
        <!-- if contratante
        <nav class="nav flex-column">

            <a class="nav-link a2" href="#"><i class="fas fa-th-large"></i> Dashboard</a>
            <a  class="nav-link a2" href=""><i class="fas fa-tasks"></i> Gerenciar Vagas</a>
            <a class="nav-link a2" href="#"><i class="far fa-star"></i> Destaques</a>
            <a class="nav-link a2" href="#"><i class="fas fa-search"></i> Descobrir</a>
            <a class="nav-link dropdown-toggle a2" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                aria-expanded="false"><i class="far fa-user-circle"></i> Conta</a>
            <div class="dropdown-menu" style="width: 200px;">
                <a class="dropdown-item" href="#">Planos</a>
                <a class="dropdown-item" href="#">Perfil</a>
            </div>
            <a class="nav-link a2" href="#"><i class="far fa-id-card"></i> Contato</a>

        </nav>
        <!--fim if contratante-->
    </div>

    <div id="main">
        <div class="nav-item btn-rotate dropdown" style="position: absolute; right: 0; margin-top: -30px;">
            <a class="nav-link dropdown-toggle" href="#" id="perfil_dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="float: left;">
                <p align="right" style="float: left; margin-top: 13px; margin-right: 10px; text-transform: uppercase; font-weight: bolder; color: white;"><?php echo $usuario->getNm_usuario(); ?></p>
                <img src="<?php echo $usuario->getFoto() ?>" style="border-radius: 50%; border: 5px solid white; width: 45px;">
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="perfil_dropdown">
                <a class="dropdown-item" href="perfil_artista.php">Meu Perfil</a>
                <a class="dropdown-item" href="upload.php">Novo Projeto</a>
                <a class="dropdown-item" href="?deslogar=1">Sair</a>
            </div>
        </div>
        <br><hr>

        <!--Início da dashboard de artista-->
        <!--Início dos cards-->
        <div class="row">
            <div class="col-md-4 col-sm-4">
                <div class="card card-stats">
                    <div class="card-header card-header-warning card-header-icon">
                        <div class="card-icon">
                            <i class="fas fa-box-open"></i>
                        </div>
                        <p class="card-category">Espaço usado:</p>
                        <h3 class="card-title">0/5<small>GB</small></h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <a href="#payment">Obtenha mais espaço.</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-4">
                <div class="card card-stats">
                    <div class="card-header card-header-warning card-header-icon">
                        <div class="card-icon">
                            <i class="far fa-grin-stars"></i>
                        </div>
                        <p class="card-category">Seguidores</p>
                        <h3 class="card-title">150</h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <a href="#followers">Ver meus seguidores.</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-4">
                <div class="card card-stats">
                    <div class="card-header card-header-warning card-header-icon">
                        <div class="card-icon">
                            <i class="fas fa-file-alt"></i>
                        </div>
                        <p class="card-category">Candidaturas</p>
                        <h3 class="card-title">0</h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <a href="#applies">Ver as vagas em que me inscrevi.</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Fim dos cards do topo-->

        <!--Início dos cards de vaga
        Esses cads aparecerão conforme o usuário atualiza seu perfil e se candidata a vagas-->
        <div class="row">
            <!--Card de vagas aplicada

            <div class="col-md-6 col-sm-6">
                <div class="card card-nav-tabs">
                    <div class="card-header card-header-blank" style="background-color: #dbdbdb; color: #313131; text-transform: uppercase; font-weight: bolder;"> Vagas aplicadas
                    </div>
                    <div class="card-body">
                        <!--Início da listagem
                        <div class="list-group">
                            <!--Item da listagem
                            <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1 titulo-vaga">Motion Designer Pleno</h5>
                                    <small>Data da aplicação: 22/03/2019 </small>
                                </div>
                                <p class="mb-1">Resumo da descrição da vaga</p>
                            </a>
                            <!--Fim do item-
                            <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1 titulo-vaga">Vaga 2</h5>
                                    <small class="text-muted">Aplicado: Há 5 dias</small>
                                </div>
                                <p class="mb-1">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget
                                    risus varius blandit.</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!--Vagas recomendadas
            <div class="col-sm-6 col-md-6">
                <div class="card card-nav-tabs">
                    <div class="card-header card-header-blank" style="background-color: #dbdbdb; color: #313131; text-transform: uppercase; font-weight: bolder;"> Vagas para você
                    </div>
                    <div class="card-body">
                        <!--Início da lista
                        <div class="list-group">
                            <!--Item da listagem
                            <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1 titulo-vaga">Diretor de arte</h5>
                                    <small>Publicada: há 5 dias</small>
                                </div>
                                <p class="mb-1">Resumo da descrição da vaga</p>
                            </a>-->
                            <!--Fim item listagem
                            <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1 titulo-vaga">Vaga 2</h5>
                                    <small>Publicada: há 5 dias</small>
                                </div>
                                <p class="mb-1">Desabafe, leitor, diga o que pensa dessa comédia de enganos que vem
                                    sendo a nossa vida.</p>
                            </a>
                        </div>-->
                        <!--Fim da lista
                    </div>
                </div>
            </div>-->
                
            <!--Fim dos cards principais contendo informações-->

            <!--Card chamado caso o artista não tenha nenhuma candidatura-->
            <div class="col-sm-6 col-md-6">
                <div class="card card-nav-tabs">
                    <div class="card-header card-header-blank" style="background-color: #dbdbdb; color: #313131; text-transform: uppercase; font-weight: bolder;"> Vagas aplicadas
                    </div>
                    <div class="card-body">
                        <h4 class="card-title text-center">Você ainda não se inscreveu em nenhuma vaga.</h4>
                        <p class="card-text text-center">Procure pelo trabalho perfeito na busca!</p>
                        <div class="card-footer">
                            <a href="search-vagas.php" class="btn btn-primary"
                                style="margin-left: auto; margin-right: auto;">Pesquisar vagas</a>
                        </div>
                    </div>
                </div>
            </div>

            <!--Card chamado caso o artista não tenha concluído o perfil-->
            <div class="col-sm-6 col-md-6">
                <div class="card card-nav-tabs">
                    <div class="card-header card-header-blank" style="background-color: #dbdbdb; color: #313131; text-transform: uppercase; font-weight: bolder;"> Vagas para você
                    </div>
                    <div class="card-body">
                        <h4 class="card-title text-center">Nenhuma recomendação para você ainda.</h4>
                        <p class="card-text text-center">Conclua seu perfil para receber recomendações!</p>
                        <div class="card-footer">
                            <a href="perfil_artista.php" class="btn btn-primary"
                                style="margin-left: auto; margin-right: auto;">Concluir perfil</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--Dashboard de contratante-->
        
        <!--Excluir esse HR-->
        <!--Cards do topo
        <div class="row">
            <div class="col-md-4 col-sm-4">
                <div class="card card-stats">
                    <div class="card-header card-header-warning card-header-icon">
                        <div class="card-icon">
                            <i class="fas fa-file-alt"></i>
                        </div>
                        <p class="card-category">Aplicações recebidas</p>
                        <h3 class="card-title">130<small> Nos últimos 6 meses</small></h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <a href="#">Gerenciar vagas</a>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-md-4 col-sm-4">
                <div class="card card-stats">
                    <div class="card-header card-header-warning card-header-icon">
                        <div class="card-icon">
                            <i class="fas fa-box-open"></i>
                        </div>
                        <p class="card-category">Vagas ativas</p>
                        <h3 class="card-title">12</h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <a href="#payment">Gerenciar vagas</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-4">
                <div class="card card-stats">
                    <div class="card-header card-header-warning card-header-icon">
                        <div class="card-icon">
                            <i class="fas fa-box-open"></i>
                        </div>
                        <p class="card-category">Espaço usado:</p>
                        <h3 class="card-title">1/10<small>GB</small></h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <a href="#payment"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Esses serão os cards chamados caso não tenha vagas recomendadas ou não tenha se aplicado a nenhuma-->



    <!--   Core JS Files   -->
    <script src="assets/css/js/core/jquery.min.js" type="text/javascript"></script>
    <script src="assets/css/js/core/popper.min.js" type="text/javascript"></script>
    <script src="assets/css/js/core/bootstrap-material-design.min.js" type="text/javascript"></script>
    <script src="assets/css/js/plugins/perfect-scrollbar.jquery.min.js"></script>

    <!-- Chartist JS -->
    <script src="assets/css/js/plugins/chartist.min.js"></script>

    <!--  Notifications Plugin    -->
    <script src="assets/css/js/plugins/bootstrap-notify.js"></script>

    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="assets/css/js/material-dashboard.min.js?v=2.1.0" type="text/javascript"></script>
</body>

</html>