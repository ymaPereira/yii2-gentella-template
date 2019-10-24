<?php

/**
 * @var string $content
 * @var \yii\web\View $this
 */

use yii\helpers\Html;

$bundle = yiister\gentelella\assets\Asset::register($this);
$baseUrl = $bundle->baseUrl;
$this->title = 'Template';
?>
<?php $this->beginPage(); ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta charset="<?= Yii::$app->charset ?>" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <link rel="shortcut icon" href="<?= \Yii::$app->request->baseUrl.'/images/icons/logo.png'?>"/>
</head>
<?php $this->beginBody(); ?>
<body class="nav-md">
<div class="container body">

    <div class="main_container">

        <div class="col-md-3 left_col">
            <div class="left_col scroll-view">

                
                <?php if(!Yii::$app->user->isGuest){?>
                    <!-- sidebar menu -->
                     <?= $this->render('leftmenu.php',['baseUrl'=>$baseUrl]); ?>
                    <!-- /sidebar menu -->
                    <!-- /menu footer buttons -->
                    <?= $this->render('leftmenubutton.php',['baseUrl'=>$baseUrl]); ?>
                    <!-- /menu footer buttons -->
                <?php }?>
            </div>
        </div>

        <!-- top navigation -->
        <?php if(!Yii::$app->user->isGuest){?>
             <?= $this->render('topmenu.php',['baseUrl'=>$baseUrl]); ?>
        <?php }?>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
            <div class="">
                <div class="clearfix"></div>
                <?= $content ?>
            </div>
        </div>
    </div>
</div>
<?php $this->endBody(); ?>
</body>
</html>
<?php $this->endPage(); ?>