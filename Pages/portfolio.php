<?php
session_start();
include '../classes/DAO/ProjetoDAO.php';
include '../classes/Projeto.php';
include '../classes/Usuario.php';
include '../classes/DAO/UsuarioDAO.php';
$uDAO = new UsuarioDAO();
$u = unserialize($_SESSION['logado']);
$uDAO->buscar_foto($u);
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$pDAO = new ProjetoDAO();
$projetos = $pDAO->Selecionar_ProjetoArtista($u->getId_usuario());
foreach ($projetos as $projeto) {
    $projs[] = new Projeto($u->getId_usuario(), $projeto['nm_projeto'], $projeto['descr_projeto'], $projeto['categ_projeto'], $projeto['id_projeto']);
}


if (isset($_GET['action']) and $_GET['action'] == 'deletearq') {
    $pDAO->remover_arquivo($_GET['id']);

    echo "<script>alert('Removido!')</script>";

    header('Location: portfolio.php');
}

if (isset($_GET['action']) and $_GET['action'] == 'editproj') {
    $projetoedit = $pDAO->selecionar_projetoID($_POST['id_projeto']);

    $projeto = new Projeto($projetoedit['id_artista_projeto'], $_POST['nm_projeto'], $_POST['descr_projeto'], $_POST['categ_projeto'], $_POST['id_projeto']);

    $pDAO->editar_projeto($projeto);

    echo "<script>alert('Editado!')</script>";

    header('Location: portfolio.php');
}

if (isset($_GET['action']) and $_GET['action'] == 'deleteproj') {
    $pDAO->remover_projeto($_POST['id_projeto']);

    echo "<script>alert('Removido!')</script>";

    header('Location: portfolio.php');
}
#SE apertar botão deslogar SAI
if (isset($_GET['deslogar'])) {
    unset($_SESSION['logado']);
    header('Location: ../index.php');
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="assets/img/favicon.png">    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Vitrine</title>
    <link rel="stylesheet" href="assets/css/material-dashboard.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"
        integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
</head>
    <body>
    <div class="sidenav" id="sidebarId" style="box-shadow: 0px 0px 10px 0px #2e2e2e; font-size: 15px; font-weight: bolder;">
        <img src="assets/img/vitrine_logo_c.png" style="width: 150px; margin-top: -3em; margin-left: 1.5em;"><hr>

            <!-- if artista -->
            <?php if ($_SESSION['tipo'] == 'a'): ?>
        <nav class="nav flex-column">
            <a class="nav-link a2" href="portfolio.php"><i class="fas fa-palette"></i> Portfólio</a>
            <a class="nav-link a2" href="dashboard.php"><i class="fas fa-th-large"></i> Dashboard</a>
            <!--<a class="nav-link a2" href="#"><i class="far fa-star"></i> Destaques</a>
            <a class="nav-link a2" href="#"><i class="far fa-thumbs-up"></i> Recomendados</a>-->
            <a class="nav-link a2" href="search-vagas.php"><i class="fas fa-search-dollar"></i> Vagas</a>
            <!--<a class="nav-link a2" href="#"><i class="far fa-envelope"></i> Mensagens</a>-->
            <a class="nav-link a2" href="#"><i class="far fa-id-card"></i> Contato</a>
        </nav>
            <?php else: ?>
                <!--fim if artista-->
                <!-- if contratante-->
                <nav class="nav flex-column">

                    <a class="nav-link" href="#">Dashboard</a>
                    <a class="nav-link" href="#">Destaques</a>
                    <a class="nav-link" href="#">Descobrir</a>
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                       aria-expanded="false">Conta</a>
                    <div class="dropdown-menu" style="width: 200px;">
                        <a class="dropdown-item" href="#">Planos</a>
                        <a class="dropdown-item" href="#">Perfil</a>
                    </div>
                    <a class="nav-link" href="#">Contato</a>

                </nav>
            <?php endif; ?>
            <!--fim if contratante-->
        </div>

        <!-- Corpo da página -->
        <div id="main">
        <div class="nav-item btn-rotate dropdown" style="position: absolute; right: 0; margin-top: -5px;">
            <a class="nav-link dropdown-toggle" href="#" id="perfil_dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="float: left;">
                <p align="right" style="float: left; margin-top: 13px; margin-right: 10px; text-transform: uppercase; font-weight: bolder; color: white;"><?php echo $u->getNm_usuario(); ?></p>
                <img src="<?php echo $u->getFoto() ?>" style="border-radius: 50%; border: 5px solid white; width: 45px;">
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="perfil_dropdown">
                <a class="dropdown-item" href="perfil_artista.php">Meu Perfil</a>
                <a class="dropdown-item" href="upload.php">Novo Projeto</a>
                <a class="dropdown-item" href="?deslogar=1">Sair</a>
            </div>
        </div>
        <br><br><hr>
            <div class="container-fluid">
                <div class="card" style="margin-top: 46px;">
                <div class="card-header card-header-blank" style="background-color: #dbdbdb; color: #313131; text-transform: uppercase; font-weight: bolder;"> Portfólio</div>
                <!--Informações do Contato-->
                <div class="card-body" style="background-color: white; border-radius: 10px;">
                    <div class="row">
                        <div class="col-md-2 col-sm-2">
                            <img src="<?php echo $u->getFoto(); ?>"
                                 style="width: 280px; max-width: 100%; border-radius: 50%;">
                        </div>

                        <div class="col-md-10 col-sm-10">
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <p
                                        style="margin-top: 5px; font-family: Montserrat; font-weight: bold; text-transform: uppercase; font-size: 35px;">
                                        <?php echo $u->getNm_usuario(); ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <p
                                        style="margin-top: -5px; font-family: Montserrat; font-weight: bolder; text-transform: uppercase; font-size: 20px;">
                                    </p><!--COLOCAR PROFISSÃO-->
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <p style="margin-top: -5px; font-family: Roboto; font-weight: bolder;" align="justify">
                                        <?php echo $u->getDescricao_usuario(); ?>
                                    </p>
                                </div>
                            </div>
                            <hr style="margin-top: -9px;">
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <a href="perfil_artista.php" class="btn btn-primary">Ver perfil completo</a>
                                </div>
                            </div>
                        </div>
                        <hr><br>
</div>

                        <!-- Mostrando os Trabalhos -->
                    <br>
                    <div class="row">
                        <div class="col-md-12 col-sm-12" style="border-left: 5px solid orangered; margin-left: 10px;">
                            <p
                                style="font-family: Montserrat; font-weight: bold; text-transform: uppercase; font-size: 30px; margin-top: 15px; margin-left: -5px; line-height: 14px;">
                                O que eu faço?</p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 col-sm-12" style="margin-left: 10px;">
                            <div class="card-deck" style="margin-right: 5px;">



                                <?php
                                if (isset($projs)):
                                    $count = 1;
                                    foreach ($projs as $projeto):
                                        $pDAO->popular_projeto($projeto);
                                        $arquivos = $projeto->getArquivos();?>
                                        
                                        <!-- Trabalho -->
                                        <div class="card" style="max-width: 19%;">
                                            <a href="" data-toggle="modal" 
                                               data-target="#<?php echo $projeto->getId_projeto(); ?>"><img class="card-img-top"
                                                                                                         src="<?php echo "../{$arquivos[0]['caminho_arquivo']}"; ?>" alt="Card image cap"
                                                                                                         style="width: 100%; height: 150px; background-size: cover; background-repeat: no-repeat;  background-attachment: fixed;"></a>
                                            <div class="card-body">
                                                <h5 class="card-title"><?php
                                                    echo $projeto->getNm_projeto();
                                                    $count += 1;
                                                    ?></h5>
                                                <p class="card-text"><?php echo $projeto->getDescr_projeto(); ?></p>
                                                 <small
                                                    class="text-muted"><?php echo "Postado em " . $projeto->getDtInclu_projeto(); ?></small>
                                            </div>
                                            <hr>
                                            <div class="card-footer" style="margin-top: -16px;">
                                                <a href="" data-toggle="modal"
                                                   data-target="#edit<?php echo $projeto->getId_projeto(); ?>"><button
                                                        type="button" class="btn btn-primary btn-sm">EDITAR</button></a>
                                                <a href="" data-toggle="modal"
                                                   data-target="#delete<?php echo $projeto->getId_projeto(); ?>"><button
                                                        type="button" class="btn btn-danger btn-sm">DELETAR</button></a>
                                            </div>
                                        </div>

                                        <!-- Modal -->
                                        <div class="modal fade" id="<?php echo $projeto->getId_projeto(); ?>" tabindex="-1"
                                             role="dialog" aria-labelledby="modal_trabalho_header" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h2 class="modal-title" id="modal_trabalho_header">
                                                            <?php echo $projeto->getNm_projeto(); ?></h2>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-12 col-sm-12">
                                                                <img src="<?php echo "../{$arquivos[0]['caminho_arquivo']}"; ?>"
                                                                     style="width: 100%; ">
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <div class="row">
                                                            <div class="col-md-3 col-sm-3">
                                                                <h5 class="card-title"
                                                                    style="font-weight: bold; text-transform: uppercase;">Título:
                                                                </h5>
                                                            </div>
                                                            <div class="col-md-9 col-sm-9">
                                                                <h5 class="card-title" style="font-weight: bolder;">
                                                                    <?php ECHO $projeto->getNm_projeto(); ?></h5>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-3 col-sm-3">
                                                                <h5 class="card-title"
                                                                    style="font-weight: bold; text-transform: uppercase;">Descrição:
                                                                </h5>
                                                            </div>
                                                            <div class="col-md-9 col-sm-9">
                                                                <h5 class="card-title" style="font-weight: bolder;">
                                                                    <?php echo $projeto->getDescr_projeto(); ?></h5>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-3 col-sm-3">
                                                                <h5 class="card-title"
                                                                    style="font-weight: bold; text-transform: uppercase;">Categoria:
                                                                </h5>
                                                            </div>
                                                            <div class="col-md-9 col-sm-9">
                                                                <h5 class="card-title" style="font-weight: bolder;">
                                                                    <?php echo $projeto->getCateg_projeto(); ?></h5>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-3 col-sm-3">
                                                                <h5 class="card-title"
                                                                    style="font-weight: bold; text-transform: uppercase;">Publicado
                                                                    em:</h5>
                                                            </div>
                                                            <div class="col-md-9 col-sm-9">
                                                                <h5 class="card-title" style="font-weight: bolder;">
                                                                    <?php echo $projeto->getDtInclu_projeto(); ?></h5>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <h3>Imagens</h3>
                                                        <?php foreach ($arquivos as $arquivo): ?>
                                                            <div class="row">
                                                                <div class="col-md-12 col-sm-12">
                                                                    <img src="<?php echo "../{$arquivo['caminho_arquivo']}"; ?>"
                                                                         style="width: 100%;" />

                                                                </div>
                                                            </div>
                                                            <br>
                                                        <?php endforeach; ?>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-primary"
                                                                data-dismiss="modal">Fechar</button>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- edit Modal -->
                                        <div class="modal fade" id="edit<?php echo $projeto->getId_projeto(); ?>" tabindex="-1"
                                             role="dialog" aria-labelledby="modal_trabalho_header" aria-hidden="true">
                                            <form method="post" action="?action=editproj">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">

                                                        <input type="hidden" value="<?php echo $projeto->getId_projeto(); ?>"
                                                               name="id_projeto" />
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="modal_trabalho_header">
                                                                <?php echo $projeto->getNm_projeto(); ?></h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-md-12 col-sm-12">
                                                                    <img src="<?php echo "../{$arquivos[0]['caminho_arquivo']}"; ?>" style="width: 100%; ">
                                                                </div>
                                                            </div>
                                                            <hr>
                                                            <div class="row">
                                                                <div class="col-md-9 col-sm-9">
                                                                    <h5 class="card-title"
                                                                        style="font-weight: bold; text-transform: uppercase;">
                                                                        Título:
                                                                    </h5>
                                                                    <input name="nm_projeto" type="text" class="form-control"
                                                                           style="font-weight: bolder;"
                                                                           value="<?php ECHO $projeto->getCateg_projeto(); ?>" />
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-9 col-sm-9">
                                                                    <h5 class="card-title"
                                                                        style="font-weight: bold; text-transform: uppercase;">
                                                                        Descrição:
                                                                    </h5><textarea name="descr_projeto"
                                                                                   class="form-control" style="font-weight: bolder;"
                                                                                   ><?php ECHO $projeto->getDescr_projeto(); ?></textarea>
                                                                </div>
                                                            </div>
                                                            <br>
                                                            <div class="row">
                                                                <div class="col-md-9 col-sm-9">
                                                                    <h5 class="card-title"
                                                                        style="font-weight: bold; text-transform: uppercase;">
                                                                        Categoria:
                                                                    </h5>
                                                                    <input name="categ_projeto" type="text" class="form-control"
                                                                           style="font-weight: bolder;"
                                                                           value="<?php ECHO $projeto->getCateg_projeto(); ?>" />
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <button type="button" class="btn btn-primary"
                                                                        data-dismiss="modal">Fechar</button>
                                                                <button type="submit" class="btn btn-primary">Confirmar</button>
                                                            </div>    
                                                            <hr>
                                                            <h3>Imagens</h3>
                                                            <?php foreach ($arquivos as $arquivo): ?>
                                                                <div class="row">
                                                                    <div class="col-md-12 col-sm-12">
                                                                        <img src="<?php echo "../{$arquivo['caminho_arquivo']}"; ?>"
                                                                             style="width: 100%;" />

                                                                        <a
                                                                           href="?action=deletearq&id=<?php echo $arquivo['id_arquivo'] ?>"><button>Deletar</button></a>
                                                                    </div>
                                                                </div>
                                                                <br>
                                                            <?php endforeach; ?>
                                                        </div>
                                                    </div>
                                                    <br>
                                                </div>
                                            </form>
                                            <hr>
                                        </div>
                                        <!-- delete Modal -->
                                        <div class="modal fade" id="delete<?php echo $projeto->getId_projeto(); ?>" tabindex="-1"
                                             role="dialog" aria-labelledby="modal_trabalho_header" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h2 class="modal-title" id="modal_trabalho_header">
                                                            <?php echo $projeto->getNm_projeto(); ?></h2>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-12 col-sm-12">
                                                                <img src="<?php echo "../{$arquivos[0]['caminho_arquivo']}"; ?>"
                                                                     style="width: 100%; ">
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <div class="row">
                                                            <div class="col-md-3 col-sm-3">
                                                                <h5 class="card-title"
                                                                    style="font-weight: bold; text-transform: uppercase;">Título:
                                                                </h5>
                                                            </div>
                                                            <div class="col-md-9 col-sm-9">
                                                                <h5 class="card-title" style="font-weight: bolder;">
                                                                    <?php ECHO $projeto->getNm_projeto(); ?></h5>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-3 col-sm-3">
                                                                <h5 class="card-title"
                                                                    style="font-weight: bold; text-transform: uppercase;">Descrição:
                                                                </h5>
                                                            </div>
                                                            <div class="col-md-9 col-sm-9">
                                                                <h5 class="card-title" style="font-weight: bolder;">
                                                                    <?php echo $projeto->getDescr_projeto(); ?></h5>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-3 col-sm-3">
                                                                <h5 class="card-title"
                                                                    style="font-weight: bold; text-transform: uppercase;">Categoria:
                                                                </h5>
                                                            </div>
                                                            <div class="col-md-9 col-sm-9">
                                                                <h5 class="card-title" style="font-weight: bolder;">
                                                                    <?php echo $projeto->getCateg_projeto(); ?></h5>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-3 col-sm-3">
                                                                <h5 class="card-title"
                                                                    style="font-weight: bold; text-transform: uppercase;">Publicado
                                                                    em:</h5>
                                                            </div>
                                                            <div class="col-md-9 col-sm-9">
                                                                <h5 class="card-title" style="font-weight: bolder;">
                                                                    <?php echo $projeto->getDtInclu_projeto(); ?></h5>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <h3>Imagens</h3>
                                                        <?php foreach ($arquivos as $arquivo): ?>
                                                            <div class="row">
                                                                <div class="col-md-12 col-sm-12">
                                                                    <img src="<?php echo "../{$arquivo['caminho_arquivo']}"; ?>"
                                                                         style="width: 100%;" />

                                                                </div>
                                                            </div>
                                                            <br>
                                                        <?php endforeach; ?>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Todos os dados desse projeto serão perdidos. Deseja continuar?</p>
                                                    </div>
                                                    <form action='?action=deleteproj' method="post">
                                                        <div class="modal-footer">
                                                            <input type="hidden" name="id_projeto" value="<?php echo $projeto->getId_projeto();?>"/>
                                                            <button type="submit" class="btn btn-primary">Confirmar</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>            
                            <?php
                            if($count == 5 ):
                                $count = 1;
                                echo " </div> </div> </div>";
                                echo "<div class='row'>";
                                echo "<div class='col-md-12 col-sm-12' style='margin-left: 10px;'>";
                                echo "<div class='card-deck' style='margin-right: 5px;'>";
                            endif;
                        endforeach;?>
                            </div>
                        </div>
                    </div>
                    <?php else: ?>
                        <!-- Trabalho -->
                        <div class='card' style="max-width: 100%;">
                            <div class="card-body">
                                <p class="mb-1">Nenhum trabalho para expor ainda.</p>
                            </div>
                        </div>
                    <?php
                    endif;
                    ?>
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