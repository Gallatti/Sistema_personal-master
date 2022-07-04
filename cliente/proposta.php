<?php 

    session_start();

    if(isset($_SESSION['cpf_cnpj_personal']) == '')
    {
        header('Location: ../index.php');
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

    <nav id="mainNav" class="navbar navbar-inverse navbar-fixed-top">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" style="background: #EFFBFB;">
                    <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand page-scroll" href="#page-top">Microeasy</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a class="page-scroll" href="#about">Validar</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#services">Meus Dados</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#proposta">Proposta</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#contact">Contato</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="../logout.php">Sair</a>
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
                <h1 id="homeHeading">VALIDAR CÓDIGO</h1>
                <hr>
                <p>Aguarde o SMS com o código de validação</p>
                <a href="#about" class="btn btn-primary btn-xl page-scroll" style="background: #00FFFF; color: #000000;">Validar</a>
            </div>
        </div>
    </header>

    <section class="bg-primary" id="about"  style="background: #00FFFF; color: #000000;">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <h2 class="section-heading">Para abrir as propostas digite o código enviado por SMS no ceu celular</h2>
                    <hr class="light">
                    <form class="form-inline">
                      <div class="form-group">
                        <label for="email">Código</label>
                        <input type="text" class="form-control" id="campo-cod" onkeyup="upperCase(this)" maxlength="5" placeholder="10KM1">
                      </div>
                      <button type="button" id="bt-valida-cod" class="btn btn-default">Validar</button>
                    </form>
                    <hr>
                    
                    <a href="../#about" class="btn btn-default btn-xl page-scroll" style="color: #000000;">Reenviar SMS</a>
                </div>
            </div>
        </div>
    </section>

    <section id="services">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Meus Dados</h2>
                    <hr class="primary">
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="form-group">
                    <label>Nome: <? echo $_SESSION['dados_cli_completo']->NOME_RAZAO_SOCIAL ?></label>
                </div>
                <div class="form-group">
                    <label>CPF/CNPJ: <? echo $_SESSION['dados_cli_completo']->CPF_CNPJ ?></label>
                </div>
                <div class="form-group">
                    <label>Endereço: <? echo $_SESSION['dados_cli_completo']->ENDERECO ?></label>
                </div>
                <div class="form-group">
                    <label>Cidade: <? echo $_SESSION['dados_cli_completo']->CIDADE ?>, UF: <? echo $_SESSION['dados_cli_completo']->UF ?></label>
                </div>
            </div>
        </div>
    </section>

    <section class="no-padding" id="proposta">
        <div class="container-fluid">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h2 class="section-heading">Proposta</h2>
                        <hr class="primary">
                        <h2 class="section-heading">Lista de Contratos Abordados Pela Proposta</h2>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>Número Contrato</th>
                  </tr>
                </thead>
                <tbody id="table-numero-contrato">

                </tbody>
              </table>
            </div>

            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        
                        <hr class="primary">
                        <h2 class="section-heading">Tabela de Propostas</h2>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>Opção</th>
                    <th>Tipo</th>
                    <th>Entrada</th>
                    <th>Qtd. Parcelas</th>
                    <th>Val. Parcela</th>
                  </tr>
                </thead>
                <tbody id="table-propostas">
                </tbody>
              </table>
            </div>
            <div id="area-proposta" style="display: none;">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 text-center">
                            <hr class="primary">
                            <h2 class="section-heading">Escolha a sua proposta</h2>
                            <form class="form-inline">
                                <label>Opções</label>
                                <select class="form-control" id="opcao-prosta">
                                    
                                </select>
                              <button type="button" id="bt-proposta-opcao" class="btn">Gerar Boleto</button>
                            </form>
                        </div>
                    </div>
                </div>
                <hr class="primary">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 text-center">
                            <h2 class="section-heading">Caso nenhuma das opções acima esteja dentro de suas possibilidades, faça sua proposta.</h2>
                            <form class="form-horizontal">
                                <div class="form-group">
                                  <label class="control-label col-sm-6" for="vl-entrada">Entrada:</label>
                                  <div class="col-sm-3">
                                    <input type="text" class="form-control" id="vl-entrada" onkeyup="formataValorCampo('vl-entrada');" placeholder="0,00" maxlength="12">
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="control-label col-sm-6" for="qt-parcela">Qtde. Parcela</label>
                                  <div class="col-sm-3">
                                    <input type="text" class="form-control" id="qt-parcela" onkeypress='return SomenteNumero(event)' placeholder="0">
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="control-label col-sm-6" for="vl-parcela">Vl. Parcela</label>
                                  <div class="col-sm-3">
                                    <input type="text" class="form-control" id="vl-parcela" onkeyup="formataValorCampo('vl-parcela');" placeholder="0,00" maxlength="12">
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="control-label col-sm-6" for="dt-pagamento">Dt. Pagamento</label>
                                  <div class="col-sm-3">
                                    <input type="text" class="form-control" id="dt-pagamento" placeholder="dd/mm/aaaa">
                                  </div>
                                </div>
                                <div class="form-group">
                                  <div class="col-sm-offset-4 col-sm-7">
                                    <button type="button" class="btn" id="bt-sua-proposta">ENVIAR A SUA PROPOSTA</button>
                                  </div>
                                </div>
                              </form>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </section>

    <aside class="bg-dark">
        <div class="container text-center">
            <div class="call-to-action">
                <h2>Personalcob & Microeasy</h2>
            </div>
        </div>
    </aside>

    <section id="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <h2 class="section-heading">Contato</h2>
                    <hr class="primary">
                    
                </div>
                <div class="col-lg-4 col-lg-offset-2 text-center">
                    <i class="fa fa-phone fa-3x sr-contact"></i>
                    <p>(11) 3566 3500</p>
                </div>
                <div class="col-lg-4 text-center">
                    <i class="fa fa-envelope-o fa-3x sr-contact"></i>
                    <p><a>sac@personalcob.com.br/a></p>
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

    <!-- Helpers -->
    <script src="../js/mask.js"></script>

    <!-- Helpers -->
    <script src="../js/helpers.js?v=1.0.37"></script>


    <!-- Modal -->
    <div class="modal fade" id="modal-envio" role="dialog" data-backdrop="static">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Aguarde...</h4>
            </div>
            <div class="modal-body">
              <center><img src="../img/loading.gif" class="img-responsive"></center>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modal-erro" role="dialog" data-backdrop="static">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Mensagem!</h4>
            </div>
            <div class="modal-body">
              <span id="modal-conteudo-erro"></span>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal Cep -->
    <div class="modal fade" id="modal-cep" role="dialog" data-backdrop="static">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Confirmação de Endereço</h4>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-2 col-lg-offset-0">
                            <div class="form-group">
                                <label for="cep">Digite seu CEP</label>
                                <input type="text" class="form-control" id="cep" placeholder="CEP">
                            </div>
                        </div>
                        
                    </div>
                    <div class="row"  style="display: none;" id="alert-cep">
                        <div class="col-lg-3 col-lg-offset-0">
                            <div class="form-group">
                                <div class="alert alert-warning">
                                    Cep não encontrado!
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row"  style="display: none;" id="alert-cep-campo">
                        <div class="col-lg-3 col-lg-offset-0">
                            <div class="form-group">
                                <div class="alert alert-info">
                                    <span id="alert-cep-campo-conteudo"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="campos-logradouro" style="display: none;">
                        <div class="row">
                            <div class="col-lg-3 col-lg-offset-0">
                                <div class="form-group">
                                    <label for="logradouro">Logradouro</label>
                                    <input type="text" class="form-control" id="logradouro" placeholder="" disabled>
                                </div>
                            </div>
                            <div class="col-lg-1 col-lg-offset-0">
                                <div class="form-group">
                                    <label for="numero">Número</label>
                                    <input type="text" class="form-control" id="numero" placeholder="" maxlength="5">
                                </div>
                            </div>
                            <div class="col-lg-3 col-lg-offset-0">
                                <div class="form-group">
                                    <label for="complemento">Complemento</label>
                                    <input type="text" class="form-control" id="complemento" placeholder="" maxlength="50">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-lg-offset-0">
                                <div class="form-group">
                                    <label for="bairro">Bairro</label>
                                    <input type="text" class="form-control" id="bairro" placeholder="" disabled>
                                </div>
                            </div>
                            <div class="col-lg-3 col-lg-offset-0">
                                <div class="form-group">
                                    <label for="cidade">Cidade</label>
                                    <input type="text" class="form-control" id="cidade" placeholder="" disabled>
                                </div>
                            </div>
                            <div class="col-lg-1 col-lg-offset-0">
                                <div class="form-group">
                                    <label for="uf">UF</label>
                                    <input type="text" class="form-control" id="uf" placeholder="" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" id="load-cep" style="display: none;">
                        <div class="col-lg-1 col-lg-offset-0">
                            <center><img src="../img/loading.gif" class="img-responsive"></center>
                        </div>
                    </div>
                    <div class="row" id="msg-erro-cep" style="display: none;">
                        <div class="col-lg-4 col-lg-offset-0">
                            <div class="alert alert-warning alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                Cep não encontrado!
                            </div>
                        </div>
                    </div>
                </div>
                <br>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" style="background: #00FFFF; display: none;" id="gera-boleto">Gerar Boleto</button>
              <button type="button" class="btn btn-default" style="background: #00FFFF;" data-dismiss="modal">Fechar</button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modal-msg" role="dialog" style="color: #000000;">
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
    <div class="modal fade" id="modal-load" role="dialog" style="color: #000000;">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <div class="modal-header">
              
              <h4 class="modal-title" style="color: #000000;">Consultando...</h4>
            </div>
            <div class="modal-body">
              <center><img src="../img/loading.gif" class="img-responsive" alt="Consultando..."></center>
            </div>
            
          </div>
        </div>
      </div>
    </div>

    <!-- Modal -->
  <div class="modal fade" id="model-boleto" role="dialog" style="color: #000000;">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Boleto</h4>
        </div>
        <div class="modal-body">
          <div>
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <td id="body-boleto">
                                
                            </td>
                        </tr>
                    </table>
                </div>
          </div>
          <div id="email-boleto" style="display: block; color: #000000;">
                <label>Digite o e-mail que deseja receber o boleto</label>
                <input type="text" class="form-control" id="txt-boleto" maxlength="50">
                <br>
                <div class="alert alert-info" id="alert-info-boleto" style="display: none;">
                  <strong>Mensagem!</strong> <span id="info-boleto-email"></span>
                </div>
                <div class="alert alert-danger" id="alert-erro-boleto" style="display: none;">
                  <strong>Erro!</strong> <span id="erro-boleto-email"></span>
                </div>
                <div class="alert alert-success" id="alert-sucesso-boleto" style="display: none;">
                  <strong>Mensagem!</strong> <span id="sucesso-boleto-email"></span>
                </div>
                <button type="button" style="background: #00FFFF;" id="bt-boleto-email" class="btn btn-default">Enviar</button> <button type="button" style="background: #00FFFF;" id="voltar-boleto" class="btn btn-default">Boleto</button>
          </div>
          <div id="sms-linha-digitavel" style="display: none;">
                <label>Confirma receber a linha digitavel referente aos contratos?</label>
                <br>
                <label><span id="n-contratos"> </span></label>
                <br>
                <div class="alert alert-success" id="alert-sucesso-sms" style="display: none; color: #000000;">
                  <strong>Mensagem!</strong> SMS enviado com sucesso para o seu celular!
                </div>
                <button type="button" style="background: #00FFFF;" id="enviar-sms" class="btn btn-default">Sim</button> <button type="button" style="background: #00FFFF;" id="nao-enviar-sms" class="btn btn-default">Não</button>
          </div>
          <div id="load-envio-email" style="display: none;">
              <center><img src="../img/loading.gif" class="img-responsive"></center>
          </div>
        </div>
        <div class="modal-footer">
           <button type="button" style="background: #00FFFF;" id="bt-boleto-sms" class="btn btn-default">Enviar linha digitável por SMS</button> <button type="button" style="background: #00FFFF;" id="bt-email" class="btn btn-default">Enviar por e-mail</button> <button type="button" class="btn btn-default" style="background: #00FFFF;" data-dismiss="modal">Fechar</button>
        </div>
      </div>
    </div>
  </div>

    <script type="text/javascript">
    var hboleto = '';

    $(document).ready(function(){
        $('#bt-valida-cod').click(function(){
            var codigo = $('#campo-cod').val();

            if (codigo == '') {
                $("#modal-msg").modal('show');
                $('#msg-consulta').html('Preencha o campo Código!');
            } 
            else if (codigo.length < 5) {
                $("#modal-msg").modal('show');
                $('#msg-consulta').html('Preencha o campo Código corretamente!');
            } else {
                $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    url: '../controller/controller.php',
                    data:   {         
                                codigo: codigo,
                                tipo: 'codigo',
                                arquivo: 'consulta/contrato.php'
                    },
                    beforeSend: function() {
                            $('#modal-load').modal({backdrop: "static"});
                    },
                    success: function(result, status, request) {
                        var res = JSON.parse(request.responseText);
                        console.log(res[1]);
                        if (res[0] == 'invalido') {
                            setTimeout(function(){
                                $('#msg-consulta').html('Código invalido!');
                                $('#modal-msg').modal('show');
                                $('#table-propostas').html('');
                                $('#opcao-prosta').html('');
                                $('#table-numero-contrato').html('');
                                $('#area-proposta').hide();
                            }, 600);    
                        } else {
                            setTimeout(function(){
                                $('#msg-consulta').html('Código valido!');
                                $('#modal-msg').modal('show');
                                preencheTabelaProposta(res[0][0]);
                                preencheTabelaContrato(res[1]);
                                setTimeout(function(){
                                    $('#modal-msg').modal('hide');
                                }, 2000);
                            }, 600);
                        }
                    },
                    error: function(request, status, erro) {
                        setTimeout(function(){
                            $('#msg-consulta').html('Ocorreu o seguinte erro -> ' + request.responseText);
                            $('#modal-msg').modal('show');
                            $('#table-propostas').html('');
                            $('#opcao-prosta').html('');
                            $('#area-proposta').hide();
                        }, 600);
                    },
                    complete: function() {
                        $('#modal-load').modal('hide');
                    }
                });
            }
        });

        function preencheTabelaContrato(arrContrato)
        {
            var conteudo = '';
            var conteudoContrato = '';
            $('#n-contratos').html('');
            for (var i = 0; i < arrContrato.length; i++) {
                conteudo += '<tr>' +
                                '<td>' + arrContrato[i] + '</td>' +
                           '</tr>';
                conteudoContrato += arrContrato[i] + '<br>'; 
            }
            $('#n-contratos').html(conteudoContrato);
            $('#table-numero-contrato').html(conteudo);
        }
        
        $('#bt-email').click(function(){
            $('#body-boleto').hide(600);
            $('#alert-info-boleto').hide(600);
            $('#alert-sucesso-boleto').hide(600);
            $('#alert-erro-boleto').hide(600);
            $('#sms-linha-digitavel').hide(600);
            $('#email-boleto').show(600);
        });

        $('#voltar-boleto').click(function(){
            $('#email-boleto').hide(600);
            $('#alert-info-boleto').hide(600);
            $('#body-boleto').show(600);
        });

        $('#cep').keyup(function(){
            var cepTotal = this.value.replace(/[_-]/g, '').length;
            var cep      = this.value.replace(/[_-]/g, '');
            $('#msg-erro-cep').hide(400);
            if (cepTotal == 8) {
                $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    url: '../controller/controller.php',
                    data:   {
                                cep: cep,
                                arquivo: 'cep/cep.php'
                    },
                    beforeSend: function() {
                        $('#load-cep').show(400);
                        $('#alert-cep').hide(400);
                        $('#campos-logradouro').hide(400);
                        $('#alert-cep-campo').hide(400);
                    },
                    success: function(result, status, request) {
                        console.log(result);
                        if (result.message == 'Endereço não encontrado!') {
                            $('#logradouro').val('');
                            $('#bairro').val('');
                            $('#cidade').val('');
                            $('#uf').val('');
                            $('#alert-cep').show(400);
                            $('#campos-logradouro').hide(400);
                            $('#gera-boleto').hide(400);
                        } else {
                            $('#logradouro').val(result.tipoDeLogradouro + ' ' + result.logradouro);
                            $('#bairro').val(result.bairro);
                            $('#cidade').val(result.cidade);
                            $('#uf').val(result.estado);
                            $('#campos-logradouro').show(400);
                            $('#gera-boleto').show(400);
                        }
                    },
                    error: function(request, status, erro) {
                        $('#modal-cep').modal('hide');
                        setTimeout(function(){
                            $('#modal-conteudo-erro').html('Ocorreu o seguinte erro -> ' + request.responseText);
                            $('#modal-erro').modal('show');
                        }, 600);
                    },
                    complete: function() {
                        $('#load-cep').hide(400);
                    }
                });
            }
        });

        $('#cep').mask('99999-999');

        $('#bt-boleto-email').click(function(){
            var email = $('#txt-boleto').val();
            var valorOpcao = $('#opcao-prosta').val();

            $('#alert-info-boleto').hide(600);
            $('#alert-erro-boleto').hide(600);
            $('#alert-sucesso-boleto').hide(600);

            if (email == '') {
                $('#info-boleto-email').html('Digite um e-mail antes de enviar');
                $('#alert-info-boleto').show(600);
            } else if (!is_email(email)) {
                $('#info-boleto-email').html('Digite um e-mail valido antes de enviar!');
                $('#alert-info-boleto').show(600);
            } else {
                $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    url: '../controller/controller.php',
                    data:   {   
                                valorOpcao: valorOpcao,
                                bodyEmail: hboleto,      
                                email: email,
                                tipo: 'enviarEmail',
                                arquivo: 'boleto/geraBoleto.php'
                    },
                    beforeSend: function() {
                        $('#bt-boleto-email').hide(200);
                        $('#voltar-boleto').hide(200);
                        $('#load-envio-email').show(600);  
                    },
                    success: function(result, status, request) {
                        var res = JSON.parse(request.responseText);
                        if (res == 'ok') {
                            $('#sucesso-boleto-email').html('Boleto enviado com sucesso para o e-mail acima!');
                            $('#alert-sucesso-boleto').show(600);
                        }
                    },
                    error: function(request, status, erro) {
                        $('#erro-boleto-email').html('Ocorreu o seguinte erro -> ' + request.responseText)
                        $('#alert-erro-boleto').show(600);
                    },
                    complete: function() {
                        $('#bt-boleto-email').show(200);
                        $('#voltar-boleto').show(200);
                        $('#load-envio-email').hide(600);  
                    }
                });
            }
        });
        
        $('#bt-proposta-opcao-old').click(function(){
            $('#gera-boleto').hide();
            $('#alert-cep').hide();
            $('#campos-logradouro').hide();
            $('#campos-logradouro').hide();
            $('#alert-cep-campo').hide();
            $('#modal-cep').modal('show');
            $('#cep').val('');
            $('#numero').val('');
        });

        $('#gera-boleto').click(function(){
            var cep         = $('#cep').val().replace(/[-]/g, '');
            var logradouro  = $('#logradouro').val();
            var numero      = $('#numero').val();
            var bairro      = $('#bairro').val();
            var cidade      = $('#cidade').val();
            var uf          = $('#uf').val();
            var complemento = $('#complemento').val();
            var valorOpcao  = $('#opcao-prosta').val();

            var erroCep = [];
            if (cep.length != 8) erroCep.push('Cep');
            if (logradouro == '') erroCep.push('Logradouro');
            if (numero == '') erroCep.push('Número');
            if (bairro == '') erroCep.push('Bairro');
            if (cidade == '') erroCep.push('Cidade');
            if (uf == '') erroCep.push('UF');

            if (erroCep.length != 0) {
                var conteudo = 'Preencha os campos:';
                for (var i = 0; i < erroCep.length; i++) {
                    conteudo += '<br>- ' + erroCep[i];
                }
                $('#alert-cep-campo-conteudo').html(conteudo);
                $('#alert-cep-campo').show(400);
            } else {
                $('#alert-cep-campo').hide(400);
                $.ajax({
                    type: 'POST',
                    url: "../controller/controller.php",
                    dataType: "json",
                    data: {
                        cep: cep,
                        logradouro: logradouro,
                        numero: numero,
                        bairro: bairro,
                        cidade: cidade,
                        uf: uf,
                        complemento: complemento,
                        valorOpcao: valorOpcao,
                        tipo: 'setBoletoInfo',
                        arquivo: 'consulta/contrato.php'
                    },
                    beforeSend: function() {
                        $('#load-cep').show(400);
                    },
                    success: function(response) {
                        if (response[0] == 'ok') {
                            $('#modal-cep').modal('hide');
                            setTimeout(function(){
                                getPropostaPorOpcao();
                            }, 600);
                        }
                    },
                    error: function(request, status, erro) {
                        $('#alert-cep-campo').show(400);
                        $('#alert-cep-campo-conteudo').html('Ocorreu o seguinte erro -> ' + request.responseText);
                    },
                    complete: function() {
                        $('#load-cep').hide(400);
                    }

                });
            }
        });

        function getPropostaPorOpcao()
        {
            var valorOpcao = $('#opcao-prosta').val();
            $( "#bt-boleto-sms" ).prop( "disabled", false );
            $('#bt-boleto-sms').html('ENVIAR LINHA DIGITÁVEL POR SMS');
            $.ajax({
                 "url": "../controller/controller.php",
                 "dataType": "html",
                 "data": {
                    "valorOpcao": valorOpcao,
                    tipo: 'boleto1',
                    arquivo: 'boleto/geraBoleto.php'
                 },
                beforeSend: function() {
                    $('#modal-load').modal({backdrop: "static"});
                    $('#email-boleto').hide();
                    $('#sms-linha-digitavel').hide()
                    $('#alert-info-boleto').hide(600);
                    $('#body-boleto').show();
                },
                 "success": function(response) {
                    //em caso de sucesso, a div ID=saida recebe o response do post
                    setTimeout(function(){
                        $("#body-boleto").html(response);
                        //$('#model-boleto').modal('show');
                        $('#model-boleto').modal({backdrop: "static"});
                        hboleto = response;
                    }, 600);
                 },
                error: function(request, status, erro) {
                    setTimeout(function(){
                        $('#msg-consulta').html('Ocorreu o seguinte erro -> ' + request.responseText);
                        $('#modal-msg').modal('show');
                    }, 600);
                },
                complete: function() {
                    $('#modal-load').modal('hide');
                }

            });
        }

        $('#bt-boleto-sms').click(function(){
            $('#sms-linha-digitavel').show(600);
            $('#body-boleto').hide(600);
            $('#email-boleto').hide(600);
        });

        $('#enviar-sms').click(function(){
            var valorOpcao = $('#opcao-prosta').val();

            $.ajax({
                url: "../controller/controller.php",
                dataType: "json",
                data: {
                    valorOpcao: valorOpcao,
                    tipo: 'enviarLinhaDigitavelSms',
                    arquivo: 'boleto/geraBoleto.php'
                },
                beforeSend: function() {
                    $('#load-envio-email').show(400);
                },
                success: function(response) {
                    //em caso de sucesso, a div ID=saida recebe o response do post
                    //$('#alert-sucesso-sms').show(400);
                    $('#bt-boleto-sms').prop('disabled', true);
                    $('#bt-boleto-sms').html('SMS ENVIADO COM SUCESSO!');
                    $('#sms-linha-digitavel').hide(400);
                    $('#body-boleto').show(600);
                 },
                error: function(request, status, erro) {
                    alert('Ocorreu o seguinte erro -> ' + request.responseText);
                },
                complete: function() {
                    $('#load-envio-email').hide(400);
                }

            });
        });

        $('#nao-enviar-sms').click(function(){
            $('#sms-linha-digitavel').hide(400);
            $('#body-boleto').show(600);
        });

        $('#bt-proposta-opcao').click(function(){
            var valorOpcao = $('#opcao-prosta').val();
            $( "#bt-boleto-sms" ).prop( "disabled", false );
            $('#bt-boleto-sms').html('ENVIAR LINHA DIGITÁVEL POR SMS');
            $.ajax({
                 "url": "../controller/controller.php",
                 "dataType": "html",
                 "data": {
                    "valorOpcao": valorOpcao,
                    tipo: 'boleto1',
                    arquivo: 'boleto/geraBoleto.php'
                 },
                beforeSend: function() {
                    $('#modal-load').modal({backdrop: "static"});
                    $('#email-boleto').hide();
                    $('#sms-linha-digitavel').hide()
                    $('#alert-info-boleto').hide(600);
                    $('#body-boleto').show();
                },
                 "success": function(response) {
                    //em caso de sucesso, a div ID=saida recebe o response do post
                    setTimeout(function(){
                        $("#body-boleto").html(response);
                        //$('#model-boleto').modal('show');
                        $('#model-boleto').modal({backdrop: "static"});
                        hboleto = response;
                    }, 600);
                 },
                error: function(request, status, erro) {
                    setTimeout(function(){
                        $('#msg-consulta').html('Ocorreu o seguinte erro -> ' + request.responseText);
                        $('#modal-msg').modal('show');
                    }, 600);
                },
                complete: function() {
                    $('#modal-load').modal('hide');
                }

              });

            //$("#body-boleto").load("../class/boleto/boleto/testesantander.php");
        });

        $('#bt-proposta-opcao-old-2').click(function(){
            var valorOpcao = $('#opcao-prosta').val();

            $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    url: '../controller/controller.php',
                    data:   {         
                                opcaoProposta: valorOpcao,
                                tipo: 'boleto1',
                                arquivo: 'boleto/geraBoleto.php'
                    },
                    beforeSend: function() {
                            $('#modal-load').modal({backdrop: "static"});
                    },
                    success: function(result, status, request) {
                        var res = JSON.parse(request.responseText);
                        setTimeout(function(){
                            $('#msg-consulta').html('A opção escolhida foi enviada para a Personalcob');
                            $('#modal-msg').modal('show');
                            $('#table-propostas').html('');
                            $('#opcao-prosta').html('');
                            $('#area-proposta').hide();
                            $('#campo-cod').val('');
                        }, 600);
                    },
                    error: function(request, status, erro) {
                        setTimeout(function(){
                            $('#msg-consulta').html('Ocorreu o seguinte erro -> ' + request.responseText);
                            $('#modal-msg').modal('show');
                        }, 600);
                    },
                    complete: function() {
                        $('#modal-load').modal('hide');
                    }
                });
        });

        $('#bt-sua-proposta').click(function(){
            var entrada     = $('#vl-entrada').val();
            var qtParcela   = $('#qt-parcela').val();
            var vlParcela   = $('#vl-parcela').val();
            var dtPagamento = $('#dt-pagamento').val();

            if (entrada == '' || dtPagamento == '' || vlParcela == '' || dtPagamento == '') {
                $('#modal-envio').modal('hide');
                $("#modal-msg").modal('show');
                $('#msg-consulta').html('Preencha todos os campos antes de enviar a sua proposta!');
            } else {
                $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    url: '../controller/controller.php',
                    data:   {         
                                entrada: entrada,
                                qtParcela: qtParcela,
                                vlParcela: vlParcela,
                                dtPagamento: dtPagamento,
                                tipo: 'propostaCliente',
                                arquivo: 'email/email.php'
                    },
                    beforeSend: function() {
                            $('#modal-load').modal({backdrop: "static"});
                    },
                    success: function(result, status, request) {
                        var res = JSON.parse(request.responseText);
                        if (res == 'ok')
                        {
                            setTimeout(function(){
                                $('#msg-consulta').html('Sua proposta foi encaminhada para o banco e sendo ou não aprovada você vai receber um sms informando.');
                                $('#modal-msg').modal('show');
                                $('#vl-entrada').val('');
                                $('#qt-parcela').val('');
                                $('#vl-parcela').val('');
                                $('#dt-pagamento').val('');
                                $('#table-propostas').html('');
                                $('#campo-cod').val('');
                                $('#area-proposta').hide();
                                $('#opcao-prosta').html('');
                            }, 600);
                        } else {
                            setTimeout(function(){
                                $('#msg-consulta').html('Ocorreu o seguinte erro -> ' + res);
                                $('#modal-msg').modal('show');
                            }, 600);
                        }
                        
                    },
                    error: function(request, status, erro) {
                        setTimeout(function(){
                            $('#msg-consulta').html('Ocorreu o seguinte erro -> ' + request.responseText);
                            $('#modal-msg').modal('show');
                        }, 600);
                    },
                    complete: function() {
                        $('#modal-load').modal('hide');
                    }
                });                    
            }
        });

    });

    function is_email(email)
    {
        er = /^[a-zA-Z0-9][a-zA-Z0-9\._-]+@([a-zA-Z0-9\._-]+\.)[a-zA-Z-0-9]{2,3}/; 
        if( er.exec(email) ) {
            return true;
        }
        return false;
    }

    function preencheTabelaProposta(proposta)
    {
        window.location.href='#proposta';

        var conteudoTable = '';
        var conteudoOpcao = '';

        console.log('cross here!');

        if (proposta.TIPO_PROPOSTA1 != null) {
            conteudoTable +=  '<tr>' +
                                      '<td>' + 1 + '</td>' +
                                      '<td>' + proposta.TIPO_PROPOSTA1 + '</td>' +
                                      '<td>' + proposta.VALOR_ENTREGA_PROPOSTA1 + '</td>' +
                                      '<td>' + proposta.QTDE_PARCELAS_PROPOSTA1 + '</td>' +
                                      '<td>' + proposta.VALOR_PARCELAS_PROPOSTA1 + '</td>' +
                                      
                                  '</tr>';

            conteudoOpcao += "<option value='" + 1 + "'>" +
                                  + 1 +
                             '</option>';
        }

        if (proposta.TIPO_PROPOSTA2 != null) {
            conteudoTable +=  '<tr>' +
                                  '<td>' + 2 + '</td>' +
                                  '<td>' + proposta.TIPO_PROPOSTA2 +  '</td>' +
                                  '<td>' + proposta.VALOR_ENTRADA_PROPOSTA2 + '</td>' +
                                  '<td>' + proposta.QTDE_PARCELAS_PROPOSTA2 + '</td>' +
                                  '<td>' + proposta.VALOR_PARCELAS_PROPOSTA2 + '</td>' +
                                  
                              '</tr>';

            conteudoOpcao += "<option value='" + 2 + "'>" +
                                  + 2 +
                             '</option>';
        }

        if (proposta.TIPO_PROPOSTA3 != null) {
            conteudoTable +=  '<tr>' +
                                  '<td>' + 3 + '</td>' +
                                  '<td>' + proposta.TIPO_PROPOSTA3 +  '</td>' +
                                  '<td>' + proposta.VALOR_ENTRADA_PROPOSTA3 + '</td>' +
                                  '<td>' + proposta.QTDE_PARCELAS_PROPOSTA3 + '</td>' +
                                  '<td>' + proposta.VALOR_PARCELAS_PROPOSTA3 + '</td>' +
                                  
                              '</tr>';
            conteudoOpcao += "<option value='" + 3 + "'>" +
                                  + 3 +
                             '</option>';   
        }

        if (proposta.TIPO_PROPOSTA4 != null) {
            conteudoTable +=  '<tr>' +
                                  '<td>' + 4 + '</td>' +
                                  '<td>' + proposta.TIPO_PROPOSTA4 +  '</td>' +
                                  '<td>' + proposta.VALOR_ENTRADA_PROPOSTA4 + '</td>' +
                                  '<td>' + proposta.QTDE_PARCELAS_PROPOSTA4 + '</td>' +
                                  '<td>' + proposta.VALOR_PARCELAS_PROPOSTA4 + '</td>' +
                                  
                              '</tr>';
            conteudoOpcao += "<option value='" + 4 + "'>" +
                                  + 4 +
                             '</option>';
        }

        $('#table-propostas').html(conteudoTable);
        $('#opcao-prosta').html(conteudoOpcao);
        $('#area-proposta').show();
    }

    </script>


</body>

</html>
