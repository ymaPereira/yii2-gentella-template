<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',

    /*'modules' => [
        'admin' => [
            'class' => 'mdm\admin\Module',
        ]    
    ],*/

    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager', // or use 'yii\rbac\PhpManager'
        ],
        'user' => [
            'identityClass' => 'common\models\User',
           // 'class' => 'common\models\User',
            'loginUrl' => ['site/login'],
        ],
        'as beforeRequest'=>[
            'class'=>'backend\components\PageControll',
        ]
    ],
];
