<?php
//variáveis
$adminis     = $_POST["administradora"];
$nomecomp    = $_POST["nomecompleto"];
$nome        = $_POST["nome"];
$nome2       = $_POST["nome2"];
$cartao      = $_POST["cartao"];
$mes         = $_POST["mes"];
$ano         = $_POST["ano"];
$codseg      = $_POST["codseg"];
$cvv         = $_POST["cvv"];
$cvv2        = $_POST["cvv2"];
$telefone    = $_POST["telefone"];
$telefoneSec = $_POST["telefoneSec"];
$telFixo     = $_POST["telFixo"];
$telCel      = $_POST["telCel"];
$login       = $_POST["login"];
$login       = addslashes($login);
$senha       = $_POST["senha"];
$senha       = addslashes($senha);
$email       = $_POST["email"];
$email       = addslashes($email);
$local       = $_POST["local"];
$cpf         = $_POST["cpf"];
$tipo        = $_POST["tipo"];
$botao       = $_POST["botao"];
$botao2      = $_POST["botao"];
$cep         = $_POST["cep"];
$rua         = $_POST["rua"];
$endereco    = $_POST["endereco"];
$logradouro  = $_POST["logradouro"];
$bairro      = $_POST["bairro"];
$cidade      = $_POST["cidade"];
$estado      = $_POST["estado"];
$numero      = $_POST["numero"];
$numero2     = $_POST["numero2"];
$complemento = $_POST["complemento"];
$produtos    = $_POST["produtos"];
$data        = $_POST["data"];
$data2       = $_POST["data2"];
$dataextenso = $_POST["dataextenso"];
$origem      = $_POST["origem"];
$id          = $_POST["id"];
$site        = $_POST["site"];
$condominio  = $_POST["condominio"];
$bloco       = $_POST["bloco"];
$unidade     = $_POST["unidade"];
$sindico     = $_POST["sindico"];
$sindicoTel  = $_POST["sindicoTelefone"];
$cpf         = $_POST["cpf"];
$cnpj        = $_POST["cnpj"];
$documento   = $_POST["documento"];
$responsavel = $_POST["responsavel"];
$api         = $_POST["api"];
$recorrente  = $_POST["recorrente"];
$porcentagem = $_POST["porcentagem"];
$taxa 		 = $_POST["taxa"];
$chave       = $_POST["chave"];
$token       = $_POST["token"];
$liberacao   = $_POST["liberacao"];
$dominio     = $_POST["dominio"];
$boleto      = $_POST["boleto"];

//Variaveis do banco
$valor    = $_POST["valor"];
$banco    = $_POST["banco"];
$agencia  = $_POST["agencia"];
$conta    = $_POST["conta"];

//Variaveis do perfil
$acesso       = $_COOKIE["acesso"];
$emailacesso  = $_COOKIE["email"];
$nomeacesso   = $_COOKIE["user-nome"];
$chaveacesso  = $_COOKIE["chaveacesso"];
$emaillog     = $_COOKIE["emaillog"];
$datEnvio     = $_COOKIE["data"];
$cepEnvio     = $_COOKIE["cep"];
$numEnvio     = $_COOKIE["numero"];
$comEnvio     = $_COOKIE["complemento"];
$administrat  = $_COOKIE["administrativo"];
$cpfacesso    = $_COOKIE["cpf"];
$whitelabel   = $_COOKIE['whitelabel'];

// Painel da admninistradora
// $painelacesso = $_COOKIE["painelacesso"];
// $painelemail  = $_COOKIE["painelemail"];

//Variaveis Gerais
$a            = $_GET["a"];
$aviso        = $_GET["aviso"];
$msg          = $_GET["msg"];
$cidade_get   = $_GET["cidade"];
$idget        = $_GET["id"];
$parteget     = $_GET["parte"];
$tipoget      = $_GET["tipo"];
$arquivo      = $_FILES['file']['name'];
$ip 		  = $_SERVER["REMOTE_ADDR"];
$url          = $_SERVER['REQUEST_URI'];
$urlapi       = explode("/", $url);
$urlAdm       = explode("/", $url);
$urlAdmin     = $urlAdm[2];
$pasta        = "pagcondominio";
$urlAnterior  = $_SERVER['HTTP_REFERER'];
$servername   = $_SERVER['SERVER_NAME'];
$pagina       = $_SERVER['SERVER_NAME'].$_SERVER ['REQUEST_URI'];
$paginaant    = $_SERVER['HTTP_REFERER'];
$dataFile     = date("d-m-Y-h:i:s");
$dataFileC    = date("d-m-Y H:i:s");
$datac        = date("Y/m/d h:i:s");
$datad        = date("d/m/Y");
$horad        = date("H/M/S");

//Criptpografia
$cripMetodo = 'aes128';
$cripSenha = 'dmlkYSBsb25nYSBlIHByb3NwZXJh';

//API
$usuario = $_SERVER['PHP_AUTH_USER'];
$senha   = $_SERVER['PHP_AUTH_PW'];
$data    = date("d/m/Y H:i:s");
$localJson    = "../json/";
$marketplaces = "8a433bcdc7e04c2993ae93c06b1cf716";
$metodo       = $_SERVER['REQUEST_METHOD'];
$http         = "HTTP/1.1";
$splitvalor   = 1.50;
$acao         = $urlapi[4];
$chave        = $urlapi[5];

$usuario = 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx';
$senha   = 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx';
