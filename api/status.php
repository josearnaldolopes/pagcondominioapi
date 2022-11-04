<?php
include "../app/constants.php";
include "../app/variaveis.php";
include "../app/conexao.php";

header('Content-type: application/json');
date_default_timezone_set("America/Sao_Paulo");

$sql = "SELECT  erp.id,erp.usuario,erp.senha FROM erp WHERE erp.usuario = '$usuario' and erp.senha = '$senha'";
$simples = $conexao->prepare($sql);
$simples->execute();
$registro = $simples->fetch();

switch ($metodo) {
    case "GET":
    if ($usuario && $senha) {
        if ($usuario == $registro["usuario"] && $senha == $registro["senha"]) {
        header($http." 200");
        echo json_encode(array('resultado' => 'Dados corretos!', 'documentacao' => 'https://documentacao.pagcondominio.com/', 'email' => 'contato@pagcondominio.com', 'id' => $registro["id"], 'data' => $data), JSON_UNESCAPED_SLASHES);
    } else {
            header($http." 500");
            die(json_encode(array('resultado' => 'Verifique o acesso, dados errados.', 'data' => $data)));
        }
    } else {
        header($http." 500");
        die(json_encode(array('resultado' => 'Sem acesso. Tem login e senha?', 'data' => $data)));
    }
break;
default:
    header($http." 405");
    die(json_encode(array('resultado' => 'Método errado.')));
}