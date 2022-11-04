<?php
function acessoAPI() {
	global $usuario, $senha, $sql, $resultado, $conexao, $numero, $registro, $http;

	//Abre o banco
	$sql = "SELECT * FROM erp WHERE usuario = '$usuario' and senha = '$senha'";
	$simples = $conexao->prepare($sql);
	$simples->execute();
	$registro = $simples->fetch();
	$numero = $simples->rowCount();

	//Confere o login e senha
	if ($usuario && $senha) {
		if ($_SERVER['PHP_AUTH_USER'] == $registro["usuario"] && $_SERVER['PHP_AUTH_PW'] == $registro["senha"]) {
		//echo json_encode(array('aviso' => 'Dados ok!'));
		} else {
		header($http." 500");
		die(json_encode(array('aviso' => 'Verifique o acesso, dados errados.')));
		}
	} else {
		header($http." 401");
		die(json_encode(array('aviso' => 'Sem acesso. Tem login e senha?')));
	}
}

function urlAPI() {
	global $caminho, $local, $acao, $token, $chave;
	//Pega a URL e explode
	$caminho = explode('/', $_SERVER["REQUEST_URI"]);
	$local = $caminho[2];
	$acao  = $caminho[3];
	$chave = $caminho[4];
	$token = $caminho[4];
	//echo $local."-".$acao."-".$token."-".$chave;
}

function chave() {
	return aleatorio(30,false)."-".base64_encode(date("Y/m/d h:i:sa"));
}

function arquivo() {
	global $local, $arquivo, $usuario, $chave, $token, $localJson;
	if ($local === "condominos") {
		$arquivo = $localJson.$usuario.'_'.$chave.'.json';
	} else if ($local === "condominio"){
		$arquivo = $localJson.$usuario.'_'.$token.'_condominio.json';
	}
	// echo "arquivo: ".$arquivo;
}

function capturacondominio() {

}

function findById($vector, $param1) {
	$encontrado = -1;
	foreach($vector as $key => $obj){          
	if($obj['id'] == $param1){
		$encontrado = $key;
		break;
	}
	}
	return $encontrado;
}

function gerador($tamanho = 8, $maiusculas = true, $numeros = true, $simbolos = false) {
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

function valida($tipo, $corpo, $verbo) {
	global $http,$simples,$conexao,$resultado,$numero,$documento,$registro,$erp;
	switch ($tipo) {
		case "cartao":
				if (count($corpo) <> 8) {
					header($http." 400");
					die(json_encode(array('erro' => 'Quantidade errada de informações')));
				} else {
					header($http." 400");
					echo $corpo['idcondomino'] ? "" : die(json_encode(array('erro' => 'Sem idcondomino')));
					echo $corpo['chave'] ? "" : die(json_encode(array('erro' => 'Sem chave')));
					echo $corpo['bandeira'] ? "" : die(json_encode(array('erro' => 'Sem bandeira')));
					echo $corpo['documento'] ? "" : die(json_encode(array('erro' => 'Sem documento')));
					echo $corpo['nome'] ? "" : die(json_encode(array('erro' => 'Sem nome')));
					echo $corpo['numero'] ? "" : die(json_encode(array('erro' => 'Sem numero')));
					echo $corpo['validade'] ? "" : die(json_encode(array('erro' => 'Sem validade')));
					echo $corpo['cvv'] ? "" : die(json_encode(array('erro' => 'Sem cvv')));
				}
			break;
		case "boleto":
			if (!$corpo["tipo"]) { header($http." 400"); die(json_encode(array('erro' => 'Defina o tipo'))); }
			if (!$corpo["externo"]) { header($http." 400"); die(json_encode(array('erro' => 'Defina um valor externo'))); }
			if (!$corpo["chave"]) { header($http." 400"); die(json_encode(array('erro' => 'Defina a chave do condominio'))); }
			if (!$corpo["consumidor"]["documento"]) { header($http." 400"); die(json_encode(array('erro' => 'Envie o documento'))); }
			if (!cpf($corpo["consumidor"]["documento"])) { header($http." 400"); die(json_encode(array('erro' => 'Documento invalido'))); }
			/* Faz a validacao se o documento exite no banco de dados */
			$documento = limpanumero($corpo["consumidor"]["documento"]);
			$documento = criptografar($documento);
			$simples = $conexao->prepare("SELECT id,nome,documento FROM condominos WHERE documento = '$documento'");
			$simples->execute();
			// $resultado = $simples->fetch();
			$numero = $simples->rowCount();
			echo $numero ? "" : die(json_encode(array('aviso' => 'Cadastro nao encontrado com esse documento')));
			/* Fim da validacao se o documento exite no banco de dados */
			break;
		case "condominio":
			if (count($corpo) <> 12) {
				header($http." 400");
				die(json_encode(array('erro' => 'Quantidade errada de informacoes')));
			} else {
				header($http." 400");
				echo $corpo['condominio'] ? "" : die(json_encode(array('erro' => 'Sem condominio')));
				echo $corpo['cep'] ? "" : die(json_encode(array('erro' => 'Sem cep')));
				echo $corpo['logradouro'] ? "" : die(json_encode(array('erro' => 'Sem logradouro')));
				echo $corpo['bairro'] ? "" : die(json_encode(array('erro' => 'Sem bairro')));
				echo $corpo['cidade'] ? "" : die(json_encode(array('erro' => 'Sem cidade')));
				echo $corpo['estado'] ? "" : die(json_encode(array('erro' => 'Sem estado')));
				echo $corpo['telefone'] ? "" : die(json_encode(array('erro' => 'Sem telefone')));
				echo $corpo['documento'] ? "" : die(json_encode(array('erro' => 'Sem documento')));
				echo $corpo['banco'] ? "" : die(json_encode(array('erro' => 'Sem banco')));
				echo $corpo['agencia'] ? "" : die(json_encode(array('erro' => 'Sem agencia')));
				echo $corpo['conta'] ? "" : die(json_encode(array('erro' => 'Sem conta')));
			}
			break;
		case "condomino":
			if (count($corpo) <> 8) {
				header($http." 400");
				die(json_encode(array('erro' => 'Quantidade errada de informações')));
			} else {
				header($http." 400");
				echo $corpo['chave'] ? "" : die(json_encode(array('erro' => 'Sem chave')));
				echo $corpo['nome'] ? "" : die(json_encode(array('erro' => 'Sem nome')));
				echo $corpo['apartamento'] ? "" : die(json_encode(array('erro' => 'Sem apartamento')));
				echo $corpo['bloco'] ? "" : die(json_encode(array('erro' => 'Sem bloco')));
				echo $corpo['telefone'] ? "" : die(json_encode(array('erro' => 'Sem telefone')));
				// echo $corpo['email'] ? "" : die(json_encode(array('erro' => 'Sem email')));
				echo $corpo['documento'] ? "" : die(json_encode(array('erro' => 'Sem documento')));
			}
			break;
	}

}

function validametodo($verbo, $acao) {
	global $http,$metodo,$acao;
	// die(json_encode(array('verbo' => $verbo, 'metodo' => $metodo,  'acao' => $acao)));
	if ($acao == "listar" || $acao == "ver") {
		// header($http." 405");
		echo ($verbo == "GET") ? "" : die(json_encode(array('erro' => 'Metodo nao compativel. Use GET.')));
	} elseif ($acao == "apagar") {
		header($http." 405");
		echo ($verbo == "DELETE") ? "" : die(json_encode(array('erro' => 'Metodo nao compativel. Use DELETE.')));
	} elseif ($acao == "alterar") {
		header($http." 405");
		echo ($verbo == "PUT") ? "" : die(json_encode(array('erro' => 'Metodo nao compativel. Use PUT!')));
	} elseif (empty($acao)) {
		echo ($verbo == "POST") ? "" : die(json_encode(array('erro' => 'Metodo nao compativel. Use POST.')));
	}
}

function validaboleto($interno) {
	global $simples,$conexao,$resultado,$numero;
	$simples = $conexao->prepare("SELECT estado,interno FROM boleto WHERE interno = '$interno' AND estado = '1'");
	$simples->execute();
	$numero = $simples->rowCount();
	echo $numero ? "" : die(json_encode(array('aviso' => 'Boleto apagado ou inexistente')));
}

function cpfOuCnpj($cpfoucnpj, $tabela) {
	global $http;
    if(strlen($cpfoucnpj) == 11) { //Caso seja CNPJ
        // return cpf($cpfoucnpj);
	    if (!cpf($cpfoucnpj)) { header($http." 400"); die(json_encode(array('erro' => 'Documento CPF invalido'))); } else { documentoverifica(criptografar($cpfoucnpj), $tabela); }
		// die();
    } elseif(strlen($cpfoucnpj) == 14) { //Caso seja CPF
        // return cnpj($cpfoucnpj);
	    if (!cnpj($cpfoucnpj)) { header($http." 400"); die(json_encode(array('erro' => 'Documento CNPJ invalido'))); } else { /*documentoverifica(criptografar($cpfoucnpj), $tabela);*/ }
		// die();
    } else {
		header($http." 400"); die(json_encode(array('erro' => 'Documento invalido.')));
		// die();
	}
}

function cpf($cpf) {
	$cpf = "$cpf";
	if (strpos($cpf, "-") !== false)
	{
		$cpf = str_replace("-", "", $cpf);
	}
	if (strpos($cpf, ".") !== false)
	{
		$cpf = str_replace(".", "", $cpf);
	}
	$sum = 0;
	$cpf = str_split( $cpf );
	$cpftrueverifier = array();
	$cpfnumbers = array_splice( $cpf , 0, 9 );
	$cpfdefault = array(10, 9, 8, 7, 6, 5, 4, 3, 2);
	for ( $i = 0; $i <= 8; $i++ )
	{
		$sum += $cpfnumbers[$i]*$cpfdefault[$i];
	}
	$sumresult = $sum % 11;  
	if ( $sumresult < 2 )
	{
		$cpftrueverifier[0] = 0;
	}
	else
	{
		$cpftrueverifier[0] = 11-$sumresult;
	}
	$sum = 0;
	$cpfdefault = array(11, 10, 9, 8, 7, 6, 5, 4, 3, 2);
	$cpfnumbers[9] = $cpftrueverifier[0];
	for ( $i = 0; $i <= 9; $i++ )
	{
		$sum += $cpfnumbers[$i]*$cpfdefault[$i];
	}
	$sumresult = $sum % 11;
	if ( $sumresult < 2 )
	{
		$cpftrueverifier[1] = 0;
	}
	else
	{
		$cpftrueverifier[1] = 11 - $sumresult;
	}
	$returner = false;
	if ( $cpf == $cpftrueverifier )
	{
		$returner = true;
	}


	$cpfver = array_merge($cpfnumbers, $cpf);

	if ( count(array_unique($cpfver)) == 1 || $cpfver == array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 0) )

	{
		$returner = false;
	}
	return $returner;
}

function documentoverifica($documento, $tabela) {
	global $simples,$conexao,$resultado,$numero;
	if ($tabela == "condominos") {
		$simples = $conexao->prepare("SELECT nome,documento FROM condominos WHERE documento = '$documento'");
	} elseif ($tabela == "condominios") {
		$simples = $conexao->prepare("SELECT condominio,documento FROM condominios WHERE documento = '$documento'");
	}
	$simples->execute();
	$resultado = $simples->fetch();
	$numero = $simples->rowCount();
	// echo "Veja: ".$numero;
	echo $numero ? die(json_encode(array('aviso' => 'Já existe um cadastro com esse Documento'))) : "";
}

/*
function cpfverifica($cpf)
{
	global $simples,$conexao,$resultado,$numero;
	$simples = $conexao->prepare("SELECT nome,documento FROM condominos WHERE documento = '$cpf'");
	$simples->execute();
	$resultado = $simples->fetch();
	$numero = $simples->rowCount();
	// echo "Veja: ".$numero;
	echo $numero ? die(json_encode(array('aviso' => 'Já existe um cadastro com esse Documento'))) : "";
}
*/

function cnpj($cnpj) {
	$cnpj = preg_replace('/[^0-9]/', '', (string) $cnpj);
	
	// Valida tamanho
	if (strlen($cnpj) != 14)
		return false;

	// Verifica se todos os digitos são iguais
	if (preg_match('/(\d)\1{13}/', $cnpj))
		return false;	

	// Valida primeiro dígito verificador
	for ($i = 0, $j = 5, $soma = 0; $i < 12; $i++)
	{
		$soma += $cnpj[$i] * $j;
		$j = ($j == 2) ? 9 : $j - 1;
	}

	$resto = $soma % 11;

	if ($cnpj[12] != ($resto < 2 ? 0 : 11 - $resto))
		return false;

	// Valida segundo dígito verificador
	for ($i = 0, $j = 6, $soma = 0; $i < 13; $i++)
	{
		$soma += $cnpj[$i] * $j;
		$j = ($j == 2) ? 9 : $j - 1;
	}

	$resto = $soma % 11;

	return $cnpj[13] == ($resto < 2 ? 0 : 11 - $resto);
}

function cartao($cardNumber) {
    $charMapping = ['0' => 0, '1' => 1, '2' => 2, '3' => 3, '4' => 4, '5' => 5, '6' => 6, '7' => 7, '8' => 8, '9' => 9, 'A' => 10, 'B' => 11, 'C' => 12, 'D' => 13, 'E' => 14, 'F' => 15, 'G' => 16, 'H' => 17, 'I' => 18, 'J' => 19, 'K' => 20, 'L' => 21, 'M' => 22, 'N' => 23, 'O' => 24, 'P' => 25, 'Q' => 26, 'R' => 27, 'S' => 28, 'T' => 29, 'U' => 30, 'V' => 31, 'W' => 32, 'X' => 33, 'Y' => 34, 'Z' => 35];
    $cardNumber = array_reverse(str_split(strtoupper($cardNumber)));
    $sum = 0;
    $secondDigit = false;
    foreach ($cardNumber as $char) {

        $value = $charMapping[$char];
        if ($secondDigit) {
            $value = $value*2;
            if ($value>9){
                $value = $value-9;
            }
        }
        $sum = $sum+$value;
        $secondDigit = !$secondDigit;
    }
    return ($sum % 10) == 0;
}

function busca($tipo, $documento, $chave) {
	global $simples, $conexao, $resultado, $numero, $http;
	switch ($tipo) {
		case "condominio":
			// echo "Dados na função busca: ".$tipo . $documento. $chave;
			if ($chave) {
				// echo "Chaveta: " . $chave . "documento" . $documento;
				$simples = $conexao->prepare("SELECT chave FROM condominios WHERE chave = '$chave'");
			} else {
				// echo "Sem chave";
				$simples = $conexao->prepare("SELECT documento FROM condominios WHERE documento = '$documento'");
			}
			$simples->execute();
			$resultado = $simples->fetch();
			$numero = $simples->rowCount();
			if ($numero) {
				header($http." 400");
				echo json_encode(array('aviso' => 'Condominio já cadastrado com esse numero de documento'));
				die();
			}
      		// echo $numero ? json_encode(array('aviso' => 'Condominio já cadastrado com esse numero de documento')) : json_encode(array('aviso' => 'Vai fundo'));
			// echo $resultado["cep"]." (".$numero." registro, claro)";
			break;
		case "cartao":
			echo "cartao";
			break;
		case "boleto":
			echo "boleto";
			break;
		default:
			echo "Default";
	}
}

function condominio($chave) {
	global $simples, $conexao, $resultado, $numero, $http;
	$simples = $conexao->prepare("SELECT condominios.condominio,condominios.chave FROM condominios WHERE chave = '$chave'");
	$simples->execute();
	$resultado = $simples->fetch();
	$numero = $simples->rowCount();
	// echo $chave." > ".$numero . " > " . $resultado["condominio"];
	if ($numero) {
		// header($http." 400");
		// echo json_encode(array('aviso' => 'Condominio já cadastrado com esse numero de documento'));
		// die();
	} else {
		header($http." 400");
		echo json_encode(array('aviso' => 'Condominio nao encontrado'));
		die();
	}
}

function verificatipo($verificar) {
    global $tipo,$http;
    if (in_array($verificar, $tipo)) {
    } else {
        header($http." 405");
        die( json_encode(array('aviso' => 'Esse metodo de pagamento nao existe.')) );  
    }
}