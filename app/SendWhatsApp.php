<?php

function sendMsg(array $data){

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
            CURLOPT_POSTFIELDS => 'apikey=9aa31d55-616b-4ce9-93aa-ec22c91041e6&phone_number=5511968314087&contact_phone_number='.$data['phoneNumber'].'&message_custom_id='.$data['id'].'&message_type=text&message_body='.$data['text'].'&check_status=1&schedule='.$schedule.'&message_to_group=0',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/x-www-form-urlencoded'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
}

$dsn = 'mysql:dbname=mkradius;host=192.168.15.14';
$user = 'root';
$pass = 'vertrigo';

$dbh = new PDO($dsn, $user, $pass);

$phoneNumbers = $dbh->prepare('SELECT celular FROM sis_cliente where cli_ativado = ?');
$phoneNumbers->execute(['s']);
$i = 1;

while($result = $phoneNumbers->fetchObject()){
    $phoneNumber = "55".str_replace(['(',')', ' ', '-', '55', '+'], ['', '', '', ''], $result->celular);
    if(!is_null($result->celular) and strlen($phoneNumber) == 13){
        $data['phoneNumber'] = $phoneNumber;

        $data['id'] = '12345';    

        $data['text'] = 'Olá aqui é do suporte da DG Fiber, passando para avisar que o numero do suporte mudou para (11) 968314087. Pedimos para que altere na sua agenda, e pedimos desculpas pelo inconveniente.';

        $result = sendMsg($data);
        print_r($result);
    }
}


