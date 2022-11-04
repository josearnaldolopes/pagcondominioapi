<?php
include "../app/constants.php";
include "../app/variaveis.php";
include "../app/conexao.php";

header('Content-type: application/json');
date_default_timezone_set("America/Sao_Paulo");
header($http." 200");

echo json_encode(
    array('resultados' => 
        array('site' => 'https://pagcondominio.com/', 'documentacao' => 'https://documentacao.pagcondominio.com/', 'email' => 'contato@pagcondominio.com', 'data' => $data)
    )
);