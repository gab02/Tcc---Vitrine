<?php 
include '../classes/Usuario.php';
include '../classes/Vaga.php';
include '../classes/DAO/VagaDAO.php';
session_start();
$a = unserialize($_SESSION['logado']);
if (isset($_GET['inserir'])){
    $vagaDAO = new VagaDAO();
    $vaga = new Vaga($a->getId_usuario(),1, $_POST['remuneracao'] ,$_POST['contratoRadio'],'requisio',$_POST['descr'],$_POST['titulo'],1,'carg',0,$_POST['Ramo'], $_POST['local'],$_POST['localRadio']);
    $vagaDAO->inserir_vaga($vaga);
    echo "<script>alert('Vaga Incluída');</script>";
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
        name='viewport' />
    <title>Vitrine</title>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"
        integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <!-- CSS Files -->
    <link href="assets/css/material-dashboard.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
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
        <div class="openbtn" onclick="wrap()"></div>
        <hr>
        <div class="container-fluid">
     
                <div class="col-sm-6 col-md-6"></div>
                <div class="card"> <!--Início-->
                    <div class="card-header card-header-blank" style="background-color: #dbdbdb; color: #313131; text-transform: uppercase; font-weight: bolder;">
                            Crie uma vaga
                        </div>
                    <div class="card-body">
                         <form action="?inserir=1" method="post">
					<div class="row">
                        <div class="col-md-9 col-sm-9">
                            <h6 class="heading-small text-muted" style="margin-bottom: 20px;">Informações Básicas</h6>
                            <div class="form-group">
                                <!--Título e descrição da vaga-->
                                <label  class="bmd-label-floating" for="titulo_vaga">Título da Vaga</label>
                                <input name="titulo" type="TEXT" class="form-control" id="titulo_vaga" aria-describedby="vagaHelp">
                                <span class="bmd-help">Esse é o título que aparecerá nas pesquisas.</span>
                            </div>
						</div>
							<div class="col-md-3 col-sm-3">
							<div class="form-group" style="margin-top: 38px;">
                                <!--Salario-->
                                <label class="bmd-label-floating" for="titulo_vaga">Remuneração Média</label>
                                <input name="remuneracao" type="number" class="form-control" id="titulo_vaga" aria-describedby="vagaHelp">
                                <span class="bmd-help">Campo não obrigatório.</span>
                            </div>
							</div>
					</div>
						<div class="row">
						<div class="col-md-12 col-sm-12">
                            <div class="form-group" style="margin-top: 15px;">
                                <label class="bmd-label-floating" for="descricao_vaga">Descrição da Vaga</label>
                                <textarea name="descr" class="form-control" id="descricao_vaga" rows="4"></textarea>
                                <span class="bmd-help">Insira uma descrição da vaga.</span>
                            </div><br>
                            <h6 class="heading-small text-muted">Tipo de Contratação</h6>
                            <div class="form-check form-check-radio">
                                <!--Tipo de contratação-->
                                <label class="form-check-label">
                                    <input class="form-check-input" type="radio" name="contratoRadio" id="contrato_efetivo"
                                        value="Contrato Efetivo">
                                    Contrato Efetivo
                                    <span class="circle">
                                        <span class="check"></span>
                                    </span>
                                </label>
                            </div>
                            <div class="form-check form-check-radio">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="radio" name="contratoRadio" id="contrato_temporario"
                                        value="Contrato Temporário">
                                    Contrato Temporário
                                    <span class="circle">
                                        <span class="check"></span>
                                    </span>
                                </label>
                            </div>
                            <div class="form-check form-check-radio">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="radio" name="contratoRadio" id="meio_periodo"
                                        value="Meio Período">
                                    Meio Período
                                    <span class="circle">
                                        <span class="check"></span>
                                    </span>
                                </label>
                            </div>
                            <div class="form-check form-check-radio">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="radio" name="contratoRadio" id="estagio"
                                        value="Estágio">
                                    Estágio
                                    <span class="circle">
                                        <span class="check"></span>
                                    </span>
                                </label>
                            </div>
                            <div class="form-check form-check-radio">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="radio" name="contratoRadio" id="trabalho_freelance"
                                        value="Trabalho Freelance">
                                    Trabalho Freelance
                                    <span class="circle">
                                        <span class="check"></span>
                                    </span>
                                </label>
                            </div>
                        </div><br>
                        <div class="col-md-4">
                            <!--Ramo de arte desejável à vaga-->
                            <h6 class="heading-small text-muted">Ramo do Artista</h6>
                            <select name="Ramo" class="custom-select bg-light" id="tipoArtista">
                                <option value="">Selecione</option>
                                <option value="Design Gráfico">Design Gráfico</option>
                                        <option value="Artes Visuais">Artes Visuais</option>
                                        <option value="Motion Design">Motion Design</option>
                                        <option value="Produção de Vídeo">Produção de Vídeo</option>
                                        <option value="Web Design">Web Design</option>
                                        <option value="Fotografia">Fotografia</option>
                                        <option value="Outro">Outro</option>
                            </select>
                        </div><br>
                        <div class="col-sm-12 col-md-12">
                            <div class="form-check form-check-radio">
                                <!--Local de trabalho-->
                                <h6 class="heading-small text-muted">Local de Trabalho</h6>
                                <div class="form-check form-check-radio">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="radio" name="localRadio" id="presencial"
                                            value="Presencial">
                                        Presencial
                                        <span class="circle">
                                            <span class="check"></span>
                                        </span>
                                    </label>
                                </div>
                                <div class="form-check form-check-radio">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="radio" name="localRadio" id="remoto"
                                            value="Remoto">
                                        Remoto
                                        <span class="circle">
                                            <span class="check"></span>
                                        </span>
                                    </label>
                                </div>
                                <div class="form-check form-check-radio">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="radio" name="localRadio"
                                            id="presencial_remoto" value="Presencial e Remoto">
                                        Presencial e Remoto
                                        <span class="circle">
                                            <span class="check"></span>
                                        </span>
                                    </label>
                                </div>
                            </div><br>
                            <div class="form-group">
                                <!--Localização do trabalho. Caso seja selecionado o Remoto, a localização é opcional.-->
                                <label class="bmd-label-floating" for="localizacao_vaga">Localização</label>
                                <input name="local" type="text" class="form-control" id="localizacao_vaga" aria-describedby="vagaHelp">
                                <span class="bmd-help">Esse campo não é obrigatório caso o trabalho seja apenas remoto.</span>
                            </div>
                        </div>
                        <hr>
                        <div class="card-footer">
                            <div class="row justify-content-start">
                                <button class="btn btn-primary">Publicar</button>
                                <button type="reset" class="btn btn-danger">Limpar</button>
                            </div>
                        </div>
                    </div>
                              </form>
                </div>
            </div>
        </div>

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