<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\sgi\models\AuthItem */

$this->title = 'Páginas';
$this->params['breadcrumbs'][] = ['label' => 'Página', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-item-create">

    <?= $this->render('_form', [
        'model' => $model,'empresas'=>$empresas,'agencias'=>$agencias
    ]) ?>

</div>
