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
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Novo Projeto</title>
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
        <div class="sidenav" id="sidebarId"
             style="box-shadow: 0px 0px 10px 0px #2e2e2e; font-size: 15px; font-weight: bolder;">
            <img src="assets/img/vitrine_logo_c.png" style="width: 150px; margin-top: -3em; margin-left: 1.5em;">
            <hr>

            <!-- if artista -->
        <nav class="nav flex-column">
            <a class="nav-link a2" href="portfolio.php"><i class="fas fa-palette"></i> Portfólio</a>
            <a class="nav-link a2" href="dashboard.html"><i class="fas fa-th-large"></i> Dashboard</a>
            <a class="nav-link a2" href="#"><i class="far fa-star"></i> Destaques</a>
            <a class="nav-link a2" href="#"><i class="far fa-thumbs-up"></i> Recomendados</a>
            <a class="nav-link a2" href="search-vagas.php"><i class="fas fa-search-dollar"></i> Vagas</a>
            <a class="nav-link a2" href="#"><i class="far fa-envelope"></i> Mensagens</a>
            <a class="nav-link a2" href="#"><i class="far fa-id-card"></i> Contato</a>
        </nav>
            <!--fim if artista-->
            
            <!-- if contratante
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
        <br><br><hr><br>
            <form method="post" action="?Enviar=1" enctype="multipart/form-data">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <div class="container">
                        <a class="navbar-brand" href="#">Criação de projeto</a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNav">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Capa</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Visualização</a>
                                </li>
                            </ul>
                        </div>
                        <button type="button" class="btn btn-dark">Cancelar</button>
                        <button type="button" id="updateCapa" class="btn btn-success" data-toggle="modal"
                                data-target="#projetoConfig">
                            Continuar
                        </button>
                    </div>
                </nav>


                <!-- Modal de configuração-->
                <div class="modal fade" id="projetoConfig" tabindex="-1" role="dialog" aria-labelledby="projetoConfig"
                     aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Configurações do Projeto</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <nav style="padding-bottom: 25px;">
                                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                        <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home"
                                           role="tab" aria-controls="nav-home" aria-selected="true">Capa</a>
                                        <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile"
                                           role="tab" aria-controls="nav-profile" aria-selected="false">Visualização</a>
                                    </div>
                                </nav>
                                <div class="tab-content" id="nav-tabContent">
                                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel"
                                         aria-labelledby="nav-home-tab">
                                        <div id="slotCapa">
                                            <img>
                                        </div>
                                        <div class="form-group">
                                            <label for="tituloProjeto">Título</label>
                                            <input name="titulo" type="text" class="form-control" id="tituloProjeto"
                                                   >
                                        </div>
                                        <div class="form-group">
                                            <label for="descricaoProjeto">Descrição</label>
                                            <textarea name="descricao" class="form-control" id="descricaoProjeto" rows="3"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="categoria">Categoria</label>
                                            <input type="text" name="categoria" class="form-control" id="categoriaProjeto"/>
                                        </div>
                                         <div id="gallery"></div>
                                    </div>
                                    <div class="tab-pane fade" id="nav-profile" role="tabpanel"
                                         aria-labelledby="nav-profile-tab">

                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button value="Enviar" type="button" class="btn btn-dark" data-dismiss="modal">Fechar</button>
                                <button type="submit" value="Enviar" class="btn btn-success">Publicar</button>
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
                                    <h4 class="card-title">Arquivos</h4>
                                    <input type="file" name="arquivo[]" multiple id="gallery-photo-add">
                                    <label for="gallery-photo-add">Selecionar imagens</label> <br>
                                    <small>Obs: A capa do projeto será a primeira imagem na fila.</small>
                                    <hr>
                                    <div id="gallery"></div>

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