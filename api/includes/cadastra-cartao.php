<?php
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.zoop.ws/v1/marketplaces/".$marketplaces."/cards/tokens",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "{\"holder_name\":\"".$jsonBody['condomino']."\",\"card_number\":\"".$jsonBody['cartao']."\",\"expiration_month\":\"05\",\"expiration_year\":\"2022\",\"security_code\":\"".$jsonBody['cvv']."\"}",
  CURLOPT_HTTPHEADER => array(
    "authorization: Basic enBrX3Rlc3Rfbm00UWtta0RZcmpsNnZCMjFXYXFJRjdkOg==",
    "cache-control: no-cache",
    "content-type: application/json",
    "postman-token: 7d878137-0c3b-6761-4017-acf68d7f3acf"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
  $json = json_decode($response, true);

  $id_general   = $json['id'];
  $card_id      = $json['card']['id'];
  $holder_name  = $json['card']['holder_name'];

  $sql = "INSERT INTO condominos (condominio,idresposta,idcard,jsonresposta,nome) VALUES ('$token','$id_general','$card_id','$response','$holder_name')";

  if ($conexao->query($sql) === TRUE) {
      echo json_encode(array('aviso' => 'Adicionado com sucesso!'));
  } else {
      echo "Erro:" . $conexao->error;
  }
}