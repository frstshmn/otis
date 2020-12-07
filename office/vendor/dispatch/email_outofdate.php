<?php
require('../config/email.php');
//Getting data from POST

$client_firm            = $_POST['department'];             //Client firm name
$sender                 = $_POST['sender_email'];           //Client email address
$phone                  = $_POST['phone'];                  //Client phone number
$address                = $_POST['address'];                //Client address
$web                    = $_POST['web'];                    //Client web-site

$car_firm               = $_POST['firm_name'];              //Car firm name
$recipient              = $_POST['recipient'];              //Car firm email address
$registration_number    = $_POST['registration_number'];    //Car registration number
$car_mark               = $_POST['car_mark'];               //Car mark
$car_model              = $_POST['car_model'];              //Car model

$sertification_date     = $_POST['sertification_date'];     //Last sertification date
$passing_date           = $_POST['passing_date'];           //Last technical chekc pass date

try{
$mail->setFrom('noreply@otis.co.ua', 'OTIS System');
$mail->addAddress($recipient);
$mail->addReplyTo($sender);
$mail->isHTML(true);
    if($sertification_date != NULL && $passing_date != NULL){
        $mail->Subject = $client_firm.' - Закінчується термін дії документів';
        $mail->Body = '<html><head><style>body{font-family: Tahoma;background-color: #f8f9fa;}.main_container{width: 800px;margin: 0 auto;}.header1{padding-top: 1em;padding-bottom: 1em;border-radius: 2em 2em 0 0;background-color: #343a40;text-align: center;color: #caccce;}.header2{padding-top: 2em;padding-bottom: 2em;border-radius: 0;background-color: #343a40;text-align: center;color: #1bc718;font-size: 1.5em;font-weight: bold;}.content{background-color: #fff;padding: 2em;font-size: 1.2em;text-align: justify;}.content_detail{padding: 0.8em 2em;font-size: 1.1em;color: #1bc718;font-weight: bold;background-color: white;}.info{display: inline-block;width: 100%;background-color: white;}table{padding: 2em;}th{background-color: #1bc718;}tr:hover{background-color: #e5ffe4;}td{text-align: center;}.col1{display: inline-block;width: 30%;padding: 0.8em 2em;}.col2{display: inline-block;font-weight: bold;}.signature{padding: 2em;background-color: #343a40;color: #caccce;border-radius: 0 0 2em 2em;}.opys{background-color: white;padding: 1em 2em;font-size: 0.8em;}a{text-decoration: none;color: #1bc718;}.signature a{text-decoration: none;color: #caccce;}.signature a:hover{text-decoration: none;color: #fff;}img{width: 15%;vertical-align: middle;padding-bottom: 1em;}</style></head><body><div class="main_container"><div class="header1"><a href="https://otis.co.ua"><img src="https://otis.co.ua/img/logo.png"></a> - онлайн-система обліку ТО та сертифікатів транспортних засобів</div><div class="header2">Шановний '.$car_firm.'!</div><div class="content">Звертаємо увагу, що у Вашого транспортного засобу незабаром закінчиться термін дії документів, а саме:</div><div class="content_detail">Інформація про авто:</div><table cellspacing="0" cellpadding="10" border="0" width="100%"><tr><th>Марка</th><th>Модель</th><th>Держномер</th><th>ТО<br>дійсний до</th><th>Сертифікат<br>дійсний до</th></tr><tr><td>'.$car_mark.'</td><td>'.$car_model.'</td><td>'.$registration_number.'</td><td>'.$passing_date.'</td><td>'.$sertification_date.'</td></tr></table><div class="content"><p>Для продовження дії документів, будь ласка, зателефонуйте нам, або завітайте до нас в офіс. Із задоволенням надамо повну інформацію щодо умов та термінів.</p><p>Дякуємо, що користуєтесь нашими послугами.</p></div><div class="opys">* УВАГА! Цей лист відправлено системою <b><a href="https://otis.co.ua">OTIS</a></b> автоматично з метою ознайомлення. Відповідати на нього <b>НЕ ПОТРІБНО!</b></div><div class="signature">----------------------<br>З повагою,<br><b>'.$client_firm.'</b><br>тел. '.$phone.'<br>'.$address.'<br><b><a href="'.$web.'">'.$web.'</a></b></div></div></body></html>';
    }
    else{
        echo 'Перевірте правильність введення дат';
    }

    $mail->send();
    echo 'Повідомлення успішно надіслано';
}

catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}