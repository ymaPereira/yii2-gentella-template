<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\core\models\Menu */

$this->title = 'Menu' .": ". $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Menus', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Atualizar';
?>
<div class="menu-update">

    <?= $this->render('_form', [
        'model' => $model,'self_id'=>$self_id,'permission'=>$permission,'empresas'=>$empresas,'entidades'=>$entidades
    ]) ?>

</div>
