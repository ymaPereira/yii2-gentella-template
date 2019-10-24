<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\core\models\Menu */

$this->title = 'Menu';
$this->params['breadcrumbs'][] = ['label' => 'Menus', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Registar';
?>
<div class="menu-create">

    <?= $this->render('_form', [
        'model' => $model,'self_id'=>$self_id,'permission'=>$permission,'empresas'=>$empresas,'entidades'=>$entidades
    ]) ?>

</div>
