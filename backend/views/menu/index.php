<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\core\models\MenuSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Gestão de Menu';
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= Html::encode($this->title) ?></h1>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Menu <small>Lista de menu</small></h2>
                <ul class="nav navbar-right panel_toolbox">
                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <p> 
                <?= Html::a('<i class="fa fa-plus"></i>'.' Novo Menu', ['create'], ['class' => 'btn btn-primary']) ?>
            </p>
            <div class="x_content">
                <?php Pjax::begin(); ?>                                   
                         <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            //['class' => 'yii\grid\SerialColumn'],

                            'id',
                            'name',
                            'route',
                            'order',
                            ['class' => 'yii\grid\ActionColumn',
                            'options'=>['width'=>'100px'],
                            ],
                        ],
                    ]); ?>
                <?php Pjax::end(); ?>   
            </div>
        </div>
    </div>
</div>