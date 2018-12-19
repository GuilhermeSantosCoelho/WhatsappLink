<?php
    /* Função PHP que retorna a URL encurtada a partir dos dados recebidos via POST */

    $numero = $_POST['numero']; //Pega o número de telefone
    $texto = $_POST['texto']; // Pega o texto da mensagem

    $numero_novo = preg_replace('/[() -]+/' , '' , $numero); //Remove os símbolos da mascara de telefone
    $texto_novo = preg_replace('/[ -]+/' , '%20' , $texto); //Substitui os espaços da mensagem por %20 para a URL

    $url = ("https://api.whatsapp.com/send?phone=55".$numero_novo."%26text=".$texto_novo); //Gera a URL da API do Whatsapp

    $login = "seu_login"; //Seu login do Bit.ly
    $api_key = "sua_chave_de_api"; //Seu token de acesso do Bit.ly

    $ch = curl_init("http://api.bitly.com/v3/shorten?login=".$login."&apiKey=".$api_key."&longUrl=".$url);//Gera a URL da API do Bit.ly

    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true); //Definindo a opção de cURL

    $result = curl_exec($ch); //Obtendo o resultado da requisição

    $res = json_decode($result,true); //Decodificando a resposta em JSON

    echo $res['data']['url']; //Retornando somente a URL encurtada 
?>