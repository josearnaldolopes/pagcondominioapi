<?php
/**
* Função para gerar senhas aleatórias
*
* @author    Thiago Belem <contato@thiagobelem.net>
*
* @param integer $tamanho Tamanho da senha a ser gerada
* @param boolean $maiusculas Se terá letras maiúsculas
* @param boolean $numeros Se terá números
* @param boolean $simbolos Se terá símbolos
*
* @return string A senha gerada
*/
function aleatorio($tamanho = 8, $maiusculas = true, $numeros = true, $simbolos = false)
{
	$lmin = 'abcdefghijklmnopqrstuvwxyz';
	$lmai = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$num = '1234567890';
	$simb = '!@#$%*-';
	$retorno = '';
	$caracteres = '';
	$caracteres .= $lmin;
	if ($maiusculas) $caracteres .= $lmai;
	if ($numeros) $caracteres .= $num;
	if ($simbolos) $caracteres .= $simb;
	$len = strlen($caracteres);
	for ($n = 1; $n <= $tamanho; $n++) {
	$rand = mt_rand(1, $len);
	$retorno .= $caracteres[$rand-1];
	}
	return $retorno;
}

function acesso($acesso, $local) {
	($acesso) ?:  header ("Location: index?nolog");
}

function limpa($string)
{
  $string = preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë|ẽ)/","/(É|È|Ê|Ë|Ê)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/","/(ç)/","/(Ç)/"),explode(" ","a A e E i I o O u U n N c C"),$string);
  $string = ltrim($string);
  $string = rtrim($string);
  $string = strip_tags($string);
  $string = addslashes($string);
  $string = strtolower($string);
  $string = str_replace(" ","-",$string);
	return $string;
}
function limpanumero($numero) {
	$numero = ltrim($numero);
	$numero = rtrim($numero);
	$padrao = '/([-_\/.,():;])/';
	$numero = preg_replace($padrao, "", $numero);
	$numero = str_replace(" ", "", $numero);
	return $numero;
}
function quarteto($numero) {
	$numero = substr($numero, -4);
	return $numero;
}
function maiuscula($string)
{
	$string = strtoupper($string);
	return $string;
}
function primeira($string)
{
	$letra = $string{0};
	return $letra;
}
function criptografia($valor) {
	$valor = md5($valor);
	return $valor;
}
function criptografar($valor) {
	global $cripMetodo, $cripSenha;
	$valor = openssl_encrypt($valor, $cripMetodo, $cripSenha);
	return $valor;
}
function descriptografar($valor) {
	global $cripMetodo, $cripSenha;
	$valor = openssl_decrypt($valor, $cripMetodo, $cripSenha);
	return $valor;
}