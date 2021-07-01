<?php
include('../vendor/autoload.php');
use Opis\Database\Database;
use Opis\Database\Connection;

$connection = new Connection(
  'mysql:host=localhost;dbname=gabrielusina_teste',
  'gabrielusina_gabrielusina',
  'mdD=i0B{q-)c'
);
$db = new Database($connection);

$IdInicial = isset($_POST['IdInicial']) ? $_POST['IdInicial']:"";
$IdFinal = isset($_POST['IdFinal']) ? $_POST['IdFinal']:"";
$retorno = "";

if ($IdInicial != "" && $IdFinal != "") {
  $result_id = $db->from('clientes')
    ->where('id_clientes')->between($IdInicial, $IdFinal)
    ->select(['id_clientes', 'nome_clientes'])
    ->all();
  $object = (object) $result_id;
  if (count($result_id)) {
    echo "<div align=center> <h4>Resultados</h4></div>";
    foreach($object as $obj) {
      $retorno = "<div class='row' align='center'><div class='col' align='center'><table><tr><td><b>".$obj->id_clientes."</b>.</td><td>".$obj->nome_clientes."</td></tr></div></div></table>";
      echo $retorno;
    }
  }else{ //caso não sejam encontrados registros
    $retorno .= "<div class='alert alert-primary d-flex align-items-center' role='alert'>
    <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-info-circle-fill' viewBox='0 0 16 16'>
      <path d='M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z'/>
    </svg>
    <div style='margin-left: 5px'>
      Não existem registros com os parâmetros informados.
    </div>
    </div>";
    echo $retorno;
  }

}else{ //caso o usuário não tenha dado entrada nos campos.
  $retorno .= "<div class='alert alert-danger d-flex align-items-center' role='alert'>
  <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-exclamation-triangle-fill' viewBox='0 0 16 16'>
    <path d='M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z'/></svg>
        <div style='margin-left: 5px'>
          As datas iniciais e finais devem estar preenchidas!
        </div>
    </div>";
    echo $retorno;
}
