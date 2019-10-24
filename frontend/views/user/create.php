<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = 'Utilizadores';
$this->params['breadcrumbs'][] = ['label' => 'Utilizadores', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Registar';
?>
<div class="user-create">

    <?= $this->render('_form', [
        'model' => $model,'permission'=>$permission,'value'=>$value,'agencias'=>$agencias
    ]) ?>

</div>
