<?php
$cep         = $jsonBody['cep'];
$logradouro  = $jsonBody['logradouro'];
$numero 	 = $jsonBody['numero'];
$bairro 	 = $jsonBody['bairro'];
$cidade 	 = $jsonBody['cidade'];
$estado 	 = $jsonBody['estado'];
$condominio  = $jsonBody['condominio'];
$documento 	 = $jsonBody['documento'];
$banco 	     = $jsonBody['banco'];
$agencia 	 = $jsonBody['agencia'];
$conta 	     = $jsonBody['conta'];

$sql = "INSERT INTO condominios (cep,logradouro,numero,bairro,cidade,estado,condominio,documento,administradoraAPI,banco,agencia,conta,origem) VALUES ('$cep','$logradouro','$numero','$bairro','$cidade','$estado','$condominio','$documento','$administradora','$banco','$agencia','$conta','API')";

if ($conexao->query($sql) === TRUE) {
  	echo json_encode(array('aviso' => 'Adicionado com sucesso! Em até 7 dias úteis enviaremos o Token de acesso'));
} else {
    echo "Erro:" . $conexao->error;
}

/*----------- Envia o email avisando a requisicão -----------*/
$emailsender='contato@pagcondominio.com';
//$emailUser 	= $_COOKIE["userEmail"];
/* Verifica qual é o sistema operacional do servidor para ajustar o cabeçalho de forma correta. Não alterar */
if(PHP_OS == "Linux") $quebra_linha = "\n"; //Se for Linux
elseif(PHP_OS == "WINNT") $quebra_linha = "\r\n"; // Se for Windows
else die("Este script nao esta preparado para funcionar com o sistema operacional de seu servidor");
 
// Passando os dados obtidos pelo formulário para as variáveis abaixo
$nomeremetente     = "PagCondominio";
$emailremetente    = trim("contato@pagcondominio.com");
// $emaildestinatario = trim("acacio@pagcondominio.com");
$emaildestinatario = trim("josearnaldo.net@gmail.com");
// $comcopia          = trim("josearnaldo.net@gmail.com");
$assunto           = "Cadastro de Condominio [Requisição]";
$mensagem          = "<p>Um condominio foi cadastrado:</p><p>Condominio: ".$condominio."</p><p>Logradouro: ".$logradouro."</p><p>Endereço: ".$logradouro.", ".$numero .", ".$bairro.", ".$cidade."/".$estado."</p>
<p>Documento: ".$documento."</p><p>Banco: ".$banco." ".$agencia." ".$conta."</p>";

/* Montando a mensagem a ser enviada no corpo do e-mail. */
$mensagemHTML = $mensagem; 
 
/* Montando o cabeçalho da mensagem */
$headers = "MIME-Version: 1.1".$quebra_linha;
$headers .= "Content-type: text/html; charset=iso-8859-1".$quebra_linha;
// Perceba que a linha acima contém "text/html", sem essa linha, a mensagem não chegará formatada.
$headers .= "From: ".$emailsender.$quebra_linha;
$headers .= "Return-Path: " . $emailsender . $quebra_linha;
// Esses dois "if's" abaixo são porque o Postfix obriga que se um cabeçalho for especificado, deverá haver um valor.
// Se não houver um valor, o item não deverá ser especificado.
if(strlen($comcopia) > 0) $headers .= "Cc: ".$comcopia.$quebra_linha;
if(strlen($comcopiaoculta) > 0) $headers .= "Bcc: ".$comcopiaoculta.$quebra_linha;
$headers .= "Reply-To: ".$emailremetente.$quebra_linha;
// Note que o e-mail do remetente será usado no campo Reply-To (Responder Para)
 
/* Enviando a mensagem */
mail($emaildestinatario, $assunto, $mensagemHTML, $headers, "-r". $emailsender);
/*----------- Fim do email avisando a requisicão -----------*/

// echo json_encode(array('aviso' => 'Email enviado'));