<?php
include "../app/variaveis.php";
include "../app/constants.php";
include "../app/conexao.php";
include "../app/function.php";
include "includes/variaveis.php";
include "includes/functions.php";

header('Content-type: application/json');

// acessoAPI();
// urlAPI();

$jsonBody = file_get_contents('php://input');
$body = json_decode($jsonBody, true);

switch ($metodo) {
  case "POST":
      validametodo("POST", $acao);
      $documento = limpanumero($body['documento']);
      $digitos   = quarteto($numero);
      // valida("condomino", $body, $metodo);
      cpfOuCnpj($documento, "condomino");
      $documento = criptografar($documento);
      // if (!cpf($documento)) { header($http." 400"); die(json_encode(array('erro' => 'Documento invalido'))); }
      /*
      $sqlCond = $conexao->prepare("SELECT condominios.id,condominios.condominio,condominios.chave FROM condominios WHERE condominios.chave = '".$body["chave"]."' AND erp = ".$registro["id"]."");
      $sqlCond->execute();
      $resultadoC = $sqlCond->fetch();
      $numeroCond = $sqlCond->rowCount();
      if (!$numeroCond) { header($http." 400"); die(json_encode(array('aviso' => 'Erro ao acessar esse condominio.'))); }
      
      $sqlCondomino = $conexao->prepare("SELECT condomino.id,condomino.documento FROM condomino WHERE condomino.documento = '".$documento."' AND erp = ".$registro["id"]."");
      $sqlCondomino->execute();
      $resultadoCondomino = $sqlCond->fetch();
      $numeroCondomino = $sqlCondomino->rowCount();
      if ($numeroCondomino) { header($http." 400"); die(json_encode(array('aviso' => 'Ja existe um cadastro com esse documento'))); }
      */
      
      try {
      $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
      $stmt = $conexao->prepare('INSERT INTO condomino (nome,apartamento,bloco,complemento,documento,telefone,email) VALUES(:nome,:apartamento,:bloco,:complemento,:documento,:telefone,:email)');
      $stmt->execute(array(
        ':nome' => $body['nome'],
        ':apartamento' => $body['apartamento'],
        ':bloco' => $body['bloco'],
        ':complemento' => $body['complemento'],
        ':documento' => $documento,
        ':telefone' => criptografar($body['telefone']),
        ':email' => criptografar($body['email'])
      ));
      header($http." 201");
      echo json_encode(array('sucesso' => true, 'mensagem' => 'Condomino cadastrado', 'data' =>  $ata));
    } catch(PDOException $e) {
      header($http." 500");
      echo json_encode(array('erro' => $e->getMessage()));
    }
    break;
  case "DELETE":
    validametodo("DELETE", $acao);
    if ($acao == "apagar" && $chave) {
      // $sql = $conexao->prepare("DELETE FROM condomino WHERE condomino.id = '$chave' AND condomino.erp = ".$registro["id"]."");
      $sql = $conexao->prepare("DELETE FROM condomino WHERE condomino.id = '$chave'");
      $sql->execute();
      $numero = $sql->rowCount();
      if ($numero) {
        header($http." 200");
        echo json_encode(array('sucesso' => true, 'mensagem' => 'Condomino apagado', 'numero' =>  $numero));
      } else {
        header($http." 400");
        echo json_encode(array('sucesso' => false, 'mensagem' => 'Condomino ja apagado ou nao encontrado', 'numero' =>  $numero));
      }
    } else if ($acao == "apagar" && !$chave)  {
      header($http." 400");
      echo json_encode(array('aviso' => 'Forneca um ID para ser tratado'));
    } else {
      header($http." 500");
      echo json_encode(array('aviso' => 'Ocorreu um erro interno'));
    }
    break;
  case "GET":
    validametodo("GET", $acao);
    if ($acao == "ver" && $chave) {
      // $sql = $conexao->prepare("SELECT id,condominio,bloco,unidade,nome,telefone,telefoneSec,email,recorrencia FROM condomino WHERE condomino.id = '$chave' AND condomino.erp = ".$registro["id"]."");
      $sql = $conexao->prepare("SELECT id,condominio,bloco,apartamento,nome,telefone,email FROM condomino WHERE condomino.id = '$chave'");
      $sql->execute();
      $condomino = $sql->fetchAll(PDO::FETCH_ASSOC);
      $numero = $sql->rowCount();
      // descriptografa dos dados do json com os dados abertos em fetchAll()
      // $condomino[0]["cpf"] = descriptografar($condomino[0]["cpf"]);
      $condomino[0]["telefone"] = descriptografar($condomino[0]["telefone"]);
      $condomino[0]["email"] = descriptografar($condomino[0]["email"]);
      if ($numero) {
        header($http." 200");
        $condomino = json_encode($condomino); // a variável $resultado vira o json...
        echo trim($condomino, '[]'); //...para o trim retirar os colchetes
      } else {
        header($http." 400");
        echo json_encode(array('aviso' => 'erro ao acessar esse condomino'));
      }
      // echo $numero ? json_encode($condomino) : json_encode(array('aviso' => 'Erro ao acessar esse condomino'));
    } else if ($acao == "listar") {
      // $sql = $conexao->prepare("SELECT id,condominio,bloco,unidade,nome,telefone,telefoneSec,email,recorrencia FROM condomino WHERE condomino.erp = ".$registro["id"]."");
      $sql = $conexao->prepare("SELECT id,condominio,bloco,apartamento,nome,telefone,email FROM condomino");
      $sql->execute();
      $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
      $numero = $sql->rowCount();
      $condomino = $sql->fetchAll(PDO::FETCH_ASSOC);

      for($i=0; $i<=count($resultado)-1; $i++) {
        $resultado[$i]["telefone"] = descriptografar($resultado[$i]["telefone"]);
        $resultado[$i]["email"] = descriptografar($resultado[$i]["email"]);
      }

      $json = json_encode($resultado);
      
      if ($numero) {
        header($http." 200");
        echo trim($json, '[]');
      } else {
        header($http." 400");
        echo json_encode(array('aviso' => 'Erro ao acessar esse condomino'));
      }
      // echo $numero ? json_encode($resultado) : json_encode(array('aviso' => 'Erro ao acessar esse condomino'));
    } else if ($acao == "condominio") {
      $sql = $conexao->prepare("SELECT id,nome,apartamento,bloco,chave,erp FROM condomino WHERE condomino.chave = '$chave' AND condomino.erp = ".$registro["id"]."");
      $sql->execute();
      $condomino = $sql->fetchAll(PDO::FETCH_ASSOC);
      $numero = $sql->rowCount();
      if ($numero) {
        header($http." 200");
        $condomino = json_encode($condomino); 
        echo $condomino;
      } else {
        header($http." 400");
        echo json_encode(array('aviso' => 'Erro ao acessar esse condomino'));
      }
    } else if ($acao == "") {
      header($http." 405");
      echo json_encode(array('erro' => 'Metodo nao compativel...'));
    } else {
      header($http." 500");
      echo json_encode(array('aviso' => 'Ocorreu um erro interno'));
    }
    break;
  case "PUT":
    if ($acao == "alterar") {

      try {
        $chave = $body['chave'];
        $idJson = $body['id'];
        $documento = limpanumero($body['documento']);
        //busca ("condominio", $documento, $chave);
        $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
        $stmt = $conexao->prepare('UPDATE condomino SET nome = :nome, apartamento = :apartamento, bloco = :bloco, complemento = :complemento, telefone = :telefone, email = :email, documento = :documento WHERE id = :id');
        $stmt->execute(array(
          ':id' => $idJson,
          ':nome' => $body['nome'],
          ':apartamento' => $body['apartamento'],
          ':bloco' => $body['bloco'],
          ':complemento' => $body['complemento'],
          ':telefone' => $body['telefone'],
          ':email' => criptografar($body['email']),
          ':telefone' => criptografar($body['telefone']),
          ':documento' => criptografar($documento)
        ));
        $numero = $stmt->rowCount();
          if ($numero) {
            header($http." 200");
            echo json_encode(array('sucesso' => true, 'mensagem' => 'Condomino Alterado', 'data' =>  $data));
          } else {
            header($http." 400");
            echo json_encode(array('sucesso' => false, 'mensagem' => 'Ocorreu um erro ou nao há o que alterar em sua requisicao'));
          }
      } catch(PDOException $e) {
          header($http." 500");
          echo json_encode(array('erro' => $e->getMessage()));
      }
    }
    break;
  default:
    header($http." 405");
    echo json_encode(array('erro' => 'Metodo nao compativel...'));
  }