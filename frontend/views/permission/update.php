<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\sgi\models\AuthItem */

$this->title = 'Páginas';
$this->params['breadcrumbs'][] = ['label' => 'Página', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->name]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="auth-item-update">

    <?= $this->render('_form', [
        'model' => $model,'empresas'=>$empresas,'agencias'=>$agencias
    ]) ?>

</div>
