<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\core\models\Menu */

$this->title = 'Gestão de Menu';
$this->params['breadcrumbs'][] = ['label' => 'Menus', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Registar';
?>
<div class="menu-create">
	<h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_form', [
        'model' => $model,'parent'=>$parent,'permission'=>$permission
    ]) ?>

</div>
