<?php
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://payment.safe2pay.com.br/v2/Payment',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
    "Id": '.$internoBoleto.',
    "PaymentMethod": "1",
    "PaymentObject": {
        "Command": 4,
        "DiscountDue": "'.$body["boleto"]["data"].'",
        "DiscountAmount": '.$body["boleto"]["descontovalor"].'
    }
}',
  CURLOPT_HTTPHEADER => array(
    'x-api-key: 367BB444676A4ACDB9711029499D7E6B',
    'Content-Type: application/json',
    'Cookie: .AspNetCore.Session=CfDJ8Gb%2BFr1pKTBFoMuwXxZ5oUX%2Bd90mvmppaTmGBLW4H%2BFaVOT3zUbQmSvGZcfb1wbHh8RZ%2Fe9%2Fe3nYgNUUSx9%2BEAVJxR8yg6bokq9dismz4C%2BQ9dAP%2FyF%2Fz1UQl2rbQWonDdfd4kY16PwOwZeGVAiubuTs8TzJxufKJx8m%2FECX7JD8; ARRAffinity=e81fdc6ba350a5d391684e8a00ce9d8d0c39cc9c99bfa5f795f1331dba9fe0f6; ARRAffinitySameSite=e81fdc6ba350a5d391684e8a00ce9d8d0c39cc9c99bfa5f795f1331dba9fe0f6; TiPMix=71.2582998775217; x-ms-routing-name=self'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
// die($response);

/* ------------------------- GUARDA OS DADOS DA SAFE2PAY ------------------------- */

$bodycurl = json_decode($response, true);
$erro       = $bodycurl["HasError"];
$mensagem   = $bodycurl["Error"];
$linhadigitavel = $bodycurl["ResponseDetail"]["DigitableLine"];
$codigodebarras = $bodycurl["ResponseDetail"]["Barcode"];

/* ------------------------- DAQUI PRA FRENTE SAO AS INFORMACOES PARA PAGCONDOMINIO ------------------------- */

$origem = $boleto;
$bodyprimario = $response;
$interno = $bodycurl["ResponseDetail"]["IdTransaction"];