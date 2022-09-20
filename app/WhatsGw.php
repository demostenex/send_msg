<?php
/*
    recebe array com as chaves apikey,phoneNumber,id,text
    retorna msg enviada ou não 
*/
function sendMsgWhatsApp(array $data){

    $curl = curl_init();
        $in = ['/',':',' '];
        $out = ['%2F','%3A','%20'];
        $schedule = str_replace($in, $out, date('Y/m/d H:i:s', strtotime('+10 seconds')));
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://app.whatsgw.com.br/api/WhatsGw/Send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => 'apikey='.$data['apikey'].'&phone_number='.$data['fromPhoneNumber'].'&contact_phone_number='.$data['phoneNumber'].'&message_custom_id='.$data['id'].'&message_type=text&message_body='.$data['text'].'&check_status=1&schedule='.$schedule.'&message_to_group=0',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/x-www-form-urlencoded'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
}


