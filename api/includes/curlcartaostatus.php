<?php
switch ($cartao) {
    case "anser":
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.ansertecnologia.com/midas-core/v2/status',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'Authorization: Basic cGFnY29uZG9taW5pby1oZWxib3I6SW5FdjJJQmlYTDFkWlJRdlpkbnVpQ0N6SktEVFd3PT0='
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $resposta = ($response == "OK") ? true : false;
    break;
    case "cartao":
    break;
    case "cartaooutro":
    break;
    default:
      header($http." 405");
      die(json_encode(array('aviso' => 'Sem cartao.')));
  }