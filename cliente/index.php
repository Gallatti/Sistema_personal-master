<?php 

    session_start();
    
    if(isset($_SESSION['cpf_cnpj_personal']) == '')
    {
        header('Location: ../');
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

    <link rel="stylesheet" href="../js/pieprogress/css/asPieProgress.css">

    <style type="text/css">
        .pie_progress {
          width: 160px;
          margin: 10px auto;
        }
        @media all and (max-width: 768px) {
          .pie_progress {
            width: 80%;
            max-width: 300px;
          }
        }
    </style>

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
                <h1 id="homeHeading">Bem-vindo</h1>
                <h3 id="homeHeading"><? echo $_SESSION['nome_cli_cob'] ?></h3>
                <hr>
                <p><h2>Agora vamos validar o número do seu celular!</h2></p>
                <a href="#about" class="btn btn-primary btn-xl page-scroll" style="background: #00FFFF; color: #000000;">Validar</a>
            </div>
        </div>
    </header>

    <section class="bg-primary" id="about"  style="background: #00FFFF; color: #000000;">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <h2 class="section-heading">Para validar preencha o campo abaixo com o número do seu celular</h2>
                    <hr class="light">
                    <form class="form-inline">
                      <div class="form-group">
                        <label for="email">ddd + Número</label>
                        <input type="text" class="form-control" id="campo-cel" onkeyup="somenteNumeros(this);" maxlength="11" placeholder="1190000000">
                      </div>
                      <button type="button" id="bt-validar" class="btn btn-default">Validar</button>
                    </form>
                    <hr>
                    <a href="#services" class="btn btn-default btn-xl page-scroll" style="color: #000000;">MEUS DADOS</a>
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
                    <p><a>sac@personalcob.com.br</a></p>
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
    <script src="../js/helpers.js?v=1.0.13"></script>

    <!-- jquery-asPieProgress-master -->
    <script type="text/javascript" src="../js/pieprogress/jquery-asPieProgress.js"></script>


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
                <div class="pie_progress--countdown" id="pieSec" role="progressbar" style="display: none;">
                    <span class="pie_progress__number">0: 05</span>
                </div>
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
              
              <h4 class="modal-title">Consultando...</h4>
            </div>
            <div class="modal-body">
              <center><img src="../img/loading.gif" class="img-responsive" alt="Consultando..."></center>
            </div>
            
          </div>
        </div>
      </div>
    </div>

    <script type="text/javascript">
    $(document).ready(function(){

        $('#bt-validar').click(function(){
            var celular = $('#campo-cel').val();

            if (celular == '')
            {
                $("#modal-msg").modal('show');
                $('#msg-consulta').html('Preencha o campo ddd + Número!');
            } 
            else if (celular.length < 10)
            {
                $("#modal-msg").modal('show');
                $('#msg-consulta').html('Preencha o campo dd + Número corretamente!');
            } else {
                $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    url: '../controller/controller.php',
                    data:   {         
                                celular: celular,
                                tipo: 'celular',
                                arquivo: 'consulta/contrato.php'
                    },
                    beforeSend: function() {
                            $('#modal-load').modal({backdrop: "static"});
                    },
                    success: function(result, status, request) {
                        var res = JSON.parse(request.responseText);
                        if (res.resposta == 'ok') {
                            setTimeout(function(){
                                $('#msg-consulta').html('Foi enviado um SMS para o seu celular contendo o código de validação das propostas, você será redirecionado para a página de propostas em:');
                                $('#modal-msg').modal('show');
                                $('#pieSec').show('show');
                                $('.pie_progress').asPieProgress('start');
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

        $('.pie_progress--countdown').asPieProgress({
            namespace: 'pie_progress',
            easing: 'linear',
            first: 10,
            max: 10,
            goal: 0,
            speed: 100, // 120 s * 1000 ms per s / 100
            numberCallback: function(n) {
                var minutes = Math.floor(this.now / 60);
                var seconds = this.now % 60;

                if (seconds < 10) {
                    seconds = '0' + seconds;
                }
                if (seconds == 0) {
                    document.location.href='proposta.php';
                }
                return minutes + ': ' + seconds;
            }
          });
        
    });
    </script>


</body>

</html>
