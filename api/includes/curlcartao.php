<?php
/*---- Tratando erros ----*/
// ini_set('display_errors', '1');
// ini_set('display_startup_errors', '1');
// error_reporting(E_ALL);
/*---- Fim do Tratando erros ----*/

/*
include "../../app/constants.php";
include "../../app/conexao.php";
include "../../app/function.php";

$cartoes  = $_REQUEST["cartoes"];
$cvv      = $_REQUEST["cvv"];
date_default_timezone_set('America/Brasilia');
$data     = date("Y-m-d\TH:i:s");
$transacao = aleatorio();
$valor = $_REQUEST["valor"];
$documento = $_REQUEST["documento"];
// echo $data." > ".$cartoes;
//echo $cartoes.$cvv;
// die("Valores: ".$valor." > ".$cvv." > ".$cartoes);

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api.ansertecnologia.com/midas-core/v2/transaction/creditcard/authorize',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
   "externalId":"'.$transacao.'",
   "externalDate":"'.$data.'",
   "cardToken":"'.$cartoes.'",
   "cvv": "'.$cvv.'",
   "amount":'.$valor.',
   "instalments":1,
   "description":"'.$descricao.'"
}',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json',
    'Authorization: Basic cGFnY29uZG9taW5pby1oZWxib3I6SW5FdjJJQmlYTDFkWlJRdlpkbnVpQ0N6SktEVFd3PT0='
  ),
));

$response = curl_exec($curl);

curl_close($curl);
// echo $response;

//Lendo o json
$resposta = json_decode($response);
$sucesso = $resposta->result->success ? "true" : "false";
// echo $sucesso;
echo $resposta->result->message;
*/

/*
echo "<br>";
echo "<b>Resultado:</b> ".trim($resposta->result->success)."<br>";
echo "<b>Code:</b> ".trim($resposta->result->code)."<br>";
echo "<b>Mensagem:</b> ".trim($resposta->result->message)."<br>";
echo "<b>Token:</b> ".trim($resposta->transactionToken)."<br>";
*/

/* Gravando no banco de dados */

/*
try {
  $resultado = $resposta->result->success ? "true" : "false";
  $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
  $stmt = $conexao->prepare('INSERT INTO transacao (resposta,IdTransacao,token,resultado,mensagem,dataTransacao,cardToken,documento) VALUES(:resposta,:IdTransacao,:token,:resultado,:mensagem,:dataTrans,:cardToken,:documento)');
  $stmt->execute(array(
    ':resposta' => ''.$response.'',
    ':IdTransacao' => ''.$transacao.'',
    ':token' => ''.$resposta->transactionToken.'',
    ':resultado' => ''.$resultado.'',
    ':mensagem' => ''.$resposta->result->message.'',
    ':dataTrans' => ''.$data.'',
    ':cardToken' => ''.$cartoes.'',
    ':documento' => ''.$documento.''
  ));
  
  // echo "Resultado: ".$stmt->rowCount();
} catch(PDOException $e) {
  echo 'Error: ' . $e->getMessage();
}
include "../../conexaofechar.php";
*/


header($http." 200");
echo json_encode(array('aviso' => 'Pagamento', 'IP: ' => $ip, 'Usuário (ERP)' => $usuario, 'cartao' => $cartao, 'cadastro' => $cadastro, 'status' => $resposta));