<?php

use Mobizon\MobizonApi;


function sendSMS($array){
    $api = new MobizonApi($array['apiKey'], 'api.mobizon.com.br');

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
