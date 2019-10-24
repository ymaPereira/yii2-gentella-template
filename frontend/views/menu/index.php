<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\core\models\MenuSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Menus';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title">Lista de menu</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
            <div class="menu-index">
                <p> 
                    <?= Html::a('<i class="fa fa-plus"></i>'.' Novo Menu', ['create'], ['class' => 'btn btn-default']) ?>
                </p>
                        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
                    <?php Pjax::begin(); ?>                                   
                         <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            //['class' => 'yii\grid\SerialColumn'],

                            'id',
                            ['attribute'=>'descricao','value'=>function($model){return ($model->menu_principal==0)?$model->descricao:'';}],
                            // ['attribute'=>'self_id','value'=>function($model){return ($model->menu_principal==1)?$model->descricao:'';}],
                            // 'orden',
                            ['attribute'=>'status','value'=>function($model){return ($model->status==1)?'Ativo':'Inativo';}],
                            ['attribute'=>'page','value'=>function($model){return !empty($model->page)?$model->page:'---';},'label'=>'Link'],

                            ['class' => 'yii\grid\ActionColumn',
                            'options'=>['width'=>'100px'],
                            ],
                        ],
                    ]); ?>
                <?php Pjax::end(); ?>        
            </div>
    </div>
</div>
