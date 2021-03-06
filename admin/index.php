<?php 

    session_start(); 
    
    if(isset($_SESSION['login_personal_adm']) != '')
    {
        header('Location: admin.php');
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
                        <a class="page-scroll" href="../">RETORNAR</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#adm">ACESSO</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="https://trctaborda.com.br/">Servi??os</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#contact">Contato</a>
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
                <h1 id="homeHeading">??rea administrativa</h1>
                <hr>
                <p>Microeasy & PersonalCob</p>
                <a href="#adm" class="btn btn-primary btn-xl page-scroll" style="background: #00FFFF; color: #000000;">Acessar</a>
            </div>
        </div>
    </header>

    <aside class="bg-dark" id="adm">
        <div class="container text-center">
            <div class="call-to-action">
                <h2>Microeasy & PersonalCob</h2>
                <h3>Acesso Administrativo</h3>
            </div>
            <div class="row">
                <form>
                    <div class="form-group col-lg-2">
                        
                    </div>
                    <div class="form-group col-lg-4">
                        <label>Logon</label>
                        <input type="text" id="login-admin" class="form-control" maxlength="10">
                    </div>
                    <div class="form-group col-lg-4">
                        <label>Senha</label>
                        <input type="password" id="senha-admin" class="form-control" maxlength="10">
                    </div>
                    <div class="form-group col-lg-12">
                        <button type="button" id="bt-acessar" class="btn btn-default">Acessar</button>
                    </div>
                </form>
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
    <script src="../js/helpers.js?v=1.0.6"></script>

    <!-- Modal -->
    <div class="modal fade" id="modal-msg" role="dialog">
        <div class="modal-dialog modal-sm">
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

    <script type="text/javascript">
    $('#bt-acessar').click(function() {
        var login = $('#login-admin').val();
        var senha = $('#senha-admin').val();

        var arrErro = [];

        if (login == '') {
            arrErro.push('Campo Login vazio');
        } else {
            if (login < 3) arrErro.push('O login ?? menor que 3 caracteres');
        }

        if (senha == '') {
            arrErro.push('Campo Senha vazio');
        } else {
            if (senha < 3) arrErro.push('A senha ?? menor que 3 caracteres');
        }

        if (arrErro.length != 0) {
            var conteudoErro = '';
            for (var i = 0; i < arrErro.length; i++) {
                conteudoErro += '<p>-' + arrErro[i] + '</p>';
            }
            $('#msg-consulta').html(conteudoErro);
            $('#modal-msg').modal('show');
        } else {
            $.ajax({
                  type: 'POST',
                  dataType: 'json',
                  url: '../controller/controller.php',
                  
                  data: {
                          login: login, 
                          senha: senha,
                          arquivo: 'acesso/acesso.php',
                        },
                  beforeSend: function() {
                    //alert('Enviou');
                    //$("#loading-modal").modal({backdrop: "static"});
                    
                  },
                  success: function(result, status, request) {
                      var resposta = JSON.parse(request.responseText);
                      if (resposta.res == 'ok') {
                        document.location.href='admin.php';
                      } else {
                        $('#msg-consulta').html('Login ou senha incorreto');
                        $('#modal-msg').modal('show');
                      }
                  },
                  error: function(request, status, erro) {
                      alert('Ocorreu o seguinte erro -> ' + request.responseText);
                  },
                  complete: function() {
                    //alert('terminou');
                  }
              });        
        }

      
    });
    </script>


</body>

</html>
