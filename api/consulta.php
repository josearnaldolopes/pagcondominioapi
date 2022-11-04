<?php
// ini_set('display_errors',1);
// ini_set('display_startup_erros',1);
// error_reporting(E_ALL);
include "../app/variaveis.php";
include "../app/constants.php";
include "../app/conexao.php";
include "../app/function.php";
include "includes/variaveis.php";
include "includes/functions.php";

header('Content-type: application/json');
date_default_timezone_set('America/Sao_Paulo');

acessoAPI();
urlAPI();

$tipopgto = $urlapi[3];
$externo  = $urlapi[4];
$tipo       = array("cartao", "boleto", "pix", "outros");
$pagamento  = array("aberto", "liguidado", "atrasado", "indefinido", "sem pagamentos");

verificatipo($tipopgto);
 
$resposta = json_encode(array("externo" => $externo, "pagamento" => $tipopgto, "data" => $datac , "estado" => $pagamento[4]));

if ($metodo == "GET") {
    header($http." 200");
    echo $resposta; 
} else {
    header($http." 405");
    die( json_encode(array('aviso' => 'Metodo nao compativel.')) );  
}