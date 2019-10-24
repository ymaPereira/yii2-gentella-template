<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\core\models\Menu */

$this->title = 'Menus';
$this->params['breadcrumbs'][] = ['label' => 'Menus', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-primary">
    <div class="box-header with-border"><h3 class="box-title">Informações de menu: <b><?= $model->id?></b></h3></div>
    <div class="box-body">
        <div class="menu-view">

                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                            'id',
                            'descricao',
                            ['attribute'=>'self_id','value'=>!empty($model->self_id)?$model->self->descricao:''],
                            'orden',
                            ['attribute'=>'status','value'=>($model->status==1)?'Ativo':'Inativo'],
                            ['attribute'=>'permission','value'=>!empty($model->permission)?$model->permission:'---'],
                            ['attribute'=>'menu_principal','value'=>($model->menu_principal==1)?'Menu Principal':'Submenu'],
                    ],
                ]) ?>
                <p>
                    <?= Html::a('<i class="fa fa-plus"></i>'.' Novo Registo', ['create'], ['class' => 'btn btn-default left']) ?>

                    <?= Html::a('<i class="fa fa-pencil"></i>'.' Editar', ['update', 'id' => $model->id], ['class' => 'btn btn-default left']) ?>

                    <?= Html::a('<i class="fa fa-trash"></i>'.' Eliminar', ['delete', 'id' => $model->id], [
                        'class' => 'btn btn-default left',
                        'data' => [
                            'confirm' => 'Deseja realmente eliminar este item?',
                            'method' => 'post',
                        ],
                    ]) ?>
                </p>
            </div>
        </div>
</div>
