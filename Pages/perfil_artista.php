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
  <meta charset="UTF-8" />
  <link rel="icon" type="image/png" href="assets/img/favicon.png" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>Vitrine</title>
  <link rel="stylesheet" href="assets/css/material-dashboard.css" />
  <link rel="stylesheet" href="assets/css/style.css" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"
    integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous" />
  <link rel="stylesheet" type="text/css"
    href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" />
</head>

<body>
  <!-- Sidebar -->
  <div class="sidenav" id="sidebarId"
    style="box-shadow: 0px 0px 10px 0px #2e2e2e; font-size: 15px; font-weight: bolder;">
    <img src="assets/img/vitrine_logo_c.png" style="width: 150px; margin-top: -3em; margin-left: 1.5em;" />
    <hr />
    <nav class="nav flex-column">
      <a class="nav-link a2" href="portfolio.php"><i class="fas fa-palette"></i> Portfólio</a>
      <a class="nav-link a2" href="dashboard.html"><i class="fas fa-th-large"></i> Dashboard</a>
      <!--<a class="nav-link a2" href="#"><i class="far fa-star"></i> Destaques</a>
            <a class="nav-link a2" href="#"><i class="far fa-thumbs-up"></i> Recomendados</a>-->
      <a class="nav-link a2" href="search-vagas.php"><i class="fas fa-search-dollar"></i> Vagas</a>
      <!--<a class="nav-link a2" href="#"><i class="far fa-envelope"></i> Mensagens</a>-->
      <a class="nav-link a2" href="#"><i class="far fa-id-card"></i> Contato</a>
    </nav>
  </div>
  <div id="main">
    <div class="nav-item btn-rotate dropdown" style="position: absolute; right: 0; margin-top: -30px;">
      <a class="nav-link dropdown-toggle" href="#" id="perfil_dropdown" data-toggle="dropdown" aria-haspopup="true"
        aria-expanded="false" style="float: left;">
        <p align="right"
          style="float: left; margin-top: 13px; margin-right: 10px; text-transform: uppercase; font-weight: bolder; color: white;">
          <?php echo $usuario->getNm_usuario(); ?>
        </p>
        <img src="<?php echo $usuario->getFoto() ?>"
          style="border-radius: 50%; border: 5px solid white; width: 45px;" />
      </a>
      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="perfil_dropdown">
        <a class="dropdown-item" href="perfil_artista.php">Meu Perfil</a>
        <a class="dropdown-item" href="upload.php">Novo Projeto</a>
        <a class="dropdown-item" href="?deslogar=1">Sair</a>
      </div>
    </div>
    <br />
    <hr />
    <br />
    <!-- Container Principal -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-8">
            <!-- Card de Informações -->
            <div class="card">
              <div class="card-header card-header-blank"
                style="background-color: #dbdbdb; color: #313131; text-transform: uppercase; font-weight: bolder;">
                Perfil de Artista
                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target=".editar_perfil_modal"
                  style="position: absolute; margin-right: 10px; margin-top: -3px; right: 0;">
                  Editar
                </button>
              </div>
              <!-- Corpo do Card de Informações -->
              <div class="card-body">
                <h6 class="heading-small text-muted">Dados Pessoais</h6>
                <form>
                  <div class="row">
                    <div class="col-md-10">
                      <div class="form-group">
                        <label class="bmd-label-floating" for="campo_nome">Nome Completo</label>
                        <input type="text" class="form-control" name="nome" id="campo_nome"
                          value="<?php echo $usuario->getNm_usuario(); ?>" disabled />
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label class="bmd-label-floating" for="campo_idade">Idade</label>
                        <input type="number" class="form-control" name="idade" id="campo_idade" value="18" disabled />
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="bmd-label-floating" for="campo_local">Localização</label>
                        <input type="text" class="form-control" name="local" id="campo_local"
                          value="<?php echo $usuario->getLocal_usuario(); ?>" disabled />
                      </div>
                    </div>
                  </div>

                  <!-- Botão de Contato (Adicionar JS que só deixa abrir o collapse caso tenha dado match) -->
                  <div class="row">
                    <div class="col-md-12">
                      <p>
                        <a class="btn btn-primary" data-toggle="collapse" href="#campo_contato" role="button"
                          aria-expanded="false" aria-controls="campo_contato"
                          style="width: 100%; background: #f7f7f7; color: #999999">Contato</a>
                      </p>
                      <div class="row">
                        <div class="col">
                          <div class="collapse" id="campo_contato">
                            <div class="card card-body" style="margin-top: -1em;">
                              <!-- Informações de Contato -->
                              <div class="row">
                                <div class="col-md-12">
                                  <div class="form-group">
                                    <label class="bmd-label-floating" for="campo_telefone">Telefone</label>
                                    <input type="text" class="form-control" name="telefone" id="campo_telefone"
                                      value="<?php echo $usuario->getTelefone_usuario(); ?>" disabled />
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-12">
                                  <div class="form-group">
                                    <label class="bmd-label-floating" for="campo_email">E-Mail</label>
                                    <input type="email" class="form-control" name="email" id="campo_email"
                                      value="<?php echo $usuario->getEmail_usuario(); ?>" disabled />
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="clearfix"></div>
                </form>
              </div>
            </div>

            <!-- Formação Acadêmica -->
            <div class="card" style="margin-top: 50px;">
              <div class="card-header card-header-blank"
                style="background-color: #dbdbdb; color: #313131; text-transform: uppercase; font-weight: bolder;">
                Formação Acadêmica
                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target=".editar_formacao_modal"
                  style="position: absolute; margin-right: 10px; margin-top: -3px; right: 0;">
                  Editar
                </button>
              </div>
              <div class="card-body">
                <h6 class="heading-small text-muted">
                  Informações da Formação
                </h6>
                <div class="row"
                  style=" padding: 6px; margin: 0px; box-shadow: 0px 1px 4px #d2b4a5; border-radius: 3px;">
                  <div class="col-md-4">
                    <h6 class="heading-small text-muted">
                      Técnico em Informática
                    </h6>
                    <br />
                    <h6 class="heading-small text-muted" style="margin-top: -3em;">
                      28/06/2019
                    </h6>
                  </div>
                  <div class="col-md-8">
                    <p style="line-height: 18px;">
                      Curso técnico na área de informática, ministrado na ETEC
                      Professor Horácio Augusto da Silveira. O curso consiste
                      em técnicas de lógica de programação e análise dos
                      sistemas, além do aprendizado de algumas linguagens de
                      programação como o C#, Java, PHP, JavaScript, entre
                      outros.
                    </p>
                  </div>
                </div>
              </div>
              <div class="clearfix"></div>
            </div>

            <!-- Experiência Profissional -->
            <div class="card" style="margin-top: 50px;">
              <div class="card-header card-header-blank"
                style="background-color: #dbdbdb; color: #313131; text-transform: uppercase; font-weight: bolder;">
                Experiência Profissional
                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target=".editar_experiencia_modal"
                  style="position: absolute; margin-right: 10px; margin-top: -3px; right: 0;">
                  Editar
                </button>
              </div>
              <div class="card-body">
                <!--<h6 class="heading-small text-muted">Experiência Profissional</h6>
                                <?php
                                    $expDAO = new ExperienciaDAO();
                                    $exps = $expDAO->busar_expArtista($usuario->getId_usuario());
                                    if ($exps != null):
                                        foreach ($exps as $exp):
                                ?>       
                                <div class="row" style=" padding: 6px; margin: 0px; box-shadow: 0px 1px 4px #d2b4a5; border-radius: 3px;">
                                    <div class="col-md-4">
                                        <h6 class="heading-small text-muted"><?php echo $exp['empresa_exp']; ?>;</h6><br>
                                        <h6 class="heading-small text-muted" style="margin-top: -3em;">24/04/2019</h6>    
                                    </div>
                                <div class="col-md-8">
                                    <p style="line-height: 18px;"><?php echo $exp['descricao_exp']; ?></p>
                                </div>
                                </div><br>
                                    <?php
                                        endforeach;
                                    else:
                                    ?>

                                <div class="row" style=" padding: 6px; margin: 0px; box-shadow: 0px 1px 4px #d2b4a5; border-radius: 3px;">
                                    <div class="col-md-8">
                                        <p style="line-height: 18px;">Nada para mostrar</p>
                                    </div>
                                </div>
                                <?php endif; ?>-->

                <h6 class="heading-small text-muted">
                  Informações do Trabalho
                </h6>
                <div class="row"
                  style=" padding: 6px; margin: 0px; box-shadow: 0px 1px 4px #d2b4a5; border-radius: 3px;">
                  <div class="col-md-4">
                    <h6 class="heading-small text-muted">Jovem Aprendiz</h6>
                    <br />
                    <h6 class="heading-small text-muted" style="margin-top: -3em;">
                      24/11/2018
                    </h6>
                  </div>
                  <div class="col-md-8">
                    <p style="line-height: 18px;">
                      Contrado como Jovem Aprendiz em uma empresa de
                      tecnologia com a premissa de aprender sobre o mercado,
                      técnicas de programação e a como se portar diante de uma
                      empresa de grande porte.
                    </p>
                  </div>
                </div>
              </div>
              <div class="clearfix"></div>
            </div>
          </div>

          <!-- Card de Perfil (sobre mim) -->
          <div class="col-md-4">
            <div class="card card-profile">
              <div class="card-avatar">
                <a href="" data-toggle="modal" data-target="#editfoto">
                  <img class="img" style="min-width: 100%;" src="<?php echo $usuario->getFoto() ?>" />
                </a>
              </div>
              <div class="card-body" style="margin-top: -10px;">
                <h6 class="card-category">Programador</h6>
                <h4 class="card-title" style="margin-top: -0.5em;">
                  <?php echo $usuario->getNm_usuario(); ?>
                </h4>
                <hr />

                <div class="row">
                  <div class="col">
                    <div class="card-profile-stats d-flex justify-content-center container-fluid">
                      <div style="margin: auto;">
                        <span class="heading">47</span><br />
                        <span class="description" style="font-weight: bold;">Seguindo</span>
                      </div>
                      <div style="margin:auto;">
                        <span class="heading">150</span><br />
                        <span class="description" style="font-weight: bold;">Seguidores</span>
                      </div>
                      <div style="margin: auto;">
                        <span class="heading">89</span><br />
                        <span class="description" style=" font-weight: bold;">Incentivo</span>
                      </div>
                    </div>
                  </div>
                </div>
                <hr />
                <p class="card-description">
                  <?php  echo $usuario->getDescricao_usuario(); ?>
                  <!-- Me chamo Igor de Souza Teixeira e tenho 18 anos. Atualmente no curso técnico de informática, trabalhando para concluir o TCC junto com os membros do meu grupo. No trabalho eu cuido da parte de desenvolvimento do back-end em PHP e do banco de dados.-->
                </p>
                <hr />
                <button type="submit" class="btn btn-primary" style="width: 100%;">
                  Seguir
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!--Modal de Foto de Perfil-->
    <div class="modal fade" id="editfoto" tabindex="-1" role="dialog" aria-labelledby="modal_trabalho_header"
      aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">
              Selecione uma foto de perfil.
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form method="post" action="?action=edit_ft" enctype="multipart/form-data">
              <!--Assim dá pra enviar arquivo-->
              <input type="file" class="btn" style="width: 100%;" name="capa" /><br />
              <hr />
              <input type="submit" class="btn-primary btn" value="Enviar" name="fotoperfil"
                style="right: 0; position: absolute; margin-top: 0px; margin-right: 130px;" />
              <input type="button" class="btn-primary btn" value="Fechar" class="close" data-dismiss="modal"
                aria-label="Close" style="right: 0; position: absolute; margin-top: 0px; margin-right: 20px;" /><br />
            </form>
          </div>
        </div>
      </div>
    </div>

    <!--Modal de Editar Perfil-->
    <div class="modal fade editar_perfil_modal" tabindex="-1" role="dialog" aria-labelledby="perfil_modal"
      aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content container">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">
              Editar Informações Pessoais
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form>
              <div class="row">
                <div class="col-md-8">
                  <div class="form-group">
                    <label class="show" for="campo_nome" style="font-size: 11px;">Nome Completo</label>
                    <input type="text" class="form-control" name="nome" id="campo_nome"
                      value="<?php echo $usuario->getNm_usuario(); ?>" />
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="show" for="campo_idade" style="font-size: 11px;">Data de Nascimento</label>
                    <input type="date" class="form-control" name="nascimento" id="campo_nascimento" value="" />
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="show" for="campo_local" style="font-size: 11px;">E-Mail</label>
                    <input type="text" class="form-control" name="local" id="campo_email"
                      value="<?php echo $usuario->getEmail_usuario(); ?>" />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="show" for="campo_local" style="font-size: 11px;">Telefone</label>
                    <input type="text" class="form-control" name="local" id="campo_telefone"
                      value="<?php echo $usuario->getTelefone_usuario(); ?>" />
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="show" for="campo_local" style="font-size: 11px;">Localização</label>
                    <input type="text" class="form-control" name="local" id="campo_local"
                      value="<?php echo $usuario->getLocal_usuario(); ?>" />
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="show" for="campo_profissao" style="font-size: 11px;">Profissão</label>
                    <input type="text" class="form-control" name="profissao" id="campo_profissao"
                      value="<?php # echo $usuario->getLocal_usuario(); ?>" />
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="show" for="campo_sobre" style="font-size: 11px;">Sobre Mim</label>
                    <textarea class="form-control" id="campo_sobre" rows="4">
<?php echo $usuario->getDescricao_usuario(); ?></textarea>
                  </div>
                </div>
              </div>
            </form>
            <hr />
            <form>
              <input type="submit" class="btn-primary btn" value="Salvar" name="salvar_perfil"
                style="right: 0; position: absolute; margin-top: 0px; margin-right: 130px;" />
              <input type="button" class="btn-primary btn" value="Fechar" class="close" data-dismiss="modal"
                aria-label="Close" style="right: 0; position: absolute; margin-top: 0px; margin-right: 20px;" /><br />
            </form>
          </div>
        </div>
      </div>
    </div>

    <!--Modal de Editar Formação-->
    <div class="modal fade editar_formacao_modal" tabindex="-1" role="dialog" aria-labelledby="formacao_modal"
      aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content container">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">
              Editar Formação Acadêmica
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form>
              <div class="row">
                <div class="col-md-8">
                  <div class="form-group">
                    <label class="show" for="campo_formacao" style="font-size: 11px;">Formação Acadêmica</label>
                    <input type="text" class="form-control" name="formacao" id="campo_formacao"
                      aria-describedby="basic-addon1" value="Técnico em Informática" />
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="show" for="campo_formacao_conclusao" style="font-size: 11px;">Data de
                      Conclusão</label>
                    <input type="date" class="form-control" name="formacao_conclusao" id="campo_formacao_conclusao"
                      value="" />
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="show" for="campo_formacao_descricao" style="font-size: 11px;">Descrição da
                      Formação</label>
                    <textarea class="form-control" id="formacao_descricao" rows="4">
Curso técnico na área de informática, ministrado na ETEC Professor Horácio Augusto da Silveira. O curso consiste em técnicas de lógica de programação e análise dos sistemas, além do aprendizado de algumas linguagens de programação como o C#, Java, PHP, JavaScript, entre outros.</textarea>
                  </div>
                </div>
              </div>
            </form>
            <hr />
            <form>
              <input type="submit" class="btn-primary btn" value="Salvar" name="salvar_formacao"
                style="right: 0; position: absolute; margin-top: 0px; margin-right: 130px;" />
              <input type="button" class="btn-primary btn" value="Fechar" class="close" data-dismiss="modal"
                aria-label="Close" style="right: 0; position: absolute; margin-top: 0px; margin-right: 20px;" /><br />
            </form>
          </div>
        </div>
      </div>
    </div>

    <!--Modal de Editar Experiência-->
    <div class="modal fade editar_experiencia_modal" tabindex="-1" role="dialog" aria-labelledby="formacao_modal"
      aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content container">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">
              Editar Experiência Profissional
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form>
              <div class="row">
                <div class="col-md-8">
                  <div class="form-group">
                    <label class="show" for="campo_experiencia" style="font-size: 11px;">Experiência
                      Profissional</label>
                    <input type="text" class="form-control" name="experiencia" id="campo_experiencia"
                      aria-describedby="basic-addon1" value="Jovem Aprendiz" />
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="show" for="campo_experiencia_conclusao" style="font-size: 11px;">Data de
                      Execução</label>
                    <input type="date" class="form-control" name="experiencia_conclusao" id="campo_formacao_conclusao"
                      value="" />
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="show" for="campo_experiencia_descricao" style="font-size: 11px;">Descrição da
                      Experiência</label>
                    <textarea class="form-control" id="experiencia_descricao" rows="4">
Contrado como Jovem Aprendiz em uma empresa de tecnologia com a premissa de aprender sobre o mercado, técnicas de programação e a como se portar diante de uma empresa de grande porte.</textarea>
                  </div>
                </div>
              </div>
            </form>
            <hr />
            <form>
              <input type="submit" class="btn-primary btn" value="Salvar" name="salvar_experiencia"
                style="right: 0; position: absolute; margin-top: 0px; margin-right: 130px;" />
              <input type="button" class="btn-primary btn" value="Fechar" class="close" data-dismiss="modal"
                aria-label="Close" style="right: 0; position: absolute; margin-top: 0px; margin-right: 20px;" /><br />
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!--JS HELPERS-->
  <script src="assets/Helpers/js/estados-cidades.js"></script>

  <!--Scripts do material dashboard-->
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