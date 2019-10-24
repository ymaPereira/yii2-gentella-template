<?php 
use \yii\widgets\ActiveForm;
use \yii\helpers\Html;
use \yii\helpers\Url;
use \yii\helpers\ArrayHelper;

$perfils = ArrayHelper::map(\app\modules\sgao\models\Perfil::find()->innerJoinWith('perfilUsers')->where(['user'=>\Yii::$app->user->identity->id])->all(),'cod_perfil','descricao');
?>
	<div class="login-box" style="width: 400px; border: 1px solid #046897;">
      <div class="login-box-body">
        <?php $form = ActiveForm::begin([
        	'action'=>Url::toRoute(['user/set-perfil'])
			]); ?>
          <div class="form-group has-feedback">
            
          <div class="row">
            <div class="col-xs-9">
            <label class="control-label" for="perfil">Selecione o perfil a entrar</label>
				<?= Html::dropDownList('perfil',null,$perfils,['prompt'=>'--- Selecione o perfil ---','id'=>'perfil','class'=>'form-control','required'=>true])?>
		    </div>
		    <div class="col-xs-3">
		    	<label class="control-label" for="perfil"></label>
		    	<br/>
              <button type="submit" class="btn btn-primary btn-block btn-flat">OK</button>
            </div><!-- /.col -->
          </div>
        <?php ActiveForm::end(); ?>
      </div>
    </div>
</div>
