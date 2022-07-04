function somenteNumeros(num)
{
    var er = /[^0-9.]/;
    er.lastIndex = 0;
    var campo = num;
    if (er.test(campo.value)) {
      campo.value = "";
    }
}

function consultar()
{
    var cpf = document.getElementById('cpf-cnpj').value;

    if (cpf == '')
    {
        $("#modal-msg").modal('show');
        document.getElementById('msg-consulta').innerHTML = 'Preencha o campo CPF/CNPJ!';
    } 
    else if (cpf.length < 10)
    {
        $("#modal-msg").modal('show');
        document.getElementById('msg-consulta').innerHTML = 'Preencha o campo CPF/CNPJ corretamente!';
    }
    else
    {
        var url = "controller/controller.php";
        var rt = createRequest();
        rt.open("POST", url, true);
          rt.onreadystatechange = function() {
            if (rt.readyState == 4)
            {
              if (rt.status == 200)
              {
                var resposta = rt.responseText;
                
                switch (resposta)
                {
                    case 'ok':
                      document.location.href='cliente/index.php';
                      break;
                    case 'invalido':
                      document.getElementById('msg-consulta').innerHTML = 'CPF/CNPJ não encontrado!';
                      $("#modal-msg").modal('show');
                      break;
                    default:
                      document.getElementById('msg-consulta').innerHTML = 'Erro ao fazer a consulta -> ' + resposta;
                      $("#modal-msg").modal('show');
                }
                
              }
              else
              {
                console.log('Ocorreu um erro na função consultar, status ajax -> ' + rt.status);
              }
            }
          }
          rt.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
          rt.send('&arquivo=consulta/contrato.php' +
                  "&cpfCnpf=" + escape(cpf) +
                  "&tipo=contrato"); 

    }
}

function validarCelular()
{
    var celular = document.getElementById('campo-cel').value;

    if (celular == '')
    {
        $("#modal-msg").modal('show');
        document.getElementById('msg-consulta').innerHTML = 'Preencha o campo dd + Número!';
    } 
    else if (celular.length < 10)
    {
        $("#modal-msg").modal('show');
        document.getElementById('msg-consulta').innerHTML = 'Preencha o campo dd + Número corretamente!';
    }
    else
    {
        var url = "../controller/controller.php";
        var rt = createRequest();
        rt.open("POST", url, true);
          rt.onreadystatechange = function() {
            if (rt.readyState == 4)
            {
              if (rt.status == 200)
              {
                var resposta = rt.responseText;

                switch (resposta)
                {
                    case 'ok':
                      $("#modal-msg").modal('show');
                      document.getElementById('msg-consulta').innerHTML = 'Foi enviado um SMS para o seu celular!';
                      setTimeout(function(){document.location.href='proposta.php';}, 3000)
                      break;
                    case 'invalido':
                      document.getElementById('msg-consulta').innerHTML = 'CPF/CNPJ não encontrado!';
                      $("#modal-msg").modal('show');
                      break;
                    default:
                      document.getElementById('msg-consulta').innerHTML = 'Erro ao fazer a consulta ou incluir celular na bases de dados -> ' + resposta;
                      $("#modal-msg").modal('show');
                }
              }
              else
              {
                console.log('Ocorreu um erro na função consultar, status ajax -> ' + rt.status);
              }
            }
          }
          rt.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
          rt.send('&arquivo=consulta/contrato.php' +
                  "&celular=" + escape(celular) +
                  "&tipo=celular"); 

    }
}

function validarCodigo()
{
    var codigo = document.getElementById('campo-cod').value;

    if (codigo == '')
    {
        $("#modal-msg").modal('show');
        document.getElementById('msg-consulta').innerHTML = 'Preencha o campo Código!';
    } 
    else if (codigo.length < 5)
    {
        $("#modal-msg").modal('show');
        document.getElementById('msg-consulta').innerHTML = 'Preencha o campo Código corretamente!';
    }
    else
    {
        var url = "../controller/controller.php";
        var rt = createRequest();
        rt.open("POST", url, true);
          rt.onreadystatechange = function() {
            if (rt.readyState == 4)
            {
              if (rt.status == 200)
              {
                var proposta = rt.responseText;

                if (proposta.substr(0, 2) == '[{')
                {
                    var proposta = JSON.parse(proposta);
                    var conteudoTable = '';
                    var conteudoOpcao = '';
                    for (var i = 0; i < proposta.length; i++)
                    {
                        conteudoTable +=  '<tr>' +
                                              '<td>' + proposta[i].OPCAO + '</td>' +
                                              '<td>' + formatReal(proposta[i].VR_ENTRADA) + '</td>' +
                                              '<td>' + proposta[i].QTDE_PARCELA + '</td>' +
                                              '<td>' + formatReal(proposta[i].VR_PARCELA) + '</td>' +
                                          '</tr>';
                        conteudoOpcao += "<option value='" + proposta[i].ID + "'>" +
                                              + proposta[i].OPCAO +
                                         '</option>';
                    }
                    document.location.href='#proposta';
                    if (proposta.length > 0)
                    {
                        document.getElementById('table-propostas').innerHTML = conteudoTable;
                        document.getElementById('opcao-prosta').innerHTML = conteudoOpcao;
                        document.getElementById('sem-registro').style.display = 'none';
                        document.getElementById('area-proposta').style.display = 'block';
                    }
                    else
                    {
                        //Sem registro
                        document.getElementById('table-propostas').innerHTML = '';
                        document.getElementById('sem-registro').style.display = 'block';
                        document.getElementById('area-proposta').style.display = 'none';
                    }
                    $("#modal-msg").modal('show');
                    document.getElementById('msg-consulta').innerHTML = 'Código validado com sucesso!';
                }
                else if(proposta == 'invalido')
                {
                    document.getElementById('msg-consulta').innerHTML = 'Código invalido!';
                    $("#modal-msg").modal('show');
                    document.getElementById('table-propostas').innerHTML = '';
                    document.getElementById('sem-registro').style.display = 'block';
                    document.getElementById('area-proposta').style.display = 'none';
                }
                else
                {
                    document.getElementById('msg-consulta').innerHTML = 'Erro ao buscar o código na bases de dados -> ' + proposta;
                    $("#modal-msg").modal('show');
                    document.getElementById('table-propostas').innerHTML = '';
                    document.getElementById('sem-registro').style.display = 'block';
                    document.getElementById('area-proposta').style.display = 'none';
                }
              }
              else
              {
                console.log('Ocorreu um erro na função validarCodigo, status ajax -> ' + rt.status);
              }
            }
          }
          rt.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
          rt.send('&arquivo=consulta/contrato.php' +
                  "&codigo=" + escape(codigo) +
                  "&tipo=codigo"); 

    }
}

function enviarProposta(tipo)
{
    $('#modal-envio').modal('show');
    var url = "../controller/controller.php";
    var rt = createRequest();
    rt.open("POST", url, true);
      rt.onreadystatechange = function() {
        if (rt.readyState == 4)
        {
          if (rt.status == 200)
          {
            $('#modal-envio').modal('hide');

            var proposta = rt.responseText;

            if (proposta != 'ok')
            {
              $("#modal-erro").modal('show');
              document.getElementById('modal-conteudo-erro').innerHTML = proposta;
            }
            else
            {
              $("#modal-msg").modal('show');
              document.getElementById('msg-consulta').innerHTML = 'Proposta enviada com sucesso!';
            }
          }
          else
          {
            console.log('Ocorreu um erro na função enviarPropostaEmail, status ajax -> ' + rt.status);
          }
        }
      }
      rt.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      if (tipo == 'opcao')
      {
        rt.send('&arquivo=email/email.php' +
                "&opcaoProposta=" + escape(document.getElementById('opcao-prosta').value) +
                "&tipo=propostaOpcao");
      } 
        else if (tipo == 'cliente')
      {
        var entrada     = document.getElementById('vl-entrada').value;
        var qtParcela   = document.getElementById('qt-parcela').value;
        var vlParcela   = document.getElementById('vl-parcela').value;
        var dtPagamento = document.getElementById('dt-pagamento').value;

        if (entrada == '' || dtPagamento == '' || vlParcela == '' || dtPagamento == '')
        {
            $('#modal-envio').modal('hide');
            $("#modal-msg").modal('show');
            document.getElementById('msg-consulta').innerHTML = 'Preencha todos os campos antes de enviar a sua proposta!';
        }
        else
        {
          rt.send('&arquivo=email/email.php' +
                  "&entrada=" + escape(entrada) +
                  "&qtParcela=" + escape(qtParcela) +
                  "&vlParcela=" + escape(vlParcela) +
                  "&dtPagamento=" + escape(dtPagamento) +
                  "&tipo=propostaCliente");
        }

      }
}

function upperCase(args)
{
    var campo = args.value;
    campo = campo.toUpperCase();
    document.getElementById(args.id).value = campo;
}

function formatReal( int )
{ 
        var tmp = int+'';
        tmp = tmp.replace(/([0-9]{2})$/g, ",$1");
        if( tmp.length > 6 ){
            tmp = tmp.replace(/([0-9]{3}),([0-9]{2}$)/g, ".$1,$2");
        }
    if( tmp.length <= 3 ){
      tmp = tmp.replace(",","0,");
    }
    if( tmp.length == 1 ){
      tmp = '0,0'+tmp;
    }
    var str = tmp;
    var patt = new RegExp("-,");
    if(patt.test(str)){
      saldo = int;
      saldo = saldo * -1;
      tmp = '-0,' + saldo;
    }
    if( tmp.length == 2 ){
      var patt = new RegExp("-");
      if(patt.test(str)){
        saldo = int;
        saldo = saldo * -1;
        tmp = '-0,0' + saldo;
      }
    }
    
    return tmp;
}

function formataValorCampo(campo, tipo) {
  var conteudo =  (tipo == 'valor') ? campo : document.getElementById(campo).value;

  conteudo = conteudo.replace(/[.,a-zA-ZÇç]/g, '');
  
  var lengthConteudo = conteudo.length;

  switch (lengthConteudo) {
    case 4:
      if (conteudo.substring(0, 4) != '0000') {
        if (conteudo.substring(0, 3) == '000') conteudo = conteudo.substring(0, 3).replace('000', '') + conteudo.substring(3, 4);
        if (conteudo.substring(0, 2) == '00') conteudo = conteudo.substring(0, 2).replace('00', '') + conteudo.substring(2, 4);
        if (conteudo.substring(0, 1) == '0') conteudo = conteudo.substring(0, 1).replace('0', '') + conteudo.substring(1, 4);
      }
      break;
    case 5:
      //conteudo = conteudo.substring(0, 1).replace('0', '') + conteudo.substring(1, 4);
      break;
  }

  var lengthConteudo = conteudo.length;

  switch (lengthConteudo) {
    case 1:
      conteudo = '0,0' + conteudo;
      break;
    case 2:
      conteudo = '0,' + conteudo;
      break;
    case 3:
      conteudo = conteudo.substring(0, 1) + ',' + conteudo.substring(1, 3);
      break;
    case 4:
      if (conteudo.substring(0, 4) == '0000') {
        conteudo = conteudo.substring(0, 1) + ',' + '00';
      } else {
        conteudo = conteudo.substring(0, 2) + ',' + conteudo.substring(2, 4);
      }
      break;
    case 5:
      conteudo = conteudo.substring(0, 3) + ',' + conteudo.substring(3, 5);
      break;
    case 6:
      conteudo = conteudo.substring(0, 1) + '.' + conteudo.substring(1, 4) + ',' + conteudo.substring(4, 6);
      break;
    case 7:
      conteudo = conteudo.substring(0, 2) + '.' + conteudo.substring(2, 5) + ',' + conteudo.substring(5, 7);
      break;
    case 8:
      conteudo = conteudo.substring(0, 3) + '.' + conteudo.substring(3, 6) + ',' + conteudo.substring(6, 8);
      break;
    case 9:
      conteudo = conteudo.substring(0, 1) + '.' + conteudo.substring(1, 4) + '.' + conteudo.substring(4, 7) + ',' + conteudo.substring(7, 9);
      break;
  }
  return (tipo == 'valor') ? conteudo : document.getElementById(campo).value = conteudo;

}

function SomenteNumero(e){
    var tecla=(window.event)?event.keyCode:e.which;   
    if((tecla>47 && tecla<58)) return true;
    else{
      if (tecla==8 || tecla==0) return true;
  else  return false;
    }
}

// Mascaras
jQuery("#dt-pagamento").mask("99/99/9999");
