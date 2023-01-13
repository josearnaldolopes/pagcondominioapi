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
    "IsSandbox": true,
    "Application": "Pagcondominio",
    "Vendor": "Pagcondominio.com",
    "CallbackUrl": "https://callbacks.exemplo.com.br/api/Notify",
    "PaymentMethod": "1",
    "Reference": "",
    "Customer": {
        "Name": "",
        "Identity": "",
        "Phone": "",
        "Email": "",
        "Address": {
            "ZipCode": "",
            "Street": "",
            "Number": "",
            "Complement": "",
            "District": "",
            "CityName": "",
            "StateInitials": "",
            "CountryName": ""
        }
    },
    "Products": [
        {
            "Code": "001",
            "Description": "",
            "UnitPrice": '.$valor_cobrado.',
            "Quantity": 1
        }
    ],
    "PaymentObject": {
        "DueDate": "",
        "Instruction": "Instruções",
        "Message": [
            "",
            ""
        ]
    }
}',
  CURLOPT_HTTPHEADER => array(
    'x-api-key: xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx',
    'Content-Type: application/json',
    'Cookie: xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
//echo $response;
//echo '<hr>';
$bodycurl = json_decode($response, true);
/*
echo "DigitableLine: ".$bodycurl["ResponseDetail"]["DigitableLine"];
echo '<br>';
echo "Barcode: ".$bodycurl["ResponseDetail"]["Barcode"];
echo '<br>';
echo $bodycurl["ResponseDetail"]["IdTransaction"];
echo '<hr>';
*/
