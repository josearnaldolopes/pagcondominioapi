<?php
include "../app/variaveis.php";
include "../app/constants.php";
include "../app/conexao.php";
include "../app/function.php";
include "includes/variaveis.php";
include "includes/functions.php";

header('Content-type: application/json');
date_default_timezone_set('America/Sao_Paulo');

// acessoAPI();
// urlAPI();

$jsonBody = file_get_contents('php://input');
$body = json_decode($jsonBody, true);

$split = "soma";
$internoBoleto = $body["interno"];

//Lista as mensagens
foreach ($body['pagamento']['mensagens'] as $mensagem){
  $mensagens = $mensagem. "\n";
}

//Soma os valores e multiplica a quantidade informada no boleto
foreach ($body['produtos'] as $valores){
  $valor += $valores["valor"] * $valores["quantidade"];
}

if ($split == "porcentagem") {
  $taxa = $valor * $splitvalor / 100;
  $valor = $valor + $taxa;
} else if ($split == "soma") {
  $valor = $valor + $splitvalor;
}

switch ($metodo) {
  case "POST":
    validametodo("POST", $acao);
    if ($acao == "alterar")  {
      // echo "alterar";
      include "includes/curlboletoaltera.php"; //Conversa com a API do Boleto
      if ($erro) {
        echo json_encode(array('sucesso' => false, 'mensagem' => $mensagem));
        die();
      } else {
        
        $link = 'https://api.pagcondominio.com/gerarboleto/boleto/'.$interno.'/pdf';

        $sql = $conexao->prepare("UPDATE boleto SET estado = '0' WHERE usuario = '$usuario' AND boleto.interno = '$interno'");
        $sql->execute();
                  
        try {
        $resposta = json_encode(array('externo' => $body['externo'], 'interno' => $interno, 'tipo' => 'Condominio, Aluguel, etc...', 'documento' =>  $body['consumidor']['documento'], 'valor' => $valor, 'tipo' => $body['tipo'], 'linhadigitavel' => $linhadigitavel, 'codigodebarras' => $codigodebarras, 'link' => $link, 'situacao' => array('erros' => false, 'condicao' => 'pendente', 'mensagem' => 'Aguardando o pagamento. Após o pagamento, o boleto poderá levar até dois dias úteis para ser compensado.', 'data' => date($datac))));
        $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
        $stmt = $conexao->prepare('INSERT INTO boleto (interno,externo,usuario,bodyprimario,body,resposta,linhadigitavel,codigodebarras,link,ip,origem) VALUES(:interno,:externo,:usuario,:bodyprimario,:body,:resposta,:linhadigitavel,:codigodebarras,:link,:ip,:origem)');
        $stmt->execute(array(
          ':interno' => $interno,
          ':externo' => $body['externo'],
          ':usuario' => $usuario,
          ':bodyprimario' => $bodyprimario,
          ':body' => json_encode($body),
          ':resposta' => $resposta,
          ':linhadigitavel' => $linhadigitavel,
          ':codigodebarras' => $codigodebarras,
          ':link' => $link,
          ':ip' => $ip,
          ':origem' => $origem
        ));
        } catch(PDOException $e) {
          die(json_encode(array('erro' => $e->getMessage())));
        }
        echo $resposta;
        die();
      }
    } else {
      // echo "criar";
      switch ($boleto) {
        case "safe2pay":
          $chave = $body['chave'];
          condominio($chave);
          valida("boleto", $body, $metodo);
          include "includes/curlboleto.php"; //Conversa com a API do Boleto
          $link = 'https://api.pagcondominio.com/gerarboleto/boleto/'.$interno.'/pdf';
                
          try {
          $resposta = json_encode(array('externo' => $body['externo'], 'interno' => $interno, 'tipo' => 'Condominio, Aluguel, etc...', 'documento' =>  $body['consumidor']['documento'], 'valor' => $valor, 'tipo' => $body['tipo'], 'linhadigitavel' => $linhadigitavel, 'codigodebarras' => $codigodebarras, 'link' => $link, 'situacao' => array('erros' => false, 'condicao' => 'pendente', 'mensagem' => 'Aguardando o pagamento. Após o pagamento, o boleto poderá levar até dois dias úteis para ser compensado.', 'data' => date($datac))));
          $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
          $stmt = $conexao->prepare('INSERT INTO boleto (interno,externo,usuario,bodyprimario,body,resposta,linhadigitavel,codigodebarras,link,ip,origem) VALUES(:interno,:externo,:usuario,:bodyprimario,:body,:resposta,:linhadigitavel,:codigodebarras,:link,:ip,:origem)');
          $stmt->execute(array(
            ':interno' => $interno,
            ':externo' => $body['externo'],
            ':usuario' => $usuario,
            ':bodyprimario' => $bodyprimario,
            ':body' => json_encode($body),
            ':resposta' => $resposta,
            ':linhadigitavel' => $linhadigitavel,
            ':codigodebarras' => $codigodebarras,
            ':link' => $link,
            ':ip' => $ip,
            ':origem' => $origem
          ));
          } catch(PDOException $e) {
            die(json_encode(array('erro' => $e->getMessage())));
          }
          header($http." 201");
          echo $resposta;
          break;
        case "sicoob":
          header($http." 201");
          echo json_encode(array('boleto' => $boleto));
          break;
        case "bluepay":
          header($http." 201");
          echo json_encode(array('boleto' => $boleto));
          break;
        default:
        header($http." 200");
          die( json_encode(array('boleto' => 'Sem Empresa definida!')) );
      }  
    }
  break;
  case "GET":
    validametodo("GET", $acao);
    if ($acao == "ver") {
      $internoBoleto = $urlapi[4];
      include "includes/curlboletoconsulta.php"; //Conversa com a API do Boleto
      $simples = $conexao->prepare("SELECT interno,estado FROM boleto WHERE interno = $internoBoleto AND estado = 1");
      $simples->execute();
      $numero = $simples->rowCount();
        if ($numero) {
          /*Reservado para algo true*/
        } else {
          header($http." 400");
          die(json_encode(array('sucesso' => false, 'mensagem' => "Boleto nao encontrado")));
        }
      if ($erro) {
        header($http." 400");
        echo json_encode(array('sucesso' => false, 'mensagem' => "Ocorreu um erro não catalogado"));
        die();
      } else {
        header($http." 200");
        echo json_encode(array('interno' =>$interno, 'mensagem' => $mensagem, 'data' => $datacria, 'valor' => $valor, 'consumidor' => array('nome' => $nome, 'documento' => $documento, 'endereco' => array('logradouro' => $logradouro, 'numero' => $numero, 'logradouro' => $logradouro, 'numero' => $numero, 'complemento' => $comp, 'bairro' => $bairro, 'cidade' => $cidade, 'estado' => $estado), 'pagamento' => array('data' => $vencimento, 'linhadigitavel' => $linhadigitavel, 'codigodebarras' => $codigodebarras))));
      }
    }
  break;
  case "DELETE":
    validametodo("DELETE", $acao);
    if ($acao == "apagar") {
      include "includes/curlboletoapaga.php"; //Conversa com a API do Boleto
      if ($erro) {
        header($http." 400");
        echo json_encode(array('sucesso' => false, 'mensagem' => "Boleto ja apagado"));
        // echo json_encode(array('sucesso' => false, 'mensagem' => $descricao));
        die();
      } else {
        try {
          $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
          $sql = $conexao->prepare("UPDATE boleto SET estado = '0' WHERE usuario = '$usuario' AND boleto.interno = '$internoBoleto'");
          $sql->execute();
          $numero = $sql->rowCount();
          if ($numero) {
            header($http." 200");
            echo json_encode(array('sucesso' => true, 'mensagem' => 'Boleto apagado', 'registros' =>  $numero));
          } else {
            header($http." 400");
            echo json_encode(array('sucesso' => false, 'mensagem' => 'Boleto ja apagado ou nao encontrado', 'registros' =>  $numero));
          }
          // echo $numero ? json_encode(array('sucesso' => true, 'mensagem' => 'Boleto apagado', 'registros' =>  $numero)) : json_encode(array('sucesso' => false, 'mensagem' => 'Boleto ja apagado ou nao encontrado', 'registros' =>  $numero));
          } catch(PDOException $e) {
            die(json_encode(array('erro' => $e->getMessage())));
          }
      }
    }
  break;
  default:
  header($http." 405");
  die( json_encode(array('aviso' => 'Metodo nao compativel.')) );
}

die();