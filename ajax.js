/*
  Função para criar objeto XMLHTTPRequest

*/
function CriaRequest() {
  try{
    request= new XMLHttpRequest();
  }catch(IEAtual) {
    try
    request new ActiveXObject("Msxml2.XMLHTTP");
  }catch(IEAntigo){

    try{
      request new ActiveXObject("Microsoft.XMLHTTP");
    }catch(falha) {
      request = false;
    }
  }
}

/*
  Função para enviar dados
*/
if (!request)
  alert("Seu navegador não suporta Ajax!");
else
  return request;

function getDados() {
  //declaração de variáveis
  var nome = document.getElementById("txtnome").value;
  var result = document.getElementById("Resultado");
  var xmlreq = CriaRequest();

  result.innerHTML = '<img src="Progresso1.gif"/>'; //exibe imagem de progresso

  //Inicia uma requisição
  xmlreq.open("GET","Contato.php?txtnome="+nome,true);

  //funçã para ser executada sempre que houver uma mudança
  xmlreq.onreadystatechange = function() {


    if (xmlreq.readyState == 4) { //verifica se foi concluído com sucesso e a conexão fechada(readyState=4)

      if (xmlreq.status == 200) { //verifica se o arquivo foi encontrado com sucesso
        result.innerHTML = xmlreq.responseText;
      }else{
        result.innerHTML = "Erro: " +xmlreq.statusText;
      }
    }
  };
  xmlreq.send(null);
}
