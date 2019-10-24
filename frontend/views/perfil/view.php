<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\sgi\models\AuthItem */

$this->title = 'Perfil';
$this->params['breadcrumbs'][] = ['label' => 'Perfil', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->name;
?>
 <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Informações de Perfil</h3>
    </div>
    <div class="box-body">
	    <p>
	        <?= Html::a('<i class="fa fa-plus"></i> Novo Perfil', ['create'], ['class' => 'btn btn-default btn-flat']) ?>
	        <?= Html::a('<i class="fa fa-pencil"></i>'.' Editar', ['update', 'name' => $model->name], ['class' => 'btn btn-default left']) ?>
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
			echo DetailView::widget([
					'model'=>$model,
					'attributes'=>[
						 [
							'attribute'=>'name',
							'label'=>'Código',
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
			?>
		</div>
    </div><!-- /.box-body -->
</div><!-- /.box -->
		  

<div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Informações sobre as permissões</h3>
    </div>
    <div class="box-body">
	
		<?php 
		\yii\widgets\Pjax::begin(['timeout'=>5000,]);
		?>
		
		<!-- Lista de Permissoes a adicionar -->
		<div class="col-lg-6">
			<div class="alert alert-info">Permissões</div>
			<?php if($dataProvider2->getCount()){?>
			<?php
				echo Html::beginForm('','POST',['data-pjax'=>1,]);
				echo Html::hiddenInput('flag', '2');
				 echo yii\grid\GridView::widget([
						'dataProvider' => $dataProvider2,
						'filterModel' => $searchModel2,
						'summaryOptions'=>['class'=>'col-lg-12','style'=>'padding-bottom:20px;'],
						'columns' => [
							[
							'class' => 'yii\grid\CheckboxColumn',
							'headerOptions'=>['width'=>20,],
							],
							[
								'attribute'=>'name',
								'headerOptions'=>['width'=>180,],
							],
							'description:ntext',
						],
					]); 
				echo '<p>'.Html::submitButton('Adicionar', ['class'=>'btn btn-default']).'</p>';
				echo Html::endForm();
				?>
		   <?php }else{
				echo '<div class="col-lg-6">Nenhum resultado encontrado.</div>';
		   }?>
		</div>
		
		<!-- Lista de permissoes que ja foram adicionados -->
	    <div class="col-lg-6">
			<div class="alert alert-info">Remover permissões</div>
			<?php if($dataProvider1->getCount()){?>
			<?php
			 echo Html::beginForm('','POST',['data-pjax'=>1,]);
			 echo Html::hiddenInput('flag', '1');
			 echo yii\grid\GridView::widget([
					'dataProvider' => $dataProvider1,
					'filterModel' => $searchModel1,
					'summaryOptions'=>['class'=>'col-lg-12','style'=>'padding-bottom:20px;'],
					'columns' => [
						[
						'class' => 'yii\grid\CheckboxColumn',
						'headerOptions'=>['width'=>20,],
						],
						[
							'attribute'=>'name',
							'headerOptions'=>['width'=>180,],
						],
						'description:ntext',
					],
				]); 
				
			echo '<p>'.Html::submitButton('Remover', ['class'=>'btn btn-default']).'</p>';
			echo Html::endForm();
			?>
		   <?php }else{
				echo '<div class="col-lg-6">Nenhum resultado encontrado.</div>';
		   }?>

		</div>
   
	</div><!-- /.box-body -->

<?php \yii\widgets\Pjax::end();?>
</div>