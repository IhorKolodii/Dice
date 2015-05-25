<?php

$params = require(__DIR__ . '/params.php');

$config = [
  'modules' => [
    'gii' => [
      'class' => 'system.gii.GiiModule',
      'password' => 'passwd',
      'ipFilters' => array('127.0.0.1', '::1'),
    ],
    'user' => [
        'class' => 'dektrium\user\Module',
        'admins' => ['admin','IGKey'],
        'enableConfirmation' => false,
    ],
  ],
  'defaultRoute' => 'dice',
  'id' => 'basic',
  'basePath' => dirname(__DIR__),
  'bootstrap' => ['log'],
  'components' => [
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
            'useFileTransport' => true,
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
