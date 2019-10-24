<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\sgi\models\AuthItem */

$this->title = 'Páginas';
$this->params['breadcrumbs'][] = ['label' => 'Página', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->name;
?>
 <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Informações da Página</h3>
    </div>
    <div class="box-body">
	    <p>
	        <?= Html::a('<i class="fa fa-plus"></i> Nova Página', ['create'], ['class' => 'btn btn-default btn-flat']) ?>
	        <?= Html::a('<i class="fa fa-pencil"></i>'.' Editar', ['update', 'id' => $model->name], ['class' => 'btn btn-default left']) ?>
			<?= Html::a('<i class="fa fa-trash"></i>'.' Eliminar', ['delete', 'id' => $model->name], [
                        'class' => 'btn btn-default left',
                        'data' => [
                            'confirm' => 'Deseja realmente eliminar este item?',
                            'method' => 'post',
                        ],
            ]) ?>
	    </p>
		<hr/>
	    <div class="perfil-view">
			<?php
			
			yii\widgets\Pjax::begin();
			
				echo DetailView::widget([
					'model'=>$model,
					'attributes'=>[
						 [
							'attribute'=>'name',
							'displayOnly'=>true,
						 ],
						'description:ntext',
						[
							'attribute'=>'created_at',
							'label'=>'Registado em',
							'displayOnly'=>true,
							
							'value'=>date('Y-m-d H:i:s',$model->created_at),
						],
						[
							'attribute'=>'updated_at',
							'label'=>'Actualizado em',
							'displayOnly'=>true,
							'value'=>date('Y-m-d H:i:s',$model->updated_at),
						],
						[
							'attribute'=>'empresa_fk',
							'label'=>'Empresa',
							'displayOnly'=>true,
							'value'=>$model->empresaFk->nome,
						],
					]
				]);
				
			yii\widgets\Pjax::end();
			?>
		</div>
    </div><!-- /.box-body -->
</div><!-- /.box -->
