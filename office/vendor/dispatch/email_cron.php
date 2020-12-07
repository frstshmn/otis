<?php
    require_once('/home/inco/otis.co.ua/office/vendor/config/email.php');
    require_once('/home/inco/otis.co.ua/office/vendor/config/database.php');

    //connect to DB
    $mysql = (new Database())->connect();
    $mysql->set_charset("utf8");

    //email counter
    $success_count = 0;

    //select every firms from DB which have emails
    $firms = $mysql->query("SELECT firm.id_firm, firm.id_client, firm.name, firm.telephone, firm.email AS firm_email, users.id_client, users.email AS user_email, users.telephone_number, users.department, users.street, users.web_site FROM firm INNER JOIN users ON firm.id_client = users.id_client WHERE firm.email <> ''");
    $firms = $firms->fetch_all(MYSQLI_ASSOC);
    foreach ($firms as $firm) {
        global $firm;

        //select every car of this firm
        $cars = $mysql->query("SELECT cars.registration_number, cars.id_driver, firm.name, firm.telephone, brand_model.brand, brand_model.model, cars.vin_code, cars.date_of_passing, cars.next_passing_date, cars.date_of_receiving_sertificate, cars.next_sertification_date, cars.availability_sertificate, cars.sometext FROM cars INNER JOIN firm ON cars.id_firm = firm.id_firm INNER JOIN users ON firm.id_client = users.id_client INNER JOIN brand_model ON brand_model.id_model = cars.id_model WHERE cars.id_firm = '".$firm['id_firm']."'");
        $cars = $cars->fetch_all(MYSQLI_ASSOC);

        //push every car with expiring date into array
        $c = [];
        foreach ($cars as $car) {
            $days30 = new DateTime('now');
            $days30->add(new DateInterval('P30D'));
            $days14 = new DateTime('now');
            $days14->add(new DateInterval('P14D'));
            $date_of_passing = new DateTime(date($car['next_passing_date']));
            $sertification_date = new DateTime(date($car['next_sertification_date']));
        
            if ($date_of_passing < $days30 || $sertification_date < $days30 || $date_of_passing < $days14 || $sertification_date < $days14){
                array_push($c, array(
                    'brand' => $car['brand'], 
                    'model' => $car['model'], 
                    'registration_number' => $car['registration_number'], 
                    'next_passing_date' => $car['next_passing_date'], 
                    'next_sertification_date' => $car['next_sertification_date']
                ));
            }
        }

        //if car array is not empty - from a HTML <table> row and concate it to string $car_string
        $car_string = '';
        if (!empty($c)){
            foreach ($c as $car) {
                $car_string .= '<tr><td>'.$car['brand'].'</td><td>'.$car['model'].'</td><td>'.$car['registration_number'].'</td><td>'.$car['next_passing_date'].'</td><td>'.$car['next_sertification_date'].'</td></tr>';
            }
        }else{continue;}

        //trying to send emails
        $mail->setFrom('noreply@otis.co.ua', 'OTIS System');
        $mail->addAddress($firm['firm_email']);
        $mail->addReplyTo($firm['user_email']);
        $mail->isHTML(true);
        $mail->Subject = $client_firm.' - Закінчується термін дії документів';
        $mail->Body = '<html><head><style>body{font-family: Tahoma;background-color: #f8f9fa;}.main_container{width: 800px;margin: 0 auto;}.header1{padding-top: 1em;padding-bottom: 1em;border-radius: 2em 2em 0 0;background-color: #343a40;text-align: center;color: #caccce;}.header2{padding-top: 2em;padding-bottom: 2em;border-radius: 0;background-color: #343a40;text-align: center;color: #1bc718;font-size: 1.5em;font-weight: bold;}.content{background-color: #fff;padding: 2em;font-size: 1.2em;text-align: justify;}.content_detail{padding: 0.8em 2em;font-size: 1.1em;color: #1bc718;font-weight: bold;background-color: white;}.info{display: inline-block;width: 100%;background-color: white;}table{padding: 2em;}th{background-color: #1bc718;}tr:hover{background-color: #e5ffe4;}td{text-align: center;}.col1{display: inline-block;width: 30%;padding: 0.8em 2em;}.col2{display: inline-block;font-weight: bold;}.signature{padding: 2em;background-color: #343a40;color: #caccce;border-radius: 0 0 2em 2em;}.opys{background-color: white;padding: 1em 2em;font-size: 0.8em;}a{text-decoration: none;color: #1bc718;}.signature a{text-decoration: none;color: #caccce;}.signature a:hover{text-decoration: none;color: #fff;}img{width: 15%;vertical-align: middle;padding-bottom: 1em;}</style></head><body><div class="main_container"><div class="header1"><a href="https://otis.co.ua"><img src="https://otis.co.ua/img/logo.png"></a> - онлайн-система обліку ТО та сертифікатів транспортних засобів</div><div class="header2">Шановний '.$firm['name'].'!</div><div class="content">Звертаємо увагу, що у Вашого транспортного засобу незабаром закінчиться термін дії документів, а саме:</div><div class="content_detail">Інформація про авто:</div><table cellspacing="0" cellpadding="10" border="0" width="100%"><tr><th>Марка</th><th>Модель</th><th>Держномер</th><th>ТО<br>дійсний до</th><th>Сертифікат<br>дійсний до</th></tr>'.$car_string.'</table><div class="content"><p>Для продовження дії документів, будь ласка, зателефонуйте нам, або завітайте до нас в офіс. Із задоволенням надамо повну інформацію щодо умов та термінів.</p><p>Дякуємо, що користуєтесь нашими послугами.</p></div><div class="opys">* УВАГА! Цей лист відправлено системою <b><a href="https://otis.co.ua">OTIS</a></b> автоматично з метою ознайомлення. Відповідати на нього <b>НЕ ПОТРІБНО!</b></div><div class="signature">----------------------<br>З повагою,<br><b>'.$firm['department'].'</b><br>тел. '.$firm['telephone_number'].'<br>'.$firm['street'].'<br><b><a href="'.$firm['web_site'].'">'.$firm['web_site'].'</a></b></div></div><br></body></html>';

        //$mail->send();
        $mail->ClearAddresses();
        $success_count++;
    }
    echo 'Успішно надіслано '.$success_count.' повідомлень';