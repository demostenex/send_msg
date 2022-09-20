<?php

require_once __DIR__.'/../vendor/autoload.php';

use Mobizon\MobizonApi;

$dsn = 'mysql:dbname=mkradius;host=192.168.15.14';
$user = 'root';
$pass = 'vertrigo';

function sendSMS($array){
    $api = new MobizonApi('br853431d377abb17cd94286da5701136446e6ccf6c540ea6aa0553a9bd7e2615112ba', 'api.mobizon.com.br');

    echo "Send Message..." .PHP_EOL;
    //$alphaname = 'Suporte DG';
    /*$arraySms = array(
        'recipient' => '5511941631498',
        'text' => 'Test sms message',
        //'from' => $alphaname,
        //Optional, if you don't have registered alphaname, just skip this param and your message will be sent with our free common alphaname.
    );*/

    if ($api->call('message',
        'sendSMSMessage',
        $array
        )
    ) {
        $messageId = $api->getData('messageId');
        echo 'Message created with ID:' . $messageId . PHP_EOL;

        if ($messageId) {
            echo 'Get message info...' . PHP_EOL;
            $messageStatuses = $api->call(
                'message',
                'getSMSStatus',
                array(
                    'ids' => array($messageId, '13394', '11345', '4393')
                ),
                array(),
                true
            );

            if ($api->hasData()) {
                foreach ($api->getData() as $messageInfo) {
                    echo 'Message # ' . $messageInfo->id . " status:\t" . $messageInfo->status . PHP_EOL;
                }
            }
        }
        return "Message scheduled.";
    } else {
        echo 'An error occurred while sending message: [' . $api->getCode() . '] ' . $api->getMessage() . 'See details below:' . PHP_EOL;
        var_dump(array($api->getCode(), $api->getData(), $api->getMessage()));
        return "Errors please verify";
    }
}

$dbh = new PDO($dsn, $user, $pass);

$phoneNumbers = $dbh->prepare('SELECT celular FROM sis_cliente where cli_ativado = ?');
$phoneNumbers->execute(['s']);
$i = 1;
while($result = $phoneNumbers->fetchObject()){
    $phoneNumber = "55".str_replace(['(',')', ' ', '-', '55', '+'], ['', '', '', ''], $result->celular);
    if(!is_null($result->celular) and strlen($phoneNumber) == 13){
        echo $i." ";
        echo "Caimos no if com o $phoneNumber".PHP_EOL;
        $array = [
            'recipient' => $phoneNumber,
            'text' => 'Olá aqui é do suporte da DG Fiber, passando para avisar que o numero do suporte mudou para (11) 968314087. Pedimos para que altere na sua agenda, e pedimos desculpas pelo inconveniente',
        ];
        sendSMS($array);
        $i++;
    }
    
}
/*$array = [
    'recipient' => '5511941631498',
    'text' => 'Ola aqui é do suporte da DG Fiber, passando para avisar que o numero do suporte mudou para (11) 968314087. Pedimos para que altere na sua agenda.',
];

sendSMS($array);*/