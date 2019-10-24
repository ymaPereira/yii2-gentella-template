<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = 'Utilizadores';
$this->params['breadcrumbs'][] = ['label' => 'Utilizador', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-primary">
    <div class="box-header with-border"><h3 class="box-title">Informações de utilizador: <b><?= $model->id?></b></h3></div>
    <div class="box-body">
        <div class="user-view">

<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
            'id',
            'nome',
            'email:email',
            'username',
            ['attribute'=>'status','value'=>($model->status==1)?'Ativo':'Inativo'],
            ['attribute'=>'created_at','label'=>'Registado em','value'=>date('Y-m-d H:i:s',$model->created_at)],
            ['attribute'=>'updated_at','label'=>'Atualizado em','value'=>date('Y-m-d H:i:s',$model->updated_at)],
            [
                'attribute'=>'agencia_fk',
                'label'=>'Agência',
                'displayOnly'=>true,
                'value'=>$model->agenciaFk->codigo,
            ],
            [
                'attribute'=>'agencia_fk',
                'label'=>'Empresa',
                'displayOnly'=>true,
                'value'=>$model->agenciaFk->idEmpresa->nome,
            ],
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

                    <?= Html::a('<i class="fa fa-street-view"></i>'.' Perfil', ['perfil', 'id' => $model->id], ['class' => 'btn btn-default left']) ?>

                    <?php
                    // Html::a('<i class="fa fa-stack-overflow"></i>'.' Atribuir Permissões', ['permission', 'id' => $model->id], ['class' => 'btn btn-default left']) 
                    ?>
                </p>
            </div>
        </div>
</div>
