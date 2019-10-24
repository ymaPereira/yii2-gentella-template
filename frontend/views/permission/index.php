<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\sgi\models\AuthItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Páginas';
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="box box-primary">
    <div class="box-header with-border"><h3 class="box-title">Lista de Páginas</h3></div>
    <div class="box-body">
       
		<div class="auth-item-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <p>
        <?= Html::a('<i class="fa fa-plus"></i> Nova Página', ['create'], ['class' => 'btn btn-default btn-flat']) ?> 
		<?= Html::a('<i class="fa fa-user"></i> Listar Utilizadores', ['user/index'], ['class' => 'btn btn-default btn-flat']) ?>
    </p>
	<hr/>
	
	<?php \yii\widgets\Pjax::begin([
		'timeout'=>5000,
	]);?>
		<?= GridView::widget([
			'dataProvider' => $dataProvider,
			'filterModel' => $searchModel,
			'columns' => [
				//['class' => 'yii\grid\SerialColumn'],
				[
					'attribute'=>'name',
					'headerOptions'=>['width'=>250,],
				],
				'description:ntext',
				['attribute'=>'empresa_fk','value'=>function($model){ return $model->empresaFk->nome;}],
				[
					'class' => 'yii\grid\ActionColumn',
					'template'=>'{view} {update} {delete}',
				],
			],
		]); ?>
		
		<?php \yii\widgets\Pjax::end();?>

	</div>
	   
    </div>	
</div>