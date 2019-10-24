<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\sgi\models\AuthItem */

$this->title = 'Perfil';
$this->params['breadcrumbs'][] = ['label' => 'Perfil', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-item-create">

    <?= $this->render('_form', [
        'model' => $model,'role_pai'=>$role_pai,'empresas'=>$empresas,'agencias'=>$agencias
    ]) ?>

</div>
