<?php

$params = require(__DIR__ . '/params.php');

$config = [
  'name' => 'Dice!',
  'modules' => [
    'gii' => [
      'class' => 'system.gii.GiiModule',
      'password' => 'passwd',
      'ipFilters' => ['127.0.0.1', '::1'],
    ],
    'user' => [
      'class' => 'dektrium\user\Module',
      'modelMap' => [
        'RegistrationForm' => 'app\models\RegistrationForm',
        'RecoveryForm' => 'app\models\RecoveryForm',
       ],
      'admins' => ['admin', 'IGKey'],
      //'enableConfirmation' => false,
      //admin@igkey.8nio.com set to znZbyRQtEf
      //no-reply@igkey.8nio.com set to vBSqF8fJXY
      'mailer' => [
        'sender' => 'dice@localhost', // or ['no-reply@myhost.com' => 'Sender name']
        'welcomeSubject' => 'Welcome to DICE!',
        'confirmationSubject' => 'Confirm you DICE! registration',
        'reconfirmationSubject' => 'Email change on DICE!',
        'recoverySubject' => 'Password recovery on DICE!',
      ],
    ],
  ],
  'defaultRoute' => 'dice',
  'id' => 'basic',
  'basePath' => dirname(__DIR__),
  'bootstrap' => ['log'],
  'components' => [
    'view' => [
      'theme' => [
        'pathMap' => [
          '@dektrium/user/views' => '@app/views/user'
        ],
      ],
    ],
    'request' => [
      // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
      'cookieValidationKey' => 'lWccqAE-qv9OwaG7DbdJn7Kr4ScAGOkJ',
    ],
    'cache' => [
      'class' => 'yii\caching\FileCache',
    ],
    'errorHandler' => [
      'errorAction' => 'site/error',
    ],
    'mailer' => [
      'class' => 'yii\swiftmailer\Mailer',
      // send all mails to a file by default. You have to set
      // 'useFileTransport' to false and configure a transport
      // for the mailer to send real emails.
      'useFileTransport' => false,
      'transport' => [
        'class' => 'Swift_SmtpTransport',
        'host' => 'smtp.gmail.com', // e.g. smtp.mandrillapp.com or smtp.gmail.com
        'username' => 's.dice.service@gmail.com',
        'password' => '123qwe!_',
        'port' => '587', // Port 25 is a very common port too
        //git status
        'encryption' => 'tls', // It is often used, check your provider or mail server specs
      ],
    ],
    'log' => [
      'traceLevel' => YII_DEBUG ? 3 : 0,
      'targets' => [
        [
          'class' => 'yii\log\FileTarget',
          'levels' => ['error', 'warning'],
        ],
      ],
    ],
    'db' => require(__DIR__ . '/db.php'),
  ],
  'params' => $params,
];

if (YII_ENV_DEV) {
  // configuration adjustments for 'dev' environment
  $config['bootstrap'][] = 'debug';
  $config['modules']['debug'] = 'yii\debug\Module';

  $config['bootstrap'][] = 'gii';
  $config['modules']['gii'] = 'yii\gii\Module';
}

return $config;
/*
 * Адрес ПУА: https://cp.beget.ru
Имя пользователя: z51219c4
Пароль: iostream
Сервер: adavs
 */