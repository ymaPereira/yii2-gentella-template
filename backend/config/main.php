<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'template-app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        'orcamento' => [
            'class' => 'backend\modules\orcamento\Orcamento',
        ], 
        'crm' => [
            'class' => 'backend\modules\crm\Crm',
        ], 
    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'loginUrl' => ['site/login'], 
            'identityCookie' => ['name' => '_identity-pme-backend', 'httpOnly' => true],
            'authTimeout' => 1000,
            'on afterLogin'=>function($event){
                $role = \Yii::$app->authManager->getRolesByUser(\Yii::$app->user->identity->id);
                foreach ($role as $key => $value) {
                   $role = $key;
                   break;
                }
                $session = new \yii\web\Session;
                $session->open();
                $session->set('role',$role);
                $session->close();
            }
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'pme-backend',
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
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
    ], 
    'as beforeRequest'=>[
        'class'=>'backend\components\PageControll',
    ],
    'params' => $params,
];
