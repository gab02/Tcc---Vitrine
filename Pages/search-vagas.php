<?php
session_start();

#Chama Classe Usuario para que o objeto passado por sessão sejá integro
include '../classes/Usuario.php';
include '../classes/DAO/UsuarioDAO.php';
include '../classes/DAO/vagaDAO.php';

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
if (isset($_GET['search'])) {
    $vaga = new VagaDAO();
    $vagas = $vaga->busca_vaga_por_filtro($_POST['tipo'], $_POST['local'], $_POST['ramo']);
}

if (isset($_GET['candidatar'])) {
    $vaga = new VagaDAO();
    $vaga->inserir_cadidatura($_POST['artista'], $_POST['vaga']);
    echo "<script>alert('Candidatura efetuada!')</script>";
    header('Location: search-vagas.php');
}
?>

<!DOCTYPE html>
<html lang="en">

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
        </nav>
        <!--fim if artista-->

        <!-- if contratante-
        <nav class="nav flex-column">

            <a class="nav-link a2" href="#"><i class="fas fa-th-large"></i> Dashboard</a>
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
        fim if contratante-->
    </div>

    <div id="main">
        <div class="nav-item btn-rotate dropdown" style="position: absolute; right: 0; margin-top: -30px;">
            <a class="nav-link dropdown-toggle" href="#" id="perfil_dropdown" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false" style="float: left;">
                <p align="right"
                    style="float: left; margin-top: 13px; margin-right: 10px; text-transform: uppercase; font-weight: bolder; color: white;">
                    <?php echo $usuario->getNm_usuario(); ?></p>
                <img src="<?php echo $usuario->getFoto() ?>"
                    style="border-radius: 50%; border: 5px solid white; width: 45px;">
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="perfil_dropdown">
                <a class="dropdown-item" href="perfil_artista.php">Meu Perfil</a>
                <a class="dropdown-item" href="upload.php">Novo Projeto</a>
                <a class="dropdown-item" href="?deslogar=1">Sair</a>
            </div>
        </div>
        <br>
        <hr>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <!--Esse card contém os filtros para a pesquisa de vagas específicas-->
                    <form action="?search=1" method="post">                   
                    <div class="card">
                        <div class="card-header card-header-blank"
                            style="background-color: #dbdbdb; color: #313131; text-transform: uppercase; font-weight: bolder;">
                            Filtro de busca
                        </div>
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <h6 class="heading-small text-muted" for="tipo_vaga">Tipo de Vaga</h6>
                                    <select class="custom-select bg-light labelSelect" id="tipo_vaga" name="ramo" style="margin-top: 0px;">
                                                <option value="NULL">Selecione</option>
                                                <option value="Design Gráfico">Design Gráfico</option>
                                                <option value="Artes Visuais">Artes Visuais</option>
                                                <option value="Motion Design">Motion Design</option>
                                                <option value="Produção de Vídeo">Produção de Vídeo</option>
                                                <option value="Web Design">Web Design</option>
                                                <option value="Fotografia">Fotografia</option>
                                                <option value="Outro">Outro</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <h6 class="heading-small text-muted" for="tipo_contrato">Tipo de Contrato</h6>
                                    <select name="tipo" class="custom-select bg-light labelSelect" id="tipo_contrato" style="margin-top: 0px;">
                                                <option value="NULL">Selecione</option>
                                                <option value="Contrato Efetivo">Contrato Efetivo</option>
                                                <option value="Contrato Temporário">Contrato Temporário</option>
                                                <option value="Meio Período">Meio Período</option>
                                                <option value="Estágio">Estágio</option>
                                                <option value="Trabalho Freelance">Trabalho Freelance</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <h6 class="heading-small text-muted" for="local_vaga">Localização</h6>
                                    <select name="local" class="custom-select bg-light labelSelect" id="local_vaga" style="margin-top: 0px;">
                                                <option value="NULL">Selecione</option>
                                                <option value="Acre">Acre</option>
                                                <option value="Alagoas">Alagoas</option>
                                                <option value="Amapá">Amapá</option>
                                                <option value="Amazonas">Amazonas</option>
                                                <option value="Bahia">Bahia</option>
                                                <option value="Ceará">Ceará</option>
                                                <option value="Distrito Federal">Distrito Federal</option>
                                                <option value="Espírito Santo">Espírito Santo</option>
                                                <option value="Goiás">Goiás</option>
                                                <option value="Maranhão">Maranhão</option>
                                                <option value="Mato Grosso">Mato Grosso</option>
                                                <option value="Mato Grosso do Sul">Mato Grosso do Sul</option>
                                                <option value="Minas Gerais">Minas Gerais</option>
                                                <option value="Pará">Pará</option>
                                                <option value="Paraíba">Paraíba</option>
                                                <option value="Paraná">Paraná</option>
                                                <option value="Pernambuco">Pernambuco</option>
                                                <option value="Piauí">Piauí</option>
                                                <option value="Rio de Janeiro">Rio de Janeiro</option>
                                                <option value="Rio Grande do Norte">Rio Grande do Norte</option>
                                                <option value="Rio Grande do Sul">Rio Grande do Sul</option>
                                                <option value="Rondônia">Rondônia</option>
                                                <option value="Roraima">Roraima</option>
                                                <option value="Santa Catarina">Santa Catarina</option>
                                                <option value="São Paulo">São Paulo</option>
                                                <option value="Sergipe">Sergipe</option>
                                                <option value="Tocantins">Tocantins</option>
                                    </select>
                                </div>
                            </div>
                            <hr>
                            <button type="sumbit" class="btn btn-primary">Buscar</button>
                            <button class="btn btn-danger">Limpar</button>
                        </div>
                    </div>
                    </form>
                    <div class="card" style="margin-top: 50px;">
                        <div class="card-header card-header-blank"
                            style="background-color: #dbdbdb; color: #313131; text-transform: uppercase; font-weight: bolder;">
                            Resultados da Pesquisa
                        </div>
                        <div class="card-body">
                            <div class="list-group">
                            <?php if (isset($vagas) and $vagas != NULL):
                                        foreach ($vagas as $v):
                                            
                                            ?>
                                            <a href="#" data-toggle="modal" data-target=".mostrar_vaga"
                                               class="list-group-item list-group-item-action flex-column align-items-start">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h5 class="mb-1"><?php echo $v['nm_vaga']; ?></h5>
                                                    <small class="text-muted">Publicado a minutos atrás</small>
                                                </div>
                                                <small>Tipo de contrato: <?php echo $v['tipo_vaga']; ?></small>
                                                <p class="mb-1"><?php echo $v['descricao_vaga']; ?></p>
                                            </a>
        <!-- Modal das Vagas -->
        <div class="modal fade mostrar_vaga" tabindex="-1" role="dialog" aria-labelledby="formacao_modal" aria-hidden="true">
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
                                                                            <input type="text" class="form-control" name="titulo" id="titulo_vaga" aria-describedby="basic-addon1" value="<?php echo $v['nm_vaga']; ?>" disabled>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4 col-sm-4">
                                                                        <div class="form-group">
                                                                            <label class="show" for="remuneracao_vaga" style="font-size: 11px;">Remuneração Média</label>
                                                                            <input type="number" class="form-control" name="remuneracao" id="remuneracao_vaga" value="<?php echo $v['remuneracao_vaga']; ?>" disabled>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-12 col-sm-12">
                                                                        <div class="form-group">
                                                                            <label class="show" for="descricao_vaga" style="font-size: 11px;">Descrição da Vaga</label>
                                                                            <textarea class="form-control" id="descricao_vaga" rows="6" disabled><?php echo $v['descricao_vaga']; ?></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <h6 class="heading-small text-muted" style="margin-top: 20px;">Detalhes da Contratação</h6>
                                                                <div class="row">
                                                                    <div class="col-md-4 col-sm-4">
                                                                        <div class="form-group">
                                                                            <label class="show" for="tipo_vaga" style="font-size: 11px;">Ramo da Vaga</label>
                                                                            <input type="text" class="form-control" name="tipovaga" id="tipo_vaga" value="<?php echo $v['ramo_vaga']; ?>" disabled>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4 col-sm-4">
                                                                        <div class="form-group">
                                                                            <label class="show" for="tipo_contrato2" style="font-size: 11px;">Tipo de Contrato</label>
                                                                            <input type="text" class="form-control" name="contrato2" id="tipo_contrato2" value="<?php echo $v['tipo_vaga']; ?>" disabled>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4 col-sm-4">
                                                                        <div class="form-group">
                                                                            <label class="show" for="local_vaga2" style="font-size: 11px;">Local de Trabalho</label>
                                                                            <input type="text" class="form-control" name="local" id="local_vaga2" value="<?php echo $v['localizacao']; ?>" disabled>
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
                                                                <input type="hidden" name="vaga" value="<?php echo $v['id_vaga']; ?>"/>
                                                                <input type="hidden" name="artista" value="<?php echo $usuario->getId_usuario(); ?>"/>
                                                                <input type="submit" class="btn-primary btn" value="Candidatar-se" style="right: 0; position: absolute; margin-top: 0px; margin-right: 130px;">
                                                                <input type="button" class="btn-primary btn" value="Fechar" class="close" data-dismiss="modal" aria-label="Close" style="right: 0; position: absolute; margin-top: 0px; margin-right: 20px;"><br>
                                                            </form>
                                                            <br>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach;
                                    else:
                                        ?>
                                        <a href="#"
                                           class="list-group-item list-group-item-action flex-column align-items-start">
                                            <div class="d-flex w-100 justify-content-between">
                                                <h5 class="mb-1">Sem Vagas para o filtro</h5>
                                            </div>
                                        </a>
<?php endif; ?>
                                </div>
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
        <script src="assets/maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>

        <!-- Chartist JS -->
        <script src="assets/css/js/plugins/chartist.min.js"></script>

        <!--  Notifications Plugin    -->
        <script src="assets/css/js/plugins/bootstrap-notify.js"></script>

        <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
        <script src="assets/css/js/material-dashboard.min.js?v=2.1.0" type="text/javascript"></script>


</body>

</html>