<?php

return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=gesitdb',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'transport'=>[
                'class'=>'Swift_SmtpTransport',
                'host'=>'smtp.gmail.com',
                'username'=>'gesit@sekolahkarakter.sch.id',
                'password'=>'Karakter123!',
                'port' => '587' ,
                'encryption' => 'tls' ,
            ],
            'viewPath' => '@common/mail',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            //'useFileTransport' => false,
        ],
        
    ],
];
