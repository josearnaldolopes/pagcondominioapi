<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api.safe2pay.com.br/v2/BankSlip/WriteOffBankSlip?idTransaction='.$internoBoleto.'',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'DELETE',
  CURLOPT_HTTPHEADER => array(
    'x-api-key: 367BB444676A4ACDB9711029499D7E6B'
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  // echo $response;
}

/* ------------------------- GUARDA OS DADOS DA SAFE2PAY ------------------------- */

$bodycurl = json_decode($response, true);
$erro       = $bodycurl["HasError"];
$mensagem   = $bodycurl["Error"];