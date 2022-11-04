<?php
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api.safe2pay.com.br/v2/transaction/Get?Id='.$internoBoleto.'',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'x-api-key: 367BB444676A4ACDB9711029499D7E6B',
    'Cookie: .AspNetCore.Session=CfDJ8A1totfthpdLoVJuiBjmbD5OKAs3Ww6dA5b9JqSBER2dZg1%2BGMa3Q3JLBbIOEtlA3yuZyx5%2B%2Btt%2FzbR7bR7jPanPwhijZpoh6edIeo5soFifC1XbIYTOPV2KpQSQnIjwJDuGFFf7lVjtxg15Z2g32nQjcGpdvrlyS7ka2bRNH4Db; ARRAffinity=e9f73a708e74fa0ed9ce7424e2e9689dea55e5ad15fb3b3eea7f5b53b08331aa; ARRAffinitySameSite=e9f73a708e74fa0ed9ce7424e2e9689dea55e5ad15fb3b3eea7f5b53b08331aa; TiPMix=91.2372817710216; x-ms-routing-name=self'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
// echo $response;

/* ------------------------- GUARDA OS DADOS DA SAFE2PAY ------------------------- */

$bodycurl = json_decode($response, true);
$erro        = $bodycurl["HasError"]; //Aparece no erro
$mensagem    = $bodycurl["Error"]; //Aparece no erro
$requestid   = $bodycurl["RequestId"]; //Aparece no erro

$linhadigitavel = $bodycurl["ResponseDetail"]['PaymentObject']["DigitableLine"];
$codigodebarras = $bodycurl["ResponseDetail"]['PaymentObject']["Barcode"];
$vencimento     = $bodycurl["ResponseDetail"]['PaymentObject']["DueDate"];

$interno  = $bodycurl["ResponseDetail"]["IdTransaction"];
$status     = $bodycurl["ResponseDetail"]["Status"];
$datacria   = $bodycurl["ResponseDetail"]["CreatedDate"];
$valor      = $bodycurl["ResponseDetail"]["Amount"];
$mensagem   = $bodycurl["ResponseDetail"]["Message"];

$nome       = $bodycurl["ResponseDetail"]["Customer"]["Name"];
$documento  = $bodycurl["ResponseDetail"]["Customer"]["Identity"];
$logradouro = $bodycurl["ResponseDetail"]["Customer"]["Address"]["Street"];
$numero     = $bodycurl["ResponseDetail"]["Customer"]["Address"]["Number"];
$bairro     = $bodycurl["ResponseDetail"]["Customer"]["Address"]["District"];
$comp       = $bodycurl["ResponseDetail"]["Customer"]["Address"]["Complement"];
$cidade     = $bodycurl["ResponseDetail"]["Customer"]["Address"]["City"];
$estado     = $bodycurl["ResponseDetail"]["Customer"]["Address"]["State"];

/* ------------------------- DAQUI PRA FRENTE SAO AS INFORMACOES PARA PAGCONDOMINIO ------------------------- */