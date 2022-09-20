<?php
require_once __DIR__.'/../vendor/autoload.php';

include 'WhatsGw.php';
include 'MobizonSMS.php';

//uso do whatsgw 
$data = [
    'apikey' => 'api-do-whatsgw',//coloque aqui a chave da api do whats gw
    'phoneNumber' => '5511xxxxxxxxx', //numero que receberá a msg com ddi e ddd ex 5511numero do telefone
    'id' => '12345', // numero de um id qualquer um para procurar na whatsgw depois
    'text' => "Texto que você pretende usar",
    'fromPhoneNumber' => '5511xxxxxxxxx',  //numero que enviara a msg previamente cadastrado no whatsgw com ddi e ddd 5511numero do telefone
];
$result = sendMsgWhatsApp($data);
print_r($result);
//fim do exemplo 

//uso do sms
$array = [
    'recipient' => '5511xxxxxxxxx',//numero que receberá o sms
    'text' => 'texto que pretende usar',
    'apiKey' => 'api-do-mobizon', //coloque aqui a chave da api obtida no mobizon.com.br
];
//sendSMS($array);
//fim do uso do mobizon