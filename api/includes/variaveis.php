<?php
$usuario = $_SERVER['PHP_AUTH_USER'];
$senha   = $_SERVER['PHP_AUTH_PW'];
$data    = date("d/m/Y H:i:s");
$localJson    = "../json/";
$marketplaces = "8a433bcdc7e04c2993ae93c06b1cf716";
$metodo       = $_SERVER['REQUEST_METHOD'];
$http         = "HTTP/1.1";
$splitvalor   = 1.50;