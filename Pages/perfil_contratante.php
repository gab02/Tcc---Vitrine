<?php
session_start();

#Chama Classe Usuario para que o objeto passado por sessão sejá integro
include '../classes/Usuario.php';
include '../classes/DAO/UsuarioDAO.php';
include '../classes/DAO/VagaDAO.php';

#SE sessão de usuário ativa, unserializa SENÃO Redireciona pra Index
if (isset($_SESSION['logado'])) {
    $logado = $_SESSION['logado'];
    $usuario = unserialize($logado);
    $uDAO = new UsuarioDAO();
    $uDAO->buscar_foto($usuario);
} else {
    header('Location: ../index.php');
}
$vagaDAO = new VagaDAO();
if (isset($_GET['excluir'])) {
    $vagaDAO->excluir_vaga($_GET['excluir']);
    header('Location: ?');
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

            header('Location: perfil_contratante.php');
        endif;
    else:
        echo 'moio';
    endif;
endif;
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
        <link rel="icon" type="image/png" href="assets/img/favicon.png">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
              name='viewport' />
        <title>Vitrine</title>
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
            .jobsRow {
                width: 100%;
                margin: 0 auto;
            }

            #block {
                margin: 20px;
                float: left;
            }

            p {
                overflow: hidden;
                text-overflow: ellipsis;
                max-height: 100%;
            }

            #attrCard {
                padding: 6px;
                margin-bottom: 15px;
                margin-top: 15px;
                margin-left: 0px;
                margin-right: 0px;
                box-shadow: 0px 1px 4px #d2b4a5;
                border-radius: 3px;
            }
        </style>
    </head>

    <body>

        <!-- Sidebar -->
        <div class="sidenav" id="sidebarId"
             style="box-shadow: 0px 0px 10px 0px #2e2e2e; font-size: 15px; font-weight: bolder;">
            <img src="assets/img/vitrine_logo_c.png" style="width: 150px; margin-top: -3em; margin-left: 1.5em;" />
            <hr />
            <!-- if contratante-->
            <nav class="nav flex-column">
              <!--<a class="nav-link a2" href="#"><i class="fas fa-th-large"></i> Dashboard</a>
                <a class="nav-link a2" href="#"><i class="far fa-star"></i> Destaques</a>
                    <a class="nav-link a2" href="#"><i class="fas fa-search"></i> Descobrir</a>-->
                <a class="nav-link a2" href="perfil_contratante.php"><i class="far fa-user-circle"></i> Meu Perfil</a>
                <a class="nav-link a2" href="insert-vagas.php"><i class="fas fa-bullhorn"></i> Inserir Vagas</a>
                <a class="nav-link a2" href="gerenciamento-vagas.php"><i class="fas fa-tasks"></i> Gerenciar Vagas</a>
                <a class="nav-link a2" href="#"><i class="far fa-id-card"></i> Contato</a>
                <a class="nav-link a2" href="?deslogar=1"><i class="fas fa-lock"></i> Sair</a>
            </nav>
            <!--fim if contratante-->
        </div>

        <div id="main">
            <hr />
            <div class="container-fluid">
                <div class="row" style="padding-top: 24px;">
                    <div class="col-md-8 col-sm-8">
                        <div class="card">
                            <div class="card card-nav-tabs card-plain">
                                <div class="card-header card-header-danger">
                                    <div class="nav-tabs-navigation">
                                        <div class="nav-tabs-wrapper">
                                            <ul class="nav nav-tabs" data-tabs="tabs">
                                                <li class="nav-item">
                                                    <a class="nav-link active" href="#about" data-toggle="tab">Visão geral</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="#vagas" data-toggle="tab">Vagas</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body ">
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="about">
                                            <!--Informações-->
                                            <div class="container-fluid">
                                                <div class="row" style="padding-bottom: 20px;">
                                                    <div class="col-md-12 col-sm-12">
                                                        <h4>Visão Geral</h4>
                                                        <p class="card-text"><?php echo $usuario->getDescricao_usuario();?></p>
                                                    </div>
                                                </div>
                                                <div class="row" id="attrCard">
                                                    <div class="col-md-4">
                                                        <h6 class="heading-small text-muted">Tamanho:</h6><br>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <p style="line-height: 18px;"><?php echo $usuario->getPorte_contratante();?></p>
                                                    </div>
                                                </div>
                                                <div class="row" id="attrCard">
                                                    <div class="col-md-4">
                                                        <h6 class="heading-small text-muted">Site</h6>
                                                        <br />
                                                    </div>
                                                    <div class="col-md-8">
                                                        <p style="line-height: 18px;"><?php echo $usuario->getSite_contratante();?></p>
                                                    </div>
                                                </div>
                                                <div class="row" id="attrCard">
                                                    <div class="col-md-4">
                                                        <h6 class="heading-small text-muted">Ramo</h6><br>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <p style="line-height: 18px;"><?php echo $usuario->getRamo_contratante();?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--Fim informações-->

                                        <!--Vagas-->
                                        <div class="tab-pane" id="vagas">
                                            <?php
                                            $vagas = $vagaDAO->busca_vaga_por_contratante($usuario->getId_usuario());
                                            if ($vagas != NULL) :
                                                foreach ($vagas as $vaga) :
                                                    ?>
                                                    <div class="jobsRow">
                                                        <!--Início card de vaga-->
                                                        <div class="card" style="max-width: 15rem; height: 13rem;" id="block">
                                                            <div class="card-body">
                                                                <h4 class="card-title">
                                                                    <?php echo $vaga['nm_vaga']; ?>
                                                                </h4>
                                                                <h6 class="card-subtitle mb-2 text-muted">
                                                                    <?php echo $vaga['tipo_vaga']; ?> 
                                                                </h6>
                                                                <small><?php echo $vaga['localizacao']; ?></small>
                                                                <br>
                                                                <p class="card-text">
                                                                    <?php echo $vaga['descricao_vaga']; ?>
                                                                </p>
                                                            </div>
                                                            <div class="card-footer">
                                                                <a data-target="#ver<?php echo $vaga['id_vaga'];?>" data-toggle="modal" class="btn btn-primary btn-sm">Visualizar</a>
                                                                <a href="<?php echo "?excluir=" . $vaga['id_vaga']; ?>" class="card-link">Deletar</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                              <!-- Modal das Vagas -->
                                           <!-- Modal das Vagas -->
                                            <div id="ver<?php echo $vaga['id_vaga']?>" class="modal fade mostrar_vaga" tabindex="-1" role="dialog" aria-labelledby="formacao_modal" aria-hidden="true">
                                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                                    <div class="modal-content container">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLongTitle">Detalhes Sobre a Vaga</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form>
                                                                <h6 class="heading-small text-muted" style="margin-top: 10px;">Informações Básicas</h6>
                                                                <div class="row">
                                                                    <div class="col-md-8 col-sm-8">
                                                                        <div class="form-group">
                                                                            <label class="show" for="titulo_vaga" style="font-size: 11px;">Título da Vaga</label>
                                                                            <input type="text" class="form-control" name="titulo" id="titulo_vaga" aria-describedby="basic-addon1" value="<?php echo $vaga['nm_vaga']; ?>" disabled>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4 col-sm-4">
                                                                        <div class="form-group">
                                                                            <label class="show" for="remuneracao_vaga" style="font-size: 11px;">Remuneração Média</label>
                                                                            <input type="number" class="form-control" name="remuneracao" id="remuneracao_vaga" value="<?php echo $vaga['remuneracao_vaga']; ?>" disabled>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-12 col-sm-12">
                                                                        <div class="form-group">
                                                                            <label class="show" for="descricao_vaga" style="font-size: 11px;">Descrição da Vaga</label>
                                                                            <textarea class="form-control" id="descricao_vaga" rows="6" disabled><?php echo $vaga['descricao_vaga']; ?></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <h6 class="heading-small text-muted" style="margin-top: 20px;">Detalhes da Contratação</h6>
                                                                <div class="row">
                                                                    <div class="col-md-4 col-sm-4">
                                                                        <div class="form-group">
                                                                            <label class="show" for="tipo_vaga" style="font-size: 11px;">Ramo da Vaga</label>
                                                                            <input type="text" class="form-control" name="tipovaga" id="tipo_vaga" value="<?php echo $vaga['ramo_vaga']; ?>" disabled>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4 col-sm-4">
                                                                        <div class="form-group">
                                                                            <label class="show" for="tipo_contrato2" style="font-size: 11px;">Tipo de Contrato</label>
                                                                            <input type="text" class="form-control" name="contrato2" id="tipo_contrato2" value="<?php echo $vaga['tipo_vaga']; ?>" disabled>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4 col-sm-4">
                                                                        <div class="form-group">
                                                                            <label class="show" for="local_vaga2" style="font-size: 11px;">Local de Trabalho</label>
                                                                            <input type="text" class="form-control" name="local" id="local_vaga2" value="<?php echo $vaga['localizacao']; ?>" disabled>
                                                                        </div>
                                                                    </div>
                                                                    <!--<div class="col-md-12 col-sm-12">
                                                                         <div class="form-group">
                                                                            <label class="show" for="localizacao_vaga" style="font-size: 11px;">Localização Específica</label>
                                                                            <input type="text" class="form-control" name="localizacao" id="localizacao_vaga" value="PHP LOCALIZAÇÃO" disabled>
                                                                        </div>
                                                                    </div>-->
                                                                </div>
                                                            </form><hr>
                                                            <form action="?candidatar" method="post">
                                                                <input type="hidden" name="vaga" value="<?php echo $vaga['id_vaga']; ?>"/>
                                                                <input type="hidden" name="artista" value="<?php echo $usuario->getId_usuario(); ?>"/>
                                                                <input type="button" class="btn-primary btn" value="Fechar" class="close" data-dismiss="modal" aria-label="Close" style="right: 0; position: absolute; margin-top: 0px; margin-right: 20px;"><br>
                                                            </form>
                                                            <br>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                                <?php endforeach;
                                            endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-4">
                        <div class="card card-profile">
                            <div class="card-avatar">
                                <a href="" data-toggle="modal" data-target="#editfoto">
                                    <img class="img" style="min-width: 100%;" src="<?php echo $usuario->getFoto() ?>" />
                                </a>
                            </div>
                            <div class="card-body" style="margin-top: -10px;">
                                <h6 class="card-category"><?php echo $usuario->getRamo_contratante(); ?></h6>
                                <h4 class="card-title" style="margin-top: -0.5em;"><?php echo $usuario->getNm_usuario(); ?>
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--modal-->
        <div class="modal fade" id="editfoto" tabindex="-1" role="dialog" aria-labelledby="modal_trabalho_header"
             aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="modal-footer">
                            <form method="post" action="?action=edit_ft" enctype="multipart/form-data">
                                <!--Assim dá pra enviar arquivo-->
                                <p>ADICIONE A FOTO:</p>
                                <input type="file" name="capa" /><br /><br />
                                <input type="submit" value="Enviar" name="fotoperfil" />
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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