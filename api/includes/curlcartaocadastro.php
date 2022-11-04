<?php
/*
include "../../app/function.php";
$cartaoNome = $_REQUEST["nome"];
$cartaoNume = str_replace(" ", "", $_REQUEST["numero"]);
$cartaoMes  = $_REQUEST["mes"];
$cartaoAno  = $_REQUEST["ano"];
// echo "Dados".$cartaoNome.$cartaoNume.$cartaoMes.$cartaoAno;

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api.ansertecnologia.com/midas-core/v2/creditcard/',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
  "externalId":"'.aleatorio().'",
  "pan":"'.$cartaoNume.'",
  "expirationMonth":'.$cartaoMes.',
  "expirationYear":'.$cartaoAno.',
  "holderName":"'.$cartaoNome.'",
  "customer": {
    "documentType":"CPF",
    "documentNumber":"28044488863"
  }
}',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json',
    'Authorization: Basic cGFnY29uZG9taW5pby1oZWxib3I6SW5FdjJJQmlYTDFkWlJRdlpkbnVpQ0N6SktEVFd3PT0='
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;
*/
$cadastro = true;