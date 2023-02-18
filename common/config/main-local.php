<?php

return [
    'components' => [
        /* 'db' => [
            'class' => \yii\db\Connection::class,
            'dsn' => 'mysql:host=localhost;dbname=yii2advanced',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
        ], */
        'html2pdf' => [
            'class' => 'yii2tech\html2pdf\Manager',
            'viewPath' => '@app/views/pdf',
            'converter' => 'wkhtmltopdf',
        ],
        'db'=>array(
            'class' => 'yii\db\Connection',
            'driverName' => 'sqlsrv',
            //'dsn' => 'sqlsrv:Server=localhost\SDUMA_DB;Database=sduma;MultipleActiveResultSets=false ',
            //'dsn' => 'sqlsrv:Server=localhost\\SDUMA_DB;database=sduma',
            //'dsn' => 'mssql:host=localhost\\SDUMA_DB;dbname=sduma',
            'dsn' => 'sqlsrv:Server=localhost\\SDUMA_DB;Database=sduma', // MS SQL Server, sqlsrv driver
            //'dsn' => 'sqlsrv:Server=192.168.18.37\\SDUMA_DB,1433;Database=sduma', // MS SQL Server, sqlsrv driver
            'username' => 'sa',
            'password' => 'vic',
            'charset' => 'utf8',
          
            'emulatePrepare' =>false
        ),
        'mailer' => [
            'class' => /* Symfony\Component\Mailer\Bridge\Google\Transport\GmailSmtpTransport::class  */  \yii\symfonymailer\Mailer::class,
            'viewPath' => '@common/mail',
            // send all mails to a file by default.
            //'useFileTransport' => true,
            // You have to set
            //
            'useFileTransport' => false,
            //
            // and configure a transport for the mailer to send real emails.
            //
            // SMTP server example:
 
            'transport' => [
                'scheme' => 'smtp',/* smtps */
                'host' => 'smtp.gmail.com',
                'username' => 'vicsdumae@gmail.com',
                'password' => 'zlmrtrzpccirllwd',
                'port' => 465,
                'encryption'=>'tls',
                //'dsn' => 'smtp://vicsdumae@gmail.com:VicPass123:465',
            ],
            //
            // DSN example:
            //    'transport' => [
            //        'dsn' => 'smtp://user:pass@smtp.example.com:25',
            //    ],
            //
            // See: https://symfony.com/doc/current/mailer.html#using-built-in-transports
            // Or if you use a 3rd party service, see:
            // https://symfony.com/doc/current/mailer.html#using-a-3rd-party-transport
        ],
    ],
];
