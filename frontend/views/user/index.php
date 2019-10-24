<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\core\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Utilizadores';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title">Lista de Utilizadores</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
            <div class="user-index">
                <p> 
                    <?= Html::a('<i class="fa fa-plus"></i>'.' Novo Utilizador', ['create'], ['class' => 'btn btn-default']) ?>
                </p>
                    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
                <?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],
            // 'id',
            'nome',
            'email:email',
            'username',
            ['attribute'=>'status','value'=>function($model){return ($model->status==1)?'Ativo':'Inativo';}],
            // ['attribute'=>'empresa_fk','label'=>'Pentencente a Empresa','value'=>function($model){return $model->empresaFk->nome;}],
            ['class' => 'yii\grid\ActionColumn',
             'template'=>'{view} &nbsp;{update} &nbsp; {perfil} &nbsp; {permission}',
             'buttons'=>[
                    'perfil'=>function($key,$model,$url){
                         return Html::a('<i class="fa fa-street-view"  title="Atribuir Perfil"></i>', \yii\helpers\Url::toRoute(['perfil', 'id'=>$model->id]),['data-pjax'=>0]);
                    },
                    // 'permission'=>function($key,$model,$url){
                    //      return Html::a('<i class="fa fa-stack-overflow"  title="Atribuir Permissões"></i>', \yii\helpers\Url::toRoute(['permission', 'id'=>$model->id]),['data-pjax'=>0]);
                    // },
                ],
            'options'=>['width'=>'150px'],
            ],
        ],
    ]); ?>
<?php Pjax::end(); ?>        </div>
    </div>
</div>
