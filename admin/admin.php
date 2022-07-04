<?php 

    session_start(); 
    
    if(isset($_SESSION['login_personal_adm']) == '')
    {
        header('Location: index.php');
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Microeasy</title>

    <!-- Bootstrap Core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>

    <!-- Plugin CSS -->
    <link href="../vendor/magnific-popup/magnific-popup.css" rel="stylesheet">

    <!-- Theme CSS -->
    <link href="../css/creative.min.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body id="page-top">

    <nav id="mainNav" class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand page-scroll" href="#page-top">Microeasy</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a class="page-scroll" href="#mailing">Mailing</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#campanha">Campanha</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#relatorio">Relatório</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#contact">Suporte</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="logout.php">Sair</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

    <header>
        <div class="header-content">
            <div class="header-content-inner">
                <h1 id="homeHeading" style="display: none;">BEM-VINDO <?php echo $_SESSION['login_personal_adm']; ?></h1>
                <hr>
                <p>Personalcob & Microeasy</p>
                <!-- a href="#mailing" class="btn btn-primary btn-xl page-scroll" style="background: #00FFFF; color: #000000;">Acessar</a -->
            </div>
        </div>
    </header>

    <section id="mailing" style="background-color: #D8D8D8;">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <h2 class="section-heading">Mailing</h2>
                    <hr class="primary">
                </div>
                <div class="col-lg-4 col-lg-offset-2 text-center">
                    <i class="fa fa-info fa-3x sr-contact"></i>
                    <p>Upload de arquivo com a extensçao .csv</p>
                    <i class="fa fa-file-excel-o fa-3x sr-contact"></i>
                    <form id="formulario" enctype="multipart/form-data">
                        <p><input type="file" id="import1" name="import1"></p>
                    </form>
                </div>
                <div class="col-lg-4 col-lg-offset-2 text-center">
                    <i class="fa fa-indent fa-3x sr-contact"></i>
                    <input type="text" id="nome-campanha" placeholder="Nome da Campanha" class="form-control" maxlength="25">
                </div>
                <div class="col-lg-4 col-lg-offset-2 text-center">
                    <i class="fa fa-university fa-3x sr-contact"></i>
                    <select class="form-control" id="opcao-banco">
                        <option value="0">[Selecione um Banco]</option>
                    </select>
                </div>
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <div id="alert-ok" class="alert alert-success">
                      <strong>Mensagem!</strong> Arquivo importado com sucesso, <span id="linhas-file"></span> gravadas no banco de dados
                    </div>
                    <div id="alert-erro" class="alert alert-danger">
                      <strong>Ops!</strong> <span id="erro-file"></span>
                    </div>
                </div>
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    
                    <button type="button" style="background-color: #333; color: #FFFFFF;" id="bt-upload" class="btn btn-default"><i class="fa fa-upload fa-1x sr-contact"></i> Fazer Upload</button>
                </div>
            </div>
        </div>
    </section>

    <!-- CAMPANHA -->
    <section id="campanha">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <h2 class="section-heading">Lista de Campanhas</h2>
                    <hr class="primary">
                </div>
                <div align="center">
                    <form class="form-inline" style="color: #FFFFFF;">
                        <div class="form-group">
                            <label style="color: #333;" for="de-campanha">De:</label>
                            <input type="text" class="form-control" id="de-campanha" placeholder="DD/MM/AAAA">
                        </div>
                        <div class="form-group">
                            <label style="color: #333;" for="ate-campanha">Até:</label>
                            <input type="text" class="form-control" id="ate-campanha" placeholder="DD/MM/AAAA">
                        </div>
                        <div class="form-group">
                            <label style="color: #333;" for="total-campanha"> Total:</label>
                            <select class="form-control" id="total-campanha">
                                <option>1</option>
                                <option>10</option>
                                <option>20</option>
                                <option>50</option>
                                <option>100</option>
                            </select>
                        </div>
                        <button type="button" style="background-color: #333; color: #FFFFFF;" id="bt-filtro-campanha" class="btn btn-default"><span class="glyphicon glyphicon-filter"></span> Filtrar</button>
                    </form>
                </div>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Cod</th>
                            <th>Status</th>
                            <th>Campanha</th>
                            <th>Total</th>
                            <th>Arquivo</th>
                            <th>Dt. Upload</th>
                            <th>Dt. Edição</th>
                            <th>User</th>
                            <th>Banco</th>
                            <th style="display: none;">Excluir</th>
                        </tr>
                    </thead>
                    <tbody id="conteudo-campanha">
                        
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <section id="relatorio" style="background-color: #D8D8D8;">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <h2 class="section-heading">Relatório</h2>
                    <hr class="primary">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-lg-offset-0">
                    <!-- To configure the contact form email address, go to mail/contact_me.php and update the email address in the PHP file on line 19. -->
                    <!-- The form should work on most web servers, but if the form is not working you may need to configure your web server differently. -->
                    <div class="bs-example bs-example-tabs" data-example-id="togglable-tabs">
                        <ul class="nav nav-tabs" id="myTabs" role="tablist">
                            <li role="presentation" class="active">
                                <a href="#home" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">
                                    Acesso
                                </a>
                            </li>
                            <li role="presentation" class="" onclick="getAnalitico();">
                                <a href="#analitico" role="tab" id="analitico-tab" data-toggle="tab" aria-controls="profile" aria-expanded="false">
                                    Analítico
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade active in" role="tabpanel" id="home" aria-labelledby="home-tab">
                                <div class="row control-group">
                                    <center><img src="../img/loading.gif" id="load-table-acesso" style="display: none;" class="img-responsive"><center>
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Ano / Mês</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>
                                            <tbody id="table-relatorio-acesso">
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" role="tabpanel" id="analitico" aria-labelledby="profile-tab">
                                <center><img src="../img/loading.gif" id="load-table-analitico" style="display: none;" class="img-responsive"><center>
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Ano / Mês</th>
                                                <th>Total. Cpf</th>
                                                <th>Total. Tel</th>
                                                <th>Total. Cod. SMS. Validado</th>
                                                <th>Total. Boleto</th>
                                                <th>Total. SMS. LDG</th>
                                                <th>Total. Boleto. E-mail</th>
                                                <th>Total. Proposta. Usuário</th>
                                            </tr>
                                        </thead>
                                        <tbody id="table-analitico">
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <h2 class="section-heading">Suporte</h2>
                    <hr class="primary">
                </div>
                <div class="col-lg-4 col-lg-offset-2 text-center">
                    <i class="fa fa-phone fa-3x sr-contact"></i>
                    <p>(11) 2609 1644</p>
                </div>
                <div class="col-lg-4 text-center">
                    <i class="fa fa-envelope-o fa-3x sr-contact"></i>
                    <p><a>suporte@microeasy.com.br</a></p>
                </div>
            </div>
        </div>
    </section>

    <!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script src="../vendor/scrollreveal/scrollreveal.min.js"></script>
    <script src="../vendor/magnific-popup/jquery.magnific-popup.min.js"></script>

    <!-- Theme JavaScript -->
    <script src="../js/creative.min.js"></script>

    <!-- ajax -->
    <script src="../js/open.js"></script>

    <script src="http://malsup.github.com/jquery.form.js"></script>

    <!-- Helpers -->
    <script src="../js/mask.js"></script>

    <!-- Helpers -->
    <script src="../js/helpers.js?v=1.0.6"></script>

    <!-- Modal -->
    <div class="modal fade" id="modal-msg" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Mensagem!</h4>
            </div>
            <div class="modal-body">
              <p><span id="msg-consulta"></span></p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modal-load" role="dialog">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <div class="modal-header">
              
              <h4 class="modal-title">Aguarde...</h4>
            </div>
            <div class="modal-body">
              <center><img src="../img/loading.gif" class="img-responsive"><center>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal Habilitar-->
    <div class="modal fade" id="modal-habilitar" role="dialog" data-backdrop="static">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <!--button type="button" class="close" data-dismiss="modal">&times;</button -->
                    <h4 class="modal-title" id="inicio">Habilitar Campanha</h4>
                </div>
                <div class="modal-body">
                    <div class="alert alert-warning" id="alert-msg" style="display: none;">
                        <span id="alert-msg-conteudo"></span>
                    </div>
                    <div class="table-responsive" id="opcao-frases">
                    <table class="table">
                        <tr>
                            <td>
                                <div class="checkbox">
                                    <label><input type="checkbox" id="ck-divulgacao" value="">Divulgação</label>
                                </div>
                            </td>
                        </tr>
                        
                        <tr id="linha-frase-sms" style="display: none;">
                            <td>
                                |_
                            </td>
                            <td>
                                <div class="form-group">
                                    <label for="usr">Frase SMS</label>
                                    <input type="text" id="frase-divulfacao" class="form-control">
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <label for="hr-de-um-preventivo">Data:</label>
                                    <input class="form-control" type="text" id="dt-divulgacao">
                                        
                                    </select>
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <label for="hr-de-um-preventivo">Início:</label>
                                    <select class="form-control" id="hr-de-divulgacao">
                                        
                                    </select>
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <label for="hr-ate-um-preventivo">Fim:</label>
                                    <select class="form-control" id="hr-ate-divulgacao">
                                        
                                    </select>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="checkbox">
                                    <label><input type="checkbox" id="ck-preventivo" value="">Preventivo</label>
                                </div>
                            </td>
                        </tr>
                        <tr id="linha-preventivo-um" style="display: none;">
                            <td>
                                |_
                            </td>
                            <td align="left">
                                <div class="checkbox">
                                    <label><input type="checkbox" id="ck-preventivo-um" value=""><i class="fa fa-minus" aria-hidden="true"></i> 1 Dia</label>
                                </div>
                            </td>
                        </tr>
                        <tr id="linha-frase-preventivo-um" style="display: none;">
                            <td>
                                
                            </td>
                            <td>
                                |_
                            </td>
                            <td>
                                <div class="form-group">
                                    <label for="usr">Frase SMS</label>
                                    <input type="text" id="preventivo-frase-um" class="form-control">
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <label for="hr-de-um-preventivo">Início:</label>
                                    <select class="form-control" id="hr-de-um-preventivo">
                                        
                                    </select>
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <label for="hr-ate-um-preventivo">Fim:</label>
                                    <select class="form-control" id="hr-ate-um-preventivo">
                                        
                                    </select>
                                </div>
                            </td>
                        </tr>
                        <tr id="linha-preventivo-dois" style="display: none;">
                            <td>
                                |_
                            </td>
                            <td>
                                <div class="checkbox">
                                    <label><input type="checkbox" id="ck-preventivo-dois" value=""><i class="fa fa-minus" aria-hidden="true"></i> 2 Dias</label>
                                </div>
                            </td>
                        </tr>
                        <tr id="linha-frase-preventivo-dois" style="display: none;">
                            <td>
                                
                            </td>
                            <td>
                                |_
                            </td>
                            <td>
                                <div class="form-group">
                                    <label for="usr">Frase SMS</label>
                                    <input type="text" id="preventivo-frase-dois" class="form-control">
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <label for="hr-de-dois-preventivo">Início</label>
                                    <select class="form-control" id="hr-de-dois-preventivo">
                                        
                                    </select>
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <label for="hr-ate-dois-preventivo">Fim:</label>
                                    <select class="form-control" id="hr-ate-dois-preventivo">
                                        
                                    </select>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="checkbox">
                                    <label><input type="checkbox" id="ck-retencao" value="">Retenção</label>
                                </div>
                            </td>
                        </tr>
                        <tr id="linha-retencao-um" style="display: none;">
                            <td>
                                |_
                            </td>
                            <td>
                                <div class="checkbox">
                                    <label><input type="checkbox" id="ck-retencao-um" value=""><i class="fa fa-plus" aria-hidden="true"></i> 1 Dia</label>
                                </div>
                            </td>
                        </tr>
                        <tr id="linha-frase-retencao-um" style="display: none;">
                            <td>
                                
                            </td>
                            <td>
                                |_
                            </td>
                            <td>
                                <div class="form-group">
                                    <label for="usr">Frase SMS</label>
                                    <input type="text" id="retencao-frase-um" class="form-control">
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <label for="hr-de-um-retencao">Início:</label>
                                    <select class="form-control" id="hr-de-um-retencao">
                                        
                                    </select>
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <label for="hr-ate-um-retencao">Fim:</label>
                                    <select class="form-control" id="hr-ate-um-retencao">
                                        
                                    </select>
                                </div>
                            </td>
                        </tr>
                        <tr id="linha-retencao-dois" style="display: none;">
                            <td>
                                |_
                            </td>
                            <td>
                                <div class="checkbox">
                                    <label><input type="checkbox" id="ck-retencao-dois" value=""><i class="fa fa-plus" aria-hidden="true"></i> 2 Dias</label>
                                </div>
                            </td>
                        </tr>
                        <tr id="linha-frase-retencao-dois" style="display: none;">
                            <td>
                                
                            </td>
                            <td>
                                |_
                            </td>
                            <td>
                                <div class="form-group">
                                    <label for="usr">Frase SMS</label>
                                    <input type="text" id="retencao-frase-dois" class="form-control">
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <label for="hr-de-dois-retencao">Início</label>
                                    <select class="form-control" id="hr-de-dois-retencao">
                                        
                                    </select>
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <label for="hr-dois-um-retencao">Fim:</label>
                                    <select class="form-control" id="hr-ate-dois-retencao">
                                        
                                    </select>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <a href="#inicio"><button type="button" style="background-color: #585858; color: #FFFFFF;" class="btn btn-default" id="confirmar-frase"><i class="fa fa-share" aria-hidden="true"></i> Continuar</button></a>
                            </td>
                        </tr>
                    </table>
                    </div>
                    <div id="confirmacao-frases" style="display: none;">
                        <button type="button" style="background-color: #585858; color: #FFFFFF;" class="btn btn-default" id="voltar-frases"><i class="fa fa-reply" aria-hidden="true"></i> Voltar</button>
                        <button type="button" style="background-color: #64FE2E; color: #FFFFFF;" class="btn btn-default" id="habilitar-frases"><i class="fa fa-check-square-o" aria-hidden="true"></i> Habilitar</button>
                        <button type="button" style="background-color: #64FE2E; color: #FFFFFF; display: none;" class="btn btn-default" id="editar-frases"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> EDITAR</button>
                    </div>
                    <div id="load-habilitar" style="display: none;">
                        <center><img src="../img/loading.gif" class="img-responsive"><center>
                    </div>
                    <br>
                    <div class="alert alert-danger" id="alert-erro-campanha" style="display: none;">
                        <span id="alert-erro-campanha-conteudo"></span>
                    </div>
                    <div class="alert alert-success" id="alert-sucesso-campanha" style="display: none;">
                        Campanha habilitada com sucesso!
                    </div>
                    <div class="alert alert-success" id="alert-sucesso-campanha-editar" style="display: none;">
                        Campanha editada com sucesso!
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" id="fechar-frases"><i class="fa fa-times" aria-hidden="true"></i> Fechar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Desabilitar Campanha-->
    <div class="modal fade" id="modal-desabilitar" role="dialog" data-backdrop="static">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" onclick="fecharItensDesabilitar();" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Desabilitar Campanha</h4>
                </div>
                <div class="modal-body">
                    <div id="confirmacao-desabilita">
                        <p>Deseja desabilitar a campanha <span id="campanha-nome"></span>?</p>
                        <p>
                            <button type="button" style="background-color: #64FE2E; color: #FFFFFF;" class="btn btn-default" id="bt-desabilita-campanha"><i class="fa fa fa-thumbs-o-up" aria-hidden="true"></i> Sim</button>
                            <button type="button" style="background-color: #585858; color: #FFFFFF;" class="btn btn-default" onclick="fecharItensDesabilitar();" data-dismiss="modal"><i class="fa fa-thumbs-o-down" aria-hidden="true"></i> Não</button>
                        </p>
                    </div>
                    <div id="load-desabilitar" style="display: none;">
                        <center><img src="../img/loading.gif" class="img-responsive"><center>
                    </div>
                    <div class="alert alert-danger" id="alert-erro-campanha-desabilita" style="display: none;">
                        <span id="alert-erro-campanha-conteudo-desabilita"></span>
                    </div>
                    <div class="alert alert-success" id="alert-sucesso-desabilitar" style="display: none;">
                        Campanha desabilitada com sucesso!
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" onclick="fecharItensDesabilitar();" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Excluir Campanha-->
    <div class="modal fade" id="modal-excluir" role="dialog" data-backdrop="static">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" onclick="fecharItensExcluir();" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Excluir Campanha</h4>
                </div>
                <div class="modal-body">
                    <div id="confirmacao-excluir">
                        <p>Deseja excluir a campanha <span id="campanha-nome-excluir"></span>?</p>
                        <p>
                            <button type="button" style="background-color: #64FE2E; color: #FFFFFF;" class="btn btn-default" id="bt-excluir-campanha"><i class="fa fa fa-thumbs-o-up" aria-hidden="true"></i> Sim</button>
                            <button type="button" style="background-color: #585858; color: #FFFFFF;" class="btn btn-default" onclick="fecharItensExcluir();" data-dismiss="modal"><i class="fa fa-thumbs-o-down" aria-hidden="true"></i> Não</button>
                        </p>
                    </div>
                    <div id="load-excluir" style="display: none;">
                        <center><img src="../img/loading.gif" class="img-responsive"><center>
                    </div>
                    <div class="alert alert-danger" id="alert-erro-campanha-excluir" style="display: none;">
                        <span id="alert-erro-campanha-conteudo-excluir"></span>
                    </div>
                    <div class="alert alert-success" id="alert-sucesso-excluir" style="display: none;">
                        Campanha excluida com sucesso!
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" onclick="fecharItensExcluir();" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal erro-->
    <div class="modal fade" id="modal-erro" role="dialog" data-backdrop="static">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Mensagem</h4>
                </div>
                <div class="modal-body" id="modal-erro-conteudo">
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Acesso de usuário -->
    <div class="modal fade" id="modal-acesso" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" id="table-acesso-dt-title"></h4>
                </div>
                <div class="modal-body" id="modal-acesso-conteudo">
                    <button type="button" class="btn btn-primary" id="bt-excel">Excel</button>        
                    <div class="table-responsive">
                        <table class="table table-hover" id="table-acesso-user">
                            <thead>
                                <tr>
                                    <th>Dt Acesso</th>
                                    <th>Nome</th>
                                    <th>CPF / CNPJ</th>
                                    <th>Id Campanha</th>
                                    <th>Nome Campanha</th>
                                </tr>
                            </thead>
                            <tbody id="table-acesso-dt">
                                
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Helpers -->
    <script src="../js/mask.js"></script>

    <script type="text/javascript">
        /** 
        *  Função que busca os bandos para amarrar com o mailing.
        *  Ao buscar os bancos a função carrega o select option opcao-banco
        **/
        function getBancos()
        {
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: '../controller/controller.php',
                async: true,
                data: {
                        arquivo: 'admin/admin.php', type: 'getBancos',
                      },
                beforeSend: function() {
                    
                },
                success: function(result, status, request) {
                    var res      = JSON.parse(request.responseText);
                    var conteudo = "<option value='0'>[Selecione um Banco]</option>";

                    for (var i = 0; i < res.length; i++) {
                        conteudo += "<option value='"+ res[i].ID +"'>"+ res[i].DESCRICAO +"</option>"
                    }

                    if (res.length > 0) {
                        $('#opcao-banco').html(conteudo);
                    }
                },
                error: function(request, status, erro) {
                    console.log('Ocorreu o seguinte erro -> ' + request.responseText);
                },
                complete: function() {
                    
                }
            });
        }

        /** 
        *  Função que busca todas as campanhas e lista em uma babela.
        **/
        function getCampanha()
        {
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: '../controller/controller.php',
                async: true,
                data: {
                        arquivo: 'admin/admin.php', type: 'getCampanha',
                      },
                beforeSend: function() {
                    
                },
                success: function(result, status, request) {
                    var res      = JSON.parse(request.responseText);
                    var conteudo = '';
                    var statusAbilitado = '';
                    var statusDesabilitado = '';
                    var color = '';
                    var classIcon = '';
                    var nomeArquivo = '';
                    if (res.length == 0) {
                        $('#conteudo-campanha').html('Sem campanhas cadastradas.');
                    } else {
                        for (var i = 0; i < res.length; i++) {
                            statusAbilitado = (res[i].status_campanha == 1) ? 'checked' : '';
                            statusDesabilitado = (res[i].status_campanha == 0) ? 'checked' : '';
                            color = (res[i].status_campanha == 1) ? "" : "";
                            classLinha = (res[i].status_campanha == 1) ? "class='success'" : "class='danger'";
                            nomeArquivo = res[i].nome_arquivo;
                            dtEdicao = (res[i].dt_ultima_edicao == null) ? 'Sem edição' : res[i].dt_ultima_edicao;

                            conteudo += "<tr "+ classLinha +">" +
                                            "<td>" + res[i].id + "</td>" +
                                            '<td>' + 
                                                        "<i style='cursor: pointer; color: #64FE2E;' class='fa fa-check' aria-hidden='true' onclick='habilitarCampanha("+ res[i].id +");'></i>" +
                                                        "&nbsp;&nbsp;&nbsp;" + 
                                                        "<i style='cursor: pointer; color: red;' class='fa fa-times' aria-hidden='true' onclick='desabilitaCampanha(\""+ res[i].nome_campanha +"\", "+ res[i].id +");'></i>" +
                                                     
                                            '</td>' +
                                            '<td>' + res[i].nome_campanha + '</td>' +
                                            '<td>' + res[i].total + '</td>' +
                                            "<td title='"+ nomeArquivo +"'>" + nomeArquivo.substr(0, 8) + '...</td>' +
                                            '<td>' + res[i].dt_upload + '</td>' +
                                            '<td>' + dtEdicao + '</td>' +
                                            '<td>' + res[i].user + '</td>' +
                                            '<td>' + res[i].banco + '</td>' +
                                            "<td style='display: none;'><i style='cursor: pointer;' class='fa fa-ban' aria-hidden='true' onclick='excluirCampanha(\""+ res[i].nome_campanha +"\", "+ res[i].id +");'></i></td>" +
                                        '</tr>';
                        }
                        $('#conteudo-campanha').html('');
                        $('#conteudo-campanha').html(conteudo);
                    }
                },
                error: function(request, status, erro) {
                    console.log('Ocorreu o seguinte erro -> ' + request.responseText);
                },
                complete: function() {
                    
                }
            });   
        }

        /** 
        *  Função para listar o relatório analítico
        **/
        function getAnalitico()
        {
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: '../controller/controller.php',
                async: true,
                data: {
                        arquivo: 'admin/admin.php', type: 'getAnalitico',
                      },
                beforeSend: function() {
                    $('#load-table-analitico').show(400);
                },
                success: function(result, status, request) {
                    console.log(result);
                    var conteudo = '';
                    for (var i = 0; i < result.length; i++) {
                        conteudo += '<tr>' +
                                        '<td>' + result[i].totalAcessos['dtAcesso'].substr(0,7) + '</td>' +
                                        '<td>' + result[i].totalAcessos['total'] + '</td>' +
                                        '<td>' + result[i].totalTelefone['total'] + '</td>' +
                                        '<td>' + result[i].totalCodValidado['total'] + '</td>' +
                                        '<td>' + ((result[i].totalBoleto['total'] != null) ? result[i].totalBoleto['total'] : 0) + '</td>' +
                                        '<td>' + ((result[i].totalSmsLd['total'] != null) ? result[i].totalSmsLd['total'] : 0) + '</td>' +
                                        '<td>' + ((result[i].totalBoletoEmail['total'] != null) ? result[i].totalBoletoEmail['total'] : 0) + '</td>' +
                                        '<td>' + '' + '</td>' +
                                    '</tr>';
                    }
                    $('#table-analitico').html(conteudo);
                },
                error: function(request, status, erro) {
                    $('#modal-erro').modal('show');
                    $('#modal-erro-conteudo').html('Ocorreu o seguinte erro: ' + request.responseText);
                },
                complete: function() {
                    $('#load-table-analitico').hide(400);  
                }
            });
        }

        /** 
        *  Função para fechar os itens alertas, erros e abilitar os botoẽs de confirmação.
        **/
        function fecharItensDesabilitar()
        {
            $('#confirmacao-desabilita').show(400);
            $('#alert-erro-campanha-desabilita').hide(400);
            $('#alert-sucesso-desabilitar').hide(400);

            getCampanha();
        }

        function fecharItensExcluir()
        {
            $('#confirmacao-excluir').show(400);
            $('#alert-erro-campanha-excluir').hide(400);
            $('#alert-sucesso-excluir').hide(400);

            getCampanha();
        }

        var idCampanha = 0;
        function habilitarCampanha(id)
        {
            var func = {
                loadCampanha: function(id) {
                    $.ajax({
                        type: 'POST',
                        dataType: 'json',
                        url: '../controller/controller.php',
                        async: true,
                        data: {
                                idCampanha: id,
                                arquivo: 'admin/admin.php', type: 'loadCampanhaInformacoes',
                              },
                        beforeSend: function() {
                            $('#opcao-frases').hide(400);
                            $('#load-habilitar').show(400);
                        },
                        success: function(result, status, request) {
                            var res = JSON.parse(request.responseText);
                            
                            if (res != 'vazio') {
                                $('#ck-divulgacao').prop('checked', (res[0].DIVULGACAO == 1) ? true : false);
                                if ($('#ck-divulgacao').prop('checked')) {
                                    $('#frase-divulfacao').val(res[0].FRASE_DIVULGACAO);
                                    $('#dt-divulgacao').val(res[0].DT_DIVULGACAO.substr(8, 2) + '/' + res[0].DT_DIVULGACAO.substr(5, 2) + '/' + res[0].DT_DIVULGACAO.substr(0, 4));
                                    $('#hr-de-divulgacao').val(res[0].HR_DE_DIVULGACAO);
                                    $('#hr-ate-divulgacao').val(res[0].HR_ATE_DIVULGACAO);
                                    $('#linha-frase-sms').show(400);
                                }

                                $('#ck-preventivo').prop('checked', (res[0].PREVENTIVO == 1) ? true : false);
                                if ($('#ck-preventivo').prop('checked')) {
                                    $('#linha-preventivo-um').show(400);
                                    $('#linha-preventivo-dois').show(400);

                                    $('#ck-preventivo-um').prop('checked', (res[0].UM_DIA_PREVENTIVO == 1) ? true : false);
                                    if ($('#ck-preventivo-um').prop('checked')) {
                                        $('#linha-frase-preventivo-um').show(400);
                                    }

                                    $('#preventivo-frase-um').val((res[0].FRASE_UM_PREVENTIVO == 0) ? '' : res[0].FRASE_UM_PREVENTIVO);
                                    $('#hr-de-um-preventivo').val(res[0].HR_DE_UM_PREVENTIVO);
                                    $('#hr-ate-um-preventivo').val(res[0].HR_ATE_UM_PREVENTIVO);

                                    $('#ck-preventivo-dois').prop('checked', (res[0].DOIS_DIA_PREVENTIVO == 1) ? true : false);
                                    if ($('#ck-preventivo-dois').prop('checked')) {
                                        $('#linha-frase-preventivo-dois').show(400);
                                    }

                                    $('#preventivo-frase-dois').val((res[0].FRASE_DOIS_PREVENTIVO == 0) ? '' : res[0].FRASE_DOIS_PREVENTIVO);
                                    $('#hr-de-dois-preventivo').val(res[0].HR_DE_DOIS_PREVENTIVO);
                                    $('#hr-ate-dois-preventivo').val(res[0].HR_ATE_DOIS_PREVENTIVO);
                                }


                                $('#ck-retencao').prop('checked', (res[0].RETENCAO == 1) ? true : false);
                                if ($('#ck-retencao').prop('checked')) {
                                    $('#linha-retencao-um').show(400);
                                    $('#linha-retencao-dois').show(400);

                                    $('#ck-retencao-um').prop('checked', (res[0].UM_DIA_RETENCAO == 1) ? true : false);
                                    if ($('#ck-retencao-um').prop('checked')) {
                                        $('#linha-frase-retencao-um').show(400);
                                    }

                                    $('#retencao-frase-um').val((res[0].FRASE_UM_RETENCAO == 0) ? '' : res[0].FRASE_UM_RETENCAO);
                                    $('#hr-de-um-retencao').val(res[0].HR_DE_UM_RETENCAO);
                                    $('#hr-ate-um-retencao').val(res[0].HR_ATE_UM_RETENCAO);

                                    $('#ck-retencao-dois').prop('checked', (res[0].DOIS_DIA_RETENCAO == 1) ? true : false);
                                    if ($('#ck-retencao-dois').prop('checked')) {
                                        $('#linha-frase-retencao-dois').show(400);
                                    }

                                    $('#retencao-frase-dois').val((res[0].FRASE_DOIS_RETENCAO == 0) ? '' : res[0].FRASE_DOIS_RETENCAO);
                                    $('#hr-de-dois-retencao').val(res[0].HR_DE_DOIS_RETENCAO);
                                    $('#hr-ate-dois-retencao').val(res[0].HR_ATE_DOIS_RETENCAO);
                                }

                                $('#editar-frases').show(400);
                                $('#habilitar-frases').hide(400);
                            } else {
                                $('#habilitar-frases').show(400);
                                $('#editar-frases').hide(400);
                            }

                        },
                        error: function(request, status, erro) {
                            alert('Ocorreu o seguinte erro: ' + request.responseText);
                        },
                        complete: function() {
                            $('#load-habilitar').hide(400);
                            $('#opcao-frases').show(400);
                        }
                    });
                }
            };
            idCampanha = id;

            func.loadCampanha(id);

            // Carregar a campanha caso ela já existir


            $('#modal-habilitar').modal('show');
        }

        function desabilitaCampanha(nomeCampanha, id)
        {
            idCampanha = id;
            $('#campanha-nome').html(nomeCampanha);
            $('#modal-desabilitar').modal('show');
        }

        function excluirCampanha(nomeCampanha, id)
        {
            idCampanha = id;
            $('#campanha-nome-excluir').html(nomeCampanha);
            $('#modal-excluir').modal('show');   
        }


        /** 
        *  Função que incrementa a hora e os minutos em 15 em 15
        *  e preenche o selects de horário inínio e fim do modal Habilitar Campanha
        **/
        function incrementHr()
        {
            var hr = 0;
            var min = 0;

            var hrImpressao = '';
            var mimImpressa = '';

            var option = '';

            for (var i = 7; i <= 22; i++) {
                hr = i;
                while (min < 59) {
                    hrImpressao = hr.toString();
                    hrImpressao = (hrImpressao.length == 1) ? '0' + hr : hr;    

                    mimImpressa = min.toString();
                    mimImpressa = (mimImpressa.length == 1) ? '0' + min : min;

                    option += '<option>' + hrImpressao + ':' + mimImpressa + '</option>';

                    min += 15;
                }
                min = 0;
            }

            option += '<option>23:00</option>';

            $('#hr-de-divulgacao').html(option);
            $('#hr-ate-divulgacao').html(option);
            $('#hr-de-um-preventivo').html(option);
            $('#hr-ate-um-preventivo').html(option);
            $('#hr-de-dois-preventivo').html(option);
            $('#hr-ate-dois-preventivo').html(option);
            $('#hr-de-um-retencao').html(option);
            $('#hr-ate-um-retencao').html(option);
            $('#hr-de-dois-retencao').html(option);
            $('#hr-ate-dois-retencao').html(option);

            $('#hr-de-divulgacao').val('07:00');
            $('#hr-ate-divulgacao').val('07:00');
            $('#hr-de-um-preventivo').val('07:00');
            $('#hr-ate-um-preventivo').val('07:00');
            $('#hr-de-dois-preventivo').val('07:00');
            $('#hr-ate-dois-preventivo').val('07:00');
            $('#hr-de-um-retencao').val('07:00');
            $('#hr-ate-um-retencao').val('07:00');
            $('#hr-de-dois-retencao').val('07:00');
            $('#hr-ate-dois-retencao').val('07:00');
        }

        function getAcessoMes(dt)
        {
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: '../controller/controller.php',
                data: {
                        dt: dt,
                        arquivo: 'admin/admin.php', type: 'userAcessoDt',
                      },
                beforeSend: function() {
                    $('#modal-load').modal({backdrop: "static"});
                },
                success: function(result, status, request) {
                    if (result[0] != 'vazio') {
                        setTimeout(function(){
                            var conteudo    = '';
                            var totalAcesso = 0;

                            for (var i = 0; i < result.length; i++) {
                                conteudo += '<tr>' +
                                                '<td>' + result[i].DT_ACESSO + '</td>' +
                                                '<td>' + result[i].NOME_RAZAO_SOCIAL + '</td>' +
                                                '<td>' + result[i].CPF_CNPJ + '</td>' +
                                                '<td>' + result[i].id_camapnha + '</td>' +
                                                '<td>' + result[i].nome_campanha + '</td>' +
                                           '</tr>';
                                totalAcesso += 1;
                            }
                            
                            $('#table-acesso-dt-title').html('Total de acessos em ' + dt + ': ' + totalAcesso);
                            $('#table-acesso-dt').html(conteudo);
                            $('#modal-acesso').modal('show');
                        }, 600);
                    }
                },
                error: function(request, status, erro) {
                    setTimeout(function(){
                        $('#modal-erro').modal('show');
                        $('#modal-erro-conteudo').html('Ocorreu o seguinte erro -> ' + request.responseText);
                    }, 600);
                },
                complete: function() {
                    $('#modal-load').modal('hide');
                }
            });
        }

        $('#bt-filtro-campanha').click(function(){
            var de      = $('#de-campanha').val();
            var ate     = $('#ate-campanha').val();
            var total   = $('#total-campanha').val();

            if (de != '' && ate != '') {
                $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    url: '../controller/controller.php',
                    async: true,
                    data: {
                            de: de,
                            ate: ate,
                            total: total,
                            arquivo: 'admin/admin.php', type: 'getCampanhaData',
                          },
                    beforeSend: function() {
                        
                    },
                    success: function(result, status, request) {
                        var res      = JSON.parse(request.responseText);
                        var conteudo = '';
                        var statusAbilitado = '';
                        var statusDesabilitado = '';
                        var color = '';
                        var classIcon = '';
                        var nomeArquivo = '';
                        if (res.length == 0) {
                            $('#conteudo-campanha').html('Sem campanhas cadastradas.');
                        } else {
                            for (var i = 0; i < res.length; i++) {
                                statusAbilitado = (res[i].status_campanha == 1) ? 'checked' : '';
                                statusDesabilitado = (res[i].status_campanha == 0) ? 'checked' : '';
                                color = (res[i].status_campanha == 1) ? "" : "";
                                classLinha = (res[i].status_campanha == 1) ? "class='success'" : "class='danger'";
                                nomeArquivo = res[i].nome_arquivo;
                                dtEdicao = (res[i].dt_ultima_edicao == null) ? 'Sem edição' : res[i].dt_ultima_edicao;

                                conteudo += "<tr "+ classLinha +">" +
                                                "<td>" + res[i].id + "</td>" +
                                                '<td>' + 
                                                            "<i style='cursor: pointer; color: #64FE2E;' class='fa fa-check' aria-hidden='true' onclick='habilitarCampanha("+ res[i].id +");'></i>" +
                                                            "&nbsp;&nbsp;&nbsp;" + 
                                                            "<i style='cursor: pointer; color: red;' class='fa fa-times' aria-hidden='true' onclick='desabilitaCampanha(\""+ res[i].nome_campanha +"\", "+ res[i].id +");'></i>" +
                                                         
                                                '</td>' +
                                                '<td>' + res[i].nome_campanha + '</td>' +
                                                '<td>' + res[i].total + '</td>' +
                                                "<td title='"+ nomeArquivo +"'>" + nomeArquivo.substr(0, 8) + '...</td>' +
                                                '<td>' + res[i].dt_upload + '</td>' +
                                                '<td>' + dtEdicao + '</td>' +
                                                '<td>' + res[i].user + '</td>' +
                                                '<td>' + res[i].banco + '</td>' +
                                                "<td><i style='cursor: pointer;' class='fa fa-ban' aria-hidden='true' onclick='excluirCampanha(\""+ res[i].nome_campanha +"\", "+ res[i].id +");'></i></td>" +
                                            '</tr>';
                            }
                            $('#conteudo-campanha').html('');
                            $('#conteudo-campanha').html(conteudo);
                        }
                    },
                    error: function(request, status, erro) {
                        $('#modal-erro').modal('show');
                        $('#modal-erro-conteudo').html('Ocorreu o seguinte erro: ' + request.responseText);
                        
                    },
                    complete: function() {
                        
                    }
                });
            } else {
                $('#modal-erro-conteudo').html('Preencha as datas antes de filtrar!');
                $('#modal-erro').modal('show');
            }
        });

        $(document).ready(function() {


            $("#bt-excel").click(function () {
                $("#table-acesso-user").btechco_excelexport({
                    containerid: "table-acesso-user"
                   , datatype: $datatype.Table
                   , filename: 'relatorio_acesso_user'
                });
            });

            var obj = function(o) {
                if (typeof o !== "object") {
                    throw new TypeError('Expected a object');
                } else {
                    return o;
                }
            }

            incrementHr();
            getBancos();
            getCampanha();

            $('#dt-divulgacao').mask('99/99/9999');

            $('#de-campanha').mask('99/99/9999');
            $('#ate-campanha').mask('99/99/9999');

            $('#homeHeading').show(2000);
            $('#alert-ok').hide();
            $('#alert-erro').hide();

            // Habilita a opção Divulgação e abre a linha de Frase SMS
            $('#ck-divulgacao').click(function(){
                if(this.checked) {
                    $('#linha-frase-sms').show(400);
                } else {
                    $('#linha-frase-sms').hide(400);
                }
            });

            // Habilita a opção preventivo e abre a opção de dias
            $('#ck-preventivo').click(function(){
                if (this.checked) {
                    $('#linha-preventivo-um').show(400);
                    $('#linha-preventivo-dois').show(400);
                } else {
                    $('#linha-preventivo-um').hide(400);
                    $('#linha-preventivo-dois').hide(400);
                    $('#linha-frase-preventivo-um').hide(400);
                    $('#linha-frase-preventivo-dois').hide(400);
                    $('#ck-preventivo-um').prop('checked', false);
                    $('#ck-preventivo-dois').prop('checked', false);
                }
            });

            // Habilita a opção da frase de menos 1 dia preventivo
            $('#ck-preventivo-um').click(function(){
                if (this.checked) {
                    $('#linha-frase-preventivo-um').show(400);
                } else {
                    $('#linha-frase-preventivo-um').hide(400);
                }
            });

            // Habilita a opção da frase de menos 2 dia preventivo
            $('#ck-preventivo-dois').click(function(){
                if (this.checked) {
                    $('#linha-frase-preventivo-dois').show(400);
                } else {
                    $('#linha-frase-preventivo-dois').hide(400);
                }
            });

            // Habilita a opção retenção e abre a opção de dias
            $('#ck-retencao').click(function(){
                if (this.checked) {
                    $('#linha-retencao-um').show(400);
                    $('#linha-retencao-dois').show(400);
                } else {
                    $('#linha-retencao-um').hide(400);
                    $('#linha-retencao-dois').hide(400);
                    $('#linha-frase-retencao-um').hide(400);
                    $('#linha-frase-retencao-dois').hide(400);
                    $('#ck-retencao-um').prop('checked', false);
                    $('#ck-retencao-dois').prop('checked', false);
                }
            });

            // Habilita a opção da frase de mais 1 dia retenção
            $('#ck-retencao-um').click(function(){
                if (this.checked) {
                    $('#linha-frase-retencao-um').show(400);
                } else {
                    $('#linha-frase-retencao-um').hide(400);
                }
            });

            // Habilita a opção da frase de mais 2 dia retencao
            $('#ck-retencao-dois').click(function(){
                if (this.checked) {
                    $('#linha-frase-retencao-dois').show(400);
                } else {
                    $('#linha-frase-retencao-dois').hide(400);
                }
            });

            // Mostra as opções voltar e habilitar e esconde as frases
            $('#confirmar-frase').click(function(){
                var arrErro = [];

                if ($('#ck-divulgacao').prop('checked')) {
                    if ($('#ck-divulgacao').prop('checked') && $('#frase-divulfacao').val() == '') {
                        arrErro.push('Em divulgação preencha o campo Frase SMS');
                    }
                    if ($('#ck-divulgacao').prop('checked') && $('#dt-divulgacao').val() == '') {
                        arrErro.push('Em divulgação preencha o campo Data');
                    }
                }                

                if ($('#ck-preventivo').prop('checked')) {
                    if (!$('#ck-preventivo-um').prop('checked') && !$('#ck-preventivo-dois').prop('checked')) {
                        arrErro.push('Em preventivo habilite - 1 dia ou - 2 dias');
                    }
                    if ($('#ck-preventivo-um').prop('checked') && $('#preventivo-frase-um').val() == '') {
                        arrErro.push('Em preventivo - 1 dia preencha o campo Frase SMS')
                    }
                    if ($('#ck-preventivo-dois').prop('checked') && $('#preventivo-frase-dois').val() == '') {
                        arrErro.push('Em preventivo - 2 dias preencha o campo Frase SMS')
                    } 
                }

                if ($('#ck-retencao').prop('checked')) {
                    if (!$('#ck-retencao-um').prop('checked') && !$('#ck-retencao-dois').prop('checked')) {
                        arrErro.push('Em retenção habilite + 1 dia ou + 2 dias');
                    }
                    if ($('#ck-retencao-um').prop('checked') && $('#retencao-frase-um').val() == '') {
                        arrErro.push('Em retenção + 1 dia preencha o campo Frase SMS')
                    }
                    if ($('#ck-retencao-dois').prop('checked') && $('#retencao-frase-dois').val() == '') {
                        arrErro.push('Em retenção + 2 dias preencha o campo Frase SMS')
                    } 
                }

                if (arrErro.length > 0) {
                    var conteudo = '<p>Atenção</p>';
                    for (var i = 0; i < arrErro.length; i++) {
                        conteudo += '<p>- ' + arrErro[i] + '</p>';
                    }
                    $('#alert-msg-conteudo').html(conteudo);
                    $('#alert-msg').show(400);
                    
                } else {
                    $('#alert-msg').hide(400);
                    $('#opcao-frases').hide(400);
                    $('#confirmacao-frases').show(400);
                }
            });

            // Mostra as frases e esconde as opções voltar e habilitar
            $('#voltar-frases').click(function(){
                $('#confirmacao-frases').hide(400);
                $('#opcao-frases').show(400); 
            });

            // Mostra as frases e esconde as opções voltar e habilitar
            $('#fechar-frases').click(function(){
                getCampanha();

                $('#linha-frase-sms').hide(400);

                $('#linha-preventivo-um').hide(400);
                $('#linha-preventivo-dois').hide(400);
                $('#linha-frase-preventivo-um').hide(400);
                $('#linha-frase-preventivo-dois').hide(400);
                $('#ck-preventivo').prop('checked', false);
                $('#ck-preventivo-um').prop('checked', false);
                $('#ck-preventivo-dois').prop('checked', false);

                $('#linha-retencao-um').hide(400);
                $('#linha-retencao-dois').hide(400);
                $('#linha-frase-retencao-um').hide(400);
                $('#linha-frase-retencao-dois').hide(400);
                $('#ck-retencao').prop('checked', false);
                $('#ck-retencao-um').prop('checked', false);
                $('#ck-retencao-dois').prop('checked', false);

                $('#confirmacao-frases').hide(400);
                $('#alert-sucesso-campanha').hide(400);
                $('#alert-sucesso-campanha-editar').hide(400);

                $('#opcao-frases').show(400);
                $('#alert-msg').hide(400);

                $('#frase-divulfacao').val('');
                $('#dt-divulgacao').val('');
                $('#hr-de-divulgacao').val('07:00');
                $('#hr-ate-divulgacao').val('07:00');

                $('#frase-divulfacao').val('');
                $('#dt-divulgacao').val('');
                $('#hr-de-divulgacao').val('07:00');
                $('#hr-ate-divulgacao').val('07:00');

                $('#retencao-frase-um').val('');
                $('#retencao-frase-dois').val('');
                

                $('#preventivo-frase-um').val('');
                $('#preventivo-frase-dois').val('');
                
                incrementHr();
            });

            // Envia os dados dos campos p/ o servidor
            $('#habilitar-frases').click(function(){
                var paramCampanha = {
                    divulgacao:           ($('#ck-divulgacao').prop('checked')) ? 1 : 0,

                    fraseDivulgacao:      ($('#frase-divulfacao').val() != '') ? $('#frase-divulfacao').val() : 0,
                    dtDivulgacao:         ($('#dt-divulgacao').val() != '') ? $('#dt-divulgacao').val() : 0,
                    deDivulgacao:         ($('#hr-de-divulgacao')).val(),
                    ateDivulgacao:        ($('#hr-ate-divulgacao')).val(),

                    preventivo:           ($('#ck-preventivo').prop('checked')) ? 1 : 0,

                    UmdiaPreventivo:      ($('#ck-preventivo-um').prop('checked')) ? 1 : 0,
                    fraseUmPreventivo:    ($('#preventivo-frase-um').val() != '') ? $('#preventivo-frase-um').val() : 0,
                    deUmPreventivo:       $('#hr-de-um-preventivo').val(),
                    ateUmPreventivo:      $('#hr-ate-um-preventivo').val(),

                    DoisDiaPreventivo:    ($('#ck-preventivo-dois').prop('checked')) ? 1 : 0,
                    fraseDoisPreventivo:  ($('#preventivo-frase-dois').val() != '') ? $('#preventivo-frase-dois').val() : 0,
                    deDoisPreventivo:     $('#hr-de-dois-preventivo').val(),
                    ateDoisPreventivo:    $('#hr-ate-dois-preventivo').val(),

                    retencao:             ($('#ck-retencao').prop('checked')) ? 1 : 0,

                    UmdiaRetencao:        ($('#ck-retencao-um').prop('checked')) ? 1 : 0,
                    fraseUmRetencao:      ($('#retencao-frase-um').val() != '') ? $('#retencao-frase-um').val() : 0,
                    deUmRetencao:         $('#hr-de-um-retencao').val(),
                    ateUmRetencao:        $('#hr-ate-um-retencao').val(),

                    DoisDiaRetencao:      ($('#ck-retencao-dois').prop('checked')) ? 1 :0,
                    fraseDoisRetencao:    ($('#retencao-frase-dois').val()) ? $('#retencao-frase-dois').val() : 0,
                    deDoisRetencao:       $('#hr-de-dois-retencao').val(),
                    ateDoisRetencao:      $('#hr-ate-dois-retencao').val()
                };

                $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    url: '../controller/controller.php',
                    async: true,
                    data: {
                            idCampanha: idCampanha,
                            paramCampanha: paramCampanha,
                            arquivo: 'admin/admin.php', type: 'setDetalheCampanha',
                          },
                    beforeSend: function() {
                        $('#alert-erro-campanha').hide(400);
                        $('#confirmacao-frases').hide(400);
                        $('#load-habilitar').show(400);
                    },
                    success: function(result, status, request) {
                        var res      = JSON.parse(request.responseText);
                        $('#alert-sucesso-campanha').show(400);
                        $('#confirmacao-frases').hide(400);
                        getCampanha();
                    },
                    error: function(request, status, erro) {
                        $('#alert-erro-campanha').show(400);
                        $('#alert-erro-campanha-conteudo').html('Ocorreu o seguinte erro: ' + request.responseText);
                        $('#confirmacao-frases').show(400);
                    },
                    complete: function() {
                        $('#load-habilitar').hide(400);
                    }
                });

            });

            $('#editar-frases').click(function(){
                var paramCampanha = {
                    divulgacao:           ($('#ck-divulgacao').prop('checked')) ? 1 : 0,

                    fraseDivulgacao:      ($('#frase-divulfacao').val() != '') ? $('#frase-divulfacao').val() : 0,
                    dtDivulgacao:         ($('#dt-divulgacao').val() != '') ? $('#dt-divulgacao').val() : 0,
                    deDivulgacao:         ($('#hr-de-divulgacao')).val(),
                    ateDivulgacao:        ($('#hr-ate-divulgacao')).val(),

                    preventivo:           ($('#ck-preventivo').prop('checked')) ? 1 : 0,

                    UmdiaPreventivo:      ($('#ck-preventivo-um').prop('checked')) ? 1 : 0,
                    fraseUmPreventivo:    ($('#preventivo-frase-um').val() != '') ? $('#preventivo-frase-um').val() : 0,
                    deUmPreventivo:       $('#hr-de-um-preventivo').val(),
                    ateUmPreventivo:      $('#hr-ate-um-preventivo').val(),

                    DoisDiaPreventivo:    ($('#ck-preventivo-dois').prop('checked')) ? 1 : 0,
                    fraseDoisPreventivo:  ($('#preventivo-frase-dois').val() != '') ? $('#preventivo-frase-dois').val() : 0,
                    deDoisPreventivo:     $('#hr-de-dois-preventivo').val(),
                    ateDoisPreventivo:    $('#hr-ate-dois-preventivo').val(),

                    retencao:             ($('#ck-retencao').prop('checked')) ? 1 : 0,

                    UmdiaRetencao:        ($('#ck-retencao-um').prop('checked')) ? 1 : 0,
                    fraseUmRetencao:      ($('#retencao-frase-um').val() != '') ? $('#retencao-frase-um').val() : 0,
                    deUmRetencao:         $('#hr-de-um-retencao').val(),
                    ateUmRetencao:        $('#hr-ate-um-retencao').val(),

                    DoisDiaRetencao:      ($('#ck-retencao-dois').prop('checked')) ? 1 :0,
                    fraseDoisRetencao:    ($('#retencao-frase-dois').val()) ? $('#retencao-frase-dois').val() : 0,
                    deDoisRetencao:       $('#hr-de-dois-retencao').val(),
                    ateDoisRetencao:      $('#hr-ate-dois-retencao').val()
                };

                $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    url: '../controller/controller.php',
                    async: true,
                    data: {
                            idCampanha: idCampanha,
                            paramCampanha: paramCampanha,
                            arquivo: 'admin/admin.php', type: 'upDateDetalheCampanha',
                          },
                    beforeSend: function() {
                        $('#alert-erro-campanha').hide(400);
                        $('#confirmacao-frases').hide(400);
                        $('#load-habilitar').show(400);
                    },
                    success: function(result, status, request) {
                        var res      = JSON.parse(request.responseText);
                        $('#alert-sucesso-campanha-editar').show(400);
                        $('#confirmacao-frases').hide(400);
                        getCampanha();
                    },
                    error: function(request, status, erro) {
                        $('#alert-erro-campanha').show(400);
                        $('#alert-erro-campanha-conteudo').html('Ocorreu o seguinte erro: ' + request.responseText);
                        $('#confirmacao-frases').show(400);
                    },
                    complete: function() {
                        $('#load-habilitar').hide(400);
                    }
                });                

            });

            // Botão p/ desabilitar campanha
            $('#bt-desabilita-campanha').click(function(){
                $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    url: '../controller/controller.php',
                    async: true,
                    data: {
                            idCampanha: idCampanha,
                            arquivo: 'admin/admin.php', type: 'desabilitaCampanha',
                          },
                    beforeSend: function() {
                        $('#confirmacao-desabilita').hide(400);
                        $('#load-desabilitar').show(400);
                    },
                    success: function(result, status, request) {
                        var res      = JSON.parse(request.responseText);
                        $('#alert-sucesso-desabilitar').show(400);
                        
                        getCampanha();
                    },
                    error: function(request, status, erro) {
                        $('#alert-erro-campanha-desabilita').show(400);
                        $('#alert-erro-campanha-conteudo-desabilita').html('Ocorreu o seguinte erro: ' + request.responseText);
                        $('#confirmacao-desabilita').show(400);
                    },
                    complete: function() {
                        $('#load-desabilitar').hide(400);
                    }
                });
            });

            // Botão p/ excluir campanha
            $('#bt-excluir-campanha').click(function(){
                $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    url: '../controller/controller.php',
                    async: true,
                    data: {
                            idCampanha: idCampanha,
                            arquivo: 'admin/admin.php', type: 'excluirCampanha',
                          },
                    beforeSend: function() {
                        $('#confirmacao-excluir').hide(400);
                        $('#load-excluir').show(400);
                    },
                    success: function(result, status, request) {
                        var res      = JSON.parse(request.responseText);
                        $('#alert-sucesso-excluir').show(400);
                        
                        getCampanha();
                    },
                    error: function(request, status, erro) {
                        $('#alert-erro-campanha-excluir').show(400);
                        $('#alert-erro-campanha-conteudo-excluir').html('Ocorreu o seguinte erro: ' + request.responseText);
                        $('#confirmacao-excluir').show(400);
                    },
                    complete: function() {
                        $('#load-excluir').hide(400);
                    }
                });
            });

            // Clique no botão FAZER UPLOAD bt-upload
            $('#bt-upload').click(function() {
                
                var nomeCampanha    = $('#nome-campanha').val();
                var file            = $('#import1').val();
                var banco           = $('#opcao-banco').val();
                var arrErro         = [];

                if (file == '') arrErro.push('Selecione um arquivo');
                if (nomeCampanha == '') arrErro.push('Campanha sem nome');
                if (banco == 0) arrErro.push('Selecione um Banco')

                if (arrErro.length != 0) {
                    var conteudo = '';
                    for (var i = 0; i < arrErro.length; i++) {
                        conteudo += '<p>- ' + arrErro[i] + '</p>';
                    }
                    $('#msg-consulta').html(conteudo);
                    $('#modal-msg').modal('show');
                } else {
                    /* Efetua o Upload sem dar refresh na pagina */
                    $('#formulario').ajaxForm({
                        url: '../controller/controller.php',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                                arquivo: 'importFile/importFile.php',
                                campanha: nomeCampanha,
                                banco : banco
                              },
                        beforeSend: function() {
                            $('#modal-load').modal({backdrop: "static"});
                            $('#alert-ok').hide(100);
                            $('#alert-erro').hide(1000);
                        },
                        //target:'#visualizar', // o callback será no elemento com o id #visualizar
                        success: function(response) {
                            // Alerta de inclusão de linha
                            $('#linhas-file').html(response.linhas);
                            $('#alert-ok').show(1000);
                            getCampanha();
                        },
                        error: function(erro) {
                            // Alerta de erro
                            $('#erro-file').html(erro.responseText);
                            $('#alert-erro').show(1000);
                        },
                        complete: function() {
                            $('#modal-load').modal('hide');
                        }
                    }).submit();
                }

            });

            /*
             * Função para incrementar na tabela table-relatorio-acesso a 
             * quantidade de acessos que o sistema teve separado por ano / mês.
            */
            function setTableTelatorioAcesso()
            {
                $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    url: '../controller/controller.php',
                    async: true,
                    data: {
                            arquivo: 'admin/admin.php', type: 'userAcesso'
                          },
                    beforeSend: function() {
                        $('#load-table-acesso').show(400);
                    },
                    success: function(result, status, request) {
                        result = obj(result);
                        
                        if (result[0] != 'vazio') {
                            var conteudo = '';
                            var dt       = '';
                            for (var i = 0; i < result.length; i++) {
                                dt = result[i].DT_ACESSO;
                                conteudo += "<tr style='cursor: pointer;' onclick='getAcessoMes(\""+ dt.substr(0, 7) +"\")'>" +
                                                '<td>' +
                                                    dt.substr(0, 7) +
                                                '</td>' +
                                                "<td>" +
                                                    result[i].total +
                                                '</td>' +
                                            "</tr>";
                            }
                            $('#table-relatorio-acesso').html(conteudo);
                        } else {
                            $('#table-relatorio-acesso').html('Sem registro');
                        }
                        
                    },
                    error: function(request, status, erro) {
                        $('#modal-erro').modal('show');
                        $('#modal-erro-conteudo').html('Ocorreu o seguinte erro: ' + request.responseText);
                    },
                    complete: function() {
                        $('#load-table-acesso').hide(400);
                    }
                });
            }
            setTableTelatorioAcesso();

        });
    </script>
    
    <!-- Excel -->
    <script type='text/javascript' src="../js/jquery.btechco.excelexport.js"></script>
    <script type='text/javascript' src="../js/jquery.base64.js"></script>

</body>

</html>
