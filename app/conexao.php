<?php
try {
  $conexao = new PDO("mysql:host=".bdhost.";dbname=".bdbanco, bdlogin, bdsenha);
  $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  // header('Content-type: application/json');
  // header($http." 200");
  // exit(json_encode(array('aviso' => 'Bonitamente conectado!')));
} catch(PDOException $erro) {
  header('Content-type: application/json');
  header($http." 400");
  echo json_encode(array('Erro' => $erro->getMessage()));
}