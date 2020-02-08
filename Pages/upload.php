<?php
session_start();
include '../classes/DAO/ProjetoDAO.php';
include '../classes/Projeto.php';
include '../classes/Usuario.php';
include '../classes/DAO/UsuarioDAO.php';

if (isset($_SESSION['logado'])) {
    $logado = $_SESSION['logado'];
    $usuario = unserialize($logado);
    $uDAO = new UsuarioDAO();
    $uDAO->buscar_foto($usuario);
} else {
    header('Location: ../index.php');
}

$pDAO = new ProjetoDAO;

if (isset($_GET['Enviar'])):
    $pDAO = new ProjetoDAO;
    if (isset($_FILES['arquivo'])) {
        if (isset($_SESSION['logado'])) {
            $u = unserialize($_SESSION['logado']);
            $proj = new Projeto($u->getId_usuario(), $_POST['titulo'], $_POST['categoria'], $_POST['descricao']);
            $pDAO->inserir_projeto($proj);
            if (count($_FILES['arquivo']['tmp_name']) > 0) :

                for ($q = 0; $q < count($_FILES['arquivo']['tmp_name']); $q++) {

                    $nomedoarquivo = md5($_FILES['arquivo']['name'][$q] . time() . rand(0, 99)) . '.jpg';

                    move_uploaded_file($_FILES['arquivo']['tmp_name'][$q], '../img/' . $nomedoarquivo);

                    $pDAO->inserir_arquivos($proj->getId_projeto(), $nomedoarquivo, 'img/' . $nomedoarquivo);
                    #header('Location: assets/pages/artista/portfolio.php');
                }
            endif;
        }
    } else {
        throw Exception('ErrO de Projeto');
    }
endif;

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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <style>
        #gallery img {
            width: 20%;
            padding: 20px;
        }

        [type="file"] {
            height: 0;
            overflow: hidden;
            width: 0;
        }

        [type="file"]+label {
            background: none;
            border: none;
            color: #fafafa;
            cursor: pointer;
            display: inline-block;
            outline: none;
            margin-top: 8px;
            padding: 10px 25px;
            transition: 0.3s;
            background-color: #fe803f;
            border-radius: 4px;
            text-transform: uppercase;
            font-size: 12px;
            font-weight: bolder;
        }

        [type="file"]+label:hover {
            background-color: #ea773b;
            color: #fafafa;
        }

        #slotCapa img {
            max-width: 100%;
            padding-bottom: 20px;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidenav" id="sidebarId" style="box-shadow: 0px 0px 10px 0px #2e2e2e; font-size: 15px; font-weight: bolder;">
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
            
    <!-- if contratante
        <nav class="nav flex-column">
            <a class="nav-link a2" href="#"><i class="fas fa-th-large"></i> Dashboard</a>
            <a class="nav-link a2" href="#"><i class="far fa-star"></i> Destaques</a>
            <a class="nav-link a2" href="#"><i class="fas fa-search"></i> Descobrir</a>
            <a class="nav-link a2" href="#"><i class="far fa-user-circle"></i> Meu Perfil</a>
            <a class="nav-link a2" href="#"><i class="fas fa-bullhorn"></i> Inserir Vagas</a>
            <a class="nav-link a2" href="#"><i class="fas fa-tasks"></i> Gerenciar Vagas</a>
            <a class="nav-link a2" href="#"><i class="far fa-id-card"></i> Contato</a>
        </nav>
        fim if contratante-->
    </div>

    <div id="main">
        <div class="nav-item btn-rotate dropdown" style="position: absolute; right: 0; margin-top: -5px;">
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
        <br><br><hr>
            <form method="post" action="?Enviar=1" enctype="multipart/form-data" style="margin-top: 26px;">
                <!-- Modal de configuração-->
                <div class="modal fade" id="projetoConfig" tabindex="-1" role="dialog" aria-labelledby="projetoConfig" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Configurações do Projeto</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                    <div id="slotCapa" style="max-width: 50%; margin-right: auto; margin-left: auto;">
                                        <img>
                                    </div>
                                    <h6 class="heading-small text-muted" style="margin-bottom: 20px; margin-top: 20px;">Detalhes do Projeto</h6>
                                    <div class="form-group">
                                        <label class="show" for="tituloProjeto" style="font-size: 11px;">Título</label>
                                        <input name="titulo" type="text" class="form-control" id="tituloProjeto">
                                    </div>
                                    <div class="form-group">
                                        <label class="show" for="descricaoProjeto" style="font-size: 11px;">Descrição</label>
                                        <textarea name="descricao" class="form-control" id="descricaoProjeto" rows="3"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label class="show" for="categoriaProjeto" style="font-size: 11px;">Categoria</label>
                                        <input type="text" name="categoria" class="form-control" id="categoriaProjeto"/>
                                    </div>
                                    <h6 class="heading-small text-muted" style="margin-bottom: 20px; margin-top: 20px;">Prévia da Galeria</h6>
                                    <div id="gallery"></div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" value="Enviar" class="btn btn-primary">Publicar</button>
                                <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <div class="card card-nav-tabs">
                            <div class="card-header card-header-blank" style="background-color: #dbdbdb; color: #313131; text-transform: uppercase; font-weight: bolder;"> Meu projeto</div>
                                <div class="card-body">
                                    <h6 class="heading-small text-muted" style="margin-bottom: -7px;">Selecionar Arquivos:</h6>
                                    <small>Selecione todas as imagens em uma única vez, tenha em mente que a capa do projeto será sempre a primeira imagem na fila.</small><br>
                                    <input type="file" name="arquivo[]" multiple id="gallery-photo-add">
                                    <label for="gallery-photo-add">Escolher imagens</label> <br>
                                    <hr>
                                    <h6 class="heading-small text-muted" style="margin-bottom: -7px;">Prévia da Galeria:</h6>
                                    <div id="gallery"></div>
                                    <button type="button" id="updateCapa" class="btn btn-primary" data-toggle="modal" data-target="#projetoConfig" style="position: absolute; right: 0; margin-right: 20px;">Finalizar Publicação</button>
                                    <br><br>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>



</body>
<!--Preview-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
    $(function () {
        // Variável das imagens
        var imagesPreview = function (input, placeToInsertImagePreview) {

            if (input.files) {
                var filesAmount = input.files.length;

                for (i = 0; i < filesAmount; i++) {
                    var reader = new FileReader();

                    reader.onload = function (event) {
                        $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(placeToInsertImagePreview);
                    }

                    //Transforma a leitura dos arquivos para que o navegador entenda e reproduza a imagem
                    reader.readAsDataURL(input.files[i]);
                }
            }
        };

        $('#gallery-photo-add').on('change', function () {
            imagesPreview(this, 'div#gallery');
        });
    });</script>

<!--Imagem da capa-->
<script>
    //Referenciando os elementos a serem trabalhados na DOM (Botão e div onde a capa é exibida no modal)
    var btnUpdate = document.querySelector('button#updateCapa');
    var capaElement = document.querySelector('div#slotCapa');

    //Criamos o elemento "img" que será jogado na capa
    var imageElement = document.querySelector('div#slotCapa img');

    btnUpdate.onclick = function () {

        //Pegamos a "src" da primeira imagem no preview
        var imagemCapa = document.querySelectorAll('div#gallery img')[0].getAttribute("src");
        //Envio da imagem para a capa, atribuindo a src da primeira imagem do preview
        imageElement.setAttribute('src', imagemCapa);
        capaElement.appendChild(imageElement);
    }
</script>

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