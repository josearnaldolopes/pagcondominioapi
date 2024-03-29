<?php
//Pega os dados no sistema do Pag Condominio
include "../../app/variaveis.php";
include "../../app/constants.php";
include "../../app/conexao.php";
include "../../app/function.php";
include "../includes/variaveis.php";
include "../includes/functions.php";

//acessoAPI();

$sql = $conexao->prepare("SELECT boleto.id,boleto.body FROM boleto WHERE boleto.id = '$a'");
$sql->execute();
$boleto = $sql->fetch();
$numero = $sql->rowCount();
//echo $boleto["body"];
$body = json_decode($boleto["body"], true);
//echo $body["consumidor"]["nome"];
//echo $body["pagamento"]["descricao"];

$numero_documento = str_pad($boleto["id"], 12, 0, STR_PAD_LEFT);

//Soma os valores e multiplica a quantidade informada no boleto
foreach ($body['produtos'] as $valores){
    $valor += $valores["valor"] * $valores["quantidade"];
}

//Lista as mensagens
foreach ($body['pagamento']['mensagens'] as $mensagem){
    $mensagens = $mensagem. "\n";
}

?>
</html>
<!DOCTYPE HTML>
<html lang="pt-br">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
    <meta name="robots" content="noindex">
    <style>
        body {
            font-family: "Arial";
        }

        @media print {
            .no-print,
            .no-print * {
                display: none !important;
            }
        }

        .document {
            /*margin: auto auto;*/
            width: 216mm;
            /*height: 108mm;*/
            background-color: #fff;
        }

        .headerBtn {
            margin: auto auto;
            width: 216mm;
            background-color: #fff;
            display: none;
        }

        table {
            width: 100%;
            position: relative;
            border-collapse: collapse;
            border-style: solid;
            border-width: 2px;
        }

        .bankLogo {
            width: 28%;
        }

        .boletoNumber {
            width: 62%;
            font-weight: bold;
        }

        .center {
            text-align: center;
        }

        .right {
            text-align: right;
            right: 20px;
        }

        td {
            position: relative;
            padding: 4px;
            border-style: solid;
            border-width: 2px;
        }

        td span {
            padding: 4px;
        }

        .title {
            position: absolute;
            left: 0px;
            top: 0px;
            font-size: 12px;
            font-weight: bold;
        }

        .text {
            font-size: 12px;
        }

        p.content {
            padding: 0px;
            width: 100%;
            margin: 0px;
            font-size: 12px;
        }

        .sideBorders {
            border-left: 1px solid black;
            border-right: 1px solid black;
        }

        hr {
            size: 1;
            border: 1px dashed;
        }

        br {
            content: " ";
            display: block;
            margin: 12px 0;
            line-height: 12px;
        }

        .print {
            /* TODO(dbeam): reconcile this with overlay.css' .default-button. */
            background-color: rgb(77, 144, 254);
            background-image: linear-gradient(to bottom, rgb(77, 144, 254), rgb(71, 135, 237));
            border: 1px solid rgb(48, 121, 237);
            color: #fff;
            text-shadow: 0 1px rgba(0, 0, 0, 0.1);
        }

        .btnDefault {
            font-kerning: none;
            font-weight: bold;
        }

        .btnDefault:not(:focus):not(:disabled) {
            border-color: #808080;
        }

        button {
            border: 1px;
            padding: 5px;
            line-height: 20px;
        }


    
    i[class*=icss-]{position:relative;display:inline-block;font-style:normal;background-color:currentColor;-webkit-box-sizing:border-box;box-sizing:border-box;vertical-align:middle}i[class*=icss-]:after,i[class*=icss-]:before{content:"";border-width:0;position:absolute;-webkit-box-sizing:border-box;box-sizing:border-box}i.icss-print{width:.68em;height:1em;border-style:solid;border-color:currentcolor;border-width:.07em;-webkit-border-radius:.05em;border-radius:.05em;background-color:transparent;margin:0 .17em}i.icss-print:before{width:1em;height:.4em;border-width:.07em .21em 0;border-style:solid;border-color:currentColor currentcolor transparent;-webkit-border-radius:.05em .05em 0 0;border-radius:.05em .05em 0 0;top:.25em;left:50%;-webkit-transform:translateX(-50%);-ms-transform:translateX(-50%);transform:translateX(-50%);background-image:-webkit-gradient(linear,left top,left bottom,color-stop(20%,transparent),color-stop(20%,currentcolor),color-stop(60%,currentcolor),color-stop(60%,transparent));background-image:-webkit-linear-gradient(transparent 20%,currentcolor 20%,currentcolor 60%,transparent 60%);background-image:-o-linear-gradient(transparent 20%,currentcolor 20%,currentcolor 60%,transparent 60%);background-image:linear-gradient(transparent 20%,currentcolor 20%,currentcolor 60%,transparent 60%)}i.icss-print:after{width:.45em;height:.065em;background-color:currentColor;left:50%;-webkit-transform:translateX(-50%);-ms-transform:translateX(-50%);transform:translateX(-50%);top:.6em;-webkit-box-shadow:0 .12em,-.1em -.28em 0 .05em;box-shadow:0 .12em,-.1em -.28em 0 .05em}i.icss-files{width:.75em;height:.95em;background-color:transparent;border:.05em solid transparent;border-width:0 .05em .05em 0;-webkit-box-shadow:inset 0 0 0 .065em,.13em .11em 0 -.05em;box-shadow:inset 0 0 0 .065em,.13em .11em 0 -.05em;-webkit-border-radius:0 .3em 0 0;border-radius:0 .3em 0 0;margin:0 .17em .05em .1em}i.icss-files:before{border-style:solid;border-width:.2em;top:.037em;left:.25em;-webkit-border-radius:.1em;border-radius:.1em;border-color:transparent currentColor transparent transparent;-webkit-transform:rotate(-45deg);-ms-transform:rotate(-45deg);transform:rotate(-45deg)}
    </style>   
        <style>
        barcode.upc-a {
        display: block;
        width: 100%;
        height: 10vh;
        background: #fff;
        border: 4.8vh solid #fff;
        font-size: 0;
        }

        barcode.upc-a * {
        position: relative;
        display: inline-block;
        margin: 0;
        }

        barcode.upc-a upc-reset {
        width: 2.5263157895vh;
        height: 100%;
        background: linear-gradient(to right, #fff 0%, #fff 20%, #000 20%, #000 40%, #fff 40%, #fff 60%, #000 60%, #000 80%, #fff 80%, #fff 100%);
        }

        barcode.upc-a upc-digit {
        width: 3.5368421053vh;
        height: 100%;
        /*margin-bottom: 1.5vh;*/
        }

        barcode.upc-a upc-reset:first-of-type,
        barcode.upc-a upc-reset:last-of-type {
        width: 1.5157894737vh;
        background: linear-gradient(to right, #000 0%, #000 33.333%, #fff 33.333%, #fff 66.667%, #000 66.667%, #000 100%);
        }

        barcode.upc-a upc-digit:first-of-type,
        barcode.upc-a upc-digit:last-of-type {
        height: 100%;
        margin: 0;
        }

        barcode.upc-a upc-digit[data-val="0"]:nth-of-type(-n + 6) {
        background: linear-gradient(to right, #fff 0%, #fff 42.8571%, #000 42.8571%, #000 71.4285%, #fff 71.4285%, #fff 85.7142%, #000 85.7142%, #000 100%);
        }
        barcode.upc-a upc-digit[data-val="0"]:nth-of-type(n + 7) {
        background: linear-gradient(to right, #000 0%, #000 42.8571%, #fff 42.8571%, #fff 71.4285%, #000 71.4285%, #000 85.7142%, #fff 85.7142%, #fff 100%);
        }

        barcode.upc-a upc-digit[data-val="1"]:nth-of-type(-n + 6) {
        background: linear-gradient(to right, #fff 0%, #fff 28.5714%, #000 28.5714%, #000 57.1428%, #fff 57.1428%, #fff 85.7142%, #000 85.7142%, #000 100%);
        }
        barcode.upc-a upc-digit[data-val="1"]:nth-of-type(n + 7) {
        background: linear-gradient(to right, #000 0%, #000 28.5714%, #fff 28.5714%, #fff 57.1428%, #000 57.1428%, #000 85.7142%, #fff 85.7142%, #fff 100%);
        }

        barcode.upc-a upc-digit[data-val="2"]:nth-of-type(-n + 6) {
        background: linear-gradient(to right, #fff 0%, #fff 28.5714%, #000 28.5714%, #000 42.8571%, #fff 42.8571%, #fff 71.4285%, #000 71.4285%, #000 100%);
        }
        barcode.upc-a upc-digit[data-val="2"]:nth-of-type(n + 7) {
        background: linear-gradient(to right, #000 0%, #000 28.5714%, #fff 28.5714%, #fff 42.8571%, #000 42.8571%, #000 71.4285%, #fff 71.4285%, #fff 100%);
        }

        barcode.upc-a upc-digit[data-val="3"]:nth-of-type(-n + 6) {
        background: linear-gradient(to right, #fff 0%, #fff 14.2857%, #000 14.2857%, #000 71.4285%, #fff 71.4285%, #fff 85.7142%, #000 85.7142%, #000 100%);
        }
        barcode.upc-a upc-digit[data-val="3"]:nth-of-type(n + 7) {
        background: linear-gradient(to right, #000 0%, #000 14.2857%, #fff 14.2857%, #fff 71.4285%, #000 71.4285%, #000 85.7142%, #fff 85.7142%, #fff 100%);
        }

        barcode.upc-a upc-digit[data-val="4"]:nth-of-type(-n + 6) {
        background: linear-gradient(to right, #fff 0%, #fff 14.2857%, #000 14.2857%, #000 28.5714%, #fff 28.5714%, #fff 71.4285%, #000 71.4285%, #000 100%);
        }
        barcode.upc-a upc-digit[data-val="4"]:nth-of-type(n + 7) {
        background: linear-gradient(to right, #000 0%, #000 14.2857%, #fff 14.2857%, #fff 28.5714%, #000 28.5714%, #000 71.4285%, #fff 71.4285%, #fff 100%);
        }

        barcode.upc-a upc-digit[data-val="5"]:nth-of-type(-n + 6) {
        background: linear-gradient(to right, #fff 0%, #fff 14.2857%, #000 14.2857%, #000 42.8571%, #fff 42.8571%, #fff 85.7142%, #000 85.7142%, #000 100%);
        }
        barcode.upc-a upc-digit[data-val="5"]:nth-of-type(n + 7) {
        background: linear-gradient(to right, #000 0%, #000 14.2857%, #fff 14.2857%, #fff 42.8571%, #000 42.8571%, #000 85.7142%, #fff 85.7142%, #fff 100%);
        }

        barcode.upc-a upc-digit[data-val="6"]:nth-of-type(-n + 6) {
        background: linear-gradient(to right, #fff 0%, #fff 14.2857%, #000 14.2857%, #000 28.5714%, #fff 28.5714%, #fff 42.8571%, #000 42.8571%, #000 100%);
        }
        barcode.upc-a upc-digit[data-val="6"]:nth-of-type(n + 7) {
        background: linear-gradient(to right, #000 0%, #000 14.2857%, #fff 14.2857%, #fff 28.5714%, #000 28.5714%, #000 42.8571%, #fff 42.8571%, #fff 100%);
        }

        barcode.upc-a upc-digit[data-val="7"]:nth-of-type(-n + 6) {
        background: linear-gradient(to right, #fff 0%, #fff 14.2857%, #000 14.2857%, #000 57.1428%, #fff 57.1428%, #fff 71.4285%, #000 71.4285%, #000 100%);
        }
        barcode.upc-a upc-digit[data-val="7"]:nth-of-type(n + 7) {
        background: linear-gradient(to right, #000 0%, #000 14.2857%, #fff 14.2857%, #fff 57.1428%, #000 57.1428%, #000 71.4285%, #fff 71.4285%, #fff 100%);
        }

        barcode.upc-a upc-digit[data-val="8"]:nth-of-type(-n + 6) {
        background: linear-gradient(to right, #fff 0%, #fff 14.2857%, #000 14.2857%, #000 42.8571%, #fff 42.8571%, #fff 57.1428%, #000 57.1428%, #000 100%);
        }
        barcode.upc-a upc-digit[data-val="8"]:nth-of-type(n + 7) {
        background: linear-gradient(to right, #000 0%, #000 14.2857%, #fff 14.2857%, #fff 42.8571%, #000 42.8571%, #000 57.1428%, #fff 57.1428%, #fff 100%);
        }

        barcode.upc-a upc-digit[data-val="9"]:nth-of-type(-n + 6) {
        background: linear-gradient(to right, #fff 0%, #fff 42.8571%, #000 42.8571%, #000 57.1428%, #fff 57.1428%, #fff 71.4285%, #000 71.4285%, #000 100%);
        }
        barcode.upc-a upc-digit[data-val="9"]:nth-of-type(n + 7) {
        background: linear-gradient(to right, #000 0%, #000 42.8571%, #fff 42.8571%, #fff 57.1428%, #000 57.1428%, #000 71.4285%, #fff 71.4285%, #fff 100%);
        }

        /*
        barcode.upc-a upc-digit::after {
        position: absolute;
        content: attr(data-val);
        font-family: mono;
        font-size: 3vh;
        bottom: -3.75vh;
        margin-left: 0.96vh;
        }
        */

        barcode.upc-a upc-digit:first-of-type::after {
        bottom: 0;
        left: -4.8vh;
        }

        barcode.upc-a upc-digit:last-of-type::after {
        bottom: 0;
        right: -4.08vh;
        }
    </style>
</head>

<body>
    <br/>
    <div class="document">
        <table cellspacing="0" cellpadding="0">
            <tr class="topLine">
                <td class="bankLogo">
                    <img src="data:image/png;base64,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"
                        alt="">
                </td>
                <td class="sideBorders center"><span style="font-size:24px;font-weight:bold;">341-7</span></td>
                <td class="boletoNumber center"><span>34191.12345 67890.101112 13141.516171 8 12345678901112</span></td>
            </tr>
        </table>
        <table cellspacing="0" cellpadding="0">
            <tr>
                <td width="70%" colspan="6">
                    <span class="title">Local de Pagamento</span>
                    <br/>
                    <span class="text">ATÉ O VENCIMENTO EM QUALQUER BANCO OU CORRESPONDENTE NÃO BANCÁRIO, APÓS O VENCIMENTO, PAGUE EM QUALQUER BANCO OU CORRESPONDENTE NÃO BANCÁRIO</span>
                </td>
                <td width="30%">
                    <span class="title">Data de Vencimento</span>
                    <br/>
                    <br/>
                    <p class="content right text" style="font-weight:bold;">01/01/2016</p>
                </td>
            </tr>
            <tr>
                <td width="70%" colspan="6">
                    <span class="title">Nome do Beneficiário / CNPJ / CPF / Endereço:</span>
                    <br/>
                    <table border="0" style="border:none">
                        <tr>
                            <td width="60%"><span class="text">Simulação</span></td>
                            <td><span class="text">CNPJ 01.000.000/0001-00</span></td>
                        </tr>
                    </table>
                    <br/>
                    <span class="text">Rua Simulação, 1 - Jardim Simulação - São Paulo - SP - 10000-000</span>
                </td>
                <td width="30%">
                    <span class="title">Agência/Código Beneficiário</span>
                    <br/>
                    <br/>
                    <p class="content right">1234/12345-1</p>
                </td>
            </tr>

            <tr>
                <td width="15%">
                    <span class="title">Data do Documento</span>
                    <br/>
                    <p class="content center">01/07/2015</p>
                </td>
                <td width="17%" colspan="2">
                    <span class="title">Num. do Documento</span>
                    <br/>
                    <p class="content center">1</p>
                </td>
                <td width="10%">
                    <span class="title">Espécie doc</span>
                    <br/>
                    <p class="content center">DM</p>
                </td>
                <td width="8%">
                    <span class="title">Aceite</span>
                    <br/>
                    <p class="content center">N</p>
                </td>
                <td>
                    <span class="title">Data Processamento</span>
                    <br/>
                    <p class="content center">01/07/2015</p>
                </td>
                <td width="30%">
                    <span class="title">Carteira/Nosso Número</span>
                    <br/>
                    <br/>
                    <p class="content right">157/12345678-9</p>
                </td>
            </tr>

            <tr>
                <td width="15%">
                    <span class="title">Uso do Banco</span>
                    <br/>
                    <p class="content center">&nbsp;</p>
                </td>
                <td width="10%">
                    <span class="title">Carteira</span>
                    <br/>
                    <p class="content center">157</p>
                </td>
                <td width="10%">
                    <span class="title">Espécie</span>
                    <br/>
                    <p class="content center">R$</p>
                </td>
                <td width="8%" colspan="2">
                    <span class="title">Quantidade</span>
                    <br/>
                    <p class="content center">N</p>
                </td>
                <td>
                    <span class="title">Valor</span>
                    <br/>
                    <p class="content center">10,00</p>
                </td>
                <td width="30%">
                    <span class="title">(=) Valor do Documento</span>
                    <br/>
                    <br/>
                    <p class="content right">10,00</p>
                </td>
            </tr>
            <tr>
                <td colspan="6" rowspan="4">
                    <span class="title">Instruções de responsabilidade do BENEFICIÁRIO. Qualquer dúvida sobre este boleto contate o beneficiário.</span>
                </td>
            </tr>
            <tr>
                <td>
                    <span class="title">(-) Descontos/Abatimento</span>
                    <br/>
                    <p class="content right">&nbsp;</p>
                </td>
            </tr>
            <tr>
                <td>
                    <span class="title">(+) Juros/Multa</span>
                    <br/>
                    <p class="content right">&nbsp;</p>
                </td>
            </tr>
            <tr>
                <td>
                    <span class="title">(=) Valor Pago</span>
                    <br/>
                    <p class="content right">&nbsp;</p>
                </td>
            </tr>
            <tr>
                <td colspan="7">
                    <table border="0" style="border:none">
                        <tr>
                            <td width="60%"><span class="text"><b>Nome do Pagador: </b> Pagador ABC</span></td>
                            <td><span class="text"><b>CNPJ/CPF: </b> 123.121.001-00</span></td>
                        </tr>
                        <tr>
                            <td><span class="text"><b>Endereço: </b> Avenida Brasil 1234 - Jardim Brasil - São Paulo - SP - 9999999-999</span></td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td><span class="text"><b>Sacador/Avalista: </b> &nbsp;</span></td>
                            <td><span class="text"><b>CNPJ/CPF: </b> &nbsp;</span></td>
                        </tr>
                    </table>

                </td>

            </tr>
        </table>
    </div>
    <div class="document">
        <hr/>
        <table cellspacing="0" cellpadding="0">
            <tr class="topLine">
                <td class="bankLogo">
                    <img src="data:image/png;base64,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"
                        alt="">
                </td>
                <td class="sideBorders center"><span style="font-size:24px;font-weight:bold;">341-7</span></td>
                <td class="boletoNumber center"><span>34191.12345 67890.101112 13141.516171 8 12345678901112</span></td>
            </tr>
        </table>
        <table cellspacing="0" cellpadding="0" border="1">
            <tr>
                <td width="70%" colspan="6">
                    <span class="title">Local de Pagamento</span>
                    <br/>
                    <span class="text">ATÉ O VENCIMENTO EM QUALQUER BANCO OU CORRESPONDENTE NÃO BANCÁRIO, APÓS O VENCIMENTO, PAGUE EM QUALQUER BANCO OU CORRESPONDENTE NÃO BANCÁRIO</span>
                </td>
                <td width="30%">
                    <span class="title">Data de Vencimento</span>
                    <br/>
                    <br/>
                    <p class="content right text" style="font-weight:bold;">01/01/2016</p>
                </td>
            </tr>
            <tr>
                <td width="70%" colspan="6">
                    <span class="title">Nome do Beneficiário / CNPJ / CPF / Endereço:</span>
                    <br/>
                    <table border="0" style="border:none">
                        <tr>
                            <td width="60%"><span class="text">Simulação</span></td>
                            <td><span class="text">CNPJ 01.000.000/0001-00</span></td>
                        </tr>
                    </table>
                    <br/>
                    <span class="text">Rua Simulação, 1 - Jardim Simulação - São Paulo - SP - 10000-000</span>
                </td>
                <td width="30%">
                    <span class="title">Agência/Código Beneficiário</span>
                    <br/>
                    <br/>
                    <p class="content right">1234/12345-1</p>
                </td>
            </tr>

            <tr>
                <td width="15%">
                    <span class="title">Data do Documento</span>
                    <br/>
                    <p class="content center">01/07/2015</p>
                </td>
                <td width="17%" colspan="2">
                    <span class="title">Num. do Documento</span>
                    <br/>
                    <p class="content center">1</p>
                </td>
                <td width="10%">
                    <span class="title">Espécie doc</span>
                    <br/>
                    <p class="content center">DM</p>
                </td>
                <td width="8%">
                    <span class="title">Aceite</span>
                    <br/>
                    <p class="content center">N</p>
                </td>
                <td>
                    <span class="title">Data Processamento</span>
                    <br/>
                    <p class="content center">01/07/2015</p>
                </td>
                <td width="30%">
                    <span class="title">Carteira/Nosso Número</span>
                    <br/>
                    <br/>
                    <p class="content right">157/12345678-9</p>
                </td>
            </tr>

            <tr>
                <td width="15%">
                    <span class="title">Uso do Banco</span>
                    <br/>
                    <p class="content center">&nbsp;</p>
                </td>
                <td width="10%">
                    <span class="title">Carteira</span>
                    <br/>
                    <p class="content center">157</p>
                </td>
                <td width="10%">
                    <span class="title">Espécie</span>
                    <br/>
                    <p class="content center">R$</p>
                </td>
                <td width="8%" colspan="2">
                    <span class="title">Quantidade</span>
                    <br/>
                    <p class="content center">N</p>
                </td>
                <td>
                    <span class="title">Valor</span>
                    <br/>
                    <p class="content center">10,00</p>
                </td>
                <td width="30%">
                    <span class="title">(=) Valor do Documento</span>
                    <br/>
                    <br/>
                    <p class="content right">10,00</p>
                </td>
            </tr>
            <tr>
                <td colspan="6" rowspan="4">
                    <span class="title">Instruções de responsabilidade do BENEFICIÁRIO. Qualquer dúvida sobre este boleto contate o beneficiário.</span>
                </td>
            </tr>
            <tr>
                <td>
                    <span class="title">(-) Descontos/Abatimento</span>
                    <br/>
                    <p class="content right">&nbsp;</p>
                </td>
            </tr>
            <tr>
                <td>
                    <span class="title">(+) Juros/Multa</span>
                    <br/>
                    <p class="content right">&nbsp;</p>
                </td>
            </tr>
            <tr>
                <td>
                    <span class="title">(=) Valor Pago</span>
                    <br/>
                    <p class="content right">&nbsp;</p>
                </td>
            </tr>
            <tr>
                <td colspan="7">
                    <table border="0" style="border:none">
                        <tr>
                            <td width="60%"><span class="text"><b>Nome do Pagador: </b> Pagador ABC</span></td>
                            <td><span class="text"><b>CNPJ/CPF: </b> 123.121.001-00</span></td>
                        </tr>
                        <tr>
                            <td><span class="text"><b>Endereço: </b> Avenida Brasil 1234 - Jardim Brasil - São Paulo - SP - 9999999-999</span></td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td><span class="text"><b>Sacador/Avalista: </b> &nbsp;</span></td>
                            <td><span class="text"><b>CNPJ/CPF: </b> &nbsp;</span></td>
                        </tr>
                    </table>

                </td>

            </tr>
        </table>
        <br/>
        <p>Barcode</p>
        <barcode class="upc-a">
            <upc-reset></upc-reset>
            <upc-digit data-val="0"></upc-digit>
            <upc-digit data-val="2"></upc-digit>
            <upc-digit data-val="2"></upc-digit>
            <upc-digit data-val="0"></upc-digit>
            <upc-digit data-val="0"></upc-digit>
            <upc-digit data-val="0"></upc-digit>
            <upc-reset></upc-reset>
            <upc-digit data-val="1"></upc-digit>
            <upc-digit data-val="2"></upc-digit>
            <upc-digit data-val="5"></upc-digit>
            <upc-digit data-val="0"></upc-digit>
            <upc-digit data-val="3"></upc-digit>
            <upc-digit data-val="3"></upc-digit>
            <upc-reset></upc-reset>
        </barcode>
        <img src="data:image/png;base64,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"
            alt="">
        <br/>
        <br/>
        <br/>
    </div>
</body>

</html>