<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="apple-touch-icon" sizes="76x76" href="../../img/apple-icon.png">
    <link rel="icon" type="image/png" href="../../img/favicon.png">
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
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <!-- Sidebar -->
    <div class="sidenav" id="sidebarId" style="box-shadow: 0px 0px 10px 0px #2e2e2e; font-size: 15px; font-weight: bolder;">
        <img src="assets/img/vitrine_logo_c.png"
            style="width: 150px; margin-top: -3em; margin-left: 1.5em;">
        <hr>

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
    </div>


    <div id="main">
        <div class="openbtn" onclick="wrap()"></div>
        <hr>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-4 col-md-4">
                    <div class="card card-nav-tabs" style="background-color: white;">
                        <div class="card-header card-header-blank"
                            style="background-color: #dbdbdb; color: #313131; text-transform: uppercase; font-weight: bolder;">
                            Filtro de busca
                        </div>
                        <div class="card-body">
                            <!--Conteúdo do card de filtros-->
                            <!--Status da vaga-->
                            <h6 class="heading-small text-muted" for="status_vaga">Status da Vaga</h6>
                            <select class="custom-select bg-light" id="status_vaga">
                                <option value="">Selecione</option>
                                <option value="open">Aberto</option>
                                <option value="closed">Fechado</option>
                                <option value="done">Finalizado</option>
                            </select><br><br>

                            <!--Tipo de contratação (value de cada campo a ser definido)-->
                            <h6 class="heading-small text-muted" for="status_vaga">Tipo de Contrato</h6>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" value="">
                                    Contrato Efetivo
                                    <span class="form-check-sign">
                                        <span class="check"></span>
                                    </span>
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label" style="margin-top: 5px;">
                                    <input class="form-check-input" type="checkbox" value="">
                                    Contrato Temporário
                                    <span class="form-check-sign">
                                        <span class="check"></span>
                                    </span>
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label" style="margin-top: 5px;">
                                    <input class="form-check-input" type="checkbox" value="">
                                    Meio Período
                                    <span class="form-check-sign">
                                        <span class="check"></span>
                                    </span>
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label" style="margin-top: 5px;">
                                    <input class="form-check-input" type="checkbox" value="">
                                    Estágio
                                    <span class="form-check-sign">
                                        <span class="check"></span>
                                    </span>
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label" style="margin-top: 5px;">
                                    <input class="form-check-input" type="checkbox" value="">
                                    Trabalho Freelance
                                    <span class="form-check-sign">
                                        <span class="check"></span>
                                    </span>
                                </label>
                            </div><br>
                            
                            <h6 class="heading-small text-muted" for="status_vaga">Publicado a partir de:</h6>
                            <input type="date" class="form-control" name="publicado" id="publicado_em"
                                aria-describedby="basic-addon1">
                            <button style="margin-top: 25px;" class="btn btn-primary">Buscar</button>
                            <button style="margin-top: 25px;" class="btn btn-dark">Limpar filtros</button>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8 col-md-8">
                    <div class="card card-nav-tabs">
                        <div class="card-header card-header-blank"
                            style="background-color: #dbdbdb; color: #313131; text-transform: uppercase; font-weight: bolder;">
                            Lista de vagas publicadas
                        </div>
                        <div class="card-body">
                            <ul class="list-group">
                                <!--Cada Linha é uma vaga publicada pelo contratante-->
                                <li class="list-group-item">

                                    <h4 class="card-title">vaga teste</h4>
                                    <small class="text-muted">Status: Aberto</small>
                                    <p class="card-text">0 Candidaturas / Contratação: Estágio</p> <small
                                        class="text-muted">Publicado: minutos atrás</small>
                                    <hr>
                                    <button class="btn btn-primary btn-sm">Ver vaga</button>
                                    <button class="btn btn-primary btn-sm">Ver artistas interessados</button>
                                    <button class="btn btn-danger btn-sm">Excluir</button>
                                    <button class="btn btn-dark btn-sm">Fechar inscrições</button>
                                </li>
                                <!--<li class="list-group-item">
                                    <h4 class="card-title">Título da vaga 2</h4>
                                    <small class="text-muted">Status: Fechado</small>
                                    <p class="card-text">5 Candidaturas / Contratação: Contrato</p> <small
                                        class="text-muted">Publicado: há 2 meses</small>
                                    <hr>
                                    <button class="btn btn-primary btn-sm">Ver vaga</button>
                                    <button class="btn btn-primary btn-sm">Ver artistas interessados</button>
                                    <button class="btn btn-danger btn-sm">Excluir</button>
                                    <button class="btn btn-info btn-sm">Reabrir inscrições</button>
                                </li>-->
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Core JS Files-->
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