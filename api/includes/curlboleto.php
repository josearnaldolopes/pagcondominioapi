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
    "IsSandbox": false,
    "Application": "Testando Subconta",
    "Vendor": "Pagcondominio.com",
    "CallbackUrl": "https://callbacks.exemplo.com.br/api/Notify",
    "PaymentMethod": "1",
    "Reference": "TESTE NUMBER 4!",
    "Customer": {
        "Name": "'.$body['consumidor']['nome'].'",
        "Identity": "'.$body['consumidor']['documento'].'",
        "Phone": "'.$body['consumidor']['telefone'].'",
        "Email": "'.$body['consumidor']['email'].'",
        "Address": {
            "ZipCode": "'.$body['consumidor']['endereco']['cep'].'",
            "Street": "'.$body['consumidor']['endereco']['logradouro'].'",
            "Number": "'.$body['consumidor']['endereco']['numero'].'",
            "Complement": "'.$body['consumidor']['endereco']['complemento'].'",
            "District": "'.$body['consumidor']['endereco']['bairro'].'",
            "CityName": "'.$body['consumidor']['endereco']['cidade'].'",
            "StateInitials": "'.$body['consumidor']['endereco']['estado'].'",
            "CountryName": "Brasil"
        }
    },
    "Products": [
        {
            "Code": "001",
            "Description": "Condominio",
            "UnitPrice": '.$valor.',
            "Quantity": 1
        }
    ],
    "PaymentObject": {
        "DueDate": "'.$body['pagamento']['vencimento'].'",
        "Instruction": "Instruções",
        "Message": [
            "'.$mensagens.'"
        ]
    }
}',
  CURLOPT_HTTPHEADER => array(
    'x-api-key: 367BB444676A4ACDB9711029499D7E6B',
    'Content-Type: application/json',
    'Cookie: .AspNetCore.Session=CfDJ8Gb%2BFr1pKTBFoMuwXxZ5oUX%2Bd90mvmppaTmGBLW4H%2BFaVOT3zUbQmSvGZcfb1wbHh8RZ%2Fe9%2Fe3nYgNUUSx9%2BEAVJxR8yg6bokq9dismz4C%2BQ9dAP%2FyF%2Fz1UQl2rbQWonDdfd4kY16PwOwZeGVAiubuTs8TzJxufKJx8m%2FECX7JD8; ARRAffinity=e81fdc6ba350a5d391684e8a00ce9d8d0c39cc9c99bfa5f795f1331dba9fe0f6; ARRAffinitySameSite=e81fdc6ba350a5d391684e8a00ce9d8d0c39cc9c99bfa5f795f1331dba9fe0f6; TiPMix=27.0779245193479; x-ms-routing-name=self'
  ),
));

$response = curl_exec($curl);
curl_close($curl);

/* ------------------------- GUARDA OS DADOS DA SAFE2PAY ------------------------- */

$bodycurl = json_decode($response, true);
/* Em caso de erro */
$error = $bodycurl["HasError"];
$erro  = $bodycurl["Error"];
/* Em caso de Sucesso */
$linhadigitavel = $bodycurl["ResponseDetail"]["DigitableLine"];
$codigodebarras = $bodycurl["ResponseDetail"]["Barcode"];

/* ------------------------- DAQUI PRA FRENTE SAO AS INFORMACOES PARA PAGCONDOMINIO ------------------------- */

$origem = $boleto;
$bodyprimario = $response;
$interno = $bodycurl["ResponseDetail"]["IdTransaction"];

if ($error) {
    header($http." 200");
    die( json_encode(array('error' => $erro)) );
}
    

/*
echo "DigitableLine: ".$bodycurl["ResponseDetail"]["DigitableLine"];
echo '<br>';
echo "Barcode: ".$bodycurl["ResponseDetail"]["Barcode"];
echo '<br>';
echo $bodycurl["ResponseDetail"]["IdTransaction"];
echo '<hr>';
*/